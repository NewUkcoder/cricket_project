<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
      --primary-color: #006D77;
      --primary-hover: #005A62;
      --secondary-color: #283618;
      --accent-color: #FEFAE0;
      --danger-color: #BC4749;
      --warning-color: #DDA15E;
      --success-color: #606C38;
      --light-bg: #F8F1E9;
      --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
      --card-shadow-hover: 0 10px 15px rgba(0, 0, 0, 0.1);
      --border-radius: 12px;
      --transition: all 0.3s ease;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--light-bg);
      color: var(--secondary-color);
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
      color: var(--secondary-color);
    }

    .player-section p {
      font-size: 0.9rem;
      color: #6c757d;
      margin: 0.25rem 0;
    }

    .player-section a {
      display: inline-block;
      margin-top: 0.5rem;
      text-decoration: none;
      font-weight: 500;
      font-size: 0.9rem;
      transition: var(--transition);
    }

    .btn-view-profile {
      background: linear-gradient(135deg, var(--primary-color), #008B97);
      color: #fff;
      border: none;
      border-radius: 20px;
      padding: 0.6rem 1.2rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      transition: var(--transition);
    }

    .btn-view-profile:hover {
      background: linear-gradient(135deg, var(--primary-hover), #007A85);
      color: #fff;
      box-shadow: 0 4px 8px rgba(0, 109, 119, 0.2);
      transform: translateY(-2px);
    }

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
      background-color: rgba(0, 109, 119, 0.1);
    }

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
      color: var(--secondary-color);
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
      color: var(--secondary-color);
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
      color: #fff;
    }

    .btn-primary:hover {
      background-color: var(--primary-hover);
      border-color: var(--primary-hover);
      color: #fff;
    }

    .btn-warning {
      background-color: var(--warning-color);
      border-color: var(--warning-color);
      color: #fff;
    }

    .btn-warning:hover {
      background-color: #c98f4c;
      border-color: #c98f4c;
    }

    .btn-danger {
      background-color: var(--danger-color);
      border-color: var(--danger-color);
      color: #fff;
    }

    .btn-danger:hover {
      background-color: #a83d3f;
      border-color: #a83d3f;
    }

    .empty-state {
      text-align: center;
      padding: 2rem;
      color: #6c757d;
    }

    .empty-state p {
      margin-bottom: 1.5rem;
    }

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

    .profile-image-container {
      position: relative;
      display: inline-block;
      margin-bottom: 1rem;
    }

    .profile-image-upload {
      margin-top: 0.5rem;
      width: 100%;
    }

    .profile-image-upload input {
      display: none;
    }

    .default-profile-icon {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      background-color: #e9ecef;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1rem;
      border: 3px solid var(--primary-color);
    }

    .default-profile-icon i {
      font-size: 2.5rem;
      color: #6c757d;
    }

    .preview-container {
      margin: 0.5rem 0;
    }

    .preview-image {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 50%;
      border: 2px solid var(--primary-color);
      display: none;
    }

    .alert {
      margin-bottom: 1rem;
    }

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
          <?php } else { ?>
            <!-- Display success/error messages -->
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $this->session->flashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>

            <?php echo form_open_multipart('PlayerController/update_player_picture/' . $data['player_id'], ['id' => 'profilePictureForm']); ?>
              <div class="profile-image-container">
                <?php if (!empty($data['image_path'])) { ?>
                  <img src="<?php echo $data['image_path']; ?>" alt="User Photo" id="currentImage">
                <?php } else { ?>
                  <div class="default-profile-icon">
                    <i class="fas fa-user"></i>
                  </div>
                <?php } ?>
                <div class="preview-container">
                  <img id="imagePreview" class="preview-image">
                </div>
                <div class="profile-image-upload">
                  <input type="file" id="profile_image" name="profile_image" accept="image/*" onchange="previewImage(event)">
                  <label for="profile_image" class="btn btn-primary btn-sm">Choose Picture</label>
                  <button type="submit" name="submit" class="btn btn-success btn-sm" style="display: none;" id="uploadButton">Upload</button>
                </div>
              </div>
            <?php echo form_close(); ?>

            <h5><?php echo $data['playerName']; ?></h5>
            <p>Role: <?php echo $data['player_role']; ?></p>
            <p>City: <?php echo $data['city']; ?></p>
            <div class="action-buttons">
              <a href="<?php echo base_url(); ?>PlayerController/profile_player/<?php echo $data['player_id']; ?>" class="btn-view-profile">View Profile</a>
              <a href="<?php echo base_url(); ?>PlayerController/update_player/<?php echo $data['player_id']; ?>" class="btn btn-warning btn-sm">Edit Profile</a>
            </div>
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
    function showSection(sectionId) {
      document.querySelectorAll('.section').forEach(section => {
        section.classList.remove('active');
      });
      document.getElementById(`${sectionId}-section`).classList.add('active');
      document.querySelectorAll('.link-bar button').forEach(button => {
        button.classList.remove('active');
      });
      event.currentTarget.classList.add('active');
    }

    function previewImage(event) {
      const preview = document.getElementById('imagePreview');
      const uploadButton = document.getElementById('uploadButton');
      const currentImage = document.getElementById('currentImage');
      const file = event.target.files[0];

      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.style.display = 'block';
          uploadButton.style.display = 'inline-block';
          if (currentImage) {
            currentImage.style.display = 'none';
          }
        }
        reader.readAsDataURL(file);
      } else {
        preview.style.display = 'none';
        uploadButton.style.display = 'none';
        if (currentImage) {
          currentImage.style.display = 'block';
        }
      }
    }

    document.addEventListener('DOMContentLoaded', () => {
      showSection('teams');
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>