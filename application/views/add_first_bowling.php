<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cricket Scorecard Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts (Inter font) -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif; /* Modern font */
      font-size: 1rem; /* Adjusted for better readability */
      color: #444;
      line-height: 1.6;
      background-color: #f8f9fa;
      margin-bottom: 60px; /* Space for fixed footer */
    }

    h4 {
      font-size: 1.25rem; /* Slightly larger for headings */
      color: #222; /* Darker for better contrast */
    }

    .container {
      max-width: 900px;
      margin-top: 10px;
      padding: 10px;
    }

    /* Team and Toss Section */
    .team-info {
      text-align: center;
      margin-bottom: 15px;
    }

    .team-card {
      background-color: #ffffff;
      border: 1px solid #e0e0e0;
      border-radius: 10px;
      padding: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .team-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .team-logo {
      width: 35px;
      height: 35px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #007bff;
    }

    .team-name {
      font-weight: 600;
      font-size: 0.9rem; /* Updated for better readability */
      color: #333;
      margin-top: 8px; /* Adjusted for spacing */
    }

    .vs-badge {
      background-color: #007bff;
      color: white;
      border-radius: 50%;
      width: 35px;
      height: 35px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: 0.9rem;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .toss-result {
      margin-top: 12px; /* Adjusted margin for better separation */
    }

    .toss-badge {
      background-color: #28a745;
      color: white;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 500;
      display: inline-block;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Scorecard Table */
    .table th, .table td {
      text-align: center;
      padding: 4px 6px;
      font-size: 0.75rem;
    }

    .table th {
      background-color: #007bff;
      color: white;
      font-size: 0.8rem;
    }

    /* Action Buttons */
    .action-btn {
      text-transform: uppercase;
      padding: 6px 12px;
      font-weight: 600;
      font-size: 0.75rem;
      border-radius: 4px;
      margin: 1px;
      transition: background-color 0.3s ease;
    }

    .action-btn:hover {
      background-color: #218838;
    }

    .action-btn.delete-btn {
      background-color: #dc3545;
    }

    .action-btn.delete-btn:hover {
      background-color: #c82333;
    }

    .action-btn.edit-btn {
      background-color: #ffc107;
    }

    .action-btn.edit-btn:hover {
      background-color: #e0a800;
    }

    /* Buttons in Row */
    .action-btn-container {
      display: flex;
      justify-content: space-between;
      gap: 4px; /* Smaller gap */
      margin-top: 8px;
    }

    .action-btn-container .btn {
      font-size: 0.75rem;  /* Smaller font size */
      padding: 6px 12px;  /* Smaller padding for compact size */
      border-radius: 4px;  /* Slightly rounded corners */
    }

    /* Footer */
    .footer {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background-color: #f8f9fa;
      padding: 6px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      z-index: 1000;
      border-top: 1px solid #ddd;
    }

    .footer-links {
      display: flex;
      justify-content: space-between;
      width: 100%;
    }

    .footer-links a {
      text-decoration: none;
      color: #007bff;
      padding: 4px 8px;
      font-size: 0.7rem;
      font-weight: bold;
      text-align: center;
      border-radius: 4px;
      transition: background-color 0.3s;
    }

    .footer-links a:hover {
      background-color: #e2e6ea;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .team-logo {
        width: 25px;
        height: 25px;
      }

      .team-name {
        font-size: 0.8rem;
      }

      .vs-badge {
        width: 25px;
        height: 25px;
        font-size: 0.8rem;
      }

      .toss-badge {
        font-size: 0.7rem;
        padding: 4px 8px;
      }

      .table th, .table td {
        font-size: 0.7rem;
        padding: 3px 5px;
      }

      .action-btn-container {
        flex-direction: row;
        gap: 13px;
      }

      .action-btn-container .btn {
        font-size: 0.65rem;
        padding: 3px;
      }

      .footer-links a {
        font-size: 0.65rem;
        padding: 3px 6px;
      }
    }
  </style>
</head>
<body>
  <?php 
    // PHP code for handling toss and other data
    foreach($toss_winner as $toss_win) {
      $wintossname = $toss_win->team_name;
    } 
    $wintossid = $toss_id['toss_winner'];
    $batting_first = $toss_id['bat_first'];
    $bowl_first = $toss_id['bowl_first'];
    $total_runs = 0; // Initialize the total runs variable
    $extras = 0; // Initialize extras variable
  ?>

  <div class="container">
    <!-- Team and Toss Information -->
    <div class="team-info">
      <div class="d-flex justify-content-center align-items-center">
        <!-- Team 1 -->
        <?php foreach($team_one as $t_one) { ?>
          <div class="team-card text-center mx-2">
            <img src="<?php echo $t_one->image_path;?>" alt="Team 1" class="team-logo">
            <div class="team-name mt-1"><?php echo $t_one->team_name;?></div>
          </div>
        <?php } ?>

        <!-- VS Badge -->
        <div class="vs-badge mx-2">
          <span class="vs-text">VS</span>
        </div>

        <!-- Team 2 -->
        <?php foreach($team_two as $t_two) { ?>
          <div class="team-card text-center mx-2">
            <img src="<?php echo $t_two->image_path;?>" alt="Team 2" class="team-logo">
            <div class="team-name mt-1"><?php echo $t_two->team_name;?></div>
          </div>
        <?php } ?>
      </div>

      <!-- Toss Result -->
      <div class="toss-result text-center mt-2">
        <div class="toss-badge">
          <span class="toss-text"><?php echo $wintossname; ?> won the toss and chose to <?php echo strtolower($decision); ?>.</span>
        </div>
      </div>
    </div>

    <h4 class="text-left mt-1">First Inning (bowling)</h4>
    <!-- Scorecard Table -->
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
        <tr>
          <th>Player Name</th>
          <th>Overs</th>
          <th>Runs</th>
          <th>Wickets</th>
          <th>Economy</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
          <?php  if($bowling_first == 0){ echo "<tr><td colspan='6' class='text-center'>Add batting record of first innings</td></tr>"; } else { 
            foreach($bowling_first as $bowl) { 
            ?>
            <tr>
              <td><?php echo $bowl->playerName; ?></td>
              <td><?php echo $bowl->overs; ?></td>
              <td><?php echo $bowl->given_runs; ?></td>
              <td><?php echo $bowl->wickets; ?></td>
              <td><?php echo number_format($bowl->given_runs/$bowl->overs, 2); ?></td>
               <td>
                <!-- Edit Button to trigger the modal -->
                <button class="btn btn-warning btn-sm edit-btn" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editModal"
                        data-id="<?php echo $bowl->player_id; ?>"
                        data-bowling-order="<?php echo $bowl->bowling_order; ?>"
                        data-player_name="<?php echo $bowl->playerName; ?>"
                        data-overs="<?php echo $bowl->overs; ?>"
                        data-runs="<?php echo $bowl->given_runs; ?>"
                        data-wickets="<?php echo $bowl->wickets; ?>">Edit</button>
              
                <form action="<?php echo base_url(); ?>/ScorecardController/delete_bowling_record" method="POST" style="display:inline;">
    <input type="hidden" name="match_id" value="<?php echo $match_id; ?>">
    <input type="hidden" name="player_id" value="<?php echo $bowl->player_id; ?>">
      <input type="hidden" name="bowling_order" value="<?php echo $bowl->bowling_order; ?>">
    <button type="submit" class="action-btn delete-btn btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
  </form>
              </td>
            </tr>
          <?php } } ?>
        </tbody>
      </table>
    </div>

    <!-- Action Buttons in Row -->
    <div class="action-btn-container">
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scorecardModal">Insert Bowling</button>
      <a href="<?php echo base_url();?>ScorecardController/add_second_batting/<?php echo $match_id;?>/<?php echo $bowl_first;?>/<?php echo $batting_first;?>">
        <button class="btn btn-success next-btn">Add 2nd Batting</button>
      </a>
    </div>
  </div>

  <!-- Modal for Scorecard Form -->
  <div class="modal fade" id="scorecardModal" tabindex="-1" aria-labelledby="scorecardModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="scorecardModalLabel">Insert Bowling</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      
        <div class="player_modal-body">
          <form action="<?php echo base_url();?>/ScorecardController/add_bowling" method="POST">
            <input type="hidden" value="<?php echo $match_id;?>" name="match_id">
            <input type="hidden" value="<?php echo $wintossid;?>" name="team_one_id">
            <input type="hidden" value="<?php echo $batting_first;?>" name="batting_team">
            <input type="hidden" value="<?php echo $bowl_first;?>" name="bowling_team">
            <input type="hidden" value="1" name="bowling_order">
            <div class="mb-3">
              <label for="player-name" class="form-label">Player Name</label>
              <select class="form-select" id="player-name" name="player_id" required>
                <option value="" disabled selected>Select Player</option>

                 <?php foreach($player_info as $player_name){ ?>
                <option value="<?php echo $player_name->player_id;?>"><?php echo $player_name->playerName;?></option>
                <?php } ?>
              </select>

            </div>
            <div class="mb-3">
              <label for="overs" class="form-label">Overs</label>
              <input type="number" class="form-control" id="overs" name="overs" required>
            </div>
            <div class="mb-3">
              <label for="runs" class="form-label">Runs</label>
              <input type="number" class="form-control" id="runs" name="given_runs" required>
            </div>
            <div class="mb-3">
              <label for="wickets" class="form-label">Wickets</label>
              <input type="number" class="form-control" id="wickets" name="wickets" required>
            </div>
            <div class="modal-footer">
             
              <button type="submit" class="btn btn-primary">Save Bowling</button>
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Bowling Stats</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url();?>/ScorecardController/edit_bowling" method="POST">
            <input type="hidden" id="edit-id" name="player_id">
            <!-- Hidden input for match_id -->
            <input type="hidden" name="match_id" value="<?php echo $match_id; ?>">
           <input type="hidden" id="edit-bowling-order" name="bowling_order">


             <div class="mb-3">
              <label for="edit-player-name" class="form-label">Player Name</label>
              <input type="text" class="form-control" id="edit-player-name" name="player_name" readonly>
            </div>
            <div class="mb-3">
              <label for="edit-overs" class="form-label">Overs</label>
              <input type="number" class="form-control" id="edit-overs" name="overs" required>
            </div>
            <div class="mb-3">
              <label for="edit-runs" class="form-label">Runs</label>
              <input type="number" class="form-control" id="edit-runs" name="given_runs" required>
            </div>
            <div class="mb-3">
              <label for="edit-wickets" class="form-label">Wickets</label>
              <input type="number" class="form-control" id="edit-wickets" name="wickets" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
  // JavaScript to fill the modal with the current bowler's data when the edit button is clicked
var editModal = document.getElementById('editModal');
editModal.addEventListener('show.bs.modal', function(event) {
  var button = event.relatedTarget; // Button that triggered the modal
  var bowlerId = button.getAttribute('data-id');
  var playerName = button.getAttribute('data-player_name');
  var overs = button.getAttribute('data-overs');
  var runs = button.getAttribute('data-runs');
  var wickets = button.getAttribute('data-wickets');
  var bowlingOrder = button.getAttribute('data-bowling-order'); // Get the bowling_order value
  
  // Fill the modal form fields with the current values
  var modalId = editModal.querySelector('#edit-id');
  var modalPlayerName = editModal.querySelector('#edit-player-name');
  var modalOvers = editModal.querySelector('#edit-overs');
  var modalRuns = editModal.querySelector('#edit-runs');
  var modalWickets = editModal.querySelector('#edit-wickets');
  var modalBowlingOrder = editModal.querySelector('#edit-bowling-order'); // Bowling order hidden input
  
  modalId.value = bowlerId;
  modalPlayerName.value = playerName;
  modalOvers.value = overs;
  modalRuns.value = runs;
  modalWickets.value = wickets;
  modalBowlingOrder.value = bowlingOrder; // Set the bowling_order value
});

  </script>
  <!-- Footer -->
  <div class="footer">
    <div class="footer-links">
      <a href="#">Privacy Policy</a>
      <a href="#">Terms of Service</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
