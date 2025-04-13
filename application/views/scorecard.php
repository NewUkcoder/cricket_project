<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Cricket Match Scorecard</title>
    <style>
        /* Modern Design System */
        :root {
            --primary: #1a3a8f;
            --secondary: #ff4757;
            --accent: #ffd32a;
            --dark: #2f3542;
            --light: #f1f2f6;
            --success: #2ed573;
            --text: #2f3542;
            --text-light: #747d8c;
            --card-bg: #ffffff;
            --border: #dfe4ea;
            --pending: #ffa502;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--light);
            color: var(--text);
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            padding-bottom: 2rem;
            overflow-x: hidden;
        }

        .pending-message {
            color: var(--pending);
            font-weight: 600;
            font-style: italic;
        }

        .match-header {
            background: linear-gradient(135deg, var(--primary), #254099);
            color: white;
            padding: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .teams-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .teams-display {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 0.5rem;
            flex-wrap: wrap;
        }

        .team-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            flex: 1;
            min-width: 120px;
            max-width: 45%;
        }

        .team-flag {
            width: 50px;
            height: 35px;
            border-radius: 4px;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 0.3rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .team-name {
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 0.2rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 100%;
        }

        .team-score {
            font-size: 0.85rem;
            opacity: 0.9;
        }

        .vs-badge {
            background-color: var(--accent);
            color: var(--dark);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.9rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            flex-shrink: 0;
        }

        .match-info-banner {
            background-color: var(--card-bg);
            padding: 1rem;
            margin: 0 auto;
            max-width: 1200px;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        .info-item {
            display: flex;
            align-items: center;
        }

        .info-icon {
            margin-right: 0.75rem;
            color: var(--primary);
            font-size: 1.1rem;
            min-width: 20px;
        }

        .info-content {
            font-size: 0.9rem;
        }

        .info-label {
            font-size: 0.75rem;
            color: var(--text-light);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.1rem;
        }

        .info-value {
            font-weight: 500;
        }

        .match-result {
            background-color: var(--success);
            color: var(--dark);
            padding: 0.8rem;
            text-align: center;
            font-weight: 700;
            font-size: 1rem;
            margin: 0.5rem auto;
            max-width: 1200px;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .result-pending {
            background-color: var(--pending);
        }

        .pom-card {
            display: flex;
            align-items: center;
            background: var(--card-bg);
            border-radius: 10px;
            padding: 0.8rem;
            max-width: 1200px;
            margin: 1rem auto;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            border-left: 4px solid var(--accent);
        }

        .pom-pending {
            border-left-color: var(--pending);
        }

        .pom-badge {
            background-color: var(--accent);
            color: var(--dark);
            font-size: 0.7rem;
            font-weight: 800;
            padding: 0.3rem 0.6rem;
            border-radius: 4px;
            margin-right: 1rem;
            white-space: nowrap;
        }

        .pom-badge-pending {
            background-color: var(--pending);
        }

        .pom-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            margin-right: 1rem;
            object-fit: cover;
            border: 2px solid var(--accent);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .pom-avatar-pending {
            border-color: var(--pending);
        }

        .pom-details {
            flex-grow: 1;
            min-width: 0;
        }

        .pom-title {
            font-size: 0.8rem;
            color: var(--text-light);
            margin-bottom: 0.2rem;
        }

        .pom-name {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .pom-pending-text {
            color: var(--pending);
            font-style: italic;
        }

        .scorecard-section {
            background: var(--card-bg);
            border-radius: 10px;
            overflow: hidden;
            max-width: 1200px;
            margin: 1.5rem auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
        }

        .innings-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, var(--primary), #254099);
            color: white;
            padding: 0.8rem 1rem;
        }

        .innings-title {
            font-weight: 600;
            font-size: 1rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            flex: 1;
            min-width: 0;
        }

        .innings-score {
            background: rgba(0, 0, 0, 0.2);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            white-space: nowrap;
            margin-left: 0.5rem;
        }

        .innings-score-pending {
            background: rgba(0, 0, 0, 0.1);
            font-style: italic;
        }

        .table-container {
            width: 100%;
            overflow: hidden;
        }

        .scorecard-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .scorecard-table th {
            background-color: #f8f9fa;
            color: var(--primary);
            font-weight: 600;
            padding: 0.5rem;
            text-align: left;
            font-size: 0.75rem;
            position: sticky;
            top: 0;
            border-bottom: 2px solid var(--border);
        }

        .scorecard-table td {
            padding: 0.5rem;
            border-bottom: 1px solid var(--border);
            font-size: 0.8rem;
            vertical-align: middle;
        }

        .player-cell {
            display: flex;
            align-items: center;
            min-width: 0;
        }

        .player-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin-right: 0.6rem;
            object-fit: cover;
            border: 2px solid var(--border);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            flex-shrink: 0;
        }

        .player-main {
            min-width: 0;
            flex: 1;
        }

        .player-name {
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--dark);
            margin-bottom: 0.1rem;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .player-detail {
            font-size: 0.7rem;
            color: var(--text-light);
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .stat-value {
            font-weight: 500;
            color: var(--text);
            white-space: nowrap;
        }

        .highlight-stat {
            color: var(--secondary);
            font-weight: 600;
            white-space: nowrap;
        }

        .summary-row {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        .empty-state {
            text-align: center;
            padding: 2rem;
            color: var(--text-light);
            font-style: italic;
            font-size: 0.9rem;
        }

        .squads-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .squad-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--border);
        }

        .squad-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary);
            margin-right: 0.8rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            flex: 1;
        }

        .squad-count {
            background: var(--light);
            color: var(--text-light);
            font-size: 0.75rem;
            padding: 0.2rem 0.6rem;
            border-radius: 12px;
            white-space: nowrap;
        }

        .squad-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 0.8rem;
            margin-bottom: 2rem;
        }

        .squad-player {
            display: flex;
            align-items: center;
            background: var(--card-bg);
            border-radius: 8px;
            padding: 0.7rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
            min-width: 0;
        }

        .squad-player:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.1);
            border-color: var(--primary);
        }

        .squad-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            margin-right: 0.8rem;
            object-fit: cover;
            border: 2px solid var(--border);
            flex-shrink: 0;
        }

        .squad-player-name {
            font-size: 0.9rem;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            min-width: 0;
        }

        /* Laptop View */
        @media (min-width: 769px) {
            .match-header {
                padding: 1.5rem;
            }

            .team-flag {
                width: 60px;
                height: 40px;
            }

            .team-name {
                font-size: 1.2rem;
            }

            .team-score {
                font-size: 1rem;
            }

            .vs-badge {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .scorecard-table th {
                font-size: 0.85rem;
                padding: 0.75rem;
            }

            .scorecard-table td {
                font-size: 0.9rem;
                padding: 0.75rem;
            }

            .player-avatar {
                width: 36px;
                height: 36px;
            }

            .player-name {
                font-size: 0.95rem;
            }

            .player-detail {
                font-size: 0.8rem;
            }
        }

        /* Mobile View */
        @media (max-width: 480px) {
            .teams-container,
            .match-info-banner,
            .match-result,
            .pom-card,
            .scorecard-section,
            .squads-container {
                width: 100%;
                max-width: none;
                padding: 0 0.5rem;
            }

            .match-header {
                padding: 0.6rem;
            }

            .team-card {
                min-width: 80px;
                max-width: 40%;
            }

            .team-flag {
                width: 40px;
                height: 28px;
            }

            .team-name {
                font-size: 0.8rem;
            }

            .team-score {
                font-size: 0.7rem;
            }

            .vs-badge {
                width: 30px;
                height: 30px;
                font-size: 0.75rem;
            }

            .match-info-banner {
                grid-template-columns: 1fr;
                padding: 0.6rem;
                gap: 0.6rem;
            }

            .info-icon {
                font-size: 0.9rem;
                margin-right: 0.5rem;
            }

            .info-content {
                font-size: 0.8rem;
            }

            .info-label {
                font-size: 0.65rem;
            }

            .match-result {
                font-size: 0.85rem;
                padding: 0.6rem;
                margin: 0.5rem 0;
            }

            .pom-card {
                padding: 0.6rem;
            }

            .pom-badge {
                font-size: 0.6rem;
                padding: 0.2rem 0.5rem;
                margin-right: 0.6rem;
            }

            .pom-avatar {
                width: 36px;
                height: 36px;
                margin-right: 0.6rem;
            }

            .pom-title {
                font-size: 0.7rem;
            }

            .pom-name {
                font-size: 0.85rem;
            }

            .innings-header {
                padding: 0.6rem;
            }

            .innings-title {
                font-size: 0.85rem;
            }

            .innings-score {
                font-size: 0.75rem;
                padding: 0.2rem 0.6rem;
            }

            .scorecard-table th {
                padding: 0.15rem;
                font-size: 0.5rem;
            }

            .scorecard-table td {
                padding: 0.15rem;
                vertical-align: middle;
            }

            .scorecard-table th:nth-child(1),
            .scorecard-table td:nth-child(1) {
                width: 40%;
            }

            .scorecard-table th:nth-child(2),
            .scorecard-table td:nth-child(2),
            .scorecard-table th:nth-child(3),
            .scorecard-table td:nth-child(3),
            .scorecard-table th:nth-child(4),
            .scorecard-table td:nth-child(4),
            .scorecard-table th:nth-child(5),
            .scorecard-table td:nth-child(5),
            .scorecard-table th:nth-child(6),
            .scorecard-table td:nth-child(6) {
                width: 12%;
            }

            .bowling-table th:nth-child(1),
            .bowling-table td:nth-child(1) {
                width: 40%;
            }

            .bowling-table th:nth-child(2),
            .bowling-table td:nth-child(2),
            .bowling-table th:nth-child(3),
            .bowling-table td:nth-child(3),
            .bowling-table th:nth-child(4),
            .bowling-table td:nth-child(4),
            .bowling-table th:nth-child(5),
            .bowling-table td:nth-child(5) {
                width: 15%;
            }

            .player-avatar {
                width: 24px;
                height: 24px;
                margin-right: 0.3rem;
            }

            .player-name {
                font-size: 0.7rem;
                white-space: normal;
                word-wrap: break-word;
                overflow: visible;
                text-overflow: clip;
                line-height: 1.2;
            }

            .player-detail {
                display: none;
            }

            .stat-value,
            .highlight-stat {
                font-size: 0.5rem;
            }

            .squad-grid {
                grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
                gap: 0.5rem;
            }

            .squad-avatar {
                width: 28px;
                height: 28px;
                margin-right: 0.4rem;
            }

            .squad-player-name {
                font-size: 0.75rem;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="match-header">
        <div class="teams-container">
            <div class="teams-display">
                <div class="team-card">
                    <img src="<?php echo $information['team_one_image'];?>" alt="Team Flag" class="team-flag">
                    <div class="team-name"><?php echo $information['team_one_name'];?></div>
                    <?php if(isset($batting_first_score) && is_array($batting_first_score) && !empty($batting_first_score)) { 
                        foreach($batting_first_score as $t_score) { ?>
                        <div class="team-score"><?php echo $t_score->total_runs; ?>/<?php echo $t_score->wickets;?></div>
                    <?php } } else { ?>
                        <div class="team-score pending-message">In Progress</div>
                    <?php } ?>
                </div>
                
                <div class="vs-badge">VS</div>
                
                <div class="team-card">
                    <img src="<?php echo $information['team_two_image'];?>" alt="Team Flag" class="team-flag">
                    <div class="team-name"><?php echo $information['team_two_name'];?></div>
                    <?php if(isset($batting_second_score) && is_array($batting_second_score) && !empty($batting_second_score)) { 
                        foreach($batting_second_score as $t_score) { ?>
                        <div class="team-score"><?php echo $t_score->total_runs; ?>/<?php echo $t_score->wickets;?></div>
                    <?php } } else { ?>
                        <div class="team-score pending-message">In Progress</div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    //<?php var_dump($match_result);?>
    
    <div class="match-info-banner">
        <div class="info-item">
            <div class="info-icon"><i class="fas fa-calendar-alt"></i></div>
            <div class="info-content">
                <div class="info-label">Date & Time</div>
                <div class="info-value"><?php echo $information['match_date']; ?>, <?php echo $information['match_time']; ?></div>
            </div>
        </div>
        
        <div class="info-item">
            <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
            <div class="info-content">
                <div class="info-label">Venue</div>
                <div class="info-value"><?php echo $information['location']; ?></div>
            </div>
        </div>
        
        <div class="info-item">
            <div class="info-icon"><i class="fas fa-trophy"></i></div>
            <div class="info-content">
                <div class="info-label">Series</div>
                <div class="info-value"><?php echo isset($information['series']) ? $information['series'] : 'N/A'; ?></div>
            </div>
        </div>
        
        <div class="info-item">
            <div class="info-icon"><i class="fas fa-clock"></i></div>
            <div class="info-content">
                <div class="info-label">Format</div>
                <div class="info-value"><?php echo $information['match_type']; ?></div>
            </div>
        </div>
        
        <div class="info-item">
            <div class="info-icon"><i class="fas fa-flag"></i></div>
            <div class="info-content">
                <div class="info-label">Toss</div>
                <div class="info-value">
                    <?php if(isset($information['toss_winner_name'])) { ?>
                        <?php echo $information['toss_winner_name']; ?> chose to <?php echo $information['decision']; ?>
                    <?php } else { ?>
                        <span class="pending-message">Pending</span>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="info-item">
            <div class="info-icon"><i class="fas fa-user-shield"></i></div>
            <div class="info-content">
                <div class="info-label">Umpires</div>
                <div class="info-value">
                    <?php if(isset($information['umpire1'])) { ?>
                        <?php echo $information['umpire1']; ?>, <?php echo $information['umpire2']; ?>
                    <?php } else { ?>
                        <span class="pending-message">To be announced</span>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="match-result <?php  echo empty($match_result) ? 'result-pending' : ''; ?>">
        <?php if(isset($match_result) && !empty($match_result)) { ?>
            <?php echo $match_result; ?>
        <?php } else { ?>
            Match In Progress
        <?php } ?>
    </div>
    
    <div class="pom-card <?php echo empty($player_of_match) ? 'pom-pending' : ''; ?>">
        <div class="pom-badge <?php echo empty($player_of_match) ? 'pom-badge-pending' : ''; ?>">POTM</div>
        <?php if (!empty($player_of_match)): ?>
            <img src="<?php echo !empty($player_of_match->image_path) ? $player_of_match->image_path : base_url('assets/images/default_player.png'); ?>" 
                 alt="Player of the Match" 
                 class="pom-avatar">
            <div class="pom-details">
                <div class="pom-title">Player of the Match</div>
                <div class="pom-name"><?php echo $player_of_match->playerName; ?></div>
            </div>
        <?php else: ?>
            <img src="<?php echo base_url('assets/images/default_player.png'); ?>" 
                 alt="Player of the Match" 
                 class="pom-avatar pom-avatar-pending">
            <div class="pom-details">
                <div class="pom-title">Player of the Match</div>
                <div class="pom-pending-text">To be decided</div>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="scorecard-section">
        <div class="innings-header">
            <div class="innings-title">First Innings - Batting</div>
            <?php if(isset($batting_first_score) && is_array($batting_first_score) && !empty($batting_first_score)) { 
                foreach($batting_first_score as $t_score) { ?>
                <div class="innings-score"><?php echo $t_score->total_runs; ?>/<?php echo $t_score->wickets;?> (<?php echo $t_score->t_overs; ?> ov)</div>
            <?php } } else { ?>
                <div class="innings-score innings-score-pending">In Progress</div>
            <?php } ?>
        </div>
        
        <div class="table-container">
            <table class="scorecard-table">
                <thead>
                    <tr>
                        <th>Batter</th>
                        <th>R</th>
                        <th>B</th>
                        <th>4s</th>
                        <th>6s</th>
                        <th>SR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($first_inning) && is_array($first_inning) && !empty($first_inning)) { 
                        foreach($first_inning as $score) {
                        $strike_rate = ($score->balls > 0) ? ($score->runs / $score->balls) * 100 : 0;
                        $dismissal_info = isset($score->dismissal) ? $score->dismissal : "Not Out";
                    ?>
                    <tr>
                        <td>
                            <div class="player-cell">
                                <img src="<?php echo isset($score->image_path) ? $score->image_path : 'https://via.placeholder.com/100';?>" alt="Player" class="player-avatar">
                                <div class="player-main">
                                    <span class="player-name"><?php echo $score->playerName;?></span>
                                    <span class="player-detail"><?php echo $dismissal_info; ?></span>
                                </div>
                            </div>
                        </td>
                        <td class="stat-value"><?php echo $score->runs;?></td>
                        <td><?php echo $score->balls;?></td>
                        <td class="highlight-stat"><?php echo $score->fours;?></td>
                        <td class="highlight-stat"><?php echo $score->sixes;?></td>
                        <td class="stat-value"><?php echo number_format($strike_rate, 2);?></td>
                    </tr>
                    <?php } 
                    
                    if(isset($batting_first_score) && is_array($batting_first_score) && !empty($batting_first_score)) { 
                        foreach($batting_first_score as $t_score) { ?>
                        <tr class="summary-row">
                            <td><strong>Extras</strong></td>
                            <td colspan="5"><?php echo $t_score->total_extra; ?> (w <?php echo $t_score->wides; ?>, nb <?php echo $t_score->no_balls; ?>, b <?php echo $t_score->byes; ?>, lb <?php echo $t_score->leg_byes; ?>)</td>
                        </tr>
                        <tr class="summary-row">
                            <td><strong>Total</strong></td>
                            <td colspan="5"><strong><?php echo $t_score->total_runs; ?></strong> (<?php echo $t_score->wickets;?> wkts, <?php echo $t_score->t_overs; ?> ov)</td>
                        </tr>
                    <?php } } } else { ?>
                    <tr>
                        <td colspan="6" class="empty-state">
                            <i class="fas fa-hourglass-half" style="margin-right: 8px;"></i>
                            Batting performance data will appear here once the match begins
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="scorecard-section">
        <div class="innings-header">
            <div class="innings-title">First Innings - Bowling</div>
            <?php if(isset($batting_first_score) && is_array($batting_first_score) && !empty($batting_first_score)) { ?>
                <div class="innings-score">Target: <?php echo $batting_first_score[0]->total_runs + 1; ?></div>
            <?php } ?>
        </div>
        
        <div class="table-container">
            <table class="scorecard-table bowling-table">
                <thead>
                    <tr>
                        <th>Bowler</th>
                        <th>O</th>
                        <th>R</th>
                        <th>W</th>
                        <th>Econ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($first_bowling_inning) && is_array($first_bowling_inning) && !empty($first_bowling_inning)) { 
                        foreach($first_bowling_inning as $f_bowling) {
                        $economy = ($f_bowling->overs > 0) ? $f_bowling->given_runs / $f_bowling->overs : 0;
                    ?>
                    <tr>
                        <td>
                            <div class="player-cell">
                                <img src="<?php echo isset($f_bowling->image_path) ? $f_bowling->image_path : 'https://via.placeholder.com/100';?>" alt="Bowler" class="player-avatar">
                                <span class="player-name"><?php echo $f_bowling->playerName;?></span>
                            </div>
                        </td>
                        <td><?php echo $f_bowling->overs;?></td>
                        <td><?php echo $f_bowling->given_runs;?></td>
                        <td class="highlight-stat"><?php echo $f_bowling->wickets;?></td>
                        <td class="stat-value"><?php echo number_format($economy, 2);?></td>
                    </tr>
                    <?php } } else { ?>
                    <tr>
                        <td colspan="5" class="empty-state">
                            <i class="fas fa-hourglass-half" style="margin-right: 8px;"></i>
                            Bowling performance data will appear here once the match begins
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="scorecard-section">
        <div class="innings-header">
            <div class="innings-title">Second Innings - Batting</div>
            <?php if(isset($batting_second_score) && is_array($batting_second_score) && !empty($batting_second_score)) { 
                foreach($batting_second_score as $t_score) { ?>
                <div class="innings-score"><?php echo $t_score->total_runs; ?>/<?php echo $t_score->wickets;?> (<?php echo $t_score->t_overs; ?> ov)</div>
            <?php } } else { ?>
                <div class="innings-score innings-score-pending">In Progress</div>
            <?php } ?>
        </div>
        
        <div class="table-container">
            <table class="scorecard-table">
                <thead>
                    <tr>
                        <th>Batter</th>
                        <th>R</th>
                        <th>B</th>
                        <th>4s</th>
                        <th>6s</th>
                        <th>SR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($second_inning) && is_array($second_inning) && !empty($second_inning)) { 
                        foreach($second_inning as $score) {
                        $strike_rate = ($score->balls > 0) ? ($score->runs / $score->balls) * 100 : 0;
                        $dismissal_info = isset($score->dismissal) ? $score->dismissal : "Not Out";
                    ?>
                    <tr>
                        <td>
                            <div class="player-cell">
                                <img src="<?php echo isset($score->image_path) ? $score->image_path : 'https://via.placeholder.com/100';?>" alt="Player" class="player-avatar">
                                <div class="player-main">
                                    <span class="player-name"><?php echo $score->playerName;?></span>
                                    <span class="player-detail"><?php echo $dismissal_info; ?></span>
                                </div>
                            </div>
                        </td>
                        <td class="stat-value"><?php echo $score->runs;?></td>
                        <td><?php echo $score->balls;?></td>
                        <td class="highlight-stat"><?php echo $score->fours;?></td>
                        <td class="highlight-stat"><?php echo $score->sixes;?></td>
                        <td class="stat-value"><?php echo number_format($strike_rate, 2);?></td>
                    </tr>
                    <?php } 
                    
                    if(isset($batting_second_score) && is_array($batting_second_score) && !empty($batting_second_score)) { 
                        foreach($batting_second_score as $t_score) { ?>
                        <tr class="summary-row">
                            <td><strong>Extras</strong></td>
                            <td colspan="5"><?php echo $t_score->total_extra; ?> (w <?php echo $t_score->wides; ?>, nb <?php echo $t_score->no_balls; ?>, b <?php echo $t_score->byes; ?>, lb <?php echo $t_score->leg_byes; ?>)</td>
                        </tr>
                        <tr class="summary-row">
                            <td><strong>Total</strong></td>
                            <td colspan="5"><strong><?php echo $t_score->total_runs; ?></strong> (<?php echo $t_score->wickets;?> wkts, <?php echo $t_score->t_overs; ?> ov)</td>
                        </tr>
                    <?php } } } else { ?>
                    <tr>
                        <td colspan="6" class="empty-state">
                            <i class="fas fa-hourglass-half" style="margin-right: 8px;"></i>
                            Batting performance data will appear here once the innings begins
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="scorecard-section">
        <div class="innings-header">
            <div class="innings-title">Second Innings - Bowling</div>
        </div>
        
        <div class="table-container">
            <table class="scorecard-table bowling-table">
                <thead>
                    <tr>
                        <th>Bowler</th>
                        <th>O</th>
                        <th>R</th>
                        <th>W</th>
                        <th>Econ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($second_bowling_inning) && is_array($second_bowling_inning) && !empty($second_bowling_inning)) { 
                        foreach($second_bowling_inning as $f_bowling) {
                        $economy = ($f_bowling->overs > 0) ? $f_bowling->given_runs / $f_bowling->overs : 0;
                    ?>
                    <tr>
                        <td>
                            <div class="player-cell">
                                <img src="<?php echo isset($f_bowling->image_path) ? $f_bowling->image_path : 'https://via.placeholder.com/100';?>" alt="Bowler" class="player-avatar">
                                <span class="player-name"><?php echo $f_bowling->playerName;?></span>
                            </div>
                        </td>
                        <td><?php echo $f_bowling->overs;?></td>
                        <td><?php echo $f_bowling->given_runs;?></td>
                        <td class="highlight-stat"><?php echo $f_bowling->wickets;?></td>
                        <td class="stat-value"><?php echo number_format($economy, 2);?></td>
                    </tr>
                    <?php } } else { ?>
                    <tr>
                        <td colspan="5" class="empty-state">
                            <i class="fas fa-hourglass-half" style="margin-right: 8px;"></i>
                            Bowling performance data will appear here once the innings begins
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="squads-container">
        <div class="squad-header">
            <div class="squad-title"><?php echo $information['team_one_name'];?></div>
            <div class="squad-count">
                <?php if(isset($team_one_squad) && is_array($team_one_squad)) { 
                    echo count($team_one_squad) . ' Players'; 
                } else { 
                    echo 'Squad'; 
                } ?>
            </div>
        </div>
        
        <div class="squad-grid">
            <?php if(isset($team_one_squad) && is_array($team_one_squad) && !empty($team_one_squad)) { 
                foreach($team_one_squad as $player) { ?>
                <div class="squad-player">
                    <img src="<?php echo isset($player->image_path) ? $player->image_path : 'https://via.placeholder.com/100';?>" alt="Player" class="squad-avatar">
                    <div class="squad-player-name"><?php echo $player->playerName; ?></div>
                </div>
            <?php } } else { ?>
                <div class="squad-player">
                    <img src="https://via.placeholder.com/100" alt="Player" class="squad-avatar">
                    <div class="squad-player-name">Squad not announced</div>
                </div>
            <?php } ?>
        </div>
        
        <div class="squad-header">
            <div class="squad-title"><?php echo $information['team_two_name'];?></div>
            <div class="squad-count">
                <?php if(isset($team_two_squad) && is_array($team_two_squad)) { 
                    echo count($team_two_squad) . ' Players'; 
                } else { 
                    echo 'Squad'; 
                } ?>
            </div>
        </div>
        
        <div class="squad-grid">
            <?php if(isset($team_two_squad) && is_array($team_two_squad) && !empty($team_two_squad)) { 
                foreach($team_two_squad as $player) { ?>
                <div class="squad-player">
                    <img src="<?php echo isset($player->image_path) ? $player->image_path : 'https://via.placeholder.com/100';?>" alt="Player" class="squad-avatar">
                    <div class="squad-player-name"><?php echo $player->playerName; ?></div>
                </div>
            <?php } } else { ?>
                <div class="squad-player">
                    <img src="https://via.placeholder.com/100" alt="Player" class="squad-avatar">
                    <div class="squad-player-name">Squad not announced</div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>