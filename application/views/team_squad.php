<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Squad</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #005F66;
            --primary-hover: #004A50;
            --secondary-color: #283618;
            --accent-color: #FEFAE0;
            --light-bg: #F8F1E9;
            --card-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            --card-shadow-hover: 0 6px 12px rgba(0, 0, 0, 0.1);
            --border-radius: 8px;
            --transition: all 0.3s ease;
            --spacing-xs: 4px;
            --spacing-sm: 8px;
            --spacing-md: 12px;
            --spacing-lg: 16px;
            --font-xs: 0.85rem;
            --font-sm: 0.875rem;
            --font-md: 1rem;
            --font-lg: 1.5rem;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            color: var(--secondary-color);
            margin: 0;
            padding: var(--spacing-md) var(--spacing-sm) var(--spacing-lg);
            min-height: 100vh;
            overflow-x: hidden;
        }

        h1 {
            text-align: center;
            font-size: var(--font-lg);
            font-weight: 600;
            margin: var(--spacing-sm) 0 var(--spacing-xs);
            color: var(--primary-color);
        }

        .team-name-header {
            text-align: center;
            font-size: var(--font-sm);
            font-weight: 500;
            color: #6c757d;
            margin-bottom: var(--spacing-md);
        }

        h2 {
            font-size: 1.25rem;
            font-weight: 600;
            margin: var(--spacing-sm) 0;
            color: var(--primary-color);
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--spacing-xs) var(--spacing-sm);
            background: var(--accent-color);
            border-radius: var(--border-radius);
        }

        h2::after {
            content: '\25BC';
            font-size: 0.8rem;
            transition: var(--transition);
        }

        h2.collapsed::after {
            content: '\25B6';
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: var(--spacing-sm);
            padding: var(--spacing-sm);
        }

        .category {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto var(--spacing-md);
            padding: var(--spacing-sm);
            background-color: #fff;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
        }

        .category-content {
            display: block;
            transition: max-height 0.3s ease, opacity 0.3s ease;
            overflow: hidden;
        }

        .category-content.collapsed {
            max-height: 0;
            opacity: 0;
            padding: 0;
        }

        .player-card {
            background-color: #fff;
            border-radius: var(--border-radius);
            overflow: hidden;
            text-align: center;
            transition: var(--transition);
            box-shadow: var(--card-shadow);
        }

        .player-card:hover {
            transform: scale(1.05);
            box-shadow: var(--card-shadow-hover);
        }

        .player-card a {
            display: block;
            text-decoration: none;
            color: inherit;
        }

        .player-card img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-bottom: 2px solid var(--primary-color);
            display: block;
            margin: 0 auto;
            loading: lazy;
        }

        .player-card h3 {
            margin: var(--spacing-xs) 0;
            font-size: var(--font-sm);
            font-weight: 600;
            color: var(--primary-color);
        }

        .player-card p {
            margin: 0 0 var(--spacing-xs);
            font-size: var(--font-xs);
            color: #6c757d;
        }

        .tm-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #fff;
            padding: var(--spacing-xs) 0;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .tm-footer-nav {
            display: flex;
            justify-content: space-around;
            align-items: center;
            max-width: 1100px;
            margin: 0 auto;
        }

        .tm-footer-nav a {
            color: var(--secondary-color);
            text-decoration: none;
            font-size: var(--font-xs);
            font-weight: 500;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: var(--spacing-xs);
            padding: var(--spacing-sm);
            transition: var(--transition);
            min-height: 44px;
        }

        .tm-footer-nav a i {
            font-size: 1.2rem;
        }

        .tm-footer-nav a:hover {
            color: var(--primary-hover);
        }

        @media (max-width: 768px) {
            body {
                padding: var(--spacing-sm) var(--spacing-xs) var(--spacing-md);
            }

            h1 {
                font-size: 1.25rem;
            }

            .team-name-header {
                font-size: var(--font-xs);
            }

            h2 {
                font-size: 1.1rem;
                padding: var(--spacing-xs);
            }

            .container {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
                gap: var(--spacing-xs);
                padding: var(--spacing-xs);
            }

            .category {
                padding: var(--spacing-xs);
                margin-bottom: var(--spacing-sm);
            }

            .player-card img {
                height: 80px;
            }

            .player-card h3 {
                font-size: var(--font-xs);
            }

            .player-card p {
                font-size: 0.8rem;
            }

            .tm-footer-nav a {
                font-size: 0.8rem;
                padding: var(--spacing-xs);
            }

            .tm-footer-nav a i {
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .container {
                grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
            }

            .player-card img {
                height: 70px;
            }

            .player-card h3 {
                font-size: 0.8rem;
            }

            .player-card p {
                font-size: 0.75rem;
            }
        }

        @media (min-width: 1200px) {
            .container {
                grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            }
        }
    </style>
</head>
<body>
    <h1>Team Squad</h1>
    <p class="team-name-header">Squad for <?php echo htmlspecialchars($team_name); ?></p>

    <?php 
    $roles = ['Batsman', 'All-Rounder', 'Wicket-Keeper', 'Spinner', 'Fast-Bowler'];
    foreach ($roles as $role) {
        $filtered_players = array_filter($squad, function($player) use ($role) {
            return $player->player_role == $role;
        });

        if (!empty($filtered_players)) { ?>
            <div class="category">
                <h2 onclick="toggleCategory(this)"><?php echo ucfirst($role . 's'); ?></h2>
                <div class="category-content">
                    <div class="container">
                        <?php foreach ($filtered_players as $player) { ?>
                            <div class="player-card">
                                <a href="<?php echo base_url(); ?>PlayerController/player_info/<?php echo htmlspecialchars($player->player_id); ?>" aria-label="View profile of <?php echo htmlspecialchars($player->playerName); ?>">
                                    <img src="<?php echo htmlspecialchars($player->image_path ?? 'default_player.png'); ?>" alt="<?php echo htmlspecialchars($player->playerName); ?>">
                                    <h3><?php echo htmlspecialchars($player->playerName); ?></h3>
                                    <p><?php echo htmlspecialchars($player->player_role); ?></p>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } 
    } ?>

    <footer class="tm-footer">
        <div class="tm-footer-nav">
            <a href="<?php echo base_url(); ?>Welcome/landing_page" aria-label="Go to Home">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
            <a href="<?php echo base_url(); ?>TeamController/team_profile/<?php echo htmlspecialchars($team_id); ?>" aria-label="Go to <?php echo htmlspecialchars($team_name); ?> Profile">
                <i class="fas fa-users"></i>
                <span><?php echo htmlspecialchars($team_name); ?></span>
            </a>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        function toggleCategory(header) {
            const content = header.nextElementSibling;
            const isCollapsed = content.classList.contains('collapsed');
            content.classList.toggle('collapsed', !isCollapsed);
            header.classList.toggle('collapsed', !isCollapsed);
            if (isCollapsed) {
                content.style.maxHeight = content.scrollHeight + 'px';
                content.style.opacity = 1;
            } else {
                content.style.maxHeight = 0;
                content.style.opacity = 0;
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.category-content').forEach(content => {
                content.style.maxHeight = content.scrollHeight + 'px';
            });
        });
    </script>
</body>
</html>