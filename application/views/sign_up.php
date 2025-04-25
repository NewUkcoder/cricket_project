<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
        background-color: #e9ecef;
    }
    .form-container {
        max-width: 420px;
        margin: 50px auto;
        background: #fff;
        padding: 30px 40px;
        border-radius: 10px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }
    .form-container h2 {
        margin-bottom: 20px;
        text-align: center;
        font-weight: bold;
        color: #1a3c34;
    }
    .btn-primary {
        background-color: #28a745;
        border: none;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #218838;
    }
    .form-footer {
        text-align: center;
        margin-top: 15px;
    }
    .form-footer a {
        color: #28a745;
        text-decoration: none;
        font-size: 0.9rem;
    }
    .form-footer a:hover {
        text-decoration: underline;
    }
    .alert {
        margin-bottom: 15px;
        font-size: 0.9rem;
    }
    .form-text {
        font-size: 0.85rem;
    }
    .form-check-label a {
        color: #28a745;
    }
    .form-check-label a:hover {
        text-decoration: underline;
    }
    @media (max-width: 576px) {
        .form-container {
            margin: 25px 10px;
            padding: 20px;
        }
        .form-container h2 {
            font-size: 1.4rem;
        }
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Sign Up</h2>
    <?php if ($this->session->flashdata('error')): ?>
      <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($this->session->flashdata('error')); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success" role="alert"><?php echo htmlspecialchars($this->session->flashdata('success')); ?></div>
    <?php endif; ?>
    <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
    <?php echo form_open('Auth/sign_up_submit', ['id' => 'signup-form']); ?>
      <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Enter your full name" value="<?php echo set_value('name'); ?>" required aria-describedby="nameHelp">
        <div id="nameHelp" class="form-text">Enter your full name as it appears on your ID.</div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" value="<?php echo set_value('email'); ?>" required aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone.</div>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required aria-describedby="passwordHelp">
        <div id="passwordHelp" class="form-text">Minimum 8 characters, include a number and a special character.</div>
      </div>
      <div class="mb-3">
        <label for="password_confirm" class="form-label">Confirm Password</label>
        <input type="password" name="password_confirm" class="form-control" id="password_confirm" placeholder="Confirm your password" required>
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" name="agreement" class="form-check-input" id="agreement" required>
        <label class="form-check-label" for="agreement">I agree to the <a href="<?php echo base_url('Auth/terms'); ?>" target="_blank">Terms and Conditions</a> and <a href="<?php echo base_url('Auth/privacy'); ?>" target="_blank">Privacy Policy</a>.</label>
      </div>
      <button type="submit" class="btn btn-primary w-100">Sign Up</button>
      <div class="form-footer">
        <p>Already have an account? <a href="<?php echo base_url('Auth/sign_in'); ?>">Sign In</a></p>
      </div>
    <?php echo form_close(); ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById('signup-form').addEventListener('submit', function(e) {
      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;
      const passwordConfirm = document.getElementById('password_confirm').value;
      const agreement = document.getElementById('agreement').checked;
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      const passwordRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
      if (!emailRegex.test(email)) {
        e.preventDefault();
        alert('Please enter a valid email address.');
      }
      if (!passwordRegex.test(password)) {
        e.preventDefault();
        alert('Password must be at least 8 characters, include a number and a special character.');
      }
      if (password !== passwordConfirm) {
        e.preventDefault();
        alert('Passwords do not match.');
      }
      if (!agreement) {
        e.preventDefault();
        alert('You must agree to the Terms and Conditions and Privacy Policy.');
      }
    });
  </script>
</body>
</html>