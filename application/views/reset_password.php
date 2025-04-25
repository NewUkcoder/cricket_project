<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
        background-color: #f5f5f5;
    }
    .form-container {
        max-width: 360px;
        margin: 80px auto;
        background: #fff;
        padding: 25px 30px;
        border-radius: 6px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }
    .form-container h2 {
        margin-bottom: 20px;
        text-align: center;
        font-weight: bold;
        color: #4a235a;
    }
    .btn-primary {
        background-color: #6f42c1;
        border: none;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #5e35b1;
    }
    .form-footer {
        text-align: center;
        margin-top: 15px;
    }
    .form-footer a {
        color: #6f42c1;
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
            margin: 50px 15px;
            padding: 20px;
        }
        .form-container h2 {
            font-size: 1.3rem;
        }
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Reset Password</h2>
    <?php if ($this->session->flashdata('error')): ?>
      <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($this->session->flashdata('error')); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success" role="alert"><?php echo htmlspecialchars($this->session->flashdata('success')); ?></div>
    <?php endif; ?>
    <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
    <?php echo form_open('Auth/reset_password_submit', ['id' => 'reset-password-form']); ?>
      <input type="hidden" name="token" value="<?php echo htmlspecialchars($this->input->get('token')); ?>">
      <div class="mb-3">
        <label for="password" class="form-label">New Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Enter new password" required aria-describedby="passwordHelp">
        <div id="passwordHelp" class="form-text">Minimum 8 characters, include a number and a special character.</div>
      </div>
      <div class="mb-3">
        <label for="password_confirm" class="form-label">Confirm New Password</label>
        <input type="password" name="password_confirm" class="form-control" id="password_confirm" placeholder="Confirm new password" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Reset Password</button>
      <div class="form-footer">
        <p>Remembered your password? <a href="<?php echo base_url('Auth/sign_in'); ?>">Sign In</a></p>
      </div>
    <?php echo form_close(); ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById('reset-password-form').addEventListener('submit', function(e) {
      const password = document.getElementById('password').value;
      const passwordConfirm = document.getElementById('password_confirm').value;
      const passwordRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
      if (!passwordRegex.test(password)) {
        e.preventDefault();
        alert('Password must be at least 8 characters, include a number and a special character.');
      }
      if (password !== passwordConfirm) {
        e.preventDefault();
        alert('Passwords do not match.');
      }
    });
  </script>
</body>
</html>