<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Player Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Custom styles */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f1e9;
            padding: 2rem;
        }

        .container {
            max-width: 1000px;
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 2rem;
            text-align: center;
            color: #333;
        }

        .form-field {
            margin-bottom: 1.5rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.5rem;
        }

        .form-field label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #333;
            width: 100%;
        }

        .form-field input,
        .form-field select {
            flex: 1;
            min-width: 0;
            padding: 0.75rem;
            font-size: 1rem;
            border-radius: 8px;
            border: 1px solid #ced4da;
            transition: border 0.3s ease;
        }

        .form-field textarea {
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            border-radius: 8px;
            border: 1px solid #ced4da;
            transition: border 0.3s ease;
        }

        .form-field input:focus,
        .form-field select:focus,
        .form-field textarea:focus {
            border-color: #DDA15E;
            outline: none;
        }

        .form-field button {
            background-color: #DDA15E;
            border: none;
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            white-space: nowrap;
        }

        .form-field button:hover {
            background-color: #bc8b4c;
        }

        /* Flexbox layout for all screens */
        .form-container {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .form-container > div {
            flex: 1 1 45%;
            min-width: 300px;
        }

        /* Special handling for textarea */
        .form-field textarea + button {
            align-self: flex-start;
        }

        /* Media queries for mobile screens */
        @media (max-width: 768px) {
            .form-container {
                flex-direction: column;
            }
            
            .form-container > div {
                width: 100%;
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Edit Player Profile</h2>

        <div class="form-container">
            <!-- Player Name Update Form -->
            <div>
                <form action="<?php echo base_url();?>PlayerController/update_field/<?php echo $data['player_id']; ?>/playerName" method="POST">
                    <div class="form-field">
                        <label for="playerName">Player Name</label>
                        <input type="text" class="form-control" id="playerName" name="playerName" value="<?php echo $data['playerName']; ?>" required>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>

            <!-- City Update Form -->
            <div>
                <form action="<?php echo base_url();?>PlayerController/update_field/<?php echo $data['player_id']; ?>/city" method="POST">
                    <div class="form-field">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" value="<?php echo $data['city']; ?>" required>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="form-container">
            <!-- Date of Birth Update Form -->
            <div>
                <form action="<?php echo base_url();?>PlayerController/update_field/<?php echo $data['player_id']; ?>/date_of_birth" method="POST">
                    <div class="form-field">
                        <label for="date_of_birth">Date of Birth</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?php echo $data['date_of_birth']; ?>" required>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>

            <!-- Batting Style Update Form -->
            <div>
                <form action="<?php echo base_url();?>PlayerController/update_field/<?php echo $data['player_id']; ?>/batting_style" method="POST">
                    <div class="form-field">
                        <label for="batting_style">Batting Style</label>
                        <select class="form-select" id="batting_style" name="batting_style" required>
                            <option value="<?php echo $data['batting_style']; ?>" selected><?php echo $data['batting_style']; ?></option>
                            <option value="Right Hand Batsman">Right Hand Batsman</option>
                            <option value="Left Hand Batsman">Left Hand Batsman</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="form-container">
            <!-- Bowling Style Update Form -->
            <div>
                <form action="<?php echo base_url();?>PlayerController/update_field/<?php echo $data['player_id']; ?>/bowling_style" method="POST">
                    <div class="form-field">
                        <label for="bowling_style">Bowling Style</label>
                        <select class="form-select" id="bowling_style" name="bowling_style" required>
                            <option value="<?php echo $data['bowling_style']; ?>" selected><?php echo $data['bowling_style']; ?></option>
                            <option value="Not a Bowler">Not a Bowler</option>
                            <option value="Right-Arm Fast Bowler">Right-Arm Fast Bowler</option>
                            <option value="Left-Arm Fast Bowler">Left-Arm Fast Bowler</option>
                            <option value="Right-Arm Medium Fast Bowler">Right-Arm Medium Fast Bowler</option>
                            <option value="Left-Arm Medium Fast Bowler">Left-Arm Medium Fast Bowler</option>
                            <option value="Right-Arm Spin Bowler">Right-Arm Spin Bowler</option>
                            <option value="Left-Arm Spin Bowler">Left-Arm Spin Bowler</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>

            <!-- Player Role Update Form -->
            <div>
                <form action="<?php echo base_url();?>PlayerController/update_field/<?php echo $data['player_id']; ?>/player_role" method="POST">
                    <div class="form-field">
                        <label for="playerRole">Role</label>
                        <select class="form-select" id="playerRole" name="player_role" required>
                            <option value="<?php echo $data['player_role']; ?>" selected><?php echo $data['player_role']; ?></option>
                            <option value="Batsman">Batsman</option>
                            <option value="Bowler">Bowler</option>
                            <option value="All-Rounder">All-Rounder</option>
                            <option value="Wicket Keeper">Wicket Keeper</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Additional Information Update Form -->
        <form action="<?php echo base_url();?>PlayerController/update_field/<?php echo $data['player_id']; ?>/additional_info" method="POST">
            <div class="form-field">
                <label for="additional_info">Additional Information</label>
                <textarea class="form-control" id="additional_info" name="additional_info" rows="4" required><?php echo $data['additional_info']; ?></textarea>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>

    </div>

</body>
</html>