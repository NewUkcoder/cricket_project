<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic League Registration</title>
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
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .form-title {
            text-align: center;
            font-size: 2rem;
            color: #28a745;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .form-container .form-group label {
            font-weight: bold;
            color: #28a745;
        }

        .form-container .form-control {
            border-radius: 8px;
            border: 1px solid #28a745;
            padding: 10px;
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
    <div class="container">
        <!-- Basic League Registration Form -->
        <div class="form-container">
            <div class="form-title">
                <span>Basic League Registration</span>
            </div>

            <form action="<?php echo base_url();?>TournamentController/add_league" method="POST">

                 <div class="form-group mb-3">
                    <label for="league_name">Title</label>
                    <input type="text" id="league_name" name="league_name" class="form-control" placeholder="Enter League Title" required>
                </div>

                <!-- City -->
                <div class="form-group mb-3">
                    <label for="city">City</label>
                    <input type="cou" id="city" name="city" class="form-control" placeholder="Enter city" required>
                </div>

                <!-- Country -->
                <div class="form-group mb-3">
                    <label for="country">Country</label>
                    <input type="country" id="country" name="country" class="form-control" placeholder="Enter country" required>
                </div>

                <!-- Venue -->
                <div class="form-group mb-3">
                    <label for="venue">Venue</label>
                    <input type="text" id="venue" name="venue" class="form-control" placeholder="Enter Venue" required>
                </div>

                <div class="form-group mb-3">
                    <label for="Venue">Season</label>
                    <input type="text" id="season" name="season" class="form-control" placeholder="Enter Season .i.e. 2025 or 1st etc" required>
                </div>

                 <div class="form-group mb-3">
                    <label for="overs">Overs</label>
                    <input type="number" id="overs" name="overs" class="form-control" placeholder="Enter Total Overs" required>
                </div>


                <!-- Phone -->
                <div class="form-group mb-3">
                    <label for="phone_number">Phone (it will be public.Enter if you are agree to share)</label>
                    <input type="tel" id="phone_number" name="phone_number" class="form-control" placeholder="Enter your number">
                </div>

                <!-- Ball Type -->
                <div class="form-group mb-3">
          <label for="match-type" class="form-label">Match Type</label>
          <select class="form-control" id="match-type" name="match_type" required>
            <option value="Leather Ball">Leather Ball</option>
            <option value="Tape Ball">Tape Ball</option>
            <option value="Tennis Ball">Tennis Ball</option>
            <option value="Others">Others</option>
          </select>
        </div>

                <!-- Submit Button -->
                <div class="form-group mb-3">
                    <button type="submit" class="btn">Register League</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>