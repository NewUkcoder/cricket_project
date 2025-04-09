<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Cricket Scorecard Admin - Second Innings Bowling</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            color: #333;
            background-color: #f8f9fa;
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
        .invalid-feedback { display: block; font-size: 0.75rem; color: #dc3545; }

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
        $batting_second = $toss_id['bowl_first'] ?? 0;
        $bowl_second = $toss_id['bat_first'] ?? 0;
        $decision = $toss_id['decision'] ?? 'bat/bowl';
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>Error loading data: " . htmlspecialchars($e->getMessage()) . "</div>";
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

        <h4 class="text-left mt-1">Second Inning (Bowling)</h4>
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
                    <?php 
                    if (empty($bowling_second)) {
                        echo "<tr><td colspan='6' class='text-center'>Add bowling records for second innings</td></tr>";
                    } else {
                        try {
                            foreach($bowling_second as $bowl) {
                                $economy = ($bowl->overs > 0) ? number_format($bowl->given_runs / $bowl->overs, 2) : 0;
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($bowl->playerName ?? 'Unknown Player'); ?></td>
                                    <td><?php echo htmlspecialchars($bowl->overs ?? 0); ?></td>
                                    <td><?php echo htmlspecialchars($bowl->given_runs ?? 0); ?></td>
                                    <td><?php echo htmlspecialchars($bowl->wickets ?? 0); ?></td>
                                    <td><?php echo $economy; ?></td>
                                    <td>
                                        <div class="d-flex flex-wrap justify-content-center gap-2">
                                            <button class="action-btn edit-btn" data-bs-toggle="modal" data-bs-target="#editModal"
                                                data-id="<?php echo htmlspecialchars($bowl->player_id ?? ''); ?>"
                                                data-player-id="<?php echo htmlspecialchars($bowl->player_id ?? ''); ?>"
                                                data-bowling-order="<?php echo htmlspecialchars($bowl->bowling_order ?? ''); ?>"
                                                data-player-name="<?php echo htmlspecialchars($bowl->playerName ?? ''); ?>"
                                                data-overs="<?php echo htmlspecialchars($bowl->overs ?? ''); ?>"
                                                data-runs="<?php echo htmlspecialchars($bowl->given_runs ?? ''); ?>"
                                                data-wickets="<?php echo htmlspecialchars($bowl->wickets ?? ''); ?>">
                                                <i class="bi bi-pencil-fill"></i> Edit
                                            </button>
                                            <form action="<?php echo base_url(); ?>/ScorecardController/delete_bowling_record" method="POST" style="display:inline;">
                                                <input type="hidden" name="match_id" value="<?php echo htmlspecialchars($match_id ?? ''); ?>">
                                                <input type="hidden" name="player_id" value="<?php echo htmlspecialchars($bowl->player_id ?? ''); ?>">
                                                <input type="hidden" name="bowling_order" value="2">
                                                <button type="submit" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this record?')">
                                                    <i class="bi bi-trash-fill"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php }
                        } catch (Exception $e) {
                            echo "<tr><td colspan='6' class='text-danger'>Error: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                        }
                    } ?>
                </tbody>
            </table>
            <div class="action-btn-container">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scorecardModal">
                    <i class="bi bi-plus-circle-fill"></i> Add Bowler
                </button>
                <a href="<?php echo base_url();?>Welcome/scorecard_links/<?php echo htmlspecialchars($bowl_second ?? ''); ?>/<?php echo htmlspecialchars($batting_second ?? ''); ?>/<?php echo htmlspecialchars($match_id ?? ''); ?>">
                    <button class="btn btn-success next-btn">
                        <i class="bi bi-arrow-right-circle-fill"></i> Next
                    </button>
                </a>
            </div>
        </div>
    </div>

    <!-- Scorecard Modal -->
    <div class="modal fade" id="scorecardModal" tabindex="-1" aria-labelledby="scorecardModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scorecardModalLabel">Add Bowling Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url();?>/ScorecardController/add_bowling" method="POST" id="bowlingForm" onsubmit="return validateBowling()">
                        <input type="hidden" value="<?php echo htmlspecialchars($match_id ?? ''); ?>" name="match_id">
                        <input type="hidden" value="<?php echo htmlspecialchars($wintossid ?? ''); ?>" name="team_one_id">
                        <input type="hidden" value="<?php echo htmlspecialchars($batting_second ?? ''); ?>" name="batting_team">
                        <input type="hidden" value="<?php echo htmlspecialchars($bowl_second ?? ''); ?>" name="bowling_team">
                        <input type="hidden" value="2" name="bowling_order">
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
                        <div class="mb-3">
                            <label for="overs" class="form-label required-field">Overs (e.g., 2.3)</label>
                            <input type="number" class="form-control" id="overs" name="overs" min="0" step="0.1" required>
                            <div class="invalid-feedback" id="overs-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="runs" class="form-label required-field">Runs Given</label>
                            <input type="number" class="form-control" id="runs" name="given_runs" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="wickets" class="form-label required-field">Wickets</label>
                            <input type="number" class="form-control" id="wickets" name="wickets" min="0" max="10" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Bowling</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Bowling Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url();?>/ScorecardController/edit_bowling" method="POST" id="editBowlingForm" onsubmit="return validateBowling()">
                        <input type="hidden" id="edit-id" name="player_id">
                        <input type="hidden" value="<?php echo htmlspecialchars($match_id ?? ''); ?>" name="match_id">
                        <input type="hidden" value="2" name="bowling_order">
                        <div class="mb-3">
                            <label for="edit-player-name" class="form-label required-field">Player Name</label>
                            <input type="text" class="form-control" id="edit-player-name" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="edit-overs" class="form-label required-field">Overs (e.g., 2.3)</label>
                            <input type="number" class="form-control" id="edit-overs" name="overs" min="0" step="0.1" required>
                            <div class="invalid-feedback" id="edit-overs-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="edit-runs" class="form-label required-field">Runs Given</label>
                            <input type="number" class="form-control" id="edit-runs" name="given_runs" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-wickets" class="form-label required-field">Wickets</label>
                            <input type="number" class="form-control" id="edit-wickets" name="wickets" min="0" max="10" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Bowling</button>
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
        // Modal population
        document.addEventListener('DOMContentLoaded', function() {
            const editModal = document.getElementById('editModal');
            editModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const fields = {
                    'id': 'player-id',
                    'bowling-order': 'bowling_order',
                    'player-name': 'player_name',
                    'overs': 'overs',
                    'runs': 'runs',
                    'wickets': 'wickets'
                };
                Object.entries(fields).forEach(([id, attr]) => {
                    const element = document.getElementById(`edit-${id}`);
                    if (element) {
                        element.value = button.getAttribute(`data-${attr}`) || '';
                    }
                });
            });
        });

        // Bowling validation
        function validateBowling() {
            const formId = event.target.id;
            const prefix = formId === 'bowlingForm' ? '' : 'edit-';
            const oversInput = document.getElementById(`${prefix}overs`);
            const runsInput = document.getElementById(`${prefix}runs`);
            const wicketsInput = document.getElementById(`${prefix}wickets`);
            const oversFeedback = document.getElementById(`${prefix}overs-feedback`);

            const overs = parseFloat(oversInput.value) || 0;
            const runs = parseInt(runsInput.value) || 0;
            const wickets = parseInt(wicketsInput.value) || 0;

            // Reset validation states
            [oversInput, runsInput, wicketsInput].forEach(input => {
                input.classList.remove('is-invalid', 'is-valid');
            });
            oversFeedback.textContent = '';

            // Validate overs
            if (overs <= 0) {
                oversInput.classList.add('is-invalid');
                oversFeedback.textContent = 'Overs must be greater than 0';
                return false;
            }

            // Convert overs to balls and validate
            const fullOvers = Math.floor(overs);
            const decimalPart = overs - fullOvers;
            const balls = Math.round(decimalPart * 10);

            if (balls > 6) {
                oversInput.classList.add('is-invalid');
                oversFeedback.textContent = 'An over cannot exceed 6 balls (e.g., use 2.6 not 2.7)';
                return false;
            }

            // Basic validations
            if (runs < 0) {
                runsInput.classList.add('is-invalid');
                alert('Runs cannot be negative');
                return false;
            }
            if (wickets < 0 || wickets > 10) {
                wicketsInput.classList.add('is-invalid');
                alert('Wickets must be between 0 and 10');
                return false;
            }

            // Economy validation
            const economy = runs / overs;
            if (economy > 36) {
                runsInput.classList.add('is-invalid');
                oversInput.classList.add('is-invalid');
                alert(`Economy rate (${economy.toFixed(2)}) seems unrealistic. Please check runs and overs.`);
                return false;
            }

            // Mark valid fields
            [oversInput, runsInput, wicketsInput].forEach(input => {
                if (input.value) input.classList.add('is-valid');
            });

            return true;
        }

        // Real-time input validation
        ['overs', 'runs', 'wickets', 'edit-overs', 'edit-runs', 'edit-wickets'].forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.addEventListener('input', function() {
                    this.classList.remove('is-invalid', 'is-valid');
                    const value = parseFloat(this.value) || 0;
                    const feedback = document.getElementById(`${id}-feedback`);

                    if (id.includes('overs')) {
                        const fullOvers = Math.floor(value);
                        const decimalPart = value - fullOvers;
                        const balls = Math.round(decimalPart * 10);
                        if (balls > 6) {
                            this.classList.add('is-invalid');
                            if (feedback) feedback.textContent = 'Max 6 balls per over (e.g., 2.6)';
                        } else if (value <= 0) {
                            this.classList.add('is-invalid');
                            if (feedback) feedback.textContent = 'Must be greater than 0';
                        } else {
                            this.classList.add('is-valid');
                            if (feedback) feedback.textContent = '';
                        }
                    } else if (value < 0 || (id.includes('wickets') && value > 10)) {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.add('is-valid');
                    }
                });
            }
        });
    </script>
</body>
</html>