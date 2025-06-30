<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cricket Match Scorecard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        body {
            background-color: #f4f6f9;
            color: #333;
            line-height: 1.5;
            padding: 15px;
            min-height: 100vh;
        }

        .scorecard-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .match-header {
            padding: 15px;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .teams-display {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .team {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
        }

        .team-logo {
            width: 40px;
            height: 40px;
            object-fit: contain;
            border-radius: 50%;
            background: white;
            padding: 3px;
            margin-bottom: 5px;
        }

        .team-name {
            font-size: 16px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
        }

        .vs-text {
            font-size: 14px;
            font-weight: 700;
            color: #ffcc00;
            flex-shrink: 0;
        }

        .match-info {
            font-size: 12px;
            opacity: 0.9;
            margin-top: 5px;
        }

        .scorecard-nav {
            padding: 15px;
        }

        .score-progress {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .innings-progress {
            flex: 1;
            background: #f8f9fa;
            border-radius: 8px;
            padding: 12px;
            border-left: 4px solid #2a5298;
        }

        .innings-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #2a5298;
        }

        .score-display {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .score-details {
            font-size: 12px;
            color: #666;
        }

        .nav-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f8f9fa;
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 10px;
            transition: all 0.2s ease;
            border-left: 4px solid #2a5298;
        }

        .nav-card:hover {
            background: #e9ecef;
        }

        .nav-text {
            font-size: 14px;
            font-weight: 500;
        }

        .nav-team {
            font-size: 12px;
            color: #6c757d;
            margin-top: 3px;
        }

        .nav-btn {
            background: #2a5298;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 6px 12px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            white-space: nowrap;
        }

        .nav-btn.disabled {
            background: #cccccc;
            cursor: not-allowed;
        }

        /* Enhanced MOTM Section */
        .motm-section {
            padding: 15px;
            background: #f9fafb;
            border-top: 1px solid #eee;
            margin-bottom: 15px;
        }

        .motm-title {
            font-size: 14px;
            font-weight: 600;
            color: #2a5298;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .motm-title i {
            color: #ffcc00;
        }

        .motm-display {
            display: flex;
            align-items: center;
            gap: 12px;
            background: white;
            border-radius: 8px;
            padding: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid #eee;
        }

        .motm-player-img-container {
            position: relative;
            width: 50px;
            height: 50px;
            flex-shrink: 0;
        }

        .motm-player-img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .motm-player-default {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #666;
            border: 2px solid #fff;
        }

        .motm-badge {
            position: absolute;
            bottom: -5px;
            right: -5px;
            background: #ffcc00;
            color: #333;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            border: 2px solid white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }

        .motm-player-info {
            flex: 1;
            min-width: 0;
        }

        .motm-player-name {
            font-size: 14px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .motm-player-team {
            font-size: 12px;
            color: #666;
            margin-top: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .motm-selected-at {
            font-size: 11px;
            color: #999;
            margin-top: 4px;
            font-style: italic;
        }

        .motm-edit-btn {
            background: none;
            border: none;
            color: #2a5298;
            font-size: 12px;
            cursor: pointer;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 5px 8px;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .motm-edit-btn:hover {
            background: #f0f5ff;
        }

        /* Popup Styles */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            padding: 15px;
        }

        .popup-content {
            background: white;
            width: 100%;
            max-width: 340px;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            animation: popupFadeIn 0.3s ease;
        }

        @keyframes popupFadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .popup-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #2a5298;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .popup-title i {
            color: #ffcc00;
        }

        .popup-select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
            transition: border 0.2s;
        }

        .popup-select:focus {
            border-color: #2a5298;
            outline: none;
        }

        .popup-submit {
            width: 100%;
            padding: 10px;
            background: #2a5298;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .popup-submit:hover {
            background: #1e3c72;
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
            text-align: center;
            padding: 15px;
        }

        @media (max-width: 480px) {
            .scorecard-container {
                max-width: 100%;
            }

            .team-logo {
                width: 36px;
                height: 36px;
            }

            .team-name {
                font-size: 14px;
            }

            .vs-text {
                font-size: 13px;
            }

            .nav-text {
                font-size: 13px;
            }
            
            .motm-player-img-container {
                width: 45px;
                height: 45px;
            }
            
            .motm-player-name {
                font-size: 13px;
            }
            
            .score-progress {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="scorecard-container">
        <?php if (!empty($toss_information) && is_array($toss_information) && !empty($toss1)): ?>
            <div class="match-header">
               Manual Match Scorecard Entry
                <div class="teams-display">
                    <div class="team">
                        <img src="<?php echo isset($two_team[0]['image_path']) ? $two_team[0]['image_path'] : '#'; ?>" alt="Team 1 Logo" class="team-logo">
                        <div class="team-name"><?php echo isset($two_team[0]['team_name']) ? $two_team[0]['team_name'] : 'Unknown'; ?></div>
                    </div>
                    <div class="vs-text">vs</div>
                    <div class="team">
                        <img src="<?php echo isset($two_team[1]['image_path']) ? $two_team[1]['image_path'] : '#'; ?>" alt="Team 2 Logo" class="team-logo">
                        <div class="team-name"><?php echo isset($two_team[1]['team_name']) ? $two_team[1]['team_name'] : 'Unknown'; ?></div>
                    </div>
                </div>
                <div class="match-info">
                    Toss: <?php echo isset($toss_information['toss_winner_name']) ? $toss_information['toss_winner_name'] : 'N/A'; ?> 
                    won and chose to <?php echo isset($toss1['decision']) ? strtolower($toss1['decision']) : 'N/A'; ?> first
                </div>
            </div>

          <div class="scorecard-nav">
    <!-- Score Progress Display -->
    <div class="score-progress">
        <!-- 1st Innings -->
        <div class="innings-progress">
            <div class="innings-title">1st Innings (<?php echo $toss_information['bat_first_name'] ?? 'Team 1'; ?>)</div>
            <?php 
            $extra1 = 0;
            if (!empty($first_extra)) {
                foreach($first_extra as $f_extra) { 
                    $extra1 = ($f_extra->wides ?? 0) + 
                             ($f_extra->no_balls ?? 0) + 
                             ($f_extra->leg_byes ?? 0) + 
                             ($f_extra->byes ?? 0);
                }
            }
            
            if (!empty($first_batting)) {
                foreach($first_batting as $f_bat) { ?>
                    <div class="score-display">
                        <?php echo ($f_bat->total_runs ?? 0) + $extra1; ?>/<?php echo $f_bat->wickets ?? 0; ?>
                    </div>
                    <div class="score-details">
                        Overs: <?php echo $f_bat->t_overs ?? '0.0'; ?> | 
                        Extras: <?php echo $extra1; ?>
                    </div>
                <?php }
            } else { ?>
                <div class="score-display">-/-</div>
                <div class="score-details">Not entered yet</div>
            <?php } ?>
        </div>
        
        <!-- 2nd Innings -->
        <div class="innings-progress">
            <div class="innings-title">2nd Innings (<?php echo $toss_information['bowl_first_name'] ?? 'Team 2'; ?>)</div>
            <?php 
            $extra2 = 0;
            if (!empty($second_extra)) {
                foreach($second_extra as $s_extra) { 
                    $extra2 = ($s_extra->wides ?? 0) + 
                             ($s_extra->no_balls ?? 0) + 
                             ($s_extra->leg_byes ?? 0) + 
                             ($s_extra->byes ?? 0);
                }
            }
            
            if (!empty($second_batting)) {
                foreach($second_batting as $s_bat) { ?>
                    <div class="score-display">
                        <?php echo ($s_bat->total_runs ?? 0) + $extra2; ?>/<?php echo $s_bat->wickets ?? 0; ?>
                    </div>
                    <div class="score-details">
                        Overs: <?php echo $s_bat->t_overs ?? '0.0'; ?> | 
                        Extras: <?php echo $extra2; ?>
                    </div>
                <?php }
            } else { ?>
                <div class="score-display">-/-</div>
                <div class="score-details">
                    <?php echo (!empty($first_batting)) ? 'Ready to enter' : 'Enter 1st innings first'; ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

                <!-- Navigation Cards -->
                <div class="nav-card">
                    <div>
                        <div class="nav-text">Team Squads</div>
                        <div class="nav-team">Both Teams</div>
                    </div>
                      <!--    <a href="<?php echo base_url(); ?>Welcome/choose_squad/<?php echo $toss_information['bat_first']; ?>/<?php echo $toss_information['bowl_first']; ?>/<?php echo $toss_information['match_id']; ?>" class="nav-btn">Add ( in Progress)</a> --> Under Work
                </div>
                
                <!-- 1st Innings Batting -->
                <div class="nav-card">
                    <div>
                        <div class="nav-text">1st Innings Batting</div>
                        <div class="nav-team"><?php echo $toss_information['bat_first_name'] ?? 'Team 1'; ?></div>
                    </div>
                    <a href="<?php echo base_url('ScorecardController/add_first_batting/'.$toss_information['bat_first'].'/'.$toss_information['bowl_first'].'/'.$match_id); ?>" 
                       class="nav-btn">
                       <?php echo (!empty($first_batting)) ? 'Edit' : 'Add'; ?>
                    </a>
                </div>
                
                <!-- 1st Innings Bowling - Only show if 1st batting exists -->
                <div class="nav-card" <?php echo (empty($first_batting)) ? 'style="opacity:0.5"' : ''; ?>>
                    <div>
                        <div class="nav-text">1st Innings Bowling</div>
                        <div class="nav-team"><?php echo $toss_information['bowl_first_name'] ?? 'Team 2'; ?></div>
                    </div>
                    <?php if (!empty($first_batting)): ?>
                        <a href="<?php echo base_url('ScorecardController/show_bowling_first/'.$toss_information['bat_first'].'/'.$toss_information['bowl_first'].'/'.$match_id); ?>" 
                           class="nav-btn">
                           Add/Edit
                        </a>
                    <?php else: ?>
                        <span class="nav-btn disabled">Add/Edit</span>
                    <?php endif; ?>
                </div>
                
                <!-- 2nd Innings Batting - Only show if 1st innings completed -->
                <div class="nav-card" <?php echo (empty($first_batting)) ? 'style="opacity:0.5"' : ''; ?>>
                    <div>
                        <div class="nav-text">2nd Innings Batting</div>
                        <div class="nav-team"><?php echo $toss_information['bowl_first_name'] ?? 'Team 2'; ?></div>
                    </div>
                    <?php if (!empty($first_batting)): ?>
                        <a href="<?php echo base_url('ScorecardController/add_second_batting/'.$toss_information['bat_first'].'/'.$toss_information['bowl_first'].'/'.$match_id); ?>" 
                           class="nav-btn">
                           <?php echo (!empty($second_batting)) ? 'Edit' : 'Add'; ?>
                        </a>
                    <?php else: ?>
                        <span class="nav-btn disabled">Add/Edit</span>
                    <?php endif; ?>
                </div>
                
                <!-- 2nd Innings Bowling - Only show if 2nd batting exists -->
                <div class="nav-card" <?php echo (empty($second_batting)) ? 'style="opacity:0.5"' : ''; ?>>
                    <div>
                        <div class="nav-text">2nd Innings Bowling</div>
                        <div class="nav-team"><?php echo $toss_information['bat_first_name'] ?? 'Team 1'; ?></div>
                    </div>
                    <?php if (!empty($second_batting)): ?>
                        <a href="<?php echo base_url('ScorecardController/show_bowling_second/'.$toss_information['bat_first'].'/'.$toss_information['bowl_first'].'/'.$match_id); ?>" 
                           class="nav-btn">
                           Add/Edit
                        </a>
                    <?php else: ?>
                        <span class="nav-btn disabled">Add/Edit</span>
                    <?php endif; ?>
                </div>
                
                <!-- Player of the Match Section -->
                <div class="motm-section">
                    <div class="motm-title">
                        <i class="fas fa-trophy"></i> Player of the Match
                    </div>
                    <?php if (empty($player_of_match['player_id'])): ?>
                        <button class="nav-btn" id="motm-select-btn" style="width: 100%;">
                            <i class="fas fa-plus-circle"></i> Select Player of the Match
                        </button>
                    <?php else: ?>
                        <div class="motm-display">
                            <div class="motm-player-img-container">
                                <?php if (!empty($player_of_match['image_path'])): ?>
                                    <img src="<?php echo $player_of_match['image_path']; ?>" alt="Player" class="motm-player-img">
                                <?php else: ?>
                                    <div class="motm-player-default">
                                        <i class="fas fa-user"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="motm-badge">
                                    <i class="fas fa-trophy"></i>
                                </div>
                            </div>
                            <div class="motm-player-info">
                                <div class="motm-player-name"><?php echo $player_of_match['playerName']; ?></div>
                                <div class="motm-player-team"><?php echo $player_of_match['team_name'] ?? 'N/A'; ?></div>
                                <?php if (!empty($player_of_match['selected_at'])): ?>
                                    <div class="motm-selected-at">
                                        Selected: <?php echo date('M j, Y g:i a', strtotime($player_of_match['selected_at'])); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <button class="motm-edit-btn" id="motm-edit-btn">
                                <i class="fas fa-edit"></i> Change
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Full Scorecard Link - Only show if both innings completed -->
                <div class="nav-card" <?php echo (empty($first_batting) || empty($second_batting)) ? 'style="opacity:0.5"' : ''; ?>>
                    <div>
                        <div class="nav-text">Full Scorecard</div>
                        <div class="nav-team">Match Summary</div>
                    </div>
                    <?php if (!empty($first_batting) && !empty($second_batting)): ?>
                        <a href="<?php echo base_url('Welcome/scorecard/'.$toss_information['bat_first'].'/'.$toss_information['bowl_first'].'/'.$match_id); ?>" 
                           class="nav-btn">
                           View
                        </a>
                    <?php else: ?>
                        <span class="nav-btn disabled">View</span>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="error-message">
                Toss information not available. Please set up the toss for this match.
            </div>
        <?php endif; ?>
    </div>

    <!-- Player of the Match Selection Popup -->
    <?php if (!empty($toss_information) && is_array($toss_information)): ?>
        <div class="popup-overlay" id="motm-popup-overlay">
            <div class="popup-content">
                <div class="popup-title">
                    <i class="fas fa-trophy"></i> Select Player of the Match
                </div>
                <form action="<?php echo base_url(); ?>PlayerController/add_match_player" method="POST" id="motm-form">
                    <select name="match_player" class="popup-select" id="motm-player-select" required>
                        <option value="">-- Select Player --</option>
                        <?php foreach ($two_team_player as $players): ?>
                            <option value="<?php echo $players['player_id']; ?>"
                                <?php if (!empty($player_of_match['player_id']) && $player_of_match['player_id'] == $players['player_id']) echo 'selected'; ?>>
                                <?php echo $players['playerName']; ?> (<?php echo $players['team_name'] ?? 'N/A'; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="match_id" value="<?php echo $toss_information['match_id']; ?>">
                    <button type="submit" class="popup-submit">
                        <i class="fas fa-save"></i> Save Selection
                    </button>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // MOTM Popup Handling
            const motmSelectBtn = document.getElementById('motm-select-btn');
            const motmEditBtn = document.getElementById('motm-edit-btn');
            const motmPopupOverlay = document.getElementById('motm-popup-overlay');
            const motmForm = document.getElementById('motm-form');
            
            // Show popup function
            function showMotmPopup() {
                if (motmPopupOverlay) {
                    motmPopupOverlay.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                    document.getElementById('motm-player-select').focus();
                }
            }
            
            // Hide popup function
            function hideMotmPopup() {
                if (motmPopupOverlay) {
                    motmPopupOverlay.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            }
            
            // Event listeners for buttons
            if (motmSelectBtn) {
                motmSelectBtn.addEventListener('click', showMotmPopup);
            }
            
            if (motmEditBtn) {
                motmEditBtn.addEventListener('click', showMotmPopup);
            }
            
            // Close popup when clicking outside
            if (motmPopupOverlay) {
                motmPopupOverlay.addEventListener('click', function(e) {
                    if (e.target === motmPopupOverlay) {
                        hideMotmPopup();
                    }
                });
            }
            
            // Form validation
            if (motmForm) {
                motmForm.addEventListener('submit', function(e) {
                    const select = document.getElementById('motm-player-select');
                    if (!select.value) {
                        e.preventDefault();
                        alert('Please select a player');
                        select.focus();
                    }
                });
            }
            
            // Close popup with ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    hideMotmPopup();
                }
            });
            
            // Flash message auto-dismiss
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 300);
                });
            }, 5000);
        });
    </script>
</body>
</html>