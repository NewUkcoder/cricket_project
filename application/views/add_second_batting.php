<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Helvetica Neue', sans-serif;
      font-size: 0.85rem;
      margin-bottom: 60px;
    }
    .container {
      max-width: 900px;
      margin-top: 10px;
      padding: 10px;
    }
    .team-card {
      background-color: #ffffff;
      border: 1px solid #e0e0e0;
      border-radius: 10px;
      padding: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .team-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .team-logo {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #007bff;
    }
    .vs-badge {
      background-color: #007bff;
      color: white;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: 1rem;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .toss-badge {
      background-color: #28a745;
      color: white;
      padding: 8px 16px;
      border-radius: 20px;
      font-size: 0.9rem;
      font-weight: 500;
      display: inline-block;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .table th {
      background-color: #007bff;
      color: white;
    }
    .action-btn {
      background-color: #28a745;
      color: white;
      border: none;
      padding: 4px 8px;
      border-radius: 5px;
      font-size: 0.8rem;
      margin: 2px;
      transition: background-color 0.3s ease;
    }
    .action-btn.delete-btn {
      background-color: #dc3545;
    }
    .action-btn.edit-btn {
      background-color: #ffc107;
    }
    .footer {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background-color: #f8f9fa;
      padding: 8px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      z-index: 1000;
      border-top: 1px solid #ddd;
    }
    .footer-links a {
      text-decoration: none;
      color: #007bff;
      padding: 6px 10px;
      font-size: 0.8rem;
      font-weight: bold;
      text-align: center;
      border-radius: 5px;
      transition: background-color 0.3s;
    }
    .footer-links a:hover {
      background-color: #e2e6ea;
    }
    @media (max-width: 768px) {
      .team-logo {
        width: 25px;
        height: 25px;
      }
      .table th, .table td {
        font-size: 0.75rem;
        padding: 3px 6px;
      }
      .action-btn-container {
        flex-direction: row;
        align-items: flex-start;
      }
      .action-btn-container .btn {
        margin-bottom: 5px;
        font-size: 0.7rem;
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
    $bowling_second = $toss_id['bat_first'];
    $batting_second = $toss_id['bowl_first'];

    if($get_extra1 == 0) {
      $totalExtras = "Click on Add extras to add it";
    } else {
      foreach($get_extra1 as $t_extra) {
        $totalExtras = $t_extra->wides + $t_extra->no_balls + $t_extra->byes + $t_extra->leg_byes;
      }
    }
    if($all_score == 0) {
      $total_score = "Click on Add extras to add it";
    } else {
      foreach($all_score as $total) {
        $total_score = $total->total_runs;
        $wickets = $total->wickets;
      }
    }
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
        <div class="vs-badge mx-3">
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
      <div class="toss-result text-center mt-3">
        <div class="toss-badge">
          <span class="toss-text"><?php echo $wintossname; ?> won the toss and chose to <?php echo strtolower($decision); ?>.</span>
        </div>
      </div>
    </div>

    <h4 class="text-left mt-1">Second Inning (Batting)</h4>
    <!-- Scorecard Table -->
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Player</th>
            <th>Runs</th>
            <th>Balls</th>
            <th>4s</th>
            <th>6s</th>
           
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if($bat_second == null) { ?>
            <tr><td colspan="8" class="text-center">Add batting record of second innings</td></tr>
          <?php } else { 
            foreach($bat_second as $bat) { 
              $strike_rate = ($bat->balls > 0) ? round(($bat->runs / $bat->balls) * 100, 2) : 0;
              ?>
              <tr>
                 <td><b><?php echo $bat->playerName; ?></b><p><?php echo $bat->dismissal;?> <?php  if ($bat->dismissal === 'Not Out' || $bat->dismissal === 'Run Out') {
   echo "" ; }else { echo ", " . $bat->bowler_name;}
  ?></p></td>
                <td><?php echo $bat->runs; ?></td>
                <td><?php echo $bat->balls; ?></td>
                <td><?php echo $bat->fours; ?></td>
                <td><?php echo $bat->sixes; ?></td>
               
                <td>
                  <button class="action-btn edit-btn btn-sm" data-bs-toggle="modal" data-bs-target="#editScorecardModal"
                          data-match-id="<?php echo $match_id;?>"
                          data-player-id="<?php echo $bat->player_id;?>"
                          data-batting-order="<?php echo $bat->batting_order;?>"
                          data-runs="<?php echo $bat->runs;?>"
                          data-balls="<?php echo $bat->balls;?>"
                          data-fours="<?php echo $bat->fours;?>"
                          data-sixes="<?php echo $bat->sixes;?>"
                          data-dismissal="<?php echo $bat->dismissal ?? ''; ?>"
                          data-bowler-id="<?php echo $bat->bowler_id ?? ''; ?>">Edit</button>
                  <form action="<?php echo base_url(); ?>/ScorecardController/delete_score" method="POST" style="display:inline;">
                    <input type="hidden" name="match_id" value="<?php echo $match_id; ?>">
                    <input type="hidden" name="player_id" value="<?php echo $bat->player_id; ?>">
                    <input type="hidden" name="batting_order" value="2">
                    <button type="submit" class="action-btn delete-btn btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                  </form>
                </td>
              </tr>
            <?php } } ?>
          <!-- Total Score Row -->
          <tr>
            <td colspan="2"><strong>Extras</strong></td>
            <td colspan="3"><strong><?php echo $totalExtras; ?></strong></td>
            <td>
              <?php if($get_extra1 != 0) { foreach($get_extra1 as $t_extra) { ?>
                <button class="action-btn edit-extras-btn btn-sm" data-bs-toggle="modal" data-bs-target="#editExtrasModal"
                        data-match-id="<?php echo $match_id; ?>"
                        data-batting-order="<?php echo $t_extra->batting_order; ?>"
                        data-wides="<?php echo $t_extra->wides; ?>"
                        data-no-balls="<?php echo $t_extra->no_balls; ?>"
                        data-byes="<?php echo $t_extra->byes; ?>"
                        data-leg-byes="<?php echo $t_extra->leg_byes; ?>">Edit</button>
              <?php } } else { ?>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#extrasModal">Add Extras</button>
              <?php } ?>
            </td>
          </tr>
          <!-- Total Score Row -->
          <tr>
            <td colspan="2"><strong>Total Score</strong></td>
            <td colspan="3"><strong><?php if($all_score == 0) { echo "Add total runs and fall of wickets by clicking on add total runs"; ?></td>
            <td><button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#totalRunsModal">Add Total Runs</button></td>
            <?php } else { echo $total_score; ?>/<?php echo $wickets; ?></strong></td>
            <td>
              <?php foreach($all_score as $t_score) { ?>
                <button class="action-btn edit-btn btn-sm" data-bs-toggle="modal" data-bs-target="#editTotalScoreModal"
                        data-total-runs="<?php echo $t_score->total_runs; ?>"
                        data-wickets="<?php echo $t_score->wickets; ?>"
                        data-match-id="<?php echo $t_score->match_id; ?>"
                        data-batting-order="<?php echo $t_score->batting_order; ?>">Edit</button>
              <?php } } ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Action Buttons in Row -->
    <div class="action-btn-container">
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scorecardModal">Insert Scorecard</button>
      <a href="<?php echo base_url();?>Welcome/scorecard_links//<?php echo $bowling_second;?>/<?php echo $batting_second;?>/<?php echo $match_id;?>">
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
          <form action="<?php echo base_url();?>/ScorecardController/insert_batting" method="POST" onsubmit="return validateScorecard()">
            <input type="hidden" value="<?php echo $match_id;?>" name="match_id">
            <input type="hidden" value="<?php echo $wintossid;?>" name="team_one_id">
            <input type="hidden" value="<?php echo $bowling_second;?>" name="bowling_team">
            <input type="hidden" value="<?php echo $batting_second;?>" name="batting_team">
            <input type="hidden" value="2" name="batting_order">
            <div class="mb-3">
              <label for="player-name" class="form-label">Player Name</label>
              <select class="form-select" id="player-name" name="player_id" required>
                <option value="" disabled selected>Select Player</option>
                <?php foreach($player_info as $player_name) { ?>
                  <option value="<?php echo $player_name->player_id;?>"><?php echo $player_name->playerName;?></option>
                <?php } ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="runs" class="form-label">Runs</label>
              <input type="number" class="form-control" id="runs" name="runs" required>
            </div>
            <div class="mb-3">
              <label for="balls" class="form-label">Balls</label>
              <input type="number" class="form-control" id="balls" name="balls" required>
            </div>
            <div class="mb-3">
              <label for="fours" class="form-label">4s</label>
              <input type="number" class="form-control" id="fours" name="fours" required>
            </div>
            <div class="mb-3">
              <label for="sixes" class="form-label">6s</label>
              <input type="number" class="form-control" id="sixes" name="sixes" required>
            </div>
            <div class="mb-3">
              <label for="dismissal" class="form-label">Dismissal</label>
              <select class="form-select" id="dismissal" name="dismissal">
                <option value="Not Out">Not Out</option>
                <option value="Bowled">Bowled</option>
                <option value="Caught">Caught</option>
                <option value="LBW">LBW</option>
                <option value="Run Out">Run Out</option>
                <option value="Stumped">Stumped</option>
                <option value="Hit Wicket">Hit Wicket</option>
              </select>
            </div>
            <div class="mb-3" id="bowler-section">
              <label for="bowler-name" class="form-label">Bowler Name</label>
              <select class="form-select" id="bowler-name" name="bowler_id">
                <option value="" disabled selected>Select Bowler</option>
                <?php foreach($bowler_info as $bowler) { ?>
                  <option value="<?php echo $bowler->player_id;?>"><?php echo $bowler->playerName;?></option>
                <?php } ?>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
          </form>
      </div>
    </div>
  </div>

  <!-- Modal for Total Runs -->
  <div class="modal fade" id="totalRunsModal" tabindex="-1" aria-labelledby="totalRunsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="totalRunsModalLabel">Add Total Runs</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url();?>/ScorecardController/insert_total_score" method="POST">
            <div class="mb-3">
              <label for="total-runs" class="form-label">Total Runs</label>
              <input type="number" class="form-control" id="total-runs" name="total_runs" required>
              <label for="t-overs" class="form-label">Total Overs</label>
              <input type="number" class="form-control" id="t-overs" name="t_overs" required>
              <label for="total-runs" class="form-label">Wickets</label>
              <input type="number" class="form-control" id="total-runs" name="wickets" required>
              <input type="hidden" value="<?php echo $match_id;?>" name="match_id">
              <input type="hidden" value="<?php echo $batting_second;?>" name="batting_team_id">
              <input type="hidden" value="2" name="batting_order">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
          </form>
      </div>
    </div>
  </div>

  <!-- Modal for Extras -->
  <div class="modal fade" id="extrasModal" tabindex="-1" aria-labelledby="extrasModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="extrasModalLabel">Add Extras</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url();?>/ScorecardController/insert_extras" method="POST">
            <input type="hidden" value="<?php echo $match_id;?>" name="match_id">
            <input type="hidden" value="<?php echo $batting_second;?>" name="batting_team_id">
            <input type="hidden" value="2" name="batting_order">
            <div class="mb-3">
              <label for="extras-runs" class="form-label">Wide</label>
              <input type="number" class="form-control" id="extras-runs" name="wides">
            </div>
            <div class="mb-3">
              <label for="extras-runs" class="form-label">No Ball</label>
              <input type="number" class="form-control" id="extras-runs" name="no_balls">
            </div>
            <div class="mb-3">
              <label for="extras-runs" class="form-label">Byes</label>
              <input type="number" class="form-control" id="extras-runs" name="byes">
            </div>
            <div class="mb-3">
              <label for="extras-runs" class="form-label">Leg Byes</label>
              <input type="number" class="form-control" id="extras-runs" name="leg_byes">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
          </form>
      </div>
    </div>
  </div>

  <!-- Modal for Edit Scorecard -->
  <div class="modal fade" id="editScorecardModal" tabindex="-1" aria-labelledby="editScorecardModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editScorecardModalLabel">Edit Scorecard</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url();?>/ScorecardController/edit_score" method="POST">
            <input type="hidden" id="edit-match-id" name="match_id">
            <input type="hidden" id="edit-player-id" name="player_id">
            <input type="hidden" value="2" name="batting_order">
            <div class="mb-3">
              <label for="edit-runs" class="form-label">Runs</label>
              <input type="number" class="form-control" id="edit-runs" name="runs" required>
            </div>
            <div class="mb-3">
              <label for="edit-balls" class="form-label">Balls</label>
              <input type="number" class="form-control" id="edit-balls" name="balls" required>
            </div>
            <div class="mb-3">
              <label for="edit-fours" class="form-label">4s</label>
              <input type="number" class="form-control" id="edit-fours" name="fours" required>
            </div>
            <div class="mb-3">
              <label for="edit-sixes" class="form-label">6s</label>
              <input type="number" class="form-control" id="edit-sixes" name="sixes" required>
            </div>
            <div class="mb-3">
              <label for="edit-dismissal" class="form-label">Dismissal</label>
              <select class="form-select" id="edit-dismissal" name="dismissal">
                <option value="Not Out">Not Out</option>
                <option value="Bowled">Bowled</option>
                <option value="Caught">Caught</option>
                <option value="LBW">LBW</option>
                <option value="Run Out">Run Out</option>
                <option value="Stumped">Stumped</option>
                <option value="Hit Wicket">Hit Wicket</option>
              </select>
            </div>
            <div class="mb-3" id="edit-bowler-section">
              <label for="edit-bowler-name" class="form-label">Bowler Name</label>
              <select class="form-select" id="edit-bowler-name" name="bowler_id">
                <option value="" disabled selected>Select Bowler</option>
                <?php foreach($bowler_info as $bowler) { ?>
                  <option value="<?php echo $bowler->player_id;?>"><?php echo $bowler->playerName;?></option>
                <?php } ?>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
          </form>
      </div>
    </div>
  </div>

  <!-- Modal for Edit Extras -->
  <div class="modal fade" id="editExtrasModal" tabindex="-1" aria-labelledby="editExtrasModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editExtrasModalLabel">Edit Extras</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url();?>/ScorecardController/edit_extra" method="POST">
            <input type="hidden" id="edit-match-id" name="match_id">
            <input type="hidden" value="2" name="batting_order">
            <div class="mb-3">
              <label for="edit-wides" class="form-label">Wides</label>
              <input type="number" class="form-control" id="edit-wides" name="wides" required>
            </div>
            <div class="mb-3">
              <label for="edit-no-balls" class="form-label">No Balls</label>
              <input type="number" class="form-control" id="edit-no-balls" name="no_balls" required>
            </div>
            <div class="mb-3">
              <label for="edit-byes" class="form-label">Byes</label>
              <input type="number" class="form-control" id="edit-byes" name="byes" required>
            </div>
            <div class="mb-3">
              <label for="edit-leg-byes" class="form-label">Leg Byes</label>
              <input type="number" class="form-control" id="edit-leg-byes" name="leg_byes" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
          </form>
      </div>
    </div>
  </div>

  <!-- Modal for Edit Total Score -->
  <div class="modal fade" id="editTotalScoreModal" tabindex="-1" aria-labelledby="editTotalScoreModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editTotalScoreModalLabel">Edit Total Score</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editTotalScoreForm" method="POST" action="<?php echo base_url();?>/ScorecardController/edit_total_score">
            <input type="hidden" id="edit-total-match-id" name="match_id">
            <input type="hidden" value="2" name="batting_order">
            <div class="mb-3">
              <label for="edit-total-runs" class="form-label">Total Runs</label>
              <input type="number" class="form-control" id="edit-total-runs" name="total_runs" required>
            </div>
            <div class="mb-3">
              <label for="edit-t-overs" class="form-label">Overs (inning)</label>
              <input type="number" class="form-control" id="edit-t-overs" name="t_overs" required>
            </div>
            <div class="mb-3">
              <label for="edit-wickets" class="form-label">Wickets</label>
              <input type="number" class="form-control" id="edit-wickets" name="wickets" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" form="editTotalScoreForm" class="btn btn-primary">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer Section -->
  <div class="footer">
    <div class="footer-links">
      <a href="#">Home</a>
      <a href="#">About</a>
      <a href="#">Contact</a>
      <a href="#">FAQ</a>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // JavaScript to show/hide bowler section based on dismissal selection
    document.getElementById('dismissal').addEventListener('change', function() {
      var dismissalValue = this.value;
      var bowlerSection = document.getElementById('bowler-section');

      if (dismissalValue === 'Not Out' || dismissalValue === 'Run Out') {
        bowlerSection.style.display = 'none';
      } else {
        bowlerSection.style.display = 'block';
      }
    });

    // Trigger the change event on page load to set the initial state
    document.getElementById('dismissal').dispatchEvent(new Event('change'));

    // Repeat for the edit modal
    document.getElementById('edit-dismissal').addEventListener('change', function() {
      var dismissalValue = this.value;
      var bowlerSection = document.getElementById('edit-bowler-section');

      if (dismissalValue === 'Not Out' || dismissalValue === 'Run Out') {
        bowlerSection.style.display = 'none';
      } else {
        bowlerSection.style.display = 'block';
      }
    });

    // Trigger the change event on page load to set the initial state for the edit modal
    document.getElementById('edit-dismissal').dispatchEvent(new Event('change'));

    // JavaScript to Populate the Edit Modal
    document.addEventListener('DOMContentLoaded', function() {
      var editScorecardModal = document.getElementById('editScorecardModal');
      editScorecardModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var matchId = button.getAttribute('data-match-id');
        var playerId = button.getAttribute('data-player-id');
        var battingOrder = button.getAttribute('data-batting-order');
        var runs = button.getAttribute('data-runs');
        var balls = button.getAttribute('data-balls');
        var fours = button.getAttribute('data-fours');
        var sixes = button.getAttribute('data-sixes');
        var dismissal = button.getAttribute('data-dismissal');
        var bowlerId = button.getAttribute('data-bowler-id');

        // Update the modal's content
        var modalBodyInputMatchId = editScorecardModal.querySelector('#edit-match-id');
        var modalBodyInputPlayerId = editScorecardModal.querySelector('#edit-player-id');
        var modalBodyInputRuns = editScorecardModal.querySelector('#edit-runs');
        var modalBodyInputBalls = editScorecardModal.querySelector('#edit-balls');
        var modalBodyInputFours = editScorecardModal.querySelector('#edit-fours');
        var modalBodyInputSixes = editScorecardModal.querySelector('#edit-sixes');
        var modalBodyInputDismissal = editScorecardModal.querySelector('#edit-dismissal');
        var modalBodyInputBowlerId = editScorecardModal.querySelector('#edit-bowler-name');

        modalBodyInputMatchId.value = matchId;
        modalBodyInputPlayerId.value = playerId;
        modalBodyInputRuns.value = runs;
        modalBodyInputBalls.value = balls;
        modalBodyInputFours.value = fours;
        modalBodyInputSixes.value = sixes;
        modalBodyInputDismissal.value = dismissal;
        modalBodyInputBowlerId.value = bowlerId;
      });
    });

    // Validation for Scorecard Form
    function validateScorecard() {
      const runs = parseInt(document.getElementById('runs').value);
      const balls = parseInt(document.getElementById('balls').value);
      const fours = parseInt(document.getElementById('fours').value);
      const sixes = parseInt(document.getElementById('sixes').value);

      const runsFromBoundaries = (fours * 4) + (sixes * 6);
      if (runsFromBoundaries > runs) {
        alert(`The combination of 4s and 6s exceeds the total runs. 
               Runs from boundaries: ${runsFromBoundaries}, Total runs: ${runs}.`);
        return false;
      }

      if (balls > 0) {
        const strikeRate = (runs / balls) * 100;
        if (strikeRate > 600) {
          alert(`Strike rate cannot exceed 600. Current strike rate is ${strikeRate.toFixed(2)}.`);
          return false;
        }
      } else {
        alert("Balls cannot be zero for strike rate calculation.");
        return false;
      }

      return true;
    }
  </script>
</body>
</html>