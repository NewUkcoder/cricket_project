<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Cricket Leaderboard - Mobile Optimized</title>
    <style>
        /* Modern Color Scheme */
        :root {
            --primary: #1d4ed8;
            --secondary: #3b82f6;
            --accent: #f59e0b;
            --background: #f3f4f6;
            --text: #111827;
            --text-light: #6b7280;
            --border: #e5e7eb;
        }

        /* Base Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: var(--background);
            line-height: 1.5;
            padding: 0.5rem;
            min-height: 100vh;
        }

        /* Leaderboard Container */
        .stats-table {
            max-width: 500px; /* Reduced width for laptops */
            margin: 0.5rem auto; /* Centered with auto margins */
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        /* Header Section */
        .table-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 1rem;
            text-align: center;
            position: relative;
        }

        .table-header h1 {
            color: white;
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0.5rem 0;
        }

        .table-header p {
            color: rgba(255,255,255,0.9);
            font-size: 0.875rem;
        }

        .back-link {
            position: absolute;
            left: 1rem;
            top: 1rem;
            color: white;
            text-decoration: none;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        . VerenArrow {
            font-size: 1rem;
        }

        .back-arrow {
            font-size: 1rem;
        }

        /* Table Header Row */
        .table-header-row {
            display: grid;
            grid-template-columns: 50px 1fr auto;
            padding: 0.75rem 1rem;
            background: #f9fafb;
            border-bottom: 1px solid var(--border);
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .header-cell {
            padding: 0.25rem;
        }

        .header-cell:last-child {
            text-align: right;
        }

        /* Player Rows */
        .table-row {
            display: grid;
            grid-template-columns: 50px 1fr auto;
            align-items: center;
            padding: 0.75rem 1rem;
            gap: 0.75rem;
            border-bottom: 1px solid var(--border);
            transition: background 0.2s ease;
        }

        .table-row:last-child {
            border-bottom: none;
        }

        /* Rank Badge */
        .rank {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            background: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.875rem;
            color: var(--text-light);
        }

        .rank-top {
            background: var(--accent);
            color: white;
        }

        /* Player Info */
        .player-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .player-photo {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid var(--border);
        }

        .player-details {
            flex: 1;
        }

        .player-name {
            font-weight: 500;
            color: var(--text);
            font-size: 0.9375rem;
        }

        .player-team {
            color: var(--text-light);
            font-size: 0.75rem;
        }

        /* Score Display */
        .total-score {
            font-weight: 600;
            color: var(--primary);
            font-size: 0.9375rem;
            text-align: right;
        }

        /* Mobile Optimization */
        @media (max-width: 480px) {
            body {
                padding: 0;
            }

            .stats-table {
                max-width: 100%; /* Full width on mobile */
                margin: 0; /* No margins */
                border-radius: 0; /* No rounded corners for full-screen look */
                box-shadow: none; /* Remove shadow for cleaner mobile view */
            }

            .table-header h1 {
                font-size: 1.125rem;
            }

            .table-header-row {
                grid-template-columns: 40px 1fr auto;
                padding: 0.5rem;
                font-size: 0.6875rem;
            }

            .table-row {
                grid-template-columns: 40px 1fr auto;
                padding: 0.5rem;
                gap: 0.5rem;
            }

            .player-photo {
                width: 32px;
                height: 32px;
            }

            .player-name {
                font-size: 0.875rem;
            }

            .player-team {
                font-size: 0.6875rem;
            }

            .total-score {
                font-size: 0.875rem;
            }

            .rank {
                width: 28px;
                height: 28px;
                font-size: 0.75rem;
            }
        }

        /* Interaction States */
        @media (hover: hover) {
            .table-row:hover {
                background: #f9fafb;
            }
        }

        .table-row:active {
            background: #f3f4f6;
        }

        /* Top Player Highlights */
        .table-row:first-child .rank {
            background: linear-gradient(135deg, #f59e0b, #f97316);
            color: white;
        }

        .table-row:nth-child(2) .rank {
            background: #d1d5db;
            color: var(--text);
        }

        .table-row:nth-child(3) .rank {
            background: #e5e7eb;
            color: var(--text);
        }
    </style>
</head>
<body>
    <div class="stats-table">
        <div class="table-header">
            <a href="javascript:history.back()" class="back-link">
                <span class="back-arrow">←</span>
                Back
            </a>
            <h1><?php echo $league['league_name']; ?></h1>
            <p>League Highest Scorer</p>
        </div>
        <div class="table-header-row">
            <div class="header-cell">Rank</div>
            <div class="header-cell">Player</div>
            <div class="header-cell">Runs</div>
        </div>
        <?php 
        $rank = 1;
        foreach($top_ten_scorer as $scorer) { ?>
            <div class="table-row">
                <div class="rank <?php echo $rank <= 3 ? 'rank-top' : ''; ?>">
                    <?php echo $rank++; ?>
                </div>
                <div class="player-info">
                    <img src="<?php echo $scorer->player_image;?>" 
                         alt="<?php echo $scorer->playerName;?>" 
                         class="player-photo">
                    <div class="player-details">
                        <span class="player-name"><?php echo $scorer->playerName;?></span>
                        <span class="player-team"><?php echo $scorer->team_name;?></span>
                    </div>
                </div>
                <div class="total-score"><?php echo $scorer->total_runs;?></div>
            </div>
        <?php } ?>
    </div>
</body>
</html>