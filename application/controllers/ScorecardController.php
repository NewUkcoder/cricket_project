<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class ScorecardController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Scorecard_model');
        $this->load->model('Team_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('upload');
          $this->load->library('user_agent');
        
        $this->load->database();
            if($this->session->userdata('logged')!=true)
    {
    
        redirect('Welcome/index');
    }
        
    }

     public function add_toss()
  {
    $team1=$this->input->post('team_one');
            $team2=$this->input->post('team_two');
            $user_id=$this->session->userdata('user_id');
            $match_id=$this->input->post('match_id');
            $toss_winner=$this->input->post('toss_winner');
            $decision=$this->input->post('decision');
            if($decision=="bat" && $toss_winner==$team1)
            {
                $bat_first=$team1;
                $bowl_first=$team2;
            }
            elseif($decision=="bowl" && $toss_winner==$team1)
            {
                $bat_first=$team2;
                $bowl_first=$team1;
            }
            elseif($decision=="bat" && $toss_winner==$team2)
            {
                $bat_first=$team2;
                $bowl_first=$team1;
            }
            elseif($decision=="bowl" && $toss_winner==$team2)
            {
                $bat_first=$team1;
                $bowl_first=$team2;
            }

            

         $data['toss1']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
         if($data['toss1']==0)
         {
            $record=array('team_one_id'=>$team1,
                'team_two_id'=>$team2,
                 'match_id'=>$match_id,
                'toss_winner'=>$toss_winner,
                'decision'=>$decision,
                'user_id'=>$user_id,
                'bat_first'=>$bat_first,
                'bowl_first'=>$bowl_first
                );


        $this->Scorecard_model->insert_toss($record);

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
           //  var_dump($data);
 $this->load->view('header');
    $this->load->view('scorecard_links',$data);
  }

}



    public function add_first_batting($team1,$team2,$match_id)
    {
           

            

                $user_id=$this->session->userdata('user_id');

                $data=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                
                $data['match_id']=$match_id;
                $team1=$data['team_one_id'];
                $team2=$data['team_two_id'];
                $win_team=$data['toss_winner'];
                $batting_first=$data['bat_first'];
                 $data['toss_id']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
            $data['team_one']=$this->Team_model->team_information(array('team_id'=>$team1),'add_team');
            $data['team_two']=$this->Team_model->team_information(array('team_id'=>$team2),'add_team');
            $data['toss_winner']=$this->Team_model->team_information(array('team_id'=>$win_team),'add_team');
            $data['bat_first']=$this->Scorecard_model->get_score(array('batting_team'=>$batting_first,'match_id'=>$match_id),'batting_first');
             $data['all_score']=$this->Scorecard_model->get_total_score(array('batting_order'=>1,'match_id'=>$match_id),'batting_first');
             $data['player_info']=$this->Scorecard_model->player_info($match_id);
              $data['bowler_info']=$this->Scorecard_model->player_info_second($match_id);
            $data['get_extra1']=$this->Scorecard_model->total_extra(array('batting_order'=>1,'match_id'=>$match_id),'extras');

             $data['decision']=$data['decision'];
          // var_dump($data);
                $this->load->view('header');
            $this->load->view('add_first_batting', $data);
             
            
        
    }

    public function insert_batting()
    {
         $user_id=$this->session->userdata('user_id');
            $match_id=$this->input->post('match_id');
            $batting_team=$this->input->post('batting_team');
            $bowl_first=$this->input->post('bowling_team');
            $player_id=$this->input->post('player_id');
            $batting_order=$this->input->post('batting_order');
             $dismissal=$this->input->post('dismissal');
              $bowler_id=$this->input->post('bowler_id');
 if ($dismissal === 'Not Out' || $dismissal === 'Run Out') {
    $bowler_id = "";
  }

        $record=array('batting_team'=>$batting_team,
                'bowling_team'=>$bowl_first,
                 'match_id'=>$this->input->post('match_id'),
                'player_id'=>$this->input->post('player_id'),
                'runs'=>$this->input->post('runs'),
                'balls'=>$this->input->post('balls'),
                'fours'=>$this->input->post('fours'),
                'sixes'=>$this->input->post('sixes'),
                'batting_order'=>$batting_order,
                'dismissal'=>$dismissal,
                'bowler_player_id'=>$bowler_id,
                'user_id'=>$this->session->userdata('user_id')
                );
       // var_dump($record);
       
        $this->Scorecard_model->insert_batting_first($record);
               if($batting_order==1)
            {
 $data=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                

                
                $team1=$data['team_one_id'];
                $team2=$data['team_two_id'];
                $win_team=$data['toss_winner'];
                $batting_first=$data['bat_first'];
               
                  $data['toss_id']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                
            $data['team_one']=$this->Team_model->team_information(array('team_id'=>$team1),'add_team');
            $data['team_two']=$this->Team_model->team_information(array('team_id'=>$team2),'add_team');
            $data['toss_winner']=$this->Team_model->team_information(array('team_id'=>$win_team),'add_team');
            $data['bat_first']=$this->Scorecard_model->get_score(array('batting_team'=>$batting_first,'match_id'=>$match_id),'batting_first');
           $data['all_score']=$this->Scorecard_model->get_total_score(array('batting_order'=>1,'match_id'=>$match_id),'batting_first');
            $data['player_info']=$this->Scorecard_model->player_info($match_id);
             $data['bowler_info']=$this->Scorecard_model->player_info_second($match_id);
            $data['get_extra1']=$this->Scorecard_model->total_extra(array('batting_order'=>1,'match_id'=>$match_id),'extras');
             $data['decision']=$data['decision'];
         // var_dump($data);
                $this->load->view('header');
            $this->load->view('add_first_batting', $data);
        }
        if($batting_order==2)
        {
           $data=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                

                
                $team1=$data['team_one_id'];
                $team2=$data['team_two_id'];
                $win_team=$data['toss_winner'];
                $batting_second=$data['bowl_first'];
              
                  $data['toss_id']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                
            $data['team_one']=$this->Team_model->team_information(array('team_id'=>$team1),'add_team');
            $data['team_two']=$this->Team_model->team_information(array('team_id'=>$team2),'add_team');
            $data['toss_winner']=$this->Team_model->team_information(array('team_id'=>$win_team),'add_team');
            $data['bat_second']=$this->Scorecard_model->get_score(array('batting_team'=>$batting_second,'match_id'=>$match_id),'batting_first');
            $data['all_score']=$this->Scorecard_model->get_total_score(array('batting_order'=>2,'match_id'=>$match_id),'batting_first');
            $data['player_info']=$this->Scorecard_model->player_info_second($match_id);
             $data['bowler_info']=$this->Scorecard_model->player_info($match_id);
            $data['get_extra1']=$this->Scorecard_model->total_extra(array('batting_order'=>2,'match_id'=>$match_id),'extras');

             $data['decision']=$data['decision'];
       // var_dump($data['bat_first']);

                $this->load->view('header');
            $this->load->view('add_second_batting', $data);

    }
    }

    public function insert_total_score()
    {
         $user_id=$this->session->userdata('user_id');
            $match_id=$this->input->post('match_id');
          $batting_order=$this->input->post('batting_order');
          $t_overs=$this->input->post('t_overs');
         
         
          
         $record=array('batting_team'=>$this->input->post('batting_team_id'),
                 'match_id'=>$match_id,
                'total_runs'=>$this->input->post('total_runs'),
                'wickets'=>$this->input->post('wickets'),
                'batting_order'=>$batting_order,
                't_overs'=>$t_overs,
                 'user_id'=>$user_id
                );

          $this->Scorecard_model->total_score($record);
                
              if($batting_order==1)
            {
 $data=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                

                
                $team1=$data['team_one_id'];
                $team2=$data['team_two_id'];
                $win_team=$data['toss_winner'];
                $batting_first=$data['bat_first'];
               
                  $data['toss_id']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                
            $data['team_one']=$this->Team_model->team_information(array('team_id'=>$team1),'add_team');
            $data['team_two']=$this->Team_model->team_information(array('team_id'=>$team2),'add_team');
            $data['toss_winner']=$this->Team_model->team_information(array('team_id'=>$win_team),'add_team');
            $data['bat_first']=$this->Scorecard_model->get_score(array('batting_team'=>$batting_first,'match_id'=>$match_id),'batting_first');
           $data['all_score']=$this->Scorecard_model->get_total_score(array('batting_order'=>1,'match_id'=>$match_id),'batting_first');
            $data['player_info']=$this->Scorecard_model->player_info($match_id);
             $data['bowler_info']=$this->Scorecard_model->player_info_second($match_id);
            $data['get_extra1']=$this->Scorecard_model->total_extra(array('batting_order'=>1,'match_id'=>$match_id),'extras');
             $data['decision']=$data['decision'];
         // var_dump($data);
                $this->load->view('header');
            $this->load->view('add_first_batting', $data);
        }
        if($batting_order==2)
        {
           $data=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                

                
                $team1=$data['team_one_id'];
                $team2=$data['team_two_id'];
                $win_team=$data['toss_winner'];
                $batting_second=$data['bowl_first'];
               $data['match_result'] = $this->Scorecard_model->calculate_match_result($match_id);
                  $data['toss_id']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                
            $data['team_one']=$this->Team_model->team_information(array('team_id'=>$team1),'add_team');
            $data['team_two']=$this->Team_model->team_information(array('team_id'=>$team2),'add_team');
            $data['toss_winner']=$this->Team_model->team_information(array('team_id'=>$win_team),'add_team');
            $data['bat_second']=$this->Scorecard_model->get_score(array('batting_team'=>$batting_second,'match_id'=>$match_id),'batting_first');
            $data['all_score']=$this->Scorecard_model->get_total_score(array('batting_order'=>2,'match_id'=>$match_id),'batting_first');
            $data['player_info']=$this->Scorecard_model->player_info_second($match_id);
             $data['bowler_info']=$this->Scorecard_model->player_info($match_id);
            $data['get_extra1']=$this->Scorecard_model->total_extra(array('batting_order'=>2,'match_id'=>$match_id),'extras');

             $data['decision']=$data['decision'];
       // var_dump($data['bat_first']);

                $this->load->view('header');
            $this->load->view('add_second_batting', $data);

    }
    }

    
    public function show_bowling_first($batting_first,$bowling_first,$match_id)
    {
        
       
         $user_id=$this->session->userdata('user_id');
$data=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                

                
                $team1=$data['team_one_id'];
                $team2=$data['team_two_id'];
                $win_team=$data['toss_winner'];
                $batting_first=$data['bat_first'];
              
                  $data['toss_id']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                
            $data['team_one']=$this->Team_model->team_information(array('team_id'=>$team1),'add_team');
            $data['team_two']=$this->Team_model->team_information(array('team_id'=>$team2),'add_team');
            $data['toss_winner']=$this->Team_model->team_information(array('team_id'=>$win_team),'add_team');
            //echo $bowl_first;
           // echo $match_id;
             $data['player_info']=$this->Scorecard_model->player_info_second($match_id);


             $data['bowling_first']=$this->Scorecard_model->get_bowling(array('bowling_team'=>$bowling_first,'match_id'=>$match_id),'bowling_first');
            
             $data['decision']=$data['decision'];
     //  var_dump($data['bowling_first']);
  //var_dump( $data['player_info']);
                $this->load->view('header');
            $this->load->view('add_first_bowling', $data);
         
    }

    public function add_bowling()
    {
         $user_id=$this->session->userdata('user_id');
            $match_id=$this->input->post('match_id');
            $batting_first=$this->input->post('batting_team');
            $bowl_first=$this->input->post('bowling_team');
             $bowling_order=$this->input->post('bowling_order');
            
            $player_id=$this->input->post('player_id');
        $record=array('batting_team'=>$batting_first,
                'bowling_team'=>$bowl_first,
                 'match_id'=>$match_id,
                'player_id'=>$player_id,
                'overs'=>$this->input->post('overs'),
                'given_runs'=>$this->input->post('given_runs'),
                'wickets'=>$this->input->post('wickets'),
                'bowling_order'=>$bowling_order,
                 'user_id'=>$this->session->userdata('user_id')
                );
        $this->Scorecard_model->insert_bowling_first($player_id,$match_id,$record);

          if($bowling_order == 1)
  {
    $data=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                

                
                $team1=$data['team_one_id'];
                $team2=$data['team_two_id'];
                $win_team=$data['toss_winner'];
                $bowling_first=$data['bowl_first'];

                  $data['toss_id']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                
            $data['team_one']=$this->Team_model->team_information(array('team_id'=>$team1),'add_team');
            $data['team_two']=$this->Team_model->team_information(array('team_id'=>$team2),'add_team');
            $data['toss_winner']=$this->Team_model->team_information(array('team_id'=>$win_team),'add_team');
            $data['bowling_first']=$this->Scorecard_model->get_bowling(array('bowling_team'=>$bowling_first,'match_id'=>$match_id),'bowling_first');
          //  var_dump($data['bowling_first']);
             $data['player_info']=$this->Scorecard_model->player_info_second($match_id);
            // var_dump($data['player_info']);
             $data['decision']=$data['decision'];
        //var_dump($data);

                $this->load->view('header');
            $this->load->view('add_first_bowling', $data);
        
    }

    if($bowling_order==2)
    {
         $data=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                

                
                $team1=$data['team_one_id'];
                $team2=$data['team_two_id'];
                $win_team=$data['toss_winner'];
                $bowl_second=$data['bat_first'];
            //    var_dump($bowl_second);
                  $data['toss_id']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                
            $data['team_one']=$this->Team_model->team_information(array('team_id'=>$team1),'add_team');
            $data['team_two']=$this->Team_model->team_information(array('team_id'=>$team2),'add_team');
            $data['toss_winner']=$this->Team_model->team_information(array('team_id'=>$win_team),'add_team');
            $data['bowling_second']=$this->Scorecard_model->get_bowling(array('bowling_team'=>$bowl_second,'match_id'=>$match_id),'bowling_first');
        //    var_dump( $data['bowling_second']);

            $data['player_info']=$this->Scorecard_model->player_info($match_id);
            
             $data['decision']=$data['decision'];
        //var_dump($data);

                $this->load->view('header');
            $this->load->view('add_second_bowling', $data);

 }
    }

      public function add_second_batting($batting_second,$bowling_second,$match_id)
    
         
    {

         $record=array('batting_team'=>$batting_second,
                'bowling_team'=>$bowling_second,
                 'match_id'=>$match_id
            );
         $user_id=$this->session->userdata('user_id');
$data=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                

                
                $team1=$data['team_one_id'];
                $team2=$data['team_two_id'];
                $win_team=$data['toss_winner'];
                $batting_second=$data['bowl_first'];
              
                  $data['toss_id']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                
            $data['team_one']=$this->Team_model->team_information(array('team_id'=>$team1),'add_team');
            $data['team_two']=$this->Team_model->team_information(array('team_id'=>$team2),'add_team');
            $data['toss_winner']=$this->Team_model->team_information(array('team_id'=>$win_team),'add_team');
            //echo $bowl_first;
           // echo $match_id;
            $data['bat_second']=$this->Scorecard_model->get_score(array('batting_team'=>$batting_second,'match_id'=>$match_id),'batting_second');
             $data['all_score']=$this->Scorecard_model->get_total_score(array('batting_order'=>2,'match_id'=>$match_id),'batting_first');
             $data['player_info']=$this->Scorecard_model->player_info_second($match_id);
              $data['bowler_info']=$this->Scorecard_model->player_info($match_id);
            $data['get_extra1']=$this->Scorecard_model->total_extra(array('batting_order'=>2,'match_id'=>$match_id),'extras');
            
             $data['decision']=$data['decision'];
       // var_dump($data['bowling_first']);

                $this->load->view('header');
            $this->load->view('add_second_batting', $data);
         
    }

     public function show_bowling_second($bowling_second,$batting_second, $match_id)
    {

      
         $user_id=$this->session->userdata('user_id');
$data=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                

                
                $team1=$data['team_one_id'];
                $team2=$data['team_two_id'];
                $win_team=$data['toss_winner'];
                $batting_second=$data['bowl_first'];
              
                  $data['toss_id']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                
            $data['team_one']=$this->Team_model->team_information(array('team_id'=>$team1),'add_team');
            $data['team_two']=$this->Team_model->team_information(array('team_id'=>$team2),'add_team');
            $data['toss_winner']=$this->Team_model->team_information(array('team_id'=>$win_team),'add_team');
            //echo $bowl_first;
           // echo $match_id;
            $data['bowling_second']=$this->Scorecard_model->get_bowling(array('bowling_team'=>$bowling_second,'match_id'=>$match_id),'bowling_first');
            $data['player_info']=$this->Scorecard_model->player_info($match_id);
             $data['decision']=$data['decision'];
       // var_dump($data['bowling_first']);

                $this->load->view('header');
            $this->load->view('add_second_bowling', $data);
         
    }



