<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo html_escape($data['playerName']); ?> | Cricket Player Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #ff3c38;
            --secondary-color: #0077ff;
            --accent-color: #ffd700;
            --dark-bg: #0f0f0f;
            --light-bg: #f4f9ff;
            --text-dark: #1c1c1c;
            --text-light: #ffffff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
            margin: 0;
            padding-bottom: 70px;
        }

        .profile-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 0 0 20px 20px;
            padding: 30px 20px;
            color: var(--text-light);
            text-align: center;
            position: relative;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .player-img-container {
            width: 130px;
            height: 130px;
            margin: 0 auto 15px;
            border-radius: 50%;
            border: 4px solid var(--accent-color);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .player-img-container:hover {
            transform: scale(1.1);
        }

        .player-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .player-name {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .player-title {
            font-size: 1rem;
            opacity: 0.9;
            margin-top: 5px;
        }

        .player-basic-info {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-top: 15px;
        }

        .info-badge {
            background: rgba(255, 255, 255, 0.15);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            color: var(--text-light);
            backdrop-filter: blur(5px);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .stats-card {
            background: white;
            border-left: 6px solid var(--primary-color);
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 119, 255, 0.1);
            padding: 20px;
            margin-bottom: 15px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .stats-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 20px rgba(0, 119, 255, 0.2);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .scrollable-section {
            max-height: 200px;
            overflow-y: auto;
            padding: 8px;
            border-radius: 8px;
            background: #f9fbfd;
        }

        .scrollable-section::-webkit-scrollbar {
            width: 6px;
        }

        .scrollable-section::-webkit-scrollbar-thumb {
            background: var(--secondary-color);
            border-radius: 3px;
        }

        .team-card {
            display: flex;
            align-items: center;
            background: white;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 10px;
            transition: transform 0.3s ease;
        }

        .team-card:hover {
            transform: translateX(6px);
        }

        .team-logo {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 12px;
        }

        .team-name {
            font-size: 0.95rem;
            font-weight: 600;
        }

        .team-name a {
            color: var(--secondary-color);
            text-decoration: none;
        }

        .team-name a:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }

        .team-league {
            font-size: 0.75rem;
            color: #6c757d;
        }

        .stats-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        .stats-table th, .stats-table td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #e3e6ea;
        }

        .stats-table th {
            background: var(--primary-color);
            color: var(--text-light);
        }

        .stats-table tr:nth-child(even) {
            background: #f0f4fa;
        }

        .stats-table tr:hover {
            background: #e6efff;
        }

        .highlight-stat {
            color: var(--secondary-color);
            font-weight: 600;
        }

        .performance-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .performance-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .performance-card:hover {
            transform: scale(1.02);
        }

        .match-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.95rem;
            margin-bottom: 10px;
        }

        .match-type {
            font-size: 0.75rem;
            background: var(--accent-color);
            padding: 4px 10px;
            border-radius: 10px;
            color: var(--text-dark);
        }

        .match-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            font-size: 0.85rem;
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.75rem;
        }

        .match-result {
            margin-top: 10px;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .won {
            color: #28a745;
        }

        .lost {
            color: #dc3545;
        }

        .profile-nav {
            background: white;
            border-radius: 12px;
            padding: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-link {
            color: var(--text-dark);
            font-weight: 500;
            padding: 10px 15px;
            border-radius: 10px;
            transition: background 0.3s, color 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link:hover, .nav-link.active {
            background: var(--primary-color);
            color: var(--text-light);
        }

        .nav-link.join-team {
            background: var(--secondary-color);
            color: var(--text-light);
        }

        .nav-link.join-team:hover {
            background: #005ecb;
        }

        .fixed-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: var(--dark-bg);
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            padding: 10px 0;
        }

        .fixed-footer .nav-link {
            color: var(--text-light);
            font-size: 0.8rem;
            padding: 6px;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: color 0.3s ease;
        }

        .fixed-footer .nav-link i {
            font-size: 1.2rem;
            margin-bottom: 3px;
        }

        .fixed-footer .nav-link:hover {
            color: var(--accent-color);
            text-shadow: 0 0 5px var(--accent-color);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .stats-card, .performance-card {
            animation: fadeIn 0.5s ease-out;
        }

        @media (min-width: 768px) {
            .player-img-container { width: 150px; height: 150px; }
            .player-name { font-size: 2.2rem; }
            .player-title { font-size: 1.1rem; }
            .performance-container { grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); }
            .stats-card { padding: 25px; }
            .card-title { font-size: 1.35rem; }
        }

        /* Enhanced Mobile Stats View */
        @media (max-width: 576px) {
            .stats-card {
                border-left: 4px solid var(--primary-color);
                padding: 15px;
                margin-bottom: 12px;
                background: linear-gradient(145deg, #ffffff, #f8f9fa);
                border-radius: 10px;
            }

            .stats-table-container {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                padding-bottom: 10px;
            }

            .stats-table {
                display: table;
                min-width: 800px; /* Ensure horizontal scrolling */
                background: transparent;
                box-shadow: none;
                border-collapse: separate;
                border-spacing: 0;
            }

            .stats-table thead {
                background: var(--primary-color);
            }

            .stats-table th {
                color: var(--text-light);
                font-weight: 600;
                font-size: 0.85rem;
                padding: 10px;
                text-align: center;
                position: sticky;
                top: 0;
                z-index: 1;
            }

            .stats-table tbody {
                background: white;
            }

            .stats-table tr {
                border-bottom: 1px solid #e9ecef;
            }

            .stats-table td {
                padding: 8px;
                font-size: 0.85rem;
                color: var(--text-dark);
                text-align: center;
                border-right: 1px solid #e9ecef;
            }

            .stats-table td:last-child {
                border-right: none;
            }

            .stats-table td .highlight-stat {
                color: var(--secondary-color);
                font-weight: 700;
                font-size: 0.9rem;
            }

            .stats-table tr td:first-child {
                font-weight: 700;
                background: #f8f9fa;
                position: sticky;
                left: 0;
                z-index: 1;
            }

            .card-title {
                font-size: 1.2rem;
                color: var(--primary-color);
                margin-bottom: 15px;
                border-bottom: 2px solid var(--secondary-color);
                padding-bottom: 8px;
            }

            .scrollable-section {
                max-height: 180px;
                background: #f8f9fa;
                border-radius: 8px;
                padding: 10px;
            }

            .performance-container {
                gap: 12px;
            }

            .performance-card {
                padding: 12px;
                border-radius: 8px;
                background: linear-gradient(145deg, #ffffff, #f9f9f9);
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
            }

            .match-header {
                font-size: 0.9rem;
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .match-type {
                font-size: 0.7rem;
                padding: 3px 8px;
            }

            .match-stats {
                grid-template-columns: 1fr;
                gap: 8px;
                font-size: 0.8rem;
            }

            .stat-label {
                font-weight: 600;
                color: var(--primary-color);
            }

            .match-result {
                font-size: 0.85rem;
                padding: 8px;
                border-radius: 6px;
                background: #f1f3f5;
            }

            .stats-table tr {
                animation: slideIn 0.3s ease-out;
            }

            @keyframes slideIn {
                from { opacity: 0; transform: translateX(-10px); }
                to { opacity: 1; transform: translateX(0); }
            }
        }

        .text-center { text-align: center; }
        .py-2 { padding-top: 0.5rem; padding-bottom: 0.5rem; }
        .text-muted { color: #6c757d; }
        .mb-0 { margin-bottom: 0; }
        .small { font-size: 0.875rem; }
    </style>
</head>
<body>
    <div class="container py-3">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="player-img-container">
                <img src="<?php echo html_escape($data['image_path']); ?>" alt="<?php echo html_escape($data['playerName']); ?>" class="player-img" loading="lazy">
            </div>
            <h1 class="player-name"><?php echo html_escape($data['playerName']); ?></h1>
            <p class="player-title"><?php echo html_escape($data['player_role']); ?> | <?php echo html_escape($data['city']); ?></p>
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
                    <?php echo html_escape($data['batting_style']); ?>
                </div>
                <div class="info-badge">
                    <i class="fas fa-baseball-ball"></i>
                    <?php echo html_escape($data['bowling_style']); ?>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="profile-nav">
            <ul class="nav justify-content-center flex-wrap">
                <?php if($this->session->userdata('user_id') == $data['user_id']): ?>
                    <li class="nav-item">
                        <a class="nav-link join-team" href="<?php echo base_url(); ?>PlayerController/join_team/<?php echo $data['player_id']; ?>" aria-label="Join a team">
                            <i class="fas fa-plus-circle"></i> Join Team
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>PlayerController/sent_team_request/<?php echo $data['player_id']; ?>" aria-label="View sent team requests">
                            <i class="fas fa-paper-plane"></i> Sent Requests
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="row">
            <!-- Left Column -->
            <div class="col-12 col-lg-4">
                <!-- Teams -->
                <div class="stats-card" id="teams">
                    <h3 class="card-title"><i class="fas fa-users"></i> Current Teams</h3>
                    <div class="scrollable-section">
                        <?php if (!empty($team_names)): ?>
                            <?php foreach ($team_names as $team): ?>
                                <div class="team-card">
                                    <img src="<?php echo $team->image_path ?: 'https://via.placeholder.com/100'; ?>" alt="<?php echo html_escape($team->team_name); ?>" class="team-logo" loading="lazy">
                                    <div class="team-info">
                                        <div class="team-name">
                                            <a href="<?php echo base_url(); ?>TeamController/view_team/<?php echo $team->team_id; ?>">
                                                <?php echo html_escape($team->team_name); ?>
                                            </a>
                                        </div>
                                        <div class="team-league"><?php echo html_escape($team->league_name ?? 'Local League'); ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-2">
                                <i class="fas fa-users-slash fa-2x text-muted"></i>
                                <p class="text-muted">No active teams</p>
                                <?php if($this->session->userdata('user_id') == $data['user_id']): ?>
                                    <a href="<?php echo base_url(); ?>PlayerController/join_team/<?php echo $data['player_id']; ?>" class="btn btn-sm btn-primary">Join a Team</a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Leagues -->
                <div class="stats-card" id="leagues">
                    <h3 class="card-title"><i class="fas fa-trophy"></i> Current Leagues</h3>
                    <div class="scrollable-section">
                        <?php if (!empty($leagues)): ?>
                            <?php foreach ($leagues as $league): ?>
                                <div class="team-card">
                                    <div class="league-info">
                                        <div class="team-name">
                                            <a href="<?php echo base_url('Welcome/tournament_landing/' . $league['league_id']); ?>">
                                                <?php echo html_escape($league['league_name']); ?>
                                            </a>
                                        </div>
                                        <div class="team-league">
                                            <i class="fas fa-map-marker-alt"></i> <?php echo html_escape($league['city']); ?> | 
                                            <i class="far fa-calendar-alt"></i> <?php echo date('M Y', strtotime($league['created_at'])); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-2">
                                <i class="fas fa-trophy fa-2x text-muted"></i>
                                <p class="text-muted">No leagues</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Career Highlights -->
                <div class="stats-card">
                    <h3 class="card-title"><i class="fas fa-star"></i> Career Highlights</h3>
                    <div class="row text-center">
                        <div class="col-6 mb-2">
                            <div class="p-2 bg-light rounded">
                                <div class="h5 text-primary"><?php echo $career_stats['highest_score'] ?? 0; ?></div>
                                <div class="small text-muted">Highest Score</div>
                            </div>
                        </div>
                        <div class="col-6 mb-2">
                            <div class="p-2 bg-light rounded">
                                <div class="h5 text-primary"><?php echo $career_stats['centuries'] ?? 0; ?></div>
                                <div class="small text-muted">Centuries</div>
                            </div>
                        </div>
                        <div class="col-6 mb-2">
                            <div class="p-2 bg-light rounded">
                                <div class="h5 text-primary"><?php echo $career_stats['total_wickets'] ?? 0; ?></div>
                                <div class="small text-muted">Wickets</div>
                            </div>
                        </div>
                        <div class="col-6 mb-2">
                            <div class="p-2 bg-light rounded">
                                <div class="h5 text-primary"><?php echo $career_stats['best_bowling'] ?? 'N/A'; ?></div>
                                <div class="small text-muted">Best Bowling</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bio -->
                <div class="stats-card">
                    <h3 class="card-title"><i class="fas fa-info-circle"></i> Player Bio</h3>
                    <p><?php echo html_escape($data['additional_info'] ?: 'No additional information provided.'); ?></p>
                </div>

                <!-- Awards -->
                <div class="stats-card" id="awards">
                    <h3 class="card-title"><i class="fas fa-medal"></i> Awards</h3>
                    <div class="scrollable-section">
                        <?php if (!empty($awards)): ?>
                            <?php foreach ($awards as $award): ?>
                                <div class="team-card">
                                    <div class="league-info">
                                        <div class="team-name"><?php echo html_escape($award['title']); ?></div>
                                        <div class="team-league">
                                            <?php echo html_escape($award['event'] . ' - ' . date('M Y', strtotime($award['date']))); ?>
                                        </div>
                                        <p class="mb-0 small"><?php echo html_escape($award['description']); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-2">
                                <i class="fas fa-medal fa-2x text-muted"></i>
                                <p class="text-muted">No awards</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-12 col-lg-8">
                <!-- Batting Stats -->
                <div class="stats-card" id="stats">
                    <h3 class="card-title"><i class="fas fa-baseball-ball"></i> Batting Statistics</h3>
                    <div class="stats-table-container">
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
                                    $matches = $player_stats[$format]['total_matches'] ?? 0;
                                    $runs = $player_stats[$format]['total_runs'] ?? 0;
                                    $balls = $player_stats[$format]['total_balls'] ?? 0;
                                    $outs = $player_stats[$format]['total_outs'] ?? $matches;
                                    $average = $outs > 0 ? round($runs / $outs, 2) : '0.00';
                                    $strike_rate = $balls > 0 ? round(($runs / $balls) * 100, 2) : '0.00';
                                ?>
                                <tr>
                                    <td><strong><?php echo ucwords(str_replace('_', ' ', $format)); ?></strong></td>
                                    <td><?php echo $matches; ?></td>
                                    <td class="highlight-stat"><?php echo $runs; ?></td>
                                    <td class="highlight-stat"><?php echo $player_stats[$format]['highest_score'] ?? 0; ?></td>
                                    <td><?php echo $average; ?></td>
                                    <td><?php echo $strike_rate; ?></td>
                                    <td class="highlight-stat"><?php echo $player_stats[$format]['centuries'] ?? 0; ?></td>
                                    <td><?php echo $player_stats[$format]['fifties'] ?? 0; ?></td>
                                    <td><?php echo $player_stats[$format]['fours'] ?? 0; ?></td>
                                    <td><?php echo $player_stats[$format]['sixes'] ?? 0; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Bowling Stats -->
                <div class="stats-card">
                    <h3 class="card-title"><i class="fas fa-baseball-ball"></i> Bowling Statistics</h3>
                    <div class="stats-table-container">
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (['Leather Ball', 'Tape Ball', 'Tennis Ball'] as $match_type): ?>
                                    <?php if (isset($bowling_stats[$match_type])): ?>
                                        <?php 
                                        $stats = $bowling_stats[$match_type];
                                        $wickets = $stats['total_wickets'] ?? 0;
                                        $runs_given = $stats['total_runs'] ?? 0;
                                        $balls_bowled = $stats['total_balls'] ?? 0;
                                        $matches = $stats['total_matches'] ?? 0;
                                        $bowling_avg = $wickets > 0 ? round($runs_given / $wickets, 2) : '0.00';
                                        $economy = $balls_bowled > 0 ? round(($runs_given / $balls_bowled) * 6, 2) : '0.00';
                                        $bowling_sr = $wickets > 0 ? round($balls_bowled / $wickets, 2) : '0.00';
                                        ?>
                                        <tr>
                                            <td><strong><?php echo $match_type; ?></strong></td>
                                            <td><?php echo $matches; ?></td>
                                            <td class="highlight-stat"><?php echo $wickets; ?></td>
                                            <td class="highlight-stat"><?php echo $stats['best_bowling'] ?? 'N/A'; ?></td>
                                            <td><?php echo $bowling_avg; ?></td>
                                            <td><?php echo $economy; ?></td>
                                            <td><?php echo $bowling_sr; ?></td>
                                            <td><?php echo $stats['four_wickets'] ?? 0; ?></td>
                                            <td><?php echo $stats['five_wickets'] ?? 0; ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Performances -->
                <div class="stats-card" id="performance">
                    <h3 class="card-title"><i class="fas fa-chart-bar"></i> Recent Performances</h3>
                    <div class="performance-container">
                        <?php if (!empty($recent_performance)): ?>
                            <?php foreach ($recent_performance as $performance): ?>
                                <div class="performance-card">
                                    <div class="match-header">
                                        <div class="match-teams">
                                            <?php echo html_escape($performance['team_one_name']); ?> vs <?php echo html_escape($performance['team_two_name']); ?>
                                        </div>
                                        <div class="match-type">
                                            <?php 
                                            echo (strpos($performance['match_id'], 'IPL') !== false) ? 'IPL Match' : 'League Match'; 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="match-stats">
                                        <div class="stat-item">
                                            <div class="stat-label">Runs</div>
                                            <div>
                                                <?php echo html_escape($performance['runs']); ?> 
                                                (<?php echo html_escape($performance['balls']); ?>)
                                                <?php if ($performance['dismissal'] && $performance['dismissal'] != 'not out'): ?>
                                                    <span class="text-danger small"><?php echo ucfirst($performance['dismissal']); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-label">SR</div>
                                            <div><?php echo number_format($performance['strike_rate'], 2); ?></div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-label">4s/6s</div>
                                            <div>
                                                <?php echo html_escape($performance['fours']); ?>/
                                                <?php echo html_escape($performance['sixes']); ?>
                                            </div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-label">Bowling</div>
                                            <div>
                                                <?php if (isset($performance['bowling_wickets'])): ?>
                                                    <?php echo html_escape($performance['bowling_wickets']); ?>/
                                                    <?php echo html_escape($performance['bowling_runs_conceded']); ?>
                                                    (<?php echo html_escape($performance['bowling_overs']); ?>)
                                                <?php else: ?>
                                                    DNB
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="match-result <?php echo $performance['result'] === 'won' ? 'won' : ($performance['result'] === 'lost' ? 'lost' : 'no-result'); ?>">
                                        <i class="fas <?php echo $performance['result'] === 'won' ? 'fa-trophy' : ($performance['result'] === 'lost' ? 'fa-times-circle' : 'fa-equals'); ?>"></i>
                                        <?php echo html_escape($performance['result_statement']); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-3">
                                <i class="fas fa-chart-line fa-2x text-muted mb-2"></i>
                                <p class="text-muted">No recent performances found</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fixed Footer -->
    <nav class="fixed-footer">
        <ul class="nav justify-content-around w-100">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>Welcome/landing_page" aria-label="Home">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
            </li>
            <?php if($this->session->userdata('user_id') == $data['user_id']): ?>
                <li class="nav-item">
                    <a class="nav-link join-team" href="<?php echo base_url(); ?>PlayerController/join_team/<?php echo $data['player_id']; ?>" aria-label="Join a team">
                        <i class="fas fa-plus-circle"></i>
                        <span>Join Team</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>PlayerController/sent_team_request/<?php echo $data['player_id']; ?>" aria-label="View sent team requests">
                        <i class="fas fa-paper-plane"></i>
                        <span>Sent Requests</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', e => {
                e.preventDefault();
                document.querySelector(anchor.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>