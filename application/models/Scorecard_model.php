<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scorecard_model extends CI_Model {

  


    public function team_toss($team1_id, $team2_id) {
        // Query for both teams based on their team_id
        $this->db->where('team_id', $team1_id);
        $this->db->or_where('team_id', $team2_id);
        $query = $this->db->get('add_team');
        
        // Initialize variables for the two teams
        $team_1_data = null;
        $team_2_data = null;

        // If we have results, differentiate the teams
        if ($query->num_rows() > 0) {
            // Loop through the results and assign data to each team
            foreach ($query->result() as $team) {
                if ($team->team_id == $team1_id) {
                    $team_1_data = $team;
                }
                if ($team->team_id == $team2_id) {
                    $team_2_data = $team;
                }
            }
        }

        // Return the two teams in an associative array
        return [
            'team_1' => $team_1_data,
            'team_2' => $team_2_data
        ];
    }

        public function insert_toss($data)
    {
         $this->db->insert('toss', $data);
    }

    public function get_toss($data)
    {
         $this->db->where($data);
        $query=$this->db->get('toss');
                if($query->num_rows()==1)
        {
            return $query->row_array();
        }
        else
        {
            return 0;
        }

    }
      public function toss_info_row($match_id)
    {
       $this->db->select('
            toss.match_id,
            toss.toss_winner,
            toss.bat_first,
            toss.bowl_first,
            team_toss.team_name AS toss_winner_name,
            team_bat.team_name AS bat_first_name,
            team_bowl.team_name AS bowl_first_name
        ');
        $this->db->from('toss');
        // Join the add_team table three times with aliases
        $this->db->join('add_team AS team_toss', 'team_toss.team_id = toss.toss_winner', 'left');
        $this->db->join('add_team AS team_bat', 'team_bat.team_id = toss.bat_first', 'left');
        $this->db->join('add_team AS team_bowl', 'team_bowl.team_id = toss.bowl_first', 'left');
        // Filter by match_id
        $this->db->where('toss.match_id', $match_id);
        // Execute the query
        $query = $this->db->get();

        // Check if any rows were returned
        if ($query->num_rows() == 1) {
            // Return the result as an associative array
            return $query->row_array();
        } else {
            // Return a message if no record is found
            return "Record with match_id $match_id does not exist in the toss table.";
        }
    }

    

     public function insert_batting_first($data)
    {   
    $player_id = $data['player_id'];
    $match_id = $data['match_id'];
    $this->db->where('player_id',$player_id);
    $this->db->where('match_id',$match_id);
    $query=$this->db->get('batting_first');
    if ($query->num_rows() == 0) {
     
         $this->db->insert('batting_first', $data);
    }
    else{ return 0;}
}

     public function get_score($data)
    {
        $batting_team = $data['batting_team'];
$match_id = $data['match_id'];

$this->db->select('
    batting_first.*, 
    batsman.playerName as playerName, 
    batsman.player_id as player_id, 
    bowler.playerName as bowler_name, 
    bowler.player_id as bowler_id
');  // Select all columns from batting_first, and batsman/bowler details from add_player
$this->db->from('batting_first');  // Start from the 'batting_first' table
$this->db->join('add_player as batsman', 'batsman.player_id = batting_first.player_id', 'inner');  // Join for batsman
$this->db->join('add_player as bowler', 'bowler.player_id = batting_first.bowler_player_id', 'left');  // Use LEFT JOIN for bowler
$this->db->where('batting_first.batting_team', $batting_team);  // Filter by batting_team
$this->db->where('batting_first.match_id', $match_id);  // Filter by match_id
$query = $this->db->get();  // Execute the query

// Fetch the result
$result = $query->result();
        if ($query->num_rows()>0) 
            {
            return $query->result();
            } 
            else {
       return 0;
                    }

    }


public function player_info($match_id)
{
$this->db->select('add_player.player_id, add_player.playerName');  // Select the 'playerName' column from the 'add_player' table
$this->db->from('add_player');  // From the 'add_player' table
$this->db->join('player_team', 'add_player.player_id = player_team.player_id', 'inner');  // Join the 'player_team' table on the 'player_id'
$this->db->join('toss', 'player_team.team_id = toss.bat_first', 'inner');  // Join the 'batting_first' table on the 'team_id' matching 'batting_team'
$this->db->where('player_team.status', 1);  // Only consider records where the 'status' column in 'player_team' is 1
$this->db->where('toss.match_id', $match_id);  // Add condition to match the 'match_id' in the 'batting_first' table

// Execute the query
$query = $this->db->get();

if ($query->num_rows() > 0) {
    return $query->result();  // Return the results if records are found
} else {
    return false;  // Return false if no records match
}



}

public function player_info_second($match_id)
{
$this->db->select('add_player.player_id, add_player.playerName');  // Select the 'playerName' column from the 'add_player' table
$this->db->from('add_player');  // From the 'add_player' table
$this->db->join('player_team', 'add_player.player_id = player_team.player_id', 'inner');  // Join the 'player_team' table on the 'player_id'
$this->db->join('toss', 'player_team.team_id = toss.bowl_first', 'inner');  // Join the 'batting_first' table on the 'team_id' matching 'batting_team'
$this->db->where('player_team.status', 1);  // Only consider records where the 'status' column in 'player_team' is 1
$this->db->where('toss.match_id', $match_id);  // Add condition to match the 'match_id' in the 'batting_first' table

// Execute the query
$query = $this->db->get();

if ($query->num_rows() > 0) {
    return $query->result();  // Return the results if records are found
} else {
    return false;  // Return false if no records match
}



}

    public function total_score($data)
    {   $this->db->where($data);
        $query=$this->db->get('total_score');
     if ($query->num_rows()==1) 
        {

       return 0;
        } else {
        // Debug line: Query returned no results
         $this->db->insert('total_score', $data);
         }
       
    }

     public function extras($data)
    {
        $this->db->insert('extras', $data);
    }
     
     public function total_extra($data)
    {
       
        $this->db->where($data);
        $query=$this->db->get('extras');
                if ($query->num_rows()==1) 
                {

                return $query->result();
                 } 
                 else {
       
                 return 0;
                 }
    }


    public function get_total_score($data)
    {
       
        $this->db->where($data);
        $query=$this->db->get('total_score');
                if ($query->num_rows()==1) {

        return $query->result();
    } else {
        // Debug line: Query returned no results
        return 0;
    }

    }

    public function insert_bowling_first($player_id,$match_id,$data)
    {
    $player_id = $data['player_id'];
    $match_id = $data['match_id'];
    $this->db->where('player_id',$player_id);
    $this->db->where('match_id',$match_id);
    $query=$this->db->get('bowling_first');
    if ($query->num_rows() == 0) {
     $this->db->insert('bowling_first', $data);   
    }
    else{ return 0;}
}

 public function get_bowling($data)
    {
       
         $bowling_team = $data['bowling_team'];
    $match_id = $data['match_id'];

        $this->db->select('bowling_first.*, add_player.playerName');  // Select all columns from 'batting_first' and 'player_name' from 'add_player'
$this->db->from('bowling_first');  // Start from the 'batting_first' table
$this->db->join('add_player', 'add_player.player_id = bowling_first.player_id', 'inner');  // Join the 'add_player' table using player_id
$this->db->where('bowling_first.bowling_team', $bowling_team);  // Filter by team_id
$this->db->where('bowling_first.match_id', $match_id);  // Filter by match_id
$query = $this->db->get();  // Execute the query

// Fetch the result
$result = $query->result();
        if ($query->num_rows()>0) 
            {
            return $query->result();
            } 
            else {
       return 0;
                    }

    }

    public function get_scorecard($match_id)
    { //echo $match_id;
$this->db->select('
    add_schedule.*,  
    team1.team_name as team_one_name,
    team1.image_path as team_one_image,
    team2.team_name as team_two_name,
    team2.image_path as team_two_image,
    toss.toss_winner,
    toss.decision,
    toss_winner.team_name as toss_winner_name, 
    toss_winner.image_path as toss_winner_image
');

// Select from add_schedule table
$this->db->from('add_schedule');

// Join with add_team for team_one_id
$this->db->join('add_team as team1', 'team1.team_id = add_schedule.team_one_id', 'left');

// Join with add_team for team_two_id
$this->db->join('add_team as team2', 'team2.team_id = add_schedule.team_two_id', 'left');

// Join with toss table
$this->db->join('toss', 'toss.match_id = add_schedule.match_id', 'left');

// Join with add_team for toss_winner team to get toss winner's details
$this->db->join('add_team as toss_winner', 'toss_winner.team_id = toss.toss_winner', 'left');

// Add where clause to filter by specific match_id (optional, if you want data for a specific match)
$this->db->where('add_schedule.match_id', $match_id);

// Execute the query
$query = $this->db->get();
//var_dump($query->result());
// Check if the query returned any results
if ($query->num_rows() > 0) {
    // Return the results as an array
    return $query->row_array();
} else {
    // Return false if no results found
    return false;
}

// Join with ad
}

 public function get_batting_first_details($match_id) {
        // Select all columns from the batting_first table along with team_name and player_name
        $this->db->select('
            bf.*,
            at.team_name, 
            ap.playerName,
            ap.image_path
        ');

        // From the batting_first table
        $this->db->from('batting_first bf');

        // Join with the add_team table to get team_name based on batting_team
        $this->db->join('add_team at', 'at.team_id = bf.batting_team', 'left');

        // Join with the add_player table to get player_name based on player_id
        $this->db->join('add_player ap', 'ap.player_id = bf.player_id', 'left');

        // Filter by match_id (to get details for a specific match)
        $this->db->where('bf.match_id', $match_id);
        $this->db->where('bf.batting_order', 1);

        // Execute the query and get the result
        $query = $this->db->get();
if ($query->num_rows() > 0) {
    // Return the results as an array
    return $query->result();
} else {
    // Return false if no results found
    return false;
} return $query->result();
    }


    public function get_batting_second_details($match_id) {
        // Select all columns from the batting_first table along with team_name and player_name
        $this->db->select('
            bf.*,
            at.team_name, 
            ap.playerName,
            ap.image_path
        ');

        // From the batting_first table
        $this->db->from('batting_first bf');

        // Join with the add_team table to get team_name based on batting_team
        $this->db->join('add_team at', 'at.team_id = bf.batting_team', 'left');

        // Join with the add_player table to get player_name based on player_id
        $this->db->join('add_player ap', 'ap.player_id = bf.player_id', 'left');

        // Filter by match_id (to get details for a specific match)
        $this->db->where('bf.match_id', $match_id);
        $this->db->where('bf.batting_order', 2);

        // Execute the query and get the result
        $query = $this->db->get();
if ($query->num_rows() > 0) {
    // Return the results as an array
    return $query->result();
} else {
    // Return false if no results found
    return false;
} return $query->result();
    }


    public function get_bowling_first_details($match_id) {
        // Select all columns from the batting_first table along with team_name and player_name
        $this->db->select('
            bf.*,
            at.team_name, 
            ap.playerName,
            ap.image_path
        ');

        // From the batting_first table
        $this->db->from('bowling_first bf');

        // Join with the add_team table to get team_name based on batting_team
        $this->db->join('add_team at', 'at.team_id = bf.bowling_team', 'left');

        // Join with the add_player table to get player_name based on player_id
        $this->db->join('add_player ap', 'ap.player_id = bf.player_id', 'left');

        // Filter by match_id (to get details for a specific match)
        $this->db->where('bf.match_id', $match_id);
        $this->db->where('bf.bowling_order', 1);

        // Execute the query and get the result
        $query = $this->db->get();

        // Return all the results
       if ($query->num_rows() > 0) {
    // Return the results as an array
    return $query->result();
} else {
    // Return false if no results found
    return 0;
}
    }

    

 public function get_bowling_second_details($match_id) {
        // Select all columns from the batting_first table along with team_name and player_name
        $this->db->select('
            bf.*,
            at.team_name, 
            ap.playerName,
            ap.image_path
        ');

        // From the batting_first table
        $this->db->from('bowling_first bf');

        // Join with the add_team table to get team_name based on batting_team
        $this->db->join('add_team at', 'at.team_id = bf.bowling_team', 'left');

        // Join with the add_player table to get player_name based on player_id
        $this->db->join('add_player ap', 'ap.player_id = bf.player_id', 'left');

        // Filter by match_id (to get details for a specific match)
        $this->db->where('bf.match_id', $match_id);
        $this->db->where('bf.bowling_order', 2);

        // Execute the query and get the result
        $query = $this->db->get();

        // Return all the results
       if ($query->num_rows() > 0) {
    // Return the results as an array
    return $query->result();
} else {
    // Return false if no results found
    return 0;
}
    }




  public function update_bowling_stats($player_id, $match_id, $overs, $given_runs, $wickets, $bowling_order) {
    $data = array(
        'overs' => $overs,
        'given_runs' => $given_runs,
        'wickets' => $wickets
    );
    $this->db->where('player_id', $player_id);
    $this->db->where('match_id', $match_id);
 //   $this->db->where('bowling_order', $bowling_order);
    return $this->db->update('bowling_first', $data); // Adjust table name as per your schema
}



public function update_score($matchId, $playerId, $data) {
  // Update the score in the database based on match_id and player_id
  $this->db->where('match_id', $matchId);
  $this->db->where('player_id', $playerId);
  return $this->db->update('batting_first', $data); // Assuming you're using 'batting_first' table
}
public function delete_score($match_id, $player_id) {
    $this->db->where('match_id', $match_id);
    $this->db->where('player_id', $player_id);
    return $this->db->delete('batting_first');
}

public function delete_bowling_record($match_id,$player_id){
     $this->db->where('match_id', $match_id);
    $this->db->where('player_id', $player_id);
    return $this->db->delete('bowling_first');
}
public function update_extras($match_id, $batting_order, $data) {
    // Assuming you have a table named "extra" where extras are stored
    $this->db->where('match_id', $match_id);
    $this->db->where('batting_order', $batting_order);
    
    // Update the "extra" table with the new data
    $this->db->update('extras', $data);
    
    // Check for successful update (optional)
    if ($this->db->affected_rows() > 0) {
        return true;
    } else {
        return false;
    }
}



public function edit_total_score($match_id, $batting_order, $total_runs, $t_overs, $wickets)
{
    // Validate input data
    if ($total_runs < 0 || $t_overs < 0 || $wickets < 0 || $wickets > 10) {
        return [
            'score_updated' => false,
            'match_result' => 'Invalid input data'
        ];
    }

    // Start a transaction to ensure atomic updates
    $this->db->trans_start();

    // Update the score record in the database
    $data = array(
        'total_runs' => $total_runs,
        't_overs' => $t_overs,
        'wickets' => $wickets
    );

    // Update the total_score table
    $this->db->where('match_id', $match_id);
    $this->db->where('batting_order', $batting_order);
    $this->db->update('total_score', $data);

    // Check if the update was successful
    if ($this->db->affected_rows() > 0) {
        // Fetch data from total_score table joined with add_team table
        $this->db->select('ts.batting_team, at.team_name, ts.total_runs, ts.wickets, ts.batting_order');
        $this->db->from('total_score ts');
        $this->db->join('add_team at', 'ts.batting_team = at.team_id', 'left');
        $this->db->where('ts.match_id', $match_id);
        $this->db->order_by('ts.batting_order', 'asc');
        $query = $this->db->get();

        // Check if we have complete data (exactly 2 teams)
        if ($query->num_rows() != 2) {
            $this->db->trans_complete();
            return [
                'score_updated' => true,
                'match_result' => 'Incomplete scorecard - need data for both teams'
            ];
        }

        // Process team data
        $teams = [];
        foreach ($query->result() as $row) {
            $teams[$row->batting_team] = [
                'team_name' => $row->team_name,
                'total_runs' => $row->total_runs,
                'wickets' => $row->wickets,
                'batting_order' => $row->batting_order
            ];
        }

        // Verify we have exactly 2 teams
        if (count($teams) != 2) {
            $this->db->trans_complete();
            return [
                'score_updated' => true,
                'match_result' => 'Scorecard must contain exactly 2 teams'
            ];
        }

        // Get team IDs and batting orders
        $team_ids = array_keys($teams);
        $team1 = $teams[$team_ids[0]];
        $team2 = $teams[$team_ids[1]];

        // Check if extras exist for both innings
        $this->db->select('batting_order')
                 ->from('extras')
                 ->where('match_id', $match_id)
                 ->where_in('batting_order', [$team1['batting_order'], $team2['batting_order']])
                 ->group_by('batting_order');
        $extras_count = $this->db->get()->num_rows();

        if ($extras_count != 2) {
            $this->db->trans_complete();
            return [
                'score_updated' => true,
                'match_result' => 'Extras data missing for one or both innings'
            ];
        }

        // Determine the match result
        if ($team1['total_runs'] > $team2['total_runs']) {
            $result = [
                'win_team' => $team_ids[0],
                'lost_team' => $team_ids[1],
                'result_statement' => $team1['team_name'] . ' won by ' . ($team1['total_runs'] - $team2['total_runs']) . ' runs'
            ];
        } elseif ($team2['total_runs'] > $team1['total_runs']) {
            $result = [
                'win_team' => $team_ids[1],
                'lost_team' => $team_ids[0],
                'result_statement' => $team2['team_name'] . ' won by ' . (10 - $team2['wickets']) . ' wickets'
            ];
        } else {
            // Tie - check wickets
            if ($team1['wickets'] < $team2['wickets']) {
                $result = [
                    'win_team' => $team_ids[0],
                    'lost_team' => $team_ids[1],
                    'result_statement' => $team1['team_name'] . ' won by ' . (10 - $team1['wickets']) . ' wickets'
                ];
            } elseif ($team2['wickets'] < $team1['wickets']) {
                $result = [
                    'win_team' => $team_ids[1],
                    'lost_team' => $team_ids[0],
                    'result_statement' => $team2['team_name'] . ' won by ' . (10 - $team2['wickets']) . ' wickets'
                ];
            } else {
                $result = [
                    'win_team' => null,
                    'lost_team' => null,
                    'result_statement' => 'Draw'
                ];
            }
        }

        // Add match_id to result data
        $result_data = array_merge(['match_id' => $match_id], $result);

        // Check if record exists and update/insert accordingly
        $this->db->where('match_id', $match_id);
        if ($this->db->get('match_result')->num_rows() > 0) {
            $this->db->where('match_id', $match_id);
            $this->db->update('match_result', $result_data);
            $this->db->trans_complete();
            return [
                'score_updated' => true,
                'match_result' => 'Match result updated: ' . $result['result_statement']
            ];
        } else {
            $this->db->insert('match_result', $result_data);
            $this->db->trans_complete();
            return [
                'score_updated' => true,
                'match_result' => 'Match result saved: ' . $result['result_statement']
            ];
        }
    } else {
        $this->db->trans_complete();
        return [
            'score_updated' => false,
            'match_result' => 'No changes made to the score'
        ];
    }
}

    
   public function show_total_score($batting_order, $match_id) {
    // Start querying the database
    $this->db->select('
        extras.wides,
        total_score.total_runs,
        total_score.wickets,
        total_score.t_overs,
        extras.no_balls,
        extras.byes,
        extras.leg_byes,
        (extras.wides + extras.no_balls + extras.byes + extras.leg_byes) AS total_extra
    ');
    $this->db->from('extras');
    $this->db->join('total_score', 'total_score.match_id = extras.match_id AND total_score.batting_order = extras.batting_order', 'inner'); // Join on match_id and batting_order
    $this->db->where('extras.match_id', $match_id); // Filter by match_id
    $this->db->where('extras.batting_order', $batting_order); // Filter by batting_order
    $query = $this->db->get(); // Execute the query
 $result = $query->row();
       // var_dump($result);
    // Check if any results were returned
    if ($query->num_rows() > 0) {
        // If records are found, fetch the result
        $result = $query->result();
       return $result;
        // Return the result as an array
      
    } else {
        // If no records found, return a message
        return 0;
    }
}


 public function calculate_match_result($match_id) {
    // Fetch data from total_score table joined with add_team table
    $this->db->select('ts.batting_team, at.team_name, ts.total_runs, ts.wickets, ts.batting_order');
    $this->db->from('total_score ts');
    $this->db->join('add_team at', 'ts.batting_team = at.team_id', 'left');
    $this->db->where('ts.match_id', $match_id);
    $this->db->order_by('ts.batting_order', 'asc');
    $query = $this->db->get();

    // Check if we have complete data (exactly 2 teams)
    if ($query->num_rows() != 2) {
        return "Incomplete scorecard - need data for both teams";
    }

    // Process team data
    $teams = [];
    foreach ($query->result() as $row) {
        $teams[$row->batting_team] = [
            'team_name' => $row->team_name,
            'total_runs' => $row->total_runs,
            'wickets' => $row->wickets,
            'batting_order' => $row->batting_order
        ];
    }

    // Verify we have exactly 2 teams
    if (count($teams) != 2) {
        return "Scorecard must contain exactly 2 teams";
    }

    // Get team IDs and batting orders
    $team_ids = array_keys($teams);
    $team1 = $teams[$team_ids[0]];
    $team2 = $teams[$team_ids[1]];

    // Check if extras exist for both innings
    $this->db->select('batting_order')
             ->from('extras')
             ->where('match_id', $match_id)
             ->where_in('batting_order', [$team1['batting_order'], $team2['batting_order']])
             ->group_by('batting_order');
    $extras_count = $this->db->get()->num_rows();

    if ($extras_count != 2) {
        return "Extras data missing for one or both innings";
    }

    // Determine the match result
    if ($team1['total_runs'] > $team2['total_runs']) {
        $result = [
            'win_team' => $team_ids[0],
            'lost_team' => $team_ids[1],
            'result_statement' => $team1['team_name'].' won by '.($team1['total_runs'] - $team2['total_runs']).' runs'
        ];
    } 
    elseif ($team2['total_runs'] > $team1['total_runs']) {
        $result = [
            'win_team' => $team_ids[1],
            'lost_team' => $team_ids[0],
            'result_statement' => $team2['team_name'].' won by '.(10 - $team2['wickets']).' wickets'
        ];
    } 
    else {
        // Tie - check wickets
        if ($team1['wickets'] < $team2['wickets']) {
            $result = [
                'win_team' => $team_ids[0],
                'lost_team' => $team_ids[1],
                'result_statement' => $team1['team_name'].' won by '.(10 - $team1['wickets']).' wickets'
            ];
        } 
        elseif ($team2['wickets'] < $team1['wickets']) {
            $result = [
                'win_team' => $team_ids[1],
                'lost_team' => $team_ids[0],
                'result_statement' => $team2['team_name'].' won by '.(10 - $team2['wickets']).' wickets'
            ];
        } 
        else {
            $result = [
                'win_team' => null,
                'lost_team' => null,
                'result_statement' => 'Draw'
            ];
        }
    }

    // Add match_id to result data
    $result_data = array_merge(['match_id' => $match_id], $result);

    // Check if record exists and update/insert accordingly
    $this->db->where('match_id', $match_id);
    if ($this->db->get('match_result')->num_rows() > 0) {
        $this->db->where('match_id', $match_id);
        $this->db->update('match_result', $result_data);
        return "Match result updated: ".$result['result_statement'];
    } 
    else {
        $this->db->insert('match_result', $result_data);
        return "Match result saved: ".$result['result_statement'];
    }


    return $result_statement;
}

 public function get_player_of_match($match_id) {
        $this->db->select('p.player_id, p.playerName, p.image_path');
        $this->db->from('match_player mp');
        $this->db->join('add_player p', 'mp.player_id = p.player_id');
        $this->db->where('mp.match_id', $match_id);
      
        $this->db->limit(1);
        
        $query = $this->db->get();
        return $query->row();
}
}