<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TournamentController extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load necessary libraries and helpers
        $this->load->model('Team_model');
        $this->load->model('Scorecard_model');
        $this->load->model('Tournament_model');
        $this->load->helper(array('form', 'url', 'security')); // Load security helper
        $this->load->library(array('form_validation', 'session', 'user_agent'));

        // Load database
        $this->load->database();

        // Check if user is logged in
        if (!$this->session->userdata('logged') || !$this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Please log in to continue.');
            redirect('Welcome/index');
        }

        // Regenerate session ID to prevent session fixation
        $this->session->regenerate_id();
    }

    public function add_league() {
        // Validate user permission (example: only organizers can add leagues)
        if (!$this->is_organizer()) {
            $this->session->set_flashdata('error', 'Unauthorized access.');
            redirect('dashboard');
        }

        // Set form validation rules
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
            $this->load->view('add_league_form'); // Load form view
            return;
        }

        $user_id = $this->session->userdata('user_id');

        // Sanitize and prepare data
        $record = array(
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
        );

        // Insert league into database
        $league_id = $this->Tournament_model->add_league($record);

        if ($league_id) {
            $this->session->set_flashdata('success', 'League added successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to add league.');
        }

        // Fetch team and player data securely
        $team_data = array(
            'team' => $this->Team_model->team_information(array('user_id' => $user_id), 'add_team') ?: 0,
            'data' => $this->Player_model->get_player(array('user_id' => $user_id), 'add_player') ?: 0,
            'tournament' => $this->Tournament_model->get_league($user_id) ?: 0
        );

        $this->load->view('header');
        $this->load->view('landing_page', $team_data);
    }

    public function accept_request($team_id, $league_id) {
        // Validate inputs
        $team_id = (int)$team_id;
        $league_id = (int)$league_id;

        // Check if user has permission to accept requests
        if (!$this->has_league_permission($league_id)) {
            $this->session->set_flashdata('error', 'Unauthorized action.');
            redirect($this->agent->referrer());
        }

        // Perform action securely
        $result = $this->Tournament_model->accept_request($team_id, $league_id);

        if ($result) {
            $this->session->set_flashdata('success', 'Team request accepted.');
        } else {
            $this->session->set_flashdata('error', 'Failed to accept team request.');
        }

        redirect($this->agent->referrer());
    }

    public function reject_team_request($team_id, $league_id) {
        // Validate inputs
        $team_id = (int)$team_id;
        $league_id = (int)$league_id;

        // Check permission
        if (!$this->has_league_permission($league_id)) {
            $this->session->set_flashdata('error', 'Unauthorized action.');
            redirect($this->agent->referrer());
        }

        // Perform action
        $result = $this->Tournament_model->reject_team_request(array(
            'team_id' => $team_id,
            'league_id' => $league_id,
            'status' => 0
        ));

        if ($result) {
            $this->session->set_flashdata('success', 'Team request rejected.');
        } else {
            $this->session->set_flashdata('error', 'Failed to reject team request.');
        }

        redirect($this->agent->referrer());
    }

    public function add_rules() {
        // Validate permission
        if (!$this->is_organizer()) {
            $this->session->set_flashdata('error', 'Unauthorized access.');
            redirect($this->agent->referrer());
        }

        // Set form validation rules
        $this->form_validation->set_rules('league_rule', 'League Rule', 'required|trim|xss_clean|min_length[5]');
        $this->form_validation->set_rules('league_id', 'League ID', 'required|numeric|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($this->agent->referrer());
        }

        $user_id = $this->session->userdata('user_id');

        // Prepare data
        $record = array(
            'league_rule' => ucwords($this->input->post('league_rule', TRUE)),
            'league_id' => (int)$this->input->post('league_id', TRUE),
            'user_id' => (int)$user_id
        );

        // Add rules
        $result = $this->Tournament_model->league_rules($record);

        if ($result) {
            $this->session->set_flashdata('success', 'Rule added successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to add rule.');
        }

        redirect($this->agent->referrer());
    }

    public function update_rules() {
        // Validate permission
        if (!$this->is_organizer()) {
            $this->session->set_flashdata('error', 'Unauthorized access.');
            redirect($this->agent->referrer());
        }

        // Set form validation rules
        $this->form_validation->set_rules('rule_id', 'Rule ID', 'required|numeric|trim');
        $this->form_validation->set_rules('league_rule', 'League Rule', 'required|trim|xss_clean|min_length[5]');
        $this->form_validation->set_rules('league_id', 'League ID', 'required|numeric|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($this->agent->referrer());
        }

        // Prepare data
        $rule_id = (int)$this->input->post('rule_id', TRUE);
        $record = array(
            'league_rule' => ucwords($this->input->post('league_rule', TRUE)),
            'league_id' => (int)$this->input->post('league_id', TRUE)
        );

        // Update rules
        $result = $this->Tournament_model->update_rules($rule_id, $record);

        if ($result) {
            $this->session->set_flashdata('success', 'Rule updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update rule.');
        }

        redirect($this->agent->referrer());
    }

    public function league_top_ten_scorer($league_id) {
        $league_id = (int)$league_id;

        // Verify league exists and user has access
        if (!$this->Tournament_model->league_exists($league_id)) {
            $this->session->set_flashdata('error', 'Invalid league.');
            redirect('dashboard');
        }

        $team_data = array(
            'league' => $this->Tournament_model->league_information($league_id),
            'top_ten_scorer' => $this->Tournament_model->get_top_10_batsmen($league_id)
        );

        $this->load->view('header');
        $this->load->view('league_top_ten_scorer', $team_data);
    }

    public function league_top_ten_bowler($league_id) {
        $league_id = (int)$league_id;

        // Verify league exists and user has access
        if (!$this->Tournament_model->league_exists($league_id)) {
            $this->session->set_flashdata('error', 'Invalid league.');
            redirect('dashboard');
        }

        $team_data = array(
            'league' => $this->Tournament_model->league_information($league_id),
            'top_ten_player' => $this->Tournament_model->league_top_ten_bowler($league_id)
        );

        $this->load->view('header');
        $this->load->view('league_top_ten_bowler', $team_data);
    }

    public function league_ten_individual_scorer($league_id) {
        $league_id = (int)$league_id;

        // Verify league exists and user has access
        if (!$this->Tournament_model->league_exists($league_id)) {
            $this->session->set_flashdata('error', 'Invalid league.');
            redirect('dashboard');
        }

        $team_data = array(
            'league' => $this->Tournament_model->league_information($league_id),
            'top_ten_player' => $this->Tournament_model->league_ten_individual_scorer($league_id)
        );

        $this->load->view('header');
        $this->load->view('league_ten_individual_scorer', $team_data);
    }

    public function league_top_ten_bowler_of_match($league_id) {
        $league_id = (int)$league_id;

        // Verify league exists and user has access
        if (!$this->Tournament_model->league_exists($league_id)) {
            $this->session->set_flashdata('error', 'Invalid league.');
            redirect('dashboard');
        }

        $team_data = array(
            'league' => $this->Tournament_model->league_information($league_id),
            'top_ten_player' => $this->Tournament_model->league_top_ten_bowler_of_match($league_id)
        );

        $this->load->view('header');
        $this->load->view('league_top_ten_bowler_of_match', $team_data);
    }

    public function get_highest_team_score($league_id) {
        $league_id = (int)$league_id;

        // Verify league exists and user has access
        if (!$this->Tournament_model->league_exists($league_id)) {
            $this->session->set_flashdata('error', 'Invalid league.');
            redirect('dashboard');
        }

        $team_data = array(
            'league' => $this->Tournament_model->league_information($league_id),
            'top_ten_player' => $this->Tournament_model->get_highest_team_score($league_id)
        );

        $this->load->view('header');
        $this->load->view('get_highest_team_score', $team_data);
    }

    public function league_top_five_team_score($league_id) {
        $league_id = (int)$league_id;

        // Verify league exists and user has access
        if (!$this->Tournament_model->league_exists($league_id)) {
            $this->session->set_flashdata('error', 'Invalid league.');
            redirect('dashboard');
        }

        $team_data = array(
            'league' => $this->Tournament_model->league_information($league_id),
            'top_five_teams' => $this->Tournament_model->league_top_five_team_score($league_id)
        );

        $this->load->view('header');
        $this->load->view('league_top_five_team_score', $team_data);
    }

    public function league_lowest_five_score($league_id) {
        $league_id = (int)$league_id;

        // Verify league exists and user has access
        if (!$this->Tournament_model->league_exists($league_id)) {
            $this->session->set_flashdata('error', 'Invalid league.');
            redirect('dashboard');
        }

        $team_data = array(
            'league' => $this->Tournament_model->league_information($league_id),
            'top_five_teams' => $this->Tournament_model->league_lowest_five_score($league_id)
        );

        $this->load->view('header');
        $this->load->view('league_lowest_five_score', $team_data);
    }

    public function join_tournament($team_id) {
        $team_id = (int)$team_id;

        // Verify team exists and user has permission
        if (!$this->Team_model->team_exists($team_id) || !$this->has_team_permission($team_id)) {
            $this->session->set_flashdata('error', 'Invalid team or unauthorized access.');
            redirect('dashboard');
        }

        $team_data = array('team_id' => $team_id);

        $this->load->view('header');
        $this->load->view('join_tournament', $team_data);
    }

    public function find_tournament() {
        // Set form validation rules
        $this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|valid_email');
        $this->form_validation->set_rules('team_id', 'Team ID', 'required|numeric|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($this->agent->referrer());
        }

        $search_query = $this->input->post('email', TRUE);
        $team_id = (int)$this->input->post('team_id', TRUE);

        // Verify team access
        if (!$this->has_team_permission($team_id)) {
            $this->session->set_flashdata('error', 'Unauthorized access.');
            redirect('dashboard');
        }

        $data = array(
            'team_id' => $team_id,
            'tournament' => $this->Tournament_model->invite_tournament($search_query)
        );

        $this->load->view('header');
        $this->load->view('join_tournament', $data);
    }

    public function tournament_team($league_id, $team_id) {
        $league_id = (int)$league_id;
        $team_id = (int)$team_id;

        // Verify permissions
        if (!$this->Tournament_model->league_exists($league_id) || !$this->has_team_permission($team_id)) {
            $this->session->set_flashdata('error', 'Invalid league or team.');
            redirect('dashboard');
        }

        $result = $this->Tournament_model->join_tournament($league_id, $team_id);

        if ($result) {
            $team_data = array(
                'team_stats' => $this->Team_model->get_team_stats($team_id),
                'data' => $this->Team_model->get_team($team_id)
            );

            $this->load->view('header');
            $this->load->view('team_profile', $team_data);
        } else {
            $this->session->set_flashdata('error', 'Failed to join tournament.');
            redirect('dashboard');
        }
    }

    // Helper method to check if user is an organizer
    private function is_organizer() {
        // Implement logic to check if user has organizer role
        return $this->session->userdata('role') === 'organizer';
    }

    // Helper method to check league permission
    private function has_league_permission($league_id) {
        // Check if user owns the league or has admin rights
        $league = $this->Tournament_model->league_information($league_id);
        return $league && $league['user_id'] == $this->session->userdata('user_id');
    }

    // Helper method to check team permission
    private function has_team_permission($team_id) {
        // Check if user owns the team
        $team = $this->Team_model->get_team($team_id);
        return $team && $team['user_id'] == $this->session->userdata('user_id');
    }
}