<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Player Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
  <style>
    :root {
      --primary-color: #005F66;
      --primary-hover: #004C52;
      --secondary-color: #283618;
      --accent-color: #FEFAE0;
      --danger-color: #BC4749;
      --warning-color: #DDA15E;
      --success-color: #606C38;
      --light-bg: #F8F1E9;
      --card-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
      --card-shadow-hover: 0 4px 8px rgba(0, 0, 0, 0.12);
      --spacing-xs: 2px;
      --spacing-sm: 5px;
      --spacing-md: 8px;
      --spacing-lg: 12px;
      --font-xs: 0.85rem;
      --font-sm: 0.875rem;
      --font-md: 1rem;
      --font-lg: 1.5rem;
      --border-radius: 8px;
      --transition: all 0.2s ease;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--light-bg);
      color: var(--secondary-color);
      line-height: 1.4;
      margin: 0;
      padding-bottom: 50px;
      font-size: var(--font-sm);
    }

    .container {
      padding: var(--spacing-md);
      max-width: 1200px;
      margin: 0 auto;
    }

    .main-content {
      display: flex;
      gap: var(--spacing-md);
      flex-wrap: wrap;
    }

    .player-section {
      flex: 0 0 240px;
      background-color: #fff;
      border-radius: var(--border-radius);
      box-shadow: var(--card-shadow);
      padding: var(--spacing-sm);
      text-align: center;
      height: fit-content;
    }

    .profile-info {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .player-section img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: var(--spacing-xs);
    }

    .player-section h5 {
      font-size: 0.9rem;
      font-weight: 600;
      margin: var(--spacing-xs) 0;
      color: var(--secondary-color);
      letter-spacing: 0.5px;
    }

    .player-section p {
      font-size: var(--font-xs);
      color: #6c757d;
      margin: var(--spacing-xs) 0;
    }

    .player-section a {
      display: block;
      margin: var(--spacing-xs) 0 0;
      text-decoration: none;
      font-weight: 500;
      font-size: var(--font-xs);
      transition: var(--transition);
    }

    .btn-view-profile {
      background: linear-gradient(135deg, var(--primary-color), #007A85);
      color: #fff;
      border: none;
      border-radius: var(--border-radius);
      padding: 0.2rem 0.5rem;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
      transition: var(--transition);
      min-height: 24px;
    }

    .btn-view-profile:hover {
      background: linear-gradient(135deg, var(--primary-hover), #006671);
      box-shadow: 0 2px 4px rgba(0, 95, 102, 0.2);
      transform: scale(1.05);
    }

    .link-bar {
      display: flex;
      justify-content: flex-start;
      gap: var(--spacing-sm);
      margin-bottom: var(--spacing-md);
      border-bottom: 1px solid #e9ecef;
      padding-bottom: var(--spacing-sm);
      overflow-x: auto;
      scrollbar-width: none;
    }

    .link-bar::-webkit-scrollbar { display: none; }

    .link-bar button {
      background-color: transparent;
      border: none;
      border-radius: var(--border-radius);
      padding: 0.2rem 0.5rem;
      font-size: var(--font-sm);
      font-weight: 500;
      color: #6c757d;
      cursor: pointer;
      transition: var(--transition);
      position: relative;
      white-space: nowrap;
      min-height: 32px;
    }

    .link-bar button.active {
      color: var(--primary-color);
    }

    .link-bar button.active::after {
      content: '';
      position: absolute;
      bottom: -1px;
      left: 0;
      width: 100%;
      height: 2px;
      background-color: var(--primary-color);
      border-radius: 2px 2px 0 0;
    }

    .link-bar button:hover {
      color: var(--primary-color);
      background-color: rgba(0, 95, 102, 0.1);
    }

    .content-section {
      flex: 1;
      min-width: 280px;
      background-color: #fff;
      border-radius: var(--border-radius);
      box-shadow: var(--card-shadow);
      padding: var(--spacing-md);
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: var(--spacing-md);
      flex-wrap: wrap;
      gap: var(--spacing-sm);
    }

    .section-header h4 {
      font-size: var(--font-lg);
      font-weight: 600;
      margin: 0;
      color: var(--secondary-color);
    }

    .grid-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
      gap: var(--spacing-sm);
    }

    .card {
      border: none;
      border-radius: var(--border-radius);
      background-color: #fff;
      box-shadow: var(--card-shadow);
      transition: var(--transition);
      padding: var(--spacing-sm);
    }

    .card:hover {
      transform: translateY(-3px);
      box-shadow: var(--card-shadow-hover);
    }

    .card img {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 50%;
      margin-right: var(--spacing-sm);
      border: 1px solid #e9ecef;
    }

    .card-body {
      display: flex;
      align-items: center;
      padding: 0;
    }

    .card-title {
      font-size: var(--font-md);
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
      flex-direction: column;
      align-items: center;
      gap: var(--spacing-xs);
      margin-top: var(--spacing-sm);
    }

    .btn {
      border-radius: var(--border-radius);
      font-weight: 500;
      font-size: var(--font-xs);
      padding: 0.2rem 0.5rem;
      transition: var(--transition);
      min-height: 24px;
    }

    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      color: #fff;
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
      padding: var(--spacing-md);
      color: #6c757d;
      background: var(--light-bg);
      border-radius: var(--border-radius);
      box-shadow: var(--card-shadow);
    }

    .empty-state i {
      font-size: 1rem;
      color: var(--primary-color);
      margin-bottom: var(--spacing-xs);
    }

    .empty-state p {
      margin-bottom: var(--spacing-sm);
      font-size: var(--font-xs);
    }

    .section {
      display: none;
      animation: fadeIn 0.3s ease;
    }

    .section.active {
      display: block;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(6px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .profile-image-container {
      position: relative;
      display: inline-block;
      margin-bottom: var(--spacing-xs);
    }

    .profile-image-upload {
      margin-top: var(--spacing-xs);
      width: 100%;
      display: flex;
      gap: var(--spacing-xs);
      justify-content: center;
    }

    .profile-image-upload input {
      display: none;
    }

    .default-profile-icon {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background-color: #e9ecef;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: var(--spacing-xs);
    }

    .default-profile-icon i {
      font-size: 1.5rem;
      color: #6c757d;
    }

    .preview-container {
      margin: var(--spacing-xs) 0;
    }

    .preview-image {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 50%;
      display: none;
    }

    .alert {
      margin-bottom: var(--spacing-sm);
      font-size: var(--font-xs);
      padding: var(--spacing-xs);
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
        padding: var(--spacing-sm);
      }
      .player-section {
        padding: var(--spacing-xs);
      }
      .player-section img, .default-profile-icon {
        width: 50px;
        height: 50px;
      }
      .player-section h5 {
        font-size: var(--font-xs);
      }
      .player-section p {
        font-size: 0.8rem;
      }
      .action-buttons {
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: flex-end;
      }
      .link-bar {
        justify-content: flex-start;
      }
      .section-header h4 {
        font-size: var(--font-md);
      }
      .grid-container {
        grid-template-columns: 1fr;
      }
      .card img {
        width: 40px;
        height: 40px;
      }
      .btn {
        padding: 0.15rem 0.4rem;
        font-size: 0.8rem;
        min-height: 20px;
      }
      .btn-view-profile {
        padding: 0.15rem 0.4rem;
        font-size: 0.8rem;
      }
      .preview-image {
        width: 40px;
        height: 40px;
      }
      .empty-state i {
        font-size: 0.9rem;
      }
      .default-profile-icon i {
        font-size: 1.2rem;
      }
    }

    @media (max-width: 576px) {
      .link-bar {
        gap: var(--spacing-xs);
      }
      .link-bar button {
        padding: 0.15rem 0.4rem;
        font-size: var(--font-xs);
      }
    }

    @media (min-width: 1200px) {
      .player-section {
        flex: 0 0 260px;
      }
      .grid-container {
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
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
            <div class="empty-state">
              <i class="fas fa-user-plus"></i>
              <p>Not a player yet.</p>
              <a href="<?php echo base_url(); ?>Welcome/enter_player" aria-label="Register as a Player">
                <button class="btn btn-primary">Register</button>
              </a>
            </div>
          <?php } else { ?>
            <!-- Display success/error messages -->
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($this->session->flashdata('success')); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($this->session->flashdata('error')); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>

            <?php echo form_open_multipart('PlayerController/update_player_picture/' . $data['player_id'], ['id' => 'profilePictureForm']); ?>
              <div class="profile-image-container">
                <?php if (!empty($data['image_path'])) { ?>
                  <img src="<?php echo htmlspecialchars($data['image_path']); ?>" alt="User Photo" id="currentImage" loading="lazy">
                <?php } else { ?>
                  <div class="default-profile-icon">
                    <i class="fas fa-user"></i>
                  </div>
                <?php } ?>
                <div class="preview-container">
                  <img id="imagePreview" class="preview-image" alt="Profile Image Preview" loading="lazy">
                </div>
                <div class="profile-image-upload">
                  <input type="file" id="profile_image" name="profile_image" accept="image/*" onchange="previewImage(event)">
                  <label for="profile_image" class="btn btn-primary btn-sm" aria-label="Choose Profile Picture">Choose</label>
                  <button type="submit" name="submit" class="btn btn-success btn-sm" style="display: none;" id="uploadButton" aria-label="Upload Profile Picture">Upload</button>
                </div>
              </div>
            <?php echo form_close(); ?>

            <h5><?php echo htmlspecialchars($data['playerName']); ?></h5>
            <p>Role: <?php echo htmlspecialchars($data['player_role']); ?></p>
            <p>City: <?php echo htmlspecialchars($data['city']); ?></p>
            <div class="action-buttons">
              <a href="<?php echo base_url(); ?>PlayerController/profile_player/<?php echo htmlspecialchars($data['player_id']); ?>" class="btn-view-profile" aria-label="View Profile">View</a>
              <a href="<?php echo base_url(); ?>PlayerController/update_player/<?php echo htmlspecialchars($data['player_id']); ?>" class="btn btn-warning btn-sm" aria-label="Edit Profile">Edit</a>
            </div>
          <?php } ?>
        </div>
      </div>

      <!-- Teams and Tournaments Section -->
      <div class="content-section">
        <!-- Link Bar -->
        <div class="link-bar">
          <button onclick="showSection('teams')" class="active" aria-label="Show Teams Section">Teams</button>
          <button onclick="showSection('tournaments')" aria-label="Show Tournaments Section">Tournaments</button>
        </div>

        <!-- Teams Section -->
        <div id="teams-section" class="section active">
          <div class="section-header">
            <h4>My Teams</h4>
            <button class="btn btn-primary" onclick="location.href='<?php echo base_url(); ?>Welcome/enter_team'" aria-label="Add Team">Add Team</button>
          </div>
          <?php if ($team == 0) { ?>
            <div class="empty-state">
              <i class="fas fa-users"></i>
              <p>No teams yet.</p>
              <a href="<?php echo base_url(); ?>Welcome/enter_team" aria-label="Create Team">
                <button class="btn btn-primary">Create Team</button>
              </a>
            </div>
          <?php } else { ?>
            <div class="grid-container">
              <?php foreach ($team as $team_info) { ?>
                <div class="card">
                  <div class="card-body">
                    <img src="<?php echo htmlspecialchars($team_info->image_path); ?>" alt="Team Logo" loading="lazy">
                    <h5 class="card-title">
                      <a href="<?php echo base_url(); ?>TeamController/team_profile/<?php echo htmlspecialchars($team_info->team_id); ?>" aria-label="View <?php echo htmlspecialchars($team_info->team_name); ?> Profile">
                        <?php echo htmlspecialchars($team_info->team_name); ?>
                      </a>
                    </h5>
                  </div>
                  <div class="action-buttons">
                    <button class="btn btn-warning btn-sm" aria-label="Edit Team">Edit</button>
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
            <button class="btn btn-primary" onclick="location.href='<?php echo base_url(); ?>Welcome/add_tournament'" aria-label="Add Tournament">Add Tournament</button>
          </div>
          <?php if (empty($tournament)) { ?>
            <div class="empty-state">
              <i class="fas fa-trophy"></i>
              <p>No tournaments available.</p>
              <button class="btn btn-primary" onclick="location.href='<?php echo base_url(); ?>Welcome/add_tournament'" aria-label="Create Tournament">Create Tournament</button>
            </div>
          <?php } else { ?>
            <div class="grid-container">
              <?php foreach ($tournament as $league) { ?>
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">
                      <a href="<?php echo base_url(); ?>Welcome/tournament_main/<?php echo htmlspecialchars($league->league_id); ?>" aria-label="View <?php echo htmlspecialchars($league->league_name); ?> Details">
                        <?php echo htmlspecialchars($league->league_name); ?>
                      </a>
                    </h5>
                  </div>
                  <div class="action-buttons">
                    <button class="btn btn-warning btn-sm" aria-label="Edit Tournament">Edit</button>
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
      const defaultIcon = document.querySelector('.default-profile-icon');
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
          if (defaultIcon) {
            defaultIcon.style.display = 'none';
          }
        }
        reader.readAsDataURL(file);
      } else {
        preview.style.display = 'none';
        uploadButton.style.display = 'none';
        if (currentImage) {
          currentImage.style.display = 'block';
        }
        if (defaultIcon) {
          defaultIcon.style.display = 'flex';
        }
      }
    }

    document.addEventListener('DOMContentLoaded', () => {
      showSection('teams');
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>