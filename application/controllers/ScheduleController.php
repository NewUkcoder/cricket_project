<?php

// Controller: PlayerController.php

defined('BASEPATH') OR exit('No direct script access allowed');

class ScheduleController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Schedule_model');
        $this->load->model('Team_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('upload');
        
        $this->load->database();
            if($this->session->userdata('logged')!=true)
    {
    
        redirect('Welcome/index');
    }
        
    }

    public function add_schedule()
    {
            $team1=$this->input->post('team1');
            $team2=$this->input->post('team2');
            $match_time=ucwords($this->input->post('match_time'));
            $match_date=ucwords($this->input->post('match_date'));
            
             if ($team1==''|| $team2=='' || $team1==$team2) 
             {
            
            $this->session->set_flashdata('error', 'Please Select Your team Correctly.');
                $this->load->view('header');
            redirect('Welcome/enter_schedule');
            }
        else {

            $record=array('team_one_id'=>$team1,
                'team_two_id'=>$team2,
                'user_id'=>$this->session->userdata('user_id'),
                'match_time'=>$match_time,
                'match_date'=>$match_date,
                'match_type'=>ucwords($this->input->post('match_type')),
                'overs'=>ucwords($this->input->post('overs')),
                'league_id'=>$this->input->post('league_id'),
                'location'=>ucwords($this->input->post('location')),
                'series'=>ucwords($this->input->post('series')),
                'umpire1'=>ucwords($this->input->post('umpire1')),
                'umpire2'=>ucwords($this->input->post('umpire2'))
                );
        
        $this->Schedule_model->save_schedule($record,$team1,$team2,$match_date,$match_time);
        $this->session->set_flashdata('success', 'Match is added into Sechedule List.<p> Add another Match</p>');
           $team_data['team_schedule'] = $this->Team_model->get_team_schedule($team1);
        $this->load->view('header');
       
          $this->load->view('team_schedule', $team_data);
                }

    }    

    public function schedule()
    {       
    
                $user_id=$this->session->userdata('user_id');
              $schedule_data['data']=$this->Schedule_model->get_schedule($user_id); 
              
               if($schedule_data['data']==0)
              {
                $schedule_data['data']=0;
              }
               else
              {
                 $schedule_data['data']=$this->Schedule_model->get_schedule($user_id);
                 
              }
             $this->load->view('header');
                $this->load->view('schedule',$schedule_data);
              
                
    }
}
    