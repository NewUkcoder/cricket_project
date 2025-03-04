<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cricket Team Requests</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa; /* Light background for the page */
    }
    .container-fluid {
      max-width: 600px; /* Limiting the width for smaller screens */
      margin: 0 auto; /* Centering the container */
    }
    .request-card {
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      margin-bottom: 10px;
      padding: 10px;
      background-color: #fff;
      display: flex;
      align-items: center;
      flex-wrap: wrap;
    }
    .team-image {
      width: 40px; /* Smaller image */
      height: 40px; /* Smaller image */
      border-radius: 50%;
      object-fit: cover;
      margin-right: 10px;
    }
    .request-details {
      flex-grow: 1;
    }
    .buttons {
      display: flex;
      gap: 5px;
      margin-top: 5px;
    }
    .btn {
      padding: 5px 10px;
      font-size: 12px;
    }
    .btn-success {
      background-color: #28a745;
      border-color: #28a745;
    }
    .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
    }
    .btn-secondary {
      background-color: #6c757d;
      border-color: #6c757d;
    }
    .tab-bar {
      display: flex;
      justify-content: center;
      margin-bottom: 20px;
      border-bottom: 2px solid #ddd;
    }
    .tab-bar button {
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      background-color: transparent;
      color: #333;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    .tab-bar button.active {
      border-bottom: 2px solid #007bff;
      color: #007bff;
      font-weight: bold;
    }
    .request-column {
      display: none;
    }
    .request-column.active {
      display: block;
    }
    @media (max-width: 576px) {
      .team-image {
        width: 35px;
        height: 35px;
      }
      .request-card {
        flex-direction: column;
        align-items: flex-start;
      }
      .buttons {
        width: 100%;
        justify-content: space-between;
      }
    }
  </style>
</head>
<body>

<div class="container-fluid my-4">
  <h2 class="text-center mb-4">Team's Requests</h2>

  <div class="tab-bar">
  <button class="active" onclick="showReceived()">Received Requests</button> 
  (<?php echo isset($team_names['received_request_count']) ? $team_names['received_request_count'] : 0; ?>)
  
  <button onclick="showSent()">Sent Requests</button>
  (<?php echo isset($team_names['sent_request_count']) ? $team_names['sent_request_count'] : 0; ?>)
</div>

<div class="request-column active" id="received-requests">
  <?php if (isset($team_names['received_request']) && !empty($team_names['received_request'])) {  
    foreach ($team_names['received_request'] as $value) { ?>
      <div class="request-card">
        <img src="<?php echo $value->image_path; ?>" alt="Team Image" class="team-image">
        <div class="request-details">
          <h5 class="card-title"><?php echo $value->team_name; ?></h5>
          <p class="card-text"><?php echo $value->city; ?></p>
        </div>
        <div class="buttons">
          <a href="<?php echo base_url();?>TeamController/accept_match_request/<?php echo $main_team;?>/<?php echo $value->team_id;?>">
            <button class="btn btn-success">Accept</button>
          </a>
          <a href="<?php echo base_url();?>TeamController/reject_match_request/<?php echo $main_team;?>/<?php echo $value->team_id;?>"> 
            <button class="btn btn-danger">Reject</button>
          </a>
        </div>
      </div>
    <?php } 
  } else { 
    echo "<p class='text-center'>No received requests.</p>";
  } ?>
</div>

<div class="request-column" id="sent-requests">
  <?php if (isset($team_names['sent_request']) && !empty($team_names['sent_request'])) {  
    foreach ($team_names['sent_request'] as $value) { ?>
      <div class="request-card">
        <img src="<?php echo $value->image_path; ?>" alt="Team Image" class="team-image">
        <div class="request-details">
          <h5 class="card-title"><a href="<?php echo base_url();?>TeamController/team_profile/<?php echo $value->team_id;?>"><?php echo $value->team_name; ?></a></h5>
          <p class="card-text"><?php echo $value->city; ?></p>
        </div>
        <div class="buttons">
          <button class="btn btn-secondary" disabled>Pending</button>
        </div>
      </div>
    <?php } 
  } else { 
    echo "<p class='text-center'>No sent requests.</p>";
  } ?>
</div>

  </div>
</div>

<script>
  function showReceived() {
    document.getElementById('received-requests').classList.add('active');
    document.getElementById('sent-requests').classList.remove('active');
    document.querySelector('.tab-bar button:first-child').classList.add('active');
    document.querySelector('.tab-bar button:last-child').classList.remove('active');
  }

  function showSent() {
    document.getElementById('sent-requests').classList.add('active');
    document.getElementById('received-requests').classList.remove('active');
    document.querySelector('.tab-bar button:last-child').classList.add('active');
    document.querySelector('.tab-bar button:first-child').classList.remove('active');
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
