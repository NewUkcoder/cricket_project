<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->library(['form_validation', 'session', 'email']);
        // Secure session settings
        $this->config->set_item('sess_cookie_secure', TRUE);
        $this->config->set_item('sess_httponly', TRUE);
    }

    /**
     * Display sign-in page
     */
    public function sign_in() {
        $this->load->view('sign_in');
    }

    /**
     * Handle sign-in form submission
     */
    public function sign_in_submit() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('sign_in');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->auth_model->get_user($email);

            if ($user && password_verify($password, $user['password'])) {
                if (isset($user['is_verified']) && !$user['is_verified']) {
                    $this->session->set_flashdata('error', 'Please verify your email to sign in.');
                    $this->load->view('sign_in');
                } else {
                    $this->session->set_userdata([
                        'user_id' => $user['user_id'],
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'logged_in' => TRUE
                    ]);
                    $this->session->set_flashdata('success', 'Successfully signed in!');
                    redirect('dashboard'); // Adjust to your dashboard route
                }
            } else {
                $this->session->set_flashdata('error', 'Invalid email or password.');
                $this->load->view('sign_in');
            }
        }
    }

    /**
     * Display sign-up page
     */
    public function sign_up() {
        $this->load->view('sign_up');
    }

    /**
     * Handle sign-up form submission
     */
    public function sign_up_submit() {
        // Custom error message for unique email
        $this->form_validation->set_message('is_unique', 'This email is already registered. Please use a different email or sign in.');
        
        $this->form_validation->set_rules('name', 'Full Name', 'required|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]+$/]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->V2('xss_clean');
        $this->form_validation->set_rules('agreement', 'Agreement', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('sign_up');
        } else {
            $data = [
                'name' => $this->input->post('name', TRUE),
                'email' => $this->input->post('email', TRUE),
                'password' => password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT),
                'is_verified' => 0,
                'verification_token' => bin2hex(random_bytes(16)),
                'token_expires_at' => date('Y-m-d H:i:s', strtotime('+1 hour'))
            ];

            if ($this->auth_model->register($data)) {
                // Send verification email
                $this->email->from('no-reply@cricketproject.com', 'Cricket Project');
                $this->email->to($data['email']);
                $this->email->subject('Verify Your Email');
                $this->email->message('Please verify your email by clicking this link: ' . base_url('auth/verify?token=' . $data['verification_token']));
                if ($this->email->send()) {
                    $this->session->set_flashdata('success', 'Registration successful! Please check your email to verify your account.');
                } else {
                    $this->session->set_flashdata('error', 'Registration successful, but failed to send verification email. Contact support.');
                }
                redirect('auth/sign_in');
            } else {
                $this->session->set_flashdata('error', 'Registration failed. Please try again.');
                $this->load->view('sign_up');
            }
        }
    }

    /**
     * Check email uniqueness via AJAX
     */
    public function check_email() {
        $email = $this->input->post('email', TRUE);
        $user = $this->auth_model->get_user($email);
        
        $response = ['exists' => !empty($user)];
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    /**
     * Verify email using token
     */
    public function verify() {
        $token = $this->input->get('token', TRUE);
        if (!$token) {
            $this->session->set_flashdata('error', 'Invalid verification token.');
            redirect('auth/sign_in');
        }

        $user = $this->auth_model->get_user_by_token($token);
        if ($user && strtotime($user['token_expires_at']) > time()) {
            $this->auth_model->verify_user($user['user_id']);
            $this->session->set_flashdata('success', 'Email verified successfully! You can now sign in.');
        } else {
            $this->session->set_flashdata('error', 'Invalid or expired verification token.');
        }
        redirect('auth/sign_in');
    }

    /**
     * Display forgot password page
     */
    public function forgot_password() {
        $this->load->view('forgot_password');
    }

    /**
     * Handle forgot password form submission
     */
    public function forgot_password_submit() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('forgot_password');
        } else {
            $email = $this->input->post('email', TRUE);
            $user = $this->auth_model->get_user($email);

            if ($user) {
                $reset_token = bin2hex(random_bytes(16));
                $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));

                if ($this->auth_model->set_reset_token($user['user_id'], $reset_token, $expires_at)) {
                    // Send reset email
                    $this->email->from('no-reply@cricketproject.com', 'Cricket Project');
                    $this->email->to($email);
                    $this->email->subject('Password Reset Request');
                    $this->email->message('Click this link to reset your password: ' . base_url('auth/reset_password?token=' . $reset_token));
                    if ($this->email->send()) {
                        $this->session->set_flashdata('success', 'A password reset link has been sent to your email.');
                    } else {
                        $this->session->set_flashdata('error', 'Failed to send reset email. Contact support.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Failed to generate reset link. Please try again.');
                }
            } else {
                $this->session->set_flashdata('error', 'No account found with that email.');
            }
            redirect('auth/forgot_password');
        }
    }

    /**
     * Display reset password page
     */
    public function reset_password() {
        $token = $this->input->get('token', TRUE);
        $user = $this->auth_model->get_user_by_reset_token($token);

        if ($user && strtotime($user['reset_token_expires_at']) > time()) {
            $data['token'] = $token;
            $this->load->view('reset_password', $data);
        } else {
            $this->session->set_flashdata('error', 'Invalid or expired reset token.');
            redirect('auth/forgot_password');
        }
    }

    /**
     * Handle reset password form submission
     */
    public function reset_password_submit() {
        $this->form_validation->set_rules('token', 'Token', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]+$/]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('reset_password');
        } else {
            $token = $this->input->post('token', TRUE);
            $password = $this->input->post('password', TRUE);
            $user = $this->auth_model->get_user_by_reset_token($token);

            if ($user && strtotime($user['reset_token_expires_at']) > time()) {
                $this->auth_model->update_password($user['user_id'], password_hash($password, PASSWORD_DEFAULT));
                $this->auth_model->clear_reset_token($user['user_id']);
                $this->session->set_flashdata('success', 'Password reset successfully! Please sign in.');
                redirect('auth/sign_in');
            } else {
                $this->session->set_flashdata('error', 'Invalid or expired reset token.');
                redirect('auth/forgot_password');
            }
        }
    }

    /**
     * Display Terms and Conditions page
     */
    public function terms() {
        $this->load->view('terms');
    }

    /**
     * Display Privacy Policy page
     */
    public function privacy() {
        $this->load->view('privacy');
    }

    /**
     * Handle user logout
     */
    public function logout() {
        $this->session->unset_userdata(['user_id', 'name', 'email', 'logged_in']);
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'Logged out successfully.');
        redirect('auth/sign_in');
    }
}