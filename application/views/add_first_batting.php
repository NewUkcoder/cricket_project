<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Cricket Scorecard Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* General Styles */
    body {
      background-color: #f8f9fa;
      font-family: 'Helvetica Neue', sans-serif;
      font-size: 0.85rem;
      color: #333;
      margin-bottom: 60px; /* Space for fixed footer */
      -webkit-text-size-adjust: 100%; /* Prevent font scaling in landscape */
    }
    .container {
      max-width: 900px;
      margin-top: 10px;
      padding: 10px;
    }
    .team-info {
      text-align: center;
      margin-bottom: 20px;
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
    .team-name {
      font-weight: 600;
      font-size: 0.9rem;
      color: #333;
      margin-top: 5px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
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
    .vs-text {
      font-size: 0.9rem;
    }
    .toss-result {
      margin-top: 15px;
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
      max-width: 100%;
      white-space: normal;
    }
    .toss-text {
      font-size: 0.9rem;
    }
    .table th, .table td {
      text-align: center;
      padding: 4px 8px;
      font-size: 0.8rem;
      vertical-align: middle;
    }
    .table th {
      background-color: #007bff;
      color: white;
      font-size: 0.9rem;
    }
    .action-btn {
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 0.8rem;
      margin: 2px;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 6px 8px;
      min-width: 60px;
    }
    .action-btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    .action-btn.delete-btn {
      background-color: #dc3545;
    }
    .action-btn.delete-btn:hover {
      background-color: #c82333;
    }
    .action-btn.edit-btn {
      background-color: #ffc107;
      color: #212529;
    }
    .action-btn.edit-btn:hover {
      background-color: #e0a800;
    }
    .action-btn-container {
      display: flex;
      justify-content: space-between;
      gap: 8px;
      margin-top: 15px;
      flex-wrap: wrap;
    }
    .action-btn-container .btn {
      font-size: 0.85rem;
      padding: 8px 12px;
      flex: 1;
      min-width: 120px;
      white-space: nowrap;
    }
    .next-btn {
      background-color: #17a2b8;
      color: white;
    }
    .next-btn:hover {
      background-color: #138496;
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
    .footer-links {
      display: flex;
      justify-content: space-around;
      width: 100%;
      flex-wrap: wrap;
    }
    .footer-links a {
      text-decoration: none;
      color: #007bff;
      padding: 6px 8px;
      font-size: 0.8rem;
      font-weight: bold;
      text-align: center;
      border-radius: 5px;
      transition: background-color 0.3s;
      margin: 2px;
      flex: 1;
      min-width: 60px;
    }
    .footer-links a:hover {
      background-color: #e2e6ea;
    }
    .modal-dialog {
      margin: 10px auto;
    }
    .modal-content {
      border-radius: 10px;
    }
    .modal-body {
      padding: 15px;
    }
    .form-control, .form-select {
      padding: 8px 12px;
      font-size: 0.9rem;
    }
    .btn-sm {
      padding: 5px 10px;
      font-size: 0.75rem;
    }
    .player-dismissal {
      font-size: 0.75rem;
      color: #6c757d;
      margin-top: 3px;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
      body {
        font-size: 0.8rem;
      }
      .container {
        padding: 5px;
      }
      .team-logo {
        width: 30px;
        height: 30px;
      }
      .vs-badge {
        width: 30px;
        height: 30px;
        font-size: 0.8rem;
      }
      .team-name {
        font-size: 0.8rem;
      }
      .toss-badge {
        padding: 6px 12px;
        font-size: 0.8rem;
      }
      .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
      }
      .table th, .table td {
        font-size: 0.7rem;
        padding: 3px 5px;
      }
      .action-btn {
        font-size: 0.7rem;
        padding: 4px 6px;
        min-width: 50px;
      }
      .action-btn-container .btn {
        font-size: 0.75rem;
        padding: 6px 8px;
        min-width: 100px;
      }
      .footer-links a {
        font-size: 0.7rem;
        padding: 4px 6px;
      }
      .modal-dialog {
        margin: 5px;
        max-width: 95%;
      }
      .modal-body {
        padding: 10px;
      }
      .form-control, .form-select {
        padding: 6px 10px;
        font-size: 0.8rem;
      }
      .btn-sm {
        padding: 4px 8px;
        font-size: 0.7rem;
      }
    }

    @media (max-width: 480px) {
      .team-card {
        padding: 5px;
      }
      .vs-badge {
        margin: 0 5px;
      }
      .table th, .table td {
        font-size: 0.65rem;
      }
      .action-btn-container {
        flex-direction: column;
        gap: 5px;
      }
      .action-btn-container .btn {
        width: 100%;
      }
      .footer-links {
        flex-wrap: nowrap;
        overflow-x: auto;
        padding-bottom: 5px;
        justify-content: flex-start;
      }
      .footer-links a {
        flex: 0 0 auto;
        white-space: nowrap;
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
          <div class="team-card text-center mx-1">
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
          <div class="team-card text-center mx-1">
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

    <h4 class="text-left mt-1">First Inning (Batting)</h4>
    <!-- Scorecard Table -->
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Player</th>
            <th>R</th>
            <th>B</th>
            <th>4s</th>
            <th>6s</th>
            <th>SR</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if($bat_first == null) { ?>
            <tr><td colspan="7" class="text-center">Add batting record of first innings</td></tr>
          <?php } else { 
            foreach($bat_first as $bat) { 
              $strike_rate = ($bat->balls > 0) ? round(($bat->runs / $bat->balls) * 100, 2) : 0;
              ?>
              <tr>
                <td class="text-start">
                  <b><?php echo $bat->playerName; ?></b>
                  <div class="player-dismissal">
                    <?php echo $bat->dismissal;?> 
                    <?php if ($bat->dismissal !== 'Not Out' && $bat->dismissal !== 'Run Out') {
                      echo ", " . $bat->bowler_name;
                    } ?>
                  </div>
                </td>
                <td><?php echo $bat->runs; ?></td>
                <td><?php echo $bat->balls; ?></td>
                <td><?php echo $bat->fours; ?></td>
                <td><?php echo $bat->sixes; ?></td>
                <td><?php echo $strike_rate; ?></td>
                <td>
                  <div class="d-flex flex-wrap justify-content-center">
                    <button class="action-btn edit-btn" data-bs-toggle="modal" data-bs-target="#editScorecardModal"
                            data-match-id="<?php echo $match_id;?>"
                            data-player-id="<?php echo $bat->player_id;?>"
                            data-batting-order="<?php echo $bat->batting_order;?>"
                            data-runs="<?php echo $bat->runs;?>"
                            data-balls="<?php echo $bat->balls;?>"
                            data-fours="<?php echo $bat->fours;?>"
                            data-sixes="<?php echo $bat->sixes;?>"
                            data-dismissal="<?php echo $bat->dismissal ?? ''; ?>"
                            data-bowler-id="<?php echo $bat->bowler_id ?? ''; ?>">
                      <i class="bi bi-pencil-fill"></i> Edit
                    </button>
                    <form action="<?php echo base_url(); ?>/ScorecardController/delete_score" method="POST" style="display:inline;">
                      <input type="hidden" name="match_id" value="<?php echo $match_id; ?>">
                      <input type="hidden" name="player_id" value="<?php echo $bat->player_id; ?>">
                      <input type="hidden" name="batting_order" value="1">
                      <button type="submit" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this record?')">
                        <i class="bi bi-trash-fill"></i> Delete
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            <?php } } ?>
          <!-- Total Score Row -->
          <tr>
            <td colspan="2"><strong>Extras</strong></td>
            <td colspan="4"><strong><?php echo $totalExtras; ?></strong></td>
            <td>
              <?php if($get_extra1!=0){ foreach($get_extra1 as $t_extra) {?>
                <button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#editExtrasModal"
                        data-match-id="<?php echo $match_id; ?>"
                        data-batting-order="<?php echo $t_extra->batting_order; ?>"
                        data-wides="<?php echo $t_extra->wides; ?>"
                        data-no-balls="<?php echo $t_extra->no_balls; ?>"
                        data-byes="<?php echo $t_extra->byes; ?>"
                        data-leg-byes="<?php echo $t_extra->leg_byes; ?>">Edit Extras</button>
              <?php } }else { ?>
                <button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#extrasModal">Add Extras</button>
              <?php } ?>
            </td>
          </tr>
          <!-- Total Score Row -->
          <tr>
            <td colspan="2"><strong>Total Score</strong></td>
            <td colspan="4"><strong><?php if($all_score == 0) { echo "Add total runs and wickets"; ?></td>
            <td><button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#totalRunsModal">Add Total</button></td>
            <?php } else { echo $total_score; ?>/<?php echo $wickets; ?></strong></td>
            <td>
              <?php foreach($all_score as $t_score) { ?>
                <button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#editTotalScoreModal"
                        data-total-runs="<?php echo $t_score->total_runs; ?>"
                        data-wickets="<?php echo $t_score->wickets; ?>"
                        data-match-id="<?php echo $t_score->match_id; ?>"
                        data-batting-order="<?php echo $t_score->batting_order; ?>">Edit Total</button>
              <?php } } ?>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="action-btn-container">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scorecardModal">
          <i class="bi bi-plus-circle-fill"></i> Add Player
        </button>
        <a href="<?php echo base_url();?>Welcome/scorecard_links//<?php echo $bowl_first;?>/<?php echo $batting_first;?>/<?php echo $match_id;?>">
          <button class="btn btn-success next-btn">
            <i class="bi bi-arrow-right-circle-fill"></i> Next Inning
          </button>
        </a>
      </div>
    </div>
  </div>

  <!-- Extras Modal -->
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
            <input type="hidden" value="<?php echo $batting_first;?>" name="batting_team_id">
            <input type="hidden" value="1" name="batting_order">
            <div class="mb-3">
              <label for="wides" class="form-label">Wides</label>
              <input type="number" class="form-control" id="wides" name="wides" min="0">
            </div>
            <div class="mb-3">
              <label for="no-balls" class="form-label">No Balls</label>
              <input type="number" class="form-control" id="no-balls" name="no_balls" min="0">
            </div>
            <div class="mb-3">
              <label for="byes" class="form-label">Byes</label>
              <input type="number" class="form-control" id="byes" name="byes" min="0">
            </div>
            <div class="mb-3">
              <label for="leg-byes" class="form-label">Leg Byes</label>
              <input type="number" class="form-control" id="leg-byes" name="leg_byes" min="0">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save Extras</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Total Runs Modal -->
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
              <input type="number" class="form-control" id="total-runs" name="total_runs" min="0" required>
            </div>
            <div class="mb-3">
              <label for="t-overs" class="form-label">Total Overs</label>
              <input type="number" class="form-control" id="t-overs" name="t_overs" min="0" step="0.1" required>
            </div>
            <div class="mb-3">
              <label for="wickets" class="form-label">Wickets</label>
              <input type="number" class="form-control" id="wickets" name="wickets" min="0" max="10" required>
            </div>
            <input type="hidden" value="<?php echo $match_id;?>" name="match_id">
            <input type="hidden" value="<?php echo $batting_first;?>" name="batting_team_id">
            <input type="hidden" value="1" name="batting_order">
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save Total</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Scorecard Modal -->
  <div class="modal fade" id="scorecardModal" tabindex="-1" aria-labelledby="scorecardModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="scorecardModalLabel">Add Player Score</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url();?>/ScorecardController/insert_batting" method="POST" onsubmit="return validateScorecard()">
            <input type="hidden" value="<?php echo $match_id;?>" name="match_id">
            <input type="hidden" value="<?php echo $wintossid;?>" name="team_one_id">
            <input type="hidden" value="<?php echo $batting_first;?>" name="batting_team">
            <input type="hidden" value="<?php echo $bowl_first;?>" name="bowling_team">
            <input type="hidden" value="1" name="batting_order">
            <div class="mb-3">
              <label for="player-name" class="form-label">Player Name</label>
              <select class="form-select" id="player-name" name="player_id" required>
                <option value="" disabled selected>Select Player</option>
                <?php foreach($player_info as $player_name) { ?>
                  <option value="<?php echo $player_name->player_id;?>"><?php echo $player_name->playerName;?></option>
                <?php } ?>
              </select>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="runs" class="form-label">Runs</label>
                <input type="number" class="form-control" id="runs" name="runs" min="0" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="balls" class="form-label">Balls</label>
                <input type="number" class="form-control" id="balls" name="balls" min="0" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="fours" class="form-label">4s</label>
                <input type="number" class="form-control" id="fours" name="fours" min="0">
              </div>
              <div class="col-md-6 mb-3">
                <label for="sixes" class="form-label">6s</label>
                <input type="number" class="form-control" id="sixes" name="sixes" min="0">
              </div>
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
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save Score</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Scorecard Modal -->
  <div class="modal fade" id="editScorecardModal" tabindex="-1" aria-labelledby="editScorecardModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editScorecardModalLabel">Edit Player Score</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url();?>/ScorecardController/edit_score" method="POST">
            <input type="hidden" id="edit-match-id" name="match_id">
            <input type="hidden" id="edit-player-id" name="player_id">
            <input type="hidden" value="1" name="batting_order">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="edit-runs" class="form-label">Runs</label>
                <input type="number" class="form-control" id="edit-runs" name="runs" min="0" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="edit-balls" class="form-label">Balls</label>
                <input type="number" class="form-control" id="edit-balls" name="balls" min="0" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="edit-fours" class="form-label">4s</label>
                <input type="number" class="form-control" id="edit-fours" name="fours" min="0">
              </div>
              <div class="col-md-6 mb-3">
                <label for="edit-sixes" class="form-label">6s</label>
                <input type="number" class="form-control" id="edit-sixes" name="sixes" min="0">
              </div>
            </div>
            <div class="mb-3">
              <label for="edit-dismissal" class="form-label">Dismissal</label>
              <select class="form-select" id="edit-dismissal" name="dismissal">
                <option value="">Select Here</option required>
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
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Update Score</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Extras Modal -->
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
            <input type="hidden" value="1" name="batting_order">
            <div class="mb-3">
              <label for="edit-wides" class="form-label">Wides</label>
              <input type="number" class="form-control" id="edit-wides" name="wides" min="0" required>
            </div>
            <div class="mb-3">
              <label for="edit-no-balls" class="form-label">No Balls</label>
              <input type="number" class="form-control" id="edit-no-balls" name="no_balls" min="0" required>
            </div>
            <div class="mb-3">
              <label for="edit-byes" class="form-label">Byes</label>
              <input type="number" class="form-control" id="edit-byes" name="byes" min="0" required>
            </div>
            <div class="mb-3">
              <label for="edit-leg-byes" class="form-label">Leg Byes</label>
              <input type="number" class="form-control" id="edit-leg-byes" name="leg_byes" min="0" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Update Extras</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Total Score Modal -->
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
            <input type="hidden" value="1" name="batting_order">
            <div class="mb-3">
              <label for="edit-total-runs" class="form-label">Total Runs</label>
              <input type="number" class="form-control" id="edit-total-runs" name="total_runs" min="0" required>
            </div>
            <div class="mb-3">
              <label for="edit-wickets" class="form-label">Wickets</label>
              <input type="number" class="form-control" id="edit-wickets" name="wickets" min="0" max="10" required>
            </div>
            <div class="mb-3">
              <label for="edit-t-overs" class="form-label">Total Overs</label>
              <input type="number" class="form-control" id="edit-t-overs" name="t_overs" min="0" step="0.1" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" form="editTotalScoreForm" class="btn btn-primary">Update Total</button>
            </div>
          </form>
        </div>
      </div>
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

    // Populate edit modals
    document.addEventListener('DOMContentLoaded', function() {
      // Edit Scorecard Modal
      var editScorecardModal = document.getElementById('editScorecardModal');
      editScorecardModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        document.getElementById('edit-match-id').value = button.getAttribute('data-match-id');
        document.getElementById('edit-player-id').value = button.getAttribute('data-player-id');
        document.getElementById('edit-runs').value = button.getAttribute('data-runs');
        document.getElementById('edit-balls').value = button.getAttribute('data-balls');
        document.getElementById('edit-fours').value = button.getAttribute('data-fours');
        document.getElementById('edit-sixes').value = button.getAttribute('data-sixes');
        document.getElementById('edit-dismissal').value = button.getAttribute('data-dismissal');
        document.getElementById('edit-bowler-name').value = button.getAttribute('data-bowler-id');
      });

      // Edit Extras Modal
      var editExtrasModal = document.getElementById('editExtrasModal');
      editExtrasModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        document.getElementById('edit-match-id').value = button.getAttribute('data-match-id');
        document.getElementById('edit-wides').value = button.getAttribute('data-wides');
        document.getElementById('edit-no-balls').value = button.getAttribute('data-no-balls');
        document.getElementById('edit-byes').value = button.getAttribute('data-byes');
        document.getElementById('edit-leg-byes').value = button.getAttribute('data-leg-byes');
      });

      // Edit Total Score Modal
      var editTotalScoreModal = document.getElementById('editTotalScoreModal');
      editTotalScoreModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        document.getElementById('edit-total-match-id').value = button.getAttribute('data-match-id');
        document.getElementById('edit-total-runs').value = button.getAttribute('data-total-runs');
        document.getElementById('edit-wickets').value = button.getAttribute('data-wickets');
      });
    });

    function validateScorecard() {
      // Get input values
      const runs = parseInt(document.getElementById('runs').value) || 0;
      const balls = parseInt(document.getElementById('balls').value) || 0;
      const fours = parseInt(document.getElementById('fours').value) || 0;
      const sixes = parseInt(document.getElementById('sixes').value) || 0;

      // Validate 4s and 6s
      const runsFromBoundaries = (fours * 4) + (sixes * 6);
      if (runsFromBoundaries > runs) {
        alert(`The combination of 4s and 6s (${runsFromBoundaries} runs) exceeds the total runs (${runs}). Please correct your entries.`);
        return false;
      }

      // Validate Strike Rate
      if (balls > 0) {
        const strikeRate = (runs / balls) * 100;
        if (strikeRate > 600) {
          alert(`The strike rate of ${strikeRate.toFixed(2)} seems unusually high. Please verify the runs and balls entered.`);
          return false;
        }
      } else if (runs > 0) {
        alert("Balls cannot be zero when runs are scored.");
        return false;
      }

      return true;
    }
  </script>

  <!-- Footer Section -->
  <div class="footer">
    <div class="footer-links">
      <a href="#"><i class="bi bi-house-door"></i> Home</a>
      <a href="#"><i class="bi bi-info-circle"></i> About</a>
      <a href="#"><i class="bi bi-envelope"></i> Contact</a>
      <a href="#"><i class="bi bi-question-circle"></i> FAQ</a>
    </div>
  </div>

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</body>
</html>