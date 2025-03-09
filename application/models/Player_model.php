<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Player_model extends CI_Model {

    // Function to save image data to the database
    public function save_image($data) 
    {
            $user_id=$this->session->userdata('user_id');
             $this->db->where($user_id);
        $query=$this->db->get('add_player');
         if($query->num_rows()==0)
        {
        $this->db->insert('add_player', $data);
        }
        else
        {
            return 0;
        } // Insert the data into the 'images' table

    }

     public function get_player($data) 
     {
       
        $this->db->where($data);
        $query=$this->db->get('add_player');
        
                if($query->num_rows()==1)
        {
            return $query->row_array();
        }

        else 
        {
            return 0;
        }

    }

     public function update_player($user_id,$data) {
       
        $this->db->where('user_id', $user_id);
        return $this->db->update('add_player', $data);
       
    }

    public function searchTeams($email) {
              $this->db->select('add_team.team_name, add_team.team_id');
        $this->db->from('users');  // Assuming your users table is named 'users'
        $this->db->join('add_team', 'add_team.user_id = users.user_id');  // Join using user_id
        $this->db->where('users.email', $email);  

        // Query the add_team table and return the results
        $query = $this->db->get();
        return $query->result();  // Return teams as an array
    }

  public function join_team($player_id, $team_id, $user_id) {
    // Look for the team by name
    $this->db->where('team_id', $team_id);
    $query = $this->db->get('add_team'); // Assuming your table is named 'add_team'

    // Log the team query result
   // log_message('debug', 'Team query result: ' . print_r($query->result(), true));

    if ($query->num_rows() > 0) {
        $team = $query->row(); // Fetch the team

        // Log the team details
      //  log_message('debug', 'Found team: ' . print_r($team, true));

        // Check if the player is already in this team
        $this->db->where('player_id', $player_id);
        $this->db->where('team_id', $team_id);
        $existing_player = $this->db->get('player_team');

        // Log the existing player query result
       // log_message('debug', 'Existing player query result: ' . print_r($existing_player->result(), true));

        if ($existing_player->num_rows() > 0) {
            // Player already in the team
           // log_message('debug', 'Player is already in the team.');
            return false;
        }

        // Insert the player into the team
        $data = [
            'player_id' => $player_id,
            'team_id' => $team->team_id,
            'user_id' => $user_id,
            'status' => 0,
            'joined_at' => date('Y-m-d H:i:s')
        ];

        // Log the data being inserted
       

        // Insert into the player_team table
        if ($this->db->insert('player_team', $data)) {
           // log_message('debug', 'Player added to the team successfully.');
            return true;  // Successful insertion
        } else {
           // log_message('debug', 'Error inserting player into team.');
            return false;  // Insertion failed
        }
    }

   // log_message('debug', 'Team not found: ' . $team_name);
    return false; // Team not found

}

// In your model
// In your model
public function get_player_team($data) {
    // Extract player_id and user_id from the $data array
    $player_id = $data['player_id'];
    $user_id = $data['user_id'];

    // Build the query
    $this->db->select('
        add_team.team_name, 
        add_team.image_path as team_image_path, 
        add_player.playerName, 
        add_player.image_path as player_image_path, 
        player_team.*');
    $this->db->from('player_team');
    $this->db->join('add_team', 'add_team.team_id = player_team.team_id');
    $this->db->join('add_player', 'add_player.player_id = player_team.player_id');

    // Add conditions for player_id and user_id
    $this->db->where('player_team.player_id', $player_id);
    $this->db->where('player_team.user_id', $user_id);
     $this->db->where('player_team.player_id', $player_id);
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


 public function delete_player_from_team($data) {
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


   public function calculate_player_stats($player_id)
{
    $result = [];

    // Leather Ball Stats
    $this->db->select('
        COUNT(*) as total_matches,
        SUM(bf.runs) as total_runs,
        AVG(bf.runs) as average_runs,
        SUM(bf.runs >= 100) as centuries,
        SUM(bf.runs >= 50 AND bf.runs < 100) as fifties,
        MAX(bf.runs) as highest_score
    ');
    $this->db->from('batting_first bf');
    $this->db->join('add_schedule asch', 'bf.match_id = asch.match_id');
    $this->db->where('asch.match_type', 'Leather Ball');
    $this->db->where('bf.player_id', $player_id);
    
    $query = $this->db->get();
    $leather_ball_result = $query->row();
    
    $result['leather_ball'] = [
        'total_matches' => $leather_ball_result->total_matches,
        'total_runs' => $leather_ball_result->total_runs,
        'average_runs' => $leather_ball_result->average_runs,
        'centuries' => $leather_ball_result->centuries,
        'fifties' => $leather_ball_result->fifties,
        'highest_score' => $leather_ball_result->highest_score
    ];

    // Tape Ball Stats
    $this->db->select('
        COUNT(*) as total_matches,
        SUM(bf.runs) as total_runs,
        AVG(bf.runs) as average_runs,
        SUM(bf.runs >= 100) as centuries,
        SUM(bf.runs >= 50 AND bf.runs < 100) as fifties,
        MAX(bf.runs) as highest_score
    ');
    $this->db->from('batting_first bf');
    $this->db->join('add_schedule asch', 'bf.match_id = asch.match_id');
    $this->db->where('asch.match_type', 'Tape Ball');
    $this->db->where('bf.player_id', $player_id);
    
    $query = $this->db->get();
    $tape_ball_result = $query->row();
    
    $result['tape_ball'] = [
        'total_matches' => $tape_ball_result->total_matches,
        'total_runs' => $tape_ball_result->total_runs,
        'average_runs' => $tape_ball_result->average_runs,
        'centuries' => $tape_ball_result->centuries,
        'fifties' => $tape_ball_result->fifties,
        'highest_score' => $tape_ball_result->highest_score
    ];

    // Tennis Ball Stats
    $this->db->select('
        COUNT(*) as total_matches,
        SUM(bf.runs) as total_runs,
        AVG(bf.runs) as average_runs,
        SUM(bf.runs >= 100) as centuries,
        SUM(bf.runs >= 50 AND bf.runs < 100) as fifties,
        MAX(bf.runs) as highest_score
    ');
    $this->db->from('batting_first bf');
    $this->db->join('add_schedule asch', 'bf.match_id = asch.match_id');
    $this->db->where('asch.match_type', 'Tennis Ball');
    $this->db->where('bf.player_id', $player_id);
    
    $query = $this->db->get();
    $tennis_ball_result = $query->row();
    
    $result['tennis_ball'] = [
        'total_matches' => $tennis_ball_result->total_matches,
        'total_runs' => $tennis_ball_result->total_runs,
        'average_runs' => $tennis_ball_result->average_runs,
        'centuries' => $tennis_ball_result->centuries,
        'fifties' => $tennis_ball_result->fifties,
        'highest_score' => $tennis_ball_result->highest_score
    ];

    return $result;
}

public function calculate_player_bowling_stats($player_id) {
    $match_types = ['Leather Ball', 'Tape Ball', 'Tennis Ball', 'Others'];

    $stats = [];

    foreach ($match_types as $match_type) {
        $this->db->select('
            COUNT(*) as total_matches,
            SUM(bf.wickets) as total_wickets,
            SUM(bf.given_runs) as total_runs,
            AVG(bf.given_runs / bf.overs) as economy_rate,
            MAX(bf.wickets) as best_wickets,
            MIN(bf.given_runs) as best_runs
        ');
        $this->db->from('bowling_first bf');
        $this->db->join('add_schedule asch', 'bf.match_id = asch.match_id');
        $this->db->where('bf.player_id', $player_id);

        if ($match_type != 'Others') {
            $this->db->where('asch.match_type', $match_type); // Filter by specific match type
        } else {
            // For 'Others', get all match types that are not 'Leather Ball', 'Tape Ball', or 'Tennis Ball'
            $this->db->where_not_in('asch.match_type', ['Leather Ball', 'Tape Ball', 'Tennis Ball']);
        }

        $query = $this->db->get();
        $result = $query->row();

        // Calculate best bowling figure: wickets/runs in the best match
        $best_bowling = '';
        if ($result->best_wickets > 0 && $result->best_runs > 0) {
            $best_bowling = $result->best_wickets . '/' . $result->best_runs;
        }

        // Store the stats for each match type
        $stats[$match_type] = [
            'total_matches' => $result->total_matches,
            'total_wickets' => $result->total_wickets,
            'total_runs' => $result->total_runs,
            'economy_rate' => round($result->economy_rate ?? 0, 2), // Round economy rate to 2 decimal places, defaulting to 0 if null

            'best_bowling' => $best_bowling,
        ];
    }

    return $stats;
}


    public function get_active_teams($player_id) {
        // Fetch team names where status is 1
        $this->db->select('t.team_name');
        $this->db->from('player_team pt');
        $this->db->join('add_team t', 'pt.team_id = t.team_id');
        $this->db->join('add_player p', 'pt.player_id = p.player_id');
        $this->db->where('pt.status', 1);
         $this->db->where('pt.player_id', $player_id);

        $query = $this->db->get();
        
        // Return the result as an array of objects
        return $query->result();
    
}


}
