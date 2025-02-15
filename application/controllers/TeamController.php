<?php

// Controller: PlayerController.php

defined('BASEPATH') OR exit('No direct script access allowed');

class TeamController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Team_model');
         $this->load->model('Scorecard_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('upload');
        
        $this->load->database();
            if($this->session->userdata('logged')!=true)
    {
    
        redirect('Welcome/index');
    }
        
    }

    public function add_team()
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
            redirect('Welcome/enter_team');
        }

        // Check if file was uploaded successfully
        if (!$this->upload->do_upload('userfile')) {
            // If upload fails, show errors
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('Welcome/enter_team');
        } else {
            // If upload is successful, get file data
            $file_data = $this->upload->data();
            // Save file info to the database
            $image_data = base_url('uploads/' . $file_data['file_name']);

            $user_id=$this->session->userdata('user_id');
            var_dump($user_id);
            $record=array('team_name'=>ucwords($this->input->post('team_name')),
                'city'=>ucwords($this->input->post('city')),
                'country'=>ucwords($this->input->post('country')),
                'coach'=>ucwords($this->input->post('coach')),
                'chairman'=>ucwords($this->input->post('chairman')),
                'description'=>ucwords($this->input->post('description')),
                'image_path'=>$image_data,
                'user_id'=>$user_id
                
                
                );


            $this->Team_model->save_image($record);

            // Set a success message and redirect
            $this->session->set_flashdata('success', 'Image uploaded successfully!');
                $this->load->view('header');
            redirect('Welcome/welcome_message');

        }
    }

    public function team_profile($team_id)
    {       
  
                $team_data['team_stats']=$this->Team_model->get_team_stats($team_id);
              $team_data['data']=$this->Team_model->get_team(array('team_id'=>$team_id),'add_team');
                $this->load->view('header');
                $this->load->view('team_profile',$team_data);
                
    }

    public function show_team()
    {
        $user_id=$this->session->userdata('user_id');
         $team_data['data']=$this->Team_model->get_team(array('user_id'=>$user_id),'add_team');
            $this->load->view('header');
        $this->load->view('landing_page',$team_data);
                
    }

    public function my_teams()
    {
        $user_id=$this->session->userdata('user_id');
         $team_data['data']=$this->Team_model->get_team(array('user_id'=>$user_id),'add_team');
          if($team_data['data']==0)
              {
                $team_data['data']=0;
              }
               else
              {
                 $team_data['data']=$this->Team_model->get_team(array('user_id'=>$user_id),'add_team');
            }
            
            $this->load->view('header');
        $this->load->view('my_teams',$team_data);
    }

    public function player_request($team_id)
    {
        $user_id=$this->session->userdata('user_id');
        $player_data['request']=$this->Team_model->get_player_request($team_id);
        

         $this->load->view('header');
        $this->load->view('player_request', $player_data);
    }
     public function accept_request($player_id,$team_id)

    {   
        $this->Team_model->accept_request($player_id,$team_id);
        
        $player_data['request']=$this->Team_model->get_player_request($team_id);
        

         $this->load->view('header');
        $this->load->view('player_request', $player_data);
    }

     public function team_squad($team_id)
    {
        $user_id=$this->session->userdata('user_id');
        $player_data['squad']=$this->Team_model->get_squad($team_id);
         $this->load->view('header');
        $this->load->view('team_squad',$player_data);
    }
     public function cancel_player_request($player_id,$team_id)
    {
        
        
        // Call model method to delete player record
        $this->Player_model->delete_player_from_team(array('player_id'=>$player_id,'team_id'=>$team_id,'status'=> 0));
        
        
        $user_id=$this->session->userdata('user_id');
        $player_data['data']=$this->Player_model->get_player_team(array('user_id'=>$user_id, 'player_id'=>$player_id),'player_team');
      
 $player_data['request']=$this->Team_model->get_player_request($team_id);
        

         $this->load->view('header');
        $this->load->view('player_request', $player_data);
 

    }

   
}
    