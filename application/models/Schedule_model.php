<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_model extends CI_Model {

    public function save_schedule($data, $team1, $team2, $match_date, $match_time) {
        // Check if a match already exists with the same teams and date/time
        $this->db->from('add_schedule');
        $this->db->where('(
            (add_schedule.team_one_id = ' . $this->db->escape($team1) . ' AND add_schedule.team_two_id = ' . $this->db->escape($team2) . ')
            OR 
            (add_schedule.team_one_id = ' . $this->db->escape($team2) . ' AND add_schedule.team_two_id = ' . $this->db->escape($team1) . ')
        )');
        $this->db->where('add_schedule.match_date', $match_date);
        $this->db->where('add_schedule.match_time', $match_time);
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            // A match already exists for the same teams and date/time
            return false;
        } else {
            // No match exists, proceed with inserting the new schedule
            $this->db->insert('add_schedule', $data);
            return true;
        }
    }

    public function update_schedule($schedule_id, $data, $team1, $team2, $match_date, $match_time) {
        // Check for conflicts with other matches (excluding the current schedule_id)
        $this->db->from('add_schedule');
        $this->db->where('match_id !=', $schedule_id);
        $this->db->where('(
            (add_schedule.team_one_id = ' . $this->db->escape($team1) . ' AND add_schedule.team_two_id = ' . $this->db->escape($team2) . ')
            OR 
            (add_schedule.team_one_id = ' . $this->db->escape($team2) . ' AND add_schedule.team_two_id = ' . $this->db->escape($team1) . ')
        )');
        $this->db->where('add_schedule.match_date', $match_date);
        $this->db->where('add_schedule.match_time', $match_time);
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            // A conflict exists with another match
            return false;
        }

        // Update the schedule
        $this->db->where('match_id', $schedule_id);
        $this->db->update('add_schedule', $data);
        return $this->db->affected_rows() > 0;
    }

    public function delete_schedule($schedule_id) {
        $this->db->where('match_id', $schedule_id);
        $this->db->delete('add_schedule');
        return $this->db->affected_rows() > 0;
    }

    public function check_toss($schedule_id) {
        $this->db->where('match_id', $schedule_id);
        $query = $this->db->get('toss');
        return $query->num_rows() > 0;
    }

    public function get_schedule($user_id) {
        $this->db->select('
            add_schedule.*,
            team_one.team_name AS team_one_name,
            team_one.image_path AS team_one_image,
            team_two.team_name AS team_two_name,
            team_two.image_path AS team_two_image,
            add_schedule.match_id
        ');
        $this->db->from('add_schedule');
        $this->db->join('add_team AS team_one', 'add_schedule.team_one_id = team_one.team_id', 'left');
        $this->db->join('add_team AS team_two', 'add_schedule.team_two_id = team_two.team_id', 'left');
        $this->db->where('add_schedule.user_id', $user_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function total_score($data) {
        $this->db->insert('total_score', $data);
    }
      public function edit_schedule($match_id, $data) {
        $this->db->where('match_id', $match_id);
        $this->db->update('add_schedule', $data);
        return $this->db->affected_rows() > 0;
    }
    public function check_toss_exists($match_id) {
    $this->db->where('match_id', $match_id);
    $query = $this->db->get('toss');
    return $query->num_rows() > 0;
}


}