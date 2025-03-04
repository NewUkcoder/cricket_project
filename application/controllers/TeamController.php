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
        $this->load->library('session');

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
          $current_date = date('Y-m-d');
            $record=array('team_name'=>ucwords($this->input->post('team_name')),
                'city'=>ucwords($this->input->post('city')),
                'country'=>ucwords($this->input->post('country')),
                'home_ground'=>ucwords($this->input->post('home_ground')),
                'phone_number'=>ucwords($this->input->post('phone_number')),
                'coach'=>ucwords($this->input->post('coach')),
                'chairman'=>ucwords($this->input->post('chairman')),
                'description'=>ucwords($this->input->post('description')),
                'image_path'=>$image_data,
                'user_id'=>$user_id,
                'created_at' => date('Y-m-d', $current_date)
                
                
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
              $team_data['data']=$this->Team_model->get_team($team_id);
              $team_data['captain']=$this->Team_model->team_captain($team_id);

            //var_dump($team_data);
                $this->load->view('header');
                $this->load->view('team_profile',$team_data);
                
    }

    public function add_captain_leather($team_id)
    {   $team_data['team_id']=$team_id;
        $team_data['players']=$this->Team_model->get_squad($team_id);
        //var_dump($team_data);
         $this->load->view('header');
                $this->load->view('add_captain_leather', $team_data);
    }
    public function add_captain_tape($team_id)
    {   $team_data['team_id']=$team_id;
        $team_data['players']=$this->Team_model->get_squad($team_id);
        //var_dump($team_data);
         $this->load->view('header');
                $this->load->view('add_captain_tape', $team_data);
    }

    public function add_captain_tennis($team_id)
    {   $team_data['team_id']=$team_id;
        $team_data['players']=$this->Team_model->get_squad($team_id);
        //var_dump($team_data);
         $this->load->view('header');
                $this->load->view('add_captain_tennis', $team_data);
    }

      public function insert_captain()
    {   
        $team_id=$this->input->post('team_id');
        $player_id=$this->input->post('player_id');
        $ball_type=$this->input->post('ball_type');
        $user_id=$this->session->userdata('user_id');
      
          $record=array(
                'ball_type'=>$ball_type,
                'player_id'=>$player_id,
                'team_id'=>$team_id,
                'user_id'=>$user_id,
                'created_on' => date('Y-m-d')
                );
        
      $team_data['players']=$this->Team_model->insert_captain($record);
        //var_dump($team_data);
       $team_data['team_stats']=$this->Team_model->get_team_stats($team_id);
              $team_data['data']=$this->Team_model->get_team($team_id);
              $team_data['captain']=$this->Team_model->team_captain($team_id);

            //var_dump($team_data);
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

    public function invite_team($team_id)
    {
        $data['team_id']=$team_id;
        $this->load->view('header');
        $this->load->view('invite_team',$data);
    }

    public function find_team()
    {
        $search_query = $this->input->post('email', TRUE);

        $team_id = $this->input->post('team_id', TRUE);
     //   echo $player_id;
        // If a search query is provided, search teams, otherwise show all teams
        $data['team_id']=$team_id;
        $data['teams'] = $this->Team_model->invite_team($search_query);

        // Load the view and pass the teams data
        $this->load->view('invite_team', $data);
    }

  public function insert_match($team_two_id,$team_id) {
    // Retrieve the values from the POST data
  

   
    $result = $this->Team_model->join_match( $team_two_id,$team_id);
      $team_data['team_stats']=$this->Team_model->get_team_stats($team_id);
              $team_data['data']=$this->Team_model->get_team($team_id);
             // var_dump($team_data);
                $this->load->view('header');
                $this->load->view('team_profile',$team_data);
    
        
}

public function match_request($team_id)
    {
        $team_data['team_id']=$team_id;
        $team_data['team_names'] = $this->Team_model->get_match_teams($team_id);
      $this->load->view('header');
     // var_dump($team_data);
    $this->load->view('match_request',$team_data);

}

public function team_request($team_id)
    {
           $team_data['main_team']=$team_id;
        $team_data['team_names'] = $this->Team_model->team_request($team_id);
      $this->load->view('header');
    $this->load->view('team_request',$team_data);

}

public function accept_match_request($team_one_id,$team_two_id)
{
 $team_data['main_team']=$team_one_id;
 $this->Team_model->accept_match_request($team_one_id,$team_two_id);

        $team_data['team_names'] = $this->Team_model->team_request($team_one_id);
      $this->load->view('header');
    $this->load->view('team_request',$team_data);

}
public function reject_match_request($main_id,$team_one_id)
{
 $team_data['team_id']=$main_id;
 $this->Team_model->reject_match_request(array('team_one_id'=>$main_id,'team_two_id'=>$team_one_id,'status'=> 0));

        $team_data['team_names'] = $this->Team_model->get_match_teams($main_id);

      $this->load->view('header');
    $this->load->view('team_request',$team_data);

}

public function team_schedule($team_id)
{
      $team_data['team_schedule'] = $this->Team_model->get_team_schedule($team_id);
     $this->load->view('header');
    $this->load->view('team_schedule' ,$team_data);
}
}
    