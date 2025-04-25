<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Team_model');
        $this->load->model('Scorecard_model');
        $this->load->model('Tournament_model');
        $this->load->model('Schedule_model');
        $this->load->model('Player_model'); // Ensure Player_model is loaded
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->library('user_agent');
        $this->load->database();
    }

    public function index() {
        $this->load->view('sign_in');
    }

    public function sign_up() {
        $this->load->view('sign_up');
    }

    public function welcome_message() {
        if ($this->session->userdata('logged')) {
            $this->load->view('header');
            $this->load->view('welcome_message');
        } else {
            $this->index();
        }
    }

    public function enter_player() {
        if ($this->session->userdata('logged')) {
            $this->load->view('header');
            $this->load->view('enter_player');
        } else {
            $this->index();
        }
    }

    public function enter_team() {
        if ($this->session->userdata('logged')) {
            $this->load->view('header');
            $this->load->view('enter_team');
        } else {
            $this->index();
        }
    }

    public function scorecard($team_one, $team_two, $match_id) {
        if ($this->session->userdata('logged')) {
            $user_id = $this->session->userdata('user_id');
            $toss = $this->Scorecard_model->get_toss(['match_id' => $match_id]);

            if ($toss) {
                $data['match_result'] = $this->Scorecard_model->calculate_match_result($match_id);
                $data['information'] = $this->Scorecard_model->get_scorecard($match_id);
                $data['batting_first_score'] = $this->Scorecard_model->show_total_score(1, $match_id);
                $data['batting_second_score'] = $this->Scorecard_model->show_total_score(2, $match_id);
                $data['first_inning'] = $this->Scorecard_model->get_batting_first_details($match_id);
                $data['first_bowling_inning'] = $this->Scorecard_model->get_bowling_first_details($match_id);
                $data['second_inning'] = $this->Scorecard_model->get_batting_second_details($match_id);
                $data['second_bowling_inning'] = $this->Scorecard_model->get_bowling_second_details($match_id);
                $data['player_of_match'] = $this->Scorecard_model->get_player_of_match($match_id);

                $this->load->view('header');
                $this->load->view('scorecard', $data);
            } else {
                $this->session->set_flashdata('error', 'Toss information not found for match ID ' . $match_id);
                redirect($this->agent->referrer());
            }
        } else {
            $this->index();
        }
    }

    public function schedule() {
        if ($this->session->userdata('logged')) {
            $this->load->view('header');
            $this->load->view('schedule');
        } else {
            $this->index();
        }
    }

    public function landing_page() {
        if ($this->session->userdata('logged')) {
            $user_id = $this->session->userdata('user_id');
            $team_data['team'] = $this->Team_model->team_information(['user_id' => $user_id], 'add_team') ?: 0;
            $team_data['data'] = $this->Player_model->get_player(['user_id' => $user_id], 'add_player') ?: 0;
            $team_data['tournament'] = $this->Tournament_model->get_league($user_id) ?: 0;

            $this->load->view('header');
            $this->load->view('landing_page', $team_data);
        } else {
            $this->index();
        }
    }

    public function match_summary() {
        if ($this->session->userdata('logged')) {
            $this->load->view('header');
            $this->load->view('match_summary');
        } else {
            $this->index();
        }
    }

    public function enter_schedule($team_one_id, $team_two_id) {
        if ($this->session->userdata('logged')) {
            $team_data = $this->Team_model->add_fixture($team_one_id, $team_two_id);
            $this->load->view('header');
            $this->load->view('enter_schedule', $team_data);
        } else {
            $this->index();
        }
    }

    public function scorecard_links($team1, $team2, $match_id) {
        if ($this->session->userdata('logged')) {
            $user_id = $this->session->userdata('user_id');
            $toss = $this->Scorecard_model->get_toss(['match_id' => $match_id]);
            $toss_info = $this->Scorecard_model->toss_info_row($match_id);

            if (!$toss || !$toss_info) {
                $this->session->set_flashdata('error', 'Toss information not found for match ID ' . $match_id);
                redirect($this->agent->referrer());
            }

            $data['toss1'] = $toss;
            $data['toss_information'] = $toss_info;
            $data['two_team'] = $this->Team_model->two_team($team1, $team2);
            $data['two_team_player'] = $this->Team_model->two_team_player($team1, $team2);
            $data['player_of_match'] = $this->Player_model->player_of_match($match_id);
            $data['match_id'] = $match_id;

            $this->load->view('header');
            $this->load->view('scorecard_links', $data);
        } else {
            $this->index();
        }
    }

    public function toss($team1, $team2, $match_id) {
        if ($this->session->userdata('logged')) {
            $toss = $this->Scorecard_model->get_toss(['match_id' => $match_id]);

            if (!$toss) {
                $teams = $this->Scorecard_model->team_toss($team1, $team2);
                if ($teams['team_1'] && $teams['team_2']) {
                    $data['team_one'] = $teams['team_1'];
                    $data['team_two'] = $teams['team_2'];
                    $data['match_id'] = $match_id;
                    $this->load->view('header');
                    $this->load->view('toss', $data);
                } else {
                    $this->session->set_flashdata('error', 'No teams found for toss.');
                    redirect($this->agent->referrer());
                }
            } else {
                $data['toss1'] = $toss;
                $data['toss_information'] = $this->Scorecard_model->toss_info_row($match_id);
                if (!$data['toss_information']) {
                    $this->session->set_flashdata('error', 'Toss information not found for match ID ' . $match_id);
                    redirect($this->agent->referrer());
                }
                $data['two_team'] = $this->Team_model->two_team($team1, $team2);
                $data['two_team_player'] = $this->Team_model->two_team_player($team1, $team2);
                $data['player_of_match'] = $this->Player_model->player_of_match($match_id);
                $data['match_id'] = $match_id;

                $this->load->view('header');
                $this->load->view('scorecard_links', $data);
            }
        } else {
            $this->index();
        }
    }

    public function enter_scorecard() {
        if ($this->session->userdata('logged')) {
            $user_id = $this->session->userdata('user_id');
            $team_data['team'] = $this->Team_model->team_information(['user_id' => $user_id], 'add_team') ?: 0;
            $team_data['players'] = $this->Player_model->get_player(['user_id' => $user_id], 'add_player') ?: 0;

            $this->load->view('header');
            $this->load->view('enter_scorecard', $team_data);
        } else {
            $this->index();
        }
    }

    public function add_tournament() {
        if ($this->session->userdata('logged')) {
            $this->load->view('header');
            $this->load->view('add_tournament');
        } else {
            $this->index();
        }
    }

    public function tournament_landing($league_id) {
        if ($this->session->userdata('logged')) {
            $team_data['league'] = $this->Tournament_model->league_information($league_id);
            $team_data['league_teams'] = $this->Tournament_model->get_league_teams($league_id);
            $team_data['league_schedule'] = $this->Tournament_model->get_league_schedule($league_id);
            $team_data['league_rules'] = $this->Tournament_model->get_league_rules($league_id);
            $team_data['league_top_scorer'] = $this->Tournament_model->league_top_scorer($league_id);
            $team_data['league_top_bowler'] = $this->Tournament_model->league_top_bowler($league_id);
            $team_data['league_highest_individual_score'] = $this->Tournament_model->league_highest_individual_score($league_id);
            $team_data['league_highest_wicket_taker'] = $this->Tournament_model->league_highest_wicket_taker($league_id);
            $team_data['league_highest_team_score'] = $this->Tournament_model->get_highest_team_score($league_id);
            $team_data['league_lowest_team_score'] = $this->Tournament_model->league_lowest_team_score($league_id);
            $team_data['league_teams'] = $this->Tournament_model->league_teams($league_id);
            $team_data['match_results'] = $this->Tournament_model->get_match_results_by_league_with_batting_order($league_id);

            $this->load->view('header');
            $this->load->view('tournament_landing', $team_data);
        } else {
            $this->index();
        }
    }

    public function tournament_main($league_id) {
        if ($this->session->userdata('logged')) {
            $team_data['league'] = $this->Tournament_model->league_information($league_id);
            $team_data['team_request'] = $this->Tournament_model->tournament_teams($league_id);
            $team_data['league_teams'] = $this->Tournament_model->get_league_teams($league_id);
            $team_data['league_schedule'] = $this->Tournament_model->get_league_schedule($league_id);
            $team_data['league_rules'] = $this->Tournament_model->get_league_rules($league_id);

            $this->load->view('header');
            $this->load->view('tournament_main', $team_data);
        } else {
            $this->index();
        }
    }

    public function team_admin($team_id) {
        if ($this->session->userdata('logged')) {
            $user_id = $this->session->userdata('user_id');
            $team_data['requests'] = $this->Team_model->get_player_request($team_id);
            $team_data['team_names'] = $this->Team_model->team_request($team_id);
            $team_data['captain'] = $this->Team_model->team_captain($team_id);
            $team_data['team_id'] = $team_id;
            $team_data['data'] = $this->Team_model->get_team($team_id);
            $team_data['opposition_team'] = $this->Team_model->get_match_teams($team_id);
            $team_data['team_schedule'] = $this->Team_model->get_team_schedule($team_id);
            $team_data['management_staff'] = $this->Team_model->get_team_management($team_id);
           
            $this->load->view('header');
            $this->load->view('team_admin', $team_data);
        } else {
            $this->index();
        }
    }

    public function choose_squad($team1, $team2, $match_id) {
        if ($this->session->userdata('logged')) {
            $this->load->view('header');
            $this->load->view('choose_squad');
        } else {
            $this->index();
        }
    }

   public function update_schedule() {
    $this->load->library('form_validation');

    // Set validation rules
    $this->form_validation->set_rules('match_id', 'Match ID', 'required|numeric');
    $this->form_validation->set_rules('team_id', 'Team ID', 'required|numeric');
    $this->form_validation->set_rules('team_one_id', 'Team One', 'required|numeric');
    $this->form_validation->set_rules('team_two_id', 'Team Two', 'required|numeric|differs[team_one_id]');
    $this->form_validation->set_rules('match_date', 'Match Date', 'required|regex_match[/^\d{4}-\d{2}-\d{2}$/]');
    $this->form_validation->set_rules('match_time', 'Match Time', 'required|regex_match[/^\d{2}:\d{2}$/]');
    $this->form_validation->set_rules('overs', 'Overs', 'required|numeric|greater_than[0]');
    $this->form_validation->set_rules('venue', 'Venue', 'required|trim|max_length[255]');
    $this->form_validation->set_rules('series', 'Series', 'required|trim|max_length[255]');
    $this->form_validation->set_rules('first_umpire', 'First Umpire', 'trim|max_length[100]');
    $this->form_validation->set_rules('second_umpire', 'Second Umpire', 'trim|max_length[100]');

    // Check if validation passes
    if ($this->form_validation->run() === FALSE) {
        $this->session->set_flashdata('error', validation_errors());
        redirect('Welcome/team_admin/' . $this->input->post('team_id'));
    }

    // Prepare data for update
    $data = [
        'team_one_id' => $this->input->post('team_one_id'),
        'team_two_id' => $this->input->post('team_two_id'),
        'match_date' => $this->input->post('match_date'),
        'match_time' => $this->input->post('match_time'),
        'overs' => $this->input->post('overs'),
        'series' => $this->input->post('series'),
        'location' => $this->input->post('venue'), // Maps 'venue' form input to 'location' column
        'umpire1' => $this->input->post('first_umpire') ?: NULL, // Maps 'first_umpire' to 'umpire1'
        'umpire2' => $this->input->post('second_umpire') ?: NULL // Maps 'second_umpire' to 'umpire2'
    ];

    // Update schedule in the database
    if ($this->Schedule_model->edit_schedule($this->input->post('match_id'), $data)) {
        $this->session->set_flashdata('success', 'Match schedule updated successfully');
    } else {
        $this->session->set_flashdata('error', 'Failed to update match schedule');
    }

    // Redirect back to team admin dashboard
    redirect('Welcome/team_admin/' . $this->input->post('team_id'));
}
    public function delete_schedule($match_id) {
 

    if (!is_numeric($match_id) || $match_id <= 0) {
        $this->session->set_flashdata('error', 'Invalid match ID.');
        redirect('Welcome/team_admin/' . $this->input->post('team_id'));
    }

    $team_id = $this->input->post('team_id');
    
    if (!$team_id) {
        $this->session->set_flashdata('error', 'Team ID is required.');
        redirect('Welcome/team_admin/' . $team_id);
    }

   

    if ($this->Schedule_model->check_toss_exists($match_id)) {
        $this->session->set_flashdata('error', 'Cannot delete match because the toss has already been entered.');
        redirect('Welcome/team_admin/' . $team_id);
    }

    $result = $this->Schedule_model->delete_schedule($match_id);
    if ($result) {
        $this->session->set_flashdata('success', 'Match deleted successfully.');
    } else {
        $this->session->set_flashdata('error', 'Failed to delete match.');
    }

    redirect('Welcome/team_admin/' . $team_id);
}
}