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

        .motm-section {
            padding: 15px;
            background: #f9fafb;
            border-top: 1px solid #eee;
        }

        .motm-title {
            font-size: 14px;
            font-weight: 600;
            color: #2a5298;
            margin-bottom: 10px;
        }

        .motm-display {
            display: flex;
            align-items: center;
            gap: 10px;
            background: white;
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .motm-player-img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }

        .motm-player-name {
            font-size: 14px;
            font-weight: 500;
            flex: 1;
        }

        .motm-edit-btn {
            background: none;
            border: none;
            color: #2a5298;
            font-size: 12px;
            cursor: pointer;
            font-weight: 500;
        }

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
        }

        .popup-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #2a5298;
        }

        .popup-select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
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
                <a href="" class="nav-btn">Currently in Progress</a>
                <!-- <a href="<?php echo base_url();?>Welcome/choose_squad/<?php echo $toss_information['bat_first'];?>/<?php echo $toss_information['bowl_first'];?>/<?php echo $toss_information['match_id'];?>" class="nav-btn">Add</a> -->
            </div>
            <div class="nav-card">
                <div>
                    <div class="nav-text">1st Innings Batting</div>
                    <div class="nav-team"><?php echo $toss_information['bat_first_name'];?></div>
                </div>
                <a href="<?php echo base_url();?>ScorecardController/add_first_batting/<?php echo $toss_information['bat_first'];?>/<?php echo $toss_information['bowl_first'];?>/<?php echo $toss_information['match_id'];?>" class="nav-btn">Add</a>
            </div>
            <div class="nav-card">
                <div>
                    <div class="nav-text">1st Innings Bowling</div>
                    <div class="nav-team"><?php echo $toss_information['bowl_first_name'];?></div>
                </div>
                <a href="<?php echo base_url();?>ScorecardController/show_bowling_first/<?php echo $toss_information['bat_first'];?>/<?php echo $toss_information['bowl_first'];?>/<?php echo $toss_information['match_id'];?>" class="nav-btn">Add</a>
            </div>
            <div class="nav-card">
                <div>
                    <div class="nav-text">2nd Innings Batting</div>
                    <div class="nav-team"><?php echo $toss_information['bowl_first_name'];?></div>
                </div>
                <a href="<?php echo base_url();?>ScorecardController/add_second_batting/<?php echo $toss_information['bat_first'];?>/<?php echo $toss_information['bowl_first'];?>/<?php echo $toss_information['match_id'];?>" class="nav-btn">Add</a>
            </div>
            <div class="nav-card">
                <div>
                    <div class="nav-text">2nd Innings Bowling</div>
                    <div class="nav-team"><?php echo $toss_information['bat_first_name'];?></div>
                </div>
                <a href="<?php echo base_url();?>ScorecardController/show_bowling_second/<?php echo $toss_information['bat_first'];?>/<?php echo $toss_information['bowl_first'];?>/<?php echo $toss_information['match_id'];?>" class="nav-btn">Add</a>
            </div>
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