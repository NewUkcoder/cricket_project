<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Cricket Leaderboard - Modern Design</title>
    <style>
        /* Modern Color Scheme */
        :root {
            --primary: #2563eb;
            --secondary: #4f46e5;
            --accent: #f59e0b;
            --background: #f8fafc;
            --text: #1e293b;
            --text-light: #64748b;
        }

        /* Base Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: var(--background);
            line-height: 1.5;
            padding: 1rem;
            min-height: 100vh;
        }

        /* Leaderboard Container */
        .stats-table {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05), 0 4px 6px -2px rgba(0,0,0,0.02);
            overflow: hidden;
        }

        /* Header Section */
        .table-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 1.5rem;
            text-align: center;
        }

        .table-header h1 {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.025em;
        }

        /* Player Rows */
        .table-row {
            display: grid;
            grid-template-columns: 50px 1fr auto;
            align-items: center;
            padding: 1rem 1.5rem;
            gap: 1rem;
            border-bottom: 1px solid #f1f5f9;
            transition: background 0.2s ease;
        }

        .table-row:last-child {
            border-bottom: none;
        }

        /* Rank Badge */
        .rank {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
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
            gap: 1rem;
        }

        .player-photo {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid #e2e8f0;
        }

        .player-details {
            flex: 1;
        }

        .player-name {
            font-weight: 600;
            color: var(--text);
            font-size: 1rem;
            margin-bottom: 0.125rem;
        }

        .player-team {
            color: var(--text-light);
            font-size: 0.875rem;
            display: block;
        }

        /* Score Display */
        .total-score {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.125rem;
            min-width: 60px;
            text-align: right;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .stats-table {
                border-radius: 1rem;
            }

            .table-row {
                padding: 1rem;
                grid-template-columns: 40px 1fr auto;
                gap: 0.75rem;
            }

            .player-photo {
                width: 36px;
                height: 36px;
            }

            .player-name {
                font-size: 0.9375rem;
            }

            .player-team {
                font-size: 0.8125rem;
            }

            .total-score {
                font-size: 1rem;
            }

            .rank {
                width: 32px;
                height: 32px;
                font-size: 0.875rem;
            }
        }

        /* Interaction States */
        @media (hover: hover) {
            .table-row:hover {
                background: #f8fafc;
            }
        }

        .table-row:active {
            background: #f1f5f9;
        }

        /* Top Player Highlight */
        .table-row:first-child .rank {
            background: linear-gradient(135deg, #f59e0b, #f97316);
            color: white;
        }

        .table-row:nth-child(2) .rank {
            background: #cbd5e1;
            color: var(--text);
        }

        .table-row:nth-child(3) .rank {
            background: #e2e8f0;
            color: var(--text-light);
        }
    </style>
</head>
<body>
    <div class="stats-table">
        <div class="table-header">
            <h1><?php echo $league['league_name']; ?></h1>
            <p> League Top Individual Performance</p>
        </div>

        <?php //var_dump($top_ten_player);
        $rank = 1;
        foreach($top_ten_player as $scorer) { ?>
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
                <div class="total-score"><?php echo $scorer->highest_score;?></div>
            </div>
        <?php } ?>
    </div>
</body>
</html>