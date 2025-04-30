<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Squad</title>
    <style>
        /* Global Styles */
        body {
            
            margin: 0;
            padding: 20px;
            padding-bottom: 70px; /* Space for fixed footer */
            background-color: #f4f4f9;
            color: #333;
            min-height: 100vh;
            overflow-x: hidden;
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            margin: 20px 0 10px;
            color: #1a73e8;
        }

        .team-name-header {
            text-align: center;
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 20px;
        }

        h2 {
            text-align: center;
            font-size: 1.8rem;
            margin: 15px 0;
            color: #e91e63;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
            gap: 20px;
        }

        .category {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .player-card {
            background-color: #fff;
            border-radius: 12px;
            overflow: hidden;
            width: 150px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .player-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .player-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-bottom: 2px solid #1a73e8;
        }

        .player-card h3 {
            margin: 10px 0;
            font-size: 1.2rem;
            color: #1a73e8;
        }

        .player-card p {
            margin: 5px 0;
            font-size: 0.9rem;
            color: #666;
        }

        /* Fixed Mobile Footer */
        .tm-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #ffffff; /* White background */
            padding: 10px 0;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .tm-footer-nav {
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .tm-footer-nav a {
            color: #333; /* Darker text for contrast */
            text-decoration: none;
            font-size: 14px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }

        .tm-footer-nav a i {
            font-size: 18px;
        }

        .tm-footer-nav a:hover {
            color: #1a73e8;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                gap: 15px;
            }

            .player-card {
                width: calc(33.33% - 10px); /* Three cards per row with gap */
                max-width: 120px;
            }

            .player-card img {
                height: 120px;
            }

            h1 {
                font-size: 2rem;
            }

            .team-name-header {
                font-size: 1rem;
            }

            h2 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .player-card {
                width: calc(33.33% - 10px); /* Maintain three cards per row */
                max-width: 100px;
            }

            .player-card img {
                height: 100px;
            }

            .player-card h3 {
                font-size: 1rem;
            }

            .player-card p {
                font-size: 0.8rem;
            }

            .tm-footer-nav a {
                font-size: 12px;
            }

            .tm-footer-nav a i {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <h1>Team Squad</h1>
    <p class="team-name-header">Squad for <?php echo htmlspecialchars($team_name); ?></p>

    <?php 
    // Group players by their roles
    $roles = ['Batsman', 'All-Rounder', 'Wicket-Keeper', 'Spinner', 'Fast-Bowler'];
    
    // Loop through each role and display players
    foreach ($roles as $role) { 
        // Filter players by role
        $filtered_players = array_filter($squad, function($player) use ($role) {
            return $player->player_role == $role;
        });

        // If there are players for this role, display the category
        if (!empty($filtered_players)) { ?>
            <div class="category">
                <h2><?php echo ucfirst($role . 's'); ?></h2>
                <div class="container">
                    <?php foreach ($filtered_players as $player) { ?>
                        <div class="player-card">
                            <a href="<?php echo base_url(); ?>PlayerController/player_info/<?php echo $player->player_id; ?>">
                                <img src="<?php echo $player->image_path; ?>" alt="<?php echo $player->playerName; ?>">
                                <h3><?php echo $player->playerName; ?></h3>
                                <p><?php echo $player->player_role; ?></p>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } 
    } ?>

    <!-- Fixed Mobile Footer -->
    <footer class="tm-footer">
        <div class="tm-footer-nav">
            <a href="<?php echo base_url(); ?>Welcome/landing_page">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
            <a href="<?php echo base_url(); ?>TeamController/team_profile/<?php echo $team_id; ?>">
                <i class="fas fa-users"></i>
                <span><?php echo htmlspecialchars($team_name); ?></span>
            </a>
        </div>
    </footer>

    <!-- Font Awesome for icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>