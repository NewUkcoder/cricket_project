<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php echo $league['league_name']; ?> | Cricket League</title>
    <style>
        /* Modern Base Styles */
        :root {
            --primary-color: #005f8d;
            --secondary-color: #007bb5;
            --accent-color: #ff6b35;
            --text-color: #333;
            --light-text: #777;
            --bg-color: #f5f5f5;
            --card-bg: #ffffff;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --section-spacing: 20px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            line-height: 1.6;
            font-size: 15px;
            padding-bottom: 60px;
        }

        /* Header Styles */
        .league-header {
            background: linear-gradient(135deg, var(--primary-color), #003d5c);
            color: white;
            padding: 15px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            color: white;
            text-decoration: none;
            margin-bottom: 10px;
            font-size: 14px;
            padding: 5px 10px;
            border-radius: 4px;
            background-color: rgba(255,255,255,0.15);
            transition: background-color 0.2s;
        }

        .back-btn:hover {
            background-color: rgba(255,255,255,0.25);
        }

        .league-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 5px;
            word-break: break-word;
            line-height: 1.3;
        }

        .league-meta {
            font-size: 12px;
            opacity: 0.9;
            margin-bottom: 5px;
            line-height: 1.4;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .league-meta span {
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .league-meta i {
            font-size: 14px;
        }

        /* Navigation */
        .nav-scroll {
            background: var(--card-bg);
            padding: 12px 15px;
            overflow-x: auto;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
            position: sticky;
            top: 140px;
            z-index: 90;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            display: none;
        }

        .nav-scroll::-webkit-scrollbar {
            display: none;
        }

        .nav-link {
            display: inline-block;
            padding: 8px 16px;
            margin: 0 5px;
            background: #f0f0f0;
            color: var(--primary-color);
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }

        .nav-link.active, .nav-link:hover {
            background: var(--primary-color);
            color: white;
        }

        /* Footer Styles */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: var(--card-bg);
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            z-index: 100;
        }

        .footer__link {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--light-text);
            font-size: 11px;
            padding: 8px;
            flex: 1;
            transition: color 0.2s ease;
        }

        .footer__link.active,
        .footer__link:hover,
        .footer__link:focus {
            color: var(--primary-color);
        }

        .footer__icon {
            font-size: 20px;
            margin-bottom: 4px;
        }

        /* Main Content */
        .container {
            max-width: 100%;
            padding: 15px;
        }

        .section-title {
            font-size: 1.2rem;
            color: var(--primary-color);
            margin: var(--section-spacing) 0 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--secondary-color);
            font-weight: 700;
            position: sticky;
            top: 140px;
            background: var(--bg-color);
            z-index: 50;
            padding-top: 5px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: var(--section-spacing);
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 12px;
            box-shadow: var(--box-shadow);
            text-align: center;
            transition: transform 0.2s;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .stat-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--secondary-color);
            margin: 0 auto 8px;
        }

        .stat-title {
            font-size: 13px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .stat-value {
            font-size: 12px;
            color: var(--text-color);
            margin-bottom: 3px;
            font-weight: 500;
        }

        .stat-team {
            font-size: 11px;
            color: var(--secondary-color);
            font-weight: 600;
            margin-bottom: 5px;
        }

        .see-more {
            font-size: 11px;
            color: var(--primary-color);
            text-decoration: none;
            display: inline-block;
            margin-top: 5px;
            font-weight: 600;
        }

        /* Progress Bar for Stats */
        .stat-progress {
            width: 80%;
            height: 6px;
            background: #e0e0e0;
            border-radius: 3px;
            margin: 5px auto 8px;
            overflow: hidden;
        }

        .stat-progress-bar {
            height: 100%;
            background: var(--accent-color);
            border-radius: 3px;
            transition: width 0.5s ease;
        }

        /* Badge for Top Performers */
        .stat-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--accent-color);
            color: white;
            font-size: 10px;
            padding: 3px 8px;
            border-radius: 12px;
            font-weight: 600;
        }

        /* Match Cards */
        .match-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 15px;
            margin-bottom: 12px;
            box-shadow: var(--box-shadow);
            transition: transform 0.2s;
        }

        .match-card:hover {
            transform: translateY(-3px);
        }

        .team-vs {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 10px;
        }

        .team-img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--secondary-color);
        }

        .vs-text {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 14px;
        }

        .match-title {
            font-size: 14px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 10px;
            color: var(--text-color);
        }

        .match-details {
            display: grid;
            grid-template-columns: 1fr;
            gap: 8px;
            font-size: 13px;
        }

        .match-detail {
            display: flex;
            align-items: center;
        }

        .match-detail strong {
            margin-right: 8px;
            color: var(--primary-color);
            min-width: 60px;
            font-weight: 600;
        }

        /* Results Section - Compact */
        .result-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 12px;
            margin-bottom: 10px;
            box-shadow: var(--box-shadow);
            border-left: 4px solid var(--accent-color);
            transition: transform 0.2s;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .result-card:hover {
            transform: translateY(-3px);
        }

        .result-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: var(--light-text);
        }

        .result-date {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .result-status {
            background: var(--accent-color);
            color: white;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 600;
        }

        .result-teams {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .result-team {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            gap: 5px;
        }

        .result-team-logo {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--secondary-color);
        }

        .result-team-name {
            font-size: 12px;
            font-weight: 600;
            text-align: center;
            line-height: 1.2;
        }

        .result-vs {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 12px;
        }

        .result-score {
            font-size: 12px;
            text-align: center;
            line-height: 1.4;
            color: var(--text-color);
        }

        .result-outcome {
            font-weight: 700;
            color: var(--accent-color);
            text-align: center;
            font-size: 13px;
            line-height: 1.3;
        }

        .view-scorecard {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px;
            font-size: 12px;
            text-align: center;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.2s;
        }

        .view-scorecard:hover {
            background: var(--secondary-color);
        }

        /* Points Table */
        .points-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: var(--section-spacing);
            font-size: 13px;
            background: var(--card-bg);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
        }

        .points-table th {
            background: var(--primary-color);
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: 600;
        }

        .points-table td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        .points-table tr:nth-child(even) {
            background: #f9f9f9;
        }

        .highlight {
            font-weight: 700;
            color: var(--primary-color);
        }

        /* Teams Section */
        .team-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 15px;
            margin-bottom: 12px;
            box-shadow: var(--box-shadow);
            transition: transform 0.2s;
        }

        .team-card:hover {
            transform: translateY(-3px);
        }

        .team-header {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }

        .team-logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--secondary-color);
            margin-right: 12px;
        }

        .team-name {
            font-size: 15px;
            font-weight: 700;
            color: var(--primary-color);
        }

        .player-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .player-stat {
            text-align: center;
        }

        .player-stat-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--secondary-color);
            margin: 0 auto 5px;
        }

        .player-stat-title {
            font-size: 12px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 3px;
        }

        .player-stat-value {
            font-size: 12px;
            color: var(--text-color);
            font-weight: 500;
        }

        /* Rules Section */
        .rules-list {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 15px;
            box-shadow: var(--box-shadow);
            font-size: 14px;
        }

        .rules-list li {
            margin-bottom: 10px;
            padding-left: 18px;
            position: relative;
            line-height: 1.5;
        }

        .rules-list li:before {
            content: "•";
            color: var(--accent-color);
            position: absolute;
            left: 5px;
            font-size: 18px;
            line-height: 1;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 20px;
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            font-size: 14px;
            color: var(--light-text);
            margin-bottom: var(--section-spacing);
        }

        /* Mobile Optimizations */
        @media (max-width: 767px) {
            body {
                font-size: 14px;
            }

            .league-title {
                font-size: 1.3rem;
            }

            .league-meta {
                font-size: 11px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .stat-card {
                padding: 10px;
            }

            .result-card {
                padding: 10px;
            }

            .result-team-logo {
                width: 30px;
                height: 30px;
            }

            .result-team-name {
                font-size: 11px;
            }

            .result-score {
                font-size: 11px;
            }

            .view-scorecard {
                padding: 6px;
                font-size: 11px;
            }

            .player-stats {
                grid-template-columns: 1fr;
            }

            .match-details {
                grid-template-columns: 1fr;
            }
        }

        /* Desktop Optimizations */
        @media (min-width: 768px) {
            body {
                padding-bottom: 0;
            }
            
            .footer {
                display: none;
            }
            
            .nav-scroll {
                display: block;
                top: 160px;
                padding: 12px 20px;
            }
            
            .container {
                max-width: 1000px;
                margin: 0 auto;
                padding: 20px;
            }

            .league-header {
                padding: 20px 25px 15px;
            }

            .league-title {
                font-size: 2rem;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
                gap: 15px;
            }

            .section-title {
                top: 160px;
                font-size: 1.4rem;
            }

            .player-stats {
                grid-template-columns: repeat(4, 1fr);
            }

            .match-details {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="league-header">
        <a href="javascript:history.back()" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </a>
        <h1 class="league-title"><?php echo $league['league_name']; ?></h1>
        <div class="league-meta">
            <span><i class="fas fa-calendar-alt"></i> <?php echo $league['season']; ?></span>
            <span><i class="fas fa-map-marker-alt"></i> <?php echo $league['city']; ?>, <?php echo $league['country']; ?></span>
            <span><i class="fas fa-baseball-ball"></i> <?php echo $league['match_type']; ?></span>
            <span><i class="fas fa-clock"></i> <?php echo $league['overs']; ?> Overs</span>
            <span><i class="fas fa-stadium"></i> <?php echo $league['venue']; ?></span>
        </div>
    </header>

    <div class="container">
        <!-- Top Stats Section -->
        <h2 class="section-title" id="stats">
            <i class="fas fa-chart-line"></i> League Top Performers
        </h2>
        <div class="stats-grid">
            <!-- Top Batsman -->
            <div class="stat-card">
                <?php if ($league_top_scorer): ?>
                    <span class="stat-badge">Top Scorer</span>
                    <img src="<?php echo $league_top_scorer->player_image; ?>" alt="<?php echo $league_top_scorer->playerName; ?>" class="stat-img">
                    <h3 class="stat-title"><i class="fas fa-bat"></i> Top Batsman</h3>
                    <p class="stat-value"><?php echo $league_top_scorer->playerName; ?></p>
                    <div class="stat-progress">
                        <div class="stat-progress-bar" style="width: <?php echo min(($league_top_scorer->total_runs / 500) * 100, 100); ?>%;"></div>
                    </div>
                    <p class="stat-value"><strong><?php echo $league_top_scorer->total_runs; ?> Runs</strong></p>
                    <p class="stat-team"><?php echo $league_top_scorer->team_name; ?></p>
                    <a href="<?php echo base_url();?>TournamentController/league_top_ten_scorer/<?php echo $league['league_id'];?>" class="see-more">
                        <i class="fas fa-arrow-right"></i> See more
                    </a>
                <?php else: ?>
                    <h3 class="stat-title">Top Batsman</h3>
                    <p class="stat-value">No data available</p>
                <?php endif; ?>
            </div>

            <!-- Top Bowler -->
            <div class="stat-card">
                <?php if ($league_top_bowler): ?>
                    <span class="stat-badge">Top Wickets</span>
                    <img src="<?php echo $league_top_bowler->player_image; ?>" alt="<?php echo $league_top_bowler->playerName; ?>" class="stat-img">
                    <h3 class="stat-title"><i class="fas fa-bowling-ball"></i> Top Bowler</h3>
                    <p class="stat-value"><?php echo $league_top_bowler->playerName; ?></p>
                    <div class="stat-progress">
                        <div class="stat-progress-bar" style="width: <?php echo min(($league_top_bowler->total_wickets / 20) * 100, 100); ?>%;"></div>
                    </div>
                    <p class="stat-value"><strong><?php echo $league_top_bowler->total_wickets; ?> Wickets</strong></p>
                    <p class="stat-team"><?php echo $league_top_bowler->team_name; ?></p>
                    <a href="<?php echo base_url();?>TournamentController/league_top_ten_bowler/<?php echo $league['league_id'];?>" class="see-more">
                        <i class="fas fa-arrow-right"></i> See more
                    </a>
                <?php else: ?>
                    <h3 class="stat-title">Top Bowler</h3>
                    <p class="stat-value">No data available</p>
                <?php endif; ?>
            </div>

            <!-- Highest Individual Score -->
            <div class="stat-card">
                <?php if ($league_highest_individual_score): ?>
                    <span class="stat-badge">High Score</span>
                    <img src="<?php echo $league_highest_individual_score->player_image; ?>" alt="<?php echo $league_highest_individual_score->playerName; ?>" class="stat-img">
                    <h3 class="stat-title"><i class="fas fa-star"></i> Highest Score</h3>
                    <p class="stat-value"><?php echo $league_highest_individual_score->playerName; ?></p>
                    <div class="stat-progress">
                        <div class="stat-progress-bar" style="width: <?php echo min(($league_highest_individual_score->highest_score / 200) * 100, 100); ?>%;"></div>
                    </div>
                    <p class="stat-value"><strong><?php echo $league_highest_individual_score->highest_score; ?> Runs</strong></p>
                    <p class="stat-team"><?php echo $league_highest_individual_score->team_name; ?></p>
                    <a href="<?php echo base_url();?>TournamentController/league_ten_individual_scorer/<?php echo $league['league_id'];?>" class="see-more">
                        <i class="fas fa-arrow-right"></i> See more
                    </a>
                <?php else: ?>
                    <h3 class="stat-title">Highest Score</h3>
                    <p class="stat-value">No data available</p>
                <?php endif; ?>
            </div>

            <!-- Best Bowling -->
            <div class="stat-card">
                <?php if ($league_highest_wicket_taker): ?>
                    <span class="stat-badge">Best Figures</span>
                    <img src="<?php echo $league_highest_wicket_taker->player_image; ?>" alt="<?php echo $league_highest_wicket_taker->playerName; ?>" class="stat-img">
                    <h3 class="stat-title"><i class="fas fa-trophy"></i> Best Bowling</h3>
                    <p class="stat-value"><?php echo $league_highest_wicket_taker->playerName; ?></p>
                    <div class="stat-progress">
                        <div class="stat-progress-bar" style="width: <?php echo min(($league_highest_wicket_taker->wickets / 7) * 100, 100); ?>%;"></div>
                    </div>
                    <p class="stat-value"><strong><?php echo $league_highest_wicket_taker->wickets; ?>/<?php echo $league_highest_wicket_taker->given_runs; ?></strong></p>
                    <p class="stat-team"><?php echo $league_highest_wicket_taker->team_name; ?></p>
                    <a href="<?php echo base_url();?>TournamentController/league_top_ten_bowler_of_match/<?php echo $league['league_id'];?>" class="see-more">
                        <i class="fas fa-arrow-right"></i> See more
                    </a>
                <?php else: ?>
                    <h3 class="stat-title">Best Bowling</h3>
                    <p class="stat-value">No data available</p>
                <?php endif; ?>
            </div>

            <!-- Highest Team Score -->
            <div class="stat-card">
                <?php if ($league_highest_team_score): ?>
                    <span class="stat-badge">Team High</span>
                    <img src="<?php echo $league_highest_team_score->team_image; ?>" alt="<?php echo $league_highest_team_score->team_name; ?>" class="stat-img">
                    <h3 class="stat-title"><i class="fas fa-users"></i> Highest Team Score</h3>
                    <p class="stat-value"><?php echo $league_highest_team_score->team_name; ?></p>
                    <div class="stat-progress">
                        <div class="stat-progress-bar" style="width: <?php echo min(($league_highest_team_score->highest_team_score / 400) * 100, 100); ?>%;"></div>
                    </div>
                    <p class="stat-value"><strong><?php echo $league_highest_team_score->highest_team_score; ?>/<?php echo $league_highest_team_score->wickets; ?></strong></p>
                    <p class="stat-value"><?php echo $league_highest_team_score->t_overs; ?> overs</p>
                    <a href="<?php echo base_url();?>TournamentController/league_top_five_team_score/<?php echo $league['league_id'];?>" class="see-more">
                        <i class="fas fa-arrow-right"></i> See more
                    </a>
                <?php else: ?>
                    <h3 class="stat-title">Highest Team</h3>
                    <p class="stat-value">No data available</p>
                <?php endif; ?>
            </div>

            <!-- Lowest Team Score -->
            <div class="stat-card">
                <?php if ($league_lowest_team_score): ?>
                    <span class="stat-badge">Team Low</span>
                    <img src="<?php echo $league_lowest_team_score->team_image; ?>" alt="<?php echo $league_lowest_team_score->team_name; ?>" class="stat-img">
                    <h3 class="stat-title"><i class="fas fa-users"></i> Lowest Team Score</h3>
                    <p class="stat-value"><?php echo $league_lowest_team_score->team_name; ?></p>
                    <div class="stat-progress">
                        <div class="stat-progress-bar" style="width: <?php echo min((100 - ($league_lowest_team_score->highest_team_score / 400) * 100), 100); ?>%;"></div>
                    </div>
                    <p class="stat-value"><strong><?php echo $league_lowest_team_score->highest_team_score; ?>/<?php echo $league_lowest_team_score->wickets; ?></strong></p>
                    <p class="stat-value"><?php echo $league_lowest_team_score->t_overs; ?> overs</p>
                    <a href="<?php echo base_url();?>TournamentController/league_lowest_five_score/<?php echo $league['league_id'];?>" class="see-more">
                        <i class="fas fa-arrow-right"></i> See more
                    </a>
                <?php else: ?>
                    <h3 class="stat-title">Lowest Team</h3>
                    <p class="stat-value">No data available</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Schedule Section -->
        <h2 class="section-title" id="schedule">
            <i class="fas fa-calendar-day"></i> Upcoming Matches
        </h2>
        <?php if (!empty($league_schedule)): ?>
            <?php foreach ($league_schedule as $schedule): ?>
                <div class="match-card">
                    <div class="team-vs">
                        <img src="<?php echo $schedule->team_one_image; ?>" alt="<?php echo $schedule->team_one_name; ?>" class="team-img">
                        <span class="vs-text">vs</span>
                        <img src="<?php echo $schedule->team_two_image; ?>" alt="<?php echo $schedule->team_two_name; ?>" class="team-img">
                    </div>
                    <h3 class="match-title"><?php echo $schedule->team_one_name; ?> vs <?php echo $schedule->team_two_name; ?></h3>
                    <div class="match-details">
                        <div class="match-detail">
                            <strong><i class="far fa-calendar"></i> Date:</strong> <?php echo date("d M Y", strtotime($schedule->match_date)); ?>
                        </div>
                        <div class="match-detail">
                            <strong><i class="far fa-clock"></i> Time:</strong> <?php echo $schedule->match_time; ?>
                        </div>
                        <div class="match-detail">
                            <strong><i class="fas fa-map-marker-alt"></i> Venue:</strong> <?php echo $schedule->location; ?>
                        </div>
                        <div class="match-detail">
                            <strong><i class="fas fa-baseball-ball"></i> Overs:</strong> <?php echo $league['overs']; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="far fa-calendar-times fa-2x" style="margin-bottom: 10px;"></i>
                <p>No upcoming matches scheduled yet</p>
            </div>
        <?php endif; ?>

        <!-- Results Section - Compact -->
        <h2 class="section-title" id="results">
            <i class="fas fa-trophy"></i> Recent Results
        </h2>
        <?php if (!empty($match_results)): ?>
            <?php foreach ($match_results as $match): ?>
                <div class="result-card">
                    <div class="result-header">
                        <span class="result-date">
                            <i class="far fa-calendar-alt"></i> <?php echo date("d M Y", strtotime($match->match_date)); ?>
                            <i class="far fa-clock"></i> <?php echo $match->match_time; ?>
                        </span>
                        <span class="result-status">COMPLETED</span>
                    </div>
                    
                    <div class="result-teams">
                        <div class="result-team">
                            <img src="<?php echo base_url($match->win_team_image); ?>" alt="<?php echo $match->win_team_name; ?>" class="result-team-logo">
                            <span class="result-team-name"><?php echo $match->win_team_name; ?></span>
                        </div>
                        <span class="result-vs">vs</span>
                        <div class="result-team">
                            <img src="<?php echo base_url($match->lost_team_image); ?>" alt="<?php echo $match->lost_team_name; ?>" class="result-team-logo">
                            <span class="result-team-name"><?php echo $match->lost_team_name; ?></span>
                        </div>
                    </div>
                    
                    <div class="result-score">
                        <span><strong><?php echo $match->batting_team_batting_order_1; ?>:</strong> <?php echo $match->total_runs_batting_order_1; ?>/<?php echo $match->wickets_batting_order_1; ?> (<?php echo $match->total_overs_batting_order_1; ?> ov)</span><br>
                        <span><strong><?php echo $match->batting_team_batting_order_2; ?>:</strong> <?php echo $match->total_runs_batting_order_2; ?>/<?php echo $match->wickets_batting_order_2; ?> (<?php echo $match->total_overs_batting_order_2; ?> ov)</span>
                    </div>
                    
                    <div class="result-outcome">
                        <?php echo $match->result_statement; ?>
                    </div>
                    
                    <a href="<?php echo base_url(); ?>Welcome/scorecard/<?php echo $match->team_one_id; ?>/<?php echo $match->team_two_id; ?>/<?php echo $match->match_id; ?>" class="view-scorecard">
                        <i class="fas fa-file-alt"></i> View Full Scorecard
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="far fa-frown fa-2x" style="margin-bottom: 10px;"></i>
                <p>No match results available yet</p>
            </div>
        <?php endif; ?>

        <!-- Points Table -->
        <h2 class="section-title" id="points">
            <i class="fas fa-table"></i> Points Table
        </h2>
        <table class="points-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Team</th>
                    <th>P</th>
                    <th>W</th>
                    <th>L</th>
                    <th>NR</th>
                    <th>Pts</th>
                    <th>NRR</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($points_table)): ?>
                    <?php foreach ($points_table as $index => $team): ?>
                        <tr>
                            <td class="<?php echo $index < 3 ? 'highlight' : ''; ?>"><?php echo $index + 1; ?></td>
                            <td style="text-align: left; padding-left: 15px;">
                                <img src="<?php echo $team->team_image; ?>" alt="<?php echo $team->team_name; ?>" style="width: 25px; height: 25px; border-radius: 50%; vertical-align: middle; margin-right: 8px;">
                                <?php echo $team->team_name; ?>
                            </td>
                            <td><?php echo $team->matches_played; ?></td>
                            <td><?php echo $team->wins; ?></td>
                            <td><?php echo $team->losses; ?></td>
                            <td><?php echo $team->no_results; ?></td>
                            <td><strong><?php echo $team->points; ?></strong></td>
                            <td><?php echo number_format($team->net_run_rate, 3); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 20px;">
                            <i class="far fa-frown" style="margin-right: 5px;"></i>
                            No points data available
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Teams Section -->
        <h2 class="section-title" id="teams">
            <i class="fas fa-users"></i> Teams
        </h2>
        <?php if (!empty($league_teams) && is_array($league_teams)): ?>
            <?php foreach ($league_teams as $team): ?>
                <?php if (!empty($team) && (isset($team['team_info']) || isset($team['top_scorer']) || isset($team['top_bowler']))): ?>
                    <div class="team-card">
                        <div class="team-header">
                            <?php $team_image = isset($team['team_info']['team_image']) ? $team['team_info']['team_image'] : base_url('assets/images/default-team.png'); ?>
                            <img src="<?php echo $team_image; ?>" alt="Team Logo" class="team-logo">
                            <h3 class="team-name">
                                <?php if (isset($team['team_info']['team_id']) && isset($team['team_info']['team_name'])): ?>
                                    <a href="<?php echo base_url(); ?>TeamController/team_profile/<?php echo $team['team_info']['team_id']; ?>">
                                        <?php echo $team['team_info']['team_name']; ?>
                                    </a>
                                <?php else: ?>
                                    Team
                                <?php endif; ?>
                            </h3>
                        </div>
                        <div class="player-stats">
                            <!-- Top Batsman -->
                            <div class="player-stat">
                                <h4 class="player-stat-title">Top Batsman</h4>
                                <?php if (isset($team['top_scorer']) && !empty($team['top_scorer'])): ?>
                                    <?php $batsman_image = isset($team['top_scorer']['player_image']) ? $team['top_scorer']['player_image'] : base_url('assets/images/default-player.png'); ?>
                                    <img src="<?php echo $batsman_image; ?>" alt="Top Batsman" class="player-stat-img">
                                    <p class="player-stat-value"><?php echo $team['top_scorer']['player_name'] ?? 'N/A'; ?></p>
                                    <p class="player-stat-value"><strong><?php echo $team['top_scorer']['total_runs'] ?? '0'; ?> runs</strong></p>
                                <?php else: ?>
                                    <p class="stat-value">No data available</p>
                                <?php endif; ?>
                            </div>
                            <!-- Highest Score -->
                            <div class="player-stat">
                                <h4 class="player-stat-title">Highest Score</h4>
                                <?php if (isset($team['highest_individual_score']) && !empty($team['highest_individual_score'])): ?>
                                    <?php $hs_image = isset($team['highest_individual_score']['player_image']) ? $team['highest_individual_score']['player_image'] : base_url('assets/images/default-player.png'); ?>
                                    <img src="<?php echo $hs_image; ?>" alt="Highest Score" class="player-stat-img">
                                    <p class="player-stat-value"><?php echo $team['highest_individual_score']['player_name'] ?? 'N/A'; ?></p>
                                    <p class="player-stat-value"><strong><?php echo $team['highest_individual_score']['runs'] ?? '0'; ?> runs</strong></p>
                                <?php else: ?>
                                    <p class="stat-value">No data available</p>
                                <?php endif; ?>
                            </div>
                            <!-- Top Bowler -->
                            <div class="player-stat">
                                <h4 class="player-stat-title">Top Bowler</h4>
                                <?php if (isset($team['top_bowler']) && !empty($team['top_bowler'])): ?>
                                    <?php $bowler_image = isset($team['top_bowler_image']) ? $team['top_bowler_image'] : base_url('assets/images/default-player.png'); ?>
                                    <img src="<?php echo $bowler_image; ?>" alt="Top Bowler" class="player-stat-img">
                                    <p class="player-stat-value"><?php echo $team['top_bowler'] ?? 'N/A'; ?></p>
                                    <p class="player-stat-value"><strong><?php echo $team['top_bowler_wickets'] ?? '0'; ?> wickets</strong></p>
                                <?php else: ?>
                                    <p class="stat-value">No data available</p>
                                <?php endif; ?>
                            </div>
                            <!-- Best Bowling -->
                            <div class="player-stat">
                                <h4 class="player-stat-title">Best Bowling</h4>
                                <?php if (isset($team['best_bowler']) && !empty($team['best_bowler'])): ?>
                                    <?php $best_bowler_image = isset($team['best_bowling_image']) ? $team['best_bowling_image'] : base_url('assets/images/default-player.png'); ?>
                                    <img src="<?php echo $best_bowler_image; ?>" alt="Best Bowling" class="player-stat-img">
                                    <p class="player-stat-value"><?php echo $team['best_bowler'] ?? 'N/A'; ?></p>
                                    <p class="player-stat-value"><strong><?php echo $team['best_bowling_figures'] ?? 'N/A'; ?></strong></p>
                                <?php else: ?>
                                    <p class="stat-value">No data available</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php if (empty(array_filter($league_teams))): ?>
                <div class="empty-state">
                    <i class="fas fa-user-slash fa-2x" style="margin-bottom: 10px;"></i>
                    <p>No teams registered yet</p>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-user-slash fa-2x" style="margin-bottom: 10px;"></i>
                <p>No teams registered yet</p>
            </div>
        <?php endif; ?>

        <!-- Rules Section -->
        <h2 class="section-title" id="rules">
            <i class="fas fa-book"></i> League Rules
        </h2>
        <div class="rules-list">
            <?php if (!empty($league_rules)): ?>
                <ul>
                    <?php foreach ($league_rules as $rule): ?>
                        <li><?php echo $rule->league_rule; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-exclamation-circle fa-2x" style="margin-bottom: 10px;"></i>
                    <p>No rules specified yet</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer (Mobile Only) -->
    <footer class="footer">
        <a href="<?php echo base_url(); ?>Welcome/landing_page" class="footer__link <?php echo current_url() == base_url('Welcome/landing_page') ? 'active' : ''; ?>" aria-label="Go to Home page">
            <i class="fas fa-home footer__icon"></i>
            <span>Home</span>
        </a>
        <?php if ($this->session->userdata('user_id') == $league['user_id']): ?>
            <a href="<?php echo base_url(); ?>Welcome/tournament_main/<?php echo htmlspecialchars($league['league_id']); ?>" class="footer__link <?php echo strpos(current_url(), 'tournament_main') !== false ? 'active' : ''; ?>" aria-label="Go to League Dashboard">
                <i class="fas fa-tachometer-alt footer__icon"></i>
                <span>Dashboard</span>
            </a>
        <?php endif; ?>
    </footer>

    <script>
        // Enhanced JavaScript for better interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Navigation handling
            const navItems = document.querySelectorAll('.footer__link, .nav-link');
            const sections = document.querySelectorAll('section[id], .section-title');
            
            function highlightNav() {
                let current = '';
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    if (pageYOffset >= (sectionTop - 150)) {
                        current = section.getAttribute('id');
                    }
                });
                
                navItems.forEach(item => {
                    item.classList.remove('active');
                    if (item.getAttribute('href') === `#${current}`) {
                        item.classList.add('active');
                    }
                });
            }
            
            window.addEventListener('scroll', highlightNav);
            highlightNav();
            
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 120,
                            behavior: 'smooth'
                        });
                        history.pushState(null, null, targetId);
                    }
                });
            });
            
            function checkScreenSize() {
                const footer = document.querySelector('.footer');
                const horizontalNav = document.querySelector('.nav-scroll');
                
                if (window.innerWidth >= 768) {
                    footer.style.display = 'none';
                    horizontalNav.style.display = 'block';
                } else {
                    footer.style.display = 'flex';
                    horizontalNav.style.display = 'none';
                }
            }
            
            window.addEventListener('resize', checkScreenSize);
            checkScreenSize();
            
            const cards = document.querySelectorAll('.stat-card, .match-card, .result-card, .team-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'translateY(-5px)';
                    card.style.boxShadow = '0 6px 16px rgba(0, 0, 0, 0.12)';
                });
                
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0)';
                    card.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.08)';
                });
            });
        });
    </script>
</body>
</html>