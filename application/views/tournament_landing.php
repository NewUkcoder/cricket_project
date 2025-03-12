<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cricket Tournament Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles for Typography -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }

        .navbar {
            margin-bottom: 20px;
        }

        .container {
            margin-top: 30px;
        }

        h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #343a40;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #007bff;
            color: white;
        }

        .card-body {
            padding: 20px;
        }

        .nav-link {
            color: #007bff;
        }

        .nav-link:hover {
            color: #0056b3;
        }

        .sidebar {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar h4 {
            font-size: 1.2rem;
            font-weight: 500;
            color: #343a40;
        }

        .stats-box {
            margin-top: 20px;
        }

        .stats-box .card {
            margin-bottom: 15px;
        }

        .stats-box .card-body {
            padding: 15px;
            background-color: #e9ecef;
            text-align: center;
        }

        .btn-update {
            background-color: #007bff;
            color: white;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 1rem;
            text-align: center;
        }

        .btn-update:hover {
            background-color: #0056b3;
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: stretch;
        }

        .col-md-4 {
            flex: 1;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .row {
                flex-direction: column;
            }

            .col-md-4 {
                margin-bottom: 15px;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Cricket Tournament</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#stats">Stats</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#record-entry">Record Entry</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#updating-record">Updating Record</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <!-- Sidebar -->
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="sidebar">
                    <h4>Menu</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#stats">Tournament Stats</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#record-entry">Record Entry</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#updating-record">Update Records</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9 col-md-8 col-sm-12">
                <!-- Stats Section -->
                <div id="stats" class="stats-box">
                    <h2>Cricket Stats</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    Top Batsman
                                </div>
                                <div class="card-body">
                                    <p><strong>Player Name</strong>: Virat Kohli</p>
                                    <p><strong>Runs</strong>: 1023</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    Top Bowler
                                </div>
                                <div class="card-body">
                                    <p><strong>Player Name</strong>: Jasprit Bumrah</p>
                                    <p><strong>Wickets</strong>: 45</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    Top Team Score
                                </div>
                                <div class="card-body">
                                    <p><strong>Team</strong>: India</p>
                                    <p><strong>Score</strong>: 350/5</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    Lowest Team Score
                                </div>
                                <div class="card-body">
                                    <p><strong>Team</strong>: Australia</p>
                                    <p><strong>Score</strong>: 98/10</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Record Entry Section -->
                <div id="record-entry" class="stats-box">
                    <h2>Record Entry</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    Scorecard
                                </div>
                                <div class="card-body">
                                    <p>Enter match score details here.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    Schedule
                                </div>
                                <div class="card-body">
                                    <p>Enter upcoming match schedule details here.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    Teams
                                </div>
                                <div class="card-body">
                                    <p>Enter team names and details here.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    Point Table
                                </div>
                                <div class="card-body">
                                    <p>Enter point table details here.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Updating Record Section -->
                <div id="updating-record" class="stats-box">
                    <h2>Updating Record</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    Update Match Score
                                </div>
                                <div class="card-body">
                                    <button class="btn-update">Update Score</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    Update Schedule
                                </div>
                                <div class="card-body">
                                    <button class="btn-update">Update Schedule</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    Update Team
                                </div>
                                <div class="card-body">
                                    <button class="btn-update">Update Team</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
