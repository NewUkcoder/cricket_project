<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['playerName']; ?> | Cricket Player Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #1e3a8a;
            --secondary-color: #dc2626;
            --accent-color: #f59e0b;
            --light-bg: #f8fafc;
            --dark-text: #1e293b;
            --light-text: #64748b;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            padding-bottom: 80px; /* Adjusted for fixed footer height */
        }

        /* Header Styles */
        .profile-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0f172a 100%);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
        }

        .player-img-container {
            position: relative;
            width: 200px;
            height: 200px;
            margin: 0 auto;
            border-radius: 50%;
            border: 5px solid white;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .player-img-container:hover {
            transform: scale(1.05);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
        }

        .player-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .player-name {
            font-size: 2.2rem;
            font-weight: 700;
            margin-top: 15px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .player-title {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 10px;
        }

        .player-basic-info {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-top: 15px;
        }

        .info-badge {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Content Cards */
        .stats-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Scrollable Container */
        .scrollable-section {
            max-height: 300px;
            overflow-y: auto;
            background-color: #f8fafc;
            border-radius: 8px;
            padding: 10px;
        }

        .scrollable-section::-webkit-scrollbar {
            width: 8px;
        }

        .scrollable-section::-webkit-scrollbar-track {
            background: #e2e8f0;
            border-radius: 4px;
        }

        .scrollable-section::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 4px;
        }

        .scrollable-section::-webkit-scrollbar-thumb:hover {
            background: #0f172a;
        }

        /* Team Display */
        .team-card {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }

        .team-card:hover {
            transform: translateX(3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .team-logo {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 12px;
            border: 2px solid #e2e8f0;
        }

        .team-info {
            flex-grow: 1;
        }

        .team-name {
            font-weight: 600;
            margin-bottom: 2px;
            font-size: 0.95rem;
        }

        .team-name a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .team-name a:hover {
            text-decoration: underline;
        }

        .team-league {
            font-size: 0.75rem;
            color: var(--light-text);
        }

        /* Stats Tables */
        .stats-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .stats-table th {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 15px;
            text-align: center;
            font-weight: 500;
        }

        .stats-table td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #e2e8f0;
        }

        .stats-table tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .stats-table tr:hover {
            background-color: #f1f5f9;
        }

        .highlight-stat {
            font-weight: 600;
            color: var(--secondary-color);
        }

        /* Performance Cards */
        .performance-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .performance-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 15px;
            transition: all 0.3s ease;
        }

        .performance-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
        }

        .match-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
        }

        .match-teams {
            font-weight: 600;
        }

        .match-type {
            font-size: 0.8rem;
            background-color: #e2e8f0;
            padding: 3px 8px;
            border-radius: 10px;
        }

        .match-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .stat-item {
            font-size: 0.9rem;
        }

        .stat-label {
            color: var(--light-text);
            font-size: 0.8rem;
        }

        .match-result {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #e2e8f0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .won {
            color: #16a34a;
        }

        .lost {
            color: #dc2626;
        }

        /* League Card Styles */
        .league-card {
            padding: 10px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 8px;
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary-color);
        }

        .league-card:hover {
            transform: translateX(3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .league-info {
            flex-grow: 1;
        }

        .league-name {
            font-weight: 600;
            margin-bottom: 2px;
            font-size: 0.9rem;
        }

        .league-name a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .league-name a:hover {
            text-decoration: underline;
        }

        .league-details {
            font-size: 0.7rem;
            color: var(--light-text);
        }

        /* Navigation */
        .profile-nav {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 10px;
            margin-bottom: 20px;
        }

        .nav-item {
            margin: 0 5px;
        }

        .nav-link {
            color: var(--dark-text);
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
            min-height: 44px; /* Touch-friendly */
        }

        .nav-link:hover, .nav-link.active {
            background-color: var(--primary-color);
            color: white;
        }

        .nav-link.join-team {
            background-color: var(--secondary-color);
            color: white;
        }

        .nav-link.join-team:hover {
            background-color: #b91c1c;
        }

        /* Fixed Footer */
        .fixed-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: white;
            box-shadow: 0 -4px 6px -1px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            padding: 10px 0;
        }

        .fixed-footer .nav-link {
            font-size: 0.85rem;
            padding: 6px 12px;
            min-height: 44px; /* Touch-friendly */
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .player-name {
                font-size: 1.8rem;
            }

            .player-img-container {
                width: 150px;
                height: 150px;
            }

            .performance-container {
                grid-template-columns: 1fr;
            }

            .stats-table {
                font-size: 0.8rem;
            }

            .stats-table th, .stats-table td {
                padding: 8px 10px;
            }

            .scrollable-section {
                max-height: 200px;
            }

            .team-card, .league-card {
                padding: 8px;
                margin-bottom: 6px;
            }

            .team-logo {
                width: 36px;
                height: 36px;
                margin-right: 10px;
            }

            .team-name {
                font-size: 0.9rem;
            }

            .team-league {
                font-size: 0.7rem;
            }

            .league-name {
                font-size: 0.85rem;
            }

            .league-details {
                font-size: 0.65rem;
            }

            .profile-nav .nav {
                flex-direction: column;
                align-items: center;
            }

            .nav-item {
                margin: 5px 0;
                width: 100%;
            }

            .nav-link {
                width: 100%;
                text-align: center;
            }

            .fixed-footer .nav {
                flex-direction: column;
                align-items: center;
            }

            .fixed-footer .nav-item {
                margin: 5px 0;
                width: 100%;
            }

            .fixed-footer .nav-link {
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 576px) {
            .player-basic-info {
                flex-direction: column;
                align-items: center;
            }

            .info-badge {
                width: 100%;
                justify-content: center;
            }
        }

        /* Utility Classes */
        .text-accent {
            color: var(--accent-color);
        }

        .bg-highlight {
            background-color: #fef3c7;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <!-- Player Header Section -->
        <div class="profile-header text-center">
            <div class="player-img-container">
                <img src="<?php echo $data['image_path']; ?>" alt="<?php echo $data['playerName']; ?>" class="player-img">
            </div>
            <h1 class="player-name"><?php echo $data['playerName']; ?></h1>
            <p class="player-title"><?php echo $data['player_role']; ?> | <?php echo $data['city']; ?></p>
            
            <div class="player-basic-info">
                <div class="info-badge">
                    <i class="fas fa-birthday-cake"></i>
                    <?php 
                        $dob = new DateTime($data['date_of_birth']);
                        $today = new DateTime();
                        echo $dob->format('M j, Y') . " (" . $today->diff($dob)->y . " yrs)";
                    ?>
                </div>
                <div class="info-badge">
                    <i class="fas fa-calendar-alt"></i>
                    Member since <?php echo date("M Y", strtotime($data['created_on'])); ?>
                </div>
                <div class="info-badge">
                    <i class="fas fa-baseball-ball"></i>
                    <?php echo $data['batting_style']; ?> Batting
                </div>
                <div class="info-badge">
                    <i class="fas fa-baseball-ball"></i>
                    <?php echo $data['bowling_style']; ?> Bowling
                </div>
            </div>
        </div>
        
        <!-- Navigation -->
        <div class="profile-nav">
            <ul class="nav justify-content-center">
                <?php if($this->session->userdata('user_id') == $data['user_id']): ?>
                    <li class="nav-item">
                        <a class="nav-link join-team" href="<?php echo base_url(); ?>PlayerController/join_team/<?php echo $data['player_id']; ?>">
                            <i class="fas fa-plus-circle"></i> Join Team
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>PlayerController/sent_team_request/<?php echo $data['player_id']; ?>">
                            <i class="fas fa-paper-plane"></i> Sent Requests
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link active" href="#stats">
                        <i class="fas fa-chart-line"></i> Statistics
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#leagues">
                        <i class="fas fa-trophy"></i> Leagues
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-4">
                <!-- Teams Section -->
                <div class="stats-card" id="teams">
                    <h3 class="card-title">
                        <i class="fas fa-users text-accent"></i> Current Teams
                    </h3>
                    
                    <div class="scrollable-section">
                        <?php if (!empty($team_names)): ?>
                            <?php foreach ($team_names as $team): ?>
                                <div class="team-card">
                                    <img src="https://via.placeholder.com/100?text=<?php echo substr($team->team_name, 0, 2); ?>" alt="<?php echo $team->team_name; ?>" class="team-logo">
                                    <div class="team-info">
                                        <div class="team-name">
                                            <a href="<?php echo base_url(); ?>TeamController/view_team/<?php echo $team->team_id; ?>">
                                                <?php echo $team->team_name; ?>
                                            </a>
                                        </div>
                                        <div class="team-league"><?php echo $team->league_name ?? 'Local League'; ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-3">
                                <i class="fas fa-users-slash fa-2x text-muted mb-2"></i>
                                <p class="text-muted">No active teams found</p>
                                <?php if($this->session->userdata('user_id') == $data['user_id']): ?>
                                    <a href="<?php echo base_url(); ?>PlayerController/join_team/<?php echo $data['player_id']; ?>" class="btn btn-sm btn-primary">
                                        Join a Team
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Leagues Section -->
                <div class="stats-card" id="leagues">
                    <h3 class="card-title">
                        <i class="fas fa-trophy text-accent"></i> Current Leagues
                    </h3>
                    
                    <div class="scrollable-section">
                        <?php if (!empty($leagues)): ?>
                            <?php foreach ($leagues as $league): ?>
                                <div class="league-card">
                                    <div class="league-info">
                                        <div class="league-name">
                                            <a href="<?php echo base_url('Welcome/tournament_landing/' . ($league['league_id'])); ?>">
                                                <?php echo $league['league_name']; ?>
                                            </a>
                                        </div>
                                        <div class="league-details">
                                            <span>
                                                <i class="fas fa-map-marker-alt"></i> <?php echo $league['city']; ?> | 
                                                <i class="far fa-calendar-alt"></i> Created <?php echo date('M Y', strtotime($league['created_at'])); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-3">
                                <i class="fas fa-trophy fa-2x text-muted mb-2"></i>
                                <p class="text-muted">No league participation found</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Quick Stats -->
                <div class="stats-card">
                    <h3 class="card-title">
                        <i class="fas fa-tachometer-alt text-accent"></i> Career Highlights
                    </h3>
                    
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <div class="p-3 bg-highlight rounded">
                                <div class="h4 text-accent"><?php echo $player_stats['leather_ball']['highest_score']; ?></div>
                                <div class="small text-muted">Highest Score</div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="p-3 bg-highlight rounded">
                                <div class="h4 text-accent"><?php echo $player_stats['leather_ball']['centuries'] + $player_stats['tape_ball']['centuries'] + $player_stats['tennis_ball']['centuries']; ?></div>
                                <div class="small text-muted">Centuries</div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="p-3 bg-highlight rounded">
                                <div class="h4 text-accent"><?php echo $bowling_stats['Leather Ball']['total_wickets'] + $bowling_stats['Tape Ball']['total_wickets'] + $bowling_stats['Tennis Ball']['total_wickets']; ?></div>
                                <div class="small text-muted">Total Wickets</div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="p-3 bg-highlight rounded">
                                <div class="h4 text-accent"><?php echo $bowling_stats['Leather Ball']['best_bowling'] ?? 'N/A'; ?></div>
                                <div class="small text-muted">Best Bowling</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Player Bio -->
                <div class="stats-card">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle text-accent"></i> Player Bio
                    </h3>
                    <p><?php echo $data['additional_info'] ?: 'No additional information provided.'; ?></p>
                </div>
                
                <!-- Awards Section -->
                <div class="stats-card" id="awards">
                    <h3 class="card-title">
                        <i class="fas fa-medal text-accent"></i> Awards & Achievements
                    </h3>
                    
                    <div class="awards-list">
                        <div class="award-item mb-3 p-3 border-bottom">
                            <h5 class="mb-1">Player of the Tournament</h5>
                            <div class="text-muted small mb-1">City Premier League 2023 - June 2023</div>
                            <p class="mb-0">Awarded for scoring 450 runs and taking 15 wickets</p>
                        </div>
                        <div class="award-item mb-3 p-3 border-bottom">
                            <h5 class="mb-1">Best Batsman</h5>
                            <div class="text-muted small mb-1">Community Cricket Cup - September 2022</div>
                            <p class="mb-0">Highest run scorer with 320 runs in 5 matches</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column -->
            <div class="col-lg-8">
                <!-- Batting Statistics -->
                <div class="stats-card" id="stats">
                    <h3 class="card-title">
                        <i class="fas fa-bat text-accent"></i> Batting Statistics
                    </h3>
                    
                    <div class="table-responsive">
                        <table class="stats-table">
                            <thead>
                                <tr>
                                    <th>Format</th>
                                    <th>Matches</th>
                                    <th>Runs</th>
                                    <th>HS</th>
                                    <th>Avg</th>
                                    <th>SR</th>
                                    <th>100s</th>
                                    <th>50s</th>
                                    <th>4s</th>
                                    <th>6s</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $formats = ['leather_ball', 'tape_ball', 'tennis_ball'];
                                foreach ($formats as $format):
                                    $matches = $player_stats[$format]['total_matches'];
                                    $runs = $player_stats[$format]['total_runs'];
                                    $balls = $player_stats[$format]['total_balls'] ?? 0;
                                    $outs = $player_stats[$format]['total_outs'] ?? $matches;
                                    
                                    $average = $outs > 0 ? round($runs / $outs, 2) : '-';
                                    $strike_rate = $balls > 0 ? round(($runs / $balls) * 100, 2) : '-';
                                ?>
                                <tr>
                                    <td><strong><?php echo ucwords(str_replace('_', ' ', $format)); ?></strong></td>
                                    <td><?php echo $matches; ?></td>
                                    <td class="highlight-stat"><?php echo $runs; ?></td>
                                    <td class="highlight-stat"><?php echo $player_stats[$format]['highest_score']; ?></td>
                                    <td><?php echo $average; ?></td>
                                    <td><?php echo $strike_rate; ?></td>
                                    <td class="highlight-stat"><?php echo $player_stats[$format]['centuries']; ?></td>
                                    <td><?php echo $player_stats[$format]['fifties']; ?></td>
                                    <td><?php echo $player_stats[$format]['fours']; ?></td>
                                    <td><?php echo $player_stats[$format]['sixes']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Bowling Statistics -->
                <div class="stats-card">
                    <h3 class="card-title">
                        <i class="fas fa-baseball-ball text-accent"></i> Bowling Statistics
                    </h3>
                    
                    <div class="table-responsive">
                        <table class="stats-table">
                            <thead>
                                <tr>
                                    <th>Format</th>
                                    <th>Matches</th>
                                    <th>Wickets</th>
                                    <th>Best</th>
                                    <th>Avg</th>
                                    <th>Econ</th>
                                    <th>SR</th>
                                    <th>4W</th>
                                    <th>5W</th>
                                    <th>Maidens</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (['Leather Ball', 'Tape Ball', 'Tennis Ball'] as $match_type): ?>
                                    <?php if (isset($bowling_stats[$match_type])): ?>
                                        <?php 
                                        $stats = $bowling_stats[$match_type];
                                        $wickets = $stats['total_wickets'];
                                        $runs_given = $stats['total_runs'];
                                        $balls_bowled = $stats['total_balls'] ?? 0;
                                        $matches = $stats['total_matches'];
                                        
                                        $bowling_avg = $wickets > 0 ? round($runs_given / $wickets, 2) : '-';
                                        $economy = $balls_bowled > 0 ? round(($runs_given / $balls_bowled) * 6, 2) : '-';
                                        $bowling_sr = $wickets > 0 ? round($balls_bowled / $wickets, 2) : '-';
                                        ?>
                                        <tr>
                                            <td><strong><?php echo $match_type; ?></strong></td>
                                            <td><?php echo $matches; ?></td>
                                            <td class="highlight-stat"><?php echo $wickets; ?></td>
                                            <td class="highlight-stat"><?php echo $stats['best_bowling']; ?></td>
                                            <td><?php echo $bowling_avg; ?></td>
                                            <td><?php echo $economy; ?></td>
                                            <td><?php echo $bowling_sr; ?></td>
                                            <td><?php echo $stats['four_wickets'] ?? '0'; ?></td>
                                            <td><?php echo $stats['five_wickets'] ?? '0'; ?></td>
                                            <td><?php echo $stats['maidens'] ?? '0'; ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Recent Performance -->
                <div class="stats-card" id="performance">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar text-accent"></i> Recent Performances
                    </h3>
                    
                    <div class="performance-container">
                        <div class="performance-card">
                            <div class="match-header">
                                <div class="match-teams">RCB vs MI</div>
                                <div class="match-type">Leather Ball</div>
                            </div>
                            <div class="match-stats">
                                <div class="stat-item">
                                    <div class="stat-label">Runs</div>
                                    <div class="stat-value">78 (65)</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-label">SR</div>
                                    <div class="stat-value">120.00</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-label">4s/6s</div>
                                    <div class="stat-value">8/2</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-label">Wickets</div>
                                    <div class="stat-value">2/35</div>
                                </div>
                            </div>
                            <div class="match-result won">
                                <i class="fas fa-trophy"></i> Won by 24 runs
                            </div>
                        </div>
                        
                        <div class="performance-card">
                            <div class="match-header">
                                <div class="match-teams">CSK vs KKR</div>
                                <div class="match-type">Tape Ball</div>
                            </div>
                            <div class="match-stats">
                                <div class="stat-item">
                                    <div class="stat-label">Runs</div>
                                    <div class="stat-value">45 (40)</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-label">SR</div>
                                    <div class="stat-value">112.50</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-label">4s/6s</div>
                                    <div class="stat-value">5/1</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-label">Wickets</div>
                                    <div class="stat-value">1/28</div>
                                </div>
                            </div>
                            <div class="match-result lost">
                                <i class="fas fa-times-circle"></i> Lost by 5 wickets
                            </div>
                        </div>
                        
                        <div class="performance-card">
                            <div class="match-header">
                                <div class="match-teams">DC vs SRH</div>
                                <div class="match-type">Tennis Ball</div>
                            </div>
                            <div class="match-stats">
                                <div class="stat-item">
                                    <div class="stat-label">Runs</div>
                                    <div class="stat-value">112 (82)</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-label">SR</div>
                                    <div class="stat-value">136.58</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-label">4s/6s</div>
                                    <div class="stat-value">12/4</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-label">Wickets</div>
                                    <div class="stat-value">3/42</div>
                                </div>
                            </div>
                            <div class="match-result won">
                                <i class="fas fa-trophy"></i> Won by 38 runs
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Career Graph -->
                <div class="stats-card">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line text-accent"></i> Career Progress
                    </h3>
                    
                    <div class="text-center py-4 bg-light rounded">
                        <img src="https://via.placeholder.com/800x300?text=Career+Progress+Graph" alt="Career Progress Graph" class="img-fluid">
                        <p class="mt-2 text-muted">Batting averages and wickets taken by season</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Fixed Footer -->
    <nav class="fixed-footer navbar navbar-light">
        <div class="container-fluid">
            <ul class="nav justify-content-center w-100">
                <li> <a href="<?php echo base_url(); ?>Welcome/landing_page">
                <i class="fas fa-paper-plane"></i>
                <span>Home</span>
            </a>
        </li>
                <?php if($this->session->userdata('user_id') == $data['user_id']): ?>
                    <li class="nav-item">
                        <a class="nav-link join-team" href="<?php echo base_url(); ?>PlayerController/join_team/<?php echo $data['player_id']; ?>">
                            <i class="fas fa-plus-circle"></i> Join Team
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>PlayerController/sent_team_request/<?php echo $data['player_id']; ?>">
                            <i class="fas fa-paper-plane"></i> Sent Requests
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="#stats">
                        <i class="fas fa-chart-line"></i> Statistics
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#leagues">
                        <i class="fas fa-trophy"></i> Leagues
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>