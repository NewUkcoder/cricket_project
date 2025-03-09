<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cricket Match Scorecard</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #fff;
            text-align: center;
            padding: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Match Information Section */
        .match-info {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            padding: 20px;
            margin: 20px auto;
            border-radius: 12px;
            width: 90%;
            max-width: 1100px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, #ffffff, #f9f9f9);
        }

        .match-info p {
            font-size: 1.1rem;
            margin: 8px 0;
            color: #333;
            flex-basis: 100%;
        }

        .match-info span {
            font-weight: bold;
            color: #1e3c72;
        }

        .match-teams {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-basis: 100%;
            gap: 20px;
            margin-bottom: 20px;
        }

        .match-teams div {
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            padding: 10px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            color: #fff;
        }

        .match-teams img {
            width: 40px;
            height: 30px;
            margin-right: 10px;
            border-radius: 4px;
        }

        /* Player of the Match Section */
        .player-of-the-match {
            position: relative;
            font-size: 1.3rem;
            margin-top: 20px;
            display: flex;
            align-items: center;
            padding: 20px;
            background: linear-gradient(135deg, #0055cc, #0077cc);
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            flex-basis: 100%;
            justify-content: center;
            transition: transform 0.3s ease;
            color: #ffffff;
            text-align: center;
        }

        .player-of-the-match img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 3px solid #ffcc00;
            object-fit: cover;
        }

        .player-of-the-match p {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .player-of-the-match:hover {
            transform: scale(1.05);
        }

        .scorecard-container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        .innings-header {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #fff;
            padding: 15px;
            border-radius: 12px;
            font-size: 1.3rem;
            margin-bottom: 20px;
            font-weight: 600;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .scorecard-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            background-color: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .scorecard-table th,
        .scorecard-table td {
            padding: 12px;
            text-align: center;
            font-size: 1rem;
            border-bottom: 1px solid #e0e0e0;
            color: #444;
        }

        .scorecard-table th {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #fff;
            font-weight: 600;
        }

        .scorecard-table td {
            background-color: #fafafa;
        }

        .scorecard-table tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }

        .highlight-player {
            background-color: #ffcc00;
            font-weight: 600;
        }

        .player-info {
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .player-image {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 10px;
            border: 2px solid #1e3c72;
            object-fit: cover;
        }

        .player-name {
            font-size: 1rem;
            font-weight: 600;
            color: #444;
        }

        .responsive-table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }

        .squad-section {
            margin-top: 20px;
            margin-bottom: 40px;
        }

        .squad-section h3 {
            font-size: 1.3rem;
            margin-bottom: 15px;
            font-weight: 600;
            color: #333;
            text-align: center;
        }

        .squad-list {
            display: flex;
            justify-content: space-evenly;
            flex-wrap: wrap;
        }

        .squad-list div {
            display: flex;
            align-items: center;
            margin: 10px;
            background-color: #f7f7f7;
            padding: 10px;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .squad-list div:hover {
            transform: scale(1.05);
            background-color: #e0e0e0;
        }

        .squad-list img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
            border: 2px solid #1e3c72;
            object-fit: cover;
        }

        .squad-list div span {
            font-size: 1rem;
            font-weight: 600;
        }

        /* Match Result Section */
        .match-result {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1e3c72;
            text-align: center;
            margin: 20px 0;
            padding: 15px;
            background-color: #ffcc00;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .scorecard-table th,
            .scorecard-table td {
                padding: 8px;
                font-size: 0.9rem;
            }

            .innings-header {
                font-size: 1.1rem;
            }

            .match-info {
                flex-direction: column;
                align-items: center;
            }

            .match-info p {
                margin: 5px 0;
                flex-basis: 100%;
                text-align: left;
            }

            .match-teams {
                flex-direction: row;
                justify-content: center;
                flex-wrap: nowrap;
                gap: 10px;
            }

            .match-teams div {
                margin: 5px;
                padding: 8px 15px;
                font-size: 0.9rem;
            }

            .player-of-the-match {
                flex-direction: column;
                align-items: center;
                padding: 15px;
                width: auto;
                margin-top: 20px;
            }

            .player-of-the-match img {
                margin-bottom: 15px;
            }

            .match-result {
                font-size: 1.2rem;
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="match-teams">
            <div>
                <img src="<?php echo $information['team_one_image'];?>" alt="Team A Flag">
                <span><strong><?php echo $information['team_one_name'];?></strong></span>
            </div>
            <div>
                <img src="<?php echo $information['team_two_image'];?>" alt="Team B Flag">
                <span><strong><?php echo $information['team_two_name'];?></strong></span>
            </div>
        </div>
    </header>
 <div class="match-result">
        <?php echo $match_result; ?>
    </div>
    <!-- Match Information Section -->
    <div class="match-info">
        <div>
            <p><span>Match Date:</span><?php echo $information['match_date'];?></p>
            <p><span>Match Time:</span><?php echo $information['match_time'];?></p>
            <p><span>Venue:</span> <?php echo $information['location'];?></p>
            <p><span>Format:</span><?php echo $information['match_type'];?></p>
            <p><span>Series:</span> <?php echo $information['series'];?></p>
            <p><span>Overs:</span> <?php echo $information['overs'];?></p>
            <p><span>Toss Result:</span> <?php echo $information['toss_winner_name'];?> won the toss and chose to <?php echo $information['decision'];?>.</p>
            <p><span>Umpires:</span> <?php echo $information['umpire1'];?>, <?php echo $information['umpire2'];?></p>
        </div>
   
        <!-- Player of the Match -->
        <div class="player-of-the-match">
            <img src="https://via.placeholder.com/100" alt="Player of the Match">
            <p><strong>Player of the Match: John Doe</strong></p>
        </div>
    </div>

    <!-- Match Result Section -->
   

    <!-- Scorecards for First and Second Innings -->
    <!-- First Innings - Batting -->
    <div class="scorecard-container">
        <div class="innings-header">
            <span>First Innings - Batting</span>
        </div>
        <div class="responsive-table">
            <table class="scorecard-table">
                <thead>
                    <tr>
                        <th>Player</th>
                        <th>Runs</th>
                        <th>Balls</th>
                        <th>4s</th>
                        <th>6s</th>
                        <th>SR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($first_inning !=0){ foreach($first_inning as $score) {
                    $strike_rate = ($score->runs / $score->balls) * 100; ?>
                    <tr>
                        <td>
                            <div class="player-info">
                                <img class="player-image" src="<?php echo $score->image_path;?>" alt="Player A1">
                                <span class="player-name"><?php echo $score->playerName;?></span>
                            </div>
                        </td>
                        <td><?php echo $score->runs;?></td>
                        <td><?php echo $score->balls;?></td>
                        <td><?php echo $score->fours;?></td>
                          <td><?php echo $score->sixes;?></td>
                        <td><?php echo number_format($strike_rate, 2);?></td>
                    </tr>
                    <?php } } else { ?> 
                        <tr> <td colspan="5" align="text-center"> No record available for this innings yet. </td> </tr>
                     
                  <?php  }?>
                   <tr>
                      <?php  if($batting_first_score !=0) {foreach($batting_first_score as $t_score) { ?>
                    <td><strong>Extras</strong></td>
                    <td colspan="5"><?php echo $t_score->total_extra; ?> (W <?php echo $t_score->wides; ?>, NB <?php echo $t_score->no_balls; ?>, B <?php echo $t_score->byes; ?>, LB <?php echo $t_score->leg_byes; ?>)</td>
                </tr>
                <tr>
                    <td><strong>Total Runs</strong></td>
                    <td colspan="5"><?php echo $t_score->total_runs; ?>/<?php echo $t_score->wickets;?> (<?php echo $t_score->t_overs; ?> Overs)</td>
                </tr>
            <?php } }?>
                </tbody>
            </table>
        </div>


        <!-- First Innings - Bowling -->
       <div class="innings-header">
            <span>First Innings - Bowling</span>
        </div>
        <div class="responsive-table">
            <table class="scorecard-table">
                <thead>
                    <tr>
                        <th>Player</th>
                        <th>Overs</th>
                        <th>Runs</th>
                        <th>Wickets</th>
                        <th>Economy</th>
                    </tr>
                </thead>
                <tbody>
                      <?php if($first_bowling_inning !=0) { foreach($first_bowling_inning as $f_bowling) {
                     $economy = $f_bowling->given_runs / $f_bowling->overs; ?>
                    <tr>
                        <td>
                            <div class="player-info">
                                <img class="player-image" src="<?php echo $f_bowling->image_path;?>" alt="Player B1">
                                <span class="player-name"><?php echo $f_bowling->playerName;?></span>
                            </div>
                        </td>
                        <td><?php echo $f_bowling->overs;?></td>
                        <td><?php echo $f_bowling->given_runs;?></td>
                        <td><?php echo $f_bowling->wickets;?></td>
                        <td><?php echo number_format($economy, 2);?></td>
                    </tr>
                    <?php } } else { ?> 
                        <tr> <td colspan="5" align="text-center"> No record available for this innings yet. </td> </tr>
                     
                  <?php  }?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Second Innings -->
    <div class="scorecard-container">
        <div class="innings-header">
            <span>Second Innings - Batting</span>
        </div>
        <div class="responsive-table">
            <table class="scorecard-table">
                <thead>
                    <tr>
                        <th>Player</th>
                        <th>Runs</th>
                        <th>Balls</th>
                        <th>4s</th>
                        <th>6s</th>
                        <th>SR</th>
                    </tr>
                </thead>
                <tbody>
                     <?php if($second_inning !=0){ foreach($second_inning as $score) {
                    $strike_rate = ($score->runs / $score->balls) * 100; ?>
                    <tr>
                        <td>
                            <div class="player-info">
                                <img class="player-image" src="<?php echo $score->image_path;?>" alt="Player A1">
                                <span class="player-name"><?php echo $score->playerName;?></span>
                            </div>
                        </td>
                        <td><?php echo $score->runs;?></td>
                        <td><?php echo $score->balls;?></td>
                        <td><?php echo $score->fours;?></td>
                          <td><?php echo $score->sixes;?></td>
                        <td><?php echo number_format($strike_rate, 2);?></td>
                    </tr>
                    <?php } } else { ?> 
                        <tr> <td colspan="5" align="text-center"> No record available for this innings yet. </td> </tr>
                     
                  <?php  }?>
                     <tr>
                      <?php if($batting_second_score !=0) {foreach($batting_second_score as $t_score) { ?>
                    <td><strong>Extras</strong></td>
                    <td colspan="5"><?php echo $t_score->total_extra; ?> (W <?php echo $t_score->wides; ?>, NB <?php echo $t_score->no_balls; ?>, B <?php echo $t_score->byes; ?>, LB <?php echo $t_score->leg_byes; ?>)</td>
                </tr>
                <tr>
                    <td><strong>Total Runs</strong></td>
                    <td colspan="5"><?php echo $t_score->total_runs; ?>/<?php echo $t_score->wickets;?> (<?php echo $t_score->t_overs; ?> Overs)</td>
                </tr>
            <?php } }?>
                </tbody>
            </table>
        </div>

        <!-- Second Innings - Bowling -->
        <div class="innings-header">
            <span>Second Innings - Bowling</span>
        </div>
        <div class="responsive-table">
            <table class="scorecard-table">
                <thead>
                    <tr>
                        <th>Player</th>
                        <th>Overs</th>
                        <th>Runs</th>
                        <th>Wickets</th>
                        <th>Economy</th>
                    </tr>
                </thead>
                <tbody>
                      <?php if($second_bowling_inning !=0) { foreach($second_bowling_inning as $f_bowling) {
                     $economy = $f_bowling->given_runs / $f_bowling->overs; ?>
                    <tr>
                        <td>
                            <div class="player-info">
                                <img class="player-image" src="<?php echo $f_bowling->image_path;?>" alt="Player B1">
                                <span class="player-name"><?php echo $f_bowling->playerName;?></span>
                            </div>
                        </td>
                        <td><?php echo $f_bowling->overs;?></td>
                        <td><?php echo $f_bowling->given_runs;?></td>
                        <td><?php echo $f_bowling->wickets;?></td>
                        <td><?php echo number_format($economy, 2);?></td>
                    </tr>
                    <?php } } else { ?> 
                        <tr> <td colspan="5" align="text-center"> No record available for this innings yet. </td> </tr>
                     
                  <?php  }?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Team Squads Section -->
    <div class="scorecard-container squad-section">
        <h3>Team Squads</h3>

        <!-- Team A Squad -->
        <div class="squad-list">
            <div>
                <img src="https://via.placeholder.com/50" alt="Player A1">
                <span>Player A1</span>
            </div>
            <div>
                <img src="https://via.placeholder.com/50" alt="Player A2">
                <span>Player A2</span>
            </div>
            <div>
                <img src="https://via.placeholder.com/50" alt="Player A3">
                <span>Player A3</span>
            </div>
            <div>
                <img src="https://via.placeholder.com/50" alt="Player A4">
                <span>Player A4</span>
            </div>
            <div>
                <img src="https://via.placeholder.com/50" alt="Player A5">
                <span>Player A5</span>
            </div>
        </div>

        <!-- Team B Squad -->
        <div class="squad-list">
            <div>
                <img src="https://via.placeholder.com/50" alt="Player B1">
                <span>Player B1</span>
            </div>
            <div>
                <img src="https://via.placeholder.com/50" alt="Player B2">
                <span>Player B2</span>
            </div>
            <div>
                <img src="https://via.placeholder.com/50" alt="Player B3">
                <span>Player B3</span>
            </div>
            <div>
                <img src="https://via.placeholder.com/50" alt="Player B4">
                <span>Player B4</span>
            </div>
        </div>
    </div>
</body>

</html>