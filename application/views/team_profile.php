<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cricket Club</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1e90ff;
            --secondary-color: #ff4500;
            --text-dark: #1a252f;
            --text-muted: #6c757d;
            --bg-white: #ffffff;
            --bg-light: #f7f9fc;
            --shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 5px 10px rgba(0, 0, 0, 0.15);
            --spacing-xs: 6px;
            --spacing-sm: 10px;
            --spacing-md: 14px;
            --spacing-lg: 20px;
            --font-xs: 0.8rem;
            --font-sm: 0.9rem;
            --font-md: 1rem;
            --font-lg: 1.6rem;
            --border-radius: 10px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.5;
            padding-bottom: 70px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: var(--spacing-md);
        }

        .header-container {
            background: var(--bg-white);
            border-radius: var(--border-radius);
            padding: var(--spacing-lg);
            margin: var(--spacing-md) 0;
            box-shadow: var(--shadow);
        }

        .team-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: var(--spacing-md);
        }

        .club-logo {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 2px solid var(--primary-color);
            object-fit: cover;
        }

        .club-title {
            font-size: var(--font-lg);
            font-weight: 700;
            color: var(--primary-color);
            margin-left: var(--spacing-sm);
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: var(--spacing-sm);
        }

        .stats-item {
            background: var(--bg-white);
            border-radius: var(--border-radius);
            padding: var(--spacing-sm);
            text-align: center;
            box-shadow: var(--shadow);
            border: 1px solid #e9ecef;
            transition: transform 0.2s ease;
        }

        .stats-item:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
        }

        .stats-item.matches { background: linear-gradient(135deg, var(--primary-color), #40c4ff); color: #fff; }
        .stats-item.wins { background: linear-gradient(135deg, #28a745, #66bb6a); color: #fff; }
        .stats-item.losses { background: linear-gradient(135deg, #dc3545, #ef5350); color: #fff; }

        .stats-title {
            font-size: var(--font-xs);
            text-transform: uppercase;
            font-weight: 500;
        }

        .stats-value {
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 3px;
        }

        .link-bar {
            display: flex;
            gap: var(--spacing-xs);
            overflow-x: auto;
            padding: var(--spacing-sm) 0;
            margin-bottom: var(--spacing-md);
            scrollbar-width: none;
        }

        .link-bar::-webkit-scrollbar { display: none; }

        .link-bar a {
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 18px;
            background: var(--bg-light);
            color: var(--primary-color);
            font-size: var(--font-xs);
            font-weight: 500;
            white-space: nowrap;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .link-bar a:hover {
            background: var(--primary-color);
            color: #fff;
        }

        .section {
            background: var(--bg-white);
            border-radius: var(--border-radius);
            padding: var(--spacing-md);
            margin-bottom: var(--spacing-md);
            box-shadow: var(--shadow);
        }

        .section h2, .tm-section-title {
            font-size: var(--font-lg);
            font-weight: 700;
            color: var(--primary-color);
            text-align: center;
            margin-bottom: var(--spacing-sm);
        }

        .team-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--spacing-sm);
        }

        .info-card {
            background: var(--bg-light);
            border-radius: var(--border-radius);
            padding: var(--spacing-sm);
            display: flex;
            align-items: center;
            gap: var(--spacing-xs);
            border: 1px solid #e9ecef;
            transition: transform 0.2s ease;
        }

        .info-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
        }

        .info-card i {
            font-size: 1.1rem;
            color: var(--primary-color);
        }

        .info-card p {
            margin: 0;
            font-size: var(--font-sm);
            color: var(--text-dark);
        }

        .opposition-team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: var(--spacing-sm);
        }

        .opposition-team-card {
            background: var(--bg-light);
            border-radius: var(--border-radius);
            padding: var(--spacing-sm);
            display: flex;
            align-items: center;
            gap: var(--spacing-xs);
            box-shadow: var(--shadow);
            text-decoration: none;
            color: var(--text-dark);
            transition: transform 0.2s ease, background-color 0.2s ease;
        }

        .opposition-team-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
            background: #e9ecef;
        }

        .opposition-team-card img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 2px solid var(--primary-color);
            object-fit: cover;
        }

        .opposition-team-card p {
            margin: 0;
            font-size: var(--font-sm);
            font-weight: 500;
        }

        .opposition-team-card .city-name {
            color: var(--secondary-color);
            font-size: var(--font-xs);
            font-weight: 600;
        }

        .tm-schedule-card {
            background: var(--bg-light);
            border-radius: var(--border-radius);
            padding: var(--spacing-sm);
            margin-bottom: var(--spacing-sm);
            box-shadow: var(--shadow);
        }

        .tm-match-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            overflow-x: auto;
        }

        .tm-team {
            display: flex;
            align-items: center;
            gap: var(--spacing-xs);
            min-width: 100px;
        }

        .tm-team img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 2px solid var(--primary-color);
            object-fit: cover;
        }

        .tm-team p {
            font-size: var(--font-sm);
            font-weight: 500;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .tm-vs {
            font-size: var(--font-sm);
            font-weight: 600;
            color: var(--secondary-color);
        }

        .tm-match-details {
            text-align: center;
            margin-top: var(--spacing-xs);
            font-size: var(--font-xs);
            color: var(--text-muted);
        }

        .tm-match-details span {
            margin: 0 4px;
        }

        .performer-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: var(--spacing-sm);
        }

        .player-card {
            background: var(--bg-white);
            border-radius: var(--border-radius);
            padding: var(--spacing-sm);
            text-align: center;
            box-shadow: var(--shadow);
            transition: transform 0.2s ease;
        }

        .player-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
        }

        .player-card.bowler { background: linear-gradient(135deg, #0288d1, #4fc3f7); color: #fff; }
        .player-card.batsman { background: linear-gradient(135deg, #d81b60, #f06292); color: #fff; }

        .player-card h4 {
            font-size: var(--font-sm);
            font-weight: 600;
            margin-bottom: var(--spacing-xs);
        }

        .player-image, .captain-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid var(--primary-color);
            object-fit: cover;
            margin: 0 auto var(--spacing-xs);
        }

        .captain-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: var(--spacing-sm);
        }

        .captain-card {
            background: var(--bg-light);
            border-radius: var(--border-radius);
            padding: var(--spacing-sm);
            text-align: center;
            box-shadow: var(--shadow);
            transition: transform 0.2s ease;
        }

        .captain-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
        }

        .captain-card h4 {
            font-size: var(--font-sm);
            color: var(--primary-color);
            margin-bottom: var(--spacing-xs);
        }

        .league-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: var(--spacing-sm);
        }

        .league-card {
            background: var(--bg-light);
            border-radius: var(--border-radius);
            padding: var(--spacing-sm);
            text-align: center;
            box-shadow: var(--shadow);
            transition: transform 0.2s ease;
        }

        .league-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
        }

        .league-card a {
            text-decoration: none;
            color: var(--text-dark);
            font-size: var(--font-sm);
            font-weight: 500;
        }

        .management-list {
            list-style: none;
            display: grid;
            gap: var(--spacing-xs);
        }

        .management-member {
            background: var(--bg-light);
            border-radius: var(--border-radius);
            padding: var(--spacing-sm);
            display: flex;
            align-items: center;
            gap: var(--spacing-xs);
            box-shadow: var(--shadow);
        }

        .management-member i {
            font-size: 1.1rem;
            color: var(--secondary-color);
        }

        .management-member p {
            margin: 0;
            font-size: var(--font-sm);
            color: var(--text-dark);
        }

        .tm-footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: var(--bg-white);
            padding: var(--spacing-xs) 0;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .tm-footer-nav {
            display: flex;
            justify-content: space-around;
            max-width: 500px;
            margin: 0 auto;
        }

        .tm-footer-nav a {
            color: var(--text-dark);
            text-decoration: none;
            font-size: var(--font-xs);
            font-weight: 500;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3px;
            padding: var(--spacing-xs);
            transition: color 0.2s ease;
        }

        .tm-footer-nav a i {
            font-size: 1.1rem;
        }

        .tm-footer-nav a.active {
            color: var(--primary-color);
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .container { padding: var(--spacing-xs); }
            .header-container, .section { padding: var(--spacing-sm); margin: var(--spacing-sm) 0; }
            .club-title { font-size: 1.3rem; }
            .stats-container { grid-template-columns: repeat(auto-fit, minmax(90px, 1fr)); }
            .stats-item { padding: var(--spacing-xs); }
            .stats-title { font-size: 0.75rem; }
            .stats-value { font-size: 1rem; }
            .team-info-grid, .opposition-team-grid, .performer-row, .captain-cards, .league-grid {
                grid-template-columns: 1fr;
            }
            .info-card, .opposition-team-card, .tm-schedule-card, .league-card, .management-member {
                padding: var(--spacing-xs);
            }
            .info-card p, .opposition-team-card p, .league-card a, .management-member p {
                font-size: var(--font-xs);
            }
            .opposition-team-card .city-name { font-size: 0.7rem; }
            .section h2, .tm-section-title { font-size: 1.3rem; }
            .tm-footer-nav a { font-size: 0.7rem; padding: 5px; }
            .tm-footer-nav a i { font-size: 1rem; }
        }

        @media (max-width: 480px) {
            .club-logo, .opposition-team-card img, .tm-team img { width: 32px; height: 32px; }
            .player-image, .captain-image { width: 45px; height: 45px; }
            .club-title { font-size: 1.1rem; }
            .stats-item { min-width: 75px; }
            .section h2, .tm-section-title { font-size: 1.2rem; }
            .tm-footer-nav a { font-size: 0.65rem; }
            .tm-footer-nav a i { font-size: 0.9rem; }
        }

        @media (min-width: 1200px) {
            .team-info-grid { grid-template-columns: repeat(3, 1fr); }
            .opposition-team-grid { grid-template-columns: repeat(4, 1fr); }
            .performer-row, .captain-cards { grid-template-columns: repeat(3, 1fr); }
            .league-grid { grid-template-columns: repeat(3, 1fr); }
            .stats-container { grid-template-columns: repeat(3, 1fr); }
            .club-title { font-size: 1.7rem; }
            .section h2, .tm-section-title { font-size: 1.8rem; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-container">
            <div class="team-header">
                <div class="d-flex align-items-center">
                    <img src="<?php echo htmlspecialchars($data['image_path'] ?? 'default_logo.png'); ?>" alt="Cricket Club Logo" class="club-logo" loading="lazy">
                    <div class="club-title"><?php echo htmlspecialchars($data['team_name'] ?? 'Team Name'); ?></div>
                </div>
            </div>
            <div class="stats-container">
                <div class="stats-item matches">
                    <div class="stats-title">Matches</div>
                    <div class="stats-value"><?php echo htmlspecialchars($team_stats['total_matches'] ?? '0'); ?></div>
                </div>
                <div class="stats-item wins">
                    <div class="stats-title">Wins</div>
                    <div class="stats-value"><?php echo htmlspecialchars($team_stats['win_matches'] ?? '0'); ?></div>
                </div>
                <div class="stats-item losses">
                    <div class="stats-title">Losses</div>
                    <div class="stats-value"><?php echo htmlspecialchars($team_stats['lost_matches'] ?? '0'); ?></div>
                </div>
            </div>
        </div>

        <?php if ($this->session->flashdata('message')): ?>
            <div class="alert alert-<?php echo htmlspecialchars($this->session->flashdata('message_type')); ?> text-center">
                <?php echo htmlspecialchars($this->session->flashdata('message')); ?>
            </div>
        <?php endif; ?>

        <div class="link-bar">
            <?php if ($this->session->userdata('user_id') == $data['user_id']): ?>
                <a href="<?php echo base_url(); ?>Welcome/team_admin/<?php echo htmlspecialchars($data['team_id']); ?>">Dashboard</a>
            <?php endif; ?>
            <a href="<?php echo base_url(); ?>TeamController/team_schedule/<?php echo htmlspecialchars($data['team_id']); ?>">View Schedule</a>
            <a href="<?php echo base_url(); ?>TeamController/team_squad/<?php echo htmlspecialchars($data['team_id']); ?>">Squad</a>
        </div>

        <section class="section recent-matches-section">
            <h2>Match Results</h2>
            <?php if (empty($matches)): ?>
                <div class="alert alert-info text-center">No match results available for this team.</div>
            <?php else: ?>
                <ul class="list-group">
                    <?php foreach ($matches as $match):
                        $is_home_team = ($data['team_id'] == $match->win_team_id || $data['team_id'] == $match->lost_team_id);
                        $is_winner = ($data['team_id'] == $match->win_team_id);
                        $opponent = ($data['team_id'] == $match->win_team_id) ? htmlspecialchars($match->lost_team_name) : htmlspecialchars($match->win_team_name);
                    ?>
                        <a href="<?php echo base_url(); ?>Welcome/scorecard/<?php echo htmlspecialchars($match->win_team_id); ?>/<?php echo htmlspecialchars($match->lost_team_id); ?>/<?php echo htmlspecialchars($match->match_id); ?>" class="text-decoration-none">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <?php echo date('d M Y', strtotime($match->match_date)); ?>: 
                                    vs <?php echo $opponent; ?> - 
                                    <?php echo htmlspecialchars($match->result_statement); ?>
                                </div>
                                <span class="badge bg-<?php echo $is_winner ? 'success' : 'danger'; ?>">
                                    <?php echo $is_winner ? 'W' : 'L'; ?>
                                </span>
                            </li>
                        </a>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>

        <section class="section tm-section">
            <h2 class="tm-section-title">Match Schedule</h2>
            <?php if (empty($team_schedule)): ?>
                <p class="text-center text-muted">No match is added yet</p>
            <?php else: ?>
                <div class="tm-schedule-container">
                    <?php foreach ($team_schedule as $value): ?>
                        <div class="tm-schedule-card">
                            <div class="tm-match-header">
                                <div class="tm-team">
                                    <img src="<?php echo htmlspecialchars($value->team_one_image ?? 'default_team.png'); ?>" alt="<?php echo htmlspecialchars($value->team_one_name ?? 'Team 1'); ?> Logo" loading="lazy">
                                    <p><?php echo htmlspecialchars($value->team_one_name ?? 'Team 1'); ?></p>
                                </div>
                                <span class="tm-vs">VS</span>
                                <div class="tm-team">
                                    <img src="<?php echo htmlspecialchars($value->team_two_image ?? 'default_team.png'); ?>" alt="<?php echo htmlspecialchars($value->team_two_name ?? 'Team 2'); ?> Logo" loading="lazy">
                                    <p><?php echo htmlspecialchars($value->team_two_name ?? 'Team 2'); ?></p>
                                </div>
                            </div>
                            <div class="tm-match-details">
                                <?php
                                $date = $value->match_date;
                                $formatted_date = date("M d, Y", strtotime($date));
                                ?>
                                <span><?php echo htmlspecialchars($formatted_date); ?></span> |
                                <span><?php echo htmlspecialchars(date("g:i A", strtotime($value->match_time ?? '00:00'))); ?></span> |
                                <span><?php echo htmlspecialchars($value->location ?? 'TBD'); ?></span> |
                                <span><?php echo htmlspecialchars($value->series ?? 'N/A'); ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>

        <section class="section top-performers-section">
            <h2>Player of the Team</h2>
            <?php if ($top_performers['top_bowler']['playerName'] === 'N/A' && $top_performers['top_batsman']['playerName'] === 'N/A'): ?>
                <p class="text-center text-muted">No performance data available yet.</p>
            <?php else: ?>
                <div class="performer-row">
                    <div class="player-card bowler">
                        <h4>Leading Wicket-Taker</h4>
                        <img src="<?php echo htmlspecialchars($top_performers['top_bowler']['image_path']); ?>" alt="Top Bowler" class="player-image" loading="lazy">
                        <p><?php echo htmlspecialchars($top_performers['top_bowler']['playerName']); ?></p>
                        <p><?php echo htmlspecialchars($top_performers['top_bowler']['total_wickets']); ?> wickets</p>
                    </div>
                    <div class="player-card batsman">
                        <h4>Leading Batsman</h4>
                        <img src="<?php echo htmlspecialchars($top_performers['top_batsman']['image_path']); ?>" alt="Top Batsman" class="player-image" loading="lazy">
                        <p><?php echo htmlspecialchars($top_performers['top_batsman']['playerName']); ?></p>
                        <p><?php echo htmlspecialchars($top_performers['top_batsman']['total_runs']); ?> runs</p>
                    </div>
                </div>
            <?php endif; ?>
        </section>

        <section class="section team-info-section">
            <h2>Team Information</h2>
            <div class="team-info-grid">
                <div class="info-card">
                    <i class="fas fa-city" aria-label="City"></i>
                    <p><strong>City:</strong> <?php echo htmlspecialchars($data['city'] ?? 'N/A'); ?></p>
                </div>
                <div class="info-card">
                    <i class="fas fa-globe" aria-label="Country"></i>
                    <p><strong>Country:</strong> <?php echo htmlspecialchars($data['country'] ?? 'N/A'); ?></p>
                </div>
                <div class="info-card">
                    <i class="fas fa-calendar-alt" aria-label="Joining Date"></i>
                    <p><strong>Joining Date:</strong> <?php echo htmlspecialchars($data['created_at'] ?? 'N/A'); ?></p>
                </div>
                <div class="info-card">
                    <i class="fas fa-stadium" aria-label="Home Ground"></i>
                    <p><strong>Home Ground:</strong> <?php echo htmlspecialchars($data['home_ground'] ?? 'N/A'); ?></p>
                </div>
                <div class="info-card">
                    <i class="fas fa-envelope" aria-label="Admin Email"></i>
                    <p><strong>Admin Email:</strong> <?php echo htmlspecialchars($data['email'] ?? 'N/A'); ?></p>
                </div>
                <div class="info-card">
                    <i class="fas fa-phone" aria-label="Admin Phone"></i>
                    <p><strong>Admin Phone:</strong> <?php echo htmlspecialchars($data['phone_number'] ?? 'N/A'); ?></p>
                </div>
            </div>
        </section>

        <section class="section current-captain-section">
            <h2>Current Captain</h2>
            <div class="captain-cards">
                <?php
                $types = ['leather_ball' => 'Leather Ball', 'tape_ball' => 'Tape Ball', 'tennis_ball' => 'Tennis Ball'];
                foreach ($types as $key => $label): ?>
                    <div class="captain-card">
                        <h4><?php echo htmlspecialchars($label); ?></h4>
                        <?php if ($captain[$key]['status'] === 0): ?>
                            <p>Not added yet</p>
                        <?php else: ?>
                            <img src="<?php echo htmlspecialchars($captain[$key]['image_path'] ?? 'default_captain.png'); ?>" alt="<?php echo htmlspecialchars($label); ?> Captain" class="captain-image" loading="lazy">
                            <p><?php echo htmlspecialchars($captain[$key]['playerName'] ?? 'N/A'); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="section opposition-team-section">
            <h2>Opposition Team</h2>
            <?php if ($opposition_team['status'] == 'error'): ?>
                <p class="text-center text-muted"><?php echo htmlspecialchars($opposition_team['message']); ?></p>
            <?php else: ?>
                <div class="opposition-team-grid">
                    <?php foreach ($opposition_team['data'] as $team): ?>
                        <a href="<?php echo base_url(); ?>TeamController/team_profile/<?php echo htmlspecialchars($team->team_one_id); ?>" class="opposition-team-card" aria-label="View profile of <?php echo htmlspecialchars($team->team_one_name); ?>">
                            <img src="<?php echo htmlspecialchars($team->team_one_image ?? 'default_team.png'); ?>" alt="<?php echo htmlspecialchars($team->team_one_name); ?> Logo" loading="lazy">
                            <div>
                                <p><?php echo htmlspecialchars($team->team_one_name); ?></p>
                                <p class="city-name">Opposition Team</p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>

        <section class="section league-section">
            <h2>Leagues Participated</h2>
            <?php if (!empty($league_playing)): ?>
                <div class="league-grid">
                    <?php foreach ($league_playing as $league): ?>
                        <div class="league-card">
                            <a href="<?php echo base_url('Welcome/tournament_landing/' . ($league->slug ?? $league->league_id)); ?>">
                                <?php echo htmlspecialchars($league->league_name); ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-center text-muted">This team is not currently participating in any leagues.</p>
            <?php endif; ?>
        </section>

        <section class="section management-section">
            <h2>Team Management</h2>
            <ul class="management-list">
                <?php if (!empty($team_management)): ?>
                    <?php foreach ($team_management as $staff): ?>
                        <li class="management-member">
                            <i class="fas fa-user-tie" aria-label="Management Member"></i>
                            <p><strong><?php echo htmlspecialchars($staff->role); ?>:</strong> <?php echo htmlspecialchars($staff->name); ?></p>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="management-member">
                        <p class="text-muted">No team management members found.</p>
                    </li>
                <?php endif; ?>
            </ul>
        </section>
    </div>

    <footer class="tm-footer">
        <div class="tm-footer-nav">
            <a href="<?php echo base_url(); ?>Welcome/landing_page" class="<?php echo current_url() == base_url('Welcome/landing_page') ? 'active' : ''; ?>">
                <i class="fas fa-home" aria-label="Home"></i>
                <span>Home</span>
            </a>
            <?php if ($this->session->userdata('user_id') == $data['user_id']): ?>
                <a href="<?php echo base_url(); ?>Welcome/team_admin/<?php echo htmlspecialchars($data['team_id']); ?>" class="<?php echo strpos(current_url(), 'team_admin') !== false ? 'active' : ''; ?>">
                    <i class="fas fa-tachometer-alt" aria-label="Dashboard"></i>
                    <span>Dashboard</span>
                </a>
            <?php endif; ?>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>