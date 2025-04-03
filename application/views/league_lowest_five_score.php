<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cricket League Lowest Scores</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f5f6fa;
        }

        .standings-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .title-section {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e74c3c;
        }

        .league-title {
            color: #2c3e50;
            font-size: 1.8rem;
            margin-bottom: 5px;
        }

        .subtitle {
            color: #e74c3c;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .standing-row {
            display: flex;
            align-items: center;
            padding: 15px;
            margin-bottom: 12px;
            background: #f8f9fa;
            border-radius: 8px;
            position: relative;
            transition: transform 0.2s ease;
        }

        .standing-row:hover {
            transform: translateY(-2px);
        }

        .rank {
            font-weight: bold;
            color: #fff;
            width: 40px;
            height: 40px;
            text-align: center;
            line-height: 40px;
            border-radius: 50%;
            background: #e74c3c;
        }

        .rank.rank-top {
            background: #e67e22;
        }

        .team-info {
            flex: 1;
            display: flex;
            align-items: center;
            margin-left: 15px;
        }

        .team-logo {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 15px;
            border: 2px solid #ddd;
        }

        .team-name {
            font-weight: 600;
            color: #2c3e50;
            font-size: 1rem;
        }

        .score-info {
            text-align: right;
            margin-left: 15px;
        }

        .runs {
            font-weight: 700;
            color: #e74c3c;
            font-size: 1rem;
        }

        .score-details {
            color: #95a5a6;
            font-size: 0.8rem;
            margin-top: 3px;
        }

        .scorecard-link {
            color: #e74c3c;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            margin-left: 15px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .scorecard-link:hover {
            color: #c23616;
            text-decoration: underline;
        }

        .link-icon {
            margin-left: 6px;
            font-size: 0.9em;
        }

        .performance-tag {
            font-size: 0.75rem;
            padding: 2px 8px;
            border-radius: 10px;
            margin-left: 10px;
            background: #f8d7da;
            color: #721c24;
        }

        @media (max-width: 480px) {
            .standings-container {
                margin: 10px;
                padding: 15px;
            }

            .team-info {
                margin-left: 10px;
            }

            .team-logo {
                margin-right: 10px;
            }

            .team-name {
                font-size: 0.9rem;
            }

            .runs {
                font-size: 0.9rem;
            }

            .score-details {
                font-size: 0.75rem;
            }

            .scorecard-link {
                position: absolute;
                right: 15px;
                bottom: 8px;
                font-size: 0.75rem;
                background: rgba(232, 65, 24, 0.1);
                padding: 3px 8px;
                border-radius: 4px;
            }

            .link-icon {
                display: none;
            }

            .performance-tag {
                position: absolute;
                right: 15px;
                bottom: 28px;
                font-size: 0.65rem;
            }
         .back-link {
            position: absolute;
            top: 25px;
            left: 25px;
            color: #e74c3c;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: #c23616;
            text-decoration: underline;
        }

        .back-arrow {
            margin-right: 6px;
            font-size: 1.1em;
        }

        .title-section {
            position: relative;
            padding-top: 35px;
        }

        @media (max-width: 480px) {
            .back-link {
                top: 15px;
                left: 15px;
                font-size: 0.8rem;
            }
            
            .standings-container {
                padding-top: 45px;
            }
        }
    </style>
</head>
<body>
    <div class="standings-container">
        <div class="title-section">
            <a href="javascript:history.back()" class="back-link">
                <span class="back-arrow">←</span>
                Back
            </a>
            <h1 class="league-title"><?php echo $league['league_name']; ?></h1>
            <p class="subtitle">Lowest Team Scores</p>
        </div>
        
        <?php $rank = 1; ?>
        <?php foreach($top_five_teams as $scorer) { ?>
            <div class="standing-row">
                <div class="rank <?php echo $rank <= 3 ? 'rank-top' : ''; ?>">
                    <?php echo $rank++; ?>
                </div>
                <div class="team-info">
                    <img src="<?php echo $scorer->team_image;?>" class="team-logo" alt="<?php echo $scorer->team_name;?>">
                    <span class="team-name"><?php echo $scorer->team_name;?></span>
                    <?php if($scorer->wickets == 10) { ?>
                        <span class="performance-tag">All Out</span>
                    <?php } ?>
                </div>
                <div class="score-info">
                    <div class="runs"><?php echo $scorer->highest_team_score;?></div>
                    <div class="score-details">
                        <?php echo $scorer->wickets;?> wkts • <?php echo $scorer->t_overs;?> ov
                    </div>
                </div>
                <a href="" class="scorecard-link">
                    View
                    <span class="link-icon">→</span>
                </a>
            </div>
        <?php } ?>
    </div>
</body>
</html>