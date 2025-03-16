<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cricket Scorecard Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Helvetica Neue', sans-serif;
      font-size: 0.85rem;
      color: #333;
      margin-bottom: 60px; /* Space for fixed footer */
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
      font-size: 0.8rem;
      color: #333;
      margin-top: 5px;
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
      margin-top: 10px;
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
      background-color: #28a745;
      color: white;
      border: none;
      padding: 2px 5px; /* Smaller padding */
      border-radius: 4px;
      font-size: 0.7rem; /* Smaller font size */
      margin: 1px; /* Smaller margin */
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
      font-size: 0.7rem;  /* Smaller font size */
      padding: 6px 10px;  /* Smaller padding for compact size */
      border-radius: 4px;  /* Slightly rounded corners */
      margin: 2px;  /* Smaller margin for tighter spacing */
      transition: background-color 0.3s ease;
    }

    /* Insert Bowling Button (Smaller Size) */
    .action-btn-container .btn-primary {
      font-size: 0.75rem; /* Smaller font size for this button */
      padding: 6px 8px;  /* Slightly smaller padding */
      border-radius: 4px;
    }

    /* Add Bowling Button (Smaller Size) */
    .action-btn-container .btn-success {
      font-size: 0.75rem; /* Smaller font size for this button */
      padding: 6px 8px;  /* Slightly smaller padding */
      border-radius: 4px;
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
      font-size: 0.7rem; /* Smaller font size */
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
        font-size: 0.7rem;
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
        gap: 13px; /* Smaller gap */
      }

      .action-btn-container .btn {
        font-size: 0.65rem; /* Smaller font size */
        padding: 3px; /* Smaller padding */
      }

      .footer-links a {
        font-size: 0.65rem; /* Smaller font size */
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
    $batting_second = $toss_id['bowl_first'];
    $bowl_second = $toss_id['bat_first'];
   
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

    <h4 class="text-left mt-1">Second Inning (bowling)</h4>
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
          <?php  if($bowling_second == 0){ echo "<tr><td colspan='6' class='text-center'>Add batting record of first innings</td></tr>"; } else { 
            foreach($bowling_second as $bowl) { 
            ?>
            <tr>
              <td><?php echo $bowl->playerName; ?></td>
              <td><?php echo $bowl->overs; ?></td>
              <td><?php echo $bowl->given_runs; ?></td>
              <td><?php echo $bowl->wickets; ?></td>
              <td><?php echo number_format($bowl->given_runs/$bowl->overs, 2); ?></td>
              <td>
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
      <input type="hidden" name="bowling_order" value="2">
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
     <a href="<?php echo base_url();?>Welcome/scorecard_links//<?php echo $bowl_second;?>/<?php echo $batting_second;?>/<?php echo $match_id;?>">
          <button class="btn btn-success next-btn">NEXT</button>
        </a>

    </div>
  </div>

  <!-- Modal for Scorecard Form -->
  <div class="modal fade" id="scorecardModal" tabindex="-1" aria-labelledby="scorecardModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="scorecardModalLabel">Insert Scorecard</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url();?>/ScorecardController/add_bowling" method="POST">
            <input type="hidden" value="<?php echo $match_id;?>" name="match_id">
            <input type="hidden" value="<?php echo $wintossid;?>" name="team_one_id">
            <input type="hidden" value="<?php echo $batting_second;?>" name="batting_team">
            <input type="hidden" value="<?php echo $bowl_second;?>" name="bowling_team">
                <input type="hidden" value="2" name="bowling_order">
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
              <label for="balls" class="form-label">Overs</label>
              <input type="number" class="form-control" id="balls" name="overs" required>
            </div>
            <div class="mb-3">
              <label for="runs" class="form-label">Runs</label>
              <input type="number" class="form-control" id="runs" name="given_runs" required>
            </div>
            <div class="mb-3">
              <label for="fours" class="form-label">Wickets</label>
              <input type="number" class="form-control" id="fours" name="wickets">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
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
  <!-- Footer Section -->
  <div class="footer">
    <div class="footer-links">
      <a href="#">Home</a>
      <a href="#">About</a>
      <a href="#">Contact</a>
      <a href="#">FAQ</a>
    </div>
  </div>

  <!-- Bootstrap JS & jQuery -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
