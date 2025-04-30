<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sent Team Requests</title>
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
            width: 70%;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-top: 5px solid #008c8c;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .no-requests {
            text-align: center;
            font-size: 1.2rem;
            color: #666;
            padding: 20px;
        }

        .request-list {
            list-style: none;
            padding: 0;
        }

        .request-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fafafa;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 15px;
            transition: transform 0.3s, background-color 0.3s;
        }

        .request-item:hover {
            transform: translateY(-5px);
            background-color: #e0f7fa;
        }

        .request-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .request-info img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .request-info div {
            display: flex;
            flex-direction: column;
        }

        .request-info p {
            margin: 0;
            font-size: 1rem;
            color: #333;
        }

        .status {
            font-weight: bold;
            color: #ff9800;
        }

        .btn {
            padding: 10px 20px;
            background-color: #009688;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .btn:hover {
            background-color: #00796b;
            transform: scale(1.05);
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
                width: 90%;
            }

            h1 {
                font-size: 1.5rem;
            }

            .request-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .request-info {
                flex-direction: row;
                align-items: center;
                width: 100%;
            }

            .request-info div {
                margin-left: 10px;
            }

            .btn {
                width: 100%;
                text-align: center;
                margin-top: 10px;
            }

            .request-item:hover {
                transform: none;
            }

            .tm-footer-nav a {
                font-size: 12px;
            }

            .tm-footer-nav a i {
                font-size: 16px;
            }
        }

        @media screen and (max-width: 480px) {
            .request-info img {
                width: 40px;
                height: 40px;
            }

            .request-info p {
                font-size: 0.9rem;
            }

            .btn {
                font-size: 0.8rem;
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($player_name['playerName']); ?>'s Sent Team Requests</h1>
        <?php if (empty($data)) { ?>
            <p class="no-requests">No team requests sent.</p>
        <?php } else { ?>
            <ul class="request-list">
                <?php foreach ($data as $request) { ?>
                    <li class="request-item">
                        <div class="request-info">
                            <img src="<?php echo $request->team_image_path; ?>" alt="Team Picture">
                            <div>
                                <p><strong>Team:</strong> <?php echo htmlspecialchars($request->team_name); ?></p>
                                <p><strong>Request Date:</strong> <?php echo date('F j, Y', strtotime($request->joined_at)); ?></p>
                                <p class="status">Status: <?php echo $request->status == 0 ? "Waiting" : "Approved"; ?></p>
                            </div>
                        </div>
                        <a href="<?php echo base_url(); ?>PlayerController/cancel_request/<?php echo $player_name['player_id']; ?>/<?php echo $request->team_id; ?>" class="btn">Cancel Request</a>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>

    <!-- Fixed Mobile Footer -->
    <footer class="tm-footer">
        <div class="tm-footer-nav">
            <a href="<?php echo base_url(); ?>Welcome/landing_page">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
            <a href="<?php echo base_url(); ?>PlayerController/profile_player/<?php echo htmlspecialchars($player_name['player_id']); ?>">
                <i class="fas fa-user"></i>
                <span><?php echo htmlspecialchars($player_name['playerName'] ?? 'Player Profile'); ?></span>
            </a>
        </div>
    </footer>

    <!-- Font Awesome for icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>