<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tournament_model extends CI_Model {

public function add_league($data)
{
	 $user_id = $data['user_id'];
    $league_name = $data['league_name'];
    $this->db->where('user_id',$user_id);
    $this->db->where('league_name',$league_name);
    $query=$this->db->get('add_league');
    if ($query->num_rows() == 0) {
     
         $this->db->insert('add_league', $data);
    }
    else{ return 0;}
}

public function get_league($user_id)
{
	$this->db->where('user_id',$user_id);
   
    $query=$this->db->get('add_league');
    if ($query->num_rows() > 0) 
   		 {  

            return $query->result();
        }
}

public function league_information($league_id)
{
	  
	  $this->db->where('league_id',$league_id);
        $query=$this->db->get('add_league');

                if($query->num_rows()==1)
        {
            return $query->row_array();
        }
}


public function tournament_teams($league_id)
{
	 // First, fetch data where league_id matches $team_id and status is 0
    $this->db->select('add_team.team_name, add_team.team_id, add_team.city');
    $this->db->from('league_teams');
    $this->db->join('add_team', 'league_teams.team_id = add_team.team_id');
    $this->db->where('league_teams.league_id', $league_id); // Match league_id
    $this->db->where('league_teams.status', 0); // Status is 0
    $query_one = $this->db->get();
    return $query_one->result();
}

public function accept_request($team_id,$league_id)
{
	 $data = array(
        'status' => 1  // Set new status value, e.g. 1
    );
   //  var_dump($team_one_id,$team_two_id);
    // Update the record in the database
    $this->db->where('team_id', $team_id)
             ->where('league_id', $league_id)
             ->where('status', 0)  // Only update where status is 0
             ->update('league_teams', $data);

    // Check if the update was successful
    if ($this->db->affected_rows() > 0) {
        // Update successful
        return true;
    } else {
        // Update failed (maybe no matching record)
       return false;
    }
}

  public function reject_team_request($data)
{
   // var_dump($data);
    // Check the data to make sure it's correct
    if (empty($data)) {
        return false; // No data provided
    }

    // Optionally, you can log or debug the data
    // var_dump($data); exit;

    $this->db->where($data);
    $this->db->delete('league_teams');

    // Check if the query was successful
    $affected_rows = $this->db->affected_rows();

    if ($affected_rows > 0) {
        return true; // Successful deletion
    } else {
        return false; // No rows deleted, might be an issue with the provided data
    }
}


	public function get_league_teams($league_id) {
    $this->db->select('add_team.team_name, add_team.image_path, add_team.team_id');
    $this->db->from('add_team');
    $this->db->join('league_teams', 'add_team.team_id = league_teams.team_id');
    $this->db->where('league_teams.status', 1);
    $this->db->where('league_teams.league_id', $league_id);
    
    $query = $this->db->get();
    return $query->result_array(); // Returns an array of objects
}

public function get_league_schedule($league_id)
{
   $this->db->select('
    add_schedule.*, 
    team_one.team_name AS team_one_name, 
    team_one.image_path AS team_one_image, 
    team_two.team_name AS team_two_name, 
    team_two.image_path AS team_two_image
');
$this->db->from('add_schedule');
$this->db->join('add_team AS team_one', 'team_one.team_id = add_schedule.team_one_id', 'left');
$this->db->join('add_team AS team_two', 'team_two.team_id = add_schedule.team_two_id', 'left');
$this->db->where('add_schedule.league_id', $league_id);
$this->db->order_by('add_schedule.match_date', 'DESC'); // Order by latest match_date
$this->db->order_by('add_schedule.match_time', 'DESC'); // Then by latest match_time if same date
$query = $this->db->get();
$result = $query->result();
if (!empty($result)) {
   return $result; // or return $result;
} else {
    return false;
}

}

public function league_rules($data)
{
     $this->db->insert('league_rules', $data); //
}

public function get_league_rules($league_id) {
   $this->db->where('league_id',$league_id);
        $query=$this->db->get('league_rules');

                if($query->num_rows()>0)
        {
            return $query->result();
        }
}

public function update_rules($rule_id,$data)
{
        $this->db->where('league_rules_id',$rule_id);
        $this->db->update('league_rules', $data);
        return true;
}

public function league_top_scorer($league_id)
{
    $this->db->select('ap.playerName, ap.player_id, ap.image_path as player_image, at.team_name, at.team_id, at.image_path as team_image, SUM(bf.runs) as total_runs');
$this->db->from('add_schedule asch');
$this->db->join('batting_first bf', 'asch.match_id = bf.match_id');
$this->db->join('add_player ap', 'bf.player_id = ap.player_id');
$this->db->join('add_team at', 'bf.batting_team = at.team_id');
$this->db->where('asch.league_id', 3);
$this->db->group_by('ap.player_id, ap.playerName, ap.image_path, at.team_name, at.team_id, at.image_path');
$this->db->order_by('total_runs', 'DESC');
$this->db->limit(1);
$query = $this->db->get();

if ($query->num_rows() > 0) {
    return $query->row(); // Return the top scorer's details as an object
} else {
    return false; // No data found
}
}


public function league_top_bowler($league_id)
{
   $this->db->select('
        ap.player_id,
        MAX(ap.playerName) AS playerName,
        MAX(ap.image_path) AS player_image,
        MAX(at.team_name) AS team_name,
        MAX(at.team_id) AS team_id,
        MAX(at.image_path) AS team_image,
        SUM(bf.wickets) AS total_wickets
    ');
    $this->db->from('add_schedule asch');
    $this->db->join('bowling_first bf', 'asch.match_id = bf.match_id');
    $this->db->join('add_player ap', 'bf.player_id = ap.player_id');
    $this->db->join('add_team at', 'bf.bowling_team = at.team_id');
    $this->db->where('asch.league_id', $league_id);
    $this->db->group_by('ap.player_id');
    $this->db->order_by('total_wickets', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return false;
    }
}

    public function league_highest_individual_score($league_id) {
       $this->db->select('
        ap.player_id,
        MAX(ap.playerName) AS playerName,
        MAX(ap.image_path) AS player_image,
        MAX(at.team_name) AS team_name,
        MAX(at.team_id) AS team_id,
        MAX(at.image_path) AS team_image,
        MAX(bf.runs) AS highest_score
    ');
    $this->db->from('add_schedule asch');
    $this->db->join('batting_first bf', 'asch.match_id = bf.match_id');
    $this->db->join('add_player ap', 'bf.player_id = ap.player_id');
    $this->db->join('add_team at', 'bf.batting_team = at.team_id');
    $this->db->where('asch.league_id', $league_id);
    $this->db->group_by('ap.player_id');
    $this->db->order_by('highest_score', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return false;
    }
    }

    public function league_ten_individual_scorer($league_id)
    {
  $this->db->select('ap.playerName, ap.player_id, ap.image_path AS player_image, 
                      at.team_name, at.team_id, at.image_path AS team_image, 
                      MAX(bf.runs) AS highest_score');
    $this->db->from('add_schedule asch');
    $this->db->join('batting_first bf', 'asch.match_id = bf.match_id');
    $this->db->join('add_player ap', 'bf.player_id = ap.player_id');
    $this->db->join('add_team at', 'bf.batting_team = at.team_id');
    $this->db->where('asch.league_id', $league_id);
    $this->db->group_by('ap.player_id, ap.playerName, ap.image_path, at.team_name, at.team_id, at.image_path');
    $this->db->order_by('highest_score', 'DESC');
    $this->db->limit(10);
    $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result(); // Return the list of players as an array of objects
        } else {
            return false; // No data found
        }
    }
    

    public function get_top_10_batsmen($league_id) {
        $this->db->select('ap.playerName, ap.player_id, ap.image_path as player_image, at.team_name, at.team_id, at.image_path as team_image, SUM(bf.runs) as total_runs');
$this->db->from('add_schedule asch');
$this->db->join('batting_first bf', 'asch.match_id = bf.match_id');
$this->db->join('add_player ap', 'bf.player_id = ap.player_id');
$this->db->join('add_team at', 'bf.batting_team = at.team_id');
$this->db->where('asch.league_id', 3);
$this->db->group_by(array('ap.player_id', 'ap.playerName', 'ap.image_path', 'at.team_name', 'at.team_id', 'at.image_path'));
$this->db->order_by('total_runs', 'DESC');
$this->db->limit(10);
$query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result(); // Return the list of batsmen as an array of objects
        } else {
            return false; // No data found
        }
    }

    public function league_top_ten_bowler($league_id)
{
   $this->db->select('ap.playerName, ap.player_id, ap.image_path AS player_image, 
                  at.team_name, at.team_id, at.image_path AS team_image, 
                  SUM(bf.wickets) AS total_wickets');
$this->db->from('add_schedule asch');
$this->db->join('bowling_first bf', 'asch.match_id = bf.match_id');
$this->db->join('add_player ap', 'bf.player_id = ap.player_id');
$this->db->join('add_team at', 'bf.bowling_team = at.team_id');
$this->db->where('asch.league_id', $league_id);
$this->db->group_by('ap.player_id, ap.playerName, ap.image_path, at.team_name, at.team_id, at.image_path');
$this->db->order_by('total_wickets', 'DESC');
$this->db->limit(10);
$query = $this->db->get();


if ($query->num_rows() > 0) {
    return $query->result(); // Return the top scorer's details as an object
} else {
    return false; // No data found
}
}

public function league_highest_wicket_taker($league_id) {
      $this->db->select('ap.playerName, ap.player_id, ap.image_path AS player_image, 
                  at.team_name, at.team_id, at.image_path AS team_image, 
                  fb.wickets, fb.given_runs, fb.match_id');
$this->db->from('bowling_first fb');
$this->db->join('add_schedule asch', 'fb.match_id = asch.match_id');
$this->db->join('add_player ap', 'fb.player_id = ap.player_id');
$this->db->join('add_team at', 'fb.bowling_team = at.team_id');
$this->db->where('asch.league_id', $league_id);
$this->db->order_by('fb.wickets', 'DESC');
$this->db->order_by('fb.given_runs', 'ASC'); // Secondary sort for bowlers with same wickets
$this->db->limit(1);
$query = $this->db->get();


        if ($query->num_rows() > 0) {
            return $query->row(); // Return the highest wicket-taker's details as an object
        } else {
            return false; // No data found
        }
    }

   

    public function league_top_ten_bowler_of_match($league_id)
    {
        $this->db->select('ap.playerName, ap.player_id, ap.image_path AS player_image, 
                  at.team_name, at.team_id, at.image_path AS team_image, 
                  fb.wickets, fb.given_runs, fb.match_id, asch.match_date');
$this->db->from('bowling_first fb');
$this->db->join('add_schedule asch', 'fb.match_id = asch.match_id');
$this->db->join('add_player ap', 'fb.player_id = ap.player_id');
$this->db->join('add_team at', 'fb.bowling_team = at.team_id');
$this->db->where('asch.league_id', $league_id);
$this->db->order_by('fb.wickets', 'DESC');
$this->db->order_by('fb.given_runs', 'ASC');
$this->db->order_by('asch.match_date', 'DESC'); // New: recent performances first when equal
$this->db->limit(10);
$query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result(); // Return the highest wicket-taker's details as an object
        } else {
            return false; // No data found
        }
    }

     public function get_highest_team_score($league_id) {
     $this->db->select('
        at.team_name,
        at.team_id,
        at.image_path AS team_image,
        bf.total_runs AS highest_team_score,
        bf.t_overs,
        bf.wickets
    ');
    $this->db->from('add_schedule asch');
    $this->db->join('total_score bf', 'asch.match_id = bf.match_id');
    $this->db->join('add_team at', 'bf.batting_team = at.team_id');
    $this->db->where('asch.league_id', $league_id);
    $this->db->order_by('bf.total_runs', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return false;
    }

    }

      public function league_lowest_team_score($league_id) {
        $this->db->select('
        at.team_name,
        at.team_id,
        at.image_path AS team_image,
        bf.total_runs AS highest_team_score,
        bf.t_overs,
        bf.wickets
    ');
    $this->db->from('add_schedule asch');
    $this->db->join('total_score bf', 'asch.match_id = bf.match_id');
    $this->db->join('add_team at', 'bf.batting_team = at.team_id');
    $this->db->where('asch.league_id', $league_id);
    $this->db->order_by('bf.total_runs', 'ASC');
    $this->db->limit(1);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return false;
    }
}

public function league_top_five_team_score($league_id){
$this->db->select('at.team_name, at.team_id, at.image_path AS team_image, 
                  MAX(bf.total_runs) AS highest_team_score, 
                  bf.t_overs, bf.wickets, asch.match_id');
$this->db->from('add_schedule asch');
$this->db->join('total_score bf', 'asch.match_id = bf.match_id');
$this->db->join('add_team at', 'bf.batting_team = at.team_id');
$this->db->where('asch.league_id', $league_id);
$this->db->group_by('bf.batting_team, at.team_name, at.team_id, at.image_path, bf.t_overs, bf.wickets, asch.match_id');
$this->db->order_by('highest_team_score', 'DESC');
$this->db->limit(5);
$query = $this->db->get();
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result(); // Return team details with highest score
        } else {
            return false; // No data found
        }
}

public function league_lowest_five_score($league_id){
$this->db->select('at.team_name, at.team_id, at.image_path AS team_image, 
                  MAX(bf.total_runs) AS highest_team_score, 
                  bf.t_overs, bf.wickets, asch.match_id');
$this->db->from('add_schedule asch');
$this->db->join('total_score bf', 'asch.match_id = bf.match_id');
$this->db->join('add_team at', 'bf.batting_team = at.team_id');
$this->db->where('asch.league_id', $league_id);
$this->db->group_by('bf.batting_team, at.team_name, at.team_id, at.image_path, bf.t_overs, bf.wickets, asch.match_id');
$this->db->order_by('highest_team_score', 'ASC'); // Changed to ASC for lowest to highest
$this->db->limit(5);
$query = $this->db->get();

return ($query->num_rows() > 0) ? $query->result() : false;
}

public function invite_tournament($email) {
        // Join the user table and add_team table using user_id
        $this->db->select('add_league.league_name, add_league.league_id');
        $this->db->from('users');  // Assuming your users table is named 'users'
        $this->db->join('add_league', 'add_league.user_id = users.user_id');  // Join using user_id
        $this->db->where('users.email', $email);  // Filter by email
        
        $query = $this->db->get();
       // var_dump($query->result());
        // Log or print the query to check if it's correct
        log_message('debug', $this->db->last_query());  // Logs the query
        
        // Return result if available
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        
        return null;  // If no result is found
    }

  


     public function join_tournament($league_id, $team_id)
{


    // Query to check if already exists
    $this->db->select('*');
    $this->db->from('league_teams');
    $this->db->where('(league_id = ' . $league_id . ' AND team_id = ' . $team_id . ') ');
    $query = $this->db->get();

    // If a match exists, return an error message
    if ($query->row()) {

         $this->session->set_flashdata('message', ' Team is already in this league list.');
            $this->session->set_flashdata('message_type', 'error');

         return false;
    }

    // If no match exists, insert the new match
    $data = [
        'league_id' => $league_id,
        'team_id' => $team_id,
        'status' => 0,
        'joined_at' => date('Y-m-d H:i:s')
    ];

    // Insert the new match into the match_team table
    $this->db->insert('league_teams', $data);
     $this->session->set_flashdata('message', 'Request to join this leauge is sent successfully');
$this->session->set_flashdata('message_type', 'success');
    // Get the inserted match IDs (team_one_id and team_two_id)
    //$inserted_id = $this->db->insert_id();  // Gets the last inserted ID
    return true; // Match successfully created
}


public function league_teams($league_id) {
    // Get all active teams in the league
    $this->db->select('at.team_id, at.team_name, at.image_path AS team_image');
    $this->db->from('league_teams lt');
    $this->db->join('add_team at', 'lt.team_id = at.team_id');
    $this->db->where('lt.league_id', $league_id);
    $this->db->where('lt.status', 1); // Active teams only
    $teams = $this->db->get()->result_array();

    if (empty($teams)) {
        return ['message' => 'No active teams found for this league'];
    }

    $results = [];

    foreach ($teams as $team) {
        $team_id = $team['team_id'];
        $team_info = [
            'team_id' => $team['team_id'],
            'team_name' => $team['team_name'],
            'team_image' => $team['team_image']
        ];

        // 1️⃣ Top Batsman (Most Total Runs)
        $top_scorer = $this->db->query("
            SELECT bf.player_id, ap.playerName as player_name, ap.image_path as player_image, SUM(bf.runs) AS total_runs
            FROM batting_first bf
            JOIN add_schedule s ON bf.match_id = s.match_id
            JOIN add_player ap ON bf.player_id = ap.player_id
            WHERE s.league_id = ? AND bf.batting_team = ?
            GROUP BY bf.player_id, ap.playerName, ap.image_path
            ORDER BY total_runs DESC
            LIMIT 1
        ", [$league_id, $team_id])->row_array();

        // 2️⃣ Best Individual Scorer (Highest Runs in a Single Match)
        $highest_individual_score = $this->db->query("
            SELECT bf.player_id, ap.playerName as player_name, ap.image_path as player_image, MAX(bf.runs) AS runs
            FROM batting_first bf
            JOIN add_schedule s ON bf.match_id = s.match_id
            JOIN add_player ap ON bf.player_id = ap.player_id
            WHERE s.league_id = ? AND bf.batting_team = ?
            GROUP BY bf.player_id, ap.playerName, ap.image_path
            ORDER BY runs DESC
            LIMIT 1
        ", [$league_id, $team_id])->row_array();

        // 3️⃣ Top Bowler (Most Total Wickets)
        $top_bowler_data = $this->db->query("
            SELECT bf.player_id, ap.playerName as player_name, ap.image_path as player_image, SUM(bf.wickets) AS total_wickets
            FROM bowling_first bf
            JOIN add_schedule s ON bf.match_id = s.match_id
            JOIN add_player ap ON bf.player_id = ap.player_id
            WHERE s.league_id = ? AND bf.bowling_team = ?
            GROUP BY bf.player_id, ap.playerName, ap.image_path
            ORDER BY total_wickets DESC
            LIMIT 1
        ", [$league_id, $team_id])->row_array();

        // 4️⃣ Best Bowling Performance (Most Wickets in a Single Match + Given Runs)
        $best_bowling_data = $this->db->query("
            SELECT bf.player_id, ap.playerName as player_name, ap.image_path as player_image, 
                   bf.wickets, bf.given_runs,
                   CONCAT(bf.wickets, '/', bf.given_runs) AS bowling_figures
            FROM bowling_first bf
            JOIN add_schedule s ON bf.match_id = s.match_id
            JOIN add_player ap ON bf.player_id = ap.player_id
            WHERE s.league_id = ? AND bf.bowling_team = ?
            ORDER BY bf.wickets DESC, bf.given_runs ASC
            LIMIT 1
        ", [$league_id, $team_id])->row_array();

        $results[] = [
            'team_info' => $team_info,
            'top_scorer' => $top_scorer,
            'highest_individual_score' => $highest_individual_score,
            'top_bowler' => $top_bowler_data ? $top_bowler_data['player_name'] : null,
            'top_bowler_image' => $top_bowler_data ? $top_bowler_data['player_image'] : null,
            'top_bowler_wickets' => $top_bowler_data ? $top_bowler_data['total_wickets'] : null,
            'best_bowler' => $best_bowling_data ? $best_bowling_data['player_name'] : null,
            'best_bowling_image' => $best_bowling_data ? $best_bowling_data['player_image'] : null,
            'best_bowling_figures' => $best_bowling_data ? $best_bowling_data['bowling_figures'] : null
        ];
    }

    return $results;
}

public function get_match_results_by_league_with_batting_order($league_id)
{
    $this->db->select('
        add_schedule.match_id,
        add_schedule.match_date,
        add_schedule.match_time,

        MAX(match_result.win_team) AS win_team,
        MAX(match_result.lost_team) AS lost_team,
        MAX(match_result.result_statement) AS result_statement,

        SUM(CASE WHEN total_score.batting_order = 1 THEN total_score.total_runs ELSE 0 END) AS total_runs_batting_order_1,
        SUM(CASE WHEN total_score.batting_order = 2 THEN total_score.total_runs ELSE 0 END) AS total_runs_batting_order_2,

        GROUP_CONCAT(CASE WHEN total_score.batting_order = 1 THEN total_score.batting_team ELSE NULL END) AS batting_team_batting_order_1,
        GROUP_CONCAT(CASE WHEN total_score.batting_order = 2 THEN total_score.batting_team ELSE NULL END) AS batting_team_batting_order_2,

        SUM(CASE WHEN total_score.batting_order = 1 THEN total_score.t_overs ELSE 0 END) AS total_overs_batting_order_1,
        SUM(CASE WHEN total_score.batting_order = 2 THEN total_score.t_overs ELSE 0 END) AS total_overs_batting_order_2,

        SUM(CASE WHEN total_score.batting_order = 1 THEN total_score.wickets ELSE 0 END) AS wickets_batting_order_1,
        SUM(CASE WHEN total_score.batting_order = 2 THEN total_score.wickets ELSE 0 END) AS wickets_batting_order_2,

        MAX(win_team.team_name) AS win_team_name,
        MAX(win_team.image_path) AS win_team_image,
        MAX(lost_team.team_name) AS lost_team_name,
        MAX(lost_team.image_path) AS lost_team_image
    ');

    $this->db->from('add_schedule');
    $this->db->join('match_result', 'add_schedule.match_id = match_result.match_id', 'inner');
    $this->db->join('total_score', 'add_schedule.match_id = total_score.match_id', 'left');

    // Join add_team twice for winner and loser
    $this->db->join('add_team AS win_team', 'match_result.win_team = win_team.team_id', 'inner');
    $this->db->join('add_team AS lost_team', 'match_result.lost_team = lost_team.team_id', 'inner');

    // Filter by league
    $this->db->where('add_schedule.league_id', $league_id);

    // One row per match
    $this->db->group_by('add_schedule.match_id');

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->result(); // Array of objects
    } else {
        return false; // No results
    }
}







}