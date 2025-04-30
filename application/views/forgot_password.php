<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
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
    <h2>Forgot Password</h2>
    <?php if ($this->session->flashdata('error')): ?>
      <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($this->session->flashdata('error')); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success" role="alert"><?php echo htmlspecialchars($this->session->flashdata('success')); ?></div>
    <?php endif; ?>
    <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
    <?php echo form_open('auth/forgot_password_submit', ['id' => 'forgot-password-form']); ?>
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" value="<?php echo set_value('email'); ?>" required aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll send a password reset link to this email.</div>
        <div class="feedback" id="emailFeedback"></div>
      </div>
      <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
      <div class="form-footer">
        <p>Remembered your password? <a href="<?php echo base_url('auth/sign_in'); ?>">Sign In</a></p>
        <p>Don't have an account? <a href="<?php echo base_url('auth/sign_up'); ?>">Sign Up</a></p>
      </div>
    <?php echo form_close(); ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Real-time email validation
    document.getElementById('email').addEventListener('input', function() {
      const value = this.value.trim();
      const feedback = document.getElementById('emailFeedback');
      const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!value) {
        feedback.className = 'feedback neutral';
        feedback.textContent = 'Please enter your email.';
      } else if (!regex.test(value)) {
        feedback.className = 'feedback invalid';
        feedback.textContent = 'Please enter a valid email address.';
      } else {
        feedback.className = '';
        feedback.textContent = '';
      }
    });

    // Form submission
    document.getElementById('forgot-password-form').addEventListener('submit', function(e) {
      e.preventDefault();
      let isValid = true;

      const email = document.getElementById('email');
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email.value)) {
        document.getElementById('emailFeedback').className = 'feedback invalid';
        document.getElementById('emailFeedback').textContent = 'Please enter a valid email address.';
        isValid = false;
      }

      if (isValid) {
        this.submit();
      }
    });
  </script>
</body>
</html>