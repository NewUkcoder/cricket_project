<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function check_user_exists($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

    public function check_name_exists($name) {
        $this->db->where('name', $name);
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

    public function register($data) {
        return $this->db->insert('users', $data);
    }

    public function get_user($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->row_array();
    }

    public function get_user_by_token($token) {
        $this->db->where('verification_token', $token);
        $query = $this->db->get('users');
        return $query->row_array();
    }

    public function verify_user($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->update('users', array(
            'is_verified' => 1,
            'verification_token' => NULL,
            'token_expires_at' => NULL
        ));
    }
}