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

    public function player_of_match($match_id) 
     {
       
       $this->db->select('ap.playerName, ap.player_id, ap.image_path');
$this->db->from('add_player ap');
$this->db->join('match_player pm', 'ap.player_id = pm.player_id');
$this->db->where('pm.match_id', $match_id);
$query = $this->db->get();
$result = $query->row_array();
return $result;

    }

     public function update_player($user_id,$data) {
       
        $this->db->where('user_id', $user_id);
        return $this->db->update('add_player', $data);
       
    }

    public function add_match_player($data)
    {

        $this->db->where($data);
        $query=$this->db->get('match_player');
        
                if($query->num_rows()==0)
                {
         $this->db->insert('match_player', $data);
     }
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
            add_team.city,
            add_team.team_id,
            add_team.image_path as team_image_path, 
            add_player.playerName, 
            add_player.image_path as player_image_path, 
            player_team.*');
        $this->db->from('player_team');
        $this->db->join('add_team', 'add_team.team_id = player_team.team_id');
        $this->db->join('add_player', 'add_player.player_id = player_team.player_id');
        $this->db->where('player_team.player_id', $player_id);
        $this->db->where('player_team.user_id', $user_id);
        $this->db->where('player_team.status', 0); // Pending requests only
    
        // Execute the query
        $query = $this->db->get();

        // Return results
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
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

// In your Player_model.php

public function calculate_career_stats($player_id) {
    $career_stats = array();
    
    // Batting stats
    $this->db->select('MAX(runs) as highest_score, 
                      SUM(CASE WHEN runs >= 100 THEN 1 ELSE 0 END) as centuries,
                      SUM(runs) as total_runs');
    $this->db->from('batting_first'); // Or whatever your batting table is called
    $this->db->where('player_id', $player_id);
    $batting_query = $this->db->get();
    $batting_stats = $batting_query->row_array();
 //   var_dump($batting_stats);
    // Bowling stats
    $this->db->select('SUM(wickets) as total_wickets,
                      MAX(wickets) as max_wickets,
                      MIN(given_runs) as min_runs_for_max_wickets');
    $this->db->from('bowling_first');
    $this->db->where('player_id', $player_id);
    $bowling_query = $this->db->get();
    $bowling_stats = $bowling_query->row_array();
    
    // Combine stats
    $career_stats['highest_score'] = $batting_stats['highest_score'] ?? 0;
    $career_stats['centuries'] = $batting_stats['centuries'] ?? 0;
    $career_stats['total_wickets'] = $bowling_stats['total_wickets'] ?? 0;
    
    // Calculate best bowling figures
    if (!empty($bowling_stats['max_wickets'])) {
        $this->db->select('given_runs, wickets');
        $this->db->from('bowling_first');
        $this->db->where('player_id', $player_id);
        $this->db->where('wickets', $bowling_stats['max_wickets']);
        $this->db->order_by('given_runs', 'asc');
        $this->db->limit(1);
        $best_bowling_query = $this->db->get();
        $best_bowling = $best_bowling_query->row_array();
        
        if ($best_bowling) {
            $career_stats['best_bowling'] = $best_bowling['wickets'].'/'.$best_bowling['given_runs'];
        } else {
            $career_stats['best_bowling'] = 'N/A';
        }
    } else {
        $career_stats['best_bowling'] = 'N/A';
    }
    
    return $career_stats;
}

// In application/models/Player_model.php

public function get_recent_performance($player_id) {
    if (empty($player_id) || !is_numeric($player_id)) {
        return array();
    }

    $this->db->select('
        s.match_id,
        s.match_date,
        s.match_time,
        s.match_type,
        s.location,
        s.series,
        s.overs AS match_overs,
        mr.win_team,
        mr.lost_team,
        mr.result_statement,
        bf.bowling_team AS opposition,
        bf.runs,
        bf.balls,
        bf.fours,
        bf.sixes,
        bf.batting_team,
        bf.batting_order,
        bf.dismissal,
        IFNULL(bw.given_runs, 0) AS bowling_runs_conceded,
        IFNULL(bw.wickets, 0) AS bowling_wickets,
        IFNULL(bw.overs, 0) AS bowling_overs,
        t1.team_name AS team_one_name,
        t2.team_name AS team_two_name
    ');
    
    $this->db->from('batting_first bf');
    $this->db->join('bowling_first bw', 'bf.match_id = bw.match_id AND bf.player_id = bw.player_id', 'left');
    $this->db->join('match_result mr', 'bf.match_id = mr.match_id');
    $this->db->join('add_schedule s', 'bf.match_id = s.match_id');
    $this->db->join('add_team t1', 's.team_one_id = t1.team_id');
    $this->db->join('add_team t2', 's.team_two_id = t2.team_id');
    $this->db->where('bf.player_id', $player_id);
    $this->db->order_by('s.match_date', 'DESC');
    $this->db->limit(5);
    
    $query = $this->db->get();
  
    if ($query->num_rows() > 0) {
        $performances = $query->result_array();
        
        foreach ($performances as &$performance) {
            // Batting calculations
            $performance['strike_rate'] = ($performance['balls'] > 0) ? 
                round(($performance['runs'] / $performance['balls']) * 100, 2) : 0;
            
            // Match result determination
            $performance['result'] = $this->determine_match_result(
                $performance['win_team'],
                $performance['lost_team'],
                $performance['batting_team']
            );
            
            // Format match date and time
            $performance['formatted_date'] = date('M j, Y', strtotime($performance['match_date']));
            $performance['formatted_time'] = date('g:i A', strtotime($performance['match_time']));
            
            // Determine if player was on team one or two
            $performance['player_team'] = ($performance['batting_team'] == $performance['team_one_name']) ? 
                'team_one' : 'team_two';
        }
        
        return $performances;
    }
    
    return array();
}
private function determine_match_result($win_team, $lost_team, $batting_team) {
    if ($win_team == $batting_team) {
        return 'won';
    } elseif ($lost_team == $batting_team) {
        return 'lost';
    } elseif (!empty($win_team) || !empty($lost_team)) {
        return 'draw';
    }
    return 'no result';
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
        MAX(bf.runs) as highest_score,
        SUM(bf.fours) as fours,
        SUM(bf.sixes) as sixes
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
        'highest_score' => $leather_ball_result->highest_score,
        'fours'=>$leather_ball_result->fours,
        'sixes'=>$leather_ball_result->sixes
    ];

    // Tape Ball Stats
    $this->db->select('
        COUNT(*) as total_matches,
        SUM(bf.runs) as total_runs,
        AVG(bf.runs) as average_runs,
        SUM(bf.runs >= 100) as centuries,
        SUM(bf.runs >= 50 AND bf.runs < 100) as fifties,
        MAX(bf.runs) as highest_score,
         SUM(bf.fours) as fours,
        SUM(bf.sixes) as sixes
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
        'highest_score' => $tape_ball_result->highest_score,
        'fours'=>$tape_ball_result->fours,
        'sixes'=>$tape_ball_result->sixes
    ];

    // Tennis Ball Stats
    $this->db->select('
        COUNT(*) as total_matches,
        SUM(bf.runs) as total_runs,
        AVG(bf.runs) as average_runs,
        SUM(bf.runs >= 100) as centuries,
        SUM(bf.runs >= 50 AND bf.runs < 100) as fifties,
        MAX(bf.runs) as highest_score,
         SUM(bf.fours) as fours,
        SUM(bf.sixes) as sixes
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
        'highest_score' => $tennis_ball_result->highest_score,
        'fours'=>$tennis_ball_result->fours,
        'sixes'=>$tennis_ball_result->sixes
    ];

    return $result;
}

public function calculate_player_bowling_stats($player_id) {
     $match_types = ['Leather Ball', 'Tape Ball', 'Tennis Ball'];
    $bowling_stats = [];

    foreach ($match_types as $type) {
        // Main bowling stats query
        $this->db->select("
            COUNT(DISTINCT bf.match_id) as total_matches,
            SUM(bf.wickets) as total_wickets,
            SUM(bf.given_runs) as total_runs,
            SUM(bf.overs) as overs,
            SUM(CASE WHEN bf.wickets >= 4 AND bf.wickets < 5 THEN 1 ELSE 0 END) as four_wickets,
            SUM(CASE WHEN bf.wickets >= 5 THEN 1 ELSE 0 END) as five_wickets
        ");
        $this->db->from('bowling_first bf');
        $this->db->join('add_schedule s', 'bf.match_id = s.match_id');
        $this->db->where('bf.player_id', $player_id);
        $this->db->where('s.match_type', $type);
        $main_stats = $this->db->get()->row_array();

        // Best bowling figures query
        $this->db->select('
            bf.wickets, 
            bf.given_runs,
            CONCAT(bf.wickets, "/", bf.given_runs) as best_bowling
        ');
        $this->db->from('bowling_first bf');
        $this->db->join('add_schedule s', 'bf.match_id = s.match_id');
        $this->db->where('bf.player_id', $player_id);
        $this->db->where('s.match_type', $type);
        $this->db->where('bf.wickets >', 0);
        $this->db->order_by('bf.wickets', 'DESC');
        $this->db->order_by('bf.given_runs', 'ASC');
        $this->db->limit(1);
        $best_figures = $this->db->get()->row_array();

        // Calculate derived stats
        $wickets = $main_stats['total_wickets'] ?? 0;
        $runs = $main_stats['total_runs'] ?? 0;
        $balls = $main_stats['total_balls'] ?? 0;

        $bowling_stats[$type] = [
            'total_matches' => $main_stats['total_matches'] ?? 0,
            'total_wickets' => $wickets,
            'total_runs' => $runs,
            'total_balls' => $balls,
            'best_bowling' => $best_figures['best_bowling'] ?? 'N/A',
            'four_wickets' => $main_stats['four_wickets'] ?? 0,
            'five_wickets' => $main_stats['five_wickets'] ?? 0,
            // These will be calculated in the view
            'bowling_avg' => ($wickets > 0) ? round($runs / $wickets, 2) : 0,
            'economy' => ($balls > 0) ? round(($runs / $balls) * 6, 2) : 0,
            'bowling_sr' => ($wickets > 0) ? round($balls / $wickets, 2) : 0
        ];
    }

    return $bowling_stats;
}


    public function get_active_teams($player_id) {
        // Fetch team names where status is 1
        $this->db->select('t.team_name');
        $this->db->select('t.team_id');
         $this->db->select('t.city');
         $this->db->select('t.image_path');
        $this->db->from('player_team pt');
        $this->db->join('add_team t', 'pt.team_id = t.team_id');
        $this->db->join('add_player p', 'pt.player_id = p.player_id');
        $this->db->where('pt.status', 1);
         $this->db->where('pt.player_id', $player_id);

        $query = $this->db->get();
        
        // Return the result as an array of objects
        return $query->result();
    
}


public function get_player_leagues($player_id) {
    $this->db->select('al.league_id, al.league_name, al.city, al.created_at');
    $this->db->from('player_team pt');
    $this->db->join('add_team t', 'pt.team_id = t.team_id');
    $this->db->join('league_teams lt', 't.team_id = lt.team_id');
    $this->db->join('add_league al', 'lt.league_id = al.league_id');
    $this->db->where('pt.player_id', $player_id);
    $this->db->where('pt.status', 1); // Active team membership
    $this->db->where('lt.status', 1); // Accepted team in league
    $this->db->group_by('al.league_id, al.league_name, al.city, al.created_at');
    $query = $this->db->get();
    
    return $query->num_rows() > 0 ? $query->result_array() : [];
}

 public function update_profile_picture($player_id, $image_path) {
        if (empty($player_id) || empty($image_path)) {
            return false;
        }
        
        $data = [
            'image_path' => $image_path
        ];
        
        $this->db->where('player_id', $player_id);
        return $this->db->update('add_player', $data);
    }

    public function get_player_image($player_id) {
        $this->db->select('image_path');
        $this->db->where('player_id', $player_id);
        $query = $this->db->get('add_player');
        
        if ($query->num_rows() > 0) {
            return $query->row()->image_path;
        }
        return null;
    }

    public function update_player_field($player_id, $field_name, $new_value) {
        // Validate the field name to make sure it's a valid column
        $valid_fields = ['playerName', 'city', 'date_of_birth', 'batting_style', 'bowling_style', 'player_role', 'additional_info'];
        
        if (in_array($field_name, $valid_fields)) {
            // Prepare the data for the update
            $data = [$field_name => $new_value];

            // Update the field in the database
            $this->db->where('player_id', $player_id);
            return $this->db->update('add_player', $data);
        }

        // Return false if the field name is not valid
        return false;
    }


}
