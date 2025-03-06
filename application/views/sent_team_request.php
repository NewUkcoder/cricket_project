<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sent Team Requests</title>
    <style>
       body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f4f8;
}

.container {
    width: 70%; /* Adjusted width */
    margin: 20px auto;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    padding: 20px;
    border-top: 5px solid #008c8c; /* Modern color accent */
}

h1 {
    text-align: center;
    color: #333;
    font-size: 2rem;
    margin-bottom: 20px;
}

.request-list {
    list-style: none;
    padding: 0;
}

.request-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #fafafa;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    margin-bottom: 20px;
    padding: 15px;
    transition: transform 0.3s, background-color 0.3s;
}

.request-item:hover {
    transform: translateY(-5px);
    background-color: #e0f7fa; /* Light cyan background on hover */
}

.request-info {
    display: flex;
    align-items: center;
    gap: 15px;
}

.request-info img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}

.request-info div {
    display: flex;
    flex-direction: column;
}

.request-info p {
    margin: 0;
    font-size: 1rem;
    color: #333;
}

.status {
    font-weight: bold;
    color: #ff9800; /* Modern orange accent */
}

.btn {
    padding: 10px 20px;
    background-color: #009688; /* Teal accent */
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #00796b;
    transform: scale(1.05);
}

/* Mobile-Friendly Adjustments */
@media screen and (max-width: 768px) {
    .container {
        width: 90%; /* Further reduce width on mobile */
    }

    h1 {
        font-size: 1.5rem;
    }

    .request-item {
        flex-direction: row; /* Keep horizontal layout for mobile */
        align-items: center;
        justify-content: space-between;
    }

    .request-info {
        flex-direction: row; /* Keep team details side by side */
        justify-content: space-between;
        align-items: center;
        width: auto;
    }

    .request-info div {
        margin-left: 10px;
    }

    .btn {
        margin-left: 15px; /* Ensure space between team details and button */
        width: auto;
    }

    .request-item:hover {
        transform: none; /* Remove hover effect for mobile */
    }
}

    </style>
</head>
<body>

    <div class="container">
             <h1><?php echo $player_name['playerName']; $player_id=$player_name['player_id'];?>(Sent Team Requests)</h1>
        <?php foreach($data as $request){ ?>

        <ul class="request-list">
            <li class="request-item">
                <div class="request-info">
                    <img src="<?php echo $request->team_image_path;?>" alt="Team 1 Picture">
                    <div> <?php $team_id=$request->team_id;?>
                        <p><strong>Team:</strong> <?php echo $request->team_name;?></p>
                        <p><strong>Request Date:</strong> <?php echo date('F j, Y', strtotime($request->joined_at)); ?></p>

                        <p class="status">Status: <?php if($request->status==0){ echo "Wating";}else{ echo "Approved";}?></p>
                    </div>
                </div>
                <a class="nav-link join-team" href="<?php echo base_url();?>PlayerController/cancel_request/<?php echo $player_id;?>/<?php echo $team_id;?>"><button class="btn">Cancel Request</button></a>
            </li>
           
        </ul>
    <?php } ?>
    </div>

</body>
</html>
