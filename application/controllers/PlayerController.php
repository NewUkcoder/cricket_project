<?php

// Controller: PlayerController.php

defined('BASEPATH') OR exit('No direct script access allowed');

class PlayerController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Player_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('upload');
        
        $this->load->database();
           $this->load->library('user_agent');
        if($this->session->userdata('logged')!=true)
    {
    
        redirect('Welcome/index');
    }
        
    }

    public function add_player()
    {
        

            $user_id=$this->session->userdata('user_id');
            
            $record=array('playerName'=>ucwords($this->input->post('playerName')),
                'city'=>ucwords($this->input->post('city')),
                'batting_style'=>ucwords($this->input->post('batting_style')),
                'bowling_style'=>ucwords($this->input->post('bowling_style')),
                'date_of_birth'=>ucwords($this->input->post('date_of_birth')),
                'player_role'=>ucwords($this->input->post('playerRole')),
                'additional_info'=>$this->input->post('additional_info'),
                'image_path'=>"",
                'user_id'=>$user_id,
                'created_on'=>date('Y-m-d')
                
                
                );


            $this->Player_model->save_image($record);

            // Set a success message and redirect
            $this->session->set_flashdata('success', 'Player is registered successfully!');
                $this->load->view('header');
            redirect('Welcome/landing_page');

        }
    

