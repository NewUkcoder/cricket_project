<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cricket League</title>
    <style>
        /* Reset and Universal Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: white;
            color: #333;
            font-size: 14px;
        }

        .external-header {
            background: white;
            color: #005f8d;
            text-align: center;
            padding: 20px 0;
            border-bottom: 2px solid #005f8d;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .external-header h1 {
            font-size: 2.5em;
            letter-spacing: 1px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
        }

        .external-header .league-info {
            font-size: 1.1em;
            color: #666;
            margin-top: 10px;
        }

        /* Navigation Styles */
        .main-nav {
            background-color: #005f8d;
            position: sticky;
            top: 0;
            z-index: 100;
            padding: 8px 0;
            overflow-x: auto; /* Enable horizontal scrolling */
            white-space: nowrap; /* Prevent wrapping of navigation items */
        }

        #main-nav-ul {
            display: inline-block; /* Make the list inline */
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        #main-nav-ul li {
            display: inline-block; /* Display list items inline */
            margin: 0 15px;
        }

        #main-nav-ul li a {
            color: white;
            text-decoration: none;
            font-size: 1em;
            padding: 6px 12px;
            display: block;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        #main-nav-ul li a:hover {
            background-color: #00b0ff;
            transform: scale(1.05);
        }

        /* Hide scrollbar for a cleaner look (optional) */
        .main-nav::-webkit-scrollbar {
            display: none;
        }

        .main-nav {
            -ms-overflow-style: none; /* IE and Edge */
            scrollbar-width: none; /* Firefox */
        }

        /* Main Container */
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        /* Section Titles */
        .section-title {
            margin-bottom: 25px;
            font-size: 1.6em;
            color: #005f8d;
            text-align: center;
            border-bottom: 3px solid #007bb5;
            padding-bottom: 10px;
        }

        /* Top Players & Stats Section */
        .statistics {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-card img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 3px solid #007bb5;
        }

        .stat-card h4 {
            font-size: 1.4em;
            color: #005f8d;
            margin-bottom: 10px;
        }

        .stat-card p {
            font-size: 1.1em;
            color: #666;
        }

        .stat-card .team-name {
            font-size: 1.1em;
            color: #007bb5;
            font-weight: bold;
            margin-top: 10px;
        }

        /* Schedule Section */
        .schedule-section {
            margin-top: 40px;
        }

        .schedule-card {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .schedule-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .schedule-card h4 {
            font-size: 1.4em;
            color: #005f8d;
            margin-bottom: 10px;
            text-align: center;
        }

        .schedule-card .match-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.1em;
            color: #666;
        }

        .schedule-card .match-details p {
            margin: 0;
        }

        /* Result Section */
        .result-section {
            margin-top: 40px;
        }

        .result-card {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .result-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .result-card h4 {
            font-size: 1.4em;
            color: #005f8d;
            margin-bottom: 15px;
            text-align: center;
        }

        .result-card .team-images img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            border: 3px solid #007bb5;
        }

        .result-card .team-images span {
            font-size: 1.2em;
            color: #005f8d;
            font-weight: bold;
        }

        .result-card .result-details {
            text-align: center;
            margin-bottom: 15px;
        }

        .result-card .result-details p {
            font-size: 1.1em;
            color: #666;
            margin: 5px 0;
        }

        .result-card .result-details p strong {
            color: #005f8d;
        }

        .result-card .view-scorecard-button {
            background-color: #007bb5;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
            display: block;
            margin: 0 auto;
        }

        .result-card .view-scorecard-button:hover {
            background-color: #005f8d;
        }

        /* Team Section */
        .team-section {
            margin-top: 40px;
        }

        .team-card {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .team-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .team-card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 3px solid #007bb5;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .team-card h4 {
            font-size: 1.4em;
            color: #005f8d;
            margin-bottom: 20px;
            text-align: center;
            word-wrap: break-word;
        }

        .team-card .player-stats {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .team-card .player-stats .player-info {
            flex: 1;
            min-width: 200px;
            text-align: center;
        }

        .team-card .player-stats .player-info img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            margin-bottom: 10px;
            border: 2px solid #007bb5;
        }

        .team-card .player-stats .player-info h5 {
            font-size: 1.2em;
            color: #005f8d;
            margin-bottom: 10px;
        }

        .team-card .player-stats .player-info p {
            font-size: 1em;
            color: #666;
            margin: 5px 0;
        }

        .team-card .player-stats .player-info .scorecard-link {
            color: #007bb5;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .team-card .player-stats .player-info .scorecard-link:hover {
            color: #005f8d;
        }

        /* Points Table */
        .points-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }

        .points-table th,
        .points-table td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .points-table th {
            background-color: #007bb5;
            color: white;
            font-size: 1.1em;
        }

        .points-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .points-table tr:hover {
            background-color: #f1f1f1;
        }

        .points-table .highlight {
            font-weight: bold;
            color: #007bb5;
        }

        /* Team Images Styling */
        .team-images {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin-bottom: 15px;
        }

        .team-images img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            border: 3px solid #007bb5;
        }

        .team-images span {
            font-size: 1.2em;
            color: #005f8d;
            font-weight: bold;
        }

        /* League Rules Section */
        .rules-section {
            margin-top: 40px;
        }

        .rules-card {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .rules-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .rules-card h4 {
            font-size: 1.4em;
            color: #005f8d;
            margin-bottom: 10px;
        }

        .rules-card ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        .rules-card ul li {
            font-size: 1.1em;
            color: #666;
            margin-bottom: 10px;
        }

        footer {
            background-color: #005f8d;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="external-header">
        <h1><?php echo $league['league_name']; ?></h1>
        <div class="league-info">
            <p>Season: <?php echo $league['season']; ?> | City: <?php echo $league['city']; ?> | Country: <?php echo $league['country']; ?> | Ball: <?php echo $league['match_type']; ?></p>
        </div>
        <div class="league-info">
            <p>Venue: <?php echo $league['venue']; ?> | Phone: <?php echo $league['phone_number']; ?> | Overs: <?php echo $league['overs']; ?></p>
        </div>
    </div>

    <!-- Navigation Bar -->
    <nav class="main-nav">
        <ul id="main-nav-ul">
            <li><a href="#teams">Teams</a></li>
            <li><a href="#stats">Stats</a></li>
            <li><a href="#schedule">Schedule</a></li>
            <li><a href="#points-table">Points Table</a></li>
            <li><a href="#result">Results</a></li>
            <li><a href="#rules">League Rules</a></li>
        </ul>
    </nav>

    <div class="container">
        <!-- Top Players & Stats -->
        <div id="stats" class="section-title">Top Players & Stats</div>
        <div class="statistics">
            <div class="stat-card">
                <img src="https://via.placeholder.com/70" alt="Top Batsman">
                <h4>Top Batsman</h4>
                <p>Player Name - 890 runs</p>
                <p class="team-name">Team 1</p>
            </div>

            <div class="stat-card">
                <img src="https://via.placeholder.com/70" alt="Top Bowler">
                <h4>Top Bowler</h4>
                <p>Player Name - 40 wickets</p>
                <p class="team-name">Team 2</p>
            </div>

            <div class="stat-card">
                <h4>Highest Individual Score</h4>
                <p>Player Name - 180 runs</p>
                <p class="team-name">Team 3</p>
            </div>

            <div class="stat-card">
                <h4>Highest Wicket Taker in a Match</h4>
                <p>Player Name - 7 wickets</p>
                <p class="team-name">Team 4</p>
            </div>

            <div class="stat-card">
                <h4>Highest Team Score</h4>
                <p>Team Name - 320/5</p>
                <p class="team-name">Team 1</p>
            </div>

            <div class="stat-card">
                <h4>Lowest Team Score</h4>
                <p>Team Name - 50 all out</p>
                <p class="team-name">Team 4</p>
            </div>
        </div>

        <!-- Schedule Section -->
        <div id="schedule" class="section-title">Upcoming Matches</div>
        <div class="schedule-section">
            <?php if (!empty($league_schedule)) { 
                foreach ($league_schedule as $schedule) { ?>
                    <div class="schedule-card">
                        <div class="team-images">
                            <img src="<?php echo $schedule->team_one_image; ?>" alt="Team 1">
                            <span>vs</span>
                            <img src="<?php echo $schedule->team_two_image; ?>" alt="Team 3">
                        </div>
                        <h4><?php echo $schedule->team_one_name; ?> vs <?php echo $schedule->team_two_name; ?></h4>
                        <div class="match-details">
                            <?php $date = $schedule->match_date; $formatted_date = date("d F Y", strtotime($date)); ?>
                            <p><strong>Date:</strong> <?php echo $formatted_date; ?></p>
                            <p><strong>Time:</strong> <?php echo $schedule->match_time; ?></p>
                            <p><strong>Venue:</strong> <?php echo $schedule->location; ?></p>
                        </div>
                    </div>
                <?php } 
            } else { ?>
                <h2>Currently no schedule is added.</h2>
            <?php } ?>
        </div>

        <!-- Result Section -->
        <div id="result" class="section-title">Recent Match Results</div>
        <div class="result-section">
            <!-- Result Card 1 -->
            <div class="result-card">
                <div class="team-images">
                    <img src="https://via.placeholder.com/70" alt="Team 1">
                    <span>vs</span>
                    <img src="https://via.placeholder.com/70" alt="Team 2">
                </div>
                <h4>Team 1: The Mighty Warriors vs Team 2: The Glorious Champions</h4>
                <div class="result-details">
                    <p><strong>Score:</strong> Team 1 - 250/7 (50 overs) | Team 2 - 240/8 (50 overs)</p>
                    <p><strong>Result:</strong> Team 1 won by 10 runs</p>
                    <p><strong>Player of the Match:</strong> Player A (Team 1) - 120 runs & 3 wickets</p>
                </div>
                <button class="view-scorecard-button">View Full Scorecard</button>
            </div>

            <!-- Result Card 2 -->
            <div class="result-card">
                <div class="team-images">
                    <img src="https://via.placeholder.com/70" alt="Team 3">
                    <span>vs</span>
                    <img src="https://via.placeholder.com/70" alt="Team 4">
                </div>
                <h4>Team 3: The Fearless Fighters vs Team 4: The Dominators</h4>
                <div class="result-details">
                    <p><strong>Score:</strong> Team 3 - 180/5 (20 overs) | Team 4 - 120/9 (20 overs)</p>
                    <p><strong>Result:</strong> Team 3 won by 60 runs</p>
                    <p><strong>Player of the Match:</strong> Player B (Team 3) - 85 runs & 2 wickets</p>
                </div>
                <button class="view-scorecard-button">View Full Scorecard</button>
            </div>
        </div>

        <!-- Points Table -->
        <div id="points-table" class="section-title">Points Table</div>
        <table class="points-table">
            <thead>
                <tr>
                    <th>Position</th>
                    <th>Team</th>
                    <th>Matches</th>
                    <th>Wins</th>
                    <th>Losses</th>
                    <th>Points</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="highlight">1</td>
                    <td>Team 1</td>
                    <td>10</td>
                    <td>8</td>
                    <td>2</td>
                    <td>16</td>
                </tr>
                <tr>
                    <td class="highlight">2</td>
                    <td>Team 2</td>
                    <td>10</td>
                    <td>7</td>
                    <td>3</td>
                    <td>14</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Team 3</td>
                    <td>10</td>
                    <td>6</td>
                    <td>4</td>
                    <td>12</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Team 4</td>
                    <td>10</td>
                    <td>4</td>
                    <td>6</td>
                    <td>8</td>
                </tr>
            </tbody>
        </table>

        <!-- Team Section -->
        <div id="teams" class="section-title">Teams</div>
        <div class="team-section">
            <!-- Team 1 -->
            <?php if (!empty($league_teams)) { 
                foreach ($league_teams as $l_teams) { ?>
                    <div class="team-card">
                        <img src="<?php echo $l_teams['image_path']; ?>" alt="Team 1">
                        <h4><a href="<?php echo base_url(); ?>TeamController/team_profile/<?php echo $l_teams['team_id']; ?>"><?php echo $l_teams['team_name']; ?></a></h4>
                        <div class="player-stats">
                            <div class="player-info">
                                <img src="https://via.placeholder.com/70" alt="Top Batsman">
                                <h5>Top Batsman</h5>
                                <p>Player A - 890 runs</p>
                            </div>
                            <div class="player-info">
                                <img src="https://via.placeholder.com/70" alt="Top Bowler">
                                <h5>Top Bowler</h5>
                                <p>Player B - 40 wickets</p>
                            </div>
                            <div class="player-info">
                                <img src="https://via.placeholder.com/70" alt="Highest Individual Score">
                                <h5>Highest Individual Score</h5>
                                <p>Player C - 180 runs</p>
                                <a href="#" class="scorecard-link">View Scorecard</a>
                            </div>
                            <div class="player-info">
                                <img src="https://via.placeholder.com/70" alt="Most Wicket-Taker">
                                <h5>Most Wicket-Taker in a Match</h5>
                                <p>Player D - 7 wickets</p>
                                <a href="#" class="scorecard-link">View Scorecard</a>
                            </div>
                        </div>
                    </div>
                <?php } 
            } else { ?>
                <h2>Currently, there is no registered team in the league yet.</h2>
            <?php } ?>
        </div>

        <!-- League Rules Section -->
        <div id="rules" class="section-title">League Rules</div>
        <div class="rules-section">
            <div class="rules-card">
                <ul>
                    <?php if (!empty($league_rules)) { 
                        foreach ($league_rules as $rule) { ?>
                            <li> <?php echo $rule->league_rule; ?>.</li>
                        <?php } 
                    } else { 
                        echo "No rules are mentioned yet. Add new rules of the league";
                    } ?>
                </ul>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Cricket League</p>
    </footer>
</body>
</html>