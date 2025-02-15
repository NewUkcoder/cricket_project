<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    // Check if a user already exists
    public function check_user_exists($email) {
        // Query the users table to see if the username is already taken
        $query = $this->db->get_where('users', array('email' => $email));
        
        // If a result is returned, the username exists
        return $query->num_rows() > 0;
    }

    // Register User
    public function register($data) {
        return $this->db->insert('users', $data);
    }

    // Get User by Username
    public function get_user($email) {
        $query = $this->db->get_where('users', array('email' => $email));
        return $query->row_array();
    }
}
