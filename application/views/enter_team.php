<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Information Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f5f1;
            color: #212529;
        }

        .form-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 50px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .form-title {
            text-align: center;
            font-size: 2.5rem;
            color: #28a745;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .gradient-heading {
            color: #28a745;
            font-weight: bold;
            margin-bottom: 20px;
            font-size: 1.5rem;
            text-transform: uppercase;
        }

        .form-container .form-group label {
            font-weight: bold;
            color: #28a745;
        }

        .form-container .form-control {
            border-radius: 8px;
            border: 1px solid #28a745;
            padding: 12px;
        }

        .form-container .btn {
            background-color: #28a745;
            color: #fff;
            font-weight: bold;
            padding: 12px;
            border-radius: 8px;
            border: none;
            width: 100%;
            cursor: pointer;
        }

        .form-container .btn:hover {
            background-color: #218838;
        }

        .form-container .form-control:focus {
            border-color: #218838;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
        }
    </style>
</head>
<body>
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
<div class="container">

    <!-- Team Information Registration Form -->
    <div class="form-container">
        <div class="form-title">
            <span class="gradient-heading">Team Information Registration</span>
        </div>

        <form action="<?php echo base_url();?>TeamController/add_team" method="POST" enctype="multipart/form-data">
            <!-- Team Name -->
            <div class="form-group mb-3">
                <label for="team_name">Team Name</label>
                <input type="text" id="team_name" name="team_name" class="form-control" placeholder="Enter team name" required>
            </div>

            <!-- Team Logo -->
            <div class="form-group mb-3">
                <label for="teamLogo">Team Logo (Image)</label>
                <input type="file" id="teamLogo" name="userfile" class="form-control" accept="image/*" required>
            </div>

        
            <div class="form-group mb-3">
                <label for="city">City</label>
                <input type="text" id="city" name="city" class="form-control" placeholder="Enter city" required>
            </div>

            <!-- Team Management -->
            <div class="form-group mb-3">
                <label for="country">Country</label>
                <input type="text" id="country" name="country" class="form-control" placeholder="Enter country" required>
            </div>
             <div class="form-group mb-3">
                <label for="country">Home Ground</label>
                <input type="text" id="home_ground" name="home_ground" class="form-control" placeholder="Enter home ground" required>
            </div>
             <div class="form-group mb-3">
                <label for="country">Phone Number(Team admin phone number. It will be public.if you do not want to share opnely, leave it blank)</label>
                <input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="Enter team's admin phone number" >
            </div>

            <!-- Coach -->
            <div class="form-group mb-3">
                <label for="coach">Coach</label>
                <input type="text" id="coach" name="coach" class="form-control" placeholder="Enter coach name" required>
            </div>

            <div class="form-group mb-3">
                <label for="chairman">Chairman</label>
                <input type="text" id="chairman" name="chairman" class="form-control" placeholder="Enter coach name" required>
            </div>



            <!-- Team Description -->
            <div class="form-group mb-3">
                <label for="description">Team Description</label>
                <textarea id="description" name="description" class="form-control" rows="4" placeholder="Enter a brief description of the team" required></textarea>
            </div>

            <!-- Submit Button -->
            <div class="form-group mb-3">
                <button type="submit" class="btn">Register Team</button>
            </div>
        </form>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
