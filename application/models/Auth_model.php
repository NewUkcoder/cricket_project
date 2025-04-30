<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Check if an email exists
     * @param string $email
     * @return bool
     */
    public function check_user_exists($email) {
        $this->db->where('email', $email);
        return $this->db->get('users')->num_rows() > 0;
    }

    /**
     * Check if a username exists
     * @param string $username
     * @return bool
     */
    public function check_username_exists($username) {
        $this->db->where('LOWER(username)', strtolower($username));
        return $this->db->get('users')->num_rows() > 0;
    }

    /**
     * Get user by email or username
     * @param string $identifier
     * @return array|null
     */
    public function get_user($identifier) {
        $this->db->where('email', $identifier);
        $this->db->or_where('username', $identifier);
        return $this->db->get('users')->row_array();
    }

    /**
     * Register a new user
     * @param array $data
     * @return bool
     */
    public function register($data) {
        return $this->db->insert('users', $data);
    }

    /**
     * Update user password
     * @param int $user_id
     * @param array $data
     * @return bool
     */
    public function update_password($user_id, $data) {
        $this->db->where('user_id', $user_id);
        return $this->db->update('users', $data);
    }

    /**
     * Delete a user account
     * @param int $user_id
     * @return bool
     */
    public function delete_user($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->delete('users');
    }

    /**
     * Get security questions for a user
     * @param int $user_id
     * @return array
     */
    public function get_security_questions($user_id) {
        $this->db->select('security_question1, security_question2');
        $this->db->where('user_id', $user_id);
        return $this->db->get('users')->row_array();
    }

    /**
     * Verify security answers
     * @param int $user_id
     * @param array $answers
     * @return bool
     */
    public function verify_security_answers($user_id, $answers) {
        $this->db->where('user_id', $user_id);
        $this->db->where('security_answer1', hash('sha256', $answers['answer1']));
        $this->db->where('security_answer2', hash('sha256', $answers['answer2']));
        return $this->db->get('users')->num_rows() > 0;
    }

    /**
     * Check if an email exists (for AJAX)
     * @param string $email
     * @return bool
     */
    public function check_email($email) {
        return $this->check_user_exists($email);
    }
}