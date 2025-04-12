<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cricket Club</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Section */
        .header-container {
            display: flex;
            flex-direction: column;
            padding: 15px;
            margin: 15px 0;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .team-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .club-logo {
            max-width: 60px;
            border-radius: 50%;
            border: 2px solid #007bff;
            transition: transform 0.3s ease;
        }

        .club-logo:hover {
            transform: scale(1.1);
        }

        .club-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #007bff;
            margin-left: 10px;
        }

        .stats-container {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .stats-item {
            background: linear-gradient(135deg, #ffffff, #e9ecef);
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
            font-weight: 600;
            flex: 1;
            min-width: 100px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stats-item.matches {
            background: linear-gradient(135deg, #007bff, #00c4ff);
            color: #fff;
        }

        .stats-item.wins {
            background: linear-gradient(135deg, #28a745, #4caf50);
            color: #fff;
        }

        .stats-item.losses {
            background: linear-gradient(135deg, #dc3545, #ff5252);
            color: #fff;
        }

        .stats-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .stats-title {
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stats-value {
            font-size: 1.5rem;
            margin-top: 5px;
        }

        /* Link Bar */
        .link-bar {
            display: flex;
            overflow-x: auto;
            gap: 10px;
            padding: 10px 0;
            margin-bottom: 20px;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .link-bar::-webkit-scrollbar {
            display: none;
        }

        .link-bar a {
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 20px;
            background-color: #f8f9fa;
            color: #007bff;
            font-size: 0.8rem;
            font-weight: 500;
            white-space: nowrap;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .link-bar a:hover {
            background-color: #007bff;
            color: #fff;
        }

        .link-bar a.join-tournament {
            background-color: #ff5722;
            color: #fff;
        }

        .link-bar a.join-tournament:hover {
            background-color: #e64a19;
        }

        .link-bar a.invite-team {
            background-color: #28a745;
            color: #fff;
        }

        .link-bar a.invite-team:hover {
            background-color: #218838;
        }

        .link-bar a.match-request {
            background-color: #dc3545;
            color: #fff;
        }

        .link-bar a.match-request:hover {
            background-color: #c82333;
        }

        .link-bar a.player-request {
            background-color: #ffc107;
            color: #000;
        }

        .link-bar a.player-request:hover {
            background-color: #e0a800;
        }

        /* Team Information Section */
        .team-info-section {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .team-info-section h2 {
            font-size: 1.6rem;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 20px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .team-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .info-card {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 10px;
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #dee2e6;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .info-card i {
            font-size: 1.5rem;
            color: #007bff;
        }

        .info-card p {
            margin: 0;
            font-size: 0.9rem;
            color: #333;
        }

        .info-card .team-admin-email {
            color: #007bff;
        }

        .info-card .team-admin-phone {
            color: #28a745;
        }

        /* Team Management Section */
        .management-section {
            background: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .management-section h3 {
            font-size: 1.4rem;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 15px;
            text-align: center;
        }

        .management-list {
            list-style: none;
            padding: 0;
        }

        .management-member {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .management-member:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .management-member i {
            font-size: 1.2rem;
            color: #ff5722;
        }

        .management-member p {
            margin: 0;
            font-size: 0.9rem;
            font-weight: 500;
            color: #333;
        }

        /* Top Performers Section */
        .top-performers-section {
            background: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .top-performers-section h3 {
            font-size: 1.4rem;
            font-weight: 600;
            color: #ff5722;
            margin-bottom: 15px;
            text-align: center;
        }

        .performer-row {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .player-card {
            background: linear-gradient(135deg, #fff, #e3f2fd);
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            font-size: 0.9rem;
            flex: 1;
            min-width: 140px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }

        .player-card.bowler {
            background: linear-gradient(135deg, #0288d1, #4fc3f7);
            color: #fff;
        }

        .player-card.batsman {
            background: linear-gradient(135deg, #d81b60, #f06292);
            color: #fff;
        }

        .player-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .player-card h4 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .player-image {
            max-width: 80px;
            border-radius: 50%;
            border: 3px solid #007bff;
            transition: transform 0.3s ease;
            margin-bottom: 10px;
        }

        .player-image:hover {
            transform: scale(1.1);
        }

        .player-stats {
            font-size: 1rem;
            font-weight: 600;
            margin: 5px 0;
        }

        /* Recent Match Results Section */
        .recent-matches-section {
            background: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .recent-matches-section h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 15px;
            text-align: center;
        }

        .list-group-item {
            font-size: 0.9rem;
            padding: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .list-group-item:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .badge {
            font-size: 0.9rem;
        }

        /* Flash message container */
        .flashdata-message {
            font-family: Arial, sans-serif;
            font-size: 16px;
            margin: 10px 0;
            padding: 15px;
            border-radius: 5px;
        }

        .flashdata-message.success {
            background-color: #28a745;
            color: white;
        }

        .flashdata-message.error {
            background-color: #dc3545;
            color: white;
        }

        /* Current Captain Section */
        .current-captain-section {
            background: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .current-captain-section h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 15px;
            text-align: center;
        }

        .captain-cards {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .captain-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            font-size: 0.9rem;
            flex: 1;
            min-width: 120px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .captain-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .captain-card h4 {
            font-size: 1.1rem;
            color: #007bff;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .captain-image {
            max-width: 80px;
            border-radius: 50%;
            border: 3px solid #007bff;
            transition: transform 0.3s ease;
        }

        .captain-image:hover {
            transform: scale(1.1);
        }

        /* Match Schedule Section */
        .tm-section {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .tm-section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 20px;
            text-align: center;
        }

        .tm-empty-state {
            text-align: center;
            color: #6c757d;
            font-style: italic;
            font-size: 1rem;
        }

        .tm-schedule-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .tm-schedule-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .tm-match-header {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            align-items: center;
            justify-content: center;
            gap: 20px;
            overflow-x: auto;
            padding: 5px;
        }

        .tm-team {
            display: flex;
            align-items: center;
            gap: 10px;
            text-align: left;
            max-width: 200px;
            min-width: 120px;
        }

        .tm-team img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #007bff;
            flex-shrink: 0;
        }

        .tm-team p {
            font-size: 0.9rem;
            font-weight: 500;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .tm-vs {
            font-size: 1rem;
            font-weight: 600;
            color: #ff5722;
            flex-shrink: 0;
        }

        .tm-match-details {
            text-align: center;
            margin-top: 10px;
            font-size: 0.9rem;
            color: #333;
        }

        .tm-match-details span {
            margin: 0 5px;
        }

        /* Responsive adjustments */
        @media (min-width: 768px) {
            .header-container {
                flex-direction: column;
                align-items: stretch;
            }

            .team-header {
                justify-content: flex-start;
                margin-bottom: 15px;
            }

            .stats-container {
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .club-title {
                font-size: 1.4rem;
            }

            .stats-item {
                min-width: 90px;
                padding: 10px;
            }

            .stats-title {
                font-size: 0.9rem;
            }

            .stats-value {
                font-size: 1.2rem;
            }

            .player-card, .captain-card {
                min-width: 100px;
            }

            .player-image, .captain-image {
                max-width: 60px;
            }

            .team-info-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header-container">
            <div class="team-header">
                <div class="d-flex align-items-center">
                    <img src="<?php echo htmlspecialchars($data['image_path'] ?? 'default_logo.png'); ?>" alt="Cricket Club Logo" class="club-logo">
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
            <div class="flashdata-message <?php echo htmlspecialchars($this->session->flashdata('message_type')); ?>">
                <?php echo htmlspecialchars($this->session->flashdata('message')); ?>
            </div>
        <?php endif; ?>

        <!-- Horizontal Link Bar -->
        <div class="link-bar">
            <?php if ($this->session->userdata('user_id') == $data['user_id']): ?>
                <a href="<?php echo base_url(); ?>Welcome/team_admin/<?php echo htmlspecialchars($data['team_id']); ?>" class="dashboard">Dashboard</a>
            <?php endif; ?>
            <a href="<?php echo base_url(); ?>TeamController/team_schedule/<?php echo htmlspecialchars($data['team_id']); ?>">View Schedule</a>
            <a href="<?php echo base_url(); ?>TeamController/team_squad/<?php echo htmlspecialchars($data['team_id']); ?>">Squad</a>
        </div>

        <!-- Team Information Section -->
        <section class="team-info-section">
            <h2>Team Information</h2>
            <div class="team-info-grid">
                <div class="info-card">
                    <i class="fas fa-city"></i>
                    <p><strong>City:</strong> <?php echo htmlspecialchars($data['city'] ?? 'N/A'); ?></p>
                </div>
                <div class="info-card">
                    <i class="fas fa-globe"></i>
                    <p><strong>Country:</strong> <?php echo htmlspecialchars($data['country'] ?? 'N/A'); ?></p>
                </div>
                <div class="info-card">
                    <i class="fas fa-calendar-alt"></i>
                    <p><strong>Joining Date:</strong> <?php echo htmlspecialchars($data['created_at'] ?? 'N/A'); ?></p>
                </div>
                <div class="info-card">
                    <i class="fas fa-stadium"></i>
                    <p><strong>Home Ground:</strong> <?php echo htmlspecialchars($data['home_ground'] ?? 'N/A'); ?></p>
                </div>
                <div class="info-card">
                    <i class="fas fa-envelope team-admin-email"></i>
                    <p><strong>Admin Email:</strong> <span class="team-admin-email"><?php echo htmlspecialchars($data['email'] ?? 'N/A'); ?></span></p>
                </div>
                <div class="info-card">
                    <i class="fas fa-phone team-admin-phone"></i>
                    <p><strong>Admin Phone:</strong> <span class="team-admin-phone"><?php echo htmlspecialchars($data['phone_number'] ?? 'N/A'); ?></span></p>
                </div>
            </div>
        </section>

        <!-- Current Captain Section -->
        <section class="current-captain-section">
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
                            <img src="<?php echo htmlspecialchars($captain[$key]['image_path'] ?? 'default_captain.png'); ?>" alt="<?php echo htmlspecialchars($label); ?> Captain" class="captain-image">
                            <p><?php echo htmlspecialchars($captain[$key]['playerName'] ?? 'N/A'); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Team Management and Top Performers Section -->
        <div class="row my-3">
            <div class="col-md-6">
                <div class="management-section">
                    <h3>Team Management</h3>
                    <ul class="management-list">
                        <li class="management-member">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <p><strong>Coach:</strong> Michael Smith</p>
                        </li>
                        <li class="management-member">
                            <i class="fas fa-user-tie"></i>
                            <p><strong>Assistant Coach:</strong> Sarah Johnson</p>
                        </li>
                        <li class="management-member">
                            <i class="fas fa-briefcase"></i>
                            <p><strong>Manager:</strong> David Brown</p>
                        </li>
                        <li class="management-member">
                            <i class="fas fa-user-nurse"></i>
                            <p><strong>Assistant:</strong> Emily Davis</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="top-performers-section">
                    <h3>Player of the Team</h3>
                    <div class="performer-row">
                        <div class="player-card bowler">
                            <h4>Leading Wicket-Taker</h4>
                            <img src="best_bowler.jpg" alt="Best Bowler" class="player-image">
                            <p>John Doe</p>
                            <p class="player-stats">120 wickets</p>
                        </div>
                        <div class="player-card batsman">
                            <h4>Leading Batsman</h4>
                            <img src="best_batsman.jpg" alt="Best Batsman" class="player-image">
                            <p>Jane Smith</p>
                            <p class="player-stats">3,200 runs</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Match Schedule Section -->
        <section class="tm-section">
            <h3 class="tm-section-title">Match Schedule</h3>
            <?php if (empty($team_schedule)): ?>
                <p class="tm-empty-state">No match is added yet</p>
            <?php else: ?>
                <div class="tm-schedule-container">
                    <?php foreach ($team_schedule as $value): ?>
                        <div class="tm-schedule-card">
                            <div class="tm-match-header">
                                <div class="tm-team">
                                    <img src="<?php echo htmlspecialchars($value->team_one_image ?? 'default_team.png'); ?>" alt="Team One Logo">
                                    <p><?php echo htmlspecialchars($value->team_one_name ?? 'Team 1'); ?></p>
                                </div>
                                <span class="tm-vs">VS</span>
                                <div class="tm-team">
                                    <img src="<?php echo htmlspecialchars($value->team_two_image ?? 'default_team.png'); ?>" alt="Team Two Logo">
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

        <!-- Recent Match Results Section -->
        <section class="recent-matches-section">
            <h2>Recent Matches</h2>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Match 1: Cricket Club vs Rivals - Won by 20 runs
                    <span class="badge bg-success">W</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Match 2: Cricket Club vs Challengers - Lost by 5 wickets
                    <span class="badge bg-danger">L</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Match 3: Cricket Club vs Warriors - Won by 8 wickets
                    <span class="badge bg-success">W</span>
                </li>
            </ul>
        </section>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>