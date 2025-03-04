<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team_model extends CI_Model {

    // Function to save image data to the database
    public function save_image($data) 
    {
        $this->db->insert('add_team', $data); // Insert the data into the 'images' table

    }

     public function get_team($team_id) 
     {
        
       
         $this->db->select('users.user_id, users.email, add_team.*');
        $this->db->from('users');
        $this->db->join('add_team', 'add_team.team_id = users.user_id');
        $this->db->where('add_team.team_id', $team_id);
        $query = $this->db->get();

        // Return the result as an associative array (single row)
        return $query->row_array();
             

    }

    public function team_information($data)
    {
        $this->db->where($data);
        $query=$this->db->get('add_team');

                if($query->num_rows()>0)
        {
            return $query->result();
        }

    }
        public function add_fixture($team_one_id, $team_two_id) {
        // Create the JOIN query
        $this->db->select('
            t1.team_id as team_one_id, 
            t1.team_name as team_one_name, 
            t1.image_path as team_one_image,
            t2.team_id as team_two_id, 
            t2.team_name as team_two_name, 
            t2.image_path as team_two_image
        ');

        // Join the table to itself (self join)
        $this->db->from('add_team t1');
        $this->db->join('add_team t2', 't1.team_id != t2.team_id', 'inner'); // Adjust the join condition

        // Where condition for team_one_id and team_two_id
        $this->db->where('t1.team_id', $team_one_id);
        $this->db->where('t2.team_id', $team_two_id);

        // Run the query
        $query = $this->db->get();

        // Check if records are found
        if ($query->num_rows() > 0) {
            // Fetch the result
            $result = $query->row_array();

            // Prepare a new array to distinguish team one and team two
            $data = [
                'team_one' => [
                    'team_id' => $result['team_one_id'],
                    'team_name' => $result['team_one_name'],
                    'image_path' => $result['team_one_image']
                ],
                'team_two' => [
                    'team_id' => $result['team_two_id'],
                    'team_name' => $result['team_two_name'],
                    'image_path' => $result['team_two_image']
                ]
            ];

            return $data;
        } else {
           
            return null;
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
    
  

    public function invite_team($email) {
        // Join the user table and add_team table using user_id
        $this->db->select('add_team.team_name, add_team.team_id');
        $this->db->from('users');  // Assuming your users table is named 'users'
        $this->db->join('add_team', 'add_team.user_id = users.user_id');  // Join using user_id
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


    // Check and Insert Match in one function
  public function join_match($team_one_id, $team_two_id)
{
    // Ensure team_one_id and team_two_id are not the same
    if ($team_one_id == $team_two_id) {
        

         $this->session->set_flashdata('message', 'Error! Team cannot play against itself.');
        $this->session->set_flashdata('message_type', 'error');

         return 0;
    }

    // Query to check if a match between the two teams already exists
    $this->db->select('*');
    $this->db->from('match_team');
    $this->db->where('(team_one_id = ' . $team_one_id . ' AND team_two_id = ' . $team_two_id . ') 
                        OR (team_one_id = ' . $team_two_id . ' AND team_two_id = ' . $team_one_id . ')');
    $query = $this->db->get();

    // If a match exists, return an error message
    if ($query->row()) {

         $this->session->set_flashdata('message', ' Team is already in match list.');
            $this->session->set_flashdata('message_type', 'error');

         return false;
    }

    // If no match exists, insert the new match
    $data = [
        'team_one_id' => $team_one_id,
        'team_two_id' => $team_two_id,
        'status' => 0,
        'joined_at' => date('Y-m-d H:i:s')
    ];

    // Insert the new match into the match_team table
    $this->db->insert('match_team', $data);
     $this->session->set_flashdata('message', 'Match request is sent successfully');
$this->session->set_flashdata('message_type', 'success');
    // Get the inserted match IDs (team_one_id and team_two_id)
    //$inserted_id = $this->db->insert_id();  // Gets the last inserted ID
    return true; // Match successfully created
}

 public function get_match_teams($team_id) {
    // Select team_name, team_id, and team_image for both teams in the match
    $this->db->select('
        t1.team_name as team_one_name, 
        t1.team_id as team_one_id, 
        t1.image_path as team_one_image, 
        t2.team_name as team_two_name, 
        t2.team_id as team_two_id, 
        t2.image_path as team_two_image,
        mt.team_one_id as original_team_one_id, 
        mt.team_two_id as original_team_two_id
    ');
    
    $this->db->from('match_team mt');
    
    // Join add_team for team_one
    $this->db->join('add_team t1', 'mt.team_one_id = t1.team_id', 'left');
    
    // Join add_team for team_two
    $this->db->join('add_team t2', 'mt.team_two_id = t2.team_id', 'left');
    
    // Filter for team_id matching either team_one_id or team_two_id
    $this->db->where('(
        mt.team_one_id = ' . $this->db->escape($team_id) . ' OR 
        mt.team_two_id = ' . $this->db->escape($team_id) . '
    )');
    
    // Filter for status = 1
    $this->db->where('mt.status', 1);
    
    // Get the results
    $query = $this->db->get();
    
    // Check if any records were found
    if ($query->num_rows() == 0) {
        return ['status' => 'error', 'message' => 'There is no team in your match List yet. Go to invite team option.'];
    }
    
    $results = $query->result();
    
    // Process the results to ensure $team_id is always team_two
    foreach ($results as $result) {
        if ($result->original_team_one_id == $team_id) {
            // Swap team_one and team_two if $team_id is team_one
            $temp_name = $result->team_one_name;
            $temp_id = $result->team_one_id;
            $temp_image = $result->team_one_image;
            
            $result->team_one_name = $result->team_two_name;
            $result->team_one_id = $result->team_two_id;
            $result->team_one_image = $result->team_two_image;
            
            $result->team_two_name = $temp_name;
            $result->team_two_id = $temp_id;
            $result->team_two_image = $temp_image;
        }
        
        // Remove the original IDs as they are no longer needed
        unset($result->original_team_one_id);
        unset($result->original_team_two_id);
    }
    
    return ['status' => 'success', 'data' => $results]; // Return the processed results
}

public function team_request($team_id)
{
    // Perform the JOIN query to fetch team details where team_two_id matches the passed $team_id
    // First, fetch data where team_one_id matches $team_id and status is 0
    $this->db->select('add_team.team_name, add_team.image_path, add_team.team_id, add_team.city');
    $this->db->from('match_team');
    $this->db->join('add_team', 'match_team.team_two_id = add_team.team_id');
    $this->db->where('match_team.team_one_id', $team_id); // Match team_one_id
    $this->db->where('match_team.status', 0); // Status is 0
    $query_one = $this->db->get();
   // var_dump($query_one->result());
    // Fetch data where team_two_id matches $team_id
    $this->db->select('add_team.team_name, add_team.image_path, add_team.team_id, add_team.city');
    $this->db->from('match_team');
    $this->db->join('add_team', 'match_team.team_one_id = add_team.team_id');
    $this->db->where('match_team.team_two_id', $team_id); // Match team_two_id
    $this->db->where('match_team.status', 0); // Status is 0
    $query_two = $this->db->get();

    // Count the number of received and sent requests
    $received_request_count = $query_one->num_rows(); // Number of records in $query_one (received requests)
    $sent_request_count = $query_two->num_rows(); // Number of records in $query_two (sent requests)

    // Return the results along with the total request counts
    $results = array(
        'received_request' => $query_one->result(),
        'sent_request' => $query_two->result(),
        'received_request_count' => $received_request_count,
        'sent_request_count' => $sent_request_count,
        'total_requests' => $received_request_count + $sent_request_count // Total number of requests
    );
   // var_dump($results);
    return $results;
}

    public function accept_match_request($team_two_id,$team_one_id)
    {
     $data = array(
        'status' => 1  // Set new status value, e.g. 1
    );
   //  var_dump($team_one_id,$team_two_id);
    // Update the record in the database
    $this->db->where('team_two_id', $team_one_id)
             ->where('team_one_id', $team_two_id)
             ->where('status', 0)  // Only update where status is 0
             ->update('match_team', $data);

    // Check if the update was successful
    if ($this->db->affected_rows() > 0) {
        // Update successful
        return true;
    } else {
        // Update failed (maybe no matching record)
       return false;
    }
   }
   public function reject_match_request($data)
{
   // var_dump($data);
    // Check the data to make sure it's correct
    if (empty($data)) {
        return false; // No data provided
    }

    // Optionally, you can log or debug the data
    // var_dump($data); exit;

    $this->db->where($data);
    $this->db->delete('match_team');

    // Check if the query was successful
    $affected_rows = $this->db->affected_rows();

    if ($affected_rows > 0) {
        return true; // Successful deletion
    } else {
        return false; // No rows deleted, might be an issue with the provided data
    }
}

public function get_team_schedule($team_id)
{
    $this->db->select('s.*, t1.image_path as team_one_image, t1.team_name as team_one_name, t2.image_path as team_two_image, t2.team_name as team_two_name');
$this->db->from('add_schedule s');
$this->db->join('add_team t1', 't1.team_id = s.team_one_id', 'left'); // Join to get team one details
$this->db->join('add_team t2', 't2.team_id = s.team_two_id', 'left'); // Join to get team two details
$this->db->where('s.team_one_id', $team_id);
$this->db->or_where('s.team_two_id', $team_id);
$query = $this->db->get();

if ($query->num_rows() > 0) {
    // Records found, return the result
    return $query->result(); 
} else {
    // No records found, show a message
    return 0;
}

}
public function team_captain($team_id)
{
        $this->db->select('tc.team_id, tc.ball_type, ap.playerName, ap.image_path');
        $this->db->from('team_captain tc');
        $this->db->join('add_player ap', 'tc.player_id = ap.player_id', 'left');
        $this->db->where('tc.team_id', $team_id); // Filter by team_id
        $query = $this->db->get();

        // Initialize a user-defined array
        $team_details = array(
            'team_id' => $team_id,
            'leather_ball' => array(
                'playerName' => '',
                'image_path' => '',
                'status' => 0 // Default status is 0 (Not Found)
            ),
            'tape_ball' => array(
                'playerName' => '',
                'image_path' => '',
                'status' => 0 // Default status is 0 (Not Found)
            ),
            'tennis_ball' => array(
                'playerName' => '',
                'image_path' => '',
                'status' => 0 // Default status is 0 (Not Found)
            )
        );

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                // Populate the user-defined array based on ball_type
                switch ($row['ball_type']) {
                    case 'leather_ball':
                        $team_details['leather_ball']['playerName'] = $row['playerName'];
                        $team_details['leather_ball']['image_path'] = $row['image_path'];
                        $team_details['leather_ball']['status'] = 1; // Status is 1 (Found)
                        break;
                    case 'tape_ball':
                        $team_details['tape_ball']['playerName'] = $row['playerName'];
                        $team_details['tape_ball']['image_path'] = $row['image_path'];
                        $team_details['tape_ball']['status'] = 1; // Status is 1 (Found)
                        break;
                    case 'tennis_ball':
                        $team_details['tennis_ball']['playerName'] = $row['playerName'];
                        $team_details['tennis_ball']['image_path'] = $row['image_path'];
                        $team_details['tennis_ball']['status'] = 1; // Status is 1 (Found)
                        break;
                }
            }
        }

        // Return the user-defined array
        return $team_details;
    }

    public function insert_captain($data)
    {
        $this->db->insert('team_captain', $data);
    }
    }







