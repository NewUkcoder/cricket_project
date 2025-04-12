<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pakistan Squad 2025</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            margin: 20px 0;
            color: #1a73e8;
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

        /* New style for row grouping */
        .player-row {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .player-card {
                width: 120px;
            }

            .player-card img {
                height: 120px;
            }

            h1 {
                font-size: 2rem;
            }

            h2 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .player-card {
                width: 100%;
                max-width: 200px;
            }

            .player-card img {
                height: 150px;
            }

            .player-row {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <h1>Team Squad </h1>

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
                           <a href="<?php echo base_url();?>PlayerController/player_info/<?php echo $player->player_id;?>"> <img src="<?php echo $player->image_path; ?>" alt="<?php echo $player->playerName; ?>">
                            <h3><?php echo $player->playerName; ?></h3>
                            <p><?php echo $player->player_role; ?></p>
                        </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } 
    } ?>
</body>
</html>
