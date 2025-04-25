<?php
// Controller: ScheduleController.php

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
        if ($this->session->userdata('logged') != true) {
            redirect('Welcome/index');
        }
    }

    public function add_schedule() {
        $team1 = $this->input->post('team1');
        $team2 = $this->input->post('team2');
        $match_time = ucwords($this->input->post('match_time'));
        $match_date = ucwords($this->input->post('match_date'));
        
        if ($team1 == '' || $team2 == '' || $team1 == $team2) {
            $this->session->set_flashdata('error', 'Please Select Your team Correctly.');
            redirect('Welcome/enter_schedule');
        } else {
            $record = array(
                'team_one_id' => $team1,
                'team_two_id' => $team2,
                'user_id' => $this->session->userdata('user_id'),
                'match_time' => $match_time,
                'match_date' => $match_date,
                'match_type' => ucwords($this->input->post('match_type')),
                'overs' => ucwords($this->input->post('overs')),
                'league_id' => $this->input->post('league_id'),
                'location' => ucwords($this->input->post('location')),
                'series' => ucwords($this->input->post('series')),
                'umpire1' => ucwords($this->input->post('umpire1')),
                'umpire2' => ucwords($this->input->post('umpire2'))
            );
            $success = $this->Schedule_model->save_schedule($record, $team1, $team2, $match_date, $match_time);
            if ($success) {
                $this->session->set_flashdata('success', 'Match is added into Schedule List.');
            } else {
                $this->session->set_flashdata('error', 'A match with these teams already exists on the selected date and time.');
            }
            redirect('Welcome/team_admin/' . $team1);
        }
    }

    public function edit_schedule() {
        $schedule_id = $this->input->post('schedule_id');
        $team1 = $this->input->post('team1');
        $team2 = $this->input->post('team2');
        $match_time = ucwords($this->input->post('match_time'));
        $match_date = ucwords($this->input->post('match_date'));
        $league_id = $this->input->post('league_id');

        // Validation
        if (empty($schedule_id)) {
            $this->session->set_flashdata('error', 'Invalid schedule ID.');
            redirect('Welcome/tournament_main/' . $league_id);
        }

        if ($team1 == '' || $team2 == '' || $team1 == $team2) {
            $this->session->set_flashdata('error', 'Please select teams correctly.');
            redirect('Welcome/tournament_main/' . $league_id);
        }

      
        // Prepare record for update
        $record = array(
            'team_one_id' => $team1,
            'team_two_id' => $team2,
            'user_id' => $this->session->userdata('user_id'),
            'match_time' => $match_time,
            'match_date' => $match_date,
            'match_type' => ucwords($this->input->post('match_type')),
            'overs' => ucwords($this->input->post('overs')),
            'league_id' => $league_id,
            'location' => ucwords($this->input->post('location')),
            'series' => ucwords($this->input->post('series')),
            'umpire1' => ucwords($this->input->post('umpire1')),
            'umpire2' => ucwords($this->input->post('umpire2'))
        );

        // Update schedule
        $updated = $this->Schedule_model->update_schedule($schedule_id, $record, $team1, $team2, $match_date, $match_time);

        if ($updated) {
            $this->session->set_flashdata('success', 'Match schedule updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update match schedule. A match with these teams may already exist on the selected date and time.');
        }

        // Redirect to the same league dashboard page
        redirect('Welcome/tournament_main/' . $league_id);
    }

    public function delete_schedule($schedule_id, $league_id) {
        if (empty($schedule_id) || empty($league_id)) {
            $this->session->set_flashdata('error', 'Invalid schedule or league ID.');
            redirect('Welcome/tournament_main/' . $league_id);
        }

        // Check if match has started (toss exists)
        $toss_exists = $this->Schedule_model->check_toss($schedule_id);
        if ($toss_exists) {
            $this->session->set_flashdata('error', 'Cannot delete schedule: Match toss has already been recorded.');
            redirect('Welcome/tournament_main/' . $league_id);
        }

        // Delete schedule
        $deleted = $this->Schedule_model->delete_schedule($schedule_id);

        if ($deleted) {
            $this->session->set_flashdata('success', 'Match schedule deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete match schedule.');
        }

        // Redirect to the same league dashboard page
        redirect('Welcome/tournament_main/' . $league_id);
    }

    public function schedule() {
        $user_id = $this->session->userdata('user_id');
        $schedule_data['data'] = $this->Schedule_model->get_schedule($user_id);
        
        if ($schedule_data['data'] == 0) {
            $schedule_data['data'] = 0;
        }
        
        $this->load->view('header');
        $this->load->view('schedule', $schedule_data);
    }
}