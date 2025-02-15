<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Status Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #f8f9fa, #e9ecef);
            font-family: Arial, sans-serif;
        }
        .team-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
            overflow: hidden;
        }
        .team-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .status {
            border-radius: 15px;
            padding: 5px 10px;
            font-size: 0.8rem;
            text-transform: uppercase;
        }
        .status.manage {
            background-color: #28a745;
            color: #fff;
        }
        .status.not-manage {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <h1 class="text-center mb-4">Team Status Dashboard</h1>
        <div class="row">
             <?php if($data==0)
             {?>
              <div class="card team-card">
               <h5> There is no team to show yet. </h5>
           </div>
               <?php } else
             { 
                foreach($data as $team)
                { ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card team-card">
                    <img src="<?php echo $team->image_path;?>" alt="Team Image" class="card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title"> <?php echo $team->team_name;?></h5>
                        <p class="status manage">Manage</p>
                        <a href="#" class="btn btn-primary btn-sm">View</a>
                    </div>
                </div>
            </div>
            <?php }
        }?>

            
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
