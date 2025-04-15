<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library(array('session', 'form_validation', 'email'));
        $this->load->helper(array('form', 'url', 'security', 'cookie'));
        $this->load->database();
        log_message('debug', 'Auth controller initialized');
    }

    public function sign_up() {
        log_message('debug', 'Loading view: sign_up');
        $this->load->view('sign_up');
    }

    public function sign_in() {
        log_message('debug', 'Loading view: sign_in');
        $this->load->view('sign_in');
    }

    public function sign_up_submit() {
        $this->form_validation->set_rules('name', 'Name', 'required|trim|min_length[3]|max_length[50]|alpha_numeric_spaces|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|max_length[100]|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|callback_password_strength');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() === FALSE) {
            log_message('debug', 'Sign-up validation failed');
            $this->load->view('sign_up');
            return;
        }

        $name = $this->input->post('name', TRUE);
        $email = $this->input->post('email', TRUE);

        if ($this->Auth_model->check_user_exists($email)) {
            $this->session->set_flashdata('error', 'Email is already registered.');
            redirect('Auth/sign_up');
        }
        if ($this->Auth_model->check_name_exists($name)) {
            $this->session->set_flashdata('error', 'Name is already taken.');
            redirect('Auth/sign_up');
        }

        $token = bin2hex(random_bytes(32));
        $user_data = array(
            'name' => $name,
            'email' => $email,
            'password' => password_hash($this->input->post('password', TRUE), PASSWORD_BCRYPT),
            'verification_token' => $token,
            'token_expires_at' => date('Y-m-d H:i:s', strtotime('+24 hours')),
            'is_verified' => 0,
            'created_at' => date('Y-m-d H:i:s')
        );

        if ($this->Auth_model->register($user_data)) {
            if ($this->send_verification_email($email, $name, $token)) {
                $this->session->set_flashdata('success', 'Registration successful! Please check your email to verify your account.');
            } else {
                $this->session->set_flashdata('error', 'Registration successful, but failed to send verification email. Please contact support.');
                log_message('error', 'Email send failed for ' . $email . ': ' . $this->email->print_debugger());
            }
            redirect('Auth/sign_in');
        } else {
            $this->session->set_flashdata('error', 'Registration failed. Please try again.');
            redirect('Auth/sign_up');
        }
    }

    public function sign_in_submit() {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            log_message('debug', 'Sign-in validation failed');
            $this->load->view('sign_in');
            return;
        }

        $email = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);

        $attempt_key = 'login_attempts_' . md5($email);
        $attempts = $this->session->userdata($attempt_key) ?: 0;
        if ($attempts >= 5) {
            $this->session->set_flashdata('error', 'Too many failed login attempts. Please try again later.');
            redirect('Auth/sign_in');
        }

        $user = $this->Auth_model->get_user($email);

        if ($user && password_verify($password, $user['password'])) {
            if ($user['is_verified'] == 0) {
                $this->session->set_flashdata('error', 'Please verify your email before logging in.');
                redirect('Auth/sign_in');
            }

            $this->session->unset_userdata($attempt_key);
            $this->session->sess_regenerate(TRUE);

            $session_data = array(
                'user_id' => $user['user_id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'logged' => TRUE
            );
            $this->session->set_userdata($session_data);

            log_message('info', 'User ID ' . $user['user_id'] . ' logged in.');
            redirect('Welcome/welcome_message');
        } else {
            $this->session->set_userdata($attempt_key, $attempts + 1);
            log_message('error', 'Failed login attempt for email: ' . $email);
            $this->session->set_flashdata('error', 'Invalid email or password.');
            redirect('Auth/sign_in');
        }
    }

    public function verify_email($token) {
        $user = $this->Auth_model->get_user_by_token($token);

        if (!$user) {
            $this->session->set_flashdata('error', 'Invalid or expired verification token.');
            redirect('Auth/sign_in');
        }

        if (strtotime($user['token_expires_at']) < time()) {
            $this->session->set_flashdata('error', 'Verification token has expired. Please register again.');
            redirect('Auth/sign_up');
        }

        if ($this->Auth_model->verify_user($user['user_id'])) {
            $this->session->set_flashdata('success', 'Email verified successfully! Please sign in.');
        } else {
            $this->session->set_flashdata('error', 'Failed to verify email. Please try again.');
        }

        redirect('Auth/sign_in');
    }

    private function send_verification_email($email, $name, $token) {
        $this->email->from('ahmedmukhtar663@gmail.com', 'Cricket Project');
        $this->email->to($email);
        $this->email->subject('Verify Your Email Address');
        $verification_url = site_url('Auth/verify_email/' . $token);
        $message = '
            <h2>Welcome to Cricket Project, ' . htmlspecialchars($name) . '!</h2>
            <p>Please verify your email by clicking the link below:</p>
            <p><a href="' . $verification_url . '">' . $verification_url . '</a></p>
            <p>This link will expire in 24 hours.</p>
        ';
        $this->email->message($message);

        if ($this->email->send()) {
            log_message('info', 'Verification email sent to ' . $email);
            return TRUE;
        } else {
            log_message('error', 'Failed to send verification email to ' . $email . ': ' . $this->email->print_debugger());
            return FALSE;
        }
    }

    public function password_strength($password) {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
            $this->form_validation->set_message('password_strength', 'Password must be at least 8 characters long and include an uppercase letter, lowercase letter, number, and special character.');
            return FALSE;
        }
        return TRUE;
    }

    public function logout() {
        // Get user ID for logging before destroying session
        $user_id = $this->session->userdata('user_id');
        
        // Clear all session data
        $this->session->unset_userdata(array(
            'user_id', 
            'name', 
            'email', 
            'logged'
        ));
        
        // Destroy the session completely
        $this->session->sess_destroy();
        
        // Clear PHP session data
        session_unset();
        session_destroy();
        
        // Delete the session cookie
        delete_cookie($this->config->item('sess_cookie_name'));
        
        // Regenerate session ID for security
        session_regenerate_id(true);
        
        // Log the logout action
        log_message('info', 'User ID ' . $user_id . ' logged out.');
        
        // Prevent page caching
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header('Expires: 0');
        
        // Force redirect to login page
        redirect('Auth/sign_in', 'refresh');
        exit;
    }
}