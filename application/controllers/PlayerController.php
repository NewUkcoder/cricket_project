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
        $config['upload_path'] = './uploads/'; // Specify the directory to store images
        $config['allowed_types'] = 'gif|jpg|png|jpeg'; // Allowed file types
        $config['max_size'] = 1000000; // Max size in KB
        $config['file_name'] = time(); // Use the current timestamp for file name to avoid name collision

        // Initialize the upload library with the configuration
        $this->upload->initialize($config);

        // Check if the form was submitted and a file is selected
        if (empty($_FILES['userfile']['name'])) {
            $this->session->set_flashdata('error', 'Please select a file to upload.');
                $this->load->view('header');
            redirect('Welcome/enter_player');
        }

        // Check if file was uploaded successfully
        if (!$this->upload->do_upload('userfile')) {
            // If upload fails, show errors
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
                $this->load->view('header');
            redirect('Welcome/enter_player');
        } else {
            // If upload is successful, get file data
            $file_data = $this->upload->data();
            // Save file info to the database
            $image_data = base_url('uploads/' . $file_data['file_name']);

            $user_id=$this->session->userdata('user_id');
            
            $record=array('playerName'=>ucwords($this->input->post('playerName')),
                'city'=>ucwords($this->input->post('city')),
                'batting_style'=>ucwords($this->input->post('batting_style')),
                'bowling_style'=>ucwords($this->input->post('bowling_style')),
                'date_of_birth'=>ucwords($this->input->post('date_of_birth')),
                'player_role'=>ucwords($this->input->post('playerRole')),
                'additional_info'=>$this->input->post('additional_info'),
                'image_path'=>$image_data,
                'user_id'=>$user_id
                
                
                );


            $this->Player_model->save_image($record);

            // Set a success message and redirect
            $this->session->set_flashdata('success', 'Image uploaded successfully!');
                $this->load->view('header');
            redirect('Welcome/landing_page');

        }
    }

    public function add_match_player()
    {
        $player_id= $this->input->post('match_player');
        $match_id= $this->input->post('match_id');

        $record=array('player_id'=> $player_id,'match_id'=>$match_id);
         $this->Player_model->add_match_player($record);
          echo "<script type='text/javascript'>
            alert('Player of the Match is selected.');
           
          </script>";
          redirect($this->agent->referrer());




    }

    public function profile_player()
    {       
    //code for read bills table

                $user_id=$this->session->userdata('user_id');
               
               
                
              $player_data['data']=$this->Player_model->get_player(array('user_id'=>$user_id),'add_player');
             // var_dump($player_data);
              $player_info=$this->Player_model->get_player(array('user_id'=>$user_id),'add_player');
           
                
                 if($player_data['data']==0)
              {

                 $this->load->view('header');
                echo '<h2>please register as a player first, go back please</h2>';
              } else {
                 $player_id=$player_info['player_id'];
                
                 $player_data['team_names'] = $this->Player_model->get_active_teams($player_id);
                 $player_data['player_stats'] = $this->Player_model->calculate_player_stats($player_id);
                  $player_data['bowling_stats'] = $this->Player_model->calculate_player_bowling_stats($player_id);
               //   var_dump($player_data['bowling_stats']);
                 // var_dump($player_data);
             
                    $this->load->view('header');
                $this->load->view('profile_player',$player_data);
            }
                
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

    public function join_team($player_id)
    {
        $data['player_id']=$player_id;
        $this->load->view('header');
        $this->load->view('join_team',$data);
    }

    public function search_team()
    {
        $search_query = $this->input->post('email', TRUE);
        $player_id = $this->input->post('player_id', TRUE);
     //   echo $player_id;
        // If a search query is provided, search teams, otherwise show all teams
        $data['player_id']=$player_id;
        $data['teams'] = $this->Player_model->searchTeams($search_query);

        // Load the view and pass the teams data
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

    public function sent_team_request($player_id)
    {   
        $user_id=$this->session->userdata('user_id');
        $player_data['data']=$this->Player_model->get_player_team(array('user_id'=>$user_id, 'player_id'=>$player_id),'player_team');
         $player_data['player_name']=$this->Player_model->get_player(array('player_id'=>$player_id),'add_player');
             // var_dump($player_data);

         $this->load->view('header');
        $this->load->view('sent_team_request',$player_data);
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
    public function player_info($player_id)
    {       
    //code for read bills table

                $user_id=$this->session->userdata('user_id');
                
              $player_data['data']=$this->Player_model->get_player(array('player_id'=>$player_id),'add_player');
             // var_dump($player_data);

                 $player_data['team_names'] = $this->Player_model->get_active_teams($player_id);
                 $player_data['player_stats'] = $this->Player_model->calculate_player_stats($player_id);
                  $player_data['bowling_stats'] = $this->Player_model->calculate_player_bowling_stats($player_id);
              /*if($player_data['data']==0)
              {
                 $this->load->view('header');
                echo 'please register as a player first, go back please';
              }
              else
              {*/
                    $this->load->view('header');
                $this->load->view('profile_player',$player_data);
           // }
                
    }

   

    public function update_profile_picture($player_id) {
        // Load necessary helpers and models
        $this->load->helper(array('form', 'url'));
        $this->load->model('Player_Model');
        
        // Check if a file is uploaded
        if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
            // Configure upload settings
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048;  // 2MB max size
            $config['file_name'] = 'profile_' . $player_id . '_' . time();  // Unique file name to avoid conflicts
            
            // Load upload library with the above config
            $this->load->library('upload', $config);
            
            // Perform the file upload
            if (!$this->upload->do_upload('profile_pic')) {
                // If upload fails, set error message
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect('PlayerController/update_player/' . $player_id);
            } else {
                // Get the uploaded file data
                $upload_data = $this->upload->data();
                
                // Prepare image path for saving to the database
                $image_path = 'uploads/' . $upload_data['file_name'];
                
                // Call the model function to update the image path in the database
                $update_result = $this->Player_Model->update_profile_picture($player_id, $image_path);
                
                // Check if the update was successful
                if ($update_result) {
                    $this->session->set_flashdata('success', 'Profile picture updated successfully!');
                } else {
                    $this->session->set_flashdata('error', 'Error updating profile picture!');
                }
                
                // Redirect to the profile edit page
                redirect('PlayerController/update_player/' . $player_id);
            }
        } else {
            // No file uploaded or there was an error
            $this->session->set_flashdata('error', 'No valid file uploaded or upload error occurred!');
            redirect('PlayerController/update_player/' . $player_id);
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




    

    