public function edit_score() {
     
     $user_id=$this->session->userdata('user_id');
            $match_id = $this->input->post('match_id');

            $player_id = $this->input->post('player_id');
         //   echo $player_id;
            $batting_order = $this->input->post('batting_order');
          //  var_dump(  $this->input->post('batting_order'));
            $runs = $this->input->post('runs');
            $balls = $this->input->post('balls');
            $fours = $this->input->post('fours');
            $sixes = $this->input->post('sixes');
            $dismissal=$this->input->post('dismissal');
              $bowler_id=$this->input->post('bowler_id');
 if ($dismissal =='Not Out' || $dismissal == 'Run Out') {
    $bowler_id = "";
  }

            $data = array(
                'runs' => $runs,
                'balls' => $balls,
                'fours' => $fours,
                'sixes' => $sixes,
                'dismissal'=>$dismissal,
                'bowler_player_id'=>$bowler_id
            );
//var_dump($data);
            $this->load->model('Scorecard_model');
            $result = $this->Scorecard_model->update_score($match_id, $player_id, $data);
            if($batting_order==1)
            {
 $data=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
               // var_dump($data, $match_id); 

                
                $team1=$data['team_one_id'];
                $team2=$data['team_two_id'];
                $win_team=$data['toss_winner'];
                $batting_first=$data['bat_first'];
               
                  $data['toss_id']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                
            $data['team_one']=$this->Team_model->team_information(array('team_id'=>$team1),'add_team');
            $data['team_two']=$this->Team_model->team_information(array('team_id'=>$team2),'add_team');
            $data['toss_winner']=$this->Team_model->team_information(array('team_id'=>$win_team),'add_team');
            $data['bat_first']=$this->Scorecard_model->get_score(array('batting_team'=>$batting_first,'match_id'=>$match_id),'batting_first');
           $data['all_score']=$this->Scorecard_model->get_total_score(array('batting_order'=>1,'match_id'=>$match_id),'batting_first');
            $data['player_info']=$this->Scorecard_model->player_info($match_id);
             $data['bowler_info']=$this->Scorecard_model->player_info_second($match_id);

            $data['get_extra1']=$this->Scorecard_model->total_extra(array('batting_order'=>1,'match_id'=>$match_id),'extras');
             $data['decision']=$data['decision'];
         // var_dump($data);
                $this->load->view('header');
            $this->load->view('add_first_batting', $data);
        }
        if($batting_order==2)
        {
           $data=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                

                
                $team1=$data['team_one_id'];
                $team2=$data['team_two_id'];
                $win_team=$data['toss_winner'];
                $batting_second=$data['bowl_first'];
              
                  $data['toss_id']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                
            $data['team_one']=$this->Team_model->team_information(array('team_id'=>$team1),'add_team');
            $data['team_two']=$this->Team_model->team_information(array('team_id'=>$team2),'add_team');
            $data['toss_winner']=$this->Team_model->team_information(array('team_id'=>$win_team),'add_team');
            $data['bat_second']=$this->Scorecard_model->get_score(array('batting_team'=>$batting_second,'match_id'=>$match_id),'batting_first');
            $data['all_score']=$this->Scorecard_model->get_total_score(array('batting_order'=>2,'match_id'=>$match_id),'batting_first');
            $data['player_info']=$this->Scorecard_model->player_info_second($match_id);
             $data['bowler_info']=$this->Scorecard_model->player_info($match_id);
            $data['get_extra1']=$this->Scorecard_model->total_extra(array('batting_order'=>2,'match_id'=>$match_id),'extras');

             $data['decision']=$data['decision'];
       // var_dump($data['bat_first']);

                $this->load->view('header');
            $this->load->view('add_second_batting', $data);

    }
}
     public function insert_extras()
    {
         $user_id=$this->session->userdata('user_id');
            $match_id=$this->input->post('match_id');
            $batting_order=$this->input->post('batting_order');
         $record=array('batting_team'=>$this->input->post('batting_team_id'),
                 'match_id'=>$match_id,
                'wides'=>$this->input->post('wides'),
                'no_balls'=>$this->input->post('no_balls'),
                'byes'=>$this->input->post('byes'),
                'leg_byes'=>$this->input->post('leg_byes'),
                'batting_order'=>$batting_order,
                 'user_id'=>$user_id
                );
      
          $this->Scorecard_model->extras($record);
                
       if($batting_order==1)
    {
     $data=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                

                
                $team1=$data['team_one_id'];
                $team2=$data['team_two_id'];
                $win_team=$data['toss_winner'];
                $batting_first=$data['bat_first'];
               
                  $data['toss_id']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                
            $data['team_one']=$this->Team_model->team_information(array('team_id'=>$team1),'add_team');
            $data['team_two']=$this->Team_model->team_information(array('team_id'=>$team2),'add_team');
            $data['toss_winner']=$this->Team_model->team_information(array('team_id'=>$win_team),'add_team');
            $data['bat_first']=$this->Scorecard_model->get_score(array('batting_team'=>$batting_first,'match_id'=>$match_id),'batting_first');
           $data['all_score']=$this->Scorecard_model->get_total_score(array('batting_order'=>1,'match_id'=>$match_id),'batting_first');
            $data['player_info']=$this->Scorecard_model->player_info($match_id);
             $data['bowler_info']=$this->Scorecard_model->player_info_second($match_id);
            $data['get_extra1']=$this->Scorecard_model->total_extra(array('batting_order'=>1,'match_id'=>$match_id),'extras');
             $data['decision']=$data['decision'];
         // var_dump($data);
                $this->load->view('header');
            $this->load->view('add_first_batting', $data);// Redirect to a relevant page
    }

    if($batting_order==2)
    {
         $data=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                

                
                $team1=$data['team_one_id'];
                $team2=$data['team_two_id'];
                $win_team=$data['toss_winner'];
                $batting_second=$data['bowl_first'];
              
                  $data['toss_id']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                
            $data['team_one']=$this->Team_model->team_information(array('team_id'=>$team1),'add_team');
            $data['team_two']=$this->Team_model->team_information(array('team_id'=>$team2),'add_team');
            $data['toss_winner']=$this->Team_model->team_information(array('team_id'=>$win_team),'add_team');
            $data['bat_second']=$this->Scorecard_model->get_score(array('batting_team'=>$batting_second,'match_id'=>$match_id),'batting_first');
            $data['all_score']=$this->Scorecard_model->get_total_score(array('batting_order'=>2,'match_id'=>$match_id),'batting_first');
            $data['player_info']=$this->Scorecard_model->player_info_second($match_id);
             $data['bowler_info']=$this->Scorecard_model->player_info($match_id);
            $data['get_extra1']=$this->Scorecard_model->total_extra(array('batting_order'=>2,'match_id'=>$match_id),'extras');
 //var_dump($data['get_extra1']);
             $data['decision']=$data['decision'];
       // var_dump($data['bat_first']);

                $this->load->view('header');
            $this->load->view('add_second_batting', $data);
    }
  
    }
     public function delete_score() {
          $user_id=$this->session->userdata('user_id');
    $match_id = $this->input->post('match_id');
    $player_id = $this->input->post('player_id');
     $batting_order = $this->input->post('batting_order');

   $this->Scorecard_model->delete_score($match_id, $player_id);

        if($batting_order==1)
    {
     $data=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                

                
                $team1=$data['team_one_id'];
                $team2=$data['team_two_id'];
                $win_team=$data['toss_winner'];
                $batting_first=$data['bat_first'];
               
                  $data['toss_id']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                
            $data['team_one']=$this->Team_model->team_information(array('team_id'=>$team1),'add_team');
            $data['team_two']=$this->Team_model->team_information(array('team_id'=>$team2),'add_team');
            $data['toss_winner']=$this->Team_model->team_information(array('team_id'=>$win_team),'add_team');
            $data['bat_first']=$this->Scorecard_model->get_score(array('batting_team'=>$batting_first,'match_id'=>$match_id),'batting_first');
           $data['all_score']=$this->Scorecard_model->get_total_score(array('batting_order'=>1,'match_id'=>$match_id),'batting_first');
            $data['player_info']=$this->Scorecard_model->player_info($match_id);
             $data['bowler_info']=$this->Scorecard_model->player_info_second($match_id);
            $data['get_extra1']=$this->Scorecard_model->total_extra(array('batting_order'=>1,'match_id'=>$match_id),'extras');
             $data['decision']=$data['decision'];
         // var_dump($data);
                $this->load->view('header');
            $this->load->view('add_first_batting', $data);// Redirect to a relevant page
    }

    if($batting_order==2)
    {
         $data=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                

                
                $team1=$data['team_one_id'];
                $team2=$data['team_two_id'];
                $win_team=$data['toss_winner'];
                $batting_second=$data['bowl_first'];
              
                  $data['toss_id']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                
            $data['team_one']=$this->Team_model->team_information(array('team_id'=>$team1),'add_team');
            $data['team_two']=$this->Team_model->team_information(array('team_id'=>$team2),'add_team');
            $data['toss_winner']=$this->Team_model->team_information(array('team_id'=>$win_team),'add_team');
            $data['bat_second']=$this->Scorecard_model->get_score(array('batting_team'=>$batting_second,'match_id'=>$match_id),'batting_first');
            $data['all_score']=$this->Scorecard_model->get_total_score(array('batting_order'=>2,'match_id'=>$match_id),'batting_first');
            $data['player_info']=$this->Scorecard_model->player_info_second($match_id);
             $data['bowler_info']=$this->Scorecard_model->player_info($match_id);
            $data['get_extra1']=$this->Scorecard_model->total_extra(array('batting_order'=>2,'match_id'=>$match_id),'extras');
 //var_dump($data['get_extra1']);
             $data['decision']=$data['decision'];
       // var_dump($data['bat_first']);

                $this->load->view('header');
            $this->load->view('add_second_batting', $data);
    }

 }  

 public function delete_bowling_record()
 {
     $user_id=$this->session->userdata('user_id');
    $match_id = $this->input->post('match_id');
    $player_id = $this->input->post('player_id');
     $bowling_order = $this->input->post('bowling_order');
    $this->Scorecard_model->delete_bowling_record($match_id, $player_id);
    if($bowling_order == 1)
  {
    $data=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                

                
                $team1=$data['team_one_id'];
                $team2=$data['team_two_id'];
                $win_team=$data['toss_winner'];
                $bowling_first=$data['bowl_first'];

                  $data['toss_id']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                
            $data['team_one']=$this->Team_model->team_information(array('team_id'=>$team1),'add_team');
            $data['team_two']=$this->Team_model->team_information(array('team_id'=>$team2),'add_team');
            $data['toss_winner']=$this->Team_model->team_information(array('team_id'=>$win_team),'add_team');
            $data['bowling_first']=$this->Scorecard_model->get_bowling(array('bowling_team'=>$bowling_first,'match_id'=>$match_id),'bowling_first');
          //  var_dump($data['bowling_first']);
             $data['player_info']=$this->Scorecard_model->player_info_second($match_id);
            // var_dump($data['player_info']);
             $data['decision']=$data['decision'];
        //var_dump($data);

                $this->load->view('header');
            $this->load->view('add_first_bowling', $data);
        
    }

    if($bowling_order==2)
    {
         $data=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                

                
                $team1=$data['team_one_id'];
                $team2=$data['team_two_id'];
                $win_team=$data['toss_winner'];
                $bowl_second=$data['bat_first'];

                  $data['toss_id']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                
            $data['team_one']=$this->Team_model->team_information(array('team_id'=>$team1),'add_team');
            $data['team_two']=$this->Team_model->team_information(array('team_id'=>$team2),'add_team');
            $data['toss_winner']=$this->Team_model->team_information(array('team_id'=>$win_team),'add_team');
            $data['bowling_second']=$this->Scorecard_model->get_bowling(array('bowling_team'=>$bowl_second,'match_id'=>$match_id),'bowling_first');
            $data['player_info']=$this->Scorecard_model->player_info($match_id);

            
             $data['decision']=$data['decision'];
        //var_dump($data);

                $this->load->view('header');
            $this->load->view('add_second_bowling', $data);

 }
}
 public function edit_extra() {
    // Get the form data (assuming POST method is used)
    $match_id = $this->input->post('match_id');
    $batting_order = $this->input->post('batting_order');
    $wides = $this->input->post('wides');
    $no_balls = $this->input->post('no_balls');
    $byes = $this->input->post('byes');
    $leg_byes = $this->input->post('leg_byes');
    $user_id=$this->session->userdata('user_id');
    // Prepare data for update
    $data = array(
        'wides' => $wides,
        'no_balls' => $no_balls,
        'byes' => $byes,
        'leg_byes' => $leg_byes
    );
    
    // Load the model
    $this->load->model('Scorecard_model');
    
    // Call the model function to update extras
    $this->Scorecard_model->update_extras($match_id, $batting_order, $data);
    
    if($batting_order==1)
    {
     $data=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id));
                
