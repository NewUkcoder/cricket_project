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
    $this->db->select('ap.playerName, ap.player_id, ap.image_path AS player_image, 
                           at.team_name, at.team_id, at.image_path AS team_image, 
                           SUM(bf.runs) AS total_runs');
        $this->db->from('add_schedule asch');
        $this->db->join('batting_first bf', 'asch.match_id = bf.match_id');
        $this->db->join('add_player ap', 'bf.player_id = ap.player_id');
        $this->db->join('add_team at', 'bf.batting_team = at.team_id'); // Join with add_team
        $this->db->where('asch.league_id', $league_id);
        $this->db->group_by('ap.player_id'); // Group by player to calculate total runs
        $this->db->order_by('total_runs', 'DESC'); // Order by total runs in descending order
        $this->db->limit(1); // Limit to the top scorer
        $query = $this->db->get();

if ($query->num_rows() > 0) {
    return $query->row(); // Return the top scorer's details as an object
} else {
    return false; // No data found
}
}


public function league_top_bowler($league_id)
{
    $this->db->select('ap.playerName, ap.player_id, ap.image_path AS player_image, 
                           at.team_name, at.team_id, at.image_path AS team_image, 
                           SUM(bf.wickets) AS total_wickets');
        $this->db->from('add_schedule asch');
        $this->db->join('bowling_first bf', 'asch.match_id = bf.match_id');
        $this->db->join('add_player ap', 'bf.player_id = ap.player_id');
        $this->db->join('add_team at', 'bf.bowling_team = at.team_id'); // Join with add_team
        $this->db->where('asch.league_id', $league_id);
        $this->db->group_by('ap.player_id'); // Group by player to calculate total runs
        $this->db->order_by('total_wickets', 'DESC'); // Order by total runs in descending order
        $this->db->limit(1); // Limit to the top scorer
        $query = $this->db->get();

if ($query->num_rows() > 0) {
    return $query->row(); // Return the top scorer's details as an object
} else {
    return false; // No data found
}
}

    public function league_highest_individual_score($league_id) {
        $this->db->select('ap.playerName, ap.player_id, ap.image_path AS player_image, 
                           at.team_name, at.team_id, at.image_path AS team_image, 
                           MAX(bf.runs) AS highest_score');
        $this->db->from('add_schedule asch');
        $this->db->join('batting_first bf', 'asch.match_id = bf.match_id');
        $this->db->join('add_player ap', 'bf.player_id = ap.player_id');
        $this->db->join('add_team at', 'bf.batting_team = at.team_id'); // Join with add_team
        $this->db->where('asch.league_id', $league_id);
        $this->db->group_by('ap.player_id'); // Group by player to find individual scores
        $this->db->order_by('highest_score', 'DESC'); // Order by highest score in descending order
        $this->db->limit(1); // Limit to the player with the highest individual score
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row(); // Return the player's details as an object
        } else {
            return false; // No data found
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
        $this->db->join('add_team at', 'bf.batting_team = at.team_id'); // Join with add_team
        $this->db->where('asch.league_id', $league_id);
        $this->db->group_by('ap.player_id'); // Group by player to find individual scores
        $this->db->order_by('highest_score', 'DESC'); // Order by highest score in descending order
        $this->db->limit(10); // Limit to the top 10 players
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result(); // Return the list of players as an array of objects
        } else {
            return false; // No data found
        }
    }
    

    public function get_top_10_batsmen($league_id) {
        $this->db->select('ap.playerName, ap.player_id, ap.image_path AS player_image, 
                           at.team_name, at.team_id, at.image_path AS team_image, 
                           SUM(bf.runs) AS total_runs');
        $this->db->from('add_schedule asch');
        $this->db->join('batting_first bf', 'asch.match_id = bf.match_id');
        $this->db->join('add_player ap', 'bf.player_id = ap.player_id');
        $this->db->join('add_team at', 'bf.batting_team = at.team_id'); // Join with add_team
        $this->db->where('asch.league_id', $league_id);
        $this->db->group_by('ap.player_id'); // Group by player to calculate total runs
        $this->db->order_by('total_runs', 'DESC'); // Order by total runs in descending order
        $this->db->limit(10); // Limit to the top 10 batsmen
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
        $this->db->join('add_team at', 'bf.bowling_team = at.team_id'); // Join with add_team
        $this->db->where('asch.league_id', $league_id);
        $this->db->group_by('ap.player_id'); // Group by player to calculate total runs
        $this->db->order_by('total_wickets', 'DESC'); // Order by total runs in descending order
        $this->db->limit(10); // Limit to the top scorer
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
        $this->db->join('add_schedule asch', 'fb.match_id = asch.match_id'); // Join with add_schedule
        $this->db->join('add_player ap', 'fb.player_id = ap.player_id'); // Join with add_player
        $this->db->join('add_team at', 'fb.bowling_team = at.team_id'); // Join with add_team
        $this->db->where('asch.league_id', $league_id); // Filter by league_id
        $this->db->order_by('fb.wickets', 'DESC'); // Order by wickets in descending order
        $this->db->order_by('fb.given_runs', 'ASC'); // Order by given_runs in ascending order
        $this->db->limit(1); // Limit to the highest wicket-taker
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row(); // Return the highest wicket-taker's details as an object
        } else {
            return false; // No data found
        }
    }


}
