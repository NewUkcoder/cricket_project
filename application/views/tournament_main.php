<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Cricket League Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --league-primary: #1e3a8a;
      --league-dark: #0f1e47;
      --league-accent: #facc15;
      --league-danger: #dc3545;
      --league-success: #28a745;
      --league-text: #1f2937;
      --league-bg: #f1f5f9;
      --league-light: #f9fafb;
      --league-gray: #e5e7eb;
      --league-dark-gray: #6b7280;
      --league-radius: 8px;
      --league-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      --league-transition: all 0.3s ease-in-out;
    }

    body {
      background-color: var(--league-bg);
      color: var(--league-text);
      font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
      font-size: 16px;
      line-height: 1.5;
      margin: 0;
      padding-bottom: 70px;
    }

    /* Header */
    .league-header {
      background: linear-gradient(135deg, var(--league-primary), var(--league-dark));
      color: white;
      padding: 15px 0;
      position: relative;
      box-shadow: var(--league-shadow);
      margin-bottom: 20px;
    }

    .league-header-content {
      max-width: 900px;
      margin: 0 auto;
      padding: 0 15px;
    }

    .league-title {
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 5px;
      text-transform: uppercase;
    }

    .league-meta {
      font-size: 0.9rem;
      opacity: 0.9;
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .league-meta span {
      display: flex;
      align-items: center;
    }

    .league-meta i {
      margin-right: 6px;
      font-size: 1rem;
    }

    /* Desktop Navigation */
    .league-nav {
      background: var(--league-light);
      position: sticky;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1020;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      overflow-x: auto;
    }

    .league-nav-scroll {
      display: flex;
      padding: 0 15px;
      min-width: max-content;
      max-width: 900px;
      margin: 0 auto;
    }

    .league-nav-link {
      color: var(--league-dark-gray);
      text-decoration: none;
      font-size: 0.95rem;
      font-weight: 600;
      padding: 12px 15px;
      margin: 0 5px;
      border-bottom: 3px solid transparent;
      transition: var(--league-transition);
      white-space: nowrap;
    }

    .league-nav-link:hover, .league-nav-link.active {
      color: var(--league-primary);
      border-bottom-color: var(--league-accent);
    }

    .league-nav-link i {
      margin-right: 6px;
    }

    /* Mobile Bottom Navigation */
    .league-bottom-nav {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background: var(--league-primary);
      display: flex;
      justify-content: space-around;
      padding: 8px 0;
      box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.2);
      z-index: 1030;
      border-top: 2px solid var(--league-accent);
    }

    .league-nav-item {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-decoration: none;
      color: white;
      font-size: 0.8rem;
      padding: 5px;
      transition: var(--league-transition);
    }

    .league-nav-item:hover, .league-nav-item.active {
      background: var(--league-dark);
      color: var(--league-accent);
      transform: scale(1.05);
    }

    .league-nav-icon {
      font-size: 1.3rem;
      margin-bottom: 4px;
    }

    /* Content */
    .league-container {
      max-width: 900px;
      margin: 20px auto;
      padding: 0 15px;
    }

    .league-section {
      background: white;
      border-radius: var(--league-radius);
      box-shadow: var(--league-shadow);
      margin-bottom: 20px;
      overflow: hidden;
      transition: var(--league-transition);
    }

    .league-section:hover {
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    .league-section-header {
      background: linear-gradient(135deg, var(--league-primary), var(--league-dark));
      color: white;
      padding: 10px 15px;
      font-size: 1.1rem;
      font-weight: 600;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .league-badge {
      background: var(--league-accent);
      color: var(--league-dark);
      font-weight: 500;
      padding: 2px 8px;
      border-radius: 12px;
    }

    .league-section-body {
      padding: 12px;
    }

    /* Buttons */
    .league-btn {
      font-size: 0.85rem;
      font-weight: 600;
      padding: 6px 12px;
      border-radius: var(--league-radius);
      transition: var(--league-transition);
    }

    .league-btn-primary {
      background: var(--league-primary);
      border: none;
      color: white;
    }

    .league-btn-primary:hover {
      background: var(--league-dark);
      transform: translateY(-2px);
    }

    .league-btn-success {
      background: var(--league-success);
      border: none;
      color: white;
    }

    .league-btn-danger {
      background: var(--league-danger);
      border: none;
      color: white;
    }

    .league-btn-sm {
      padding: 4px 8px;
      font-size: 0.8rem;
    }

    /* Team Grid */
    .league-team-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 10px;
    }

    .league-team-card {
      background: var(--league-light);
      border-radius: var(--league-radius);
      box-shadow: var(--league-shadow);
      text-align: center;
      transition: var(--league-transition);
    }

    .league-team-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .league-team-img {
      width: 100%;
      height: 80px;
      object-fit: cover;
      border-bottom: 2px solid var(--league-accent);
    }

    .league-team-content {
      padding: 8px;
    }

    .league-team-name {
      font-size: 0.95rem;
      font-weight: 600;
      color: var(--league-primary);
      margin-bottom: 4px;
    }

    .league-team-meta {
      font-size: 0.8rem;
      color: var(--league-dark-gray);
    }

    /* Schedule Grid */
    .league-schedule-grid {
      display: grid;
      gap: 10px;
    }

    .league-match-card {
      background: var(--league-light);
      border-radius: var(--league-radius);
      box-shadow: var(--league-shadow);
      transition: var(--league-transition);
      padding: 10px;
      display: grid;
      grid-template-columns: 1fr auto 1fr auto;
      align-items: center;
      gap: 8px;
    }

    .league-match-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
      background: linear-gradient(135deg, #fff, #f9fafb);
    }

    .league-match-team-info {
      text-align: center;
    }

    .league-team-logo {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid var(--league-accent);
      margin: 0 auto;
    }

    .league-match-team-name {
      font-size: 0.9rem;
      font-weight: 600;
      color: var(--league-primary);
      margin-top: 4px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .league-vs-text {
      font-weight: 700;
      color: var(--league-accent);
      font-size: 1rem;
    }

    .league-match-details {
      display: flex;
      flex-direction: column;
      gap: 2px;
      font-size: 0.8rem;
    }

    .league-match-info {
      display: flex;
      align-items: center;
      color: var(--league-dark-gray);
    }

    .league-match-info i {
      color: var(--league-primary);
      margin-right: 6px;
      width: 16px;
    }

    .league-match-actions {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .league-match-action {
      font-size: 0.8rem;
      color: var(--league-primary);
      text-decoration: none;
      font-weight: 500;
      transition: var(--league-transition);
    }

    .league-match-action:hover {
      color: var(--league-dark);
      text-decoration: underline;
    }

    /* Team Requests Table */
    .league-table-wrapper {
      overflow-x: auto;
      border-radius: var(--league-radius);
      box-shadow: var(--league-shadow);
    }

    .league-table {
      width: 100%;
      margin-bottom: 0;
    }

    .league-table th {
      background: var(--league-primary);
      color: white;
      font-weight: 600;
      padding: 8px;
      white-space: nowrap;
    }

    .league-table td {
      padding: 8px;
      vertical-align: middle;
      font-size: 0.9rem;
    }

    /* Forms */
    .league-form-control, .league-form-select {
      font-size: 0.9rem;
      padding: 8px 12px;
      border-radius: var(--league-radius);
      border: 1px solid var(--league-gray);
    }

    .league-form-label {
      font-weight: 500;
      color: var(--league-text);
      margin-bottom: 5px;
    }

    /* Rules */
    .league-rules-list {
      margin-top: 10px;
    }

    .league-rule-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 8px 0;
      border-bottom: 1px solid var(--league-gray);
    }

    .league-rule-text {
      flex: 1;
      font-size: 0.9rem;
    }

    .league-rule-actions a {
      color: var(--league-primary);
      font-size: 0.85rem;
      margin-left: 12px;
      transition: var(--league-transition);
    }

    .league-rule-actions a:hover {
      color: var(--league-dark);
    }

    /* Empty State */
    .league-empty {
      text-align: center;
      padding: 20px;
      color: var(--league-dark-gray);
    }

    .league-empty i {
      font-size: 2rem;
      color: var(--league-gray);
      margin-bottom: 10px;
    }

    /* Modals */
    .league-modal-content {
      border-radius: var(--league-radius);
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    }

    .league-modal-header {
      background: linear-gradient(135deg, var(--league-primary), var(--league-dark));
      color: white;
      padding: 15px 20px;
    }

    .league-modal-body {
      padding: 20px;
    }

    /* Responsive */
    @media (min-width: 992px) {
      .league-header {
        padding: 20px 0;
      }
      .league-title {
        font-size: 1.8rem;
      }
      .league-bottom-nav {
        display: none;
      }
      .league-nav {
        display: block;
      }
    }

    @media (max-width: 767px) {
      .league-nav {
        display: none;
      }
      .league-team-grid {
        grid-template-columns: repeat(4, 1fr);
      }
      .league-team-img {
        height: 60px;
      }
      .league-team-name {
        font-size: 0.85rem;
      }
      .league-team-meta {
        font-size: 0.75rem;
      }
      .league-match-card {
        grid-template-columns: 1fr auto 1fr;
        grid-template-rows: auto auto;
        padding: 8px;
      }
      .league-match-team-info:nth-child(1) {
        grid-column: 1;
        grid-row: 1;
      }
      .league-vs-text {
        grid-column: 2;
        grid-row: 1;
      }
      .league-match-team-info:nth-child(3) {
        grid-column: 3;
        grid-row: 1;
      }
      .league-match-details {
        grid-column: 1 / 4;
        grid-row: 2;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 8px;
      }
      .league-match-actions {
        grid-column: 4;
        grid-row: 1 / 3;
      }
      .league-table th, .league-table td {
        padding: 6px;
      }
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header class="league-header">
    <div class="league-header-content">
      <h1 class="league-title"><?php echo $league['league_name']; ?></h1>
      <div class="league-meta">
        <span><i class="fas fa-calendar-alt"></i> <?php echo $league['season']; ?></span>
        <span><i class="fas fa-map-marker-alt"></i> <?php echo $league['city']; ?>, <?php echo $league['country']; ?></span>
        <span><i class="fas fa-baseball-ball"></i> <?php echo $league['match_type']; ?></span>
        <span><i class="fas fa-phone-alt"></i> <?php echo $league['phone_number']; ?></span>
      </div>
    </div>
  </header>

  <!-- Desktop Navigation -->
  <nav class="league-nav">
    <div class="league-nav-scroll">
      <a href="<?php echo base_url(); ?>Welcome/tournament_landing/<?php echo $league['league_id']; ?>" class="league-nav-link active">
        <i class="fas fa-chart-bar"></i> View
      </a>
      <a href="#league-requests" class="league-nav-link">
        <i class="fas fa-user-plus"></i> Team Requests
      </a>
      <a href="#league-teams" class="league-nav-link">
        <i class="fas fa-users"></i> Teams
      </a>
      <a href="#league-add-schedule" class="league-nav-link">
        <i class="fas fa-calendar-plus"></i> Add Schedule
      </a>
      <a href="#league-schedule" class="league-nav-link">
        <i class="fas fa-list-alt"></i> Matches
      </a>
      <a href="#league-rules" class="league-nav-link">
        <i class="fas fa-book"></i> Rules
      </a>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="league-container">
    <!-- Team Requests -->
    <?php if (!empty($team_request)) { ?>
    <section id="league-requests" class="league-section">
      <div class="league-section-header">
        <span>Team Requests</span>
        <span class="league-badge"><?php echo count($team_request); ?></span>
      </div>
      <div class="league-section-body">
        <div class="league-table-wrapper">
          <table class="league-table">
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
                  <a href="<?php echo base_url(); ?>TeamController/team_profile/<?php echo $teams->team_id; ?>" class="league-match-action">
                    <?php echo $teams->team_name; ?>
                  </a>
                </td>
                <td><?php echo $teams->city; ?></td>
                <td>
                  <div class="d-flex gap-2">
                    <a href="<?php echo base_url(); ?>TournamentController/accept_request/<?php echo $teams->team_id; ?>/<?php echo $league['league_id']; ?>" class="league-btn league-btn-success league-btn-sm">
                      <i class="fas fa-check"></i> Accept
                    </a>
                    <a href="<?php echo base_url(); ?>TournamentController/reject_team_request/<?php echo $teams->team_id; ?>/<?php echo $league['league_id']; ?>" class="league-btn league-btn-danger league-btn-sm">
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

    <!-- Teams -->
    <section id="league-teams" class="league-section">
      <div class="league-section-header">
        <span>Registered Teams</span>
        <span class="league-badge"><?php echo !empty($league_teams) ? count($league_teams) : 0; ?></span>
      </div>
      <div class="league-section-body">
        <?php if (!empty($league_teams)) { ?>
          <div class="league-team-grid">
            <?php foreach ($league_teams as $l_teams) { ?>
              <div class="league-team-card">
                <img src="<?php echo $l_teams['image_path']; ?>" alt="<?php echo $l_teams['team_name']; ?>" class="league-team-img">
                <div class="league-team-content">
                  <h3 class="league-team-name">
                    <a href="<?php echo base_url(); ?>TeamController/team_profile/<?php echo $l_teams['team_id']; ?>" class="league-match-action">
                      <?php echo $l_teams['team_name']; ?>
                    </a>
                  </h3>
                  <p class="league-team-meta"><i class="fas fa-trophy"></i> 5 Matches</p>
                  <p class="league-team-meta"><i class="fas fa-star"></i> 10 Points</p>
                </div>
              </div>
            <?php } ?>
          </div>
        <?php } else { ?>
          <div class="league-empty">
            <i class="fas fa-users-slash"></i>
            <h4>No Teams Registered</h4>
            <p>No teams have joined yet.</p>
          </div>
        <?php } ?>
      </div>
    </section>

    <!-- Add Schedule -->
    <section id="league-add-schedule" class="league-section">
      <div class="league-section-header">
        <span>Add New Match</span>
      </div>
      <div class="league-section-body">
        <button class="league-btn league-btn-primary" data-bs-toggle="modal" data-bs-target="#leagueAddScheduleModal">
          <i class="fas fa-plus"></i> Create New Match
        </button>
      </div>
    </section>

    <!-- Schedule -->
    <section id="league-schedule" class="league-section">
      <div class="league-section-header">
        <span>Match Schedule</span>
        <span class="league-badge"><?php echo !empty($league_schedule) ? count($league_schedule) : 0; ?></span>
      </div>
      <div class="league-section-body">
        <?php if (!empty($league_schedule)) { ?>
          <div class="league-schedule-grid">
            <?php foreach ($league_schedule as $schedule) { ?>
              <div class="league-match-card">
                <div class="league-match-team-info">
                  <img src="<?php echo $schedule->team_one_image; ?>" alt="<?php echo $schedule->team_one_name; ?>" class="league-team-logo">
                  <div class="league-match-team-name"><?php echo $schedule->team_one_name; ?></div>
                </div>
                <span class="league-vs-text">VS</span>
                <div class="league-match-team-info">
                  <img src="<?php echo $schedule->team_two_image; ?>" alt="<?php echo $schedule->team_two_name; ?>" class="league-team-logo">
                  <div class="league-match-team-name"><?php echo $schedule->team_two_name; ?></div>
                </div>
                <div class="league-match-details">
                  <span class="league-match-info">
                    <i class="far fa-calendar-alt"></i> <?php echo date("d F Y", strtotime($schedule->match_date)); ?>
                  </span>
                  <span class="league-match-info">
                    <i class="far fa-clock"></i> <?php echo $schedule->match_time; ?>
                  </span>
                  <span class="league-match-info">
                    <i class="fas fa-map-marker-alt"></i> <?php echo $schedule->location; ?>
                  </span>
                  <span class="league-match-info">
                    <i class="fas fa-baseball-ball"></i> <?php echo $schedule->overs; ?> Overs
                  </span>
                </div>
                <div class="league-match-actions">
                  <a href="#" class="league-match-action edit-schedule" data-bs-toggle="modal" data-bs-target="#leagueEditScheduleModal"
                     data-schedule-id="<?php echo $schedule->match_id; ?>" 
                     data-team1="<?php echo $schedule->team_one_id; ?>" 
                     data-team2="<?php echo $schedule->team_two_id; ?>" 
                     data-match-date="<?php echo $schedule->match_date; ?>" 
                     data-match-time="<?php echo $schedule->match_time; ?>" 
                     data-location="<?php echo $schedule->location; ?>"
                     data-overs="<?php echo $schedule->overs; ?>"
                     data-umpire1="<?php echo $schedule->umpire1; ?>"
                     data-umpire2="<?php echo $schedule->umpire2; ?>">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <a href="<?php echo base_url();?>Welcome/toss/<?php echo $schedule->team_one_id;?>/<?php echo $schedule->team_two_id;?>/<?php echo $schedule->match_id;?>" class="league-match-action">
                    <i class="fas fa-clipboard-list"></i> Score
                  </a>
                  <a href="<?php echo base_url(); ?>ScheduleController/delete_schedule/<?php echo $schedule->match_id; ?>/<?php echo $league['league_id']; ?>" class="league-match-action text-danger" onclick="return confirm('Delete this match?');">
                    <i class="fas fa-trash-alt"></i> Delete
                  </a>
                </div>
              </div>
            <?php } ?>
          </div>
        <?php } else { ?>
          <div class="league-empty">
            <i class="far fa-calendar-times"></i>
            <h4>No Scheduled Matches</h4>
            <p>Create your first match schedule.</p>
          </div>
        <?php } ?>
      </div>
    </section>

    <!-- Rules -->
    <section id="league-rules" class="league-section">
      <div class="league-section-header">
        <span>League Rules</span>
        <span class="league-badge"><?php echo !empty($league_rules) ? count($league_rules) : 0; ?></span>
      </div>
      <div class="league-section-body">
        <form action="<?php echo base_url(); ?>TournamentController/add_rules" method="POST" class="mb-3">
          <div class="mb-3">
            <label for="leagueRule" class="league-form-label">Add New Rule</label>
            <textarea class="league-form-control" id="leagueRule" name="league_rule" rows="3" required placeholder="Enter rule description..."></textarea>
          </div>
          <input type="hidden" value="<?php echo $league['league_id']; ?>" name="league_id">
          <button type="submit" class="league-btn league-btn-primary">
            <i class="fas fa-plus-circle"></i> Add Rule
          </button>
        </form>
        <div class="league-rules-list">
          <?php if (!empty($league_rules)) { ?>
            <?php foreach ($league_rules as $rule) { ?>
              <div class="league-rule-item">
                <div class="league-rule-text"><?php echo $rule->league_rule; ?></div>
                <div class="league-rule-actions">
                  <a href="#" class="edit-rule" data-bs-toggle="modal" data-bs-target="#leagueEditRuleModal" 
                     data-rule-id="<?php echo $rule->league_rules_id; ?>" 
                     data-rule-description="<?php echo $rule->league_rule; ?>">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <a href="<?php echo base_url(); ?>TournamentController/delete_rule/<?php echo $rule->league_rules_id; ?>/<?php echo $league['league_id']; ?>" class="text-danger" onclick="return confirm('Delete this rule?');">
                    <i class="fas fa-trash-alt"></i> Delete
                  </a>
                </div>
              </div>
            <?php } ?>
          <?php } else { ?>
            <div class="league-empty">
              <i class="fas fa-book-open"></i>
              <h4>No Rules Defined</h4>
              <p>Add rules for your league.</p>
            </div>
          <?php } ?>
        </div>
      </div>
    </section>
  </main>

  <!-- Mobile Navigation -->
  <nav class="league-bottom-nav">
    <a href="<?php echo base_url(); ?>Welcome/tournament_landing/<?php echo $league['league_id']; ?>" class="league-nav-item">
      <span class="league-nav-icon"><i class="fas fa-chart-bar"></i></span>
      <span>View</span>
    </a>
    <a href="#league-requests" class="league-nav-item">
      <span class="league-nav-icon"><i class="fas fa-user-plus"></i></span>
      <span>Requests</span>
    </a>
    <a href="#league-teams" class="league-nav-item">
      <span class="league-nav-icon"><i class="fas fa-users"></i></span>
      <span>Teams</span>
    </a>
    <a href="#league-add-schedule" class="league-nav-item">
      <span class="league-nav-icon"><i class="fas fa-calendar-plus"></i></span>
      <span>Schedule</span>
    </a>
    <a href="#league-schedule" class="league-nav-item">
      <span class="league-nav-icon"><i class="fas fa-list-alt"></i></span>
      <span>Matches</span>
    </a>
    <a href="#league-rules" class="league-nav-item">
      <span class="league-nav-icon"><i class="fas fa-book"></i></span>
      <span>Rules</span>
    </a>
  </nav>

  <!-- Modals -->
  <div class="modal fade" id="leagueAddScheduleModal" tabindex="-1" aria-labelledby="addScheduleLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="league-modal-content">
        <div class="league-modal-header">
          <h5 class="modal-title" id="addScheduleLabel">Create New Match</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="league-modal-body">
          <form action="<?php echo base_url(); ?>ScheduleController/add_schedule" method="POST">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="series" class="league-form-label">League</label>
                <input type="text" class="league-form-control" id="series" name="series" value="<?php echo $league['league_name']; ?>" readonly>
              </div>
              <div class="col-md-6 mb-3">
                <label for="match-type" class="league-form-label">Match Type</label>
                <input type="text" class="league-form-control" name="match_type" value="<?php echo $league['match_type']; ?>" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="team1" class="league-form-label">First Team</label>
                <select id="team1" name="team1" class="league-form-select" required>
                  <option value="" disabled selected>Select First Team</option>
                  <?php if (!empty($league_teams)) { 
                    foreach ($league_teams as $l_teams) { ?>
                      <option value="<?php echo $l_teams['team_id']; ?>"><?php echo $l_teams['team_name']; ?></option>
                    <?php } 
                  } ?>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label for="team2" class="league-form-label">Second Team</label>
                <select id="team2" name="team2" class="league-form-select" required>
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
                <label for="match-date" class="league-form-label">Match Date</label>
                <input type="date" class="league-form-control" id="match-date" name="match_date" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="match-time" class="league-form-label">Match Time</label>
                <input type="time" class="league-form-control" id="match-time" name="match_time" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="overs" class="league-form-label">Overs</label>
                <input type="number" class="league-form-control" id="overs" value="<?php echo $league['overs']; ?>" name="overs" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="location" class="league-form-label">Venue</label>
                <input type="text" class="league-form-control" id="location" name="location" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="umpire1" class="league-form-label">First Umpire</label>
                <input type="text" class="league-form-control" id="umpire1" name="umpire1" placeholder="Enter Umpire Name">
              </div>
              <div class="col-md-6 mb-3">
                <label for="umpire2" class="league-form-label">Second Umpire</label>
                <input type="text" class="league-form-control" id="umpire2" name="umpire2" placeholder="Enter Umpire Name">
              </div>
            </div>
            <input type="hidden" value="<?php echo $league['league_id']; ?>" name="league_id">
            <div class="d-grid">
              <button type="submit" class="league-btn league-btn-primary">
                <i class="fas fa-save"></i> Save Match
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="leagueEditScheduleModal" tabindex="-1" aria-labelledby="editScheduleLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="league-modal-content">
        <div class="league-modal-header">
          <h5 class="modal-title" id="editScheduleLabel">Edit Match Schedule</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="league-modal-body">
          <form id="editScheduleForm" action="<?php echo base_url(); ?>ScheduleController/edit_schedule" method="POST">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="editSeries" class="league-form-label">League</label>
                <input type="text" class="league-form-control" id="editSeries" name="series" value="<?php echo $league['league_name']; ?>" readonly>
              </div>
              <div class="col-md-6 mb-3">
                <label for="editMatchType" class="league-form-label">Match Type</label>
                <input type="text" class="league-form-control" name="match_type" value="<?php echo $league['match_type']; ?>" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="editTeam1" class="league-form-label">First Team</label>
                <select id="editTeam1" name="team1" class="league-form-select" required>
                  <?php if (!empty($league_teams)) { 
                    foreach ($league_teams as $l_teams) { ?>
                      <option value="<?php echo $l_teams['team_id']; ?>"><?php echo $l_teams['team_name']; ?></option>
                    <?php } 
                  } ?>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label for="editTeam2" class="league-form-label">Second Team</label>
                <select id="editTeam2" name="team2" class="league-form-select" required>
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
                <label for="editMatchDate" class="league-form-label">Match Date</label>
                <input type="date" class="league-form-control" id="editMatchDate" name="match_date" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="editMatchTime" class="league-form-label">Match Time</label>
                <input type="time" class="league-form-control" id="editMatchTime" name="match_time" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="editOvers" class="league-form-label">Overs</label>
                <input type="number" class="league-form-control" id="editOvers" name="overs" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="editLocation" class="league-form-label">Venue</label>
                <input type="text" class="league-form-control" id="editLocation" name="location" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="editUmpire1" class="league-form-label">First Umpire</label>
                <input type="text" class="league-form-control" id="editUmpire1" name="umpire1">
              </div>
              <div class="col-md-6 mb-3">
                <label for="editUmpire2" class="league-form-label">Second Umpire</label>
                <input type="text" class="league-form-control" id="editUmpire2" name="umpire2">
              </div>
            </div>
            <input type="hidden" id="editScheduleId" name="schedule_id">
            <input type="hidden" value="<?php echo $league['league_id']; ?>" name="league_id">
            <div class="d-grid">
              <button type="submit" class="league-btn league-btn-primary">
                <i class="fas fa-save"></i> Update Match
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="leagueEditRuleModal" tabindex="-1" aria-labelledby="editRuleLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="league-modal-content">
        <div class="league-modal-header">
          <h5 class="modal-title" id="editRuleLabel">Edit League Rule</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="league-modal-body">
          <form id="editRuleForm" action="<?php echo base_url(); ?>TournamentController/update_rules" method="POST">
            <div class="mb-3">
              <label for="editRuleDescription" class="league-form-label">Rule Description</label>
              <textarea class="league-form-control" id="editRuleDescription" name="league_rule" rows="5" required></textarea>
            </div>
            <input type="hidden" id="editRuleId" name="rule_id">
            <input type="hidden" value="<?php echo $league['league_id']; ?>" name="league_id">
            <div class="d-flex gap-2 justify-content-end">
              <button type="button" class="league-btn league-btn-danger" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="league-btn league-btn-primary">
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
      // Edit Schedule Modal
      document.addEventListener('click', function(e) {
        if (e.target.classList.contains('edit-schedule') {
          const button = e.target.closest('.edit-schedule');
          document.getElementById('editScheduleId').value = button.getAttribute('data-schedule-id');
          document.getElementById('editTeam1').value = button.getAttribute('data-team1');
          document.getElementById('editTeam2').value = button.getAttribute('data-team2');
          document.getElementById('editMatchDate').value = button.getAttribute('data-match-date');
          document.getElementById('editMatchTime').value = button.getAttribute('data-match-time');
          document.getElementById('editLocation').value = button.getAttribute('data-location');
          document.getElementById('editOvers').value = button.getAttribute('data-overs');
          document.getElementById('editUmpire1').value = button.getAttribute('data-umpire1') || '';
          document.getElementById('editUmpire2').value = button.getAttribute('data-umpire2') || '';
        }
      });

      // Edit Rule Modal
      document.addEventListener('click', function(e) {
        if (e.target.classList.contains('edit-rule')) {
          const button = e.target.closest('.edit-rule');
          document.getElementById('editRuleId').value = button.getAttribute('data-rule-id');
          document.getElementById('editRuleDescription').value = button.getAttribute('data-rule-description');
        }
      });

      // Smooth Scrolling
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
          e.preventDefault();
          const targetId = this.getAttribute('href');
          if (targetId === '#') return;
          const target = document.querySelector(targetId);
          if (target) {
            const offset = document.querySelector('.league-nav').offsetHeight + 20;
            window.scrollTo({
              top: target.offsetTop - offset,
              behavior: 'smooth'
            });
            updateActiveNav(targetId);
          }
        });
      });

      // Navigation Highlight
      const sections = document.querySelectorAll('.league-section');
      const navLinks = document.querySelectorAll('.league-nav-link, .league-nav-item');
      
      function updateActiveNav(targetId) {
        navLinks.forEach(link => {
          link.classList.remove('active');
          if (link.getAttribute('href') === targetId) {
            link.classList.add('active');
          }
        });
      }

      window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
          const sectionTop = section.offsetTop;
          const sectionHeight = section.clientHeight;
          const scrollPosition = window.pageYOffset + 100;
          if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
            current = `#${section.getAttribute('id')}`;
          }
        });
        updateActiveNav(current);
      });
    });
  </script>
</body>
</html>