<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cricket Match Scorecard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        body {
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.4;
            padding: 10px;
            min-height: 100vh;
        }

        .scorecard-container {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .match-header {
            padding: 12px;
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
            gap: 8px;
            margin-bottom: 8px;
        }

        .team {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
        }

        .team-logo {
            width: 36px;
            height: 36px;
            object-fit: contain;
            border-radius: 50%;
            background: white;
            padding: 2px;
            margin-bottom: 3px;
        }

        .team-name {
            font-size: 14px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
        }

        .vs-text {
            font-size: 13px;
            font-weight: 700;
            color: #ffcc00;
            flex-shrink: 0;
        }

        .match-info {
            font-size: 11px;
            opacity: 0.9;
            margin-top: 3px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .scorecard-nav {
            padding: 8px 12px;
            max-height: calc(100vh - 240px);
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        .nav-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f8f9fa;
            border-radius: 6px;
            padding: 10px 12px;
            margin-bottom: 8px;
            transition: all 0.2s ease;
            border-left: 3px solid #2a5298;
        }

        .nav-card:hover {
            background: #e9ecef;
        }

        .nav-text {
            flex: 1;
            font-size: 13px;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .nav-team {
            font-size: 11px;
            color: #6c757d;
            margin-top: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .nav-btn {
            background: #2a5298;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            font-size: 11px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            white-space: nowrap;
            margin-left: 8px;
            flex-shrink: 0;
        }

        .motm-section {
            padding: 12px;
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
            background: #f8f9fa;
        }

        .motm-title {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #2a5298;
        }

        .motm-display {
            display: flex;
            align-items: center;
            gap: 8px;
            background: white;
            border-radius: 6px;
            padding: 8px 10px;
            border: 1px solid #ddd;
        }

        .motm-player-img {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
        }

        .motm-player-name {
            flex: 1;
            font-size: 12px;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .motm-edit-btn {
            background: none;
            border: none;
            color: #2a5298;
            font-size: 11px;
            cursor: pointer;
            font-weight: 500;
            flex-shrink: 0;
        }

        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            padding: 12px;
        }

        .popup-content {
            background: white;
            width: 100%;
            max-width: 320px;
            border-radius: 10px;
            padding: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .popup-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 12px;
            color: #2a5298;
        }

        .popup-select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 12px;
            font-size: 13px;
        }

        .popup-submit {
            width: 100%;
            padding: 8px;
            background: #2a5298;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
        }

        @media (max-width: 400px) {
            .team-logo {
                width: 32px;
                height: 32px;
            }
            
            .team-name {
                font-size: 13px;
            }
            
            .vs-text {
                font-size: 12px;
            }
            
            .scorecard-nav {
                max-height: calc(100vh - 220px);
            }
        }
    </style>
</head>
<body>
    <div class="scorecard-container">
        <div class="match-header">
            <div class="teams-display">
                <div class="team">
                    <img src="<?php echo $two_team[0]['image_path'];?>" alt="Team 1 Logo" class="team-logo">
                    <div class="team-name"><?php echo $two_team[0]['team_name'];?></div>
                </div>
                <div class="vs-text">vs</div>
                <div class="team">
                    <img src="<?php echo $two_team[1]['image_path'];?>" alt="Team 2 Logo" class="team-logo">
                    <div class="team-name"><?php echo $two_team[1]['team_name'];?></div>
                </div>
            </div>
            <div class="match-info">
                Toss: <?php echo $toss_information['toss_winner_name'];?> won and chose to <?php echo strtolower($toss1['decision']); ?> first
            </div>
        </div>

        <div class="scorecard-nav">
            <div class="nav-card">
                <div>
                    <div class="nav-text">Team Squads</div>
                    <div class="nav-team">Both Teams</div>
                </div>
                <a href="" class="nav-btn">Edit</a>
            </div>
            
            <div class="nav-card">
                <div>
                    <div class="nav-text">1st Innings Batting</div>
                    <div class="nav-team"><?php echo $toss_information['bat_first_name'];?></div>
                </div>
                <a href="<?php echo base_url();?>ScorecardController/add_first_batting/<?php echo $toss_information['bat_first'];?>/<?php echo $toss_information['bowl_first'];?>/<?php echo $toss_information['match_id'];?>" class="nav-btn">Edit</a>
            </div>
            
            <div class="nav-card">
                <div>
                    <div class="nav-text">1st Innings Bowling</div>
                    <div class="nav-team"><?php echo $toss_information['bowl_first_name'];?></div>
                </div>
                <a href="<?php echo base_url();?>ScorecardController/show_bowling_first/<?php echo $toss_information['bat_first'];?>/<?php echo $toss_information['bowl_first'];?>/<?php echo $toss_information['match_id'];?>" class="nav-btn">Edit</a>
            </div>
            
            <div class="nav-card">
                <div>
                    <div class="nav-text">2nd Innings Batting</div>
                    <div class="nav-team"><?php echo $toss_information['bowl_first_name'];?></div>
                </div>
                <a href="<?php echo base_url();?>ScorecardController/add_second_batting/<?php echo $toss_information['bat_first'];?>/<?php echo $toss_information['bowl_first'];?>/<?php echo $toss_information['match_id'];?>" class="nav-btn">Edit</a>
            </div>
            
            <div class="nav-card">
                <div>
                    <div class="nav-text">2nd Innings Bowling</div>
                    <div class="nav-team"><?php echo $toss_information['bat_first_name'];?></div>
                </div>
                <a href="<?php echo base_url();?>ScorecardController/show_bowling_second/<?php echo $toss_information['bat_first'];?>/<?php echo $toss_information['bowl_first'];?>/<?php echo $toss_information['match_id'];?>" class="nav-btn">Edit</a>
            </div>

            <!-- Moved Player of the Match before Full Scorecard -->
            <div class="motm-section">
                <div class="motm-title">Player of the Match</div>
                <?php if (empty($player_of_match['player_id'])) { ?>
                    <button class="nav-btn" id="motm-select-btn" style="width: 100%;">Select Player of the Match</button>
                <?php } else { ?>
                    <div class="motm-display">
                        <img src="<?php echo $player_of_match['image_path']; ?>" alt="Player" class="motm-player-img">
                        <div class="motm-player-name"><?php echo $player_of_match['playerName']; ?></div>
                        <button class="motm-edit-btn" id="motm-edit-btn">Change</button>
                    </div>
                <?php } ?>
            </div>
            
            <div class="nav-card">
                <div>
                    <div class="nav-text">Full Scorecard</div>
                    <div class="nav-team">Match Summary</div>
                </div>
                <a href="<?php echo base_url();?>Welcome/scorecard/<?php echo $toss_information['bat_first'];?>/<?php echo $toss_information['bowl_first'];?>/<?php echo $toss_information['match_id'];?>" class="nav-btn">View</a>
            </div>
        </div>
    </div>

    <div class="popup-overlay" id="motm-popup-overlay">
        <div class="popup-content">
            <div class="popup-title">Select Player of the Match</div>
            <form action="<?php echo base_url();?>PlayerController/add_match_player" method="POST">
                <select name="match_player" class="popup-select" id="motm-player-select">
                    <option value="">Select Player</option>
                    <?php foreach($two_team_player as $players) { ?>
                        <option value="<?php echo $players['player_id'];?>"><?php echo $players['playerName'];?></option>
                    <?php } ?>
                </select>
                <input type="hidden" name="match_id" value="<?php echo $toss_information['match_id'];?>">
                <button type="submit" class="popup-submit">Submit</button>
            </form>
        </div>
    </div>

    <script>
        const motmSelectBtn = document.getElementById('motm-select-btn');
        const motmEditBtn = document.getElementById('motm-edit-btn');
        const motmPopupOverlay = document.getElementById('motm-popup-overlay');
        
        if (motmSelectBtn) {
            motmSelectBtn.addEventListener('click', function() {
                motmPopupOverlay.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            });
        }
        
        if (motmEditBtn) {
            motmEditBtn.addEventListener('click', function() {
                motmPopupOverlay.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            });
        }
        
        motmPopupOverlay.addEventListener('click', function(e) {
            if (e.target === motmPopupOverlay) {
                motmPopupOverlay.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    </script>
</body>
</html>