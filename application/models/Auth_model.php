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
     * Get user by email
     * @param string $email
     * @return array|null
     */
    public function get_user($email) {
        $this->db->where('email', $email);
        return $this->db->get('users')->row_array();
    }

    /**
     * Get user by verification token
     * @param string $token
     * @return array|null
     */
    public function get_user_by_token($token) {
        $this->db->where('verification_token', $token);
        return $this->db->get('users')->row_array();
    }

    /**
     * Get user by reset token
     * @param string $token
     * @return array|null
     */
    public function get_user_by_reset_token($token) {
        $this->db->where('reset_token', $token);
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
     * Verify a user's email
     * @param int $user_id
     * @return bool
     */
    public function verify_user($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->update('users', [
            'is_verified' => 1,
            'verification_token' => NULL,
            'token_expires_at' => NULL
        ]);
    }

    /**
     * Set password reset token
     * @param int $user_id
     * @param string $token
     * @param string $expires_at
     * @return bool
     */
    public function set_reset_token($user_id, $token, $expires_at) {
        $this->db->where('user_id', $user_id);
        return $this->db->update('users', [
            'reset_token' => $token,
            'reset_token_expires_at' => $expires_at
        ]);
    }

    /**
     * Update user password
     * @param int $user_id
     * @param string $hashed_password
     * @return bool
     */
    public function update_password($user_id, $hashed_password) {
        $this->db->where('user_id', $user_id);
        return $this->db->update('users', ['password' => $hashed_password]);
    }

    /**
     * Clear reset token
     * @param int $user_id
     * @return bool
     */
    public function clear_reset_token($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->update('users', [
            'reset_token' => NULL,
            'reset_token_expires_at' => NULL
        ]);
    }
}