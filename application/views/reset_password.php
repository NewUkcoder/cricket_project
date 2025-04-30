<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
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
    .feedback.valid {
        color: #28a745;
    }
    .feedback.invalid {
        color: #dc3545;
    }
    .feedback.neutral {
        color: #6c757d;
    }
    .password-requirements {
        font-size: 0.8rem;
        margin-top: 5px;
        color: #6c757d;
    }
    .password-requirements li.valid {
        color: #28a745;
    }
    #securityQuestionsSection {
        display: none;
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
    <h2>Reset Password</h2>
    <?php if ($this->session->flashdata('error')): ?>
      <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($this->session->flashdata('error')); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success" role="alert"><?php echo htmlspecialchars($this->session->flashdata('success')); ?></div>
    <?php endif; ?>
    <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
    <?php echo form_open('auth/reset_password_submit', ['id' => 'reset-password-form']); ?>
      <div class="mb-3">
        <label for="identifier" class="form-label">Username or Email</label>
        <input type="text" name="identifier" class="form-control" id="identifier" placeholder="Enter username or email" required aria-describedby="identifierHelp">
        <div id="identifierHelp" class="form-text">Enter your username or registered email.</div>
        <div class="feedback" id="identifierFeedback"></div>
      </div>
      <div id="securityQuestionsSection">
        <input type="hidden" name="user_id" id="user_id">
        <div class="mb-3">
          <label for="security_answer1" class="form-label" id="security_question1_label"></label>
          <input type="text" name="security_answer1" class="form-control" id="security_answer1" placeholder="Enter your answer" required>
          <div class="feedback" id="securityAnswer1Feedback"></div>
        </div>
        <div class="mb-3">
          <label for="security_answer2" class="form-label" id="security_question2_label"></label>
          <input type="text" name="security_answer2" class="form-control" id="security_answer2" placeholder="Enter your answer" required>
          <div class="feedback" id="securityAnswer2Feedback"></div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">New Password</label>
          <div class="password-container">
            <input type="password" name="password" class="form-control" id="password" placeholder="Enter new password" required aria-describedby="passwordHelp">
            <span class="toggle-password" onclick="togglePassword('password')">Show</span>
          </div>
          <div id="passwordHelp" class="form-text">Minimum 8 characters, include uppercase, lowercase, number, and special character.</div>
          <div class="feedback" id="passwordFeedback"></div>
          <ul class="password-requirements" id="passwordRequirements">
            <li id="length">At least 8 characters</li>
            <li id="uppercase">One uppercase letter</li>
            <li id="lowercase">One lowercase letter</li>
            <li id="number">One number</li>
            <li id="special">One special character (!@#$%^&*)</li>
          </ul>
        </div>
        <div class="mb-3">
          <label for="confirm_password" class="form-label">Confirm Password</label>
          <div class="password-container">
            <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm new password" required>
            <span class="toggle-password" onclick="togglePassword('confirm_password')">Show</span>
          </div>
          <div class="feedback" id="passwordConfirmFeedback"></div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary w-100" id="submitButton" disabled>Reset Password</button>
      <div class="form-footer">
        <p>Remembered your password? <a href="<?php echo base_url('auth/sign_in'); ?>">Sign In</a></p>
        <p>Don't have an account? <a href="<?php echo base_url('auth/sign_up'); ?>">Sign Up</a></p>
      </div>
    <?php echo form_close(); ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Add CSRF token to AJAX requests
    $.ajaxSetup({
        data: {
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        }
    });

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

    // Real-time identifier validation
    document.getElementById('identifier').addEventListener('input', function() {
      const value = this.value.trim();
      const feedback = document.getElementById('identifierFeedback');
      const securityQuestionsSection = document.getElementById('securityQuestionsSection');
      const submitButton = document.getElementById('submitButton');

      if (!value) {
        feedback.className = 'feedback neutral';
        feedback.textContent = 'Please enter your username or email.';
        securityQuestionsSection.style.display = 'none';
        submitButton.disabled = true;
        return;
      }

      $.ajax({
        url: '<?php echo base_url('auth/get_security_questions'); ?>',
        type: 'POST',
        data: { identifier: value },
        dataType: 'json',
        success: function(response) {
          if (response.error) {
            feedback.className = 'feedback invalid';
            feedback.textContent = response.error;
            securityQuestionsSection.style.display = 'none';
            submitButton.disabled = true;
          } else {
            feedback.className = 'feedback valid';
            feedback.textContent = 'User found! Please answer the security questions.';
            document.getElementById('user_id').value = response.user_id;
            document.getElementById('security_question1_label').textContent = 'Security Question 1: ' + response.security_question1;
            document.getElementById('security_question2_label').textContent = 'Security Question 2: ' + response.security_question2;
            securityQuestionsSection.style.display = 'block';
            submitButton.disabled = false;
            validateSecurityAnswer('security_answer1', 'securityAnswer1Feedback');
            validateSecurityAnswer('security_answer2', 'securityAnswer2Feedback');
          }
          if (response.csrf_token) {
            $.ajaxSetup({ data: { '<?php echo $this->security->get_csrf_token_name(); ?>': response.csrf_token } });
          }
        },
        error: function(xhr, status, error) {
          console.error('Get questions error:', xhr, status, error);
          feedback.className = 'feedback invalid';
          feedback.textContent = 'Error fetching security questions. Please try again.';
          securityQuestionsSection.style.display = 'none';
          submitButton.disabled = true;
        }
      });
    });

    // Real-time security answer validation
    function validateSecurityAnswer(answerId, feedbackId) {
      const answer = document.getElementById(answerId);
      const feedback = document.getElementById(feedbackId);
      if (!answer.value) {
        feedback.className = 'feedback neutral';
        feedback.textContent = 'Please enter your answer.';
      } else if (answer.value.length < 2) {
        feedback.className = 'feedback invalid';
        feedback.textContent = 'Answer must be at least 2 characters.';
      } else {
        feedback.className = 'feedback valid';
        feedback.textContent = 'Looks good!';
      }
    }

    ['security_answer1', 'security_answer2'].forEach(id => {
      document.getElementById(id).addEventListener('input', function() {
        validateSecurityAnswer(id, id + 'Feedback');
      });
    });

    // Real-time password validation
    document.getElementById('password').addEventListener('input', function() {
      const value = this.value;
      const feedback = document.getElementById('passwordFeedback');
      const requirements = {
        length: document.getElementById('length'),
        uppercase: document.getElementById('uppercase'),
        lowercase: document.getElementById('lowercase'),
        number: document.getElementById('number'),
        special: document.getElementById('special')
      };

      const checks = {
        length: value.length >= 8,
        uppercase: /[A-Z]/.test(value),
        lowercase: /[a-z]/.test(value),
        number: /\d/.test(value),
        special: /[!@#$%^&*]/.test(value)
      };

      Object.keys(checks).forEach(key => {
        requirements[key].className = checks[key] ? 'valid' : '';
      });

      const passed = Object.values(checks).filter(Boolean).length;
      if (!value) {
        feedback.className = 'feedback neutral';
        feedback.textContent = 'Please enter a password.';
      } else if (passed < 5) {
        feedback.className = 'feedback invalid';
        feedback.textContent = 'Password needs improvement.';
      } else {
        feedback.className = 'feedback valid';
        feedback.textContent = 'Strong password!';
      }
    });

    // Real-time password confirmation
    document.getElementById('confirm_password').addEventListener('input', function() {
      const value = this.value;
      const password = document.getElementById('password').value;
      const feedback = document.getElementById('passwordConfirmFeedback');
      if (!value) {
        feedback.className = 'feedback neutral';
        feedback.textContent = 'Please confirm your password.';
      } else if (value !== password) {
        feedback.className = 'feedback invalid';
        feedback.textContent = 'Passwords do not match.';
      } else {
        feedback.className = 'feedback valid';
        feedback.textContent = 'Passwords match!';
      }
    });

    // Form submission
    document.getElementById('reset-password-form').addEventListener('submit', function(e) {
      e.preventDefault();
      let isValid = true;

      // Identifier
      const identifier = document.getElementById('identifier');
      if (!identifier.value.trim()) {
        document.getElementById('identifierFeedback').className = 'feedback invalid';
        document.getElementById('identifierFeedback').textContent = 'Username or email is required.';
        isValid = false;
      }

      // Security answers
      const answer1 = document.getElementById('security_answer1');
      const answer2 = document.getElementById('security_answer2');

      if (!answer1.value || answer1.value.length < 2) {
        document.getElementById('securityAnswer1Feedback').className = 'feedback invalid';
        document.getElementById('securityAnswer1Feedback').textContent = 'Please provide a valid answer.';
        isValid = false;
      }

      if (!answer2.value || answer2.value.length < 2) {
        document.getElementById('securityAnswer2Feedback').className = 'feedback invalid';
        document.getElementById('securityAnswer2Feedback').textContent = 'Please provide a valid answer.';
        isValid = false;
      }

      // Password
      const password = document.getElementById('password');
      const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;
      if (!passwordRegex.test(password.value)) {
        document.getElementById('passwordFeedback').className = 'feedback invalid';
        document.getElementById('passwordFeedback').textContent = 'Password does not meet requirements.';
        isValid = false;
      }

      // Password confirmation
      const confirmPassword = document.getElementById('confirm_password');
      if (password.value !== confirmPassword.value) {
        document.getElementById('passwordConfirmFeedback').className = 'feedback invalid';
        document.getElementById('passwordConfirmFeedback').textContent = 'Passwords do not match.';
        isValid = false;
      }

      if (isValid) {
        this.submit();
      }
    });
  </script>
</body>
</html>