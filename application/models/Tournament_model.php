<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tournament_model extends CI_Model {

    /**
     * Add a new league if it doesn't already exist
     * @param array $data League data
     * @return mixed Insert ID if successful, 0 if exists, false on failure
     */
    public function add_league($data)
    {
        // Validate input data
        if (!isset($data['user_id']) || !is_numeric($data['user_id']) || 
            !isset($data['league_name']) || empty($data['league_name'])) {
            return false;
        }

        // Check if league already exists
        $this->db->where('user_id', $data['user_id']);
        $this->db->where('league_name', $data['league_name']);
        $query = $this->db->get('add_league');
        
        if ($query->num_rows() == 0) {
            $this->db->insert('add_league', $data);
            return $this->db->insert_id();
        }
        
        return 0;
    }

    /**
     * Get leagues by user ID
     * @param int $user_id
     * @return mixed Array of leagues or false
     */
    public function get_league($user_id)
    {
        if (!is_numeric($user_id)) {
            return false;
        }

        $this->db->where('user_id', $user_id);
        $query = $this->db->get('add_league');
        
        return ($query->num_rows() > 0) ? $query->result() : false;
    }

    /**
     * Get league information by ID
     * @param int $league_id
     * @return mixed Array of league data or false
     */
    public function league_information($league_id)
    {
        if (!is_numeric($league_id)) {
            return false;
        }

        $this->db->where('league_id', $league_id);
        $query = $this->db->get('add_league');

        return ($query->num_rows() == 1) ? $query->row_array() : false;
    }

    /**
     * Get tournament teams with status 0 (pending)
     * @param int $league_id
     * @return mixed Array of teams or false
     */
    public function tournament_teams($league_id)
    {
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

    /**
     * Accept team request to join league
     * @param int $team_id
     * @param int $league_id
     * @return bool True if successful
     */
    public function accept_request($team_id, $league_id)
    {
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

    /**
     * Reject team request
     * @param array $data Must contain team_id and league_id
     * @return bool True if successful
     */
    public function reject_team_request($data)
    {
        if (!isset($data['team_id']) || !is_numeric($data['team_id']) || 
            !isset($data['league_id']) || !is_numeric($data['league_id'])) {
            return false;
        }

        $this->db->where($data);
        $this->db->delete('league_teams');

        return ($this->db->affected_rows() > 0);
    }

    /**
     * Get all active teams in a league
     * @param int $league_id
     * @return mixed Array of teams or false
     */
    public function get_league_teams($league_id) 
    {
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

    /**
     * Get league schedule with team details
     * @param int $league_id
     * @return mixed Array of matches or false
     */
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
        ->where('add_schedule.league_id', $league_id)
        ->order_by('add_schedule.match_date', 'DESC')
        ->order_by('add_schedule.match_time', 'DESC');
        
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : false;
    }

    /**
     * Add league rules
     * @param array $data Rules data
     * @return mixed Insert ID or false
     */
    public function league_rules($data)
    {
        if (empty($data) || !isset($data['league_id']) || !is_numeric($data['league_id'])) {
            return false;
        }

        $this->db->insert('league_rules', $data);
        return $this->db->insert_id();
    }

    /**
     * Get league rules
     * @param int $league_id
     * @return mixed Array of rules or false
     */
    public function get_league_rules($league_id) 
    {
        if (!is_numeric($league_id)) {
            return false;
        }

        $this->db->where('league_id', $league_id);
        $query = $this->db->get('league_rules');

        return ($query->num_rows() > 0) ? $query->result() : false;
    }

    /**
     * Update league rules
     * @param int $rule_id
     * @param array $data
     * @return bool True if successful
     */
    public function update_rules($rule_id, $data)
    {
        if (!is_numeric($rule_id) || empty($data)) {
            return false;
        }

        $this->db->where('league_rules_id', $rule_id);
        return $this->db->update('league_rules', $data);
    }

    /**
     * Get league top scorer
     * @param int $league_id
     * @return mixed Object with player data or false
     */
    public function league_top_scorer($league_id)
    {
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

    /**
     * Get league top bowler
     * @param int $league_id
     * @return mixed Object with player data or false
     */
    public function league_top_bowler($league_id)
    {
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

    /**
     * Get league highest individual score
     * @param int $league_id
     * @return mixed Object with player data or false
     */
    public function league_highest_individual_score($league_id) 
    {
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

    /**
     * Get top 10 individual scorers
     * @param int $league_id
     * @return mixed Array of players or false
     */
    public function league_ten_individual_scorer($league_id)
    {
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

    /**
     * Get top 10 batsmen by total runs
     * @param int $league_id
     * @return mixed Array of players or false
     */
    public function get_top_10_batsmen($league_id) 
    {
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

    /**
     * Get top 10 bowlers by wickets
     * @param int $league_id
     * @return mixed Array of players or false
     */
    public function league_top_ten_bowler($league_id)
    {
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

    /**
     * Get highest wicket taker in a match
     * @param int $league_id
     * @return mixed Object with player data or false
     */
    public function league_highest_wicket_taker($league_id) 
    {
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

    /**
     * Get top 10 bowling performances
     * @param int $league_id
     * @return mixed Array of players or false
     */
    public function league_top_ten_bowler_of_match($league_id)
    {
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

    /**
     * Get highest team score in league
     * @param int $league_id
     * @return mixed Object with team data or false
     */
    public function get_highest_team_score($league_id) 
    {
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

    /**
     * Get lowest team score in league
     * @param int $league_id
     * @return mixed Object with team data or false
     */
    public function league_lowest_team_score($league_id) 
    {
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

    /**
     * Get top 5 team scores
     * @param int $league_id
     * @return mixed Array of teams or false
     */
    public function league_top_five_team_score($league_id)
    {
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

    /**
     * Get lowest 5 team scores
     * @param int $league_id
     * @return mixed Array of teams or false
     */
    public function league_lowest_five_score($league_id)
    {
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

    /**
     * Get tournament invitation data by email
     * @param string $email
     * @return mixed Array of leagues or null
     */
    public function invite_tournament($email) 
    {
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

    /**
     * Request to join a tournament
     * @param int $league_id
     * @param int $team_id
     * @return bool True if successful
     */
    public function join_tournament($league_id, $team_id)
    {
        // Validate inputs
        if (!is_numeric($league_id) || !is_numeric($team_id)) {
            $this->session->set_flashdata('message', 'Invalid league or team ID');
            $this->session->set_flashdata('message_type', 'error');
            return false;
        }

        // Check if already exists using query binding
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

    /**
     * Get detailed league team statistics
     * @param int $league_id
     * @return array Team statistics
     */
    public function league_teams($league_id) 
    {
        if (!is_numeric($league_id)) {
            return ['message' => 'Invalid league ID'];
        }

        // Get all active teams in the league
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

            // 1. Top Batsman (Most Total Runs)
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

            // 2. Best Individual Scorer (Highest Runs in a Single Match)
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

            // 3. Top Bowler (Most Total Wickets)
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

            // 4. Best Bowling Performance (Most Wickets in a Single Match + Given Runs)
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

    /**
     * Get match results with batting order details
     * @param int $league_id
     * @return mixed Array of match results or false
     */
    public function get_match_results_by_league_with_batting_order($league_id)
    {
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
}