<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>imcric</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Header Styles */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #2c3e50; /* Updated background color */
            color: #fff;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 40px; /* Adjust logo height */
            margin-right: 10px;
        }

        .user-email {
            font-size: 0.9rem;
            color: #ecf0f1; /* Light gray for email */
        }

        nav ul {
            display: flex;
            list-style: none;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 1rem;
        }

        .menu-icon {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            nav ul {
                display: none;
                flex-direction: column;
                width: 100%;
                background-color: #34495e; /* Darker background for mobile menu */
                position: absolute;
                top: 60px; /* Adjusted for logo height */
                left: 0;
            }

            nav ul.active {
                display: flex;
            }

            nav ul li {
                margin: 10px 0;
                text-align: center;
            }

            .menu-icon {
                display: block;
            }

            .user-email {
                display: none; /* Hide email on small screens */
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="https://via.placeholder.com/150x50?text=Your+Logo" alt="Logo"> <!-- Replace with your logo -->
            <?php if ($this->session->userdata('logged_in')){?>
          
            <span class="user-email"><?php echo $this->session->userdata('email');?></span> <?php } ?><!-- Replace with user email -->
        </div>
        <nav>
            <ul>
                <li><a href="<?php echo base_url();?>Welcome/welcome_message">Home</a></li>
                <li><a href="<?php echo site_url('Auth/logout'); ?>">Logout</a></li>
              
            </ul>
        </nav>
        <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
    </header>

    <script>
        function toggleMenu() {
            const nav = document.querySelector('nav ul');
            nav.classList.toggle('active');
        }
    </script>

    <!-- Example Content -->
  