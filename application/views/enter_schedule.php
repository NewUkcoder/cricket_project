<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cricket Match Schedule Registration</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* General Body Styling */
    body {
      background-color: #f9f9f9;
      font-family: 'Arial', sans-serif;
      padding: 20px 0;
    }

    /* Header Styling */
    h1 {
      font-size: 2.5rem;
      font-weight: 700;
      color: #333;
      text-align: center;
      margin-bottom: 40px;
    }

    /* Form Card Styling */
    .form-card {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      padding: 30px;
      max-width: 600px;
      margin: 0 auto;
    }

    .form-card h2 {
      font-size: 1.8rem;
      font-weight: 600;
      color: #333;
      text-align: center;
      margin-bottom: 30px;
    }

    /* Input Fields Styling */
    .form-control {
      border-radius: 10px;
      box-shadow: none;
      border: 1px solid #ddd;
    }

    .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* Submit Button Styling */
    .btn-submit {
      background-color: #007bff;
      color: #fff;
      font-weight: 600;
      border-radius: 10px;
      padding: 10px 20px;
      width: 100%;
      border: none;
      transition: background-color 0.3s ease;
    }

    .btn-submit:hover {
      background-color: #0056b3;
    }

    /* Spacing for Inputs */
    .mb-3 {
      margin-bottom: 1.5rem;
    }

    /* Responsive Styling */
    @media (max-width: 576px) {
      h1 {
        font-size: 2rem;
      }

      .form-card {
        padding: 20px;
        max-width: 100%;
      }

      .form-control {
        font-size: 0.9rem;
      }

      .btn-submit {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>

  <div class="container py-5">
    <h1>Cricket Match Schedule Registration</h1>

    <!-- Form Card -->
    <div class="form-card">
      <h2>Enter Match Details</h2>

      <form action="<?php echo base_url();?>ScheduleController/add_schedule" method="POST">
        <!-- Team 1 -->
        <?php if ($this->session->flashdata('error')): ?>
        <div style="color: red;">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success')): ?>
        <div style="color: green;">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    
         <label for="playerRole" class="form-label">Select First Team</label>
        <select class="form-select" id="playerRole" name="team1" required>
                        <option value="">Select 1st Team</option>
                         <?php foreach($team as $team_info)
                {?>
                        <option value="<?php echo $team_info->team_id;?>"><?php echo $team_info->team_name;?></option>
                        
                       <?php }?>
        </select>

        <!-- Team 2 -->
         <label for="playerRole" class="form-label">Select Second Team</label>
        <select class="form-select" id="playerRole" name="team2" required>
                        <option value="">Select 2nd Team</option>
                         <?php foreach($team as $team_info)
                {?>
                         <option value="<?php echo $team_info->team_id;?>"><?php echo $team_info->team_name;?></option>
                        
                     <?php }?>   
          </select>
                 
        <!-- Match Date -->
        <div class="mb-3">
          <label for="match-date" class="form-label">Match Date</label>
          <input type="date" class="form-control" id="match-date" name="match_date" required>
        </div>

        <!-- Match Time -->
        <div class="mb-3">
          <label for="match-time" class="form-label">Match Time</label>
          <input type="time" class="form-control" id="match-time" name="match_time" required>
        </div>

        <!-- Match Type -->
        <div class="mb-3">
          <label for="match-type" class="form-label">Match Type</label>
          <select class="form-control" id="match-type" name="match_type" required>
            <option value="Leather Ball">Leather Ball</option>
            <option value="Tape Ball">Tape Ball</option>
             <option value="Tennis Ball">Tennis Ball</option>
             <option value="Others">Others</option>
          </select>
        </div>

        <!-- Overs -->
        <div class="mb-3">
          <label for="overs" class="form-label">Overs</label>
          <input type="number" class="form-control" id="overs" name="overs" placeholder="Enter Number of Overs" required>
        </div>

        <!-- Location -->
        <div class="mb-3">
          <label for="location" class="form-label">Location</label>
          <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" required>
        </div>

        <!-- Series -->
        <div class="mb-3">
          <label for="series" class="form-label">Series</label>
          <input type="text" class="form-control" id="series" name="series" placeholder="Enter Series" required>
        </div>

        <!-- Umpires -->
        <div class="mb-3">
          <label for="umpires" class="form-label">Umpires</label>
          <input type="text" class="form-control" id="umpires" name="umpire1" placeholder="Enter First Umpires Names" >
        </div>
         <div class="mb-3">
          <label for="umpires" class="form-label">Umpires</label>
          <input type="text" class="form-control" id="umpires" name="umpire2" placeholder="Enter Second Umpires Names" >
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-submit">Submit</button>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
