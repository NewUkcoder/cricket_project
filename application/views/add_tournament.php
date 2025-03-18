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

            <form action="<?php echo base_url();?>LeagueController/add_league" method="POST">
                <!-- City -->
                <div class="form-group mb-3">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" class="form-control" placeholder="Enter city" required>
                </div>

                <!-- Country -->
                <div class="form-group mb-3">
                    <label for="country">Country</label>
                    <input type="text" id="country" name="country" class="form-control" placeholder="Enter country" required>
                </div>

                <!-- Email -->
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter email" required>
                </div>

                <!-- Phone -->
                <div class="form-group mb-3">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="Enter phone number">
                </div>

                <!-- Ball Type -->
                <div class="form-group mb-3">
                    <label for="ball_type">Ball Type</label>
                    <select id="ball_type" name="ball_type" class="form-control" required>
                        <option value="" disabled selected>Select ball type</option>
                        <option value="leather">Leather</option>
                        <option value="tape">Tape</option>
                        <option value="tennis">Tennis</option>
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