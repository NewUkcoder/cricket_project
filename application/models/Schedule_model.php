<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_model extends CI_Model {

    // Function to save image data to the database
    public function save_schedule($data, $team1, $team2, $match_date, $match_time) 
{
    
    
    // Check if a match already exists with the same teams and date/time
    $this->db->from('add_schedule');
    $this->db->where('( 
            (add_schedule.team_one_id = ' . $team1 . ' AND add_schedule.team_two_id = ' . $team2 . ') 
            OR 
            (add_schedule.team_one_id = ' . $team2 . ' AND add_schedule.team_two_id = ' . $team1 . ') 
        )');
    $this->db->where('add_schedule.match_date', $match_date);
    $this->db->where('add_schedule.match_time', $match_time);
    
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        // A match already exists for the same teams and date/time
        return false; // Or handle this as needed
    } else {
        // No match exists, proceed with inserting the new schedule
        $this->db->insert('add_schedule', $data);
        return true; // Successfully inserted
    }
}


    
       // File: application/models/Schedule_model.php
public function get_schedule($user_id)
    {
        // Select the required fields
        $this->db->select('
            add_schedule.*,
            team_one.team_name AS team_one_name,
            team_one.image_path AS team_one_image,
            team_two.team_name AS team_two_name,
            team_two.image_path AS team_two_image,
            add_schedule.match_id
        ');

        // From add_schedule table
        $this->db->from('add_schedule');

        // Join team_one_id with add_team table
        $this->db->join('add_team AS team_one', 'add_schedule.team_one_id = team_one.team_id', 'left');

        // Join team_two_id with add_team table
        $this->db->join('add_team AS team_two', 'add_schedule.team_two_id = team_two.team_id', 'left');

        // Filter schedules by user_id (assuming add_team has user_id)
        $this->db->where('add_schedule.user_id', $user_id);
        

        $query = $this->db->get();

        return $query->result(); // Return the result as an array
    }


    public function total_score($data)
    {
        $this->db->insert('total_score', $data); //
    }

    
}




    