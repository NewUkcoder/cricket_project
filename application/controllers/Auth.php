<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('session'); 
        $this->load->database();// Load Auth model for database operations
    }

    // Sign Up Page
    public function sign_up() {
        $this->load->view('Auth/sign_up');
    }

    // Sign In Page
    public function sign_in() {
        $this->load->view('Auth/sign_in');
    }

    // Handle Sign Up Form Submission
    public function sign_up_submit() 
    {
        $username = $this->input->post('name');

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        
        // You can add validation here for username and password
        
       if ($this->Auth_model->check_user_exists($email)) 
            {
        // Username already exists, redirect to sign-up page with an error message
             $this->session->set_flashdata('error', 'Username is already taken. Please choose a different one.');
             redirect('Welcome/sign_up'); // Redirect back to sign-up form
            } 
            else 
            {
        // Proceed with registration
            $data = array(
            'email' => $email,
            'password' => $password
                );

                if ($this->Auth_model->register($data)) 
                    {
            // Redirect to sign-in page after successful registration
                        $this->session->set_flashdata('success', 'Registration successful! Please sign in.');
                        redirect('Welcome/index');
                    } 
                else 
                    {
            // Handle registration failure
                 $this->session->set_flashdata('error', 'An error occurred. Please try again later.');
                    redirect('Welcome/sign_up');
                    }
            }

    }

    // Handle Sign In Form Submission
    public function sign_in_submit() 
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        
        $user = $this->Auth_model->get_user($email);
        var_dump($user);
        if ($user !== null) {
        if ($password== $user['password']) {
            $session_data = array(
            'user_id' => $user['user_id'],  // Store user ID
            'email' => $user['email'],  // Store username
            'logged' => TRUE  // Indicate the user is logged in
        );
        $this->session->set_userdata($session_data); 
            redirect('Welcome/welcome_message');
        } } else {
            redirect('Welcome/index');
        }
    }

    public function logout() {
    // Destroy all session data
    $this->session->sess_destroy();
    
    // Redirect to login page
    redirect('Welcome/index');
}
}