//var_dump($data);
                
                $team1=$data['team_one_id'];
                $team2=$data['team_two_id'];
                $win_team=$data['toss_winner'];
                $batting_first=$data['bat_first'];
               
                  $data['toss_id']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                
            $data['team_one']=$this->Team_model->team_information(array('team_id'=>$team1),'add_team');
            $data['team_two']=$this->Team_model->team_information(array('team_id'=>$team2),'add_team');
            $data['toss_winner']=$this->Team_model->team_information(array('team_id'=>$win_team),'add_team');
            $data['bat_first']=$this->Scorecard_model->get_score(array('batting_team'=>$batting_first,'match_id'=>$match_id),'batting_first');
           $data['all_score']=$this->Scorecard_model->get_total_score(array('batting_order'=>1,'match_id'=>$match_id),'batting_first');
            $data['player_info']=$this->Scorecard_model->player_info($match_id);
             $data['bowler_info']=$this->Scorecard_model->player_info_second($match_id);
            $data['get_extra1']=$this->Scorecard_model->total_extra(array('batting_order'=>1,'match_id'=>$match_id),'extras');
             $data['decision']=$data['decision'];
         // var_dump($data);
                $this->load->view('header');
            $this->load->view('add_first_batting', $data);// Redirect to a relevant page
    }

    if($batting_order==2)
    {
         $data=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                

                
                $team1=$data['team_one_id'];
                $team2=$data['team_two_id'];
                $win_team=$data['toss_winner'];
                $batting_second=$data['bowl_first'];
              
                  $data['toss_id']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                
            $data['team_one']=$this->Team_model->team_information(array('team_id'=>$team1),'add_team');
            $data['team_two']=$this->Team_model->team_information(array('team_id'=>$team2),'add_team');
            $data['toss_winner']=$this->Team_model->team_information(array('team_id'=>$win_team),'add_team');
            $data['bat_second']=$this->Scorecard_model->get_score(array('batting_team'=>$batting_second,'match_id'=>$match_id),'batting_first');
            $data['all_score']=$this->Scorecard_model->get_total_score(array('batting_order'=>2,'match_id'=>$match_id),'batting_first');
            $data['player_info']=$this->Scorecard_model->player_info_second($match_id);
             $data['bowler_info']=$this->Scorecard_model->player_info($match_id);
            $data['get_extra1']=$this->Scorecard_model->total_extra(array('batting_order'=>2,'match_id'=>$match_id),'extras');
 //var_dump($data['get_extra1']);
             $data['decision']=$data['decision'];
       // var_dump($data['bat_first']);

                $this->load->view('header');
            $this->load->view('add_second_batting', $data);
    }
}
  public function edit_total_score() {
       $user_id=$this->session->userdata('user_id');
        $match_id = $this->input->post('match_id');
        $batting_order= $this->input->post('batting_order');
        $total_runs = $this->input->post('total_runs');
        $wickets = $this->input->post('wickets');
         $t_overs=$this->input->post('t_overs');

        // Call the model to update the score
        $update_status = $this->Scorecard_model->edit_total_score($match_id, $batting_order, $total_runs, $t_overs, $wickets);

       if($batting_order==1)
    {
     $data=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                

                
                $team1=$data['team_one_id'];
                $team2=$data['team_two_id'];
                $win_team=$data['toss_winner'];
                $batting_first=$data['bat_first'];
               
                  $data['toss_id']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                
            $data['team_one']=$this->Team_model->team_information(array('team_id'=>$team1),'add_team');
            $data['team_two']=$this->Team_model->team_information(array('team_id'=>$team2),'add_team');
            $data['toss_winner']=$this->Team_model->team_information(array('team_id'=>$win_team),'add_team');
            $data['bat_first']=$this->Scorecard_model->get_score(array('batting_team'=>$batting_first,'match_id'=>$match_id),'batting_first');
           $data['all_score']=$this->Scorecard_model->get_total_score(array('batting_order'=>1,'match_id'=>$match_id),'batting_first');
            $data['player_info']=$this->Scorecard_model->player_info($match_id);
             $data['bowler_info']=$this->Scorecard_model->player_info_second($match_id);
            $data['get_extra1']=$this->Scorecard_model->total_extra(array('batting_order'=>1,'match_id'=>$match_id),'extras');
             $data['decision']=$data['decision'];
         // var_dump($data);
                $this->load->view('header');
            $this->load->view('add_first_batting', $data);// Redirect to a relevant page
    }

    if($batting_order==2)
    {
         $data=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                

                
                $team1=$data['team_one_id'];
                $team2=$data['team_two_id'];
                $win_team=$data['toss_winner'];
                $batting_second=$data['bowl_first'];
              
                  $data['toss_id']=$this->Scorecard_model->get_toss(array('user_id'=>$user_id,'match_id'=>$match_id),'toss');
                
            $data['team_one']=$this->Team_model->team_information(array('team_id'=>$team1),'add_team');
            $data['team_two']=$this->Team_model->team_information(array('team_id'=>$team2),'add_team');
            $data['toss_winner']=$this->Team_model->team_information(array('team_id'=>$win_team),'add_team');
            $data['bat_second']=$this->Scorecard_model->get_score(array('batting_team'=>$batting_second,'match_id'=>$match_id),'batting_first');
            $data['all_score']=$this->Scorecard_model->get_total_score(array('batting_order'=>2,'match_id'=>$match_id),'batting_first');
            $data['player_info']=$this->Scorecard_model->player_info_second($match_id);
             $data['bowler_info']=$this->Scorecard_model->player_info($match_id);
            $data['get_extra1']=$this->Scorecard_model->total_extra(array('batting_order'=>2,'match_id'=>$match_id),'extras');
 //var_dump($data['get_extra1']);
             $data['decision']=$data['decision'];
       // var_dump($data['bat_first']);

                $this->load->view('header');
            $this->load->view('add_second_batting', $data);
    }
    }
      public function edit_bowling() {
    $user_id = $this->session->userdata('user_id');
    $player_id = $this->input->post('player_id');
    $bowling_order = $this->input->post('bowling_order');
    $match_id = $this->input->post('match_id');  
    $overs = $this->input->post('overs');
    $given_runs = $this->input->post('given_runs');
    $wickets = $this->input->post('wickets');

    // Prepare the data array correctly (fixed syntax errors)
    $record = array(
        'overs' => $overs,
        'given_runs' => $given_runs,
        'wickets' => $wickets
    );
   // var_dump($player_id,$match_id);

    // Update the bowling record in the database
    $this->Scorecard_model->update_bowling_stats($player_id, $match_id, $overs, $given_runs, $wickets, $bowling_order);

    // Redirect based on bowling order
    if ($bowling_order == 1) {
        $data = $this->Scorecard_model->get_toss(array('user_id' => $user_id, 'match_id' => $match_id), 'toss');
        $team1 = $data['team_one_id'];
        $team2 = $data['team_two_id'];
        $win_team = $data['toss_winner'];
        $bowling_first = $data['bowl_first'];

        $data['toss_id'] = $this->Scorecard_model->get_toss(array('user_id' => $user_id, 'match_id' => $match_id), 'toss');
        $data['team_one'] = $this->Team_model->team_information(array('team_id' => $team1), 'add_team');
        $data['team_two'] = $this->Team_model->team_information(array('team_id' => $team2), 'add_team');
        $data['toss_winner'] = $this->Team_model->team_information(array('team_id' => $win_team), 'add_team');
        $data['bowling_first'] = $this->Scorecard_model->get_bowling(array('bowling_team' => $bowling_first, 'match_id' => $match_id), 'bowling_first');
        $data['player_info'] = $this->Scorecard_model->player_info_second($match_id);
        $data['decision'] = $data['decision'];

        $this->load->view('header');
        $this->load->view('add_first_bowling', $data);
    } elseif ($bowling_order == 2) {
        $data = $this->Scorecard_model->get_toss(array('user_id' => $user_id, 'match_id' => $match_id), 'toss');
        $team1 = $data['team_one_id'];
        $team2 = $data['team_two_id'];
        $win_team = $data['toss_winner'];
        $bowl_second = $data['bat_first'];

        $data['toss_id'] = $this->Scorecard_model->get_toss(array('user_id' => $user_id, 'match_id' => $match_id), 'toss');
        $data['team_one'] = $this->Team_model->team_information(array('team_id' => $team1), 'add_team');
        $data['team_two'] = $this->Team_model->team_information(array('team_id' => $team2), 'add_team');
        $data['toss_winner'] = $this->Team_model->team_information(array('team_id' => $win_team), 'add_team');
        $data['bowling_second'] = $this->Scorecard_model->get_bowling(array('bowling_team' => $bowl_second, 'match_id' => $match_id), 'bowling_first');
        $data['player_info'] = $this->Scorecard_model->player_info($match_id);
        $data['decision'] = $data['decision'];

        $this->load->view('header');
        $this->load->view('add_second_bowling', $data);
    } else {
        // Handle invalid bowling order (optional)
        log_message('error', 'Invalid bowling_order received: ' . $bowling_order);
        show_error('Invalid bowling order');
    }
}

public function live_score()
{

        $this->load->view('header');
        $this->load->view('live_score');   
}

}
     


    

    

    