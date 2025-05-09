
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TeamController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Team_model');
        $this->load->model('Scorecard_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->library('session');
        $this->load->database();
        
        if ($this->session->userdata('logged') != true) {
            redirect('Welcome/index');
        }
    }

    public function add_team() {
        $config['upload_path'] = './Uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 10000;
        $config['file_name'] = time();

        $this->upload->initialize($config);

        if (empty($_FILES['userfile']['name'])) {
            $this->session->set_flashdata('error', 'Please select a file to upload.');
            redirect('Welcome/enter_team');
        }

        if (!$this->upload->do_upload('userfile')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('Welcome/enter_team');
        } else {
            $file_data = $this->upload->data();
            $image_data = base_url('Uploads/' . $file_data['file_name']);
            $user_id = $this->session->userdata('user_id');
            $current_date = date('Y-m-d');
            
            $record = array(
                'team_name' => ucwords($this->input->post('team_name')),
                'city' => ucwords($this->input->post('city')),
                'country' => ucwords($this->input->post('country')),
                'home_ground' => ucwords($this->input->post('home_ground')),
                'phone_number' => ucwords($this->input->post('phone_number')),
                'coach' => ucwords($this->input->post('coach')),
                'chairman' => ucwords($this->input->post('chairman')),
                'description' => ucwords($this->input->post('description')),
                'image_path' => $image_data,
                'user_id' => $user_id,
                'created_at' => $current_date
            );

            $this->Team_model->save_image($record);
            $this->session->set_flashdata('success', 'Image uploaded successfully!');
            $this->load->view('header');
            redirect('Welcome/landing_page');
        }
    }

   public function team_profile($team_id) {
    $team_data['team_stats'] = $this->Team_model->get_team_stats($team_id);
    $team_data['data'] = $this->Team_model->get_team($team_id);
    $team_data['captain'] = $this->Team_model->team_captain($team_id);
    $team_data['team_schedule'] = $this->Team_model->get_team_schedule($team_id);
    $team_data['opposition_team'] = $this->Team_model->get_match_teams($team_id);
    $team_data['league_playing'] = $this->Team_model->league_participation($team_id);
    $team_data['team_management'] = $this->Team_model->get_team_management($team_id);
    $team_data['matches'] = $this->Team_model->get_team_matches($team_id);
    $team_data['top_performers'] = $this->Team_model->get_top_performers($team_id); // Add top performers

    $this->load->view('header');
    $this->load->view('team_profile', $team_data);
}

    public function add_captain_leather($team_id) {
        $team_data['team_id'] = $team_id;
        $team_data['players'] = $this->Team_model->get_squad($team_id);
        $this->load->view('header');
        $this->load->view('add_captain_leather', $team_data);
    }

    public function add_captain_tape($team_id) {
        $team_data['team_id'] = $team_id;
        $team_data['players'] = $this->Team_model->get_squad($team_id);
        $this->load->view('header');
        $this->load->view('add_captain_tape', $team_data);
    }

    public function add_captain_tennis($team_id) {
        $team_data['team_id'] = $team_id;
        $team_data['players'] = $this->Team_model->get_squad($team_id);
        $this->load->view('header');
        $this->load->view('add_captain_tennis', $team_data);
    }

    public function insert_captain() {
        $team_id = $this->input->post('team_id');
        $player_id = $this->input->post('player_id');
        $ball_type = $this->input->post('ball_type');
        $user_id = $this->session->userdata('user_id');
        
        $record = array(
            'ball_type' => $ball_type,
            'player_id' => $player_id,
            'team_id' => $team_id,
            'user_id' => $user_id,
            'created_on' => date('Y-m-d')
        );
        
        $this->Team_model->insert_captain($record);
        redirect('Welcome/team_admin/' . $team_id);
    }

    public function edit_captain_leather($team_id) {
        $team_data['team_id'] = $team_id;
        $team_data['players'] = $this->Team_model->get_squad($team_id);
        $team_data['ball_type'] = 'leather_ball';
        $team_data['current_captain'] = $this->Team_model->get_current_captain($team_id, 'leather_ball');
        
        $this->load->view('header');
        $this->load->view('edit_captain', $team_data);
    }

    public function edit_captain_tape($team_id) {
        $team_data['team_id'] = $team_id;
        $team_data['players'] = $this->Team_model->get_squad($team_id);
        $team_data['ball_type'] = 'tape_ball';
        $team_data['current_captain'] = $this->Team_model->get_current_captain($team_id, 'tape_ball');
        
        $this->load->view('header');
        $this->load->view('edit_captain', $team_data);
    }

    public function edit_captain_tennis($team_id) {
        $team_data['team_id'] = $team_id;
        $team_data['players'] = $this->Team_model->get_squad($team_id);
        $team_data['ball_type'] = 'tennis_ball';
        $team_data['current_captain'] = $this->Team_model->get_current_captain($team_id, 'tennis_ball');
        
        $this->load->view('header');
        $this->load->view('edit_captain', $team_data);
    }

    public function update_captain() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('player_id', 'Player', 'required|trim');
            $this->form_validation->set_rules('ball_type', 'Ball Type', 'required|trim');
            
            $team_id = $this->input->post('team_id');
            $ball_type = $this->input->post('ball_type');

            if ($this->form_validation->run() === FALSE) {
                $team_data['team_id'] = $team_id;
                $team_data['players'] = $this->Team_model->get_squad($team_id);
                $team_data['ball_type'] = $ball_type;
                $team_data['current_captain'] = $this->Team_model->get_current_captain($team_id, $ball_type);
                $this->load->view('header');
                $this->load->view('edit_captain', $team_data);
            } else {
                $data = array(
                    'player_id' => $this->input->post('player_id'),
                    'user_id' => $this->session->userdata('user_id'),
                    'created_on' => date('Y-m-d')
                );

                $where = array(
                    'team_id' => $team_id,
                    'ball_type' => $ball_type
                );

                $result = $this->Team_model->update_captain($data, $where);

                if ($result) {
                    $this->session->set_flashdata('success', 'Captain updated successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update captain.');
                }

                redirect('Welcome/team_admin/' . $team_id);
            }
        } else {
            redirect('Welcome/team_admin/' . $this->input->post('team_id'));
        }
    }

    public function show_team() {
        $user_id = $this->session->userdata('user_id');
        $team_data['data'] = $this->Team_model->get_team(array('user_id' => $user_id), 'add_team');
        $this->load->view('header');
        $this->load->view('landing_page', $team_data);
    }

    public function my_teams() {
        $user_id = $this->session->userdata('user_id');
        $team_data['data'] = $this->Team_model->get_team(array('user_id' => $user_id), 'add_team');
        if ($team_data['data'] == 0) {
            $team_data['data'] = 0;
        } else {
            $team_data['data'] = $this->Team_model->get_team(array('user_id' => $user_id), 'add_team');
        }
        
        $this->load->view('header');
        $this->load->view('my_teams', $team_data);
    }

    public function player_request($team_id) {
        $user_id = $this->session->userdata('user_id');
        $player_data['request'] = $this->Team_model->get_player_request($team_id);
        
        $this->load->view('header');
         redirect('TeamController/team_profile/' . $team_id);
    }

    public function accept_request($player_id, $team_id) {
        $this->Team_model->accept_request($player_id, $team_id);
        $player_data['request'] = $this->Team_model->get_player_request($team_id);
        
        $this->load->view('header');
        redirect('TeamController/team_profile/' . $team_id);
    }

   public function team_squad($team_id) {
        $user_id = $this->session->userdata('user_id');
        $player_data['squad'] = $this->Team_model->get_squad($team_id);
        $player_data['team_name'] = $this->Team_model->get_team_name($team_id); // Fetch team name
        $player_data['team_id'] = $team_id; // Pass team_id to view
        $this->load->view('header');
        $this->load->view('team_squad', $player_data);
    }

    public function cancel_player_request($player_id, $team_id) {
        $this->Team_model->delete_player_request(array('player_id' => $player_id, 'team_id' => $team_id, 'status' => 0));
        $user_id = $this->session->userdata('user_id');
        $player_data['request'] = $this->Team_model->get_player_request($team_id);
        
        $this->load->view('header');
         redirect('TeamController/team_profile/' . $team_id);
    }

    public function invite_team($team_id) {
        $data['team_id'] = $team_id;
        $this->load->view('header');
        $this->load->view('invite_team', $data);
    }

    public function find_team() {
        $search_query = $this->input->post('email', TRUE);
        $team_id = $this->input->post('team_id', TRUE);
        $data['team_id'] = $team_id;
        $data['teams'] = $this->Team_model->invite_team($search_query);
        
 $this->load->view('invite_team', $data);
    }

    public function insert_match($team_two_id, $team_id) {
        $result = $this->Team_model->join_match($team_two_id, $team_id);
        $team_data['team_stats'] = $this->Team_model->get_team_stats($team_id);
        $team_data['data'] = $this->Team_model->get_team($team_id);
        
        $this->load->view('header');
        redirect('Welcome/team_admin/' . $team_id);
    }

    public function match_request($team_id) {
        $team_data['team_id'] = $team_id;
        $team_data['team_names'] = $this->Team_model->get_match_teams($team_id);
        $this->load->view('header');
       redirect('Welcome/team_admin/' . $team_id);
    }

    public function team_request($team_id) {
        $team_data['main_team'] = $team_id;
        $team_data['team_names'] = $this->Team_model->team_request($team_id);
        $this->load->view('header');
         redirect('Welcome/team_admin/' . $team_id);
    }

    public function accept_match_request($team_one_id, $team_two_id) {
        $team_data['main_team'] = $team_one_id;
        $this->Team_model->accept_match_request($team_one_id, $team_two_id);
        $team_data['team_names'] = $this->Team_model->team_request($team_one_id);
        
        $this->load->view('header');
          redirect('Welcome/team_admin/' . $team_one_id);
    }

    public function reject_match_request($main_id, $team_one_id) {
        $team_data['team_id'] = $main_id;
        $this->Team_model->reject_match_request(array('team_one_id' => $main_id, 'team_two_id' => $team_one_id, 'status' => 0));
        $team_data['team_names'] = $this->Team_model->get_match_teams($main_id);
        
        $this->load->view('header');
         redirect('Welcome/team_admin/' . $main_id);
    }

    
    public function team_schedule($team_id) {
        $team_data['team_schedule'] = $this->Team_model->get_team_schedule($team_id);
        // Fetch team name for the given team_id
        $team_data['team_name'] = $this->Team_model->get_team_name($team_id);
        $team_data['team_id'] = $team_id; // Pass team_id to view
        $this->load->view('header');
        $this->load->view('team_schedule', $team_data);
    }


    public function update_team_info() {
        $team_id = $this->input->post('team_id');
        $scroll_position = $this->input->post('scroll_position');
        
        $data = [
            'city' => $this->input->post('city'),
            'country' => $this->input->post('country'),
            'home_ground' => $this->input->post('home_ground'),
            'phone_number' => $this->input->post('phone_number')
        ];
        
        $result = $this->Team_model->update_team_info($team_id, $data);
        
        if ($result) {
            $this->session->set_flashdata('success', 'Team information updated successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to update team information');
        }
        
        redirect($_SERVER['HTTP_REFERER'] . '?scroll=' . $scroll_position . '#edit-anchor');
    }


    public function update_team_name() {
        // Check if the request is AJAX
        $is_ajax = $this->input->is_ajax_request();

        // Get POST data
        $team_id = $this->input->post('team_id');
        $team_name = trim($this->input->post('team_name')); // Trim to remove extra spaces

        // Validate inputs
        if (empty($team_id)) {
            $response = ['status' => 'error', 'message' => 'Team ID is required'];
            if ($is_ajax) {
                echo json_encode($response);
                return;
            } else {
                $this->session->set_flashdata('error', $response['message']);
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        if (empty($team_name)) {
            $response = ['status' => 'error', 'message' => 'Team name is required'];
            if ($is_ajax) {
                echo json_encode($response);
                return;
            } else {
                $this->session->set_flashdata('error', $response['message']);
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        // Validate team name length (example: max 100 characters)
        if (strlen($team_name) > 100) {
            $response = ['status' => 'error', 'message' => 'Team name must not exceed 100 characters'];
            if ($is_ajax) {
                echo json_encode($response);
                return;
            } else {
                $this->session->set_flashdata('error', $response['message']);
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        // Load the Team_model
        $this->load->model('Team_model');

        // Check if team exists and user has permission
        $team = $this->Team_model->get_team_by_id($team_id);
        if (!$team) {
            $response = ['status' => 'error', 'message' => 'Team not found'];
            if ($is_ajax) {
                echo json_encode($response);
                return;
            } else {
                $this->session->set_flashdata('error', $response['message']);
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        // Check if the logged-in user is the team owner
        $user_id = $this->session->userdata('user_id');
        if ($team->user_id != $user_id) {
            $response = ['status' => 'error', 'message' => 'You do not have permission to update this team'];
            if ($is_ajax) {
                echo json_encode($response);
                return;
            } else {
                $this->session->set_flashdata('error', $response['message']);
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        // Prepare data for update
        $data = ['team_name' => $team_name];

        // Attempt to update team name
        try {
            $result = $this->Team_model->update_team_name($team_id, $data);

            if ($result) {
                $response = ['status' => 'success', 'message' => 'Team name updated successfully'];
                if ($is_ajax) {
                    echo json_encode($response);
                } else {
                    $this->session->set_flashdata('success', $response['message']);
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $response = ['status' => 'error', 'message' => 'Failed to update team name'];
                if ($is_ajax) {
                    echo json_encode($response);
                } else {
                    $this->session->set_flashdata('error', $response['message']);
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        } catch (Exception $e) {
            // Log the error for debugging
            log_message('error', 'Update team name failed: ' . $e->getMessage());
            $response = ['status' => 'error', 'message' => 'An error occurred while updating the team name'];
            if ($is_ajax) {
                echo json_encode($response);
            } else {
                $this->session->set_flashdata('error', $response['message']);
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function add_management($team_id) {
        $data['team_id'] = $team_id;
        $this->load->view('add_management', $data);
    }

    public function edit_team_management($team_id, $role) {
        $data['team_id'] = $team_id;
        $data['staff'] = $this->Team_model->get_team_management_member($team_id, urldecode($role));
        if (!$data['staff']) {
            $this->session->set_flashdata('error', 'Team management member not found.');
           redirect('Welcome/team_admin/' . $team_id);
        }
        $this->load->view('edit_team_management', $data);
    }

    public function insert_team_management() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('designation', 'Designation', 'required|trim');

            $team_id = $this->input->post('team_id');

            if ($this->form_validation->run() === FALSE) {
                $data['team_id'] = $team_id;
                $this->load->view('add_team_management', $data);
            } else {
                $data = array(
                    'team_id' => $team_id,
                    'user_id' => $this->session->userdata('user_id'),
                    'role' => $this->input->post('designation'),
                    'name' => $this->input->post('name'),
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                $result = $this->Team_model->insert_team_management($data);

                if ($result) {
                    $this->session->set_flashdata('success', 'Team management member added successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to add team management member.');
                }

                redirect('Welcome/team_admin/' . $team_id);
            }
        } else {
            redirect('Welcome/team_admin/' . $this->input->post('team_id'));
        }
    }

    public function update_team_management() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('designation', 'Designation', 'required|trim');

            $team_id = $this->input->post('team_id');
            $current_role = $this->input->post('current_role');

            if ($this->form_validation->run() === FALSE) {
                $data['team_id'] = $team_id;
                $data['staff'] = $this->Team_model->get_team_management_member($team_id, $current_role);
                $this->load->view('edit_team_management', $data);
            } else {
                $data = array(
                    'role' => $this->input->post('designation'),
                    'name' => $this->input->post('name')
                );

                $where = array(
                    'team_id' => $team_id,
                    'user_id' => $this->session->userdata('user_id'),
                    'role' => $current_role
                );

                $result = $this->Team_model->update_team_management($data, $where);

                if ($result) {
                    $this->session->set_flashdata('success', 'Team management member updated successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update team management member.');
                }

                redirect($_SERVER['HTTP_REFERER'] . '?scroll=' . $scroll_position . '#management-anchor');
            }
        } else {
             redirect($_SERVER['HTTP_REFERER'] . '?scroll=' . $scroll_position . '#management-anchor');
        }
    }
}
