<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Player Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
  <style>
    :root {
      --primary-color: #4361ee;
      --primary-hover: #3a56d4;
      --secondary-color: #3f37c9;
      --accent-color: #f72585;
      --light-bg: #f8f9fa;
      --card-bg: #ffffff;
      --text-dark: #212529;
      --text-light: #6c757d;
      --border-color: #e9ecef;
      --success-color: #4cc9f0;
      --warning-color: #f8961e;
      --danger-color: #ef233c;
      --card-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
      --card-shadow-hover: 0 4px 20px rgba(0, 0, 0, 0.12);
      --spacing-xs: 5px;
      --spacing-sm: 10px;
      --spacing-md: 15px;
      --spacing-lg: 20px;
      --font-xs: 0.85rem;
      --font-sm: 0.925rem;
      --font-md: 1rem;
      --font-lg: 1.25rem;
      --font-xl: 1.5rem;
      --border-radius: 10px;
      --border-radius-lg: 15px;
      --transition: all 0.3s ease;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--light-bg);
      color: var(--text-dark);
      line-height: 1.5;
      font-size: var(--font-sm);
    }

    .container-fluid {
      padding: 0;
      display: flex;
      min-height: 100vh;
    }

    /* Player Profile Sidebar */
    .player-profile {
      width: 280px;
      background: var(--card-bg);
      border-right: 1px solid var(--border-color);
      padding: var(--spacing-md);
      box-shadow: var(--card-shadow);
      position: sticky;
      top: 0;
      height: 100vh;
      overflow-y: auto;
    }

    .profile-header {
      display: flex;
      align-items: center;
      gap: var(--spacing-sm);
      margin-bottom: var(--spacing-md);
    }

    .profile-pic-container {
      position: relative;
      width: 120px;
      height: 120px;
      flex-shrink: 0;
    }

    .profile-pic {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid white;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .default-profile {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 2.5rem;
    }

    .profile-upload {
      position: absolute;
      bottom: 0;
      right: 0;
      background: var(--primary-color);
      width: 36px;
      height: 36px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      cursor: pointer;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .profile-upload input {
      display: none;
    }

    .player-info {
      flex: 1;
    }

    .player-name {
      font-size: var(--font-lg);
      font-weight: 600;
      margin-bottom: var(--spacing-xs);
    }

    .player-meta {
      color: var(--text-light);
      font-size: var(--font-xs);
      margin-bottom: var(--spacing-sm);
    }

    .player-stats {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: var(--spacing-sm);
      margin-bottom: var(--spacing-md);
      text-align: center;
    }

    .stat-item {
      padding: var(--spacing-xs);
      background: var(--light-bg);
      border-radius: var(--border-radius);
    }

    .stat-value {
      font-weight: 700;
      color: var(--primary-color);
      font-size: var(--font-md);
    }

    .stat-label {
      font-size: var(--font-xs);
      color: var(--text-light);
    }

    .profile-actions {
      display: flex;
      flex-direction: column;
      gap: var(--spacing-sm);
      margin-bottom: var(--spacing-md);
    }

    .btn-profile {
      width: 100%;
      padding: var(--spacing-sm);
      border-radius: var(--border-radius);
      font-weight: 500;
      transition: var(--transition);
      text-align: center;
    }

    .btn-primary {
      background: var(--primary-color);
      color: white;
      border: none;
      display: inline-block; /* Ensure visibility */
    }

    .btn-primary:hover {
      background: var(--primary-hover);
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(67, 97, 238, 0.2);
    }

    .btn-outline {
      background: transparent;
      border: 1px solid var(--primary-color);
      color: var(--primary-color);
    }

    .btn-outline:hover {
      background: rgba(67, 97, 238, 0.1);
    }

    .player-details {
      margin-top: var(--spacing-md);
    }

    .detail-item {
      display: flex;
      justify-content: space-between;
      padding: var(--spacing-xs) 0;
      border-bottom: 1px solid var(--border-color);
    }

    .detail-label {
      color: var(--text-light);
    }

    .detail-value {
      font-weight: 500;
    }

    /* Main Content Area */
    .main-content {
      flex: 1;
      padding: var(--spacing-lg);
      overflow-y: auto;
      height: 100vh;
    }

    .content-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: var(--spacing-lg);
    }

    .content-title {
      font-size: var(--font-xl);
      font-weight: 600;
    }

    .content-tabs {
      display: flex;
      border-bottom: 1px solid var(--border-color);
      margin-bottom: var(--spacing-lg);
      overflow-x: auto;
    }

    .tab-btn {
      padding: var(--spacing-sm) var(--spacing-md);
      font-weight: 500;
      color: var(--text-light);
      background: none;
      border: none;
      position: relative;
      cursor: pointer;
      white-space: nowrap;
      transition: var(--transition);
    }

    .tab-btn:hover {
      color: var(--primary-color);
    }

    .tab-btn.active {
      color: var(--primary-color);
    }

    .tab-btn.active::after {
      content: '';
      position: absolute;
      bottom: -1px;
      left: 0;
      width: 100%;
      height: 2px;
      background: var(--primary-color);
    }

    /* Cards Grid */
    .cards-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: var(--spacing-md);
    }

    .card {
      background: var(--card-bg);
      border-radius: var(--border-radius);
      padding: var(--spacing-md);
      box-shadow: var(--card-shadow);
      transition: var(--transition);
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: var(--card-shadow-hover);
    }

    .card-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: var(--spacing-sm);
    }

    .card-info {
      display: flex;
      align-items: center;
    }

    .card-img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: var(--spacing-md);
      border: 2px solid white;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .default-card-img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      margin-right: var(--spacing-md);
    }

    .tournament-img {
      background: linear-gradient(135deg, var(--accent-color), #b5179e);
    }

    .card-title {
      font-weight: 600;
      margin-bottom: var(--spacing-xs);
    }

    .card-subtitle {
      font-size: var(--font-xs);
      color: var(--text-light);
    }

    .card-actions {
      display: flex;
      gap: var(--spacing-sm);
      margin-top: var(--spacing-sm);
      justify-content: flex-start;
    }

    .btn-sm {
      padding: var(--spacing-xs) var(--spacing-sm);
      font-size: var(--font-xs);
      border-radius: var(--border-radius);
    }

    .btn-success {
      background: var(--success-color);
      color: white;
      border: none;
    }

    .btn-success:hover {
      background: #3da8d9;
    }

    .btn-warning {
      background: var(--warning-color);
      color: white;
      border: none;
    }

    .btn-warning:hover {
      background: #e07b00;
    }

    /* Empty State */
    .empty-state {
      text-align: center;
      padding: var(--spacing-lg);
      background: var(--card-bg);
      border-radius: var(--border-radius);
      box-shadow: var(--card-shadow);
    }

    .empty-state i {
      font-size: 2rem;
      color: var(--primary-color);
      margin-bottom: var(--spacing-md);
    }

    .empty-state h4 {
      font-size: var(--font-lg);
      margin-bottom: var(--spacing-sm);
    }

    .empty-state p {
      color: var(--text-light);
      margin-bottom: var(--spacing-md);
    }

    /* Profile Image Upload Styles */
    .profile-image-container {
      position: relative;
      width: 120px;
      height: 120px;
      flex-shrink: 0;
      margin-bottom: var(--spacing-md);
    }

    .profile-image-container img {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid white;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .default-profile-icon {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 2.5rem;
    }

    .preview-container {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      display: none;
    }

    .preview-image {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid white;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .profile-image-upload {
      position: absolute;
      bottom: 0;
      right: 0;
      display: flex;
      gap: var(--spacing-xs);
    }

    .profile-image-upload input[type="file"] {
      opacity: 0;
      width: 0;
      height: 0;
      position: absolute;
    }

    .profile-image-upload label {
      cursor: pointer;
      padding: var(--spacing-xs) var(--spacing-sm);
      font-size: var(--font-xs);
      border-radius: var(--border-radius);
      background: var(--primary-color);
      color: white;
      border: none;
      transition: var(--transition);
    }

    .profile-image-upload label:hover {
      background: var(--primary-hover);
    }

    .profile-image-upload button {
      cursor: pointer;
      padding: var(--spacing-xs) var(--spacing-sm);
      font-size: var(--font-xs);
      border-radius: var(--border-radius);
    }

    /* Section Display */
    .section {
      display: none;
    }

    .section.active {
      display: block;
    }

    /* Ensure Create Team button is visible */
    .btn-create-team {
      display: inline-block !important;
      visibility: visible !important;
      opacity: 1 !important;
    }

    /* Responsive Adjustments */
    @media (max-width: 992px) {
      .container-fluid {
        flex-direction: column;
      }

      .player-profile {
        width: 100%;
        height: auto;
        position: static;
        border-right: none;
        border-bottom: 1px solid var(--border-color);
        padding: var(--spacing-sm);
      }

      .main-content {
        height: auto;
      }

      .profile-header {
        flex-direction: row;
        text-align: left;
        gap: var(--spacing-sm);
        margin-bottom: var(--spacing-sm);
      }

      .profile-image-container {
        width: 80px;
        height: 80px;
      }

      .player-info {
        flex: 1;
      }

      .player-stats {
        display: flex;
        flex-direction: row;
        gap: var(--spacing-xs);
        justify-content: space-between;
      }

      .stat-item {
        flex: 1;
        padding: var(--spacing-xs);
      }

      .profile-actions {
        flex-direction: row;
        flex-wrap: wrap;
        gap: var(--spacing-xs);
      }

      .player-details {
        margin-top: var(--spacing-sm);
      }
    }

    @media (max-width: 768px) {
      .cards-grid {
        grid-template-columns: 1fr;
      }

      .player-stats {
        flex-direction: row;
        gap: var(--spacing-xs);
      }

      .profile-header {
        flex-direction: row;
        align-items: center;
        gap: var(--spacing-sm);
      }

      .profile-image-container {
        margin: 0;
      }

      .player-name {
        font-size: var(--font-md);
      }

      .player-meta {
        font-size: 0.75rem;
      }
    }

    @media (max-width: 576px) {
      .player-stats {
        flex-direction: row;
        gap: var(--spacing-xs);
      }

      .content-header {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--spacing-md);
      }

      .profile-header {
        flex-direction: row;
        gap: var(--spacing-xs);
      }

      .profile-image-container {
        width: 60px;
        height: 60px;
      }

      .profile-image-upload {
        width: 28px;
        height: 28px;
      }

      .profile-image-upload i {
        font-size: 0.9rem;
      }

      .stat-item {
        padding: var(--spacing-xs);
      }

      .stat-value {
        font-size: 0.9rem;
      }

      .stat-label {
        font-size: 0.7rem;
      }

      .profile-image-upload label,
      .profile-image-upload button {
        padding: 4px 8px;
        font-size: 0.7rem;
      }
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <!-- Player Profile Sidebar -->
    <div class="player-profile">
      <?php if (empty($data) || $data == 0) { ?>
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

        <?php echo form_open_multipart('PlayerController/update_player_picture/' . htmlspecialchars($data['player_id']), ['id' => 'profilePictureForm']); ?>
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

        <div class="profile-header">
          <div class="player-info">
            <h2 class="player-name">
              <a href="<?php echo base_url(); ?>PlayerController/profile_player/<?php echo htmlspecialchars($data['player_id']); ?>">
                <?php echo htmlspecialchars($data['playerName']); ?>
              </a>
            </h2>
            <div class="player-meta">
              <span><?php echo htmlspecialchars($data['player_role']); ?></span> • 
              <span><?php echo htmlspecialchars($data['city']); ?></span>
            </div>
            <div class="profile-actions mobile-only">
              <a href="<?php echo base_url(); ?>PlayerController/update_player/<?php echo htmlspecialchars($data['player_id']); ?>" class="btn-profile btn-outline btn-sm">
                <i class="fas fa-edit mr-2"></i> Edit
              </a>
            </div>
          </div>
        </div>
        <div class="player-stats">
          <div class="stat-item">
            <div class="stat-value"><?php echo !empty($team) ? count($team) : 0; ?></div>
            <div class="stat-label">Teams</div>
          </div>
          <div class="stat-item">
            <div class="stat-value"><?php echo !empty($tournament) ? count($tournament) : 0; ?></div>
            <div class="stat-label">Tournaments</div>
          </div>
        </div>
      <?php } ?>
    </div>
    <!-- Main Content Area -->
    <div class="main-content">
      <div class="content-header">
        <h1 class="content-title">Dashboard</h1>
        <div>
          <button class="btn btn-primary btn-create-team" onclick="location.href='<?php echo base_url(); ?>Welcome/enter_team'">
            <i class="fas fa-plus mr-2"></i> New Team
          </button>
           <button class="btn btn-primary" onclick="location.href='<?php echo base_url(); ?>Welcome/add_tournament'">
              <i class="fas fa-plus mr-2"></i> Create Tournament
            </button>
        </div>
      </div>
      <div class="content-tabs">
        <button class="tab-btn active" data-section="teams">
          <i class="fas fa-users mr-2"></i> My Teams
        </button>
        <button class="tab-btn" data-section="tournaments">
          <i class="fas fa-trophy mr-2"></i> Tournaments
        </button>
      
      </div>
      <!-- Teams Section -->
      <div id="teams-section" class="section active">
        <?php if (empty($team) || count($team) === 0): ?>
          <div class="empty-state">
            <i class="fas fa-users"></i>
            <h4>No Teams Yet</h4>
            <p>You haven't joined any teams yet. Create or join a team to get started!</p>
            <button class="btn btn-primary btn-create-team" onclick="location.href='<?php echo base_url(); ?>Welcome/enter_team'">
              <i class="fas fa-plus mr-2"></i> Create Team
            </button>

          </div>
        <?php else: ?>
          <div class="cards-grid">
            <?php foreach ($team as $team_info): ?>
              <div class="card">
                <div class="card-header">
                  <div class="card-info">
                    <?php if (!empty($team_info->image_path)): ?>
                      <img src="<?php echo htmlspecialchars($team_info->image_path); ?>" alt="Team Logo" class="card-img">
                    <?php else: ?>
                      <div class="default-card-img">
                        <i class="fas fa-users"></i>
                      </div>
                    <?php endif; ?>
                    <div>
                      <h4 class="card-title"><?php echo htmlspecialchars($team_info->team_name); ?></h4>
                      <p class="card-subtitle"><?php echo $this->session->userdata('user_id') == $team_info->user_id ? 'Owner' : 'Member'; ?></p>
                    </div>
                  </div>
                </div>
                <div class="card-actions">
                  <a href="<?php echo base_url(); ?>TeamController/team_profile/<?php echo htmlspecialchars($team_info->team_id); ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-eye"></i> View
                  </a>
                  <?php if ($this->session->userdata('user_id') == $team_info->user_id): ?>
                    <a href="<?php echo base_url(); ?>Welcome/team_admin/<?php echo htmlspecialchars($team_info->team_id); ?>" class="btn btn-sm btn-success">
                      <i class="fas fa-cog"></i> Manage
                    </a>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
      <!-- Tournaments Section -->
      <div id="tournaments-section" class="section">
        <?php if (empty($tournament)): ?>
          <div class="empty-state">
            <i class="fas fa-trophy"></i>
            <h4>No Tournaments</h4>
            <p>You haven't joined any tournaments yet. Create or join one to compete!</p>
            <button class="btn btn-primary" onclick="location.href='<?php echo base_url(); ?>Welcome/add_tournament'">
              <i class="fas fa-plus mr-2"></i> Create Tournament
            </button>
          </div>
        <?php else: ?>
          <div class="cards-grid">
            <?php foreach ($tournament as $league): ?>
              <div class="card">
                <div class="card-header">
                  <div class="card-info">
                    <div class="default-card-img tournament-img">
                      <i class="fas fa-trophy"></i>
                    </div>
                    <div>
                      <h4 class="card-title"><?php echo htmlspecialchars($league->league_name); ?></h4>
                      <p class="card-subtitle"><?php echo $this->session->userdata('user_id') == $league->user_id ? 'Organizer' : 'Participant'; ?></p>
                    </div>
                  </div>
                </div>
                <div class="card-actions">
                  <a href="<?php echo base_url(); ?>Welcome/tournament_main/<?php echo htmlspecialchars($league->league_id); ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-eye"></i> View
                  </a>
                  <?php if ($this->session->userdata('user_id') == $league->user_id): ?>
                    <a href="<?php echo base_url(); ?>Welcome/tournament_main/<?php echo htmlspecialchars($league->league_id); ?>" class="btn btn-sm btn-success">
                      <i class="fas fa-cog"></i> Manage
                    </a>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
      <!-- Matches Section -->
    
    </div>
  </div>

  <script>
    // Tab navigation functionality
    document.addEventListener('DOMContentLoaded', function() {
      const tabButtons = document.querySelectorAll('.tab-btn');
      const sections = document.querySelectorAll('.section');

      // Function to show a specific section
      function showSection(sectionId, button) {
        // Hide all sections
        sections.forEach(section => {
          section.style.display = 'none';
          section.classList.remove('active');
        });

        // Show the selected section
        const targetSection = document.getElementById(`${sectionId}-section`);
        if (targetSection) {
          targetSection.style.display = 'block';
          targetSection.classList.add('active');
        }

        // Update active tab button
        tabButtons.forEach(btn => {
          btn.classList.remove('active');
        });
        if (button) {
          button.classList.add('active');
        }
      }

      // Initialize first tab as active
      if (tabButtons.length > 0) {
        const firstTab = document.querySelector('.tab-btn[data-section="teams"]');
        if (firstTab) {
          showSection(firstTab.getAttribute('data-section'), firstTab);
        }
      }

      // Add click event to all tab buttons
      tabButtons.forEach(button => {
        button.addEventListener('click', function() {
          const sectionId = this.getAttribute('data-section');
          showSection(sectionId, this);
        });
      });

      // Profile image preview functionality
      const profileImageInput = document.getElementById('profile_image');
      if (profileImageInput) {
        profileImageInput.addEventListener('change', previewImage);
      }
    });

    function previewImage(event) {
      const file = event.target.files[0];
      if (file) {
        
        const reader = new FileReader();
        reader.onload = function(e) {
          const preview = document.getElementById('imagePreview');
          if (preview) {
            preview.src = e.target.result;
            document.querySelector('.preview-container').style.display = 'block';
            document.getElementById('uploadButton').style.display = 'inline-block';
          }
        };
        reader.readAsDataURL(file);
      }
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>