public function add_match_player()
{
    $player_id = $this->input->post('match_player');
    $match_id = $this->input->post('match_id');

    if (empty($player_id)) {
        $this->session->set_flashdata('error', 'Please select a player');
        redirect($this->agent->referrer());
    }

    // Check if player exists in either team for this match
   

    // Prepare data
    $record = array(
        'player_id' => $player_id,
        'match_id' => $match_id
    );

    // Add or update MOTM
    $result = $this->Player_model->add_match_player($record, $match_id);

    if ($result) {
        $this->session->set_flashdata('success', 'Player of the Match updated successfully');
    } else {
        $this->session->set_flashdata('error', 'Failed to update Player of the Match');
    }

    redirect($this->agent->referrer());
}

   public function profile_player()
{       
    $user_id = $this->session->userdata('user_id');
    $player_data['data'] = $this->Player_model->get_player(['user_id' => $user_id], 'add_player');
    $player_info = $this->Player_model->get_player(['user_id' => $user_id], 'add_player');
    
    if ($player_data['data'] == 0) {
        $this->load->view('header');
        echo '<h2>please register as a player first, go back please</h2>';
    } else {
        $player_id = $player_info['player_id'];
        $player_data['team_names'] = $this->Player_model->get_active_teams($player_id);
         $player_data['career_stats'] = $this->Player_model->calculate_career_stats($player_id);

     //    var_dump(  $player_data['career_stats']);
        $player_data['player_stats'] = $this->Player_model->calculate_player_stats($player_id);
        $player_data['bowling_stats'] = $this->Player_model->calculate_player_bowling_stats($player_id);
        $player_data['leagues'] = $this->Player_model->get_player_leagues($player_id);
      $player_data['recent_performance'] = $this->Player_model->get_recent_performance($player_id); 
     //   var_dump( $player_data['leagues'] );
        $this->load->view('header');
        $this->load->view('profile_player', $player_data);
    }
}

 public function player_info($player_id)
    {       
    //code for read bills table

                $user_id=$this->session->userdata('user_id');
                
              $player_data['data']=$this->Player_model->get_player(array('player_id'=>$player_id),'add_player');
             // var_dump($player_data);
 $player_data['career_stats'] = $this->Player_model->calculate_career_stats($player_id);
                 $player_data['team_names'] = $this->Player_model->get_active_teams($player_id);
                 $player_data['player_stats'] = $this->Player_model->calculate_player_stats($player_id);
                  $player_data['bowling_stats'] = $this->Player_model->calculate_player_bowling_stats($player_id);
                   $player_data['leagues'] = $this->Player_model->get_player_leagues($player_id); 
              /*if($player_data['data']==0)
              {
                 $this->load->view('header');
                echo 'please register as a player first, go back please';
              }
              else
              {*/  $player_data['recent_performance'] = $this->Player_model->get_recent_performance($player_id);  
            //  var_dump($data['recent_performance']);
                    $this->load->view('header');
                $this->load->view('profile_player',$player_data);
           // }
                
    }


    public function update_player()
    {
        $user_id=$this->session->userdata('user_id');
        
         $player_data['data']=$this->Player_model->get_player(array('user_id'=>$user_id),'add_player');
                    $this->load->view('header');
                $this->load->view('update_player',$player_data);
    }

    public function to_update_player()
    {
       $record=array('playerName'=>ucwords($this->input->post('playerName')),
                'city'=>ucwords($this->input->post('city')),
                'batting_style'=>ucwords($this->input->post('batting_style')),
                'bowling_style'=>ucwords($this->input->post('bowling_style')),
                'date_of_birth'=>ucwords($this->input->post('date_of_birth')),
                'player_role'=>ucwords($this->input->post('playerRole')),
                'additional_info'=>$this->input->post('additional_info')
                );  
       $user_id=$this->session->userdata('user_id');
         if ($this->Player_model->update_player($user_id, $record)) 
            {
            $player_data['data']=$this->Player_model->get_player(array('user_id'=>$user_id),'add_player');
                $this->load->view('header');
                $this->load->view('profile_player',$player_data);
            } 
        else 
            {
            echo "Failed to update record.";
            }
    }

    public function join_team($player_id) {
        $user_id = $this->session->userdata('user_id');
       // Assuming this fetches available teams
        $player_data['player_id'] = $player_id;
        $player_data['player_name'] = $this->Player_model->get_player(array('player_id' => $player_id)); // Fetch player name for footer
        $this->load->view('header');
        $this->load->view('join_team', $player_data);
    }

    public function search_team()
    {
        $search_query = $this->input->post('email', TRUE);
        $player_id = $this->input->post('player_id', TRUE);
     //   echo $player_id;
        // If a search query is provided, search teams, otherwise show all teams
        $data['player_id']=$player_id;
          $player_data['player_name'] = $this->Player_model->get_player(array('player_id' => $player_id));
        $data['teams'] = $this->Player_model->searchTeams($search_query);

         $this->load->view('header');
        $this->load->view('join_team', $data);
    }

  public function insert_team() {
        // Check if POST data exists
        $team_id = $this->input->post('team_id');
        $player_id = $this->input->post('player_id');
        
        // Log the data received for debugging
        log_message('debug', 'Received data: team_id = ' . $team_id . ', player_id = ' . $player_id);

        // Check if the data is valid
        if (!$team_id || !$player_id) {
            log_message('debug', 'Invalid input: team_name or player_id missing');
            echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
            return;
        }

        // Get user_id from session
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
           // log_message('debug', 'User ID not found in session.');
            echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
            return;
        }

        // Call the model to join the team
        $result = $this->Player_model->join_team($player_id, $team_id, $user_id);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Successfully joined the team.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error joining the team.']);
        }
    }

 

    public function sent_team_request($player_id) {
        $user_id = $this->session->userdata('user_id');
        $player_data['data'] = $this->Player_model->get_player_team(array('user_id' => $user_id, 'player_id' => $player_id));
        $player_data['player_name'] = $this->Player_model->get_player(array('player_id' => $player_id));
        $player_data['team_id'] = !empty($player_data['data']) ? $player_data['data'][0]->team_id : 0;
        $player_data['team_name'] = !empty($player_data['data']) ? $player_data['data'][0]->team_name : 'Team Profile';

        $this->load->view('header');
        $this->load->view('sent_team_request', $player_data);
    }


    public function cancel_request($player_id,$team_id)
    {
        
        
        // Call model method to delete player record
        $this->Player_model->delete_player_from_team(array('player_id'=>$player_id,'team_id'=>$team_id,'status'=> 0));
        
        
        $user_id=$this->session->userdata('user_id');
        $player_data['data']=$this->Player_model->get_player_team(array('user_id'=>$user_id, 'player_id'=>$player_id),'player_team');
         $player_data['player_name']=$this->Player_model->get_player(array('player_id'=>$player_id),'add_player');
             // var_dump($player_data);

         $this->load->view('header');
        $this->load->view('sent_team_request',$player_data);
 

    }
    

   
 public function update_player_picture($player_id) {
    // Verify the logged-in user owns the player profile
    $user_id = $this->session->userdata('user_id');
    $player = $this->Player_model->get_player(['player_id' => $player_id]);
    if (!$player || $player['user_id'] != $user_id) {
        $this->session->set_flashdata('error', 'Unauthorized access.');
        redirect('Welcome/landing_page');
    }

    // Check if a file is uploaded
    if (empty($_FILES['profile_image']['name'])) {
        $this->session->set_flashdata('error', 'Please select an image to upload.');
        redirect('Welcome/landing_page');
    }

    // Configure upload parameters
    $config = [
        'upload_path'   => './Uploads/',
        'allowed_types' => 'jpg|jpeg|png',
        'max_size'      => 5120, // 5MB in KB
        'file_name'     => 'profile_' . $player_id . '_' . time(),
        'overwrite'     => false
    ];

    $this->upload->initialize($config);

    // Attempt to upload the file
    if (!$this->upload->do_upload('profile_image')) {
        $this->session->set_flashdata('error', $this->upload->display_errors());
        redirect('Welcome/landing_page');
    }

    // Upload successful - process the image
    $upload_data = $this->upload->data();
    $uploaded_file = $upload_data['full_path'];

    try {
        // Load image library
        $this->load->library('image_lib');
        
        if (!extension_loaded('gd')) {
            throw new Exception('Image processing is not supported. Please enable the GD extension in PHP.');
        }

        // Process image for passport size (200x200 pixels)
        $this->_process_passport_image($uploaded_file);

        // Store the image path (relative path)
        $image_path = base_url('Uploads/' . $upload_data['file_name']);

        // Update database and handle old image
        $this->_update_player_image($player_id, $image_path);
        
        $this->session->set_flashdata('success', 'Profile picture updated successfully.');
    } catch (Exception $e) {
        // Clean up on error
        if (file_exists($uploaded_file)) {
            unlink($uploaded_file);
        }
        $this->session->set_flashdata('error', $e->getMessage());
    }

    redirect('Welcome/landing_page');
}

