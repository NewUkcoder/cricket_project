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


}
