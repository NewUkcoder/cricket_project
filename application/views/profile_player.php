<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Cricket Player Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* General Styles */
        body {
            padding-bottom: 80px; /* Space for fixed footer on small screens */
        }
        .navbar-custom {
            background-color: #00796b; /* Dark teal */
            border-radius: 10px;
            padding: 10px;
            margin-top: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .navbar-custom .nav-link {
            color: #fff;
            font-weight: bold;
            margin: 0 15px;
            transition: all 0.3s ease;
        }
        .navbar-custom .nav-link:hover {
            color: #ffeb3b; /* Yellow on hover */
            transform: scale(1.1);
        }
        .navbar-custom .nav-link.join-team {
            background-color: #ff5722; /* Orange */
            padding: 8px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .navbar-custom .nav-link.join-team:hover {
            background-color: #e64a19; /* Darker orange on hover */
            transform: scale(1.1);
        }
        .player-profile {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }
        .player-img {
    border-radius: 10px;
    width: 300px; /* Set a fixed width for all player images */
    height: 300px; /* Set a fixed height to make them square */
    object-fit: cover; /* Ensures the image covers the entire box without distortion */
    transition: transform 0.3s ease; /* Smooth transition for resizing */
}

.player-img:hover {
    transform: scale(1.1); /* Slightly increase the image size when hovered */
}


        .player-name {
            font-size: 2rem;
            font-weight: bold;
            color: #00796b; /* Dark teal */
        }
        .player-details {
            font-size: 1rem;
            color: #666;
        }
        .player-bio {
            font-size: 1rem;
            color: #444;
            margin-top: 15px;
            line-height: 1.6;
        }
        .player-info-box {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }
        .player-info-box h3 {
            font-size: 1.2rem;
            font-weight: bold;
            color: #00796b; /* Dark teal */
            margin-bottom: 15px;
        }
        .player-info-box p {
            font-size: 1rem;
            color: #666;
            margin: 5px 0;
        }
        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #00796b; /* Dark teal */
            margin-top: 20px;
            margin-bottom: 15px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .table-custom {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            width: 100%;
        }
        .table-custom th {
            background-color: #00796b; /* Dark teal */
            color: #fff;
            font-weight: bold;
            padding: 12px;
            text-align: center;
        }
        .table-custom td {
            padding: 12px;
            text-align: center;
        }
        .table-custom tbody tr:nth-child(odd) {
            background-color: #f8f9fa;
        }
        .table-custom tbody tr:hover {
            background-color: #e0f7fa; /* Light blue */
        }
        .match-performance {
            display: flex;
            overflow-x: auto;
            gap: 20px;
            padding-bottom: 20px;
            margin-top: 20px;
        }
        .match-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            min-width: 250px;
            transition: all 0.3s ease;
        }
        .match-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .match-card h3 {
            font-size: 1.2rem;
            color: #00796b; /* Dark teal */
            margin-bottom: 10px;
        }
        .match-card img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-bottom: 10px;
        }
        .match-card p {
            font-size: 1rem;
            color: #666;
            margin: 5px 0;
        }
        .match-card .result {
            font-weight: bold;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
        }
        .match-card .result.won {
            background-color: #4caf50; /* Green */
        }
        .match-card .result.lost {
            background-color: #f44336; /* Red */
        }
        .footer-nav {
            background-color: #00796b; /* Dark teal */
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }
        .footer-nav .nav-link {
            color: #fff;
            font-weight: bold;
            margin: 0 10px;
            transition: all 0.3s ease;
        }
        .footer-nav .nav-link:hover {
            color: #ffeb3b; /* Yellow on hover */
            transform: scale(1.1);
        }
        .footer-nav .nav-link.join-team {
            background-color: #ff5722; /* Orange */
            padding: 8px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .footer-nav .nav-link.join-team:hover {
            background-color: #e64a19; /* Darker orange on hover */
            transform: scale(1.1);
        }
        @media (max-width: 768px) {
            .player-name {
                font-size: 1.5rem;
            }
            .section-title {
                font-size: 1.2rem;
            }
            .table-custom th, .table-custom td {
                padding: 8px;
                font-size: 0.9rem;
            }
            .match-card {
                min-width: 200px;
            }
        }
    </style>
</head>
<body>

<!-- Navigation Bar (Visible on Large Screens) -->
<nav class="navbar navbar-expand-lg navbar-custom d-none d-lg-block">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link join-team" href="<?php echo base_url();?>PlayerController/join_team/<?php foreach($data as $player){ echo $player->player_id;}?>">Join Team</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>PlayerController/sent_team_request/<?php foreach($data as $player){ echo $player->player_id;}?>">Sent Request</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="player-profile text-center">
                <?php foreach($data as $player) { 
                    $dob = new DateTime($player->date_of_birth);
                    $today = new DateTime();
                    $age = $today->diff($dob)->y;
                    $joining_date=$player->created_on;
                ?>
                <img src="<?php echo $player->image_path;?>" alt="Player Image" class="player-img">
                <h1 class="player-name"><?php echo $player->playerName;?></h1>
                <p class="player-details">Local Cricket Club | <?php echo $player->city;?></p>
                <p class="player-details">Born: <?php echo $dob->format('F j, Y');?></p>
                <p class="player-details">Age: <?php echo $age;?></p>
                <p class="player-details">Role: <?php echo $player->player_role;?></p>
                <p class="player-details">Batting Style: <?php echo $player->batting_style;?></p>
                <p class="player-details">Bowling Style: <?php echo $player->bowling_style;?></p>
                <div class="player-bio">
                    <p><?php echo $player->additional_info; ?></p>
                </div>
            <?php } ?>
            </div>
        </div>
        <div class="col-md-8">
            <!-- Player Information Box (Teams and Joining Date) -->
            <div class="player-info-box">
                <h3>Player Information</h3>
                <p><strong>Teams:</strong> <?php if (!empty($team_names)): ?>
       
            <?php foreach ($team_names as $team): ?>
                <?php echo $team->team_name; echo " /"; ?>
            <?php endforeach; ?>
        
    <?php else: ?>
        <p>No active teams found.</p>
    <?php endif; ?></p>
                <p><strong>Joining Date:</strong> <?php echo date("l, F j, Y", strtotime($joining_date));?></p>
            </div>

            <div class="player-profile">
                <h2 class="section-title">Career Statistics</h2>

                <!-- Batting Statistics -->
                <h3 class="section-title">Batting Statistics</h3>
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>Match Type</th>
                                <th>Matches</th>
                                <th>Runs</th>
                                <th>Average</th>
                                <th>Centuries</th>
                                <th>Fifties</th>
                                <th>Highest Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Leather</td>
                                <td> <?php echo $player_stats['leather_ball']['total_matches']; ?></td>
                                <td><?php echo $player_stats['leather_ball']['total_runs']; ?></td>
                                <td><?php echo $player_stats['leather_ball']['average_runs']; ?></td>
                                <td><?php echo $player_stats['leather_ball']['centuries']; ?></td>
                                <td><?php echo $player_stats['leather_ball']['fifties']; ?></td>
                                <td><?php echo $player_stats['leather_ball']['highest_score']; ?></td>
                            </tr>
                            <tr>
                                <td>Tape Ball</td>
                                <td><?php echo $player_stats['tape_ball']['total_matches']; ?></td>
                                <td><?php echo $player_stats['tape_ball']['total_runs']; ?></td>
                                <td><?php echo $player_stats['tape_ball']['average_runs']; ?></td>
                                <td><?php echo $player_stats['tape_ball']['centuries']; ?></td>
                                <td><?php echo $player_stats['tape_ball']['fifties']; ?></td>
                                <td><?php echo $player_stats['tape_ball']['highest_score']; ?></td>
                            </tr>
                            <tr>
                                <td>Tennis Ball</td>
                                <td><?php echo $player_stats['tennis_ball']['total_matches']; ?></td>
                                <td><?php echo $player_stats['tennis_ball']['total_runs']; ?></td>
                                <td><?php echo $player_stats['tennis_ball']['average_runs']; ?></td>
                                <td><?php echo $player_stats['tennis_ball']['centuries']; ?></td>
                                <td><?php echo $player_stats['tennis_ball']['fifties']; ?></td>
                                <td><?php echo $player_stats['tennis_ball']['highest_score']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

              
                <!-- Bowling Statistics -->
                <h3 class="section-title">Bowling Statistics</h3>
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>Match Type</th>
                                <th>Matches</th>
                                <th>Wickets</th>
                                <th>Given Runs</th>
                                <th>Economy</th>
                                <th>Best Figures</th>
                            </tr>
                        </thead>
                        <tbody>
                              <?php
            // Display stats for each match type
            $match_types = ['Leather Ball', 'Tennis Ball', 'Tape Ball', 'Others'];

            foreach ($match_types as $match_type) {
                // Check if stats for this match type exist
               
        ?>
                            <tr>
                            <?php     if (isset($bowling_stats[$match_type])) {
                    $stats = $bowling_stats[$match_type];
                  
            }?>
                                <td><?php echo ucfirst($match_type) ?></td>
                                 <td> <?php echo $stats['total_matches'] ?></td>
                <td><?php echo $stats['total_wickets']; ?></td>
                <td><?php echo $stats['total_runs']; ?></td>
                <td><?php echo $stats['economy_rate']; ?></td>
                            <td><?php echo $stats['best_bowling']; ?></td>
                            </tr>
                        <?php } ?>
               
                        </tbody>
                    </table>
                </div>

                <!-- Last 10 Matches Performance -->
                <h2 class="section-title">Last 10 Matches Performance</h2>
                <div class="match-performance">
                    <div class="match-card">
                        <img src="team-a-logo.jpg" alt="Team A Logo">
                        <h3>Leather vs Team A</h3>
                        <p>Runs: 78</p>
                        <p>Balls: 65</p>
                        <p>4s: 8</p>
                        <p>6s: 2</p>
                        <p>Strike Rate: 120.00</p>
                        <p class="result won">Won</p>
                    </div>
                    <div class="match-card">
                        <img src="team-b-logo.jpg" alt="Team B Logo">
                        <h3>Tape Ball vs Team B</h3>
                        <p>Runs: 45</p>
                        <p>Balls: 40</p>
                        <p>4s: 5</p>
                        <p>6s: 1</p>
                        <p>Strike Rate: 112.50</p>
                        <p class="result lost">Lost</p>
                    </div>
                    <!-- Add more match cards as needed -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer Navigation (Visible on Small Screens) -->
<footer class="footer-nav d-block d-lg-none">
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link join-team" href="#join-team">Join Team</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#best-performance">Best Performance</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#contact">Contact</a>
        </li>
    </ul>
</footer>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>