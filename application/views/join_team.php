<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Cricket Teams</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            padding-bottom: 70px;
            background-color: #f0f4f8;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .team-item {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.3s;
        }

        .team-item:hover {
            background-color: #e0f7fa;
        }

        .team-item span {
            font-size: 1.1rem;
            color: #333;
        }

        .join-btn {
            background-color: #009688;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background-color 0.3s, transform 0.2s;
        }

        .join-btn:hover {
            background-color: #00796b;
            transform: scale(1.05);
        }

        .notification {
            padding: 10px;
            background-color: #2ecc71;
            color: white;
            border-radius: 5px;
            font-size: 0.9rem;
            display: none;
            margin: 15px 0;
            text-align: center;
        }

        .notification.visible {
            display: block;
        }

        .no-teams {
            text-align: center;
            margin: 20px 0;
            color: #666;
            font-size: 1.1rem;
        }

        .search-form input {
            border-radius: 25px;
            font-size: 0.9rem;
            padding: 10px;
        }

        .search-form button {
            border-radius: 25px;
            background-color: #008c8c;
            border: none;
            padding: 10px 20px;
            font-size: 0.9rem;
        }

        .search-form button:hover {
            background-color: #00796b;
        }

        .tm-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #ffffff;
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
            color: #333;
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
            color: #008c8c;
        }

        @media screen and (max-width: 768px) {
            .container {
                max-width: 90%;
            }

            h2 {
                font-size: 1.5rem;
            }

            .team-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
                padding: 12px;
            }

            .team-item span {
                font-size: 1rem;
            }

            .join-btn {
                width: 100%;
                padding: 10px;
                font-size: 0.9rem;
            }

            .search-form input {
                font-size: 0.85rem;
                padding: 8px;
            }

            .search-form button {
                padding: 8px 15px;
                font-size: 0.85rem;
            }

            .notification {
                font-size: 0.85rem;
                padding: 8px;
            }

            .no-teams {
                font-size: 1rem;
            }

            .tm-footer-nav a {
                font-size: 12px;
            }

            .tm-footer-nav a i {
                font-size: 16px;
            }
        }

        @media screen and (max-width: 480px) {
            .team-item span {
                font-size: 0.9rem;
            }

            .join-btn {
                padding: 8px;
                font-size: 0.85rem;
            }

            .search-form input {
                font-size: 0.8rem;
            }

            .search-form button {
                padding: 8px 12px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Search and Join Cricket Teams</h2>

        <!-- Search Form -->
        <div class="mb-4 search-form">
            <form action="<?php echo site_url('PlayerController/search_team'); ?>" method="POST" class="d-flex">
                <input type="hidden" value="<?php echo $player_id; ?>" name="player_id">
                <input type="text" name="email" class="form-control me-2" placeholder="Search for a team..." value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>" required>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <!-- Notification -->
        <div id="notification" class="notification"></div>

        <!-- Display Teams -->
        <div id="team-list">
            <?php if (!empty($teams)): ?>
                <?php foreach ($teams as $team): ?>
                    <div class="team-item">
                        <span><?php echo htmlspecialchars($team->team_name); ?></span>
                        <button class="join-btn" data-team-id="<?php echo $team->team_id; ?>" data-player-id="<?php echo $player_id; ?>">Join</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-teams">No teams found. Try searching for another team!</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Fixed Mobile Footer -->
    <footer class="tm-footer">
        <div class="tm-footer-nav">
            <a href="<?php echo base_url(); ?>Welcome/landing_page">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
            <a href="<?php echo base_url(); ?>PlayerController/profile_player/<?php echo htmlspecialchars($player_id); ?>">
                <i class="fas fa-user"></i>
                <span><?php echo htmlspecialchars($player_name['playerName'] ?? 'Player Profile'); ?></span>
            </a>
        </div>
    </footer>

    <!-- Bootstrap JS & Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.join-btn').click(function() {
                const teamId = $(this).data('team-id');
                const playerId = $(this).data('player-id');
                $.ajax({
                    url: '<?php echo base_url(); ?>PlayerController/insert_team',
                    type: 'POST',
                    data: { team_id: teamId, player_id: playerId },
                    success: function(response) {
                        const data = JSON.parse(response);
                        if (data.status === 'success') {
                            $('#notification').text(data.message).addClass('visible');
                            setTimeout(function() {
                                window.location.href = '<?php echo base_url(); ?>PlayerController/sent_team_request/<?php echo $player_id; ?>';
                            }, 3000);
                        } else {
                            alert(data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error joining the team. Please try again.');
                    }
                });
            });
        });
    </script>
</body>
</html>