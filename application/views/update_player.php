<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Display error or success messages -->
  
 
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .form-container {
            max-width: 700px;
            margin: auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-header h2 {
            font-weight: bold;
            background: linear-gradient(to right, #007bff, #00c853);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control {
            border: 2px solid #007bff;
            border-radius: 10px;
        }

        .form-control:focus {
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.8);
            border-color: #00c853;
        }

        .btn-primary {
            background: linear-gradient(to right, #007bff, #00c853);
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 10px;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #00c853, #007bff);
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 15px;
            }

            .form-header h2 {
                font-size: 1.5rem;
            }

            .btn-primary {
                padding: 8px 15px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="form-container">
          

            <div class="form-header">
                <h2>Player Registration</h2>
                <p>Fill in the details to create a player profile</p>
            </div>

            <form action="<?php echo base_url();?>PlayerController/to_update_player"  method="POST" enctype="multipart/form-data">
                <!-- Profile Picture -->
               
               <?php foreach($data as $player_info)
                {?>
                <!-- Player Information -->
                <div class="mb-3">
                    <label for="playerName" class="form-label">Player Name</label>
                    <input type="text" class="form-control" id="playerName" name="playerName" value="<?php echo $player_info->playerName;?>" required>
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?php echo $player_info->city;?>" required>
                </div>

                 <div class="mb-3">
                    <label for="playerName" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="playerName" name="date_of_birth" value="<?php echo $player_info->date_of_birth;?>" required>
                </div>

                 <div class="mb-3">
                    <label for="playerRole" class="form-label">Select Batting Style</label>
                    <select class="form-select" id="playerRole" name="batting_style" required>
                        
                        <option value="<?php echo $player_info->batting_style;?>"><?php echo $player_info->batting_style;?></option>
                        <option value="Right Hand Batsman">Right Hand Batsman</option>
                        <option value="Left Hand Batsman">Left Hand Batsman</option>
                       
                    </select>
                </div>

                 <div class="mb-3">
                    <label for="playerRole" class="form-label">Select Bowling Style</label>
                    <select class="form-select" id="playerRole" name="bowling_style" required>
                        <option value="<?php echo $player_info->bowling_style;?>"><?php echo $player_info->bowling_style;?></option>
                        <option value="">Not a Bowler</option>
                        <option value="Right-Arm Fast bowler">Right-Arm Fast bowler</option>
                        <option value="Left-Arm Fast Bowler">Left-Arm Fast Bowler</option>
                        <option value="Right-Arm Medium Fast Bowler">Right-Arm Medium Fast Bowler</option>
                        <option value="Left-Arm Medium Fast Bowler">Left-Arm Medium Fast Bowler</option>
                        <option value="Right-Arm Spin Bowler">Right-Arm Spin Bowler</option>
                        <option value="Left-Arm Spin Bowler">Left-Arm Spin Bowler</option>
                       
                    </select>
                </div>

                <div class="mb-3">
                    <label for="playerRole" class="form-label">Role</label>
                    <select class="form-select" id="playerRole" name="playerRole" required>
                        <option value="<?php echo $player_info->player_role;?>"><?php echo $player_info->player_role;?></option>
                        <option value="Batsman">Batsman</option>
                        <option value="Bowler">Bowler</option>
                        <option value="All-Rounder">All-Rounder</option>
                        <option value="Wicket Keeper">Wicket Keeper</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="playerStats" class="form-label">Additional Information</label>
                    <textarea class="form-control" id="playerStats" name="additional_info" rows="4" value="<?php echo $player_info->additional_info;?>"></textarea>
                </div>
            <?php } ?>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
