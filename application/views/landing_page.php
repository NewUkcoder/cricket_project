<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Professional Layout</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f4f9;
      color: #333;
      margin: 0;
      padding: 0;
    }

    .container {
      padding: 20px;
      display: flex;
      flex-direction: column;
    }

    .main-content {
      display: flex;
      gap: 20px;
    }

    /* Player Section (Sidebar) */
    .player-section {
      width: 250px; /* Fixed width for player section */
      background-color: #fff;
      border-radius: 15px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 15px;
      text-align: center;
    }

    .player-section img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 50%;
    }

    .player-section h5 {
      font-size: 1.2rem;
      font-weight: bold;
      margin: 10px 0 5px;
    }

    .player-section p {
      font-size: 0.9rem;
      color: #666;
      margin: 3px 0;
    }

    .player-section a {
      display: inline-block;
      margin-top: 10px;
      color: #3498db;
      text-decoration: none;
    }

    .player-section a:hover {
      text-decoration: underline;
    }

    /* Link Bar for Teams and Tournaments */
    .link-bar {
      display: flex;
      justify-content: flex-start;
      gap: 10px;
      margin-bottom: 20px;
    }

    .link-bar button {
      background-color: #3498db;
      border: none;
      border-radius: 8px;
      padding: 10px 20px;
      font-size: 0.9rem;
      color: white;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .link-bar button.active {
      background-color: #2980b9;
    }

    .link-bar button:hover {
      background-color: #2980b9;
    }

    /* Teams and Tournaments Section */
    .content-section {
      flex: 1;
      background-color: #fff;
      border-radius: 15px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }

    .section-header {
      font-size: 1.5rem;
      font-weight: bold;
      margin-bottom: 20px;
      color: #2c3e50;
    }

    .grid-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }

    .card {
      border: none;
      border-radius: 15px;
      overflow: hidden;
      background-color: #fff;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
    }

    .card img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 50%;
      margin-right: 15px;
    }

    .card-body {
      display: flex;
      align-items: center;
      padding: 15px;
    }

    .card-title {
      font-size: 1.1rem;
      font-weight: bold;
      margin: 0;
    }

    .action-buttons {
      display: flex;
      justify-content: flex-start;
      gap: 10px;
      margin-top: 10px;
    }

    .btn-primary {
      background-color: #3498db;
      border: none;
      border-radius: 8px;
      padding: 8px 16px;
      font-size: 0.9rem;
      transition: background-color 0.3s;
    }

    .btn-primary:hover {
      background-color: #2980b9;
    }

    .btn-warning {
      background-color: #f39c12;
      border: none;
      border-radius: 8px;
    }

    .btn-warning:hover {
      background-color: #e67e22;
    }

    .btn-danger {
      background-color: #e74c3c;
      border: none;
      border-radius: 8px;
    }

    .btn-danger:hover {
      background-color: #c0392b;
    }

    /* Hide sections by default */
    .section {
      display: none;
    }

    .section.active {
      display: block;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
      .main-content {
        flex-direction: column;
      }

      .player-section {
        width: 100%;
        padding: 15px;
        margin-bottom: 20px;
      }

      .player-section img {
        width: 60px;
        height: 60px;
      }

      .link-bar {
        justify-content: center;
      }

      .grid-container {
        grid-template-columns: 1fr;
      }

      .card img {
        width: 50px;
        height: 50px;
      }

      .section-header {
        font-size: 1.2rem;
      }

      .card-title {
        font-size: 1rem;
      }

      .btn-primary, .btn-warning, .btn-danger {
        font-size: 0.8rem;
        padding: 6px 12px;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <!-- Main Content -->
    <div class="main-content">
      <!-- Player Section (Sidebar) -->
      <div class="player-section">
        <div class="profile-info">
          <?php if ($user == 0) { ?>
            <p>You are not registered as a player yet.</p>
            <a href="<?php echo base_url(); ?>Welcome/enter_player">
              <button class="btn btn-primary">Register as a Player</button>
            </a>
          <?php } else {
            foreach ($user as $player) { ?>
              <img src="<?php echo $player->image_path; ?>" alt="User Photo">
              <h5><?php echo $player->playerName; ?></h5>
              <p>Role: <?php echo $player->player_role; ?></p>
              <p>City: <?php echo $player->city; ?></p>
              <a href="<?php echo base_url(); ?>PlayerController/profile_player">View Profile</a>
            <?php }
          } ?>
        </div>
      </div>

      <!-- Teams and Tournaments Section -->
      <div class="content-section">
        <!-- Link Bar -->
        <div class="link-bar">
          <button onclick="showSection('teams')" class="active">Teams</button>
          <button onclick="showSection('tournaments')">Tournaments</button>
        </div>

        <!-- Teams Section -->
        <div id="teams-section" class="section active">
          <div class="section-header">
            <h4>My Teams</h4>
             <button class="btn btn-primary" onclick="location.href='<?php echo base_url(); ?>Welcome/enter_team'">Add Team</button>
          </div>
          <?php if ($team == 0) { ?>
            <div class="create-btn">
              <p>You do not have a team yet. Create one.</p>
              <a href="<?php echo base_url(); ?>Welcome/enter_team">
                <button class="btn btn-primary">Create Team</button>
              </a>
            </div>
          <?php } else { ?>
            <div class="grid-container">
              <?php foreach ($team as $team_info) { ?>
                <div class="card">
                  <div class="card-body">
                    <img src="<?php echo $team_info->image_path; ?>" alt="Team Logo">
                    <h5 class="card-title"><a href="<?php echo base_url();?>TeamController/team_profile/<?php echo $team_info->team_id;?>"><?php echo $team_info->team_name;?></a></h5>
                  </div>
                  <div class="action-buttons">
                    <button class="btn btn-warning btn-sm">Edit</button>
                    <button class="btn btn-danger btn-sm">Delete</button>
                  </div>
                </div>
              <?php } ?>
            </div>
          <?php } ?>
        </div>

        <!-- Tournaments Section -->
        <div id="tournaments-section" class="section">
          <div class="section-header">
            <h4>Tournaments</h4>
             <button class="btn btn-primary" onclick="location.href='<?php echo base_url(); ?>Welcome/enter_team'">Add Team</button>
          </div>
          <div class="grid-container">
            <div class="card">
              <div class="card-body">
                <img src="https://via.placeholder.com/400x225" alt="Tournament Logo">
                <h5 class="card-title">Tournament 1</h5>
              </div>
              <div class="action-buttons">
                <button class="btn btn-warning btn-sm">Edit</button>
                <button class="btn btn-danger btn-sm">Delete</button>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <img src="https://via.placeholder.com/400x225" alt="Tournament Logo">
                <h5 class="card-title">Tournament 2</h5>
              </div>
              <div class="action-buttons">
                <button class="btn btn-warning btn-sm">Edit</button>
                <button class="btn btn-danger btn-sm">Delete</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Function to toggle sections
    function showSection(sectionId) {
      // Hide all sections
      document.querySelectorAll('.section').forEach(section => {
        section.classList.remove('active');
      });

      // Show the selected section
      document.getElementById(`${sectionId}-section`).classList.add('active');

      // Update link bar buttons
      document.querySelectorAll('.link-bar button').forEach(button => {
        button.classList.remove('active');
      });
      document.querySelector(`.link-bar button[onclick="showSection('${sectionId}')"]`).classList.add('active');
    }

    // Initialize the default section
    document.addEventListener('DOMContentLoaded', () => {
      showSection('teams'); // Show Teams section by default
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
