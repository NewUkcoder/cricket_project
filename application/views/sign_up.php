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
    .invalid-feedback {
        display: none;
        font-size: 0.85rem;
    }
    .is-invalid ~ .invalid-feedback {
        display: block;
    }
    .password-strength {
        margin-top: 5px;
        font-size: 0.85rem;
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
    <?php echo form_open('auth/sign_up_submit', ['id' => 'signup-form']); ?>
      <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Enter your full name" value="<?php echo set_value('name'); ?>" required aria-describedby="nameHelp">
        <div id="nameHelp" class="form-text">Enter your full name as it appears on your ID.</div>
        <div class="invalid-feedback">Name must be 2-50 characters and contain only letters and spaces.</div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" value="<?php echo set_value('email'); ?>" required aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone.</div>
        <div class="invalid-feedback" id="emailFeedback">Please enter a valid email address.</div>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="password-container">
          <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required aria-describedby="passwordHelp">
          <span class="toggle-password" onclick="togglePassword('password')">Show</span>
        </div>
        <div id="passwordHelp" class="form-text">Minimum 8 characters, include uppercase, lowercase, number, and special character.</div>
        <div class="invalid-feedback" id="passwordFeedback"></div>
        <div class="password-strength" id="passwordStrength"></div>
      </div>
      <div class="mb-3">
        <label for="password_confirm" class="form-label">Confirm Password</label>
        <div class="password-container">
          <input type="password" name="password_confirm" class="form-control" id="password_confirm" placeholder="Confirm your password" required>
          <span class="toggle-password" onclick="togglePassword('password_confirm')">Show</span>
        </div>
        <div class="invalid-feedback">Passwords do not match.</div>
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" name="agreement" class="form-check-input" id="agreement" required>
        <label class="form-check-label" for="agreement">I agree to the <a href="<?php echo base_url('auth/terms'); ?>" target="_blank">Terms and Conditions</a> and <a href="<?php echo base_url('auth/privacy'); ?>" target="_blank">Privacy Policy</a>.</label>
        <div class="invalid-feedback">You must agree to the Terms and Conditions and Privacy Policy.</div>
      </div>
      <button type="submit" class="btn btn-primary w-100">Sign Up</button>
      <div class="form-footer">
        <p>Already have an account? <a href="<?php echo base_url('auth/sign_in'); ?>">Sign In</a></p>
      </div>
    <?php echo form_close(); ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

    // Real-time email uniqueness check
    document.getElementById('email').addEventListener('blur', function() {
      const email = this.value;
      const emailFeedback = document.getElementById('emailFeedback');
      if (email) {
        $.ajax({
          url: '<?php echo base_url('auth/check_email'); ?>',
          type: 'POST',
          data: { email: email },
          success: function(response) {
            if (response.exists) {
              $('#email').addClass('is-invalid');
              emailFeedback.textContent = 'This email is already registered.';
            } else {
              $('#email').removeClass('is-invalid');
            }
          },
          error: function() {
            $('#email').addClass('is-invalid');
            emailFeedback.textContent = 'Error checking email. Please try again.';
          }
        });
      }
    });

    // Form validation
    document.getElementById('signup-form').addEventListener('submit', function(e) {
      e.preventDefault();
      let isValid = true;

      // Name validation
      const name = document.getElementById('name');
      const nameRegex = /^[a-zA-Z\s]{2,50}$/;
      if (!nameRegex.test(name.value.trim())) {
        name.classList.add('is-invalid');
        isValid = false;
      } else {
        name.classList.remove('is-invalid');
      }

      // Email validation
      const email = document.getElementById('email');
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email.value)) {
        email.classList.add('is-invalid');
        document.getElementById('emailFeedback').textContent = 'Please enter a valid email address.';
        isValid = false;
      }

      // Password validation
      const password = document.getElementById('password');
      const passwordConfirm = document.getElementById('password_confirm');
      const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;
      const passwordFeedback = document.getElementById('passwordFeedback');
      
      if (!passwordRegex.test(password.value)) {
        password.classList.add('is-invalid');
        passwordFeedback.textContent = 'Password must be at least 8 characters, include uppercase, lowercase, number, and special character.';
        isValid = false;
      } else {
        password.classList.remove('is-invalid');
      }

      // Password confirmation
      if (password.value !== passwordConfirm.value) {
        passwordConfirm.classList.add('is-invalid');
        isValid = false;
      } else {
        passwordConfirm.classList.remove('is-invalid');
      }

      // Agreement checkbox
      const agreement = document.getElementById('agreement');
      if (!agreement.checked) {
        agreement.classList.add('is-invalid');
        isValid = false;
      } else {
        agreement.classList.remove('is-invalid');
      }

      if (isValid) {
        this.submit();
      }
    });

    // Real-time password strength indicator
    document.getElementById('password').addEventListener('input', function() {
      const password = this.value;
      const strengthIndicator = document.getElementById('passwordStrength');
      let strength = 0;
      
      if (password.length >= 8) strength++;
      if (/[A-Z]/.test(password)) strength++;
      if (/[a-z]/.test(password)) strength++;
      if (/\d/.test(password)) strength++;
      if (/[!@#$%^&*]/.test(password)) strength++;

      switch(strength) {
        case 0:
        case 1:
          strengthIndicator.textContent = 'Weak';
          strengthIndicator.style.color = '#dc3545';
          break;
        case 2:
        case 3:
          strengthIndicator.textContent = 'Moderate';
          strengthIndicator.style.color = '#ffc107';
          break;
        case 4:
        case 5:
          strengthIndicator.textContent = 'Strong';
          strengthIndicator.style.color = '#28a745';
          break;
      }
    });

    // Remove invalid feedback on input
    ['name', 'email', 'password', 'password_confirm'].forEach(id => {
      document.getElementById(id).addEventListener('input', function() {
        this.classList.remove('is-invalid');
      });
    });

    document.getElementById('agreement').addEventListener('change', function() {
      this.classList.remove('is-invalid');
    });
  </script>
</body>
</html>