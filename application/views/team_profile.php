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

        .stats-container {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            flex-wrap: wrap;
        }

        .stats-item {
            background: #fff;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-weight: 500;
            flex: 1;
            min-width: 80px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stats-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .stats-title {
            font-size: 0.9rem;
            color: #007bff;
        }

        .stats-value {
            font-size: 1.2rem;
            color: #333;
        }

        /* Link Bar */
        .link-bar {
            display: flex;
            overflow-x: auto;
            gap: 10px;
            padding: 10px 0;
            margin-bottom: 20px;
            scrollbar-width: none; /* For Firefox */
            -ms-overflow-style: none; /* For Internet Explorer and Edge */
        }

        .link-bar::-webkit-scrollbar {
            display: none; /* For Chrome, Safari, and Opera */
        }

        .link-bar a {
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 20px;
            background-color: #f8f9fa;
            color: #007bff;
            font-size: 0.8rem; /* Smaller text size */
            font-weight: 500;
            white-space: nowrap;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .link-bar a:hover {
            background-color: #007bff;
            color: #fff;
        }

        .link-bar a.join-tournament {
            background-color: #ff5722; /* Original color for Join Tournament */
            color: #fff;
        }

        .link-bar a.join-tournament:hover {
            background-color: #e64a19;
        }

        .link-bar a.invite-team {
            background-color: #28a745; /* Green */
            color: #fff;
        }

        .link-bar a.invite-team:hover {
            background-color: #218838;
        }

        .link-bar a.match-request {
            background-color: #dc3545; /* Red */
            color: #fff;
        }

        .link-bar a.match-request:hover {
            background-color: #c82333;
        }

        .link-bar a.player-request {
            background-color: #ffc107; /* Yellow */
            color: #000;
        }

        .link-bar a.player-request:hover {
            background-color: #e0a800;
        }

        /* Team Information Section */
        .team-info-section {
            background: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .team-info-section h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 15px;
            text-align: center;
        }

        .team-info-section p {
            margin: 0;
            font-size: 0.9rem;
        }

        .team-admin-email {
            color: #007bff; /* Blue */
        }

        .team-admin-phone {
            color: #28a745; /* Green */
        }

        /* Team Management and Top Performers Section */
        .management-section, .top-performers-section {
            background: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .management-section h3, .top-performers-section h3 {
            font-size: 1.4rem;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 15px;
        }

        .management-member {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .management-member img {
            max-width: 50px;
            border-radius: 50%;
            border: 2px solid #007bff;
            transition: transform 0.3s ease;
        }

        .management-member img:hover {
            transform: scale(1.1);
        }

        .management-member p {
            margin: 0;
            font-size: 0.9rem;
        }

        .top-performers-section h3 {
            color: #ff5722;
            text-align: center;
        }

        .performer-row {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .player-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            font-size: 0.9rem;
            flex: 1;
            min-width: 120px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .player-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .player-card h4 {
            font-size: 1.1rem;
            color: #007bff;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .player-image {
            max-width: 80px;
            border-radius: 50%;
            border: 3px solid #007bff;
            transition: transform 0.3s ease;
        }

        .player-image:hover {
            transform: scale(1.1);
        }

        /* Recent Match Results Section */
        .recent-matches-section {
            background: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .recent-matches-section h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 15px;
            text-align: center;
        }

        .list-group-item {
            font-size: 0.9rem;
            padding: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .list-group-item:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .badge {
            font-size: 0.9rem;
        }

        /* Flash message container */
        .flashdata-message {
            font-family: Arial, sans-serif;
            font-size: 16px;
            margin: 10px 0;
            padding: 15px;
            border-radius: 5px;
        }

        /* Success message styles */
        .flashdata-message.success {
            background-color: #28a745;  /* Green background */
            color: white;               /* White text */
        }

        /* Error message styles */
        .flashdata-message.error {
            background-color: #dc3545;  /* Red background */
            color: white;               /* White text */
        }

        /* Current Captain Section */
        .current-captain-section {
            background: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .current-captain-section h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 15px;
            text-align: center;
        }

        .captain-cards {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .captain-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            font-size: 0.9rem;
            flex: 1;
            min-width: 120px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .captain-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .captain-card h4 {
            font-size: 1.1rem;
            color: #007bff;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .captain-image {
            max-width: 80px;
            border-radius: 50%;
            border: 3px solid #007bff;
            transition: transform 0.3s ease;
        }

        .captain-image:hover {
            transform: scale(1.1);
        }

        .edit-info-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .edit-info-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header-container">
            <div class="d-flex align-items-center">
                <img src="<?php echo $data['image_path'];?>" alt="Cricket Club Logo" class="club-logo">
                <div class="club-title"><?php echo $data['team_name'];?></div>
            </div>

            <?php $team_id=$data['team_id'];  ?>
            <div class="stats-container">
                <div class="stats-item">
                    <div class="stats-title">Matches</div>
                    <div class="stats-value"><?php echo $team_stats['total_matches']; ?></div>
                </div>
                <div class="stats-item">
                    <div class="stats-title">Wins</div>
                    <div class="stats-value"><?php echo $team_stats['win_matches']; ?></div>
                </div>
                <div class="stats-item">
                    <div class="stats-title">Losses</div>
                    <div class="stats-value"><?php echo $team_stats['lost_matches']; ?></div>
                </div>
            </div>
        </div>

        <?php if ($this->session->flashdata('message')): ?>
            <div class="flashdata-message <?php echo $this->session->flashdata('message_type'); ?>">
                <?php echo $this->session->flashdata('message'); ?>
            </div>
        <?php endif; ?>

        <!-- Horizontal Link Bar -->
        <div class="link-bar">
          <?php if($this->session->userdata('user_id')==$data['user_id']): ?>
            <a href="<?php echo base_url();?>Welcome/team_admin/<?php echo $team_id;?>" class="dashboard">Dashboard</a>
              <?php endif; ?>
            
            <a href="<?php echo base_url();?>TeamController/team_schedule/<?php echo $team_id;?>">View Schedule</a>

          
            <a href="<?php echo base_url();?>TeamController/team_squad/<?php echo $team_id;?>">Squad</a>
        </div>

        <!-- Team Information Section -->
        <section class="team-info-section">
            <h2>Team Information</h2>
            <?php if($this->session->userdata('user_id')==$data['user_id']): ?>
                <button class="edit-info-btn">Edit Information</button>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>City:</strong> <?php echo $data['city'];?></p>
                    <p><strong>Country:</strong> <?php echo $data['country'];?></p>
                    <p><strong>Joinning Date:</strong> <?php echo $data['created_at'];?></p>
                    <p><strong>Home Ground:</strong> <?php echo $data['home_ground'];?></p>
                    <p><strong>Admin Email:</strong> <span class="team-admin-email"><?php echo $data['email'];?></span></p>
                    <p><strong>Admin Phone:</strong> <span class="team-admin-phone"><?php echo $data['phone_number'];?></span></p>
                </div>
               <!--  <div class="col-md-6">
                    <p><strong>Total Members:</strong> 25</p>
                    <p><strong>Current Captain:</strong> John Doe</p>
                    <p><strong>Vice-Captain:</strong> Jane Smith</p>
                </div> -->
            </div>
        </section>

        <!-- Current Captain Section -->
        <section class="current-captain-section">
            <h2>Current Captain</h2>
            <div class="captain-cards">
                <div class="captain-card">
                    <h4>Leather Ball</h4>
                    <?php if ($captain['leather_ball']['status'] === 0)
                    { ?> <?php 
                        if($this->session->userdata('user_id')==$data['user_id']){ ?>
                        <a href="<?php echo base_url();?>TeamController/add_captain_leather/<?php echo $team_id;?>"><button class="add-info-btn">Add</button></a>
                    <?php } else { echo "Not added yet";}   
                     } else { ?>
                    <img src="<?php echo $captain['leather_ball']['image_path'];?>" alt="Leather Ball Captain" class="captain-image">
                    <p><?php echo $captain['leather_ball']['playerName'];?></p>
                    
                    <?php if($this->session->userdata('user_id')==$data['user_id']): ?>
                        <button class="edit-info-btn">Edit</button>
                    <?php endif; }?>
                </div>
                <div class="captain-card">
                    <h4>Tape Ball</h4>
                    <?php if ($captain['tape_ball']['status'] === 0)
                     { ?> <?php 
                        if($this->session->userdata('user_id')==$data['user_id']){ ?>
                        <a href="<?php echo base_url();?>TeamController/add_captain_tape/<?php echo $team_id;?>"><button class="add-info-btn">Add</button></a>
                    <?php } else { echo "Not added yet";}   
                     } else { ?>
                    <img src="<?php echo $captain['tape_ball']['image_path'];?>" alt="Leather Ball Captain" class="captain-image">
                    <p><?php echo $captain['tape_ball']['playerName'];?></p>
                    
                    <?php if($this->session->userdata('user_id')==$data['user_id']): ?>
                        <button class="edit-info-btn">Edit</button>
                    <?php endif; }?>
                </div>
                <div class="captain-card">
                    <h4>Tennis Ball</h4>
                    <?php if ($captain['tennis_ball']['status'] === 0)
                     { ?> <?php 
                        if($this->session->userdata('user_id')==$data['user_id']){ ?>
                        <a href="<?php echo base_url();?>TeamController/add_captain_tennis/<?php echo $team_id;?>"><button class="add-info-btn">Add</button></a>
                    <?php } else { echo "Not added yet";}   
                     } else { ?>
                    <img src="<?php echo $captain['tennis_ball']['image_path'];?>" alt="Leather Ball Captain" class="captain-image">
                    <p><?php echo $captain['tennis_ball']['playerName'];?></p>
                    
                    <?php if($this->session->userdata('user_id')==$data['user_id']): ?>
                        <button class="edit-info-btn">Edit</button>
                    <?php endif; }?>
                </div>
            </div>
        </section>

        <!-- Team Management and Top Performers Section -->
        <div class="row my-3">
            <div class="col-md-6">
                <div class="management-section">
                    <h3>Team Management</h3>
                    <div class="management-member">
                        <img src="coach.jpg" alt="Coach" class="management-member-img">
                        <div>
                            <p><strong>Coach:</strong> Michael Smith</p>
                        </div>
                    </div>
                    <div class="management-member">
                        <img src="assistant_coach.jpg" alt="Assistant Coach" class="management-member-img">
                        <div>
                            <p><strong>Assistant Coach:</strong> Sarah Johnson</p>
                        </div>
                    </div>
                    <div class="management-member">
                        <img src="manager.jpg" alt="Team Manager" class="management-member-img">
                        <div>
                            <p><strong>Manager:</strong> David Brown</p>
                        </div>
                    </div>
                    <div class="management-member">
                        <img src="physio.jpg" alt="Physiotherapist" class="management-member-img">
                        <div>
                            <p><strong>Assistant:</strong> Emily Davis</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="top-performers-section">
                    <h3>Player of the Team</h3>
                    <div class="performer-row">
                        <div class="player-card">
                            <h4>Leading Wicket-Taker</h4>
                            <img src="best_bowler.jpg" alt="Best Bowler" class="player-image">
                            <p>John Doe</p>
                            <p>120 wickets</p>
                        </div>
                        <div class="player-card">
                            <h4>Leading Batsman</h4>
                            <img src="best_batsman.jpg" alt="Best Batsman" class="player-image">
                            <p>Jane Smith</p>
                            <p>3,200 runs</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Match Results Section -->
        <section class="recent-matches-section">
            <h2>Recent Matches</h2>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Match 1: Cricket Club vs Rivals - Won by 20 runs
                    <span class="badge bg-success">W</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Match 2: Cricket Club vs Challengers - Lost by 5 wickets
                    <span class="badge bg-danger">L</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Match 3: Cricket Club vs Warriors - Won by 8 wickets
                    <span class="badge bg-success">W</span>
                </li>
            </ul>
        </section>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>