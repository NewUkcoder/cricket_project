<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TournamentController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(['Team_model', 'Scorecard_model', 'Tournament_model', 'Player_model']);
        $this->load->helper(['form', 'url', 'security']);
        $this->load->library(['form_validation', 'session', 'user_agent']);
        $this->load->database();

        if (!$this->session->userdata('logged') || !$this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Please log in to continue.');
            redirect('Welcome/index');
        }

        $this->session->sess_regenerate(true);
    }

    public function add_league() {
        $this->form_validation->set_rules('league_name', 'League Name', 'required|trim|xss_clean|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('city', 'City', 'required|trim|xss_clean|max_length[100]');
        $this->form_validation->set_rules('country', 'Country', 'required|trim|xss_clean|max_length[100]');
        $this->form_validation->set_rules('venue', 'Venue', 'required|trim|xss_clean|max_length[100]');
        $this->form_validation->set_rules('overs', 'Overs', 'required|numeric|trim|xss_clean');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|xss_clean|regex_match[/^[0-9\-\+\(\)\s]+$/]');
        $this->form_validation->set_rules('season', 'Season', 'required|trim|xss_clean|max_length[50]');
        $this->form_validation->set_rules('match_type', 'Match Type', 'required|trim|xss_clean|max_length[50]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('header');
            $this->load->view('add_league_form');
            return;
        }

        $user_id = $this->session->userdata('user_id');
        $record = [
            'league_name' => ucwords($this->input->post('league_name', TRUE)),
            'city' => ucwords($this->input->post('city', TRUE)),
            'country' => ucwords($this->input->post('country', TRUE)),
            'venue' => ucwords($this->input->post('venue', TRUE)),
            'overs' => (int)$this->input->post('overs', TRUE),
            'phone_number' => $this->input->post('phone_number', TRUE),
            'season' => ucwords($this->input->post('season', TRUE)),
            'match_type' => ucwords($this->input->post('match_type', TRUE)),
            'user_id' => (int)$user_id,
            'created_at' => date('Y-m-d')
        ];

        $league_id = $this->Tournament_model->add_league($record);
        $this->session->set_flashdata($league_id ? 'success' : 'error', $league_id ? 'League added successfully.' : 'Failed to add league.');
        redirect('Welcome/landing_page');
    }

    public function accept_request($team_id, $league_id) {
        $league = $this->Tournament_model->league_information($league_id);
        if (!$league || $league['user_id'] != $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Unauthorized action.');
            redirect($this->agent->referrer());
        }

        $result = $this->Tournament_model->accept_request((int)$team_id, (int)$league_id);
        $this->session->set_flashdata($result ? 'success' : 'error', $result ? 'Team request accepted.' : 'Failed to accept team request.');
        redirect($this->agent->referrer());
    }

    public function reject_team_request($team_id, $league_id) {
        $league = $this->Tournament_model->league_information($league_id);
        if (!$league || $league['user_id'] != $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Unauthorized action.');
            redirect($this->agent->referrer());
        }

        $result = $this->Tournament_model->reject_team_request([
            'team_id' => (int)$team_id,
            'league_id' => (int)$league_id,
            'status' => 0
        ]);

        $this->session->set_flashdata($result ? 'success' : 'error', $result ? 'Team request rejected.' : 'Failed to reject team request.');
        redirect($this->agent->referrer());
    }

    public function add_rules() {
        $this->form_validation->set_rules('league_rule', 'League Rule', 'required|trim|xss_clean|min_length[5]');
        $this->form_validation->set_rules('league_id', 'League ID', 'required|numeric|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($this->agent->referrer());
        }

        $league_id = (int)$this->input->post('league_id', TRUE);
        $league = $this->Tournament_model->league_information($league_id);
        if (!$league || $league['user_id'] != $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Unauthorized action.');
            redirect($this->agent->referrer());
        }

        $record = [
            'league_rule' => ucwords($this->input->post('league_rule', TRUE)),
            'league_id' => $league_id,
            'user_id' => (int)$this->session->userdata('user_id')
        ];

        $result = $this->Tournament_model->league_rules($record);
        $this->session->set_flashdata($result ? 'success' : 'error', $result ? 'Rule added successfully.' : 'Failed to add rule.');
        redirect($this->agent->referrer());
    }

    public function update_rules() {
        $this->form_validation->set_rules('rule_id', 'Rule ID', 'required|numeric|trim');
        $this->form_validation->set_rules('league_rule', 'League Rule', 'required|trim|xss_clean|min_length[5]');
        $this->form_validation->set_rules('league_id', 'League ID', 'required|numeric|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($this->agent->referrer());
        }

        $rule_id = (int)$this->input->post('rule_id', TRUE);
        $league_id = (int)$this->input->post('league_id', TRUE);
        $league = $this->Tournament_model->league_information($league_id);
        if (!$league || $league['user_id'] != $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Unauthorized action.');
            redirect('Welcome/tournament_landing/' . $league_id);
        }

        $record = [
            'league_rule' => ucwords($this->input->post('league_rule', TRUE)),
            'league_id' => $league_id
        ];

        $result = $this->Tournament_model->update_rules($rule_id, $record);
        $this->session->set_flashdata($result ? 'success' : 'error', $result ? 'Rule updated successfully.' : 'Failed to update rule. Rule may not exist.');
        redirect('Welcome/tournament_landing/' . $league_id);
    }

    public function delete_rule($rule_id, $league_id) {
        $rule_id = (int)$rule_id;
        $league_id = (int)$league_id;
        $league = $this->Tournament_model->league_information($league_id);
        if (!$league || $league['user_id'] != $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Unauthorized action.');
            redirect('Welcome/tournament_landing/' . $league_id);
        }

        $result = $this->Tournament_model->delete_rule($rule_id, $league_id);
        $this->session->set_flashdata($result ? 'success' : 'error', $result ? 'Rule deleted successfully.' : 'Failed to delete rule. Rule may not exist.');
        redirect('Welcome/tournament_landing/' . $league_id);
    }

    public function league_top_ten_scorer($league_id) {
        $league_id = (int)$league_id;
        if (!$this->Tournament_model->league_exists($league_id)) {
            $this->session->set_flashdata('error', 'Invalid league.');
            redirect('dashboard');
        }

        $data = [
            'league' => $this->Tournament_model->league_information($league_id),
            'top_ten_scorer' => $this->Tournament_model->get_top_10_batsmen($league_id)
        ];

        $this->load->view('header');
        $this->load->view('league_top_ten_scorer', $data);
    }

    public function league_top_ten_bowler($league_id) {
        $league_id = (int)$league_id;
        if (!$this->Tournament_model->league_exists($league_id)) {
            $this->session->set_flashdata('error', 'Invalid league.');
            redirect('dashboard');
        }

        $data = [
            'league' => $this->Tournament_model->league_information($league_id),
            'top_ten_player' => $this->Tournament_model->league_top_ten_bowler($league_id)
        ];

        $this->load->view('header');
        $this->load->view('league_top_ten_bowler', $data);
    }

    public function league_ten_individual_scorer($league_id) {
        $league_id = (int)$league_id;
        if (!$this->Tournament_model->league_exists($league_id)) {
            $this->session->set_flashdata('error', 'Invalid league.');
            redirect('dashboard');
        }

        $data = [
            'league' => $this->Tournament_model->league_information($league_id),
            'top_ten_player' => $this->Tournament_model->league_ten_individual_scorer($league_id)
        ];

        $this->load->view('header');
        $this->load->view('league_ten_individual_scorer', $data);
    }

    public function league_top_ten_bowler_of_match($league_id) {
        $league_id = (int)$league_id;
        if (!$this->Tournament_model->league_exists($league_id)) {
            $this->session->set_flashdata('error', 'Invalid league.');
            redirect('dashboard');
        }

        $data = [
            'league' => $this->Tournament_model->league_information($league_id),
            'top_ten_player' => $this->Tournament_model->league_top_ten_bowler_of_match($league_id)
        ];

        $this->load->view('header');
        $this->load->view('league_top_ten_bowler_of_match', $data);
    }

    public function get_highest_team_score($league_id) {
        $league_id = (int)$league_id;
        if (!$this->Tournament_model->league_exists($league_id)) {
            $this->session->set_flashdata('error', 'Invalid league.');
            redirect('dashboard');
        }

        $data = [
            'league' => $this->Tournament_model->league_information($league_id),
            'top_ten_player' => $this->Tournament_model->get_highest_team_score($league_id)
        ];

        $this->load->view('header');
        $this->load->view('get_highest_team_score', $data);
    }

    public function league_top_five_team_score($league_id) {
        $league_id = (int)$league_id;
        if (!$this->Tournament_model->league_exists($league_id)) {
            $this->session->set_flashdata('error', 'Invalid league.');
            redirect('dashboard');
        }

        $data = [
            'league' => $this->Tournament_model->league_information($league_id),
            'top_five_teams' => $this->Tournament_model->league_top_five_team_score($league_id)
        ];

        $this->load->view('header');
        $this->load->view('league_top_five_team_score', $data);
    }

    public function league_lowest_five_score($league_id) {
        $league_id = (int)$league_id;
        if (!$this->Tournament_model->league_exists($league_id)) {
            $this->session->set_flashdata('error', 'Invalid league.');
            redirect('dashboard');
        }

        $data = [
            'league' => $this->Tournament_model->league_information($league_id),
            'top_five_teams' => $this->Tournament_model->league_lowest_five_score($league_id)
        ];

        $this->load->view('header');
        $this->load->view('league_lowest_five_score', $data);
    }

    public function join_tournament($team_id) {
        $team_id = (int)$team_id;
        $this->load->view('header');
        $this->load->view('join_tournament', ['team_id' => $team_id]);
    }

    public function find_tournament() {
        $this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|valid_email');
        $this->form_validation->set_rules('team_id', 'Team ID', 'required|numeric|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($this->agent->referrer());
        }

        $team_id = (int)$this->input->post('team_id', TRUE);
        $team = $this->Tournament_model->get_team($team_id);
        if (!$team || $team['user_id'] != $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Unauthorized access.');
            redirect('dashboard');
        }

        $search_query = $this->input->post('email', TRUE);
        $data = [
            'team_id' => $team_id,
            'tournament' => $this->Tournament_model->invite_tournament($search_query)
        ];

        $this->load->view('header');
        $this->load->view('join_tournament', $data);
    }

    public function tournament_team($league_id, $team_id) {
        $league_id = (int)$league_id;
        $team_id = (int)$team_id;

        if (!$this->Tournament_model->league_exists($league_id)) {
            $this->session->set_flashdata('error', 'Invalid league.');
             redirect('Welcome/team_admin/' . $team_id);
        }

        $team = $this->Tournament_model->get_team($team_id);
        if (!$team || $team['user_id'] != $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Unauthorized access.');
             redirect('Welcome/team_admin/' . $team_id);
        }

        $result = $this->Tournament_model->join_tournament($league_id, $team_id);
        if ($result) {
            $team_data = [
                'team_stats' => $this->Tournament_model->get_team_stats($team_id),
                'data' => $this->Tournament_model->get_team($team_id)
            ];
            $this->load->view('header');
             redirect('Welcome/team_admin/' . $team_id);
        } else {
            $this->session->set_flashdata('error', 'Failed to join tournament/you already sent request.');
             redirect('Welcome/team_admin/' . $team_id);
        }
    }
}