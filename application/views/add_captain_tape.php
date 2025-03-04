<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Player Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 1.2em;
        }

        .custom-select {
            position: relative;
            width: 100%;
        }

        .custom-select-trigger {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            font-size: 1em;
            border-radius: 5px;
            border: 1px solid #ddd;
            background-color: #fff;
            cursor: pointer;
        }

        .custom-select-trigger img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .custom-options {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 100;
            display: none;
            border-radius: 5px;
            border: 1px solid #ddd;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-height: 200px;
            overflow-y: auto;
        }

        .custom-option {
            display: flex;
            align-items: center;
            padding: 10px;
            cursor: pointer;
        }

        .custom-option:hover {
            background-color: #f4f4f4;
        }

        .custom-option img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .submit-btn {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #4CAF50;
            color: white;
            font-size: 1.2em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }

        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 1.5em;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Choose Current Captain</h1>

        <form action="<?= base_url('TeamController/insert_captain') ?>" method="POST" id="playerForm">
            <div class="form-group">
                <label for="player">For Leather Ball:</label>
                <div class="custom-select">
                    <div class="custom-select-trigger" id="playerTrigger">
                        <span>Select a player</span>
                    </div>
                    <div class="custom-options" id="playerOptions">
                        <?php foreach($players as $player_info) { ?>
                            <div class="custom-option" data-id="<?php echo $player_info->player_id;?>" data-name="<?php echo $player_info->playerName;?>" data-img="<?php echo $player_info->image_path;?>">
                                <img src="<?php echo $player_info->image_path;?>" alt="<?php echo $player_info->playerName;?>">
                                <span><?php echo $player_info->playerName;?></span>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <!-- Hidden inputs for both player name, ID, team_id, and leather_ball -->
            <input type="hidden" id="player" name="player">
            <input type="hidden" id="playerId" name="player_id">
            <input type="hidden" id="teamId" name="team_id" value="<?php echo $team_id;?>">
            <input type="hidden" id="ball_type" name="ball_type" value="tape_ball"> <!-- Assuming 1 for leather ball -->

            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>

    <script>
        const trigger = document.getElementById("playerTrigger");
        const optionsContainer = document.getElementById("playerOptions");
        const selectName = document.getElementById("player");
        const selectId = document.getElementById("playerId");
        const selectTeam = document.getElementById("teamId");
        const selectLeatherBall = document.getElementById("tape_ball");

        // Toggle the custom dropdown
        trigger.addEventListener("click", function() {
            optionsContainer.style.display = optionsContainer.style.display === "block" ? "none" : "block";
        });

        // Select an option and update the trigger
        const options = document.querySelectorAll(".custom-option");
        options.forEach(option => {
            option.addEventListener("click", function() {
                const playerName = this.getAttribute("data-name");
                const playerImgSrc = this.querySelector("img").src;
                const playerId = this.getAttribute("data-id");

                // Set the selected player's name and image to the trigger
                trigger.innerHTML = `<img src="${playerImgSrc}" alt="Selected player"> <span>${playerName}</span>`;

                // Store the player name and player ID in the hidden input fields
                selectName.value = playerName;
                selectId.value = playerId;

                // Hide the dropdown after selection
                optionsContainer.style.display = "none";
            });
        });

        // Handle form submission via JavaScript (optional)
        document.getElementById("playerForm").addEventListener("submit", function(event) {
            if (!selectName.value || !selectId.value) {
                alert("Please select a player!");
                event.preventDefault(); // Prevent form submission if no player selected
            }
        });
    </script>

</body>
</html>
