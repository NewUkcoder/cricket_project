<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cricket League Overview</title>
    <style>
        /* Reset and Universal Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: white; /* White background */
            color: #333;
            font-size: 14px; /* Reduced base font size */
        }

        header {
            background: white; /* White background */
            color: #005f8d; /* Dark blue text */
            text-align: center;
            padding: 15px 0; /* Reduced height */
            border-bottom: 2px solid #005f8d;
        }

        header h1 {
            font-size: 2em; /* Slightly smaller text */
            letter-spacing: 1px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }

        header .league-info {
            font-size: 1.1em;
            color: #666;
            margin-top: 10px;
        }

        /* Navigation Styles */
        nav {
            background-color: #005f8d; /* Darker blue */
            position: sticky;
            top: 0;
            z-index: 100;
            overflow-x: auto; /* Enable horizontal scrolling */
            white-space: nowrap; /* Keep links in a single line */
            padding: 8px 0;
        }

        nav ul {
            display: flex;
            justify-content: center; /* Center links on big screens */
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            margin: 0 15px; /* Spacing between links */
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 1em; /* Slightly smaller font size for nav */
            padding: 6px 12px;
            display: block;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #00b0ff;
            transform: scale(1.05);
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
            font-size: 1.6em; /* Reduced font size for section titles */
            color: #005f8d; /* Dark blue */
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

        /* Team Request Section */
        .team-request-section {
            margin-top: 40px;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .team-request-section h3 {
            font-size: 1.6em;
            color: #005f8d;
            margin-bottom: 20px;
            text-align: center;
        }

        .team-request-card {
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .team-request-card p {
            font-size: 1.1em;
            color: #333;
        }

        .team-request-card .actions {
            display: flex;
            gap: 10px;
        }

        .team-request-card .actions button {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .team-request-card .actions button.accept {
            background-color: #007bb5;
            color: white;
        }

        .team-request-card .actions button.reject {
            background-color: #f44336;
            color: white;
        }

        .team-request-card .actions button:hover {
            opacity: 0.9;
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
            padding: 15px;
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
            margin-bottom: 10px;
        }

        .result-card .result-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.1em;
            color: #666;
        }

        .result-card .result-details p {
            margin: 0;
        }

        .result-card .view-scorecard-button {
            background-color: #007bb5;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
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
            word-wrap: break-word; /* Ensure long team names wrap properly */
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
    <header>
        <h1>External Header Name</h1>
        <div class="league-info">
            <p>Year: 2025 | City: New York | Country: USA</p>
        </div>
    </header>

    <!-- Navigation Bar -->
    <nav>
        <ul>
            <li><a href="#teams">Teams</a></li>
            <li><a href="#stats">Stats</a></li>
            <li><a href="#schedule">Schedule</a></li>
            <li><a href="#points-table">Points Table</a></li>
            <li><a href="#result">Results</a></li>
            <li><a href="#team-request">Team Request</a></li>
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
            <div class="schedule-card">
                <div class="team-images">
                    <img src="https://via.placeholder.com/70" alt="Team 1">
                    <span>vs</span>
                    <img src="https://via.placeholder.com/70" alt="Team 3">
                </div>
                <h4>Team 1: The Mighty Warriors of the Cricket League vs Team 3: The Fearless Fighters of the Cricket League</h4>
                <div class="match-details">
                    <p>Date: March 25, 2025</p>
                    <p>Time: 3:00 PM</p>
                    <p>Venue: Stadium A</p>
                </div>
            </div>

            <div class="schedule-card">
                <div class="team-images">
                    <img src="https://via.placeholder.com/70" alt="Team 2">
                    <span>vs</span>
                    <img src="https://via.placeholder.com/70" alt="Team 4">
                </div>
                <h4>Glorious Champions Cricket League vs Unstoppable Titans Cricket League</h4>
                <div class="match-details">
                    <p>Date: March 26, 2025</p>
                    <p>Time: 7:00 PM</p>
                    <p>Venue: Stadium B</p>
                </div>
            </div>
        </div>

        <!-- Result Section -->
        <div id="result" class="section-title">Recent Match Results</div>
        <div class="result-section">
            <div class="result-card">
                <div class="team-images">
                    <img src="https://via.placeholder.com/70" alt="Team 1">
                    <span>vs</span>
                    <img src="https://via.placeholder.com/70" alt="Team 2">
                </div>
                <h4>Team 1: The Mighty Warriors of the Cricket League vs Team 2: The Glorious Champions of the Cricket League</h4>
                <div class="result-details">
                    <p>Score: Team 1 - 250/7 | Team 2 - 240/8</p>
                    <p>Result: Team 1 won by 10 runs</p>
                </div>
                <button class="view-scorecard-button">View Scorecard</button>
            </div>

            <div class="team-card">
                <div class="team-images">
                    <img src="https://via.placeholder.com/70" alt="Team 3">
                    <span>vs</span>
                    <img src="https://via.placeholder.com/70" alt="Team 4">
                </div>
                <h4>Team 3: The Fearless Fighters of the Cricket League vs Team 4: The Unstoppable Titans of the Cricket League</h4>
                <div class="result-details">
                    <p>Score: Team 3 - 180/5 | Team 4 - 120/9</p>
                    <p>Result: Team 3 won by 60 runs</p>
                </div>
                <button class="view-scorecard-button">View Scorecard</button>
            </div>
        </div>

        <!-- Team Request Section -->
        <div id="team-request" class="team-request-section">
            <h3>Team Requests</h3>
            <div class="team-request-card">
                <p>Team 5 has requested to join the league.</p>
                <div class="actions">
                    <button class="accept">Accept</button>
                    <button class="reject">Reject</button>
                </div>
            </div>
            <div class="team-request-card">
                <p>Team 6 has requested to join the league.</p>
                <div class="actions">
                    <button class="accept">Accept</button>
                    <button class="reject">Reject</button>
                </div>
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
            <div class="team-card">
                <img src="https://via.placeholder.com/100" alt="Team 1">
                <h4>Team 1: The Mighty Warriors of the Cricket League, Representing the Spirit of Sportsmanship and Excellence</h4>
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

            <!-- Team 2 -->
            <div class="team-card">
                <img src="https://via.placeholder.com/100" alt="Team 2">
                <h4>Team 2: The Glorious Champions of the Cricket League, Known for Their Unmatched Skills and Determination</h4>
                <div class="player-stats">
                    <div class="player-info">
                        <img src="https://via.placeholder.com/70" alt="Top Batsman">
                        <h5>Top Batsman</h5>
                        <p>Player E - 780 runs</p>
                    </div>
                    <div class="player-info">
                        <img src="https://via.placeholder.com/70" alt="Top Bowler">
                        <h5>Top Bowler</h5>
                        <p>Player F - 35 wickets</p>
                    </div>
                    <div class="player-info">
                        <img src="https://via.placeholder.com/70" alt="Highest Individual Score">
                        <h5>Highest Individual Score</h5>
                        <p>Player G - 160 runs</p>
                        <a href="#" class="scorecard-link">View Scorecard</a>
                    </div>
                    <div class="player-info">
                        <img src="https://via.placeholder.com/70" alt="Most Wicket-Taker">
                        <h5>Most Wicket-Taker in a Match</h5>
                        <p>Player H - 6 wickets</p>
                        <a href="#" class="scorecard-link">View Scorecard</a>
                    </div>
                </div>
            </div>

            <!-- Team 3 -->
            <div class="team-card">
                <img src="https://via.placeholder.com/100" alt="Team 3">
                <h4>Team 3: The Fearless Fighters of the Cricket League, Always Ready to Take on Any Challenge with Grit and Passion</h4>
                <div class="player-stats">
                    <div class="player-info">
                        <img src="https://via.placeholder.com/70" alt="Top Batsman">
                        <h5>Top Batsman</h5>
                        <p>Player I - 720 runs</p>
                    </div>
                    <div class="player-info">
                        <img src="https://via.placeholder.com/70" alt="Top Bowler">
                        <h5>Top Bowler</h5>
                        <p>Player J - 30 wickets</p>
                    </div>
                    <div class="player-info">
                        <img src="https://via.placeholder.com/70" alt="Highest Individual Score">
                        <h5>Highest Individual Score</h5>
                        <p>Player K - 150 runs</p>
                        <a href="#" class="scorecard-link">View Scorecard</a>
                    </div>
                    <div class="player-info">
                        <img src="https://via.placeholder.com/70" alt="Most Wicket-Taker">
                        <h5>Most Wicket-Taker in a Match</h5>
                        <p>Player L - 5 wickets</p>
                        <a href="#" class="scorecard-link">View Scorecard</a>
                    </div>
                </div>
            </div>

            <!-- Team 4 -->
            <div class="team-card">
                <img src="https://via.placeholder.com/100" alt="Team 4">
                <h4>Team 4: The Unstoppable Titans of the Cricket League, Known for Their Dominance and Unyielding Spirit</h4>
                <div class="player-stats">
                    <div class="player-info">
                        <img src="https://via.placeholder.com/70" alt="Top Batsman">
                        <h5>Top Batsman</h5>
                        <p>Player M - 600 runs</p>
                    </div>
                    <div class="player-info">
                        <img src="https://via.placeholder.com/70" alt="Top Bowler">
                        <h5>Top Bowler</h5>
                        <p>Player N - 25 wickets</p>
                    </div>
                    <div class="player-info">
                        <img src="https://via.placeholder.com/70" alt="Highest Individual Score">
                        <h5>Highest Individual Score</h5>
                        <p>Player O - 140 runs</p>
                        <a href="#" class="scorecard-link">View Scorecard</a>
                    </div>
                    <div class="player-info">
                        <img src="https://via.placeholder.com/70" alt="Most Wicket-Taker">
                        <h5>Most Wicket-Taker in a Match</h5>
                        <p>Player P - 4 wickets</p>
                        <a href="#" class="scorecard-link">View Scorecard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Cricket League</p>
    </footer>
</body>
</html>