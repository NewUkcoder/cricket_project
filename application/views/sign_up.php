<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet"
  >
  <style>
    body {
      background-color: #f8f9fa; /* Light background */
    }
    .form-container {
      max-width: 400px;
      margin: 50px auto;
      background: #fff;
      padding: 20px 30px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .form-container h2 {
      margin-bottom: 20px;
      text-align: center;
      font-weight: bold;
      color: #343a40;
    }
    .btn-primary {
      background-color: #007bff;
      border: none;
    }
    .btn-primary:hover {
      background-color: #0056b3;
    }
    .btn-danger:hover {
      background-color: #d90429;
    }
    .form-footer {
      text-align: center;
      margin-top: 15px;
    }
    .form-footer a {
      color: #007bff;
      text-decoration: none;
    }
    .form-footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
 

  <!-- Sign-Up Form -->
  <div class="form-container" id="sign-up">
    <h2>Sign Up</h2>
    <form action="<?php echo site_url('Auth/sign_up_submit'); ?>" method="POST">
      <div class="mb-3">
        <label for="signup-name" class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" id="signup-name" placeholder="Enter your full name" required>
      </div>
      <div class="mb-3">
        <label for="signup-email" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="signup-email" placeholder="Enter your email" required>
      </div>
      <div class="mb-3">
        <label for="signup-password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="signup-password" placeholder="Enter your password" required>
      </div>
     
      <button type="submit" class="btn btn-primary w-100">Sign Up</button>
      <div class="form-footer">
        <p>Already have an account? <a href="<?php echo site_url('Welcome/index'); ?>">Sign In</a></p>
      </div>
    </form>
  </div>

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
