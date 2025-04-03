
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TournamentController extends CI_Controller {

       /**
        * Index Page for this controller.
        *
        * Maps to the following URL
        *            http://example.com/index.php/welcome
        *     - or -
        *            http://example.com/index.php/welcome/index
        *     - or -
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
         if($this->session->userdata('logged')!=true)
    {
    
        redirect('Welcome/index');
    }
        
        
    }

    public function add_league()
    {  
       $user_id=$this->session->userdata('user_id');
        $current_date = date('Y-m-d');
            $record=array('league_name'=>ucwords($this->input->post('league_name')),
                'city'=>ucwords($this->input->post('city')),
                'country'=>ucwords($this->input->post('country')),
                'venue'=>ucwords($this->input->post('venue')),
                 'overs'=>$this->input->post('overs'),
                'phone_number'=>ucwords($this->input->post('phone_number')),
                'season'=>ucwords($this->input->post('season')),
                'match_type'=>ucwords($this->input->post('match_type')),
                'user_id'=>$user_id,
                'created_at' => date('d-m-Y')
                
                
                );
              $this->Tournament_model->add_league($record);
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

    public function accept_request($team_id,$league_id)
    {
        $data= $this->Tournament_model->accept_request($team_id,$league_id);

    redirect($this->agent->referrer()); // Redirects to the previous page
        

    }


     public function reject_team_request($team_id,$league_id)
    {

      
 $this->Tournament_model->reject_team_request(array('team_id'=>$team_id,'league_id'=>$league_id,'status'=> 0));
 redirect($this->agent->referrer()); // Redirects to the previous page
       
    }

  public function add_rules()
    {
 $user_id=$this->session->userdata('user_id');
  $record=array('league_rule'=>ucwords($this->input->post('league_rule')),
                'league_id'=>$this->input->post('league_id'),
                'user_id'=>$user_id
         );
      
 $this->Tournament_model->league_rules($record);
 redirect($this->agent->referrer()); // Redirects to the previous page

   
}

public function update_rules()
{
       $rule_id=$this->input->post('rule_id');
 $record=array('league_rule'=>ucwords($this->input->post('league_rule')),
                'league_id'=>$this->input->post('league_id'));
 $this->Tournament_model->update_rules($rule_id,$record);
 redirect($this->agent->referrer()); // Redirects to the previous page

} 
public function league_top_ten_scorer($league_id)

{       $team_data['league']=$this->Tournament_model->league_information($league_id);
       $team_data['top_ten_scorer']=$this->Tournament_model->get_top_10_batsmen($league_id);
         $this->load->view('header');
       $this->load->view('league_top_ten_scorer',$team_data);
}

public function league_top_ten_bowler($league_id)
{
          $team_data['league']=$this->Tournament_model->league_information($league_id);
       $team_data['top_ten_player']=$this->Tournament_model->league_top_ten_bowler($league_id);
         $this->load->view('header');
       $this->load->view('league_top_ten_bowler',$team_data);
}

public function league_ten_individual_scorer($league_id)
{
          $team_data['league']=$this->Tournament_model->league_information($league_id);
       $team_data['top_ten_player']=$this->Tournament_model->league_ten_individual_scorer($league_id);
         $this->load->view('header');
       $this->load->view('league_ten_individual_scorer',$team_data);
}

public function league_top_ten_bowler_of_match($league_id)
{

          $team_data['league']=$this->Tournament_model->league_information($league_id);
       $team_data['top_ten_player']=$this->Tournament_model->league_top_ten_bowler_of_match($league_id);
         $this->load->view('header');
       $this->load->view('league_top_ten_bowler_of_match',$team_data);

}



public function get_highest_team_score($league_id)
{

          $team_data['league']=$this->Tournament_model->league_information($league_id);
       $team_data['top_ten_player']=$this->Tournament_model->get_highest_team_score($league_id);
         $this->load->view('header');
       $this->load->view('get_highest_team_score',$team_data);

}

public function league_top_five_team_score($league_id)
{

          $team_data['league']=$this->Tournament_model->league_information($league_id);
       $team_data['top_five_teams']=$this->Tournament_model->league_top_five_team_score($league_id);
         $this->load->view('header');
       $this->load->view('league_top_five_team_score',$team_data);

}

public function league_lowest_five_score($league_id)
{

          $team_data['league']=$this->Tournament_model->league_information($league_id);
       $team_data['top_five_teams']=$this->Tournament_model->league_lowest_five_score($league_id);
         $this->load->view('header');
       $this->load->view('league_lowest_five_score',$team_data);

}

public function join_tournament($team_id)
{
        $team_data['team_id']=$team_id;
        $this->load->view('header');
       $this->load->view('join_tournament',$team_data);

}

public function find_tournament()
    {
        $search_query = $this->input->post('email', TRUE);

        $team_id = $this->input->post('team_id', TRUE);
     //   echo $player_id;
        // If a search query is provided, search teams, otherwise show all teams
        $data['team_id']=$team_id;
        $data['tournament'] = $this->Tournament_model->invite_tournament($search_query);

        // Load the view and pass the teams data
        $this->load->view('join_tournament', $data);
    }


      public function tournament_team($league_id,$team_id) {
   
    $result = $this->Tournament_model->join_tournament( $league_id,$team_id);
      $team_data['team_stats']=$this->Team_model->get_team_stats($team_id);
              $team_data['data']=$this->Team_model->get_team($team_id);
             // var_dump($team_data);
                $this->load->view('header');
                $this->load->view('team_profile',$team_data);
    
        
}


}