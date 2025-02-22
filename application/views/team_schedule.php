<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Schedule</title>
    <style>
     


        .container {
            width: 90%;
            margin: 20px auto;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            background-color: #fff;
            width: 100%;
            max-width: 350px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            background: linear-gradient(135deg, #ffffff, #f4f4f4);
            margin-bottom: 20px;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            padding: 15px;
            background-color: #2c3e50;
            color: white;
            font-size: 18px;
            text-align: center;
            font-weight: bold;
        }

        .card-body {
            padding: 20px;
            text-align: center;
        }

        .match-info {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .team-logo-container {
            text-align: center;
        }

        .team-logo {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .team-name {
            font-size: 12px;
            color: #555;
            margin-top: 5px;
            font-weight: 600;
        }

        .card-footer {
            padding: 15px;
            background-color: #ecf0f1;
            text-align: center;
            font-size: 14px;
        }

        .actions a {
            text-decoration: none;
            color: #3498db;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 5px;
            background-color: #e0e4e7;
            transition: background-color 0.3s ease;
            margin: 0 5px;
        }

        .actions a:hover {
            background-color: #d0d5d9;
        }

        @media (max-width: 768px) {
            .container {
                width: 95%;
            }

            .card {
                width: 100%;
            }
        }

    </style>
</head>

<body>

   <h2> Team Name Schedule</h2>
    <div class="container">
        <!-- Card 1 -->
        <div class="card">
            <div class="card-header">
                Match - Team 1 vs Team 2
            </div>
            <div class="card-body">
                <div class="match-info">
                    <div class="team-logo-container">
                        <img src="team1-logo.png" alt="Team 1 Logo" class="team-logo">
                        <p class="team-name">Team 1</p>
                    </div>
                    <span>2025-02-20</span>
                    <div class="team-logo-container">
                        <img src="team2-logo.png" alt="Team 2 Logo" class="team-logo">
                        <p class="team-name">Team 2</p>
                    </div>
                </div>
                <p><strong>Time:</strong> 18:00</p>
                <p><strong>Venue:</strong> Stadium ABC</p>
            </div>
            <div class="card-footer actions">
                <a href="add-scorecard.html">Add Scorecard</a>
                <a href="view-scorecard.html">View Scorecard</a>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="card">
            <div class="card-header">
                Match - Team 3 vs Team 4
            </div>
            <div class="card-body">
                <div class="match-info">
                    <div class="team-logo-container">
                        <img src="team3-logo.png" alt="Team 3 Logo" class="team-logo">
                        <p class="team-name">Team 3</p>
                    </div>
                    <span>2025-02-21</span>
                    <div class="team-logo-container">
                        <img src="team4-logo.png" alt="Team 4 Logo" class="team-logo">
                        <p class="team-name">Team 4</p>
                    </div>
                </div>
                <p><strong>Time:</strong> 15:00</p>
                <p><strong>Venue:</strong> Stadium XYZ</p>
            </div>
            <div class="card-footer actions">
                <a href="add-scorecard.html">Add Scorecard</a>
                <a href="view-scorecard.html">View Scorecard</a>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="card">
            <div class="card-header">
                Match - Team 5 vs Team 6
            </div>
            <div class="card-body">
                <div class="match-info">
                    <div class="team-logo-container">
                        <img src="team5-logo.png" alt="Team 5 Logo" class="team-logo">
                        <p class="team-name">Team 5</p>
                    </div>
                    <span>2025-02-22</span>
                    <div class="team-logo-container">
                        <img src="team6-logo.png" alt="Team 6 Logo" class="team-logo">
                        <p class="team-name">Team 6</p>
                    </div>
                </div>
                <p><strong>Time:</strong> 20:00</p>
                <p><strong>Venue:</strong> Stadium PQR</p>
            </div>
            <div class="card-footer actions">
                <a href="add-scorecard.html">Add Scorecard</a>
                <a href="view-scorecard.html">View Scorecard</a>
            </div>
        </div>
        <!-- Add more match cards here -->
    </div>

</body>

</html>
