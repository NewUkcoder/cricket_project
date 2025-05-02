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
    .username-suggestions {
        max-height: 150px;
        overflow-y: auto;
        border: 1px solid #ced4da;
        border-radius: 4px;
        background: #fff;
        position: absolute;
        z-index: 1000;
        width: 100%;
        display: none;
    }
    .username-suggestion {
        padding: 8px;
        cursor: pointer;
    }
    .username-suggestion:hover {
        background-color: #f8f9fa;
    }
    .password-requirements {
        font-size: 0.8rem;
        margin-top: 5px;
        color: #6c757d;
    }
    .password-requirements li.valid {
        color: #28a745;
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
      <div class="mb-3 position-relative">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" id="username" placeholder="Enter a unique username" value="<?php echo set_value('username'); ?>" required aria-describedby="usernameHelp">
        <div id="usernameHelp" class="form-text">3-50 characters, letters and numbers only.</div>
        <div class="feedback" id="usernameFeedback"></div>
        <div class="username-suggestions" id="usernameSuggestions"></div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" value="<?php echo set_value('email'); ?>" required aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">This will be used in searching to get records</div>
        <div class="feedback" id="emailFeedback"></div>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="password-container">
          <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required aria-describedby="passwordHelp">
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
        <label for="password_confirm" class="form-label">Confirm Password</label>
        <div class="password-container">
          <input type="password" name="password_confirm" class="form-control" id="password_confirm" placeholder="Confirm your password" required>
          <span class="toggle-password" onclick="togglePassword('password_confirm')">Show</span>
        </div>
        <div class="feedback" id="passwordConfirmFeedback"></div>
      </div>
      <div class="mb-3">
        <label for="security_question1" class="form-label">Security Question 1</label>
        <select name="security_question1" class="form-control" id="security_question1" required>
          <option value="">Select a question</option>
          <option value="What is the name of your first pet?">What is the name of your first pet?</option>
          <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
          <option value="What is the name of your elementary school?">What is the name of your elementary school?</option>
          <option value="What is your favorite color?">What is your favorite color?</option>
        </select>
        <input type="text" name="security_answer1" class="form-control mt-2" id="security_answer1" placeholder="Enter your answer" required>
        <div class="feedback" id="securityAnswer1Feedback"></div>
      </div>
      <div class="mb-3">
        <label for="security_question2" class="form-label">Security Question 2</label>
        <select name="security_question2" class="form-control" id="security_question2" required>
          <option value="">Select a question</option>
          <option value="What is your favorite book?">What is your favorite book?</option>
          <option value="What is the name of your best friend?">What is the name of your best friend?</option>
          <option value="What is your favorite food?">What is your favorite food?</option>
          <option value="What is the name of your first teacher?">What is the name of your first teacher?</option>
        </select>
        <input type="text" name="security_answer2" class="form-control mt-2" id="security_answer2" placeholder="Enter your answer" required>
        <div class="feedback" id="securityAnswer2Feedback"></div>
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" name="agreement" class="form-check-input" id="agreement" required>
        <label class="form-check-label" for="agreement">I agree to the <a href="<?php echo base_url('auth/terms'); ?>" target="_blank">Terms and Conditions</a> and <a href="<?php echo base_url('auth/privacy'); ?>" target="_blank">Privacy Policy</a>.</label>
        <div class="feedback" id="agreementFeedback"></div>
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
    // Add CSRF token to AJAX requests (only for email check)
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

    // Username suggestions
    const usernameInput = document.getElementById('username');
    const usernameSuggestions = document.getElementById('usernameSuggestions');
    
    function generateUsernameSuggestions(input) {
      if (!input) return [];
      const suggestions = [
        input + Math.floor(Math.random() * 1000),
        input + 'User' + Math.floor(Math.random() * 100),
        input + 'Fan',
        input + 'Pro' + Math.floor(Math.random() * 100),
        input + 'Star',
        input + 'Guru',
        input + '_' + Math.floor(Math.random() * 100)
      ];
      return suggestions;
    }

    usernameInput.addEventListener('input', function() {
      const value = this.value.trim();
      usernameSuggestions.innerHTML = '';
      if (value.length >= 2) {
        const suggestions = generateUsernameSuggestions(value);
        suggestions.forEach(suggestion => {
          const div = document.createElement('div');
          div.className = 'username-suggestion';
          div.textContent = suggestion;
          div.onclick = function() {
            usernameInput.value = suggestion;
            usernameSuggestions.style.display = 'none';
            validateUsername(suggestion);
          };
          usernameSuggestions.appendChild(div);
        });
        usernameSuggestions.style.display = 'block';
      } else {
        usernameSuggestions.style.display = 'none';
      }
      validateUsername(value);
    });

    document.addEventListener('click', function(e) {
      if (!usernameSuggestions.contains(e.target) && e.target !== usernameInput) {
        usernameSuggestions.style.display = 'none';
      }
    });

    // Real-time username format validation (no AJAX)
    function validateUsername(value) {
      const feedback = document.getElementById('usernameFeedback');
      const regex = /^[a-zA-Z0-9]{3,50}$/;
      if (!value) {
        feedback.className = 'feedback neutral';
        feedback.textContent = 'Please enter a username.';
      } else if (!regex.test(value)) {
        feedback.className = 'feedback invalid';
        feedback.textContent = 'Username must be 3-50 characters, letters and numbers only.';
      } else {
        feedback.className = 'feedback valid';
        feedback.textContent = 'Username format is valid!';
      }
    }

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
        $.ajax({
          url: '<?php echo base_url('auth/check_email'); ?>',
          type: 'POST',
          data: { email: value },
          dataType: 'json',
          success: function(response) {
            if (response.exists) {
              feedback.className = 'feedback invalid';
              feedback.textContent = 'This email is already registered.';
            } else {
              feedback.className = 'feedback valid';
              feedback.textContent = 'Email looks good!';
            }
            // Update CSRF token if regenerated
            if (response.csrf_token) {
              $.ajaxSetup({ data: { '<?php echo $this->security->get_csrf_token_name(); ?>': response.csrf_token } });
            }
          },
          error: function(xhr, status, error) {
            console.error('Check email error:', xhr, status, error);
            feedback.className = 'feedback invalid';
            feedback.textContent = 'Error checking email. Please try again.';
          }
        });
      }
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
    document.getElementById('password_confirm').addEventListener('input', function() {
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

    // Real-time security question validation
    function validateSecurityQuestion(questionId, answerId, feedbackId) {
      const question = document.getElementById(questionId);
      const answer = document.getElementById(answerId);
      const feedback = document.getElementById(feedbackId);
      const otherQuestion = questionId === 'security_question1' ? document.getElementById('security_question2') : document.getElementById('security_question1');

      if (!question.value) {
        feedback.className = 'feedback neutral';
        feedback.textContent = 'Please select a question.';
      } else if (question.value === otherQuestion.value) {
        feedback.className = 'feedback invalid';
        feedback.textContent = 'Please select different questions.';
      } else if (!answer.value) {
        feedback.className = 'feedback neutral';
        feedback.textContent = 'Please enter an answer.';
      } else if (answer.value.length < 2) {
        feedback.className = 'feedback invalid';
        feedback.textContent = 'Answer must be at least 2 characters.';
      } else {
        feedback.className = 'feedback valid';
        feedback.textContent = 'Looks good!';
      }
    }

    ['security_question1', 'security_question2'].forEach(id => {
      document.getElementById(id).addEventListener('change', function() {
        validateSecurityQuestion('security_question1', 'security_answer1', 'securityAnswer1Feedback');
        validateSecurityQuestion('security_question2', 'security_answer2', 'securityAnswer2Feedback');
      });
    });

    ['security_answer1', 'security_answer2'].forEach(id => {
      document.getElementById(id).addEventListener('input', function() {
        validateSecurityQuestion('security_question1', 'security_answer1', 'securityAnswer1Feedback');
        validateSecurityQuestion('security_question2', 'security_answer2', 'securityAnswer2Feedback');
      });
    });

    // Agreement validation
    document.getElementById('agreement').addEventListener('change', function() {
      const feedback = document.getElementById('agreementFeedback');
      if (!this.checked) {
        feedback.className = 'feedback neutral';
        feedback.textContent = 'Please agree to the terms.';
      } else {
        feedback.className = 'feedback valid';
        feedback.textContent = 'Thank you for agreeing!';
      }
    });

    // Form submission
    document.getElementById('signup-form').addEventListener('submit', function(e) {
      e.preventDefault();
      let isValid = true;

      // Username
      const username = document.getElementById('username');
      const usernameRegex = /^[a-zA-Z0-9]{3,50}$/;
      if (!usernameRegex.test(username.value.trim())) {
        document.getElementById('usernameFeedback').className = 'feedback invalid';
        document.getElementById('usernameFeedback').textContent = 'Username must be 3-50 characters, letters and numbers only.';
        isValid = false;
      }

      // Email
      const email = document.getElementById('email');
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email.value)) {
        document.getElementById('emailFeedback').className = 'feedback invalid';
        document.getElementById('emailFeedback').textContent = 'Please enter a valid email address.';
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
      const passwordConfirm = document.getElementById('password_confirm');
      if (password.value !== passwordConfirm.value) {
        document.getElementById('passwordConfirmFeedback').className = 'feedback invalid';
        document.getElementById('passwordConfirmFeedback').textContent = 'Passwords do not match.';
        isValid = false;
      }

      // Security questions
      const question1 = document.getElementById('security_question1');
      const answer1 = document.getElementById('security_answer1');
      const question2 = document.getElementById('security_question2');
      const answer2 = document.getElementById('security_answer2');

      if (!question1.value || !answer1.value || answer1.value.length < 2) {
        document.getElementById('securityAnswer1Feedback').className = 'feedback invalid';
        document.getElementById('securityAnswer1Feedback').textContent = 'Please select a question and provide a valid answer.';
        isValid = false;
      }

      if (!question2.value || !answer2.value || answer2.value.length < 2 || question1.value === question2.value) {
        document.getElementById('securityAnswer2Feedback').className = 'feedback invalid';
        document.getElementById('securityAnswer2Feedback').textContent = 'Please select a different question and provide a valid answer.';
        isValid = false;
      }

      // Agreement
      const agreement = document.getElementById('agreement');
      if (!agreement.checked) {
        document.getElementById('agreementFeedback').className = 'feedback invalid';
        document.getElementById('agreementFeedback').textContent = 'You must agree to the terms.';
        isValid = false;
      }

      if (isValid) {
        this.submit();
      }
    });
  </script>
</body>
</html>