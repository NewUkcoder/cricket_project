<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cricket Match Scorecard</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body1 {
            background-color: #f4f4f9;
            color: #333;
            line-height: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 10px;
             display: flex;
 
        }

        /* Unique Container Class */
        .cricket-container {
            max-width: 500px;
            width: 100%;
            padding: 10px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Unique Header Class */
        .cricket-header {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            padding-bottom: 10px;
            border-bottom: 2px solid #ddd;
        }

        .cricket-team {
            text-align: center;
        }

        .cricket-team img {
            width: 30px;
            height: 30px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 5px;
        }

        .cricket-team-name {
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .cricket-vs {
            font-size: 16px;
            font-weight: 700;
            color: #007BFF;
        }

        /* Match Details Section */
        .cricket-match-details {
            margin-top: 10px;
        }

        .cricket-match-details h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #007BFF;
        }

        .cricket-match-details ul {
            list-style: none;
            padding: 0;
        }

        .cricket-match-details li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
            padding: 8px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }

        /* Links */
        .cricket-link {
            display: inline-block;
            text-decoration: none;
            color: #007BFF;
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid #007BFF;
            transition: all 0.3s ease;
        }

        .cricket-link:hover {
            background-color: #007BFF;
            color: #fff;
        }

        /* Toss Outcome */
        .cricket-toss-outcome {
            font-size: 12px;
            color: #333;
        }

        /* Man of the Match Section */
        .cricket-man-of-the-match {
            margin-top: 10px;
            text-align: center;
        }

        .cricket-man-of-the-match-display {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
        }

        .cricket-man-of-the-match-display img {
            width: 25px;
            height: 25px;
            object-fit: cover;
            border-radius: 50%;
        }

        .cricket-man-of-the-match-display span {
            font-size: 12px;
            font-weight: 600;
            color: #333;
        }

        .cricket-man-of-the-match-display .cricket-edit-btn {
            background: none;
            border: none;
            color: #007BFF;
            font-size: 10px;
            cursor: pointer;
        }

        /* Popup Styles */
        .cricket-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .cricket-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            width: 90%;
            max-width: 350px;
        }

        .cricket-popup h3 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #007BFF;
        }

        .cricket-popup select {
            width: 100%;
            padding: 6px;
            font-size: 12px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 8px;
        }

        .cricket-popup button {
            width: 100%;
            padding: 6px;
            font-size: 12px;
            border-radius: 5px;
            border: none;
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .cricket-popup button:hover {
            background-color: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .cricket-team img {
                width: 25px;
                height: 25px;
            }

            .cricket-team-name {
                font-size: 12px;
            }

            .cricket-vs {
                font-size: 14px;
            }

            .cricket-link {
                font-size: 10px;
                padding: 4px 8px;
            }
        }

        @media (max-width: 480px) {
            .cricket-team img {
                width: 20px;
                height: 20px;
            }

            .cricket-team-name {
                font-size: 10px;
            }

            .cricket-vs {
                font-size: 12px;
            }

            .cricket-link {
                font-size: 8px;
                padding: 3px 6px;
            }
        }
    </style>
</head>
<body1>
    <div class="cricket-container">
        <!-- Header: Teams & Logos -->
        <div class="cricket-header">
            <div class="cricket-team">
                <img src="<?php echo $two_team[0]['image_path'];?>" alt="Team 1 Logo">
                <div class="cricket-team-name"><?php echo $two_team[0]['team_name'];?></div>
            </div>
            <div class="cricket-vs">vs</div>
            <div class="cricket-team">
                <img src="<?php echo $two_team[1]['image_path'];?>" alt="Team 2 Logo">
                <div class="cricket-team-name"><?php echo $two_team[1]['team_name'];?></div>
            </div>
        </div>

        <!-- Match Details Section -->
        <section class="cricket-match-details">
            <h3>Match Scorecard Details</h3>
            <ul>
                <li>
                    <a href="<?php echo base_url();?>Welcome/toss/<?php echo $two_team[0]['team_id'];?>/<?php echo $two_team[1]['team_id'];?>/<?php echo $match_id;?>" class="cricket-link">Edit</a>
                    <div class="cricket-toss-outcome">Toss: <?php echo $toss_information['toss_winner_name'];?> won and chose to <?php echo strtolower($toss1['decision']); ?> first. </div>
                </li>
                <li>
                    <a href="" class="cricket-link">Add/Edit Squad</a>
                </li>
                <li>
                    <div><?php echo $toss_information['bat_first_name'];?></div>
                    <a href="<?php echo base_url();?>ScorecardController/add_first_batting/<?php echo $toss_information['bat_first'];?>/<?php echo $toss_information['bowl_first'];?>/<?php echo $toss_information['match_id'];?>" class="cricket-link">Add/Edit Batting (1st Innings)</a>
                </li>
                <li>
                    <div><?php echo $toss_information['bowl_first_name'];?></div>
                    <a href="<?php echo base_url();?>ScorecardController/show_bowling_first/<?php echo $toss_information['bat_first'];?>/<?php echo $toss_information['bowl_first'];?>/<?php echo $toss_information['match_id'];?>" class="cricket-link">Add/Edit Bowling (1st Innings)</a>
                </li>
                <li>
                    <div><?php echo $toss_information['bowl_first_name'];?></div>
                    <a href="<?php echo base_url();?>ScorecardController/add_second_batting/<?php echo $toss_information['bat_first'];?>/<?php echo $toss_information['bowl_first'];?>/<?php echo $toss_information['match_id'];?>" class="cricket-link">Add/Edit 2nd Batting (2nd Innings)</a>
                </li>
                <li>
                    <div><?php echo $toss_information['bat_first_name'];?></div>
                    <a href="<?php echo base_url();?>ScorecardController/show_bowling_second/<?php echo $toss_information['bat_first'];?>/<?php echo $toss_information['bowl_first'];?>/<?php echo $toss_information['match_id'];?>" class="cricket-link">Add/Edit Bowling (2nd Innings)</a>
                </li>
               <li>  
    <div>Player of the Match</div>
    <?php if (empty($player_of_match['player_id'])) { ?>
        <div class="cricket-man-of-the-match">
            <a href="#" class="cricket-link" id="cricket-motm-toggle">Choose Man of the Match</a>
        </div>
    <?php } else { ?> 
        <div class="cricket-man-of-the-match">
            <div class="cricket-man-of-the-match-display" id="cricket-motm-display">
                <img src="<?php echo $player_of_match['image_path']; ?>" alt="Player Image">
                <h5><?php echo $player_of_match['playerName']; ?></h5>
                <button class="cricket-edit-btn" id="cricket-motm-edit">Edit</button>
            </div>
        </div>
    <?php } ?>
</li>
                <li> <div> Scorecard </div>
                    <a href="<?php echo base_url();?>Welcome/scorecard/<?php echo $toss_information['bat_first'];?>/<?php echo $toss_information['bowl_first'];?>/<?php echo $toss_information['match_id'];?>" class="cricket-link">View Full Scorecard</a>
                </li>
            </ul>
        </section>

        <!-- Man of the Match Popup -->
        <div class="cricket-overlay" id="cricket-overlay"></div>
        <div class="cricket-popup" id="cricket-motm-popup">
            <h3>Select Man of the Match</h3>
            <form action="<?php echo base_url();?>PlayerController/add_match_player" method="POST">
                <select name="match_player" id="cricket-motm-select">
                    <option value="">Select Player</option>
                    <?php foreach($two_team_player as $players)
                    {  ?>
                    <option value="<?php echo $players['player_id'];?>" data-image="player1.jpg"><?php echo $players['playerName'];?></option>
                    <?php } ?>
                </select>
                <input type="hidden" name="match_id" value="<?php echo $toss_information['match_id'];?>">
                <button type="submit" id="cricket-motm-submit">Submit</button>
            </form>
        </div>
    </div>

    <script>
        const motmToggle = document.getElementById('cricket-motm-toggle');
        const motmPopup = document.getElementById('cricket-motm-popup');
        const overlay = document.getElementById('cricket-overlay');
        const motmDisplay = document.getElementById('cricket-motm-display');
        const motmImage = document.getElementById('cricket-motm-image');
        const motmName = document.getElementById('cricket-motm-name');
        const motmEdit = document.getElementById('cricket-motm-edit');

        motmToggle.addEventListener('click', function (e) {
            e.preventDefault();
            motmPopup.style.display = "block";
            overlay.style.display = "block";
        });

        const motmSubmit = document.getElementById('cricket-motm-submit');
        const motmSelect = document.getElementById('cricket-motm-select');

        motmSubmit.addEventListener('click', function () {
            const selectedOption = motmSelect.options[motmSelect.selectedIndex];
            if (selectedOption.value) {
                const playerName = selectedOption.text;
                const playerImage = selectedOption.getAttribute('data-image');
                motmImage.src = playerImage;
                motmName.textContent = playerName;
                motmDisplay.style.display = "flex";
                motmPopup.style.display = "none";
                overlay.style.display = "none";
            }
        });

        overlay.addEventListener('click', function () {
            motmPopup.style.display = "none";
            overlay.style.display = "none";
        });

        motmEdit.addEventListener('click', function () {
            motmPopup.style.display = "block";
            overlay.style.display = "block";
        });
    </script>
</body>
</html>