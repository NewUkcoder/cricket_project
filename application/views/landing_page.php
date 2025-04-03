<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Player Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-color: #4361ee;
      --primary-hover: #3a56d4;
      --secondary-color: #3f37c9;
      --accent-color: #4895ef;
      --danger-color: #f72585;
      --warning-color: #f8961e;
      --success-color: #4cc9f0;
      --light-bg: #f8f9fa;
      --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
      --card-shadow-hover: 0 10px 15px rgba(0, 0, 0, 0.1);
      --border-radius: 12px;
      --transition: all 0.3s ease;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--light-bg);
      color: #2b2d42;
      line-height: 1.6;
      margin: 0;
      padding: 0;
    }

    .container {
      padding: 2rem 1rem;
      max-width: 1400px;
      margin: 0 auto;
    }

    .main-content {
      display: flex;
      gap: 1.5rem;
      flex-wrap: wrap;
    }

    /* Player Section (Sidebar) */
    .player-section {
      flex: 0 0 280px;
      background-color: #fff;
      border-radius: var(--border-radius);
      box-shadow: var(--card-shadow);
      padding: 1.5rem;
      text-align: center;
      height: fit-content;
    }

    .profile-info {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .player-section img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 50%;
      border: 3px solid var(--primary-color);
      margin-bottom: 1rem;
    }

    .player-section h5 {
      font-size: 1.25rem;
      font-weight: 600;
      margin: 0.5rem 0;
      color: #2b2d42;
    }

    .player-section p {
      font-size: 0.9rem;
      color: #6c757d;
      margin: 0.25rem 0;
    }

    .player-section a {
      display: inline-block;
      margin-top: 1rem;
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 500;
      font-size: 0.9rem;
      transition: var(--transition);
    }

    .player-section a:hover {
      color: var(--primary-hover);
      text-decoration: underline;
    }

    /* Link Bar for Teams and Tournaments */
    .link-bar {
      display: flex;
      justify-content: flex-start;
      gap: 0.75rem;
      margin-bottom: 1.5rem;
      border-bottom: 1px solid #e9ecef;
      padding-bottom: 1rem;
    }

    .link-bar button {
      background-color: transparent;
      border: none;
      border-radius: 8px;
      padding: 0.5rem 1.25rem;
      font-size: 0.9rem;
      font-weight: 500;
      color: #6c757d;
      cursor: pointer;
      transition: var(--transition);
      position: relative;
    }

    .link-bar button.active {
      color: var(--primary-color);
    }

    .link-bar button.active::after {
      content: '';
      position: absolute;
      bottom: -1.1rem;
      left: 0;
      width: 100%;
      height: 3px;
      background-color: var(--primary-color);
      border-radius: 3px 3px 0 0;
    }

    .link-bar button:hover {
      color: var(--primary-color);
      background-color: rgba(67, 97, 238, 0.1);
    }

    /* Teams and Tournaments Section */
    .content-section {
      flex: 1;
      min-width: 300px;
      background-color: #fff;
      border-radius: var(--border-radius);
      box-shadow: var(--card-shadow);
      padding: 1.5rem;
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .section-header h4 {
      font-size: 1.4rem;
      font-weight: 600;
      margin: 0;
      color: #2b2d42;
    }

    .grid-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
      gap: 1.25rem;
    }

    .card {
      border: none;
      border-radius: var(--border-radius);
      overflow: hidden;
      background-color: #fff;
      box-shadow: var(--card-shadow);
      transition: var(--transition);
      padding: 1rem;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: var(--card-shadow-hover);
    }

    .card img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 50%;
      margin-right: 1rem;
      border: 2px solid #e9ecef;
    }

    .card-body {
      display: flex;
      align-items: center;
      padding: 0;
    }

    .card-title {
      font-size: 1rem;
      font-weight: 600;
      margin: 0;
    }

    .card-title a {
      color: #2b2d42;
      text-decoration: none;
      transition: var(--transition);
    }

    .card-title a:hover {
      color: var(--primary-color);
      text-decoration: underline;
    }

    .action-buttons {
      display: flex;
      justify-content: flex-start;
      gap: 0.75rem;
      margin-top: 1rem;
    }

    .btn {
      border-radius: 8px;
      font-weight: 500;
      font-size: 0.85rem;
      padding: 0.5rem 0.9rem;
      transition: var(--transition);
    }

    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
    }

    .btn-primary:hover {
      background-color: var(--primary-hover);
      border-color: var(--primary-hover);
    }

    .btn-warning {
      background-color: var(--warning-color);
      border-color: var(--warning-color);
      color: #fff;
    }

    .btn-warning:hover {
      background-color: #e68a19;
      border-color: #e68a19;
    }

    .btn-danger {
      background-color: var(--danger-color);
      border-color: var(--danger-color);
    }

    .btn-danger:hover {
      background-color: #e5177a;
      border-color: #e5177a;
    }

    /* Empty state styles */
    .empty-state {
      text-align: center;
      padding: 2rem;
      color: #6c757d;
    }

    .empty-state p {
      margin-bottom: 1.5rem;
    }

    /* Hide sections by default */
    .section {
      display: none;
      animation: fadeIn 0.3s ease;
    }

    .section.active {
      display: block;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    /* Responsive styles */
    @media (max-width: 992px) {
      .player-section {
        flex: 0 0 100%;
      }
      
      .content-section {
        flex: 1 0 100%;
      }
    }

    @media (max-width: 768px) {
      .container {
        padding: 1rem;
      }
      
      .player-section {
        padding: 1.25rem;
      }
      
      .player-section img {
        width: 80px;
        height: 80px;
      }
      
      .link-bar {
        justify-content: center;
      }
      
      .section-header {
        flex-direction: column;
        align-items: flex-start;
      }
      
      .section-header h4 {
        font-size: 1.25rem;
      }
      
      .grid-container {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 576px) {
      .link-bar {
        gap: 0.5rem;
      }
      
      .link-bar button {
        padding: 0.5rem 0.75rem;
        font-size: 0.8rem;
      }
      
      .action-buttons {
        flex-wrap: wrap;
      }
      
      .btn {
        font-size: 0.8rem;
        padding: 0.4rem 0.75rem;
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
          <?php if ($data == 0) { ?>
            <p>You are not registered as a player yet.</p>
            <a href="<?php echo base_url(); ?>Welcome/enter_player">
              <button class="btn btn-primary">Register as a Player</button>
            </a>
          <?php } else  { ?>
              <img src="<?php echo $data['image_path']; ?>" alt="User Photo">
              <h5><?php echo $data['playerName']; ?></h5>
              <p>Role: <?php echo $data['player_role']; ?></p>
              <p>City: <?php echo $data['city']; ?></p>
              <a href="<?php echo base_url(); ?>PlayerController/profile_player">View Profile</a>
            <?php } ?>
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
            <div class="empty-state">
              <p>You do not have a team yet. Create one to get started.</p>
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
            <button class="btn btn-primary" onclick="location.href='<?php echo base_url();?>Welcome/add_tournament'">Add Tournament</button>
          </div>
          <?php if (empty($tournament)) { ?>
            <div class="empty-state">
              <p>Currently no tournaments available. Create one to get started.</p>
              <button class="btn btn-primary" onclick="location.href='<?php echo base_url();?>Welcome/add_tournament'">Create Tournament</button>
            </div>
          <?php } else { ?>
            <div class="grid-container">
              <div class="card">
                <div class="card-body">
                  <img src="https://via.placeholder.com/400x225" alt="Tournament Logo">
                  <h5 class="card-title"><a href="<?php echo base_url();?>Welcome/tournament_landing">Tournament 1</a></h5>
                </div>
                <div class="action-buttons">
                  <button class="btn btn-warning btn-sm">Edit</button>
                </div>
              </div>
              <?php foreach ($tournament as $league) { ?>
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><a href="<?php echo base_url();?>Welcome/tournament_main/<?php echo $league->league_id;?>"><?php echo $league->league_name;?></a></h5>
                  </div>
                  <div class="action-buttons">
                    <button class="btn btn-warning btn-sm">Edit</button>
                  </div>
                </div>
              <?php } ?>
            </div>
          <?php } ?>
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
      event.currentTarget.classList.add('active');
    }

    // Initialize the default section
    document.addEventListener('DOMContentLoaded', () => {
      showSection('teams'); // Show Teams section by default
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>