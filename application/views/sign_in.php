<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
        background-color: #e9ecef;
    }
    .form-container {
        max-width: 400px;
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
    .password-container {
        position: relative;
    }
    .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 0.9rem;
        color: #6c757d;
    }
    .feedback {
        font-size: 0.85rem;
        margin-top: 5px;
    }
    .feedback.invalid {
        color: #dc3545;
    }
    .feedback.neutral {
        color: #6c757d;
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
    <h2>Sign In</h2>
    <?php if ($this->session->flashdata('error')): ?>
      <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($this->session->flashdata('error')); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success" role="alert"><?php echo htmlspecialchars($this->session->flashdata('success')); ?></div>
    <?php endif; ?>
    <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
    <?php echo form_open('auth/sign_in_submit', ['id' => 'signin-form']); ?>
      <div class="mb-3">
        <label for="identifier" class="form-label">Username or Email</label>
        <input type="text" name="identifier" class="form-control" id="identifier" placeholder="Enter username or email" value="<?php echo set_value('identifier'); ?>" required>
        <div class="feedback" id="identifierFeedback"></div>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="password-container">
          <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
          <span class="toggle-password" onclick="togglePassword('password')">Show</span>
        </div>
        <div class="feedback" id="passwordFeedback"></div>
      </div>
      <button type="submit" class="btn btn-primary w-100">Sign In</button>
      <div class="form-footer">
        <p>Don't have an account? <a href="<?php echo base_url('auth/sign_up'); ?>">Sign Up</a></p>
        <p><a href="<?php echo base_url('auth/reset_password'); ?>">Forgot Password?</a></p>
      </div>
    <?php echo form_close(); ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Toggle password visibility
    function togglePassword(fieldId) {
      const field = document.getElementById(fieldId);
      const toggle = field.nextElementSibling;
      if (field.type === 'password') {
        field.type = 'text';
        toggle.textContent = 'Hide';
      } else {
        field.type = 'password';
        toggle.textContent = 'Show';
      }
    }

    // Real-time validation
    document.getElementById('identifier').addEventListener('input', function() {
      const value = this.value.trim();
      const feedback = document.getElementById('identifierFeedback');
      if (!value) {
        feedback.className = 'feedback neutral';
        feedback.textContent = 'Please enter your username or email.';
      } else {
        feedback.className = '';
        feedback.textContent = '';
      }
    });

    document.getElementById('password').addEventListener('input', function() {
      const value = this.value;
      const feedback = document.getElementById('passwordFeedback');
      if (!value) {
        feedback.className = 'feedback neutral';
        feedback.textContent = 'Please enter your password.';
      } else {
        feedback.className = '';
        feedback.textContent = '';
      }
    });

    // Form submission
    document.getElementById('signin-form').addEventListener('submit', function(e) {
      e.preventDefault();
      let isValid = true;

      const identifier = document.getElementById('identifier');
      const password = document.getElementById('password');

      if (!identifier.value.trim()) {
        document.getElementById('identifierFeedback').className = 'feedback invalid';
        document.getElementById('identifierFeedback').textContent = 'Username or email is required.';
        isValid = false;
      }

      if (!password.value) {
        document.getElementById('passwordFeedback').className = 'feedback invalid';
        document.getElementById('passwordFeedback').textContent = 'Password is required.';
        isValid = false;
      }

      if (isValid) {
        this.submit();
      }
    });
  </script>
</body>
</html>