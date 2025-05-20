<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Cricket Scorecard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Helvetica Neue', sans-serif;
            font-size: 0.85rem;
            color: #333;
            margin-bottom: 60px;
            -webkit-text-size-adjust: 100%;
        }
        .container {
            max-width: 900px;
            margin-top: 10px;
            padding: 10px;
        }
        .team-info { text-align: center; margin-bottom: 20px; }
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
        .table th, .table td {
            text-align: center;
            padding: 4px 8px;
            font-size: 0.8rem;
            vertical-align: middle;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .action-btn {
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 0.8rem;
            margin: 2px;
            padding: 6px 8px;
            min-width: 60px;
            transition: all 0.3s ease;
        }
        .action-btn.edit-btn { background-color: #ffc107; color: #212529; }
        .action-btn.delete-btn { background-color: #dc3545; }
        .action-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        .action-btn-container {
            display: flex;
            justify-content: space-between;
            gap: 8px;
            margin-top: 15px;
            flex-wrap: wrap;
        }
        .next-btn { background-color: #17a2b8; color: white; }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #f8f9fa;
            padding: 8px;
            border-top: 1px solid #ddd;
        }
        .footer-links a {
            text-decoration: none;
            color: #007bff;
            padding: 6px 8px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        .modal-body {
            max-height: 70vh;
            overflow-y: auto;
            padding: 15px;
        }
        .form-control.is-invalid { border-color: #dc3545; }
        .form-control.is-valid { border-color: #28a745; }
        .required-field::after { content: " *"; color: #dc3545; }
        
        @media (max-width: 768px) {
            body { font-size: 0.8rem; }
            .container { padding: 5px; }
            .team-logo { width: 30px; height: 30px; }
            .vs-badge { width: 30px; height: 30px; font-size: 0.8rem; }
            .team-name { font-size: 0.8rem; }
            .toss-badge { padding: 6px 12px; font-size: 0.8rem; }
            .table th, .table td { font-size: 0.7rem; padding: 3px 5px; }
            .action-btn { font-size: 0.7rem; padding: 4px 6px; min-width: 50px; }
        }
        
        @media (max-width: 480px) {
            .team-card { padding: 5px; }
            .action-btn-container { flex-direction: column; gap: 5px; }
            .footer-links { overflow-x: auto; }
        }
    </style>
</head>
<body>
    <?php 
    try {
        foreach($toss_winner as $toss_win) {
            $wintossname = $toss_win->team_name ?? 'Unknown Team';
        } 
        $wintossid = $toss_id['toss_winner'] ?? 0;
        $batting_first = $toss_id['bat_first'] ?? 0;
        $bowl_first = $toss_id['bowl_first'] ?? 0;
        $decision = $toss_id['decision'] ?? 'bat/bowl';

        $totalExtras = "Click on Add extras to add it";
        if (!empty($get_extra1)) {
            foreach($get_extra1 as $t_extra) {
                $totalExtras = ($t_extra->wides ?? 0) + 
                             ($t_extra->no_balls ?? 0) + 
                             ($t_extra->byes ?? 0) + 
                             ($t_extra->leg_byes ?? 0);
            }
        }

        $total_score = "Click on Add extras to add it";
        $wickets = 0;
        $t_overs = 0;
        if (!empty($all_score)) {
            foreach($all_score as $total) {
                $total_score = $total->total_runs ?? 0;
                $wickets = $total->wickets ?? 0;
                $t_overs = $total->t_overs ?? 0;
            }
        }
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>Error loading scorecard data: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
    ?>

    <div class="container">
        <div class="team-info">
            <div class="d-flex justify-content-center align-items-center">
                <?php foreach($team_one as $t_one) { ?>
                    <div class="team-card text-center mx-1">
                        <img src="<?php echo htmlspecialchars($t_one->image_path ?? ''); ?>" alt="Team 1" class="team-logo">
                        <div class="team-name mt-1"><?php echo htmlspecialchars($t_one->team_name ?? 'Team 1'); ?></div>
                    </div>
                <?php } ?>
                <div class="vs-badge mx-2"><span>VS</span></div>
                <?php foreach($team_two as $t_two) { ?>
                    <div class="team-card text-center mx-1">
                        <img src="<?php echo htmlspecialchars($t_two->image_path ?? ''); ?>" alt="Team 2" class="team-logo">
                        <div class="team-name mt-1"><?php echo htmlspecialchars($t_two->team_name ?? 'Team 2'); ?></div>
                    </div>
                <?php } ?>
            </div>
            <div class="toss-result text-center mt-3">
                <div class="toss-badge">
                    <span><?php echo htmlspecialchars($wintossname); ?> won the toss and chose to <?php echo htmlspecialchars(strtolower($decision)); ?>.</span>
                </div>
            </div>
        </div>

        <h4 class="text-left mt-1">First Inning (Batting)</h4>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Player</th>
                        <th>Runs</th>
                        <th>Balls</th>
                        <th>4s</th>
                        <th>6s</th>
                        <th>SR</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (empty($bat_first)) {
                        echo '<tr><td colspan="7" class="text-center">Add batting record of first innings</td></tr>';
                    } else {
                        try {
                            foreach($bat_first as $bat) {
                                $strike_rate = ($bat->balls > 0) ? round(($bat->runs / $bat->balls) * 100, 2) : 0;
                                ?>
                                <tr>
                                    <td class="text-start">
                                        <b><?php echo htmlspecialchars($bat->playerName ?? 'Unknown Player'); ?></b>
                                        <div class="player-dismissal">
                                            <?php 
                                            echo htmlspecialchars($bat->dismissal ?? ''); 
                                            if ($bat->dismissal && $bat->dismissal !== 'Not Out' && $bat->dismissal !== 'Run Out') {
                                                echo ", " . htmlspecialchars($bat->bowler_name ?? 'Unknown Bowler');
                                            }
                                            ?>
                                        </div>
                                    </td>
                                    <td><?php echo htmlspecialchars($bat->runs ?? 0); ?></td>
                                    <td><?php echo htmlspecialchars($bat->balls ?? 0); ?></td>
                                    <td><?php echo htmlspecialchars($bat->fours ?? 0); ?></td>
                                    <td><?php echo htmlspecialchars($bat->sixes ?? 0); ?></td>
                                    <td><?php echo $strike_rate; ?></td>
                                    <td>
                                        <div class="d-flex flex-wrap justify-content-center gap-2">
                                            <button class="action-btn edit-btn" data-bs-toggle="modal" data-bs-target="#editScorecardModal"
                                                data-match-id="<?php echo htmlspecialchars($match_id ?? ''); ?>"
                                                data-player-id="<?php echo htmlspecialchars($bat->player_id ?? ''); ?>"
                                                data-batting-order="<?php echo htmlspecialchars($bat->batting_order ?? ''); ?>"
                                                data-runs="<?php echo htmlspecialchars($bat->runs ?? ''); ?>"
                                                data-balls="<?php echo htmlspecialchars($bat->balls ?? ''); ?>"
                                                data-fours="<?php echo htmlspecialchars($bat->fours ?? ''); ?>"
                                                data-sixes="<?php echo htmlspecialchars($bat->sixes ?? ''); ?>"
                                                data-dismissal="<?php echo htmlspecialchars($bat->dismissal ?? ''); ?>"
                                                data-bowler-id="<?php echo htmlspecialchars($bat->bowler_id ?? ''); ?>">
                                                <i class="bi bi-pencil-fill"></i> Edit
                                            </button>
                                            <form action="<?php echo base_url(); ?>/ScorecardController/delete_score" method="POST" style="display:inline;">
                                                <input type="hidden" name="match_id" value="<?php echo htmlspecialchars($match_id ?? ''); ?>">
                                                <input type="hidden" name="player_id" value="<?php echo htmlspecialchars($bat->player_id ?? ''); ?>">
                                                <input type="hidden" name="batting_order" value="1">
                                                <button type="submit" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this record?')">
                                                    <i class="bi bi-trash-fill"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php }
                        } catch (Exception $e) {
                            echo "<tr><td colspan='7' class='text-danger'>Error: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                        }
                    } ?>
                    <tr>
                        <td colspan="2"><strong>Extras</strong></td>
                        <td colspan="4"><strong><?php echo htmlspecialchars($totalExtras); ?></strong></td>
                        <td>
                            <?php if(!empty($get_extra1)) { foreach($get_extra1 as $t_extra) {?>
                                <button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#editExtrasModal"
                                    data-match-id="<?php echo htmlspecialchars($match_id ?? ''); ?>"
                                    data-batting-order="<?php echo htmlspecialchars($t_extra->batting_order ?? ''); ?>"
                                    data-wides="<?php echo htmlspecialchars($t_extra->wides ?? ''); ?>"
                                    data-no-balls="<?php echo htmlspecialchars($t_extra->no_balls ?? ''); ?>"
                                    data-byes="<?php echo htmlspecialchars($t_extra->byes ?? ''); ?>"
                                    data-leg-byes="<?php echo htmlspecialchars($t_extra->leg_byes ?? ''); ?>">
                                    Edit Extras
                                </button>
                            <?php } } else { ?>
                                <button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#extrasModal">Add Extras</button>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>Total Score</strong></td>
                        <td colspan="4">
                            <strong>
                                <?php 
                                if(empty($all_score)) { 
                                    echo "Add total runs and wickets"; 
                                } else { 
                                    echo htmlspecialchars($total_score) . "/" . htmlspecialchars($wickets) . " in " . htmlspecialchars($t_overs) . " Overs";
                                } 
                                ?>
                            </strong>
                        </td>
                        <td>
                            <?php if(!empty($all_score)) { foreach($all_score as $t_score) { ?>
                                <button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#editTotalScoreModal"
                                    data-total-runs="<?php echo htmlspecialchars($t_score->total_runs ?? ''); ?>"
                                    data-wickets="<?php echo htmlspecialchars($t_score->wickets ?? ''); ?>"
                                    data-match-id="<?php echo htmlspecialchars($t_score->match_id ?? ''); ?>"
                                    data-t-overs="<?php echo htmlspecialchars($t_score->t_overs ?? ''); ?>"
                                    data-batting-order="<?php echo htmlspecialchars($t_score->batting_order ?? ''); ?>">
                                    Edit Total
                                </button>
                            <?php } } else { ?>
                                <button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#totalRunsModal">Add Total</button>
                            <?php } ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="action-btn-container">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scorecardModal">
                    <i class="bi bi-plus-circle-fill"></i> Add Player
                </button>
                <a href="<?php echo base_url();?>Welcome/scorecard_links/<?php echo htmlspecialchars($bowl_first ?? ''); ?>/<?php echo htmlspecialchars($batting_first ?? ''); ?>/<?php echo htmlspecialchars($match_id ?? ''); ?>">
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
                    <form action="<?php echo base_url();?>/ScorecardController/insert_extras" method="POST" id="extrasForm">
                        <input type="hidden" value="<?php echo htmlspecialchars($match_id ?? ''); ?>" name="match_id">
                        <input type="hidden" value="<?php echo htmlspecialchars($batting_first ?? ''); ?>" name="batting_team_id">
                        <input type="hidden" value="1" name="batting_order">
                        <div class="mb-3">
                            <label for="wides" class="form-label">Wides</label>
                            <input type="number" class="form-control" id="wides" name="wides" min="0" value="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="no-balls" class="form-label">No Balls</label>
                            <input type="number" class="form-control" id="no-balls" name="no_balls" min="0" value="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="byes" class="form-label">Byes</label>
                            <input type="number" class="form-control" id="byes" name="byes" min="0" value="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="leg-byes" class="form-label">Leg Byes</label>
                            <input type="number" class="form-control" id="leg-byes" name="leg_byes" min="0" value="0" required>
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
                    <form action="<?php echo base_url();?>/ScorecardController/insert_total_score" method="POST" id="totalRunsForm">
                        <input type="hidden" value="<?php echo htmlspecialchars($match_id ?? ''); ?>" name="match_id">
                        <input type="hidden" value="<?php echo htmlspecialchars($batting_first ?? ''); ?>" name="batting_team_id">
                        <input type="hidden" value="1" name="batting_order">
                        <div class="mb-3">
                            <label for="total-runs" class="form-label required-field">Total Runs</label>
                            <input type="number" class="form-control" id="total-runs" name="total_runs" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="t-overs" class="form-label required-field">Total Overs</label>
                            <input type="number" class="form-control" id="t-overs" name="t_overs" min="0" step="0.1" required>
                        </div>
                        <div class="mb-3">
                            <label for="wickets" class="form-label required-field">Wickets</label>
                            <input type="number" class="form-control" id="wickets" name="wickets" min="0" max="10" required>
                        </div>
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
                    <form action="<?php echo base_url();?>/ScorecardController/insert_batting" method="POST" id="scorecardForm" onsubmit="return validateScorecard()">
                        <input type="hidden" value="<?php echo htmlspecialchars($match_id ?? ''); ?>" name="match_id">
                        <input type="hidden" value="<?php echo htmlspecialchars($wintossid ?? ''); ?>" name="team_one_id">
                        <input type="hidden" value="<?php echo htmlspecialchars($batting_first ?? ''); ?>" name="batting_team">
                        <input type="hidden" value="<?php echo htmlspecialchars($bowl_first ?? ''); ?>" name="bowling_team">
                        <input type="hidden" value="1" name="batting_order">
                        <div class="mb-3">
                            <label for="player-name" class="form-label required-field">Player Name</label>
                            <select class="form-select" id="player-name" name="player_id" required>
                                <option value="" disabled selected>Select Player</option>
                                <?php foreach($player_info as $player_name) { ?>
                                    <option value="<?php echo htmlspecialchars($player_name->player_id ?? ''); ?>">
                                        <?php echo htmlspecialchars($player_name->playerName ?? ''); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="runs" class="form-label required-field">Runs</label>
                                <input type="number" class="form-control" id="runs" name="runs" min="0" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="balls" class="form-label required-field">Balls</label>
                                <input type="number" class="form-control" id="balls" name="balls" min="0" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fours" class="form-label">4s</label>
                                <input type="number" class="form-control" id="fours" name="fours" min="0" value="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="sixes" class="form-label">6s</label>
                                <input type="number" class="form-control" id="sixes" name="sixes" min="0" value="0">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="dismissal" class="form-label required-field">Dismissal</label>
                            <select class="form-select" id="dismissal" name="dismissal" required>
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
                            <label for="bowler-name" class="form-label required-field">Bowler Name</label>
                            <select class="form-select" id="bowler-name" name="bowler_id">
                                <option value="" disabled selected>Select Bowler</option>
                                <?php foreach($bowler_info as $bowler) { ?>
                                    <option value="<?php echo htmlspecialchars($bowler->player_id ?? ''); ?>">
                                        <?php echo htmlspecialchars($bowler->playerName ?? ''); ?>
                                    </option>
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
                    <form action="<?php echo base_url();?>/ScorecardController/edit_score" method="POST" id="editScorecardForm" onsubmit="return validateEditScorecard()">
                        <input type="hidden" id="edit-match-id" name="match_id">
                        <input type="hidden" id="edit-player-id" name="player_id">
                        <input type="hidden" value="1" name="batting_order">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit-runs" class="form-label required-field">Runs</label>
                                <input type="number" class="form-control" id="edit-runs" name="runs" min="0" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit-balls" class="form-label required-field">Balls</label>
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
                            <label for="edit-dismissal" class="form-label required-field">Dismissal</label>
                            <select class="form-select" id="edit-dismissal" name="dismissal" required>
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
                            <label for="edit-bowler-name" class="form-label required-field">Bowler Name</label>
                            <select class="form-select" id="edit-bowler-name" name="bowler_id">
                                <option value="" disabled>Select Bowler</option>
                                <?php foreach($bowler_info as $bowler) { ?>
                                    <option value="<?php echo htmlspecialchars($bowler->player_id ?? ''); ?>">
                                        <?php echo htmlspecialchars($bowler->playerName ?? ''); ?>
                                    </option>
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
                    <form action="<?php echo base_url();?>/ScorecardController/edit_extra" method="POST" id="editExtrasForm">
                        <input type="hidden" id="edit-extras-match-id" name="match_id">
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
                            <label for="edit-total-runs" class="form-label required-field">Total Runs</label>
                            <input type="number" class="form-control" id="edit-total-runs" name="total_runs" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-t-overs" class="form-label required-field">Total Overs</label>
                            <input type="number" class="form-control" id="edit-t-overs" name="t_overs" min="0" step="0.1" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-wickets" class="form-label required-field">Wickets</label>
                            <input type="number" class="form-control" id="edit-wickets" name="wickets" min="0" max="10" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Total</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="footer-links d-flex justify-content-around w-100">
            <a href="#"><i class="bi bi-house-door"></i> Home</a>
            <a href="#"><i class="bi bi-info-circle"></i> About</a>
            <a href="#"><i class="bi bi-envelope"></i> Contact</a>
            <a href="#"><i class="bi bi-question-circle"></i> FAQ</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle bowler section visibility based on dismissal selection
        function toggleBowlerSection(selectId, sectionId) {
            const select = document.getElementById(selectId);
            const section = document.getElementById(sectionId);
            const bowlerSelect = section.querySelector('select');
            
            function updateBowlerVisibility() {
                const value = select.value;
                section.style.display = (value === 'Not Out' || value === 'Run Out') ? 'none' : 'block';
                bowlerSelect.required = !(value === 'Not Out' || value === 'Run Out');
            }
            
            // Initialize visibility on load
            updateBowlerVisibility();
            // Update visibility on change
            select.addEventListener('change', updateBowlerVisibility);
        }

        // Initialize toggles for both modals
        document.addEventListener('DOMContentLoaded', () => {
            toggleBowlerSection('dismissal', 'bowler-section');
            toggleBowlerSection('edit-dismissal', 'edit-bowler-section');
        });

        // Form validation for Add Player Score
        function validateScorecard() {
            const runs = parseInt(document.getElementById('runs').value) || 0;
            const balls = parseInt(document.getElementById('balls').value) || 0;
            const fours = parseInt(document.getElementById('fours').value) || 0;
            const sixes = parseInt(document.getElementById('sixes').value) || 0;
            const dismissal = document.getElementById('dismissal').value;
            const bowler = document.getElementById('bowler-name');

            const boundaryRuns = (fours * 4) + (sixes * 6);
            if (boundaryRuns > runs) {
                alert('Boundary runs (4s and 6s) cannot exceed total runs');
                return false;
            }
            if (runs > 0 && balls === 0) {
                alert('Balls cannot be zero when runs are scored');
                return false;
            }
            if (dismissal !== 'Not Out' && dismissal !== 'Run Out' && !bowler.value) {
                alert('Please select a bowler for this dismissal');
                return false;
            }
            return true;
        }

        // Form validation for Edit Player Score
        function validateEditScorecard() {
            const runs = parseInt(document.getElementById('edit-runs').value) || 0;
            const balls = parseInt(document.getElementById('edit-balls').value) || 0;
            const fours = parseInt(document.getElementById('edit-fours').value) || 0;
            const sixes = parseInt(document.getElementById('edit-sixes').value) || 0;
            const dismissal = document.getElementById('edit-dismissal').value;
            const bowler = document.getElementById('edit-bowler-name');

            const boundaryRuns = (fours * 4) + (sixes * 6);
            if (boundaryRuns > runs) {
                alert('Boundary runs (4s and 6s) cannot exceed total runs');
                return false;
            }
            if (runs > 0 && balls === 0) {
                alert('Balls cannot be zero when runs are scored');
                return false;
            }
            if (dismissal !== 'Not Out' && dismissal !== 'Run Out' && !bowler.value) {
                alert('Please select a bowler for this dismissal');
                return false;
            }
            return true;
        }

        // Modal population
        document.addEventListener('DOMContentLoaded', function() {
            // Edit Scorecard Modal
            document.getElementById('editScorecardModal').addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const fields = {
                    'match-id': 'match_id',
                    'player-id': 'player_id',
                    'runs': 'runs',
                    'balls': 'balls',
                    'fours': 'fours',
                    'sixes': 'sixes',
                    'dismissal': 'dismissal',
                    'bowler-id': 'bowler_id'
                };
                Object.entries(fields).forEach(([id, attr]) => {
                    const value = button.getAttribute(`data-${attr}`) || '';
                    const element = document.getElementById(`edit-${id}`);
                    if (element.tagName === 'SELECT') {
                        element.value = value;
                    } else {
                        element.value = value || '0';
                    }
                });
                // Trigger change event to update bowler section visibility
                const dismissalSelect = document.getElementById('edit-dismissal');
                dismissalSelect.dispatchEvent(new Event('change'));
            });

            // Edit Extras Modal
            document.getElementById('editExtrasModal').addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const fields = {
                    'extras-match-id': 'match-id',
                    'wides': 'wides',
                    'no-balls': 'no-balls',
                    'byes': 'byes',
                    'leg-byes': 'leg-byes'
                };
                Object.entries(fields).forEach(([id, attr]) => {
                    document.getElementById(`edit-${id}`).value = button.getAttribute(`data-${attr}`) || '0';
                });
            });

            // Edit Total Score Modal
            document.getElementById('editTotalScoreModal').addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const fields = {
                    'total-match-id': 'match-id',
                    'total-runs': 'total-runs',
                    'wickets': 'wickets',
                    't-overs': 't-overs'
                };
                Object.entries(fields).forEach(([id, attr]) => {
                    document.getElementById(`edit-${id}`).value = button.getAttribute(`data-${attr}`) || '0';
                });
            });

            // Real-time input validation
            ['runs', 'balls', 'fours', 'sixes', 'edit-runs', 'edit-balls', 'edit-fours', 'edit-sixes', 
             'wides', 'no-balls', 'byes', 'leg-byes', 'edit-wides', 'edit-no-balls', 'edit-byes', 'edit-leg-byes',
             'total-runs', 't-overs', 'wickets', 'edit-total-runs', 'edit-t-overs', 'edit-wickets'].forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.addEventListener('input', function() {
                        this.classList.remove('is-invalid', 'is-valid');
                        const value = parseFloat(this.value) || 0;
                        if (value < 0 || (id === 'wickets' && value > 10) || (id === 'edit-wickets' && value > 10)) {
                            this.classList.add('is-invalid');
                        } else {
                            this.classList.add('is-valid');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>