/**
 * Process image for passport size (200x200 pixels)
 */
private function _process_passport_image($file_path) {
    // First resize maintaining aspect ratio to fit within 200x200
    $resize_config = [
        'image_library'  => 'gd2',
        'source_image'   => $file_path,
        'maintain_ratio' => true,
        'width'         => 200,
        'height'        => 200,
        'quality'       => '90%',  // Higher quality for small images
        'new_image'     => $file_path
    ];

    $this->image_lib->initialize($resize_config);
    if (!$this->image_lib->resize()) {
        throw new Exception('Failed to resize image: ' . $this->image_lib->display_errors());
    }
    $this->image_lib->clear();

    // Then crop to exact 200x200 square (passport size)
    $image_info = getimagesize($file_path);
    $crop_config = [
        'image_library'  => 'gd2',
        'source_image'   => $file_path,
        'maintain_ratio' => false,
        'width'          => 200,
        'height'         => 200,
        'x_axis'         => max(0, ($image_info[0] - 200) / 2),
        'y_axis'         => max(0, ($image_info[1] - 200) / 2),
        'new_image'      => $file_path
    ];

    $this->image_lib->initialize($crop_config);
    if (!$this->image_lib->crop()) {
        throw new Exception('Failed to crop image: ' . $this->image_lib->display_errors());
    }
    $this->image_lib->clear();
}

/**
 * Update player image in database and handle old image
 */
private function _update_player_image($player_id, $new_image_path) {
    // Get old image path
    $old_image = $this->Player_model->get_player_image($player_id);
    
    // Update database
    if (!$this->Player_model->update_profile_picture($player_id, $new_image_path)) {
        throw new Exception('Failed to update profile picture in database.');
    }
    
    // Delete old image if update was successful
    if ($old_image) {
        $old_image_path = FCPATH . $old_image;
        if (file_exists($old_image_path)) {
            unlink($old_image_path);
        }
    }
}
    public function update_field($player_id, $field_name) {
        // Get the new value from the POST request
        $new_value = $this->input->post($field_name);

        // Update the specific field using the model
        $update_successful = $this->Player_model->update_player_field($player_id, $field_name, $new_value);

        // Redirect back to the player profile page with a message
        if ($update_successful) {
            $this->session->set_flashdata('message', ucfirst($field_name) . ' updated successfully.');
        } else {
            $this->session->set_flashdata('message', 'Error updating ' . $field_name);
        }

        // Redirect to the player profile edit page
        redirect('PlayerController/update_player/' . $player_id);
    }

   }




    

    