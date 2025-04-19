<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Team Management Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3498db;
            --primary-hover: #2980b9;
            --success-color: #2ecc71;
            --success-hover: #27ae60;
            --danger-color: #e74c3c;
            --danger-hover: #c0392b;
            --warning-color: #f39c12;
            --warning-hover: #e67e22;
            --text-color: #333;
            --light-text: #666;
            --lighter-text: #999;
            --border-color: #e1e1e1;
            --card-bg: #fff;
            --section-bg: #f9f9f9;
            --external-color: #8e44ad;
            --external-hover: #7d3c98;
            --internal-color: #16a085;
            --internal-hover: #138a72;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.1);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
            --radius-sm: 6px;
            --radius-md: 8px;
            --transition: all 0.2s ease;
            --score-color: #1abc9c;
            --score-hover: #16a085;
            --edit-color: #f1c40f;
            --edit-hover: #e67e22;
            --view-color: #3498db;
            --view-hover: #2980b9;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: var(--text-color);
            font-size: 15px;
            line-height: 1.5;
            background-color: #f5f5f5;
            -webkit-font-smoothing: antialiased;
        }

        .tm-container {
            max-width: 100%;
            margin: 0 auto;
            padding: 10px;
        }

        .tm-header {
            background-color: var(--card-bg);
            padding: 15px;
            border-radius: var(--radius-md);
            margin-bottom: 12px;
            box-shadow: var(--shadow-sm);
            border-left: 4px solid var(--primary-color);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .tm-header-logo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
            box-shadow: var(--shadow-sm);
        }

        .tm-header-content {
            flex: 1;
            min-width: 0;
        }

        .tm-header h1 {
            font-size: 1.5em;
            margin: 0;
            color: var(--text-color);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-weight: 600;
        }

        .tm-header p {
            font-size: 0.9em;
            color: var(--light-text);
            margin: 5px 0 0;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .tm-header p i {
            font-size: 0.9em;
        }

        .tm-social-links {
            display: flex;
            gap: 10px;
            margin-top: 8px;
        }

        .tm-social-link {
            color: var(--light-text);
            font-size: 1.1em;
            transition: var(--transition);
        }

        .tm-social-link:hover {
            color: var(--primary-color);
        }

        .tm-nav-container {
            position: sticky;
            top: 0;
            background: white;
            z-index: 100;
            padding: 8px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            margin-bottom: 12px;
        }

        .tm-nav {
            display: flex;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            padding: 5px 0;
        }

        .tm-nav::-webkit-scrollbar {
            display: none;
        }

        .tm-nav-item {
            flex: 0 0 auto;
            padding: 8px 14px;
            margin: 0 5px;
            font-size: 14px;
            color: var(--text-color);
            text-decoration: none;
            border-radius: 20px;
            background-color: #f0f0f0;
            white-space: nowrap;
            transition: var(--transition);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .tm-nav-item i {
            font-size: 14px;
        }

        .tm-nav-item.active, .tm-nav-item:hover {
            background-color: var(--primary-color);
            color: white;
            box-shadow: var(--shadow-sm);
        }

        .external-link {
            background-color: var(--external-color);
            color: white;
        }

        .external-link:hover {
            background-color: var(--external-hover);
        }

        .internal-link {
            background-color: var(--internal-color);
            color: white;
        }

        .internal-link:hover {
            background-color: var(--internal-hover);
        }

        .tm-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 18px;
            height: 18px;
            background: var(--danger-color);
            color: white;
            font-size: 11px;
            padding: 0 5px;
            border-radius: 10px;
            margin-left: 5px;
            font-weight: bold;
        }

        .tm-section {
            background: var(--card-bg);
            border-radius: var(--radius-md);
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: var(--shadow-sm);
            border-top: 1px solid rgba(0,0,0,0.03);
        }

        .tm-section-title {
            font-size: 1.2em;
            margin: 0 0 15px;
            color: var(--text-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--border-color);
        }

        .tm-section-title .tm-btn {
            font-size: 0.85em;
            padding: 5px 10px;
        }

        .tm-card {
            display: grid;
            grid-template-columns: 45px 1fr auto;
            gap: 10px;
            align-items: center;
            padding: 10px;
            margin-bottom: 8px;
            border-radius: var(--radius-sm);
            background-color: var(--section-bg);
            transition: var(--transition);
            border: 1px solid rgba(0,0,0,0.05);
        }

        .tm-card:hover {
            box-shadow: var(--shadow-sm);
            transform: translateY(-2px);
        }

        .tm-card-img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
            box-shadow: var(--shadow-sm);
        }

        .tm-card-content {
            overflow: hidden;
        }

        .tm-card-content h4 {
            margin: 0;
            font-size: 14px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-weight: 500;
        }

        .tm-card-content p {
            margin: 3px 0 0;
            font-size: 13px;
            color: var(--light-text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .tm-btn-group {
            display: flex;
            gap: 8px;
        }

        .tm-btn {
            padding: 7px 12px;
            font-size: 13px;
            border: none;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: var(--transition);
            white-space: nowrap;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .tm-btn i {
            font-size: 14px;
        }

        .tm-btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }

        .tm-btn-xs {
            padding: 4px 8px;
            font-size: 11px;
        }

        .tm-btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .tm-btn-primary:hover {
            background: var(--primary-hover);
            box-shadow: var(--shadow-sm);
        }

        .tm-btn-success {
            background: var(--success-color);
            color: white;
        }

        .tm-btn-success:hover {
            background: var(--success-hover);
            box-shadow: var(--shadow-sm);
        }

        .tm-btn-danger {
            background: var(--danger-color);
            color: white;
        }

        .tm-btn-danger:hover {
            background: var(--danger-hover);
            box-shadow: var(--shadow-sm);
        }

        .tm-btn-warning {
            background: var(--warning-color);
            color: white;
        }

        .tm-btn-warning:hover {
            background: var(--warning-hover);
            box-shadow: var(--shadow-sm);
        }

        .tm-btn-outline {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-color);
        }

        .tm-btn-outline:hover {
            background: rgba(0,0,0,0.03);
        }

        .tm-info-item {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px solid var(--border-color);
            align-items: center;
        }

        .tm-info-item:last-child {
            border-bottom: none;
        }

        .tm-info-item div {
            font-size: 14px;
        }

        .tm-info-item strong {
            font-weight: 500;
            color: var(--text-color);
        }

        .tm-captain-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
        }

        .tm-captain-card {
            text-align: center;
            padding: 15px;
            background: var(--section-bg);
            border-radius: var(--radius-md);
            border: 1px solid rgba(0,0,0,0.05);
            transition: var(--transition);
        }

        .tm-captain-card:hover {
            box-shadow: var(--shadow-sm);
            transform: translateY(-3px);
        }

        .tm-captain-card h4 {
            margin: 0 0 10px;
            font-size: 15px;
            font-weight: 500;
            color: var(--text-color);
        }

        .tm-captain-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 8px;
            border: 3px solid white;
            box-shadow: var(--shadow-sm);
        }

        .tm-captain-card p {
            margin: 5px 0;
            font-size: 14px;
            font-weight: 500;
        }

        .tm-empty-state {
            text-align: center;
            padding: 20px;
            color: var(--lighter-text);
            font-size: 14px;
        }

        .tm-schedule-card {
            background: var(--card-bg);
            border-radius: var(--radius-md);
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(0,0,0,0.05);
            transition: var(--transition);
        }

        .tm-schedule-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .tm-schedule-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .tm-schedule-teams {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
            min-width: 0;
        }

        .tm-schedule-team {
            display: flex;
            align-items: center;
            flex: 1;
            min-width: 0;
            position: relative;
        }

        .tm-schedule-team.your-team {
            font-weight: 600;
        }

        .tm-team-you {
            font-size: 11px;
            color: var(--primary-color);
            margin-left: 6px;
            white-space: nowrap;
        }

        .tm-schedule-team img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
            border: 2px solid white;
            flex-shrink: 0;
        }

        .tm-schedule-team span {
            font-size: 15px;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .tm-schedule-vs {
            margin: 0 8px;
            font-weight: bold;
            font-size: 14px;
            color: var(--light-text);
            flex-shrink: 0;
        }

        .tm-schedule-meta {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            font-size: 14px;
            flex-shrink: 0;
            min-width: 100px;
        }

        .tm-schedule-date {
            font-weight: 500;
            color: var(--text-color);
        }

        .tm-schedule-time {
            color: var(--light-text);
        }

        .tm-schedule-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 12px;
            flex-wrap: nowrap;
        }

        .tm-btn-vibrant {
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 20px;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.2s ease, background 0.2s ease;
            min-width: 80px;
            text-align: center;
        }

        .tm-btn-vibrant:hover {
            transform: scale(1.05);
        }

        .tm-btn-score {
            background: var(--score-color);
            color: white;
        }

        .tm-btn-score:hover {
            background: var(--score-hover);
        }

        .tm-btn-edit {
            background: var(--edit-color);
            color: white;
        }

        .tm-btn-edit:hover {
            background: var(--edit-hover);
        }

        .tm-btn-delete {
            background: var(--danger-color);
            color: white;
        }

        .tm-btn-delete:hover {
            background: var(--danger-hover);
        }

        .tm-btn-view {
            background: var(--view-color);
            color: white;
        }

        .tm-btn-view:hover {
            background: var(--view-hover);
        }

        .team-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .team-row {
            background: var(--section-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            padding: 12px;
            transition: var(--transition);
        }

        .team-row:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-sm);
        }

        .team-info {
            flex: 1;
            min-width: 0;
        }

        .team-info h3 {
            font-weight: 500;
            font-size: 14px;
            color: var(--text-color);
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .team-info p {
            font-weight: 400;
            font-size: 13px;
            color: var(--light-text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .insert-section {
            text-align: center;
            margin-bottom: 15px;
        }

        .insert-section .tm-btn, .team-row .tm-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--radius-sm);
            padding: 8px 16px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .insert-section .tm-btn:hover, .team-row .tm-btn:hover {
            background: var(--primary-hover);
            box-shadow: var(--shadow-sm);
        }

        .team-row .tm-btn-warning {
            background: var(--warning-color);
            padding: 5px 10px;
            font-size: 12px;
        }

        .team-row .tm-btn-warning:hover {
            background: var(--warning-hover);
        }

        .tm-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            border-radius: var(--radius-sm);
            color: white;
            font-size: 14px;
            z-index: 1000;
            animation: tmToastFadeIn 0.3s ease;
        }

        .tm-toast.success {
            background: var(--success-color);
        }

        .tm-toast.error {
            background: var(--danger-color);
        }

        @keyframes tmToastFadeIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* Modal Styles */
        .tm-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .tm-modal-content {
            background: var(--card-bg);
            border-radius: var(--radius-md);
            padding: 20px;
            max-width: 500px;
            width: 90%;
            box-shadow: var(--shadow-md);
            position: relative;
        }

        .tm-modal-close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 18px;
            color: var(--light-text);
            cursor: pointer;
            transition: var(--transition);
        }

        .tm-modal-close:hover {
            color: var(--danger-color);
        }

        .tm-modal-title {
            font-size: 1.3em;
            margin: 0 0 15px;
            color: var(--text-color);
            font-weight: 600;
        }

        .tm-form-group {
            margin-bottom: 15px;
        }

        .tm-form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--text-color);
        }

        .tm-form-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            transition: var(--transition);
            background: #fff;
        }

        .tm-form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }

        .tm-error {
            color: var(--danger-color);
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        .tm-modal-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        @media (min-width: 768px) {
            .tm-container {
                max-width: 900px;
                padding: 15px;
            }

            .tm-header {
                padding: 18px;
            }

            .tm-header h1 {
                font-size: 1.7em;
            }

            .tm-nav-item {
                padding: 8px 18px;
                margin: 0 8px;
                font-size: 15px;
            }

            .tm-section {
                padding: 18px;
                margin-bottom: 18px;
            }

            .tm-captain-grid {
                grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
                gap: 15px;
            }

            .tm-captain-card {
                padding: 18px;
            }

            .tm-schedule-card {
                padding: 20px;
            }

            .tm-schedule-team span {
                font-size: 16px;
            }

            .tm-schedule-meta {
                font-size: 15px;
            }

            .tm-btn-vibrant {
                padding: 8px 16px;
                font-size: 13px;
                min-width: 90px;
            }

            .tm-modal-content {
                padding: 25px;
            }
        }

        @media (max-width: 480px) {
            .tm-schedule-card {
                padding: 12px;
            }

            .tm-schedule-teams {
                gap: 6px;
            }

            .tm-schedule-team img {
                width: 32px;
                height: 32px;
            }

            .tm-schedule-team span {
                font-size: 14px;
            }

            .tm-schedule-vs {
                margin: 0 6px;
                font-size: 13px;
            }

            .tm-schedule-meta {
                font-size: 13px;
                min-width: 90px;
            }

            .tm-schedule-actions {
                gap: 8px;
            }

            .tm-btn-vibrant {
                padding: 5px 10px;
                font-size: 11px;
                min-width: 70px;
            }

            .tm-team-you {
                font-size: 10px;
                position: absolute;
                left: 42px;
                bottom: -12px;
            }

            .team-row {
                padding: 10px;
            }

            .team-info h3 {
                font-size: 13px;
            }

            .team-info p {
                font-size: 12px;
            }

            .team-row .tm-btn {
                font-size: 11px;
                padding: 4px 8px;
            }

            .insert-section .tm-btn {
                font-size: 12px;
                padding: 7px 14px;
            }

            .tm-toast {
                top: 10px;
                right: 10px;
                padding: 8px 15px;
                font-size: 13px;
            }

            .tm-modal-content {
                padding: 15px;
                width: 95%;
            }

            .tm-modal-title {
                font-size: 1.2em;
            }

            .tm-form-group input {
                font-size: 13px;
                padding: 8px;
            }

            .tm-modal-actions {
                flex-direction: column;
                gap: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="tm-container">
        <header class="tm-header">
            <img src="<?php echo $data['image_path']; ?>" alt="Team Logo" class="tm-header-logo">
            <div class="tm-header-content">
                <h1><?php echo htmlspecialchars($data['team_name']); ?></h1>
                <p><i class="fas fa-calendar-alt"></i> Est. <?php echo date('Y', strtotime($data['created_at'])); ?></p>
                <div class="tm-social-links">
                    <a href="#" class="tm-social-link" title="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="tm-social-link" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="tm-social-link" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="tm-social-link" title="Website"><i class="fas fa-globe"></i></a>
                </div>
            </div>
        </header>

        <?php if ($this->session->flashdata('message')): ?>
            <div class="tm-toast <?php echo $this->session->flashdata('message_type'); ?>">
                <?php echo $this->session->flashdata('message'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="tm-toast success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="tm-toast error">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <div class="tm-nav-container">
            <div class="tm-nav">
                <a href="<?php echo base_url(); ?>Welcome/landing_page" class="tm-nav-item"><i class="fas fa-home"></i> Home</a>
                <a href="<?php echo base_url(); ?>TeamController/team_profile/<?php echo $team_id; ?>" class="tm-nav-item internal-link"><i class="fas fa-eye"></i> View Page</a>
                <?php if ($this->session->userdata('user_id') == $data['user_id']): ?>
                    <a href="<?php echo base_url(); ?>TeamController/invite_team/<?php echo $team_id; ?>" class="tm-nav-item external-link" title="Invite Team">Invite Team</a>
                    <a href="<?php echo base_url(); ?>TournamentController/join_tournament/<?php echo $team_id; ?>" class="tm-nav-item external-link">Join Tournament</a>
                    <a href="<?php echo base_url(); ?>TeamController/player_request/<?php echo $team_id; ?>" class="tm-nav-item external-link" title="Player Request">Player Request <span class="tm-badge">2</span></a>
                    <a href="<?php echo base_url(); ?>TeamController/team_request/<?php echo $team_id; ?>" class="tm-nav-item external-link" title="Match Request">Team Request</a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Player Requests -->
        <section class="tm-section" id="tm-player-req">
            <h3 class="tm-section-title">Player Requests (<?php echo count($requests); ?>)</h3>
            <?php if (count($requests) > 0): ?>
                <?php foreach ($requests as $player_info): ?>
                    <div class="tm-card">
                        <img src="<?php echo $player_info->image_path; ?>" alt="Player" class="tm-card-img">
                        <div class="tm-card-content">
                            <a href="<?php echo base_url(); ?>PlayerController/profile_player/<?php echo $player_info->player_id; ?>" class="internal-link">
                                <h4><?php echo htmlspecialchars($player_info->playerName); ?></h4>
                            </a>
                            <p><?php echo htmlspecialchars($player_info->player_role); ?></p>
                        </div>
                        <div class="tm-btn-group">
                            <a href="<?php echo base_url(); ?>TeamController/accept_request/<?php echo $player_info->player_id; ?>/<?php echo $player_info->team_id; ?>">
                                <button class="tm-btn tm-btn-success tm-btn-sm">Accept</button>
                            </a>
                            <a href="<?php echo base_url(); ?>TeamController/cancel_player_request/<?php echo $player_info->player_id; ?>/<?php echo $player_info->team_id; ?>">
                                <button class="tm-btn tm-btn-danger tm-btn-sm">Reject</button>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="tm-empty-state">No player requests</p>
            <?php endif; ?>
        </section>

        <!-- Team Requests -->
        <section class="tm-section" id="tm-team-req">
            <h3 class="tm-section-title">Team Requests (<?php echo count($team_names['received_request'] ?? []); ?>)</h3>
            <?php if (isset($team_names['received_request']) && !empty($team_names['received_request'])): ?>
                <?php foreach ($team_names['received_request'] as $value): ?>
                    <div class="tm-card">
                        <img src="<?php echo $value->image_path; ?>" alt="Team" class="tm-card-img">
                        <div class="tm-card-content">
                            <h4><?php echo htmlspecialchars($value->team_name); ?></h4>
                            <p><?php echo htmlspecialchars($value->city); ?></p>
                        </div>
                        <div class="tm-btn-group">
                            <a href="<?php echo base_url(); ?>TeamController/accept_match_request/<?php echo $team_id; ?>/<?php echo $value->team_id; ?>">
                                <button class="tm-btn tm-btn-success tm-btn-sm">Accept</button>
                            </a>
                            <a href="<?php echo base_url(); ?>TeamController/reject_match_request/<?php echo $team_id; ?>/<?php echo $value->team_id; ?>">
                                <button class="tm-btn tm-btn-danger tm-btn-sm">Reject</button>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="tm-empty-state">No team requests</p>
            <?php endif; ?>
        </section>

        <!-- Opposition Team Section -->
        <section class="tm-section" id="tm-opposition">
            <h3 class="tm-section-title">Opposition Team</h3>
            <?php if ($opposition_team['status'] == 'error'): ?>
                <div class="tm-empty-state">
                    <?php echo $opposition_team['message']; ?>
                </div>
            <?php else: ?>
                <?php  foreach ($opposition_team['data'] as $team): ?>
                    <div class="tm-card">
                        <img src="<?php echo $team->team_one_image; ?>" alt="Team Logo" class="tm-card-img">
                        <div class="tm-card-content">
                            <h4><a href="<?php echo base_url(); ?>TeamController/team_profile/<?php echo $team->team_one_id; ?>"><?php echo htmlspecialchars($team->team_one_name); ?></a></h4>
                            <p>Opponent Team</p>
                        </div>
                        <a href="<?php echo base_url(); ?>Welcome/enter_schedule/<?php echo $team->team_two_id; ?>/<?php echo $team->team_one_id; ?>" class="tm-btn tm-btn-primary tm-btn-sm">Add Schedule</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>

        <!-- Schedule Section -->
        <section class="tm-section" id="tm-schedule">
            <h3 class="tm-section-title">Match Schedule</h3>
            <?php if ($team_schedule == 0): ?>
                <p class="tm-empty-state">No match is added yet</p>
            <?php else: ?>
                <div class="tm-schedule-container">
                    <?php
                    $user_id = $this->session->userdata('user_id');
                    $has_matches = false;
                    foreach ($team_schedule as $value):
                        if ($user_id == $value->user_id):
                            $has_matches = true;
                    ?>
                            <div class="tm-schedule-card">
                                <div class="tm-schedule-header">
                                    <div class="tm-schedule-teams">
                                        <div class="tm-schedule-team <?php echo $value->team_one_id == $team_id ? 'your-team' : ''; ?>">
                                            <img src="<?php echo $value->team_one_image; ?>" alt="Team Logo">
                                            <span><?php echo strtoupper(substr($value->team_one_name, 0, 3)); ?></span>
                                            <?php if ($value->team_one_id == $team_id): ?>
                                                <span class="tm-team-you">(You)</span>
                                            <?php endif; ?>
                                        </div>
                                        <span class="tm-schedule-vs">vs</span>
                                        <div class="tm-schedule-team <?php echo $value->team_two_id == $team_id ? 'your-team' : ''; ?>">
                                            <img src="<?php echo $value->team_two_image; ?>" alt="Team Logo">
                                            <span><?php echo strtoupper(substr($value->team_two_name, 0, 3)); ?></span>
                                            <?php if ($value->team_two_id == $team_id): ?>
                                                <span class="tm-team-you">(You)</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="tm-schedule-meta">
                                        <?php
                                        $date = $value->match_date;
                                        $formatted_date = date("M d, Y", strtotime($date));
                                        ?>
                                        <span class="tm-schedule-date"><?php echo $formatted_date; ?></span>
                                        <span class="tm-schedule-time"><?php echo date("g:i A", strtotime($value->match_time)); ?></span>
                                    </div>
                                </div>
                                <div class="tm-schedule-actions">
                                    <a href="<?php echo base_url(); ?>Welcome/toss/<?php echo $value->team_one_id; ?>/<?php echo $value->team_two_id; ?>/<?php echo $value->match_id; ?>" class="tm-btn tm-btn-vibrant tm-btn-score">
                                        <i class="fas fa-tachometer-alt"></i> Score
                                    </a>
                                    <a href="<?php echo base_url(); ?>Welcome/edit_schedule/<?php echo $value->team_one_id; ?>/<?php echo $value->team_two_id; ?>/<?php echo $value->match_id; ?>" class="tm-btn tm-btn-vibrant tm-btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button onclick="openConfirmModal('<?php echo $value->match_id; ?>')" class="tm-btn tm-btn-vibrant tm-btn-delete">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                    <a href="<?php echo base_url(); ?>Welcome/scorecard/<?php echo $value->team_one_id; ?>/<?php echo $value->team_two_id; ?>/<?php echo $value->match_id; ?>" class="tm-btn tm-btn-vibrant tm-btn-view">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </div>
                            </div>
                    <?php
                        endif;
                    endforeach;
                    if (!$has_matches):
                    ?>
                        <p class="tm-empty-state">No matches found for your account</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </section>

        <!-- Team Information -->
        <section class="tm-section" id="tm-team-info">
            <a id="edit-anchor"></a>
            <form id="team-info-form" method="post" action="<?php echo site_url('TeamController/update_team_info'); ?>">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <input type="hidden" name="scroll_position" id="scroll-position">
                <input type="hidden" name="team_id" value="<?php echo $team_id; ?>">
                <div class="tm-info-item">
                    <div><strong>City:</strong>
                        <span id="tm-city-display"><?php echo htmlspecialchars($data['city'] ?? ''); ?></span>
                        <input type="text" id="tm-city-edit" name="city" value="<?php echo htmlspecialchars($data['city'] ?? ''); ?>" class="tm-edit-input" style="display:none;">
                    </div>
                    <button type="button" class="tm-btn tm-btn-warning tm-btn-sm" onclick="toggleEdit('city')">Edit</button>
                </div>
                <div class="tm-info-item">
                    <div><strong>Country:</strong>
                        <span id="tm-country-display"><?php echo htmlspecialchars($data['country'] ?? ''); ?></span>
                        <input type="text" id="tm-country-edit" name="country" value="<?php echo htmlspecialchars($data['country'] ?? ''); ?>" class="tm-edit-input" style="display:none;">
                    </div>
                    <button type="button" class="tm-btn tm-btn-warning tm-btn-sm" onclick="toggleEdit('country')">Edit</button>
                </div>
                <div class="tm-info-item">
                    <div><strong>Home Ground:</strong>
                        <span id="tm-ground-display"><?php echo htmlspecialchars($data['home_ground'] ?? ''); ?></span>
                        <input type="text" id="tm-ground-edit" name="home_ground" value="<?php echo htmlspecialchars($data['home_ground'] ?? ''); ?>" class="tm-edit-input" style="display:none;">
                    </div>
                    <button type="button" class="tm-btn tm-btn-warning tm-btn-sm" onclick="toggleEdit('ground')">Edit</button>
                </div>
                <div class="tm-info-item">
                    <div><strong>Admin Phone:</strong>
                        <span id="tm-phone-display"><?php echo htmlspecialchars($data['phone_number'] ?? ''); ?></span>
                        <input type="tel" id="tm-phone-edit" name="phone_number" value="<?php echo htmlspecialchars($data['phone_number'] ?? ''); ?>" class="tm-edit-input" style="display:none;">
                    </div>
                    <button type="button" class="tm-btn tm-btn-warning tm-btn-sm" onclick="toggleEdit('phone')">Edit</button>
                </div>
                <div id="edit-controls" style="display:none;">
                    <button type="submit" class="tm-btn tm-btn-primary">Save Changes</button>
                    <button type="button" class="tm-btn tm-btn-outline" onclick="cancelEdit()">Cancel</button>
                </div>
            </form>
        </section>

        <!-- Captains -->
        <section class="tm-section" id="tm-captains">
            <h3 class="tm-section-title">Current Captains</h3>
            <div class="tm-captain-grid">
                <div class="tm-captain-card">
                    <h4>Leather Ball</h4>
                    <?php if ($captain['leather_ball']['status'] === 0): ?>
                        <?php if ($this->session->userdata('user_id') == $data['user_id']): ?>
                            <a href="<?php echo base_url(); ?>TeamController/add_captain_leather/<?php echo $team_id; ?>" class="internal-link">
                                <button class="tm-btn tm-btn-primary tm-btn-sm">Add</button>
                            </a>
                        <?php else: ?>
                            <p class="tm-empty-state">Not assigned</p>
                        <?php endif; ?>
                    <?php else: ?>
                        <img src="<?php echo $captain['leather_ball']['image_path']; ?>" alt="Captain" class="tm-captain-img">
                        <p><?php echo htmlspecialchars($captain['leather_ball']['playerName']); ?></p>
                        <?php if ($this->session->userdata('user_id') == $data['user_id']): ?>
                            <a href="<?php echo base_url(); ?>TeamController/edit_captain_leather/<?php echo $team_id; ?>" class="internal-link">
                                <button class="tm-btn tm-btn-warning tm-btn-sm">Edit</button>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="tm-captain-card">
                    <h4>Tape Ball</h4>
                    <?php if ($captain['tape_ball']['status'] === 0): ?>
                        <?php if ($this->session->userdata('user_id') == $data['user_id']): ?>
                            <a href="<?php echo base_url(); ?>TeamController/add_captain_tape/<?php echo $team_id; ?>" class="internal-link">
                                <button class="tm-btn tm-btn-primary tm-btn-sm">Add</button>
                            </a>
                        <?php else: ?>
                            <p class="tm-empty-state">Not assigned</p>
                        <?php endif; ?>
                    <?php else: ?>
                        <img src="<?php echo $captain['tape_ball']['image_path']; ?>" alt="Captain" class="tm-captain-img">
                        <p><?php echo htmlspecialchars($captain['tape_ball']['playerName']); ?></p>
                        <?php if ($this->session->userdata('user_id') == $data['user_id']): ?>
                            <a href="<?php echo base_url(); ?>TeamController/edit_captain_tape/<?php echo $team_id; ?>" class="internal-link">
                                <button class="tm-btn tm-btn-warning tm-btn-sm">Edit</button>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="tm-captain-card">
                    <h4>Tennis Ball</h4>
                    <?php if ($captain['tennis_ball']['status'] === 0): ?>
                        <?php if ($this->session->userdata('user_id') == $data['user_id']): ?>
                            <a href="<?php echo base_url(); ?>TeamController/add_captain_tennis/<?php echo $team_id; ?>" class="internal-link">
                                <button class="tm-btn tm-btn-primary tm-btn-sm">Add</button>
                            </a>
                        <?php else: ?>
                            <p class="tm-empty-state">Not assigned</p>
                        <?php endif; ?>
                    <?php else: ?>
                        <img src="<?php echo $captain['tennis_ball']['image_path']; ?>" alt="Captain" class="tm-captain-img">
                        <p><?php echo htmlspecialchars($captain['tennis_ball']['playerName']); ?></p>
                        <?php if ($this->session->userdata('user_id') == $data['user_id']): ?>
                            <a href="<?php echo base_url(); ?>TeamController/edit_captain_tennis/<?php echo $team_id; ?>" class="internal-link">
                                <button class="tm-btn tm-btn-warning tm-btn-sm">Edit</button>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Management -->
        <section class="tm-section" id="tm-management">
            <h3 class="tm-section-title">Team Management</h3>
            <div class="insert-section">
                <button type="button" class="tm-btn tm-btn-primary" onclick="openAddModal()">
                    <i class="fas fa-plus"></i> Insert New Member
                </button>
            </div>
            <div class="team-container">
                <?php  if (!empty($management_staff)): ?>
                    <?php foreach ($management_staff as $staff): ?>
                        <div class="team-row" id="staff-<?php echo htmlspecialchars($staff->role); ?>">
                            <div class="team-info">
                                <h3><?php echo htmlspecialchars($staff->name); ?></h3>
                                <p><?php echo htmlspecialchars($staff->role); ?></p>
                            </div>
                            <button type="button" class="tm-btn tm-btn-warning tm-btn-sm" onclick="openEditModal('<?php echo htmlspecialchars($staff->name, ENT_QUOTES); ?>', '<?php echo htmlspecialchars($staff->role, ENT_QUOTES); ?>')">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="tm-empty-state">No team management members found.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Add Team Management Modal -->
        <div id="tm-add-modal" class="tm-modal">
            <div class="tm-modal-content">
                <span class="tm-modal-close" onclick="closeAddModal()">&times;</span>
                <h3 class="tm-modal-title">Add New Team Management Member</h3>
                <form method="post" action="<?php echo base_url(); ?>TeamController/insert_team_management">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <input type="hidden" name="team_id" value="<?php echo $team_id; ?>">
                    <div class="tm-form-group">
                        <label for="tm-add-name">Name</label>
                        <input type="text" id="tm-add-name" name="name" value="<?php echo set_value('name'); ?>" placeholder="Enter name" required>
                        <?php if (form_error('name')): ?>
                            <span class="tm-error"><?php echo form_error('name'); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="tm-form-group">
                        <label for="tm-add-designation">Designation</label>
                        <input type="text" id="tm-add-designation" name="designation" value="<?php echo set_value('designation'); ?>" placeholder="Enter designation" required>
                        <?php if (form_error('designation')): ?>
                            <span class="tm-error"><?php echo form_error('designation'); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="tm-modal-actions">
                        <button type="submit" class="tm-btn tm-btn-primary"><i class="fas fa-save"></i> Save</button>
                        <button type="button" class="tm-btn tm-btn-danger" onclick="closeAddModal()"><i class="fas fa-times"></i> Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Team Management Modal -->
        <div id="tm-edit-modal" class="tm-modal">
            <div class="tm-modal-content">
                <span class="tm-modal-close" onclick="closeEditModal()">&times;</span>
                <h3 class="tm-modal-title">Edit Team Management Member</h3>
                <form method="post" action="<?php echo base_url(); ?>TeamController/update_team_management">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <input type="hidden" name="team_id" value="<?php echo $team_id; ?>">
                    <input type="hidden" name="current_role" id="tm-edit-current-role">
                    <div class="tm-form-group">
                        <label for="tm-edit-name">Name</label>
                        <input type="text" id="tm-edit-name" name="name" placeholder="Enter name" required>
                        <?php if (form_error('name')): ?>
                            <span class="tm-error"><?php echo form_error('name'); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="tm-form-group">
                        <label for="tm-edit-designation">Designation</label>
                        <input type="text" id="tm-edit-designation" name="designation" placeholder="Enter designation" required>
                        <?php if (form_error('designation')): ?>
                            <span class="tm-error"><?php echo form_error('designation'); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="tm-modal-actions">
                        <button type="submit" class="tm-btn tm-btn-primary"><i class="fas fa-save"></i> Save</button>
                        <button type="button" class="tm-btn tm-btn-danger" onclick="closeEditModal()"><i class="fas fa-times"></i> Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Confirmation Modal for Delete -->
        <div id="tm-confirm-modal" class="tm-modal">
            <div class="tm-modal-content">
                <i class="fas fa-exclamation-triangle tm-confirm-icon"></i>
                <div class="tm-confirm-text">Are you sure you want to delete this match?</div>
                <div class="tm-modal-actions">
                    <button class="tm-btn tm-btn-danger" id="tm-confirm-delete">Delete</button>
                    <button class="tm-btn tm-btn-outline" onclick="closeConfirmModal()">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('team-info-form').addEventListener('submit', () => {
            document.getElementById('scroll-position').value = window.pageYOffset;
        });

        window.onload = () => {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('scroll')) {
                setTimeout(() => {
                    window.scrollTo(0, parseInt(urlParams.get('scroll')));
                }, 100);
            }
            <?php if ($this->input->get('edit_field')): ?>
                toggleEdit('<?php echo $this->input->get('edit_field'); ?>');
            <?php endif; ?>
        };

        function toggleEdit(field) {
            document.querySelectorAll('.tm-edit-input').forEach(input => input.style.display = 'none');
            document.querySelectorAll('[id$="-display"]').forEach(span => span.style.display = 'inline');
            document.getElementById(`tm-${field}-edit`).style.display = 'inline-block';
            document.getElementById(`tm-${field}-display`).style.display = 'none';
            document.getElementById('edit-controls').style.display = 'block';
            document.getElementById(`tm-${field}-edit`).focus();
        }

        function cancelEdit() {
            document.querySelectorAll('.tm-edit-input').forEach(input => input.style.display = 'none');
            document.querySelectorAll('[id$="-display"]').forEach(span => span.style.display = 'inline');
            document.getElementById('edit-controls').style.display = 'none';
        }

        function openConfirmModal(matchId) {
            const modal = document.getElementById('tm-confirm-modal');
            const deleteBtn = document.getElementById('tm-confirm-delete');
            deleteBtn.onclick = () => {
                window.location.href = `<?php echo base_url(); ?>Welcome/delete_schedule/${matchId}`;
            };
            modal.style.display = 'flex';
        }

        function closeConfirmModal() {
            document.getElementById('tm-confirm-modal').style.display = 'none';
        }

        function openAddModal() {
            document.getElementById('tm-add-modal').style.display = 'flex';
            document.getElementById('tm-add-name').focus();
        }

        function closeAddModal() {
            document.getElementById('tm-add-modal').style.display = 'none';
            document.getElementById('tm-add-name').value = '';
            document.getElementById('tm-add-designation').value = '';
        }

        function openEditModal(name, role) {
            document.getElementById('tm-edit-modal').style.display = 'flex';
            document.getElementById('tm-edit-name').value = name;
            document.getElementById('tm-edit-designation').value = role;
            document.getElementById('tm-edit-current-role').value = role;
            document.getElementById('tm-edit-name').focus();
        }

        function closeEditModal() {
            document.getElementById('tm-edit-modal').style.display = 'none';
        }

        window.onclick = (event) => {
            if (event.target.classList.contains('tm-modal')) {
                closeAddModal();
                closeEditModal();
                closeConfirmModal();
            }
        };

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeAddModal();
                closeEditModal();
                closeConfirmModal();
            }
        });

        document.querySelectorAll('.tm-nav-item').forEach(link => {
            link.addEventListener('click', (e) => {
                if (link.getAttribute('href').startsWith('#')) {
                    e.preventDefault();
                    const target = document.querySelector(link.getAttribute('href'));
                    if (target) {
                        window.scrollTo({
                            top: target.offsetTop - 70,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });

        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('.tm-section');
            const navItems = document.querySelectorAll('.tm-nav-item');
            let currentSection = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                if (window.scrollY >= sectionTop) {
                    currentSection = '#' + section.getAttribute('id');
                }
            });

            navItems.forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('href') === currentSection) {
                    item.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>