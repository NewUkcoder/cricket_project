
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
            $this->load->view('landing_page');

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
}