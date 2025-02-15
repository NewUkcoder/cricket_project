<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cricket Club</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Section */
        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            margin: 15px 0;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .club-logo {
            max-width: 60px;
            border-radius: 50%;
            border: 2px solid #007bff;
            transition: transform 0.3s ease;
        }

        .club-logo:hover {
            transform: scale(1.1);
        }

        .club-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #007bff;
            margin-left: 10px;
        }

        /* Player Requests Section */
        .player-requests-section {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .player-requests-section h3 {
            font-size: 1.4rem;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 20px;
        }

        .request-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .request-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .request-card .details {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            width: 70%; /* Take up most of the available space */
        }

        .request-card .details img {
            max-width: 60px;
            max-height: 60px;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 15px;
        }

        .request-card .details h4 {
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 5px;
            width: 100%;
        }

        .request-card .details p {
            font-size: 0.9rem;
            color: #666;
            margin: 0;
            width: 100%;
        }

        .request-card .actions {
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: flex-end;
            width: 25%; /* Ensure the buttons only take up part of the space */
        }

        .btn {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .btn-accept {
            background-color: #28a745;
            color: #fff;
            border: none;
        }

        .btn-accept:hover {
            background-color: #218838;
        }

        .btn-reject {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }

        .btn-reject:hover {
            background-color: #c82333;
        }

        .badge-pending {
            background-color: #ffc107;
            color: #000;
            font-size: 0.8rem;
            padding: 5px 10px;
            border-radius: 20px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .request-card {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                gap: 10px;
            }

            .request-card .details {
                width: 60%; /* Adjust for smaller screen width */
            }

            .request-card .actions {
                width: 35%; /* Buttons take up smaller width */
            }

            .btn {
                font-size: 0.8rem; /* Reduce button text size for mobile */
                padding: 5px 12px; /* Slightly smaller button padding */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header-container">
            <div class="d-flex align-items-center">
                <img src="team_logo.jpg" alt="Cricket Club Logo" class="club-logo">
                <div class="club-title">Cricket Club</div>
            </div>
        </div>
       
        <!-- Player Requests Section -->
        <section id="player-requests" class="player-requests-section">
            <h3>Player Requests <span class="badge badge-pending">2 Pending</span></h3>
            <?php  foreach ($request as $player_info) { ?>
            <div class="request-card">
                <div class="details">
                    <img src="<?php echo $player_info->image_path; ?>" alt="Player Image">
                    <a href="<?php echo base_url();?>PlayerController/profile_player/<?php echo $player_info->player_id;?>"> 
                        <h4><?php echo $player_info->playerName;?></h4>
                    </a>
                    <p><strong>Role:</strong> <?php echo $player_info->player_role;?></p>
                </div>
                <div class="actions">
                   <a href="<?php echo base_url();?>TeamController/accept_request/<?php echo $player_info->player_id;?>/<?php echo $player_info->team_id;?>"> 
                    <button class="btn btn-accept">Accept</button>
                    </a>
                    <a href="<?php echo base_url();?>TeamController/cancel_player_request/<?php echo $player_info->player_id;?>/<?php echo $player_info->team_id;?>"> 
                    <button class="btn btn-reject">Reject</button>
                </a>
                </div>
            </div>
            <?php } ?>
        </section>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
