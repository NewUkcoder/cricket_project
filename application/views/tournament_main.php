<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Cricket League Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --cla-primary-color: #005f8d;
      --cla-primary-dark: #003d5c;
      --cla-secondary-color: #1e3a8a;
      --cla-accent-color: #ffd700;
      --cla-danger-color: #dc3545;
      --cla-success-color: #28a745;
      --cla-text-color: #333;
      --cla-light-gray: #f8f9fa;
      --cla-medium-gray: #e9ecef;
      --cla-dark-gray: #6c757d;
      --cla-border-radius: 8px;
      --cla-box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      --cla-transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    body {
      background-color: #f5f7fa;
      color: var(--cla-text-color);
      font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
      font-size: 14px;
      line-height: 1.6;
      padding-top: 70px;
      padding-bottom: 70px;
    }

    /* Header Styles */
    .cla-main-header {
      background: linear-gradient(135deg, var(--cla-primary-color), var(--cla-primary-dark));
      color: white;
      padding: 15px 0;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1030;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .cla-header-content {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 15px;
    }

    .cla-league-title {
      font-size: 1.5rem;
      font-weight: 600;
      margin-bottom: 5px;
      letter-spacing: 0.5px;
    }

    .cla-league-meta {
      font-size: 0.8rem;
      opacity: 0.9;
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .cla-league-meta span {
      display: flex;
      align-items: center;
    }

    .cla-league-meta i {
      margin-right: 5px;
      font-size: 0.9rem;
    }

    /* Main Navigation */
    .cla-main-nav {
      background: white;
      position: fixed;
      top: 70px;
      left: 0;
      right: 0;
      z-index: 1020;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      border-top: 1px solid var(--cla-medium-gray);
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }

    .cla-nav-scroll {
      display: flex;
      padding: 0 15px;
      min-width: max-content;
    }

    .cla-nav-scroll::-webkit-scrollbar {
      display: none;
    }

    .cla-nav-link {
      color: var(--cla-dark-gray);
      text-decoration: none;
      font-size: 0.9rem;
      font-weight: 500;
      padding: 12px 15px;
      margin: 0 5px;
      border-bottom: 3px solid transparent;
      transition: var(--cla-transition);
      white-space: nowrap;
    }

    .cla-nav-link:hover, .cla-nav-link.active {
      color: var(--cla-primary-color);
      border-bottom-color: var(--cla-primary-color);
    }

    .cla-nav-link i {
      margin-right: 6px;
      font-size: 0.9rem;
    }

    /* Bottom Navigation (Mobile Only) */
    .cla-bottom-nav {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background: white;
      display: flex;
      justify-content: space-around;
      padding: 8px 0;
      box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
      z-index: 1030;
      border-top: 1px solid var(--cla-medium-gray);
    }

    .cla-nav-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-decoration: none;
      color: var(--cla-dark-gray);
      font-size: 0.7rem;
      padding: 5px;
      flex: 1;
      max-width: 20%;
      transition: var(--cla-transition);
    }

    .cla-nav-item.active {
      color: var(--cla-primary-color);
    }

    .cla-nav-icon {
      font-size: 1.2rem;
      margin-bottom: 3px;
    }

    /* Main Content */
    .cla-main-container {
      max-width: 1200px;
      margin: 20px auto;
      padding: 0 15px;
    }

    .cla-section {
      background: white;
      border-radius: var(--cla-border-radius);
      box-shadow: var(--cla-box-shadow);
      margin-bottom: 20px;
      overflow: hidden;
      transition: var(--cla-transition);
    }

    .cla-section:hover {
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    .cla-section-header {
      background: linear-gradient(135deg, var(--cla-primary-color), var(--cla-primary-dark));
      color: white;
      padding: 12px 20px;
      font-size: 1.1rem;
      font-weight: 600;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .cla-section-header .badge {
      background-color: rgba(255, 255, 255, 0.2);
      font-weight: 500;
    }

    .cla-section-body {
      padding: 20px;
    }

    /* Cards */
    .cla-card {
      border: none;
      border-radius: var(--cla-border-radius);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      transition: var(--cla-transition);
      margin-bottom: 15px;
    }

    .cla-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .cla-card-header {
      background: linear-gradient(135deg, var(--cla-primary-color), var(--cla-primary-dark));
      color: white;
      font-weight: 600;
      padding: 12px 15px;
      border-radius: var(--cla-border-radius) var(--cla-border-radius) 0 0 !important;
    }

    /* Buttons */
    .cla-btn {
      font-size: 0.85rem;
      font-weight: 500;
      padding: 8px 16px;
      border-radius: var(--cla-border-radius);
      transition: var(--cla-transition);
      letter-spacing: 0.5px;
    }

    .cla-btn-primary {
      background-color: var(--cla-primary-color);
      border: none;
    }

    .cla-btn-primary:hover {
      background-color: var(--cla-primary-dark);
      transform: translateY(-2px);
    }

    .cla-btn-success {
      background-color: var(--cla-success-color);
      border: none;
    }

    .cla-btn-danger {
      background-color: var(--cla-danger-color);
      border: none;
    }

    .cla-btn-sm {
      padding: 5px 10px;
      font-size: 0.8rem;
    }

    /* Team Grid */
    .cla-team-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
      gap: 15px;
    }

    .cla-team-card {
      background: white;
      border-radius: var(--cla-border-radius);
      box-shadow: var(--cla-box-shadow);
      overflow: hidden;
      text-align: center;
      transition: var(--cla-transition);
    }

    .cla-team-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .cla-team-img {
      width: 100%;
      height: 120px;
      object-fit: cover;
      border-bottom: 1px solid var(--cla-medium-gray);
    }

    .cla-team-content {
      padding: 15px;
    }

    .cla-team-name {
      font-size: 1rem;
      font-weight: 600;
      color: var(--cla-primary-color);
      margin-bottom: 5px;
    }

    .cla-team-meta {
      font-size: 0.8rem;
      color: var(--cla-dark-gray);
      margin-bottom: 3px;
    }

    /* Schedule Cards */
    .cla-schedule-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 15px;
    }

    .cla-match-card {
      background: white;
      border-radius: var(--cla-border-radius);
      box-shadow: var(--cla-box-shadow);
      overflow: hidden;
      transition: var(--cla-transition);
    }

    .cla-match-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    .cla-match-teams {
      padding: 15px;
      border-bottom: 1px solid var(--cla-medium-gray);
      text-align: center;
    }

    .cla-team-logo {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid var(--cla-medium-gray);
      vertical-align: middle;
    }

    .cla-match-team-name {
      font-size: 0.9rem;
      font-weight: 500;
      color: var(--cla-primary-color);
      display: inline-block;
      vertical-align: middle;
      margin: 0 10px;
      max-width: 100px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    .cla-vs-text {
      font-weight: 600;
      color: var(--cla-primary-color);
      margin: 0 10px;
      display: inline-block;
      vertical-align: middle;
    }

    .cla-match-details {
      padding: 15px;
    }

    .cla-match-info {
      display: flex;
      align-items: center;
      margin-bottom: 8px;
      font-size: 0.9rem;
    }

    .cla-match-info i {
      color: var(--cla-primary-color);
      margin-right: 8px;
      width: 20px;
      text-align: center;
    }

    .cla-match-actions {
      display: flex;
      justify-content: center;
      gap: 15px;
      padding: 10px 15px;
      border-top: 1px solid var(--cla-medium-gray);
    }

    .cla-match-actions a {
      color: var(--cla-primary-color);
      text-decoration: none;
      font-size: 1rem;
      transition: var(--cla-transition);
    }

    .cla-match-actions a:hover {
      color: var(--cla-primary-dark);
    }

    .cla-match-actions a.text-danger:hover {
      color: #b02a37;
    }

    /* Tables */
    .cla-table-responsive {
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
      border-radius: var(--cla-border-radius);
      box-shadow: var(--cla-box-shadow);
    }

    .cla-table {
      margin-bottom: 0;
      min-width: 600px;
    }

    .cla-table th {
      background-color: var(--cla-primary-color);
      color: white;
      font-weight: 500;
      padding: 12px 15px;
    }

    .cla-table td {
      padding: 12px 15px;
      vertical-align: middle;
    }

    .cla-table tr:nth-child(even) {
      background-color: var(--cla-light-gray);
    }

    /* Forms */
    .cla-form-control, .cla-form-select {
      font-size: 0.9rem;
      padding: 8px 12px;
      border-radius: var(--cla-border-radius);
      border: 1px solid var(--cla-medium-gray);
    }

    .cla-form-label {
      font-weight: 500;
      color: var(--cla-text-color);
      margin-bottom: 5px;
    }

    /* Rules List */
    .cla-rules-list {
      margin-top: 15px;
    }

    .cla-rule-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 0;
      border-bottom: 1px solid var(--cla-medium-gray);
    }

    .cla-rule-item:last-child {
      border-bottom: none;
    }

    .cla-rule-text {
      flex: 1;
      font-size: 0.9rem;
    }

    .cla-rule-actions a {
      color: var(--cla-primary-color);
      text-decoration: none;
      font-weight: 500;
      font-size: 0.85rem;
      margin-left: 10px;
      transition: var(--cla-transition);
    }

    .cla-rule-actions a:hover {
      color: var(--cla-primary-dark);
      text-decoration: underline;
    }

    /* Empty States */
    .cla-empty-state {
      text-align: center;
      padding: 30px;
      color: var(--cla-dark-gray);
    }

    .cla-empty-state i {
      font-size: 2rem;
      color: var(--cla-medium-gray);
      margin-bottom: 10px;
    }

    /* Modals */
    .cla-modal-content {
      border-radius: var(--cla-border-radius);
      border: none;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    }

    .cla-modal-header {
      background: linear-gradient(135deg, var(--cla-primary-color), var(--cla-primary-dark));
      color: white;
      border-radius: var(--cla-border-radius) var(--cla-border-radius) 0 0;
      padding: 15px 20px;
    }

    .cla-modal-title {
      font-weight: 600;
    }

    .cla-modal-body {
      padding: 20px;
    }

    /* Desktop Styles */
    @media (min-width: 992px) {
      body {
        padding-top: 120px;
        padding-bottom: 0;
      }
      
      .cla-main-header {
        padding: 20px 0;
      }
      
      .cla-league-title {
        font-size: 1.8rem;
      }
      
      .cla-league-meta {
        font-size: 0.9rem;
      }
      
      .cla-main-nav {
        top: 120px;
      }
      
      .cla-bottom-nav {
        display: none;
      }
      
      .cla-team-grid {
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
      }
      
      .cla-schedule-grid {
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      }
    }

    /* Mobile-specific adjustments */
    @media (max-width: 767px) {
      .cla-main-nav {
        display: none;
      }
      
      .cla-team-grid {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
      }
      
      .cla-match-teams {
        display: block;
      }
      
      .cla-match-team-name {
        display: block;
        white-space: normal;
        max-width: none;
        margin: 5px 0;
      }
      
      .cla-vs-text {
        display: block;
        margin: 5px 0;
      }
    }
  </style>
</head>
<body>
  <!-- Main Header -->
  <header class="cla-main-header">
    <div class="cla-header-content">
      <h1 class="cla-league-title"><?php echo $league['league_name']; ?></h1>
      <div class="cla-league-meta">
        <span><i class="fas fa-calendar-alt"></i> Season: <?php echo $league['season']; ?></span>
        <span><i class="fas fa-map-marker-alt"></i> <?php echo $league['city']; ?>, <?php echo $league['country']; ?></span>
        <span><i class="fas fa-baseball-ball"></i> <?php echo $league['match_type']; ?> Ball</span>
        <span><i class="fas fa-phone-alt"></i> <?php echo $league['phone_number']; ?></span>
      </div>
    </div>
  </header>

  <!-- Main Navigation -->
  <nav class="cla-main-nav">
    <div class="cla-nav-scroll">
      <a href="<?php echo base_url(); ?>Welcome/tournament_landing/<?php echo $league['league_id']; ?>" class="cla-nav-link active">
        <i class="fas fa-chart-bar"></i> View 
      </a>
      <a href="#team-requests" class="cla-nav-link">
        <i class="fas fa-user-plus"></i> Team Requests
      </a>
      <a href="#teams" class="cla-nav-link">
        <i class="fas fa-users"></i> Teams
      </a>
      <a href="#add-schedule" class="cla-nav-link">
        <i class="fas fa-calendar-plus"></i> Add Schedule
      </a>
      <a href="#schedule-scorecard" class="cla-nav-link">
        <i class="fas fa-list-alt"></i> Matches
      </a>
      <a href="#add-rules" class="cla-nav-link">
        <i class="fas fa-book"></i> Rules
      </a>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="cla-main-container">
    <!-- Team Requests Section -->
    <?php if (!empty($team_request)) { ?>
    <section id="team-requests" class="cla-section">
      <div class="cla-section-header">
        <span>Team Requests</span>
        <span class="badge bg-light text-dark"><?php echo count($team_request); ?> Pending</span>
      </div>
      <div class="cla-section-body">
        <div class="cla-table-responsive">
          <table class="cla-table">
            <thead>
              <tr>
                <th>Team Name</th>
                <th>City</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($team_request as $teams) { ?>
              <tr>
                <td>
                  <a href="<?php echo base_url(); ?>TeamController/team_profile/<?php echo $teams->team_id; ?>" class="text-primary">
                    <?php echo $teams->team_name; ?>
                  </a>
                </td>
                <td><?php echo $teams->city; ?></td>
                <td>
                  <div class="d-flex gap-2">
                    <a href="<?php echo base_url(); ?>TournamentController/accept_request/<?php echo $teams->team_id; ?>/<?php echo $league['league_id']; ?>" class="cla-btn cla-btn-success cla-btn-sm">
                      <i class="fas fa-check"></i> Accept
                    </a>
                    <a href="<?php echo base_url(); ?>TournamentController/reject_team_request/<?php echo $teams->team_id; ?>/<?php echo $league['league_id']; ?>" class="cla-btn cla-btn-danger cla-btn-sm">
                      <i class="fas fa-times"></i> Reject
                    </a>
                  </div>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <?php } ?>

    <!-- Teams Section -->
    <section id="teams" class="cla-section">
      <div class="cla-section-header">
        <span>Registered Teams</span>
        <span class="badge bg-light text-dark"><?php echo !empty($league_teams) ? count($league_teams) : 0; ?> Teams</span>
      </div>
      <div class="cla-section-body">
        <?php if (!empty($league_teams)) { ?>
          <div class="cla-team-grid">
            <?php foreach ($league_teams as $l_teams) { ?>
              <div class="cla-team-card">
                <img src="<?php echo $l_teams['image_path']; ?>" alt="<?php echo $l_teams['team_name']; ?>" class="cla-team-img">
                <div class="cla-team-content">
                  <h3 class="cla-team-name">
                    <a href="<?php echo base_url(); ?>TeamController/team_profile/<?php echo $l_teams['team_id']; ?>">
                      <?php echo $l_teams['team_name']; ?>
                    </a>
                  </h3>
                  <p class="cla-team-meta"><i class="fas fa-trophy"></i> 5 Matches</p>
                  <p class="cla-team-meta"><i class="fas fa-star"></i> 10 Points</p>
                </div>
              </div>
            <?php } ?>
          </div>
        <?php } else { ?>
          <div class="cla-empty-state">
            <i class="fas fa-users-slash"></i>
            <h4>No Teams Registered</h4>
            <p>No teams have joined this league yet</p>
          </div>
        <?php } ?>
      </div>
    </section>

    <!-- Add Schedule Section -->
    <section id="add-schedule" class="cla-section">
      <div class="cla-section-header">
        <span>Add New Match</span>
      </div>
      <div class="cla-section-body">
        <button class="cla-btn cla-btn-primary" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
          <i class="fas fa-plus"></i> Create New Match
        </button>
      </div>
    </section>

    <!-- Schedule & Scorecard Section -->
    <section id="schedule-scorecard" class="cla-section">
      <div class="cla-section-header">
        <span>Match Schedule</span>
        <span class="badge bg-light text-dark"><?php echo !empty($league_schedule) ? count($league_schedule) : 0; ?> Matches</span>
      </div>
      <div class="cla-section-body">
        <?php if (!empty($league_schedule)) { ?>
          <div class="cla-schedule-grid">
            <?php foreach ($league_schedule as $schedule) { ?>
              <div class="cla-match-card">
                <div class="cla-match-teams">
                  <img src="<?php echo $schedule->team_one_image; ?>" alt="<?php echo $schedule->team_one_name; ?>" class="cla-team-logo">
                  <span class="cla-match-team-name"><?php echo $schedule->team_one_name; ?></span>
                  <span class="cla-vs-text">vs</span>
                  <span class="cla-match-team-name"><?php echo $schedule->team_two_name; ?></span>
                  <img src="<?php echo $schedule->team_two_image; ?>" alt="<?php echo $schedule->team_two_name; ?>" class="cla-team-logo">
                </div>
                <div class="cla-match-details">
                  <div class="cla-match-info">
                    <i class="far fa-calendar-alt"></i>
                    <?php echo date("d F Y", strtotime($schedule->match_date)); ?>
                  </div>
                  <div class="cla-match-info">
                    <i class="far fa-clock"></i>
                    <?php echo $schedule->match_time; ?>
                  </div>
                  <div class="cla-match-info">
                    <i class="fas fa-map-marker-alt"></i>
                    <?php echo $schedule->location; ?>
                  </div>
                  <div class="cla-match-info">
                    <i class="fas fa-baseball-ball"></i>
                    <?php echo $schedule->overs; ?> Overs Match
                  </div>
                </div>
                <div class="cla-match-actions">
                  <a href="#" class="edit-schedule" data-bs-toggle="modal" data-bs-target="#editScheduleModal" 
                     data-schedule-id="<?php echo $schedule->match_id; ?>" 
                     data-team1="<?php echo $schedule->team_one_id; ?>" 
                     data-team2="<?php echo $schedule->team_two_id; ?>" 
                     data-match-date="<?php echo $schedule->match_date; ?>" 
                     data-match-time="<?php echo $schedule->match_time; ?>" 
                     data-location="<?php echo $schedule->location; ?>"
                     data-overs="<?php echo $schedule->overs; ?>"
                     data-umpire1="<?php echo $schedule->umpire1; ?>"
                     data-umpire2="<?php echo $schedule->umpire2; ?>">
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="<?php echo base_url();?>Welcome/toss/<?php echo $schedule->team_one_id;?>/<?php echo $schedule->team_two_id;?>/<?php echo $schedule->match_id;?>">
                    <i class="fas fa-clipboard-list"></i>
                  </a>
                  <a href="#" class="text-danger">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                </div>
              </div>
            <?php } ?>
          </div>
        <?php } else { ?>
          <div class="cla-empty-state">
            <i class="far fa-calendar-times"></i>
            <h4>No Scheduled Matches</h4>
            <p>Create your first match schedule to get started</p>
          </div>
        <?php } ?>
      </div>
    </section>

    <!-- Add Rules Section -->
    <section id="add-rules" class="cla-section">
      <div class="cla-section-header">
        <span>League Rules</span>
        <span class="badge bg-light text-dark"><?php echo !empty($league_rules) ? count($league_rules) : 0; ?> Rules</span>
      </div>
      <div class="cla-section-body">
        <form action="<?php echo base_url(); ?>TournamentController/add_rules" method="POST" class="mb-4">
          <div class="mb-3">
            <label for="ruleDescription" class="cla-form-label">Add New Rule</label>
            <textarea class="cla-form-control" id="ruleDescription" name="league_rule" rows="3" required placeholder="Enter rule description..."></textarea>
          </div>
          <input type="hidden" value="<?php echo $league['league_id']; ?>" name="league_id">
          <button type="submit" class="cla-btn cla-btn-primary">
            <i class="fas fa-plus-circle"></i> Add Rule
          </button>
        </form>

        <div class="cla-rules-list">
          <?php if (!empty($league_rules)) { ?>
            <?php foreach ($league_rules as $rule) { ?>
              <div class="cla-rule-item">
                <div class="cla-rule-text">
                  <?php echo $rule->league_rule; ?>
                </div>
                <div class="cla-rule-actions">
                  <a href="#" class="edit-link" data-bs-toggle="modal" data-bs-target="#editRuleModal" 
                     data-rule-id="<?php echo $rule->league_rules_id; ?>" 
                     data-rule-description="<?php echo $rule->league_rule; ?>">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <a href="#" class="text-danger">
                    <i class="fas fa-trash-alt"></i> Delete
                  </a>
                </div>
              </div>
            <?php } ?>
          <?php } else { ?>
            <div class="cla-empty-state">
              <i class="fas fa-book-open"></i>
              <h4>No Rules Defined</h4>
              <p>Add rules to establish guidelines for your league</p>
            </div>
          <?php } ?>
        </div>
      </div>
    </section>
  </main>

  <!-- Bottom Navigation (Mobile Only) -->
  <nav class="cla-bottom-nav">
    <a href="#team-requests" class="cla-nav-item">
      <span class="cla-nav-icon"><i class="fas fa-user-plus"></i></span>
      <span>Requests</span>
    </a>
    <a href="#teams" class="cla-nav-item">
      <span class="cla-nav-icon"><i class="fas fa-users"></i></span>
      <span>Teams</span>
    </a>
    <a href="#add-schedule" class="cla-nav-item">
      <span class="cla-nav-icon"><i class="fas fa-calendar-plus"></i></span>
      <span>Schedule</span>
    </a>
    <a href="#schedule-scorecard" class="cla-nav-item">
      <span class="cla-nav-icon"><i class="fas fa-list-alt"></i></span>
      <span>Matches</span>
    </a>
    <a href="#add-rules" class="cla-nav-item">
      <span class="cla-nav-icon"><i class="fas fa-book"></i></span>
      <span>Rules</span>
    </a>
  </nav>

  <!-- Modals -->
  <div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="cla-modal-content">
        <div class="cla-modal-header">
          <h5 class="cla-modal-title" id="addScheduleModalLabel">Create New Match</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="cla-modal-body">
          <form action="<?php echo base_url(); ?>ScheduleController/add_schedule" method="POST">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="series" class="cla-form-label">League</label>
                <input type="text" class="cla-form-control" id="series" name="series" value="<?php echo $league['league_name']; ?>" readonly>
              </div>
              <div class="col-md-6 mb-3">
                <label for="match-type" class="cla-form-label">Match Type</label>
                <input type="text" class="cla-form-control" name="match_type" value="<?php echo $league['match_type']; ?>" readonly>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="team1" class="cla-form-label">First Team</label>
                <select id="team1" name="team1" class="cla-form-select" required>
                  <option value="" disabled selected>Select First Team</option>
                  <?php if (!empty($league_teams)) { 
                    foreach ($league_teams as $l_teams) { ?>
                      <option value="<?php echo $l_teams['team_id']; ?>"><?php echo $l_teams['team_name']; ?></option>
                    <?php } 
                  } ?>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label for="team2" class="cla-form-label">Second Team</label>
                <select id="team2" name="team2" class="cla-form-select" required>
                  <option value="" disabled selected>Select Second Team</option>
                  <?php if (!empty($league_teams)) { 
                    foreach ($league_teams as $l_teams) { ?>
                      <option value="<?php echo $l_teams['team_id']; ?>"><?php echo $l_teams['team_name']; ?></option>
                    <?php } 
                  } ?>
                </select>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="match-date" class="cla-form-label">Match Date</label>
                <input type="date" class="cla-form-control" id="match-date" name="match_date" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="match-time" class="cla-form-label">Match Time</label>
                <input type="time" class="cla-form-control" id="match-time" name="match_time" required>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="overs" class="cla-form-label">Overs</label>
                <input type="number" class="cla-form-control" id="overs" value="<?php echo $league['overs']; ?>" name="overs" placeholder="Enter Number of Overs" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="location" class="cla-form-label">Venue</label>
                <input type="text" class="cla-form-control" id="location" name="location" placeholder="Enter Match Venue" required>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="umpire1" class="cla-form-label">First Umpire</label>
                <input type="text" class="cla-form-control" id="umpire1" name="umpire1" placeholder="Enter Umpire Name">
              </div>
              <div class="col-md-6 mb-3">
                <label for="umpire2" class="cla-form-label">Second Umpire</label>
                <input type="text" class="cla-form-control" id="umpire2" name="umpire2" placeholder="Enter Umpire Name">
              </div>
            </div>
            
            <input type="hidden" value="<?php echo $league['league_id']; ?>" name="league_id">
            <div class="d-grid">
              <button type="submit" class="cla-btn cla-btn-primary">
                <i class="fas fa-save"></i> Save Match
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editScheduleModal" tabindex="-1" aria-labelledby="editScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="cla-modal-content">
        <div class="cla-modal-header">
          <h5 class="cla-modal-title" id="editScheduleModalLabel">Edit Match Schedule</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="cla-modal-body">
          <form id="editScheduleForm" action="<?php echo base_url(); ?>ScheduleController/edit_schedule" method="POST">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="editSeries" class="cla-form-label">League</label>
                <input type="text" class="cla-form-control" id="editSeries" name="series" value="<?php echo $league['league_name']; ?>" readonly>
              </div>
              <div class="col-md-6 mb-3">
                <label for="editMatchType" class="cla-form-label">Match Type</label>
                <input type="text" class="cla-form-control" name="match_type" value="<?php echo $league['match_type']; ?>" readonly>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="editTeam1" class="cla-form-label">First Team</label>
                <select id="editTeam1" name="team1" class="cla-form-select" required>
                  <?php if (!empty($league_teams)) { 
                    foreach ($league_teams as $l_teams) { ?>
                      <option value="<?php echo $l_teams['team_id']; ?>"><?php echo $l_teams['team_name']; ?></option>
                    <?php } 
                  } ?>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label for="editTeam2" class="cla-form-label">Second Team</label>
                <select id="editTeam2" name="team2" class="cla-form-select" required>
                  <?php if (!empty($league_teams)) { 
                    foreach ($league_teams as $l_teams) { ?>
                      <option value="<?php echo $l_teams['team_id']; ?>"><?php echo $l_teams['team_name']; ?></option>
                    <?php } 
                  } ?>
                </select>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="editMatchDate" class="cla-form-label">Match Date</label>
                <input type="date" class="cla-form-control" id="editMatchDate" name="match_date" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="editMatchTime" class="cla-form-label">Match Time</label>
                <input type="time" class="cla-form-control" id="editMatchTime" name="match_time" required>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="editOvers" class="cla-form-label">Overs</label>
                <input type="number" class="cla-form-control" id="editOvers" name="overs" placeholder="Enter Number of Overs" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="editLocation" class="cla-form-label">Venue</label>
                <input type="text" class="cla-form-control" id="editLocation" name="location" placeholder="Enter Match Venue" required>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="editUmpire1" class="cla-form-label">First Umpire</label>
                <input type="text" class="cla-form-control" id="editUmpire1" name="umpire1" placeholder="Enter Umpire Name">
              </div>
              <div class="col-md-6 mb-3">
                <label for="editUmpire2" class="cla-form-label">Second Umpire</label>
                <input type="text" class="cla-form-control" id="editUmpire2" name="umpire2" placeholder="Enter Umpire Name">
              </div>
            </div>
            
            <input type="hidden" id="editScheduleId" name="schedule_id">
            <input type="hidden" value="<?php echo $league['league_id']; ?>" name="league_id">
            <div class="d-grid">
              <button type="submit" class="cla-btn cla-btn-primary">
                <i class="fas fa-save"></i> Update Match
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editRuleModal" tabindex="-1" aria-labelledby="editRuleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="cla-modal-content">
        <div class="cla-modal-header">
          <h5 class="cla-modal-title" id="editRuleModalLabel">Edit League Rule</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="cla-modal-body">
          <form id="editRuleForm" action="<?php echo base_url(); ?>TournamentController/update_rules" method="POST">
            <div class="mb-3">
              <label for="editRuleDescription" class="cla-form-label">Rule Description</label>
              <textarea class="cla-form-control" id="editRuleDescription" name="league_rule" rows="5" required></textarea>
            </div>
            <input type="hidden" id="editRuleId" name="rule_id">
            <input type="hidden" value="<?php echo $league['league_id']; ?>" name="league_id">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <button type="button" class="cla-btn cla-btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="cla-btn cla-btn-primary">
                <i class="fas fa-save"></i> Save Changes
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Initialize tooltips
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });

      // Schedule Edit Modal
      var editScheduleModal = document.getElementById('editScheduleModal');
      if (editScheduleModal) {
        editScheduleModal.addEventListener('show.bs.modal', function(event) {
          var button = event.relatedTarget;
          document.getElementById('editScheduleId').value = button.getAttribute('data-schedule-id');
          document.getElementById('editTeam1').value = button.getAttribute('data-team1');
          document.getElementById('editTeam2').value = button.getAttribute('data-team2');
          document.getElementById('editMatchDate').value = button.getAttribute('data-match-date');
          document.getElementById('editMatchTime').value = button.getAttribute('data-match-time');
          document.getElementById('editLocation').value = button.getAttribute('data-location');
          document.getElementById('editOvers').value = button.getAttribute('data-overs');
          document.getElementById('editUmpire1').value = button.getAttribute('data-umpire1');
          document.getElementById('editUmpire2').value = button.getAttribute('data-umpire2');
        });
      }

      // Rule Edit Modal
      var editRuleModal = document.getElementById('editRuleModal');
      if (editRuleModal) {
        editRuleModal.addEventListener('show.bs.modal', function(event) {
          var button = event.relatedTarget;
          document.getElementById('editRuleId').value = button.getAttribute('data-rule-id');
          document.getElementById('editRuleDescription').value = button.getAttribute('data-rule-description');
        });
      }

      // Smooth scrolling for anchor links
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
          e.preventDefault();
          
          const targetId = this.getAttribute('href');
          if (targetId === '#') return;
          
          const targetElement = document.querySelector(targetId);
          if (targetElement) {
            const headerHeight = document.querySelector('.cla-main-header').offsetHeight;
            const navHeight = document.querySelector('.cla-main-nav').offsetHeight;
            const offset = headerHeight + navHeight + 20;
            
            window.scrollTo({
              top: targetElement.offsetTop - offset,
              behavior: 'smooth'
            });
            
            // Update active nav item
            if (targetId !== '#team-requests') {
              document.querySelectorAll('.cla-nav-link, .cla-nav-item').forEach(item => {
                item.classList.remove('active');
              });
              
              const navLink = document.querySelector(`.cla-nav-link[href="${targetId}"], .cla-nav-item[href="${targetId}"]`);
              if (navLink) {
                navLink.classList.add('active');
              }
            }
          }
        });
      });

      // Highlight current section in navigation
      const sections = document.querySelectorAll('.cla-section');
      const navLinks = document.querySelectorAll('.cla-nav-link');
      const navItems = document.querySelectorAll('.cla-nav-item');
      
      function updateActiveNav() {
        let current = '';
        
        sections.forEach(section => {
          const sectionTop = section.offsetTop;
          const sectionHeight = section.clientHeight;
          const scrollPosition = window.pageYOffset + 150;
          
          if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
            current = section.getAttribute('id');
          }
        });
        
        navLinks.forEach(link => {
          link.classList.remove('active');
          if (link.getAttribute('href') === `#${current}`) {
            link.classList.add('active');
          }
        });
        
        navItems.forEach(item => {
          item.classList.remove('active');
          if (item.getAttribute('href') === `#${current}`) {
            item.classList.add('active');
          }
        });
      }
      
      window.addEventListener('scroll', updateActiveNav);
      updateActiveNav();
    });
  </script>
</body>
</html>