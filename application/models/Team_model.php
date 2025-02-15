<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team_model extends CI_Model {

    // Function to save image data to the database
    public function save_image($data) 
    {
        $this->db->insert('add_team', $data); // Insert the data into the 'images' table

    }

     public function get_team($data) 
     {
        
        $this->db->where($data);
        $query=$this->db->get('add_team');
                if($query->num_rows()>0)
        {
            return $query->result();
        }

    }
   public function get_player_request($team_id)
   {


    // Build the query
    $this->db->select('
         add_player.player_id,
        add_player.playerName,
        add_player.player_role, 
        add_player.image_path, 
        player_team.*');
    $this->db->from('player_team');
    $this->db->join('add_player', 'add_player.player_id = player_team.player_id');

    // Add conditions for player_id and user_id
    $this->db->where('player_team.team_id', $team_id);
    $this->db->where('player_team.status', 0); // Assuming user_id is in player_team table
    
    // Execute the query
    $query = $this->db->get();

    // Check if any rows are returned and return the appropriate result
    if ($query->num_rows() > 0) {
        return $query->result(); // Return as an array of rows
    } else {
        return array(); // Return an empty array if no results
    }
   }

   public function accept_request($player_id,$team_id)
   {
     $data = array(
        'status' => 1  // Set new status value, e.g. 1
    );

    // Update the record in the database
    $this->db->where('player_id', $player_id)
             ->where('team_id', $team_id)
             ->where('status', 0)  // Only update where status is 0
             ->update('player_team', $data);

    // Check if the update was successful
    if ($this->db->affected_rows() > 0) {
        // Update successful
        echo "Record updated successfully.";
    } else {
        // Update failed (maybe no matching record)
        echo "No records updated.";
    }
   }

public function get_squad($team_id)
{
    $this->db->select('
         add_player.player_id,
        add_player.playerName,
        add_player.player_role, 
        add_player.image_path, 
        player_team.*');
    $this->db->from('player_team');
    $this->db->join('add_player', 'add_player.player_id = player_team.player_id');

    // Add conditions for player_id and user_id
    $this->db->where('player_team.team_id', $team_id);
    $this->db->where('player_team.status', 1); // Assuming user_id is in player_team table
    
    // Execute the query
    $query = $this->db->get();

    // Check if any rows are returned and return the appropriate result
    if ($query->num_rows() > 0) {
        return $query->result(); // Return as an array of rows
    } else {
        return array(); // Return an empty array if no results
    }
}
public function delete_player_request($data) {
        // Delete player record from player_team table where player_id matches
        $this->db->where($data);
        $this->db->delete('player_team');
        
        // Optionally, you can check if the query was successful
        if ($this->db->affected_rows() > 0) {
            return true; // Successful deletion
        } else {
            return false; // Failed deletion
        }
    }

     public function get_team_stats($team_id)
    {
        $this->db->select('
            COUNT(*) AS total_matches,
            SUM(CASE WHEN win_team = ' . $this->db->escape($team_id) . ' THEN 1 ELSE 0 END) AS win_matches,
            SUM(CASE WHEN lost_team = ' . $this->db->escape($team_id) . ' THEN 1 ELSE 0 END) AS lost_matches
        ');
        $this->db->from('match_result');
        $this->db->where('win_team', $team_id);
        $this->db->or_where('lost_team', $team_id);
        $query = $this->db->get();

        // Return the result as an array
        return $query->row_array();
    }
    
}
