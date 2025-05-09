<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library(array('session', 'form_validation'));
        $this->load->helper(array('form', 'url', 'security', 'cookie'));
        $this->load->database();
        log_message('debug', 'Auth controller initialized');
    }

    public function sign_up() {
        log_message('debug', 'Loading view: sign_up');
        $this->load->view('sign_up');
    }
    public function terms()
    {
          $this->load->view('terms');
    }
     public function privacy()
    {
          $this->load->view('privacy');
    }

    public function sign_in() {
        log_message('debug', 'Loading view: sign_in');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header('Expires: 0');
        $this->load->view('sign_in');
    }

    public function sign_up_submit() {
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[3]|max_length[50]|alpha_numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|max_length[100]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|callback_password_strength');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('security_question1', 'First Security Question', 'required');
        $this->form_validation->set_rules('security_answer1', 'First Security Answer', 'required|trim|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('security_question2', 'Second Security Question', 'required');
        $this->form_validation->set_rules('security_answer2', 'Second Security Answer', 'required|trim|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('agreement', 'Agreement', 'required');

        if ($this->form_validation->run() === FALSE) {
            log_message('debug', 'Sign-up validation failed');
            $this->load->view('sign_up');
            return;
        }

        $username = $this->input->post('username', TRUE);
        $email = $this->input->post('email', TRUE);
        $security_question1 = $this->input->post('security_question1', TRUE);
        $security_question2 = $this->input->post('security_question2', TRUE);

        if ($this->Auth_model->check_user_exists($email)) {
            $this->session->set_flashdata('error', 'This email is already registered. Please use a different email.');
            redirect('Auth/sign_up');
        }
        if ($this->Auth_model->check_username_exists($username)) {
            $this->session->set_flashdata('error', 'This username is already taken. Please choose a different username.');
            redirect('Auth/sign_up');
        }
        if ($security_question1 === $security_question2) {
            $this->session->set_flashdata('error', 'Please select different security questions.');
            redirect('Auth/sign_up');
        }

        $user_data = array(
            'username' => $username,
            'email' => $email,
            'password' => password_hash($this->input->post('password', TRUE), PASSWORD_BCRYPT),
            'security_question1' => $security_question1,
            'security_answer1' => hash('sha256', $this->input->post('security_answer1', TRUE)),
            'security_question2' => $security_question2,
            'security_answer2' => hash('sha256', $this->input->post('security_answer2', TRUE)),
            'is_verified' => 1,
            'created_at' => date('Y-m-d H:i:s')
        );

        if ($this->Auth_model->register($user_data)) {
            $this->session->set_flashdata('success', 'Registration successful! You can now sign in.');
            redirect('Auth/sign_in');
        } else {
          $this->session->set_flashdata('error', 'Registration failed. Please try again.');
            redirect('Auth/sign_up');
        }
    }

    public function check_email() {
        $email = $this->input->post('email', TRUE);
        if (!$email) {
            log_message('error', 'Check email called with empty email parameter');
            echo json_encode(['exists' => false, 'error' => 'Email parameter missing', 'csrf_token' => $this->security->get_csrf_hash()]);
            return;
        }
        $exists = $this->Auth_model->check_email($email);
        log_message('debug', 'Check email for: ' . $email . ', exists: ' . ($exists ? 'true' : 'false'));
        echo json_encode([
            'exists' => $exists,
            'csrf_token' => $this->security->get_csrf_hash()
        ]);
    }

    public function sign_in_submit() {
        // Set form validation rules
        $this->form_validation->set_rules('identifier', 'Username or Email', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            log_message('debug', 'Sign-in validation failed: ' . validation_errors());
            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('sign_in');
            return;
        }

        $identifier = $this->input->post('identifier', TRUE);
        $password = $this->input->post('password', TRUE);

        // Check login attempts (expire after 15 minutes)
        $attempt_key = 'login_attempts_' . md5($identifier);
        $attempt_data = $this->session->userdata($attempt_key);
        $attempts = isset($attempt_data['count']) ? $attempt_data['count'] : 0;
        $attempt_time = isset($attempt_data['time']) ? $attempt_data['time'] : time();

        if ($attempts >= 5 && (time() - $attempt_time) < 900) {
            log_message('error', 'Too many login attempts for identifier: ' . $identifier);
            $this->session->set_flashdata('error', 'Too many failed login attempts. Please try again after 15 minutes.');
            redirect('Auth/sign_in');
        }

        // Fetch user from database
        $user = $this->Auth_model->get_user($identifier);
        if (!$user) {
            log_message('error', 'No user found for identifier: ' . $identifier);
            $this->session->set_userdata($attempt_key, ['count' => $attempts + 1, 'time' => time()]);
            $this->session->set_flashdata('error', 'Invalid username or email.');
            redirect('Auth/sign_in');
        }

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Clear login attempts
            $this->session->unset_userdata($attempt_key);

            // Regenerate session ID without destroying old session
            $this->session->sess_regenerate();

            // Set session data
            $session_data = array(
                'user_id' => $user['user_id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'logged' => TRUE
            );
            $this->session->set_userdata($session_data);

            log_message('info', 'User ID ' . $user['user_id'] . ' logged in successfully.');
            redirect('Welcome/landing_page'); // Redirect to dashboard
        } else {
            log_message('error', 'Invalid password for identifier: ' . $identifier);
            $this->session->set_userdata($attempt_key, ['count' => $attempts + 1, 'time' => time()]);
            $this->session->set_flashdata('error', 'Invalid password.');
            redirect('Auth/sign_in');
        }
    }

    public function get_security_questions() {
        $identifier = $this->input->post('identifier', TRUE);
        if (!$identifier) {
            log_message('error', 'Get security questions called with empty identifier');
            echo json_encode([
                'error' => 'Username or email is required.',
                'csrf_token' => $this->security->get_csrf_hash()
            ]);
            return;
        }

        $user = $this->Auth_model->get_user($identifier);
        if (!$user) {
            log_message('error', 'No user found for identifier: ' . $identifier);
            echo json_encode([
                'error' => 'No account found with this username or email.',
                'csrf_token' => $this->security->get_csrf_hash()
            ]);
            return;
        }

        $questions = $this->Auth_model->get_security_questions($user['user_id']);
        echo json_encode([
            'user_id' => $user['user_id'],
            'security_question1' => $questions['security_question1'],
            'security_question2' => $questions['security_question2'],
            'csrf_token' => $this->security->get_csrf_hash()
        ]);
    }

    public function reset_password() {
        log_message('debug', 'Loading view: reset_password');
        $this->load->view('reset_password');
    }

    public function reset_password_submit() {
        $this->form_validation->set_rules('identifier', 'Username or Email', 'required|trim');
        $this->form_validation->set_rules('security_answer1', 'First Security Answer', 'required|trim');
        $this->form_validation->set_rules('security_answer2', 'Second Security Answer', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|callback_password_strength');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() === FALSE) {
            log_message('debug', 'Reset password validation failed');
            $this->load->view('reset_password');
            return;
        }

        $identifier = $this->input->post('identifier', TRUE);
        $user = $this->Auth_model->get_user($identifier);

        if (!$user) {
            $this->session->set_flashdata('error', 'No account found with this username or email.');
            redirect('Auth/reset_password');
        }

        $answers = array(
            'answer1' => $this->input->post('security_answer1', TRUE),
            'answer2' => $this->input->post('security_answer2', TRUE)
        );

        if (!$this->Auth_model->verify_security_answers($user['user_id'], $answers)) {
            $this->session->set_flashdata('error', 'Incorrect security answers.');
            redirect('Auth/reset_password');
        }

        $password = password_hash($this->input->post('password', TRUE), PASSWORD_BCRYPT);
        $update_data = array(
            'password' => $password
        );

        if ($this->Auth_model->update_password($user['user_id'], $update_data)) {
            $this->session->set_flashdata('success', 'Password reset successfully! Please sign in.');
            redirect('Auth/sign_in');
        } else {
            $this->session->set_flashdata('error', 'Failed to reset password. Please try again.');
            redirect('Auth/reset_password');
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
        $user_id = $this->session->userdata('user_id');
        $this->session->unset_userdata(array(
            'user_id',
            'username',
            'email',
            'logged'
        ));
        $this->session->sess_destroy();
        delete_cookie($this->config->item('sess_cookie_name'));
        log_message('info', 'User ID ' . $user_id . ' logged out.');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header('Expires: 0');
        redirect('Auth/sign_in');
    }

    public function delete_account() {
        if (!$this->session->userdata('logged')) {
            $this->session->set_flashdata('error', 'You must be logged in to delete your account.');
            redirect('Auth/sign_in');
        }

        $user_id = $this->session->userdata('user_id');
        if ($this->Auth_model->delete_user($user_id)) {
            $this->logout();
            $this->session->set_flashdata('success', 'Your account has been deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete account. Please try again.');
        }

        redirect('Auth/sign_in');
    }
}