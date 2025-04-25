
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team_model extends CI_Model {

    public function save_image($data) {
        $this->db->insert('add_team', $data);
    }

    public function get_team($team_id) {
        $this->db->select('users.user_id, users.email, add_team.*');
        $this->db->from('users');
        $this->db->join('add_team', 'add_team.user_id = users.user_id');
        $this->db->where('add_team.team_id', $team_id);
        $query = $this->db->get();
        
        return $query->row_array();
    }

    public function team_information($data) {
        $this->db->where($data);
        $query = $this->db->get('add_team');
        
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    public function add_fixture($team_one_id, $team_two_id) {
        $this->db->select('
            t1.team_id as team_one_id, 
            t1.team_name as team_one_name, 
            t1.image_path as team_one_image,
            t2.team_id as team_two_id, 
            t2.team_name as team_two_name, 
            t2.image_path as team_two_image
        ');
        $this->db->from('add_team t1');
        $this->db->join('add_team t2', 't1.team_id != t2.team_id', 'inner');
        $this->db->where('t1.team_id', $team_one_id);
        $this->db->where('t2.team_id', $team_two_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $data = [
                'team_one' => [
                    'team_id' => $result['team_one_id'],
                    'team_name' => $result['team_one_name'],
                    'image_path' => $result['team_one_image']
                ],
                'team_two' => [
                    'team_id' => $result['team_two_id'],
                    'team_name' => $result['team_two_name'],
                    'image_path' => $result['team_two_image']
                ]
            ];
            return $data;
        } else {
            return null;
        }
    }

    public function get_player_request($team_id) {
        $this->db->select('
            add_player.player_id,
            add_player.playerName,
            add_player.player_role, 
            add_player.image_path, 
            player_team.*');
        $this->db->from('player_team');
        $this->db->join('add_player', 'add_player.player_id = player_team.player_id');
        $this->db->where('player_team.team_id', $team_id);
        $this->db->where('player_team.status', 0);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function accept_request($player_id, $team_id) {
        $data = array(
            'status' => 1
        );
        
        $this->db->where('player_id', $player_id)
                 ->where('team_id', $team_id)
                 ->where('status', 0)
                 ->update('player_team', $data);
        
        if ($this->db->affected_rows() > 0) {
            echo "Record updated successfully.";
        } else {
            echo "No records updated.";
        }
    }

    public function get_squad($team_id) {
        $this->db->select('
            add_player.player_id,
            add_player.playerName,
            add_player.player_role, 
            add_player.image_path, 
            player_team.*');
        $this->db->from('player_team');
        $this->db->join('add_player', 'add_player.player_id = player_team.player_id');
        $this->db->where('player_team.team_id', $team_id);
        $this->db->where('player_team.status', 1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function delete_player_request($data) {
        $this->db->where($data);
        $this->db->delete('player_team');
        
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_team_stats($team_id) {
        $this->db->select('
            COUNT(*) AS total_matches,
            SUM(CASE WHEN win_team = ' . $this->db->escape($team_id) . ' THEN 1 ELSE 0 END) AS win_matches,
            SUM(CASE WHEN lost_team = ' . $this->db->escape($team_id) . ' THEN 1 ELSE 0 END) AS lost_matches
        ');
        $this->db->from('match_result');
        $this->db->where('win_team', $team_id);
        $this->db->or_where('lost_team', $team_id);
        $query = $this->db->get();
        
        return $query->row_array();
    }

    public function invite_team($email) {
        $this->db->select('add_team.team_name, add_team.team_id');
        $this->db->from('users');
        $this->db->join('add_team', 'add_team.user_id = users.user_id');
        $this->db->where('users.email', $email);
        $query = $this->db->get();
        
        log_message('debug', $this->db->last_query());
        
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        
        return null;
    }

    public function two_team($team1, $team2) {
        $this->db->select('team_name, team_id, image_path');
        $this->db->from('add_team');
        $this->db->where_in('team_id', [$team1, $team2]);
        $query = $this->db->get();
        
        return $query->result_array();
    }

    public function two_team_player($team1, $team2) {
        $this->db->select('add_player.player_id, add_player.playerName');
        $this->db->from('add_player');
        $this->db->join('player_team', 'add_player.player_id = player_team.player_id');
        $this->db->where('player_team.status', 1);
        $this->db->group_start();
        $this->db->where('player_team.team_id', $team1);
        $this->db->or_where('player_team.team_id', $team2);
        $this->db->group_end();
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function join_match($team_one_id, $team_two_id) {
        if ($team_one_id == $team_two_id) {
            $this->session->set_flashdata('message', 'Error! Team cannot play against itself.');
            $this->session->set_flashdata('message_type', 'error');
            return 0;
        }

        $this->db->select('*');
        $this->db->from('match_team');
        $this->db->where('(team_one_id = ' . $team_one_id . ' AND team_two_id = ' . $team_two_id . ') 
                          OR (team_one_id = ' . $team_two_id . ' AND team_two_id = ' . $team_one_id . ')');
        $query = $this->db->get();

        if ($query->row()) {
            $this->session->set_flashdata('message', 'Team is already in match list.');
            $this->session->set_flashdata('message_type', 'error');
            return false;
        }

        $data = [
            'team_one_id' => $team_one_id,
            'team_two_id' => $team_two_id,
            'status' => 0,
            'joined_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('match_team', $data);
        $this->session->set_flashdata('message', 'Match request is sent successfully');
        $this->session->set_flashdata('message_type', 'success');
        
        return true;
    }

    public function get_match_teams($team_id) {
        $this->db->select('
            t1.team_name as team_one_name, 
            t1.team_id as team_one_id, 
            t1.image_path as team_one_image, 
            t2.team_name as team_two_name, 
            t2.team_id as team_two_id, 
            t2.image_path as team_two_image,
            mt.team_one_id as original_team_one_id, 
            mt.team_two_id as original_team_two_id
        ');
        $this->db->from('match_team mt');
        $this->db->join('add_team t1', 'mt.team_one_id = t1.team_id', 'left');
        $this->db->join('add_team t2', 'mt.team_two_id = t2.team_id', 'left');
        $this->db->where('(
            mt.team_one_id = ' . $this->db->escape($team_id) . ' OR 
            mt.team_two_id = ' . $this->db->escape($team_id) . '
        )');
        $this->db->where('mt.status', 1);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return ['status' => 'error', 'message' => 'There is no team in your match List yet. Go to invite team option.'];
        }

        $results = $query->result();

        foreach ($results as $result) {
            if ($result->original_team_one_id == $team_id) {
                $temp_name = $result->team_one_name;
                $temp_id = $result->team_one_id;
                $temp_image = $result->team_one_image;
                
                $result->team_one_name = $result->team_two_name;
                $result->team_one_id = $result->team_two_id;
                $result->team_one_image = $result->team_two_image;
                
                $result->team_two_name = $temp_name;
                $result->team_two_id = $temp_id;
                $result->team_two_image = $temp_image;
            }
            
            unset($result->original_team_one_id);
            unset($result->original_team_two_id);
        }
        
        return ['status' => 'success', 'data' => $results];
    }

    public function team_request($team_id) {
        $this->db->select('add_team.team_name, add_team.image_path, add_team.team_id, add_team.city');
        $this->db->from('match_team');
        $this->db->join('add_team', 'match_team.team_two_id = add_team.team_id');
        $this->db->where('match_team.team_one_id', $team_id);
        $this->db->where('match_team.status', 0);
        $query_one = $this->db->get();

        $this->db->select('add_team.team_name, add_team.image_path, add_team.team_id, add_team.city');
        $this->db->from('match_team');
        $this->db->join('add_team', 'match_team.team_one_id = add_team.team_id');
        $this->db->where('match_team.team_two_id', $team_id);
        $this->db->where('match_team.status', 0);
        $query_two = $this->db->get();

        $received_request_count = $query_one->num_rows();
        $sent_request_count = $query_two->num_rows();

        $results = array(
            'received_request' => $query_one->result(),
            'sent_request' => $query_two->result(),
            'received_request_count' => $received_request_count,
            'sent_request_count' => $sent_request_count,
            'total_requests' => $received_request_count + $sent_request_count
        );
        
        return $results;
    }

    public function accept_match_request($team_two_id, $team_one_id) {
        $data = array(
            'status' => 1
        );
        
        $this->db->where('team_two_id', $team_one_id)
                 ->where('team_one_id', $team_two_id)
                 ->where('status', 0)
                 ->update('match_team', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function reject_match_request($data) {
        if (empty($data)) {
            return false;
        }

        $this->db->where($data);
        $this->db->delete('match_team');

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_team_schedule($team_id) {
        $this->db->select('s.*, t1.image_path as team_one_image, t1.team_name as team_one_name, t2.image_path as team_two_image, t2.team_name as team_two_name');
        $this->db->from('add_schedule s');
        $this->db->join('add_team t1', 't1.team_id = s.team_one_id', 'left');
        $this->db->join('add_team t2', 't2.team_id = s.team_two_id', 'left');
        $this->db->where('s.team_one_id', $team_id);
        $this->db->or_where('s.team_two_id', $team_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 0;
        }
    }

    public function team_captain($team_id) {
    $this->db->select('tc.team_id, tc.ball_type, tc.player_id, ap.playerName, ap.image_path');
    $this->db->from('team_captain tc');
    $this->db->join('add_player ap', 'tc.player_id = ap.player_id', 'left');
    $this->db->where('tc.team_id', $team_id);
    $query = $this->db->get();

    $team_details = array(
        'team_id' => $team_id,
        'leather_ball' => array(
            'player_id' => '',
            'playerName' => '',
            'image_path' => '',
            'status' => 0
        ),
        'tape_ball' => array(
            'player_id' => '',
            'playerName' => '',
            'image_path' => '',
            'status' => 0
        ),
        'tennis_ball' => array(
            'player_id' => '',
            'playerName' => '',
            'image_path' => '',
            'status' => 0
        )
    );

    if ($query->num_rows() > 0) {
        foreach ($query->result_array() as $row) {
            switch ($row['ball_type']) {
                case 'leather_ball':
                    $team_details['leather_ball']['player_id'] = $row['player_id'];
                    $team_details['leather_ball']['playerName'] = $row['playerName'];
                    $team_details['leather_ball']['image_path'] = $row['image_path'];
                    $team_details['leather_ball']['status'] = 1;
                    break;
                case 'tape_ball':
                    $team_details['tape_ball']['player_id'] = $row['player_id'];
                    $team_details['tape_ball']['playerName'] = $row['playerName'];
                    $team_details['tape_ball']['image_path'] = $row['image_path'];
                    $team_details['tape_ball']['status'] = 1;
                    break;
                case 'tennis_ball':
                    $team_details['tennis_ball']['player_id'] = $row['player_id'];
                    $team_details['tennis_ball']['playerName'] = $row['playerName'];
                    $team_details['tennis_ball']['image_path'] = $row['image_path'];
                    $team_details['tennis_ball']['status'] = 1;
                    break;
            }
        }
    }
    
    return $team_details;
}
    public function insert_captain($data) {
        $this->db->insert('team_captain', $data);
    }

    public function get_current_captain($team_id, $ball_type) {
        $this->db->select('tc.player_id, ap.playerName, ap.image_path');
        $this->db->from('team_captain tc');
        $this->db->join('add_player ap', 'tc.player_id = ap.player_id', 'left');
        $this->db->where('tc.team_id', $team_id);
        $this->db->where('tc.ball_type', $ball_type);
        $query = $this->db->get();
        
        return $query->row();
    }

    public function update_captain($data, $where) {
        $this->db->where($where);
        return $this->db->update('team_captain', $data);
    }

    public function update_team_info($team_id, $data) {
        $this->db->where('team_id', $team_id);
        return $this->db->update('add_team', $data);
    }

    public function league_participation($team_id) {
        $this->db->select('add_league.league_name, add_league.league_id, add_league.city')
             ->from('league_teams')
             ->join('add_team', 'league_teams.team_id = add_team.team_id')
             ->join('add_league', 'league_teams.league_id = add_league.league_id')
             ->where('add_team.team_id', $team_id)
             ->where('league_teams.status', 1);
        
        $query = $this->db->get();
        return $query->result();
    }

    public function insert_team_management($data) {
        return $this->db->insert('team_management', $data);
    }

    public function update_team_management($data, $where) {
        $this->db->where($where);
        return $this->db->update('team_management', $data);
    }

    public function get_team_management($team_id) {
        $this->db->where('team_id', $team_id);
        $query = $this->db->get('team_management');
        return $query->result();
    }

    public function get_team_management_member($team_id, $role) {
        $this->db->where('team_id', $team_id);
        $this->db->where('role', $role);
        $query = $this->db->get('team_management');
        return $query->row();
    }

    public function get_team_matches($team_id) {
        $this->db->select('m.match_id, m.result_statement, 
                          s.match_date, s.match_time, s.location,
                          w.team_name as win_team_name, w.team_id as win_team_id,
                          l.team_name as lost_team_name, l.team_id as lost_team_id');
        $this->db->from('match_result m');
        $this->db->join('add_schedule s', 's.match_id = m.match_id', 'left');
        $this->db->join('add_team w', 'w.team_id = m.win_team');
        $this->db->join('add_team l', 'l.team_id = m.lost_team');
        $this->db->where('m.win_team', $team_id);
        $this->db->or_where('m.lost_team', $team_id);
        $this->db->order_by('s.match_date', 'DESC');
        $this->db->order_by('s.match_time', 'DESC');
        return $this->db->get()->result();
    }
  public function get_top_performers($team_id) {
    // Fetch top batsman (most runs)
    $this->db->select('ap.player_id, ap.playerName, ap.image_path, SUM(bf.runs) as total_runs');
    $this->db->from('batting_first bf');
    $this->db->join('add_player ap', 'ap.player_id = bf.player_id', 'left');
    $this->db->join('player_team pt', 'pt.player_id = bf.player_id', 'inner');
    $this->db->where('pt.team_id', $team_id);
    $this->db->where('pt.status', 1);
    $this->db->group_by('ap.player_id, ap.playerName, ap.image_path');
    $this->db->order_by('total_runs', 'DESC');
    $this->db->limit(1);
    $top_batsman = $this->db->get()->row_array();

    // Fetch top bowler (most wickets)
    $this->db->select('ap.player_id, ap.playerName, ap.image_path, SUM(bf.wickets) as total_wickets');
    $this->db->from('bowling_first bf');
    $this->db->join('add_player ap', 'ap.player_id = bf.player_id', 'left');
    $this->db->join('player_team pt', 'pt.player_id = bf.player_id', 'inner');
    $this->db->where('pt.team_id', $team_id);
    $this->db->where('pt.status', 1);
    $this->db->group_by('ap.player_id, ap.playerName, ap.image_path');
    $this->db->order_by('total_wickets', 'DESC');
    $this->db->limit(1);
    $top_bowler = $this->db->get()->row_array();

    return [
        'top_bowler' => $top_bowler ?: ['playerName' => 'N/A', 'image_path' => 'default_player.png', 'total_wickets' => 0],
        'top_batsman' => $top_batsman ?: ['playerName' => 'N/A', 'image_path' => 'default_player.png', 'total_runs' => 0]
    ];
}
}