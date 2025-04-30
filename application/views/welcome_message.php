

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cricket Management Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .dashboard-section {
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .dashboard-section h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #343a40;
        }
        .dashboard-section ul {
            list-style: none;
            padding: 0;
        }
        .dashboard-section ul li {
            margin: 10px 0;
            text-align: center;
        }
        .dashboard-section ul li a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        .dashboard-section ul li a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="dashboard-section">
                <h2>Enter Records</h2>
                <ul>
                    <li><a href="<?php echo base_url();?>Welcome/enter_player">Add Player</a></li>
                    <li><a href="<?php echo base_url();?>Welcome/enter_team">Add Team</a></li>
                    <li><a href="<?php echo base_url();?>Welcome/enter_schedule">Add Match Schedule</a></li>
                    <li><a href="<?php echo base_url();?>ScorecardController/live_score">Add Scorecard</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-section">
                <h2>View Records</h2>
                <ul>
                	<li><a href="<?php echo base_url();?>Welcome/landing_page">Home</a></li>
                    <li><a href="<?php echo base_url();?>PlayerController/profile_player"> View Player Profil</a></li>
                    <li><a href="<?php echo base_url();?>TeamController/my_teams">View Teams</a></li>
                    <li><a href="<?php echo base_url();?>ScheduleController/schedule">View Match Schedules</a></li>
                    <li><a href="<?php echo base_url();?>Welcome/scorecard">View Scorecards</a></li>
                    <li><a href="<?php echo base_url();?>Welcome/match_summary">View Match Summary</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-section">
                <h2>Update/Delete Records</h2>
                <ul>
                    <li><a href="<?php echo base_url();?>PlayerController/update_player">Edit/Delete Player</a></li>
                    <li><a href="#edit-team">Edit/Delete Team</a></li>
                    <li><a href="#edit-schedule">Edit/Delete Match Schedule</a></li>
                    <li><a href="#edit-scorecard">Edit/Delete Scorecard</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

