


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cricket Match Schedule</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7f9fc;
        }

        .schedule-card {
            background: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 8px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .team-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .team {
            text-align: center;
            flex: 1;
        }

        .team-logo {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-bottom: 5px;
        }

        .vs-text {
            font-size: 16px;
            font-weight: bold;
            color: #007bff;
            text-align: center;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .match-details {
            font-size: 13px;
            color: #555;
            text-align: center;
        }

        .badge-info {
            font-size: 11px;
            padding: 3px 6px;
            border-radius: 4px;
        }

        .scorecard-btn {
            display: block;
            text-align: center;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 6px 12px;
            border-radius: 5px;
            font-size: 14px;
            transition: 0.3s ease-in-out;
        }

        .scorecard-btn:hover {
            background-color: #0056b3;
            color: white;
        }

        @media (max-width: 576px) {
            .team-logo {
                width: 30px;
                height: 30px;
            }

            .vs-text {
                font-size: 14px;
            }

            .match-details {
                font-size: 12px;
            }

            .scorecard-btn {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

    <div class="container py-3">
        <h1 class="text-center mb-3">Cricket Match Schedule</h1>
 
        <!-- Match Cards Grid -->
        <div class="row">
          <?php  foreach($data as $schedule_info)
                {?>
            <!-- Match Card 1 -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="schedule-card">
                    <div class="team-info">
                        <div class="team">
                            <img src="<?php echo $schedule_info->team_one_image;?>" alt="India" class="team-logo">
                            <p class="mb-0"><?php echo $schedule_info->team_one_name;?></p>
                        </div>
                        <div class="vs-text">VS</div>
                        <div class="team">
                            <img src="<?php echo $schedule_info->team_two_image;?>" alt="Pakistan" class="team-logo">
                            <p class="mb-0"><?php echo $schedule_info->team_two_name;?></p>
                        </div>
                    </div>
                    <div class="match-details mt-2">
                        <p><strong>Date:</strong> <?php echo $schedule_info->match_date;?> <strong>| Time:</strong> <?php echo $schedule_info->match_time;?></p>
                        <p><strong>Location:</strong> <?php echo $schedule_info->location;?></p>
                        <p><span class="badge bg-warning text-dark badge-info"><?php echo $schedule_info->match_type;?></span> 
                           <span class="badge bg-primary text-white badge-info"><?php echo $schedule_info->series;?></span></p>
                        <p><strong>Overs:</strong> <?php echo $schedule_info->overs;?> <strong>| Umpires:</strong> <?php echo $schedule_info->umpire1; ?>, <?php echo $schedule_info->umpire2; ?></p>
                    </div>
                    <a href="<?php echo base_url();?>Welcome/toss/<?php echo $schedule_info->team_one_id;?>/<?php echo $schedule_info->team_two_id;?>/<?php echo $schedule_info->match_id;?>" class="scorecard-btn mt-2">View/Enter Scorecard</a>
                </div>
            </div>
          <?php } ?>
            <!-- Match Card 2 -->
           
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
