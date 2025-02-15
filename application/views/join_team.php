<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Teams</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .team-item {
            background-color: #fff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .team-item:hover {
            background-color: #f8f9fa;
        }
        .join-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .join-btn:hover {
            background-color: #218838;
        }
        .notification {
            width: 100%;
            padding: 10px;
            background-color: #2ecc71;
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
        }
        .search-form button {
            border-radius: 25px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Search and Join Cricket Teams</h2>

        <!-- Search Form -->
        <div class="mb-4 search-form">
            <form action="<?php echo site_url('PlayerController/search_team'); ?>" method="POST" class="d-flex">
                <input type="hidden" value="<?php echo $player_id; ?>" name="player_id">
                <input type="text" name="query" class="form-control me-2" placeholder="Search for a team..." value="<?php echo isset($_GET['query']) ? $_GET['query'] : ''; ?>" required>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
<div id="notification" class="notification"></div>
        <!-- Display Teams -->
        <div id="team-list">
            <?php if (!empty($teams)): ?>
                <?php foreach ($teams as $team): ?>
                    <div class="team-item">
                        <span><?php echo $team->team_name; ?></span>
                        <button class="join-btn" data-team="<?php echo $team->team_name; ?>" data-player-id="<?php echo $player_id; ?>">Join</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-teams">No teams found. Try searching for another team!</p>
            <?php endif; ?>
        </div>

        <!-- Notification -->
        
    </div>

    <!-- Bootstrap JS & Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
       $(document).ready(function() {
    // Handle the Join button click event
    $('.join-btn').click(function() {
        const teamName = $(this).data('team'); // Retrieve team name
        const playerId = $(this).data('player-id'); // Retrieve player ID

        console.log("Team Name:", teamName); // Log for debugging
        console.log("Player ID:", playerId); // Log for debugging

        // Send AJAX request to join the team
        $.ajax({
            url: '<?php echo base_url(); ?>PlayerController/insert_team', // Endpoint to handle the join request
            type: 'POST',
            data: { team_name: teamName, player_id: playerId },
            success: function(response) {
                console.log('Response from server:', response);  // Log the response from the server
                const data = JSON.parse(response); // Parse the JSON response
                if (data.status === 'success') {
                    $('#notification').text(data.message).addClass('visible');

                    // Redirect to another page after 3 seconds
                    setTimeout(function() {
                        window.location.href = '<?php echo base_url(); ?>PlayerController/sent_team_request/<?php echo $player_id;?>'; // Replace with your desired URL
                    });
                } else {
                    alert(data.message);  // Show error message if failed
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX error:', status, error); // Log AJAX error
                alert('Error joining the team. Please try again.');
            }
        });
    });
});
    </script>
</body>
</html>