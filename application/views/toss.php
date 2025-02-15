
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f8ff;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .team-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .team {
            font-size: 1.5em;
            font-weight: bold;
            padding: 10px 20px;
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 150px;
        }

        .team1 {
            background-color: #1E90FF; /* Blue */
        }

        .team2 {
            background-color: #32CD32; /* Green */
        }

        .form-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
            font-size: 1.1em;
        }

        .form-container select, .form-container input {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1.1em;
        }

        .submit-btn {
            padding: 10px 20px;
            background-color: #32CD32;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #28a745;
        }

        .result-container {
            text-align: center;
            margin-top: 20px;
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
        }

        .result {
            margin: 10px 0;
        }

        .result span {
            font-size: 1.5em;
            color: #006400;
            font-weight: bold;
        }

        @media (max-width: 600px) {
            .team-container {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="team-container">
         <?php if ($team_one && $team_two){ ?>
        <div class="team team1"> <?php echo $team_one->team_name; ?></div>Vs
        <div class="team team2"><?php echo $team_two->team_name; ?></div>
    </div>

    <!-- Form to select toss winner, decision, and user's name -->
    <form action="<?php echo base_url();?>/ScorecardController/add_first_batting" method="POST" class="form-container">
        

        <select id="tossWinner" name="toss_winner" required>
            <option value="">Who won the toss. Select Here</option>
            <option value="<?php echo $team_one->team_id; ?>"><?php echo $team_one->team_name; ?> won the toss</option>
            <option value="<?php echo $team_two->team_id; ?>"><?php echo $team_two->team_name; ?> won the toss</option>
        </select>
            <input type="hidden" value="<?php echo $team_one->team_id;?>" name="team_one">
            <input type="hidden" value="<?php echo $team_two->team_id;?>" name="team_two">
            <input type="hidden" value="<?php echo $match_id;?>" name="match_id">
        <select id="decision" name="decision" required>
            <option value="">What is decision</option>
            <option value="bat">Bat first</option>
            <option value="bowl">Bowl first</option>
        </select>

        <button type="submit" class="submit-btn">Submit</button>
    </form>
<?php } ?>
</div>

</body>
</html>
