<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cricket League Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: white;
      color: #333;
      font-size: 14px;
    }
    .navbar {
      background-color: #005f8d;
      color: white;
      padding: 10px 20px;
      display: flex;
      overflow-x: auto;
      white-space: nowrap;
      scroll-behavior: smooth;
      -webkit-overflow-scrolling: touch;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .navbar::-webkit-scrollbar {
      display: none;
    }

    .navbar a {
      color: white;
      text-decoration: none;
      font-size: 1em;
      padding: 6px 12px;
      display: block;
      border-radius: 5px;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .navbar a:hover {
      color: #ffd700;
    }

    .container {
      margin-top: 20px;
      width: 80%;
    }
    .card {
      margin-bottom: 20px;
      border: none;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }
    .card:hover {
      transform: translateY(-5px);
    }
    .card-header {
      background-color: #005f8d;
      color: white;
      font-weight: bold;
      padding: 15px;
    }
    .btn-primary {
      background-color: #1e3a8a;
      border: none;
      transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
      background-color: #152c5b;
    }
    .btn-danger {
      background-color: #dc3545;
      border: none;
      transition: background-color 0.3s ease;
    }
    .btn-danger:hover {
      background-color: #a71d2a;
    }
    .team-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }
    .team-card {
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      text-align: center;
      transition: transform 0.3s ease;
    }
    .team-card:hover {
      transform: translateY(-5px);
    }
    .team-card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
    }
    .team-card h4 {
      margin: 10px 0;
      font-size: 1.2rem;
      color: #1e3a8a;
    }
    .team-card p {
      margin: 5px 0;
      color: #555;
    }
    .league-info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }
    .league-info-card {
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      text-align: center;
      transition: transform 0.3s ease;
    }
    .league-info-card:hover {
      transform: translateY(-5px);
    }
    .league-info-card h4 {
      margin: 10px 0;
      font-size: 1.2rem;
      color: #1e3a8a;
    }
    .league-info-card p {
      margin: 5px 0;
      color: #555;
    }

    /* Schedule Section Styling */
    .schedule-container {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      justify-content: space-between;
    }

    .match-card {
      flex: 1 1 calc(50% - 15px); /* Two cards per row with gap */
      box-sizing: border-box;
      background: white;
      padding: 20px;
      margin-bottom: 15px;
      border-radius: 8px;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .match-card:hover {
      transform: translateY(-5px);
    }

    .team {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .team img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
    }

    .match-details {
      text-align: center;
      margin-top: 10px;
    }

    .schedule-links {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-top: 10px;
    }

    .schedule-links a {
      text-decoration: none;
      color: #1e3a8a;
      font-weight: bold;
      transition: color 0.3s ease;
    }

    .schedule-links a:hover {
      color: #ffd700;
      text-decoration: underline;
    }

    /* External Header Section */
        .external-header {
          background: white;
          color: #005f8d;
          text-align: center;
          padding: 20px 0;
          border-bottom: 2px solid #005f8d;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .external-header h1 {
          font-size: 2.5em;
          letter-spacing: 1px;
          text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
          margin-bottom: 10px;
        }
        .external-header .league-info {
          font-size: 1.1em;
      color: #666;
      margin-top: 10px;
    }

    /* Add Rules Section */
    .rules-list {
      margin-top: 20px;
    }

    .rule-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px;
      border-bottom: 1px solid #ddd;
    }

    .rule-item:last-child {
      border-bottom: none;
    }

    .rule-item .edit-link {
      color: #1e3a8a;
      text-decoration: none;
      font-weight: bold;
      transition: color 0.3s ease;
    }

    .rule-item .edit-link:hover {
      color: #ffd700;
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <!-- External Header Section -->
  <div class="external-header">
    <h1><?php echo $league['league_name']; ?></h1>
    <div class="league-info">
      <p>Season: <?php echo $league['season']; ?> | City: <?php echo $league['city']; ?> | Country: <?php echo $league['country']; ?> | Ball: <?php echo $league['match_type']; ?></p>
    </div>
    <div class="league-info">
      <p>Venue: <?php echo $league['venue']; ?> | Phone: <?php echo $league['phone_number']; ?> | Overs: <?php echo $league['overs']; ?></p>
    </div>
  </div>

  <!-- Horizontal Navigation Bar -->
  <div class="navbar">
    <a href="<?php echo base_url(); ?>Welcome/tournament_landing/<?php echo $league['league_id']; ?>">Stats View</a>
    <a href="#add-schedule">Add Schedule</a>
    <a href="#add-rules">Add Rules</a>
  </div>

  <!-- Main Content -->
  <div class="container">
    <!-- Team Requests Section -->
    <?php if (!empty($team_request)) { ?>
    <div id="team-requests" class="card">
      <div class="card-header">Team Requests</div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th>Team Name</th>
              <th>City</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($team_request as $teams) { ?>
            <tr>
              <th><a href="<?php echo base_url(); ?>TeamController/team_profile/<?php echo $teams->team_id; ?>"><?php echo $teams->team_name; ?></a></th>
              <th><?php echo $teams->city; ?></th>
              <td>
                <a href="<?php echo base_url(); ?>TournamentController/accept_request/<?php echo $teams->team_id; ?>/<?php echo $league['league_id']; ?>"> <button class="btn btn-primary">Accept</button></a>
                <a href="<?php echo base_url(); ?>TournamentController/reject_team_request/<?php echo $teams->team_id; ?>/<?php echo $league['league_id']; ?>"> <button class="btn btn-danger">Reject</button> </a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <?php } ?>

    <!-- Teams Section -->
    <div class="card">
      <div class="card-header">Teams</div>
      <div class="card-body">
        <div class="team-grid">
          <?php if (!empty($league_teams)) { 
            foreach ($league_teams as $l_teams) { ?>
              <div class="team-card">
                <img src="<?php echo $l_teams['image_path']; ?>" alt="team">
                <h4><a href="<?php echo base_url(); ?>TeamController/team_profile/<?php echo $l_teams['team_id']; ?>"><?php echo $l_teams['team_name']; ?></a></h4>
                <p>Captain: John Doe</p>
                <p>Matches Played: 5</p>
                <p>Points: 10</p>
              </div>
            <?php } 
          } else { ?>
            <h2>Currently, there is no registered team in the league yet.</h2>
          <?php } ?>
        </div>
      </div>
    </div>

    <!-- Add Schedule Section -->
    <div id="add-schedule" class="card">
      <div class="card-header">Add Schedule</div>
      <div class="card-body">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addScheduleModal">Add Schedule</button>
      </div>
    </div>

    <!-- Schedule & Scorecard Section -->
    <div id="schedule-scorecard" class="card">
      <div class="card-header">Schedule & Scorecard</div>
      <div class="card-body">
        <div class="schedule-container">
          <?php if (!empty($league_schedule)) { 
            foreach ($league_schedule as $schedule) { ?>
              <div class="match-card">
                <div class="team">
                  <img src="<?php echo $schedule->team_one_image; ?>" alt="Team A">
                  <span><?php echo $schedule->team_one_name; ?></span>
                  <strong>vs</strong>
                  <span><?php echo $schedule->team_two_name; ?></span>
                  <img src="<?php echo $schedule->team_two_image; ?>" alt="Team B">
                </div>
                <div class="match-details">
                  <?php $date = $schedule->match_date; $formatted_date = date("d F Y", strtotime($date)); ?>
                  <p><strong>Date:</strong> <?php echo $formatted_date; ?></p>
                  <p><strong>Time:</strong> <?php echo $schedule->match_time; ?></p>
                  <p><strong>Venue:</strong> <?php echo $schedule->location; ?></p>
                </div>
                <div class="schedule-links">
                  <a href="#" class="edit-schedule" data-bs-toggle="modal" data-bs-target="#editScheduleModal" 
                     data-schedule-id="<?php echo $schedule->match_id; ?>" 
                     data-team1="<?php echo $schedule->team_one_id; ?>" 
                     data-team2="<?php echo $schedule->team_two_id; ?>" 
                     data-match-date="<?php echo $schedule->match_date; ?>" 
                     data-match-time="<?php echo $schedule->match_time; ?>" 
                     data-location="<?php echo $schedule->location; ?>"
                     data-overs="<?php echo $schedule->overs; ?>"
                     data-umpire1="<?php echo $schedule->umpire1; ?>"
                     data-umpire2="<?php echo $schedule->umpire2; ?>">Edit</a> |
                  <a href="<?php echo base_url();?>Welcome/toss/<?php echo $schedule->team_one_id;?>/<?php echo $schedule->team_two_id;?>/<?php echo $schedule->match_id;?>">Add Scorecard</a> |
                  <a href="#">Delete</a>
                </div>
              </div>
            <?php } 
          } else { ?>
            <h2>Currently no schedule is added.</h2>
          <?php } ?>
        </div>
      </div>
    </div>

    <!-- Add Rules Section -->
    <div id="add-rules" class="card">
      <div class="card-header">Add Rules</div>
      <div class="card-body">
        <form action="<?php echo base_url(); ?>TournamentController/add_rules" method="POST">
          <div class="mb-3">
            <label for="ruleDescription" class="form-label">Rule Description</label>
            <textarea class="form-control" id="ruleDescription" name="league_rule" rows="3" required></textarea>
          </div>
          <input type="hidden" value="<?php echo $league['league_id']; ?>" name="league_id">
          <button type="submit" class="btn btn-primary">Add Rule</button>
        </form>

        <!-- Rules List -->
        <div class="rules-list">
          <?php if (!empty($league_rules)) { 
            foreach ($league_rules as $rule) { ?>
              <div class="rule-item">
                <span>. <?php echo $rule->league_rule; ?></span>
                <a href="#" class="edit-link" data-bs-toggle="modal" data-bs-target="#editRuleModal" data-rule-id="<?php echo $rule->league_rules_id; ?>" data-rule-description="<?php echo $rule->league_rule; ?>">Edit</a>
              </div>
            <?php } 
          } else { 
            echo "No rules are mentioned yet. Add new rules of the league";
          } ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Schedule Modal -->
  <div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addScheduleModalLabel">Add Schedule</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url(); ?>ScheduleController/add_schedule" method="POST">
            <div class="mb-3">
              <label for="series" class="form-label">Series: <?php echo $league['league_name']; ?></label>
              <input type="hidden" class="form-control" id="series" name="series" value="<?php echo $league['league_name']; ?>" required>
            </div>
            <div class="mb-3">
              <label for="match-type" class="form-label">Match Type: <?php echo $league['match_type']; ?></label>
              <input type="hidden" name="match_type" value="<?php echo $league['match_type']; ?>">
            </div>
            <div class="form-group mb-3">
              <label for="ball_type">First Team</label>
              <select id="team1" name="team1" class="form-control" required>
                <option value="" disabled selected>Select First Team</option>
                <?php if (!empty($league_teams)) { 
                  foreach ($league_teams as $l_teams) { ?>
                    <option value="<?php echo $l_teams['team_id']; ?>"><?php echo $l_teams['team_name']; ?></option>
                  <?php } 
                } ?>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="ball_type">Second Team</label>
              <select id="team2" name="team2" class="form-control" required>
                <option value="" disabled selected>Select Second Team</option>
                <?php if (!empty($league_teams)) { 
                  foreach ($league_teams as $l_teams) { ?>
                    <option value="<?php echo $l_teams['team_id']; ?>"><?php echo $l_teams['team_name']; ?></option>
                  <?php } 
                } ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="match-date" class="form-label">Match Date</label>
              <input type="date" class="form-control" id="match-date" name="match_date" required>
            </div>
            <input type="hidden" value="<?php echo $league['league_id']; ?>" name="league_id">
            <div class="mb-3">
              <label for="match-time" class="form-label">Match Time</label>
              <input type="time" class="form-control" id="match-time" name="match_time" required>
            </div>
            <div class="mb-3">
              <label for="overs" class="form-label">Overs</label>
              <input type="number" class="form-control" id="overs" value="<?php echo $league['overs']; ?>" name="overs" placeholder="Enter Number of Overs" required>
            </div>
            <div class="mb-3">
              <label for="location" class="form-label">Location</label>
              <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" required>
            </div>
            <div class="mb-3">
              <label for="umpires" class="form-label">Umpires</label>
              <input type="text" class="form-control" id="umpires" name="umpire1" placeholder="Enter First Umpires Names">
            </div>
            <div class="mb-3">
              <label for="umpires" class="form-label">Umpires</label>
              <input type="text" class="form-control" id="umpires" name="umpire2" placeholder="Enter Second Umpires Names">
            </div>
            <button type="submit" class="btn-submit">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Schedule Modal -->
  <div class="modal fade" id="editScheduleModal" tabindex="-1" aria-labelledby="editScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editScheduleModalLabel">Edit Schedule</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editScheduleForm" action="<?php echo base_url(); ?>ScheduleController/edit_schedule" method="POST">
            <div class="mb-3">
              <label for="editSeries" class="form-label">Series: <?php echo $league['league_name']; ?></label>
              <input type="hidden" class="form-control" id="editSeries" name="series" value="<?php echo $league['league_name']; ?>" required>
            </div>
            <div class="mb-3">
              <label for="editMatchType" class="form-label">Match Type: <?php echo $league['match_type']; ?></label>
              <input type="hidden" name="match_type" value="<?php echo $league['match_type']; ?>">
            </div>
            <div class="form-group mb-3">
              <label for="editTeam1" class="form-label">First Team</label>
              <select id="editTeam1" name="team1" class="form-control" required>
                <option value="" disabled selected>Select First Team</option>
                <?php if (!empty($league_schedule)) { 
            foreach ($league_schedule as $schedule) { ?>
                    <option value="<?php echo $schedule->team_one_id; ?>"><?php echo $schedule->team_one_name; ?></option>
              <?php } } ?>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="editTeam2" class="form-label">Second Team</label>
              <select id="editTeam2" name="team2" class="form-control" required>
               
                <?php if (!empty($league_teams)) { 
                  foreach ($league_teams as $l_teams) { ?>
                    <option value="<?php echo $l_teams['team_id']; ?>"><?php echo $l_teams['team_name']; ?></option>
                  <?php } 
                } ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="editMatchDate" class="form-label">Match Date</label>
              <input type="date" class="form-control" id="editMatchDate" name="match_date" required>
            </div>
            <div class="mb-3">
              <label for="editMatchTime" class="form-label">Match Time</label>
              <input type="time" class="form-control" id="editMatchTime" name="match_time" required>
            </div>
            <div class="mb-3">
              <label for="editOvers" class="form-label">Overs</label>
              <input type="number" class="form-control" id="editOvers" name="overs" placeholder="Enter Number of Overs" required>
            </div>
            <div class="mb-3">
              <label for="editLocation" class="form-label">Location</label>
              <input type="text" class="form-control" id="editLocation" name="location" placeholder="Enter Location" required>
            </div>
            <div class="mb-3">
              <label for="editUmpire1" class="form-label">Umpires</label>
              <input type="text" class="form-control" id="editUmpire1" name="umpire1" placeholder="Enter First Umpires Names">
            </div>
            <div class="mb-3">
              <label for="editUmpire2" class="form-label">Umpires</label>
              <input type="text" class="form-control" id="editUmpire2" name="umpire2" placeholder="Enter Second Umpires Names">
            </div>
            <input type="hidden" id="editScheduleId" name="schedule_id">
            <input type="hidden" value="<?php echo $league['league_id']; ?>" name="league_id">
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Rule Modal -->
  <div class="modal fade" id="editRuleModal" tabindex="-1" aria-labelledby="editRuleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editRuleModalLabel">Edit Rule</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editRuleForm" action="<?php echo base_url(); ?>TournamentController/update_rules" method="POST">
            <div class="mb-3">
              <label for="editRuleDescription" class="form-label">Rule Description</label>
              <textarea class="form-control" id="editRuleDescription" name="league_rule" rows="3" required></textarea>
            </div>
            <input type="hidden" id="editRuleId" name="rule_id">
            <input type="hidden" value="<?php echo $league['league_id']; ?>" name="league_id">
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // JavaScript to handle the edit schedule modal
    document.addEventListener('DOMContentLoaded', function() {
      var editScheduleModal = document.getElementById('editScheduleModal');
      editScheduleModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var scheduleId = button.getAttribute('data-schedule-id'); // Extract schedule ID
        var team1 = button.getAttribute('data-team1'); // Extract team 1 ID
        var team2 = button.getAttribute('data-team2'); // Extract team 2 ID
        var matchDate = button.getAttribute('data-match-date'); // Extract match date
        var matchTime = button.getAttribute('data-match-time'); // Extract match time
        var location = button.getAttribute('data-location'); // Extract location
        var overs = button.getAttribute('data-overs'); // Extract overs
        var umpire1 = button.getAttribute('data-umpire1'); // Extract umpire 1
        var umpire2 = button.getAttribute('data-umpire2'); // Extract umpire 2

        // Update the modal's content.
        var scheduleIdInput = editScheduleModal.querySelector('#editScheduleId');
        var team1Input = editScheduleModal.querySelector('#editTeam1');
        var team2Input = editScheduleModal.querySelector('#editTeam2');
        var matchDateInput = editScheduleModal.querySelector('#editMatchDate');
        var matchTimeInput = editScheduleModal.querySelector('#editMatchTime');
        var locationInput = editScheduleModal.querySelector('#editLocation');
        var oversInput = editScheduleModal.querySelector('#editOvers');
        var umpire1Input = editScheduleModal.querySelector('#editUmpire1');
        var umpire2Input = editScheduleModal.querySelector('#editUmpire2');

        scheduleIdInput.value = scheduleId;
        team1Input.value = team1;
        team2Input.value = team2;
        matchDateInput.value = matchDate;
        matchTimeInput.value = matchTime;
        locationInput.value = location;
        oversInput.value = overs;
        umpire1Input.value = umpire1;
        umpire2Input.value = umpire2;
      });
    });

    // JavaScript to handle the edit rule modal
    document.addEventListener('DOMContentLoaded', function() {
      var editRuleModal = document.getElementById('editRuleModal');
      editRuleModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var ruleId = button.getAttribute('data-rule-id'); // Extract rule ID
        var ruleDescription = button.getAttribute('data-rule-description'); // Extract rule description

        // Update the modal's content.
        var ruleDescriptionInput = editRuleModal.querySelector('#editRuleDescription');
        var ruleIdInput = editRuleModal.querySelector('#editRuleId');

        ruleDescriptionInput.value = ruleDescription;
        ruleIdInput.value = ruleId;
      });
    });
  </script>
</body>
</html>