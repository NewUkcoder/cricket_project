<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	 public function __construct() {
        parent::__construct();
        $this->load->model('Team_model');
        $this->load->model('Scorecard_model');
          $this->load->model('Tournament_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->library('session');

          $this->load->library('user_agent');


        
        $this->load->database();
        
    }
	public function index()
	{
		$this->load->view('sign_in');
	}
	public function sign_up()
	{
		$this->load->view('sign_up');
	}
	public function welcome_message()
	{	
		
		if($this->session->userdata('logged'))
		{
			$this->load->view('header');
		$this->load->view('welcome_message');
		}
		else
		{
			$this->index();
		}
		
		 
	}
	public function enter_player()
	{	
		if($this->session->userdata('logged'))
		{
			$this->load->view('header');
		$this->load->view('enter_player');
		}
		else
		{
			$this->index();
		}
			
	}
	/*public function profile_player()
	{
		$this->load->view('profile_player');
	}*/
	public function enter_team()
	{
		if($this->session->userdata('logged'))
		{
			$this->load->view('header');
		$this->load->view('enter_team');
		}
		else
		{
			$this->index();
		}
		
	}

	/*public function team_profile()
	{
		$this->load->view('team_profile');
	}*/
	public function scorecard($team_one, $team_two,$match_id)
	{
		if($this->session->userdata('logged'))
		{
			$user_id = $this->session->userdata('user_id');
$toss = $this->Scorecard_model->get_toss(array('user_id' => $user_id, 'match_id' => $match_id));

// Check if toss is not equal to 0
if ($toss != 0) {
    // Execute the code if toss is not equal to 0
  
    $data['match_result'] = $this->Scorecard_model->calculate_match_result($match_id);
    $data['information'] = $this->Scorecard_model->get_scorecard($match_id);
    $data['batting_first_score'] = $this->Scorecard_model->show_total_score(1, $match_id);
    $data['batting_second_score'] = $this->Scorecard_model->show_total_score(2, $match_id);
    $data['first_inning'] = $this->Scorecard_model->get_batting_first_details($match_id);
    $data['first_bowling_inning'] = $this->Scorecard_model->get_bowling_first_details($match_id);
    $data['second_inning'] = $this->Scorecard_model->get_batting_second_details($match_id);
    $data['second_bowling_inning'] = $this->Scorecard_model->get_bowling_second_details($match_id);

    // Load views
    $this->load->view('header');
    $this->load->view('scorecard', $data);
} else {
    // Show message if toss is equal to 0
   redirect($this->agent->referrer());
}

	//var_dump($data);
		}
		else
		{
			$this->index();
		}
		
	}
	public function schedule()
	{	
		if($this->session->userdata('logged'))
		{
			$this->load->view('header');
		$this->load->view('schedule');
		}
		else
		{
			$this->index();
		}
		
	}

	public function landing_page()
	{		
		if($this->session->userdata('logged'))
		{
			$user_id=$this->session->userdata('user_id');
                
                 $team_data['team']=$this->Team_model->team_information(array('user_id'=>$user_id),'add_team');
                 if($team_data['team']==0)
              {
                $team_data['team']=0;
              }
               else
              {
                 $team_data['team']=$this->Team_model->team_information(array('user_id'=>$user_id),'add_team');
            }

              $team_data['data']=$this->Player_model->get_player(array('user_id'=>$user_id),'add_player');
             // var_dump($player_data);
              if($team_data['data']==0)
              {
                $team_data['data']=0;
              }
              else
              {
                $team_data['data']=$this->Player_model->get_player(array('user_id'=>$user_id),'add_player');
           	 }
           	  $team_data['tournament']=$this->Tournament_model->get_league($user_id);
             // var_dump($player_data);
              if($team_data['tournament']==0)
              {
                $team_data['tournament']=0;
              }
              else
              {
                $team_data['tournament']=$this->Tournament_model->get_league($user_id);
           	 }

           	 
           	$this->load->view('header');
			$this->load->view('landing_page',$team_data);
		}
		else
		{
			$this->index();
		}
 			
	}

	public function match_summary()
	{	
		if($this->session->userdata('logged'))
		{
			$this->load->view('header');
		$this->load->view('match_summary');
		}
		else
		{
			$this->index();
		}
		
	}

	public function enter_schedule($team_one_id, $team_two_id)
	{	
		// var_dump($team_one_id, $team_two_id);
		if($this->session->userdata('logged'))
		{
			
                
                 $team_data=$this->Team_model->add_fixture($team_one_id,$team_two_id);
                $this->load->view('header');
							$this->load->view('enter_schedule',$team_data);

		
	}
}

public function scorecard_links($team1,$team2,$match_id)
{
	$user_id=$this->session->userdata('user_id');
	//var_dump($match_id);

	 	$data['toss1']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
	 		
	 		if($data['toss1']==0)
         {
         $data['toss_information']="";
         }
         else {
         	$data['toss_information']=$this->Scorecard_model->toss_info_row($match_id);
         	 
	 		
	 	}
	 		 $data['two_team']=$this->Team_model->two_team($team1,$team2);
	 		  $data['two_team_player']=$this->Team_model->two_team_player($team1,$team2);
	 		  $data['player_of_match']=$this->Player_model->player_of_match($match_id);
	 			 $data['match_id']=$match_id;
	 //		 var_dump($data);
 $this->load->view('header');
	$this->load->view('scorecard_links',$data);


}
	public function toss($team1,$team2,$match_id)
	{
		$team_one= $team1;
		$team_two=$team2;
		$user_id=$this->session->userdata('user_id');
		$data['toss1']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
		if($data['toss1']==0)
         {

		 $teams = $this->Scorecard_model->team_toss($team_one, $team_two);

        if ($teams['team_1'] && $teams['team_2']) {
            // Pass the team data to the view
            $data['team_one'] = $teams['team_1'];
            $data['team_two'] = $teams['team_2'];
            $data['match_id'] = $match_id;

            // Load the view
           
            $this->load->view('header');
					$this->load->view('toss', $data);
        } else {
        	 $this->load->view('header');
            echo "No teams found!";
        }
      }
      else {
      	
      	   $user_id=$this->session->userdata('user_id');
	//var_dump($match_id);

	 	$data['toss1']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
	 		
	 		if($data['toss1']==0)
         {
         $data['toss_information']="";
         }
         else {
         	$data['toss_information']=$this->Scorecard_model->toss_info_row($match_id);
         	 
	 		
	 	}
	 		 $data['two_team']=$this->Team_model->two_team($team1,$team2);
	 		  $data['two_team_player']=$this->Team_model->two_team_player($team1,$team2);
	 		    $data['player_of_match']=$this->Player_model->player_of_match($match_id);
	 			 $data['match_id']=$match_id;
	 		// var_dump($data);
 $this->load->view('header');
	$this->load->view('scorecard_links',$data);
           


      }
		

	}

	public function enter_scorecard()
	{	
		if($this->session->userdata('logged'))
		{ 
			$user_id=$this->session->userdata('user_id');
                
                 $team_data['team']=$this->Team_model->team_information(array('user_id'=>$user_id),'add_team');
                 if($team_data['team']==0)
              {
                $team_data['team']=0;
              }
               else
              {
                 $team_data['team']=$this->Team_model->team_information(array('user_id'=>$user_id),'add_team');
            }

              $team_data['players']=$this->Player_model->get_player(array('user_id'=>$user_id),'add_player');
             // var_dump($player_data);
              if($team_data['players']==0)
              {
                $team_data['players']=0;
              }
              else
              {
                $team_data['players']=$this->Player_model->get_player(array('user_id'=>$user_id),'add_player');
           	 }
           	// var_dump($team_data);
			$this->load->view('header');
		$this->load->view('enter_scorecard', $team_data);
		}
		else
		{
			$this->index();
		}
		
	}
		public function add_tournament()
	{
			$this->load->view('header');
		$this->load->view('add_tournament');
	}

	public function tournament_landing($league_id)
	{
		 $team_data['league']=$this->Tournament_model->league_information($league_id);
		   $team_data['league_teams']=$this->Tournament_model->get_league_teams($league_id);
                    $team_data['league_schedule']=$this->Tournament_model->get_league_schedule($league_id);
                     $team_data['league_rules']=$this->Tournament_model->get_league_rules($league_id);
			$this->load->view('header');
		$this->load->view('tournament_landing',$team_data);
	}

	public function tournament_main($league_id)
	{
		 $user_id=$this->session->userdata('user_id');
                
                 $team_data['league']=$this->Tournament_model->league_information($league_id);
                  $team_data['team_request']=$this->Tournament_model->tournament_teams($league_id);
                   $team_data['league_teams']=$this->Tournament_model->get_league_teams($league_id);
                    $team_data['league_schedule']=$this->Tournament_model->get_league_schedule($league_id);
                     $team_data['league_rules']=$this->Tournament_model->get_league_rules($league_id);

                
              $this->load->view('header');
               $this->load->view('tournament_main',$team_data);
	}

	
}
