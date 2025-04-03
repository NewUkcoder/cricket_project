<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f6f9;
    }
    .container {
        width: 90%; /* Adjust width for all screen sizes */
        max-width: 800px; /* Limit the width for large screens */
        margin-top: 20px;
    }
    h2 {
        color: #333;
        font-size: 24px;
        margin-bottom: 15px;
    }
    .team-item {
        background-color: #ffffff;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-bottom: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        transition: transform 0.3s, background-color 0.3s;
    }
    .team-item:hover {
        background-color: #e0e0e0;
        transform: translateY(-5px);
    }
    .team-name {
        font-weight: 600;
        font-size: 16px;
        color: #333;
    }
    .view-btn {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 20px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .view-btn:hover {
        background-color: #0056b3;
    }
    .notification {
        width: 100%;
        padding: 12px;
        background-color: #28a745;
        color: white;
        border-radius: 5px;
        font-size: 14px;
        display: none;
        margin-top: 20px;
    }
    .notification.visible {
        display: block;
    }
    .no-teams {
        text-align: center;
        margin-top: 20px;
        color: #888;
    }
    .search-form input {
        border-radius: 25px;
        width: 75%;
        padding: 10px;
        margin-right: 10px;
    }
    .search-form button {
        border-radius: 25px;
        padding: 10px 20px;
    }
    /* Responsive for mobile */
    @media (max-width: 768px) {
        h2 {
            font-size: 20px;
        }
        .team-item {
            flex-direction: column;
            align-items: flex-start;
            text-align: left;
        }
        .search-form input {
            width: 100%;
            margin-bottom: 10px;
        }
        .search-form button {
            width: 100%;
        }
    }
</style>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Search Teams</h2>
        <p class="text-center">Enter team admin's email address</p>

        <!-- Search Form -->
        <div class="mb-4 search-form">
            <form action="<?php echo site_url('TournamentController/find_tournament'); ?>" method="POST" class="d-flex flex-column flex-sm-row">
                <input type="hidden" value="<?php echo $team_id; ?>" name="team_id">
                <input type="email" name="email" class="form-control me-2" placeholder="Enter team admin's email" value="<?php echo isset($_GET['query']) ? $_GET['query'] : ''; ?>" required>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <!-- Notification -->
        <div id="notification" class="notification"></div>

        <!-- Display Teams -->
        <div id="team-list">
            <?php if (!empty($tournament)): ?>
                <?php foreach ($tournament as $league): ?>
                    <div class="team-item" onclick="window.location.href='<?php echo base_url();?>TournamentController/tournament_team/<?php echo $league->league_id;?>/<?php echo  $team_id; ?>'">
                        <span class="team-name"><?php echo $league->league_name; ?></span>
                        <button class="view-btn">Join Tournament</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-teams">No teams found. Try searching for another team!</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap JS & Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
