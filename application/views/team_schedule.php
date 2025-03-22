<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Schedule</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            color: #333;
            padding: 20px;
        }

        h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            background-color: #fff;
            width: 100%;
            max-width: 350px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            background: linear-gradient(135deg, #ffffff, #f4f4f4);
            margin-bottom: 20px;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            padding: 15px;
            background-color: #2c3e50;
            color: white;
            font-size: 18px;
            text-align: center;
            font-weight: bold;
        }

        .card-body {
            padding: 20px;
            text-align: center;
        }

        .match-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .team-logo-container {
            text-align: center;
        }

        .team-logo {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .team-name {
            font-size: 12px;
            color: #555;
            margin-top: 5px;
            font-weight: 600;
        }

        .card-footer {
            padding: 15px;
            background-color: #ecf0f1;
            text-align: center;
            font-size: 14px;
        }

        .actions a {
            text-decoration: none;
            color: #3498db;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 5px;
            background-color: #e0e4e7;
            transition: background-color 0.3s ease;
            margin: 0 5px;
        }

        .actions a:hover {
            background-color: #d0d5d9;
        }

        @media (max-width: 768px) {
            .container {
                width: 95%;
            }

            .card {
                width: 100%;
                margin-bottom: 15px;
            }

            .match-info {
                flex-direction: column;
                gap: 10px;
            }

            .team-logo {
                width: 30px;
                height: 30px;
            }

            .card-body p {
                font-size: 14px;
            }

            .card-footer {
                padding: 10px;
            }
        }

        @media (max-width: 480px) {
            .card {
                max-width: 100%;
                margin: 10px 0;
            }

            .card-header {
                font-size: 16px;
                padding: 12px;
            }

            .card-body {
                padding: 15px;
            }

            .match-info {
                font-size: 14px;
            }

            .actions a {
                padding: 5px 10px;
                font-size: 12px;
            }
        }

    </style>
</head>

<body>

    <h2> Schedule</h2>

    <div class="container">
        <?php if($team_schedule == 0) { 
            echo "<p>No match is added yet</p>"; 
        } else { 
            foreach ($team_schedule as $value) { 
        ?>
        <div class="card">
            <div class="card-header">
                Match Details
            </div>
            <div class="card-body">
                <div class="match-info">
                    <div class="team-logo-container">
                        <img src="<?php echo $value->team_one_image;?>" alt="Team 5 Logo" class="team-logo">
                        <p class="team-name"><?php echo strtoupper(substr($value->team_one_name, 0, 3));?></p> <!-- Team initials -->
                    </div>
                     <?php $date=$value->match_date; $formatted_date = date("d F Y", strtotime($date)); ?>
                    <span><?php echo $formatted_date;?></span>
                    <div class="team-logo-container">
                        <img src="<?php echo $value->team_two_image;?>" alt="Team 6 Logo" class="team-logo">
                        <p class="team-name"><?php echo strtoupper(substr($value->team_two_name, 0, 3));?></p> <!-- Team initials -->
                    </div>
                </div>
                <div class="match-details">
                    <p><strong>Time:</strong> <?php echo $value->match_time;?></p>
                    <p><strong>Overs:</strong> <?php echo $value->overs;?></p>
                    <p><strong>Venue:</strong> <?php echo $value->location;?></p>
                </div>
            </div>
            <div class="card-footer actions">
                   <?php if($this->session->userdata('user_id')==$value->user_id): ?>
                <a href="<?php echo base_url();?>Welcome/toss/<?php echo $value->team_one_id;?>/<?php echo $value->team_two_id;?>/<?php echo $value->match_id;?>" class="scorecard-btn">Add Scorecard</a>
                 <?php endif; ?>
                <a href="<?php echo base_url();?>Welcome/scorecard/<?php echo $value->team_one_id;?>/<?php echo $value->team_two_id;?>/<?php echo $value->match_id;?>" class="scorecard-btn">View Scorecard</a>
            </div>
        </div>
        <?php } } ?>
    </div>

</body>

</html>
