<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>International Cricket Match Summary</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
        }
        .container {
            max-width: 1000px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            color: #333;
        }
        .header {
            background: #00796b;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .teams {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #e0f2f1;
            font-size: 18px;
        }
        .teams img {
            height: 50px;
            margin: 0 10px;
        }
        .scoreboard {
            padding: 20px;
            background-color: #f1f1f1;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .team-score {
            flex: 1;
            min-width: 300px;
        }
        .team-score h2 {
            text-align: center;
            margin-bottom: 10px;
        }
        .team-score table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .team-score th, .team-score td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .team-score th {
            background-color: #00796b;
            color: white;
        }
        .highlight {
            padding: 20px;
            background-color: #bbdefb;
        }
        .highlight p {
            margin: 8px 0;
            font-size: 16px;
        }
        .player-of-match {
            padding: 20px;
            background: linear-gradient(135deg, #f39c12, #d35400);
            color: white;
            text-align: center;
            position: relative;
        }
        .player-of-match img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 5px solid white;
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
        }
        .player-of-match h2 {
            margin: 50px 0 10px;
            font-size: 22px;
        }
        .key-stats {
            display: flex;
            justify-content: space-around;
            padding: 20px;
            background-color: #f1f1f1;
            flex-wrap: wrap;
        }
        .key-stats div {
            text-align: center;
            font-size: 16px;
            min-width: 100px;
        }
        .footer {
            text-align: center;
            padding: 10px;
            background-color: #e0e0e0;
            font-size: 14px;
        }
        @media (max-width: 768px) {
            .teams {
                flex-direction: column;
                text-align: center;
            }
            .scoreboard {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>International Cricket Match Summary</h1>
        </div>
        <div class="teams">
            <img src="india_logo.png" alt="India Logo">
            <span>India</span>
            <span>vs</span>
            <span>Australia</span>
            <img src="australia_logo.png" alt="Australia Logo">
        </div>
        <div class="scoreboard">
            <div class="team-score">
                <h2>India</h2>
                <table>
                    <tr>
                        <th>Batsman</th>
                        <th>R</th>
                        <th>B</th>
                        <th>4s</th>
                        <th>6s</th>
                        <th>SR</th>
                    </tr>
                    <tr>
                        <td>Rohit Sharma</td>
                        <td>50</td>
                        <td>45</td>
                        <td>6</td>
                        <td>2</td>
                        <td>111.1</td>
                    </tr>
                    <tr>
                        <td>Virat Kohli</td>
                        <td>95</td>
                        <td>88</td>
                        <td>10</td>
                        <td>1</td>
                        <td>108.0</td>
                    </tr>
                </table>
                <h2>Bowling</h2>
                <table>
                    <tr>
                        <th>Bowler</th>
                        <th>O</th>
                        <th>M</th>
                        <th>R</th>
                        <th>W</th>
                        <th>EC</th>
                    </tr>
                    <tr>
                        <td>Jasprit Bumrah</td>
                        <td>10</td>
                        <td>2</td>
                        <td>35</td>
                        <td>3</td>
                        <td>3.5</td>
                    </tr>
                    <tr>
                        <td>Ravindra Jadeja</td>
                        <td>10</td>
                        <td>1</td>
                        <td>40</td>
                        <td>2</td>
                        <td>4.0</td>
                    </tr>
                </table>
            </div>
            <div class="team-score">
                <h2>Australia</h2>
                <table>
                    <tr>
                        <th>Batsman</th>
                        <th>R</th>
                        <th>B</th>
                        <th>4s</th>
                        <th>6s</th>
                        <th>SR</th>
                    </tr>
                    <tr>
                        <td>David Warner</td>
                        <td>60</td>
                        <td>50</td>
                        <td>7</td>
                        <td>3</td>
                        <td>120.0</td>
                    </tr>
                    <tr>
                        <td>Steve Smith</td>
                        <td>70</td>
                        <td>85</td>
                        <td>8</td>
                        <td>2</td>
                        <td>82.4</td>
                    </tr>
                </table>
                <h2>Bowling</h2>
                <table>
                    <tr>
                        <th>Bowler</th>
                        <th>O</th>
                        <th>M</th>
                        <th>R</th>
                        <th>W</th>
                        <th>EC</th>
                    </tr>
                    <tr>
                        <td>Pat Cummins</td>
                        <td>10</td>
                        <td>2</td>
                        <td>40</td>
                        <td>2</td>
                        <td>4.0</td>
                    </tr>
                    <tr>
                        <td>Mitchell Starc</td>
                        <td>10</td>
                        <td>1</td>
                        <td>50</td>
                        <td>3</td>
                        <td>5.0</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="highlight">
            <p><strong>Result:</strong> India won by 2 runs</p>
            <p><strong>Top scorer:</strong> Virat Kohli (95 runs)</p>
            <p><strong>Best bowler:</strong> Jasprit Bumrah (3/35)</p>
        </div>
        <div class="player-of-match">
            <img src="virat_kohli.png" alt="Player of the Match">
            <h2>Player of the Match</h2>
            <p>Virat Kohli</p>
        </div>
        <div class="key
