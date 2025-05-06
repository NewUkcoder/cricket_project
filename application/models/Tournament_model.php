<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tournament_model extends CI_Model {

    public function add_league($data) {
        if (!isset($data['user_id']) || !is_numeric($data['user_id']) || 
            !isset($data['league_name']) || empty($data['league_name'])) {
            return false;
        }

        $this->db->where('user_id', $data['user_id']);
        $this->db->where('league_name', $data['league_name']);
        $query = $this->db->get('add_league');
        
        if ($query->num_rows() == 0) {
            $this->db->insert('add_league', $data);
            return $this->db->insert_id();
        }
        
        return 0;
    }

    public function league_exists($league_id) {
        if (!is_numeric($league_id)) {
            return false;
        }

        $this->db->where('league_id', $league_id);
        $query = $this->db->get('add_league');
        
        return ($query->num_rows() > 0);
    }

    public function get_league($user_id) {
        if (!is_numeric($user_id)) {
            return false;
        }

        $this->db->where('user_id', $user_id);
        $query = $this->db->get('add_league');
        
        return ($query->num_rows() > 0) ? $query->result() : false;
    }

    public function league_information($league_id) {
        if (!is_numeric($league_id)) {
            return false;
        }

        $this->db->where('league_id', $league_id);
        $query = $this->db->get('add_league');

        return ($query->num_rows() == 1) ? $query->row_array() : false;
    }

    public function tournament_teams($league_id) {
        if (!is_numeric($league_id)) {
            return false;
        }

        $this->db->select('add_team.team_name, add_team.team_id, add_team.city')
                 ->from('league_teams')
                 ->join('add_team', 'league_teams.team_id = add_team.team_id')
                 ->where('league_teams.league_id', $league_id)
                 ->where('league_teams.status', 0);
        
        $query = $this->db->get();
        return $query->result();
    }

    public function accept_request($team_id, $league_id) {
        if (!is_numeric($team_id) || !is_numeric($league_id)) {
            return false;
        }

        $data = ['status' => 1];
        
        $this->db->where('team_id', $team_id)
                 ->where('league_id', $league_id)
                 ->where('status', 0)
                 ->update('league_teams', $data);

        return ($this->db->affected_rows() > 0);
    }

    public function reject_team_request($data) {
        if (!isset($data['team_id']) || !is_numeric($data['team_id']) || 
            !isset($data['league_id']) || !is_numeric($data['league_id'])) {
            return false;
        }

        $this->db->where($data);
        $this->db->delete('league_teams');

        return ($this->db->affected_rows() > 0);
    }

    public function get_league_teams($league_id) {
        if (!is_numeric($league_id)) {
            return false;
        }

        $this->db->select('add_team.team_name, add_team.image_path, add_team.team_id')
                 ->from('add_team')
                 ->join('league_teams', 'add_team.team_id = league_teams.team_id')
                 ->where('league_teams.status', 1)
                 ->where('league_teams.league_id', $league_id);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_league_schedule($league_id)
{
    if (!is_numeric($league_id)) {
        return false;
    }

    $this->db->select('
        add_schedule.*, 
        team_one.team_name AS team_one_name, 
        team_one.image_path AS team_one_image, 
        team_two.team_name AS team_two_name, 
        team_two.image_path AS team_two_image
    ')
    ->from('add_schedule')
    ->join('add_team AS team_one', 'team_one.team_id = add_schedule.team_one_id', 'left')
    ->join('add_team AS team_two', 'team_two.team_id = add_schedule.team_two_id', 'left')
    ->join('match_result', 'match_result.match_id = add_schedule.match_id', 'left')
    ->where('add_schedule.league_id', $league_id)
    ->where('match_result.match_id IS NULL') // Only include matches without finalized results
    ->order_by('add_schedule.match_date', 'DESC')
    ->order_by('add_schedule.match_time', 'DESC');
    
    $query = $this->db->get();
    return ($query->num_rows() > 0) ? $query->result() : false;
}

public function get_completed_matches($league_id)
{
    if (!is_numeric($league_id)) {
        return false;
    }

    $this->db->select('
        add_schedule.*, 
        team_one.team_name AS team_one_name, 
        team_one.image_path AS team_one_image, 
        team_two.team_name AS team_two_name, 
        team_two.image_path AS team_two_image,
        match_result.result_statement
    ')
    ->from('add_schedule')
    ->join('add_team AS team_one', 'team_one.team_id = add_schedule.team_one_id', 'left')
    ->join('add_team AS team_two', 'team_two.team_id = add_schedule.team_two_id', 'left')
    ->join('match_result', 'match_result.match_id = add_schedule.match_id', 'inner')
    ->where('add_schedule.league_id', $league_id)
    ->order_by('add_schedule.match_date', 'DESC')
    ->order_by('add_schedule.match_time', 'DESC');
    
    $query = $this->db->get();
    return ($query->num_rows() > 0) ? $query->result() : false;
}

    public function league_rules($data) {
        if (empty($data) || !isset($data['league_id']) || !is_numeric($data['league_id'])) {
            return false;
        }

        $this->db->insert('league_rules', $data);
        return $this->db->insert_id();
    }

    public function get_league_rules($league_id) {
        if (!is_numeric($league_id)) {
            return false;
        }

        $this->db->where('league_id', $league_id);
        $query = $this->db->get('league_rules');

        return ($query->num_rows() > 0) ? $query->result() : false;
    }

    public function update_rules($rule_id, $data) {
        if (!is_numeric($rule_id) || empty($data) || !isset($data['league_id']) || !is_numeric($data['league_id'])) {
            return false;
        }

        $this->db->where('league_rules_id', $rule_id)
                 ->where('league_id', $data['league_id']);
        $this->db->update('league_rules', $data);

        return ($this->db->affected_rows() > 0);
    }

    public function delete_rule($rule_id, $league_id) {
        if (!is_numeric($rule_id) || !is_numeric($league_id)) {
            return false;
        }

        $this->db->where('league_rules_id', $rule_id)
                 ->where('league_id', $league_id);
        $this->db->delete('league_rules');

        return ($this->db->affected_rows() > 0);
    }

    public function league_top_scorer($league_id) {
        if (!is_numeric($league_id)) {
            return false;
        }

        $this->db->select('
            ap.playerName, 
            ap.player_id, 
            ap.image_path as player_image, 
            at.team_name, 
            at.team_id, 
            at.image_path as team_image, 
            SUM(bf.runs) as total_runs
        ')
        ->from('add_schedule asch')
        ->join('batting_first bf', 'asch.match_id = bf.match_id')
        ->join('add_player ap', 'bf.player_id = ap.player_id')
        ->join('add_team at', 'bf.batting_team = at.team_id')
        ->where('asch.league_id', $league_id)
        ->group_by('ap.player_id, ap.playerName, ap.image_path, at.team_name, at.team_id, at.image_path')
        ->order_by('total_runs', 'DESC')
        ->limit(1);
        
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row() : false;
    }

    public function league_top_bowler($league_id) {
        if (!is_numeric($league_id)) {
            return false;
        }

        $this->db->select('
            ap.player_id,
            MAX(ap.playerName) AS playerName,
            MAX(ap.image_path) AS player_image,
            MAX(at.team_name) AS team_name,
            MAX(at.team_id) AS team_id,
            MAX(at.image_path) AS team_image,
            SUM(bf.wickets) AS total_wickets
        ')
        ->from('add_schedule asch')
        ->join('bowling_first bf', 'asch.match_id = bf.match_id')
        ->join('add_player ap', 'bf.player_id = ap.player_id')
        ->join('add_team at', 'bf.bowling_team = at.team_id')
        ->where('asch.league_id', $league_id)
        ->group_by('ap.player_id')
        ->order_by('total_wickets', 'DESC')
        ->limit(1);
        
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row() : false;
    }

    public function league_highest_individual_score($league_id) {
        if (!is_numeric($league_id)) {
            return false;
        }

        $this->db->select('
            ap.player_id,
            MAX(ap.playerName) AS playerName,
            MAX(ap.image_path) AS player_image,
            MAX(at.team_name) AS team_name,
            MAX(at.team_id) AS team_id,
            MAX(at.image_path) AS team_image,
            MAX(bf.runs) AS highest_score
        ')
        ->from('add_schedule asch')
        ->join('batting_first bf', 'asch.match_id = bf.match_id')
        ->join('add_player ap', 'bf.player_id = ap.player_id')
        ->join('add_team at', 'bf.batting_team = at.team_id')
        ->where('asch.league_id', $league_id)
        ->group_by('ap.player_id')
        ->order_by('highest_score', 'DESC')
        ->limit(1);
        
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row() : false;
    }

    public function league_ten_individual_scorer($league_id) {
        if (!is_numeric($league_id)) {
            return false;
        }

        $this->db->select('
            ap.playerName, 
            ap.player_id, 
            ap.image_path AS player_image, 
            at.team_name, 
            at.team_id, 
            at.image_path AS team_image, 
            MAX(bf.runs) AS highest_score
        ')
        ->from('add_schedule asch')
        ->join('batting_first bf', 'asch.match_id = bf.match_id')
        ->join('add_player ap', 'bf.player_id = ap.player_id')
        ->join('add_team at', 'bf.batting_team = at.team_id')
        ->where('asch.league_id', $league_id)
        ->group_by('ap.player_id, ap.playerName, ap.image_path, at.team_name, at.team_id, at.image_path')
        ->order_by('highest_score', 'DESC')
        ->limit(10);
        
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : false;
    }

    public function get_top_10_batsmen($league_id) {
        if (!is_numeric($league_id)) {
            return false;
        }

        $this->db->select('
            ap.playerName, 
            ap.player_id, 
            ap.image_path as player_image, 
            at.team_name, 
            at.team_id, 
            at.image_path as team_image, 
            SUM(bf.runs) as total_runs
        ')
        ->from('add_schedule asch')
        ->join('batting_first bf', 'asch.match_id = bf.match_id')
        ->join('add_player ap', 'bf.player_id = ap.player_id')
        ->join('add_team at', 'bf.batting_team = at.team_id')
        ->where('asch.league_id', $league_id)
        ->group_by('ap.player_id, ap.playerName, ap.image_path, at.team_name, at.team_id, at.image_path')
        ->order_by('total_runs', 'DESC')
        ->limit(10);
        
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : false;
    }

    public function league_top_ten_bowler($league_id) {
        if (!is_numeric($league_id)) {
            return false;
        }

        $this->db->select('
            ap.playerName, 
            ap.player_id, 
            ap.image_path AS player_image, 
            at.team_name, 
            at.team_id, 
            at.image_path AS team_image, 
            SUM(bf.wickets) AS total_wickets
        ')
        ->from('add_schedule asch')
        ->join('bowling_first bf', 'asch.match_id = bf.match_id')
        ->join('add_player ap', 'bf.player_id = ap.player_id')
        ->join('add_team at', 'bf.bowling_team = at.team_id')
        ->where('asch.league_id', $league_id)
        ->group_by('ap.player_id, ap.playerName, ap.image_path, at.team_name, at.team_id, at.image_path')
        ->order_by('total_wickets', 'DESC')
        ->limit(10);
        
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : false;
    }

    public function league_highest_wicket_taker($league_id) {
        if (!is_numeric($league_id)) {
            return false;
        }

        $this->db->select('
            ap.playerName, 
            ap.player_id, 
            ap.image_path AS player_image, 
            at.team_name, 
            at.team_id, 
            at.image_path AS team_image, 
            fb.wickets, 
            fb.given_runs, 
            fb.match_id
        ')
        ->from('bowling_first fb')
        ->join('add_schedule asch', 'fb.match_id = asch.match_id')
        ->join('add_player ap', 'fb.player_id = ap.player_id')
        ->join('add_team at', 'fb.bowling_team = at.team_id')
        ->where('asch.league_id', $league_id)
        ->order_by('fb.wickets', 'DESC')
        ->order_by('fb.given_runs', 'ASC')
        ->limit(1);
        
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row() : false;
    }

    public function league_top_ten_bowler_of_match($league_id) {
        if (!is_numeric($league_id)) {
            return false;
        }

        $this->db->select('
            ap.playerName, 
            ap.player_id, 
            ap.image_path AS player_image, 
            at.team_name, 
            at.team_id, 
            at.image_path AS team_image, 
            fb.wickets, 
            fb.given_runs, 
            fb.match_id, 
            asch.match_date
        ')
        ->from('bowling_first fb')
        ->join('add_schedule asch', 'fb.match_id = asch.match_id')
        ->join('add_player ap', 'fb.player_id = ap.player_id')
        ->join('add_team at', 'fb.bowling_team = at.team_id')
        ->where('asch.league_id', $league_id)
        ->order_by('fb.wickets', 'DESC')
        ->order_by('fb.given_runs', 'ASC')
        ->order_by('asch.match_date', 'DESC')
        ->limit(10);
        
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : false;
    }

    public function get_highest_team_score($league_id) {
        if (!is_numeric($league_id)) {
            return false;
        }

        $this->db->select('
            at.team_name,
            at.team_id,
            at.image_path AS team_image,
            bf.total_runs AS highest_team_score,
            bf.t_overs,
            bf.wickets
        ')
        ->from('add_schedule asch')
        ->join('total_score bf', 'asch.match_id = bf.match_id')
        ->join('add_team at', 'bf.batting_team = at.team_id')
        ->where('asch.league_id', $league_id)
        ->order_by('bf.total_runs', 'DESC')
        ->limit(1);
        
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row() : false;
    }

    public function league_lowest_team_score($league_id) {
        if (!is_numeric($league_id)) {
            return false;
        }

        $this->db->select('
            at.team_name,
            at.team_id,
            at.image_path AS team_image,
            bf.total_runs AS highest_team_score,
            bf.t_overs,
            bf.wickets
        ')
        ->from('add_schedule asch')
        ->join('total_score bf', 'asch.match_id = bf.match_id')
        ->join('add_team at', 'bf.batting_team = at.team_id')
        ->where('asch.league_id', $league_id)
        ->order_by('bf.total_runs', 'ASC')
        ->limit(1);
        
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row() : false;
    }

    public function league_top_five_team_score($league_id) {
        if (!is_numeric($league_id)) {
            return false;
        }

        $this->db->select('
            at.team_name, 
            at.team_id, 
            at.image_path AS team_image, 
            MAX(bf.total_runs) AS highest_team_score, 
            bf.t_overs, 
            bf.wickets, 
            asch.match_id
        ')
        ->from('add_schedule asch')
        ->join('total_score bf', 'asch.match_id = bf.match_id')
        ->join('add_team at', 'bf.batting_team = at.team_id')
        ->where('asch.league_id', $league_id)
        ->group_by('bf.batting_team, at.team_name, at.team_id, at.image_path, bf.t_overs, bf.wickets, asch.match_id')
        ->order_by('highest_team_score', 'DESC')
        ->limit(5);
        
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : false;
    }

    public function league_lowest_five_score($league_id) {
        if (!is_numeric($league_id)) {
            return false;
        }

        $this->db->select('
            at.team_name, 
            at.team_id, 
            at.image_path AS team_image, 
            MAX(bf.total_runs) AS highest_team_score, 
            bf.t_overs, 
            bf.wickets, 
            asch.match_id
        ')
        ->from('add_schedule asch')
        ->join('total_score bf', 'asch.match_id = bf.match_id')
        ->join('add_team at', 'bf.batting_team = at.team_id')
        ->where('asch.league_id', $league_id)
        ->group_by('bf.batting_team, at.team_name, at.team_id, at.image_path, bf.t_overs, bf.wickets, asch.match_id')
        ->order_by('highest_team_score', 'ASC')
        ->limit(5);
        
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : false;
    }

    public function invite_tournament($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return null;
        }

        $this->db->select('add_league.league_name, add_league.league_id')
                 ->from('users')
                 ->join('add_league', 'add_league.user_id = users.user_id')
                 ->where('users.email', $email);
        
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : null;
    }

    public function join_tournament($league_id, $team_id) {
        if (!is_numeric($league_id) || !is_numeric($team_id)) {
            $this->session->set_flashdata('message', 'Invalid league or team ID');
            $this->session->set_flashdata('message_type', 'error');
            return false;
        }

        $exists = $this->db->where('league_id', $league_id)
                          ->where('team_id', $team_id)
                          ->get('league_teams')
                          ->row();

        if ($exists) {
            $this->session->set_flashdata('message', 'Team is already in this league list.');
            $this->session->set_flashdata('message_type', 'error');
            return false;
        }

        $data = [
            'league_id' => $league_id,
            'team_id' => $team_id,
            'status' => 0,
            'joined_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('league_teams', $data);
        
        $this->session->set_flashdata('message', 'Request to join this league is sent successfully');
        $this->session->set_flashdata('message_type', 'success');
        return true;
    }

    public function league_teams($league_id) {
        if (!is_numeric($league_id)) {
            return ['message' => 'Invalid league ID'];
        }

        $teams = $this->db->select('at.team_id, at.team_name, at.image_path AS team_image')
                         ->from('league_teams lt')
                         ->join('add_team at', 'lt.team_id = at.team_id')
                         ->where('lt.league_id', $league_id)
                         ->where('lt.status', 1)
                         ->get()
                         ->result_array();

        if (empty($teams)) {
            return ['message' => 'No active teams found for this league'];
        }

        $results = [];

        foreach ($teams as $team) {
            $team_id = $team['team_id'];
            $team_info = [
                'team_id' => $team['team_id'],
                'team_name' => $team['team_name'],
                'team_image' => $team['team_image']
            ];

            $top_scorer = $this->db->select('bf.player_id, ap.playerName as player_name, ap.image_path as player_image, SUM(bf.runs) AS total_runs')
                                  ->from('batting_first bf')
                                  ->join('add_schedule s', 'bf.match_id = s.match_id')
                                  ->join('add_player ap', 'bf.player_id = ap.player_id')
                                  ->where('s.league_id', $league_id)
                                  ->where('bf.batting_team', $team_id)
                                  ->group_by('bf.player_id, ap.playerName, ap.image_path')
                                  ->order_by('total_runs', 'DESC')
                                  ->limit(1)
                                  ->get()
                                  ->row_array();

            $highest_individual_score = $this->db->select('bf.player_id, ap.playerName as player_name, ap.image_path as player_image, MAX(bf.runs) AS runs')
                                                ->from('batting_first bf')
                                                ->join('add_schedule s', 'bf.match_id = s.match_id')
                                                ->join('add_player ap', 'bf.player_id = ap.player_id')
                                                ->where('s.league_id', $league_id)
                                                ->where('bf.batting_team', $team_id)
                                                ->group_by('bf.player_id, ap.playerName, ap.image_path')
                                                ->order_by('runs', 'DESC')
                                                ->limit(1)
                                                ->get()
                                                ->row_array();

            $top_bowler_data = $this->db->select('bf.player_id, ap.playerName as player_name, ap.image_path as player_image, SUM(bf.wickets) AS total_wickets')
                                       ->from('bowling_first bf')
                                       ->join('add_schedule s', 'bf.match_id = s.match_id')
                                       ->join('add_player ap', 'bf.player_id = ap.player_id')
                                       ->where('s.league_id', $league_id)
                                       ->where('bf.bowling_team', $team_id)
                                       ->group_by('bf.player_id, ap.playerName, ap.image_path')
                                       ->order_by('total_wickets', 'DESC')
                                       ->limit(1)
                                       ->get()
                                       ->row_array();

            $best_bowling_data = $this->db->select('
                bf.player_id, 
                ap.playerName as player_name, 
                ap.image_path as player_image, 
                bf.wickets, 
                bf.given_runs,
                CONCAT(bf.wickets, "/", bf.given_runs) AS bowling_figures
            ')
            ->from('bowling_first bf')
            ->join('add_schedule s', 'bf.match_id = s.match_id')
            ->join('add_player ap', 'bf.player_id = ap.player_id')
            ->where('s.league_id', $league_id)
            ->where('bf.bowling_team', $team_id)
            ->order_by('bf.wickets', 'DESC')
            ->order_by('bf.given_runs', 'ASC')
            ->limit(1)
            ->get()
            ->row_array();

            $results[] = [
                'team_info' => $team_info,
                'top_scorer' => $top_scorer,
                'highest_individual_score' => $highest_individual_score,
                'top_bowler' => $top_bowler_data ? $top_bowler_data['player_name'] : null,
                'top_bowler_image' => $top_bowler_data ? $top_bowler_data['player_image'] : null,
                'top_bowler_wickets' => $top_bowler_data ? $top_bowler_data['total_wickets'] : null,
                'best_bowler' => $best_bowling_data ? $best_bowling_data['player_name'] : null,
                'best_bowling_image' => $best_bowling_data ? $best_bowling_data['player_image'] : null,
                'best_bowling_figures' => $best_bowling_data ? $best_bowling_data['bowling_figures'] : null
            ];
        }

        return $results;
    }

    public function get_match_results_by_league_with_batting_order($league_id) {
        if (!is_numeric($league_id)) {
            return false;
        }

        $this->db->select('
            add_schedule.match_id,
            add_schedule.match_date,
            add_schedule.match_time,
            MAX(match_result.win_team) AS win_team,
            MAX(match_result.lost_team) AS lost_team,
            MAX(match_result.result_statement) AS result_statement,
            SUM(CASE WHEN total_score.batting_order = 1 THEN total_score.total_runs ELSE 0 END) AS total_runs_batting_order_1,
            SUM(CASE WHEN total_score.batting_order = 2 THEN total_score.total_runs ELSE 0 END) AS total_runs_batting_order_2,
            GROUP_CONCAT(CASE WHEN total_score.batting_order = 1 THEN total_score.batting_team ELSE NULL END) AS batting_team_batting_order_1,
            GROUP_CONCAT(CASE WHEN total_score.batting_order = 2 THEN total_score.batting_team ELSE NULL END) AS batting_team_batting_order_2,
            SUM(CASE WHEN total_score.batting_order = 1 THEN total_score.t_overs ELSE 0 END) AS total_overs_batting_order_1,
            SUM(CASE WHEN total_score.batting_order = 2 THEN total_score.t_overs ELSE 0 END) AS total_overs_batting_order_2,
            SUM(CASE WHEN total_score.batting_order = 1 THEN total_score.wickets ELSE 0 END) AS wickets_batting_order_1,
            SUM(CASE WHEN total_score.batting_order = 2 THEN total_score.wickets ELSE 0 END) AS wickets_batting_order_2,
            MAX(win_team.team_name) AS win_team_name,
            MAX(win_team.image_path) AS win_team_image,
            MAX(lost_team.team_name) AS lost_team_name,
            MAX(lost_team.image_path) AS lost_team_image
        ')
        ->from('add_schedule')
        ->join('match_result', 'add_schedule.match_id = match_result.match_id', 'inner')
        ->join('total_score', 'add_schedule.match_id = total_score.match_id', 'left')
        ->join('add_team AS win_team', 'match_result.win_team = win_team.team_id', 'inner')
        ->join('add_team AS lost_team', 'match_result.lost_team = lost_team.team_id', 'inner')
        ->where('add_schedule.league_id', $league_id)
        ->group_by('add_schedule.match_id');
        
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : false;
    }

    public function get_team($team_id) {
        if (!is_numeric($team_id)) {
            return false;
        }

        $this->db->where('team_id', $team_id);
        $query = $this->db->get('add_team');

        return ($query->num_rows() == 1) ? $query->row_array() : false;
    }

    public function get_team_stats($team_id) {
        if (!is_numeric($team_id)) {
            return false;
        }

        $this->db->select('
            at.team_name,
            at.team_id,
            at.image_path AS team_image,
            COUNT(DISTINCT lt.league_id) AS total_leagues,
            SUM(CASE WHEN mr.win_team = at.team_id THEN 1 ELSE 0 END) AS matches_won,
            SUM(CASE WHEN mr.lost_team = at.team_id THEN 1 ELSE 0 END) AS matches_lost
        ')
        ->from('add_team at')
        ->join('league_teams lt', 'at.team_id = lt.team_id AND lt.status = 1', 'left')
        ->join('add_schedule s', 's.league_id = lt.league_id', 'left')
        ->join('match_result mr', 's.match_id = mr.match_id AND (mr.win_team = at.team_id OR mr.lost_team = at.team_id)', 'left')
        ->where('at.team_id', $team_id)
        ->group_by('at.team_id, at.team_name, at.image_path');
        
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row_array() : false;
    }

    public function team_information($conditions, $table = 'add_team') {
        if (empty($conditions) || !is_array($conditions)) {
            return false;
        }

        $this->db->where($conditions);
        $query = $this->db->get($table);

        return ($query->num_rows() > 0) ? $query->result() : false;
    }

    public function get_player($conditions, $table = 'add_player') {
        if (empty($conditions) || !is_array($conditions)) {
            return false;
        }

        $this->db->where($conditions);
        $query = $this->db->get($table);

        return ($query->num_rows() > 0) ? $query->result() : false;
    }

public function get_points_table($league_id) {
    if (!is_numeric($league_id)) {
        return [];
    }

    $query = $this->db->query("
        SELECT 
            t.team_id,
            t.team_name,
            t.image_path AS team_image,
            COUNT(DISTINCT CASE WHEN mr.match_id IS NOT NULL THEN s.match_id END) AS matches_played,
            SUM(CASE WHEN mr.win_team = t.team_id THEN 1 ELSE 0 END) AS wins,
            SUM(CASE WHEN mr.lost_team = t.team_id THEN 1 ELSE 0 END) AS losses,
            SUM(CASE WHEN mr.result_statement = 'Draw' THEN 1 ELSE 0 END) AS draws,
            SUM(CASE WHEN mr.result_statement = 'No Result' THEN 1 ELSE 0 END) AS no_results,
            SUM(
                CASE 
                    WHEN mr.win_team = t.team_id THEN 2 
                    WHEN mr.result_statement IN ('Draw', 'No Result') THEN 1 
                    ELSE 0 
                END
            ) AS points,
            COALESCE(
                (SUM(ts.total_runs) / NULLIF(SUM(ts.t_overs), 0)) - 
                (SUM(opp_ts.total_runs) / NULLIF(SUM(opp_ts.t_overs), 0)),
                0
            ) AS net_run_rate
        FROM 
            add_team t
        JOIN 
            league_teams lt ON t.team_id = lt.team_id AND lt.status = 1
        LEFT JOIN 
            add_schedule s ON (s.team_one_id = t.team_id OR s.team_two_id = t.team_id) AND s.league_id = ?
        LEFT JOIN 
            match_result mr ON s.match_id = mr.match_id AND 
            (mr.win_team IS NOT NULL OR mr.lost_team IS NOT NULL OR mr.result_statement IN ('Draw', 'No Result'))
        LEFT JOIN 
            total_score ts ON ts.match_id = s.match_id AND ts.batting_team = t.team_id
        LEFT JOIN 
            total_score opp_ts ON opp_ts.match_id = s.match_id AND opp_ts.batting_team != t.team_id
        WHERE 
            lt.league_id = ?
        GROUP BY 
            t.team_id, t.team_name, t.image_path
        ORDER BY 
            points DESC,
            net_run_rate DESC
    ", [$league_id, $league_id]);

    $result = $query->result();

    // Format NRR to 3 decimal places
    foreach ($result as &$team) {
        $team->net_run_rate = number_format((float)$team->net_run_rate, 3);
    }

    return $result;
}

public function get_team_scores($league_id)
{
    if (!is_numeric($league_id)) {
        return false;
    }

    // Initialize result array
    $team_scores = [];

    // Fetch all teams in the league via junction table
    $this->db->select('add_team.team_id, add_team.team_name')
             ->from('add_team')
             ->join('league_teams', 'league_teams.team_id = add_team.team_id')
             ->where('league_teams.league_id', $league_id);
    $teams = $this->db->get()->result_array();

    if (empty($teams)) {
        return $team_scores;
    }

    foreach ($teams as $team) {
        $team_id = $team['team_id'];
        $team_name = $team['team_name'];

        // Count matches played (where team is team_one or team_two and match_result exists)
        $this->db->from('add_schedule')
                 ->join('match_result', 'match_result.match_id = add_schedule.match_id', 'inner')
                 ->where('add_schedule.league_id', $league_id)
                 ->where("(add_schedule.team_one_id = $team_id OR add_schedule.team_two_id = $team_id)");
        $matches_played = $this->db->count_all_results();

        // Calculate points (2 points for each win)
        $this->db->from('add_schedule')
                 ->join('match_result', 'match_result.match_id = add_schedule.match_id', 'inner')
                 ->where('add_schedule.league_id', $league_id)
                 ->where('match_result.win_team', $team_id);
        $wins = $this->db->count_all_results();
        $points = $wins * 2;

        $team_scores[$team_id] = [
            'team_id' => $team_id,
            'team_name' => $team_name,
            'matches_played' => $matches_played,
            'points' => $points
        ];
    }

    return $team_scores;
}
}