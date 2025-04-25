<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
        background-color: #dee2e6;
    }
    .form-container {
        max-width: 380px;
        margin: 70px auto;
        background: #fff;
        padding: 20px 30px;
        border-radius: 12px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    }
    .form-container h2 {
        margin-bottom: 20px;
        text-align: center;
        font-weight: bold;
        color: #3c2f2f;
    }
    .btn-primary {
        background-color: #fd7e14;
        border: none;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #e06c00;
    }
    .form-footer {
        text-align: center;
        margin-top: 15px;
    }
    .form-footer a {
        color: #fd7e14;
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
    @media (max-width: 576px) {
        .form-container {
            margin: 40px 20px;
            padding: 15px;
        }
        .form-container h2 {
            font-size: 1.3rem;
        }
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Forgot Password</h2>
    <?php if ($this->session->flashdata('error')): ?>
      <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($this->session->flashdata('error')); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success" role="alert"><?php echo htmlspecialchars($this->session->flashdata('success')); ?></div>
    <?php endif; ?>
    <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
    <?php echo form_open('Auth/forgot_password_submit', ['id' => 'forgot-password-form']); ?>
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" value="<?php echo set_value('email'); ?>" required aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll send a password reset link to this email.</div>
      </div>
      <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
      <div class="form-footer">
        <p>Remember your password? <a href="<?php echo base_url('Auth/sign_in'); ?>">Sign In</a></p>
      </div>
    <?php echo form_close(); ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById('forgot-password-form').addEventListener('submit', function(e) {
      const email = document.getElementById('email').value;
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        e.preventDefault();
        alert('Please enter a valid email address.');
      }
    });
  </script>
</body>
</html>