<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cricket Teams Selection</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Arial', sans-serif;
    }
    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }
    h1 {
      text-align: center;
      margin-bottom: 40px;
      font-size: 28px;
      font-weight: bold;
      color: #333;
    }
    .team-card {
      background: #fff;
      border: 1px solid #e0e0e0;
      border-radius: 12px;
      padding: 20px;
      text-align: center;
      transition: transform 0.2s, box-shadow 0.2s;
      margin-bottom: 20px;
    }
    .team-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }
    .team-logo {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 15px;
      border: 2px solid #e0e0e0;
    }
    .team-name {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 15px;
      color: #333;
    }
    .btn-play {
      padding: 8px 20px;
      font-size: 14px;
      border-radius: 25px;
      background-color: #007bff;
      border: none;
      color: #fff;
      transition: background-color 0.2s;
      text-transform: uppercase;
      font-weight: 600;
    }
    .btn-play:hover {
      background-color: #0056b3;
    }
    .row {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }
    .col-md-4 {
      flex: 1 1 calc(33.333% - 40px);
      max-width: calc(33.333% - 40px);
    }
    @media (max-width: 768px) {
      .col-md-4 {
        flex: 1 1 calc(50% - 20px);
        max-width: calc(50% - 20px);
      }
    }
    @media (max-width: 576px) {
      .col-md-4 {
        flex: 1 1 100%;
        max-width: 100%;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>Here is your Opposition Team list</h1>
    <div class="row">
<?php  if ($team_names['status'] == 'error'): ?>
        <!-- Display error message if no records are found -->
        <div class="error-message">
            <?php echo $team_names['message']; ?>
        </div>
     <?php else: ?>
        <!-- Display match teams if records are found -->
        <?php  foreach ($team_names['data'] as $team): ?>
      <div class="col-md-4">
       
        <div class="team-card">
         
          <img src="<?php echo $team->team_one_image;?>" alt="Team 1" class="team-logo">
          <div class="team-name"><?php echo $team->team_one_name;?></div>
          <a href="<?php echo base_url();?>Welcome/enter_schedule/<?php echo $team->team_two_id;?>/<?php echo $team->team_one_id;?>" class="btn btn-play">Play Match</a>
       
        </div>

      </div>
    <?php endforeach; ?>
    <?php endif; ?>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>