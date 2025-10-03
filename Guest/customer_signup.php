<?php 
include_once("../dboperation.php");
$obj = new dboperation();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../jquery-3.6.0.min.js"></script>
  <title>Signup</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="css/signup.css" />
  <style>
    .password-feedback-row {
      display: flex;
      gap: 20px;
      margin-top: -10px;
      margin-bottom: 15px;
    }
    .password-feedback {
      font-size: 12px;
      padding-left: 5px;
      min-height: 16px;
      flex: 1;
    }
    .password-match {
      color: #28a745;
    }
    .password-no-match {
      color: #dc3545;
    }
    .password-input-container {
      position: relative;
    }
  </style>
</head>
<body>

  <div class="orb"></div><div class="orb"></div><div class="orb"></div>
  <div class="auth-container">
    <div class="tabs"><div class="tab">Create Account</div></div>

    <form action="signupaction.php" method="POST" enctype="multipart/form-data">
      <div class="form-row">
        <div class="input-group"><i class="fas fa-user"></i><input type="text" name="customer_name" placeholder="Full Name" required /></div>
        <div class="input-group"><i class="fas fa-home"></i><input type="text" name="address" placeholder="Address" required /></div>
      </div>

      <div class="form-row">
        <div class="input-group"><i class="fas fa-envelope"></i><input type="email" name="email" placeholder="Email" required /></div>
        <div class="input-group"><i class="fas fa-phone"></i><input type="text" name="phone" placeholder="Phone Number" required /></div>
      </div>

      <div class="form-row">
        <div class="input-group"><i class="fas fa-user-circle"></i><input type="text" name="username" placeholder="Username" required /></div>
        <div class="input-group"><i class="fas fa-location-dot"></i><input type="text" name="location" placeholder="Location" required /></div>
      </div>

      <div class="form-row">
        <div class="input-group password-input-container">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" id="password" placeholder="Password (min 6 characters)" minlength="6" required />
        </div>
        <div class="input-group password-input-container">
          <i class="fas fa-lock"></i>
          <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required />
        </div>
      </div>
      <div class="password-feedback-row">
        <div id="password-requirement-message" class="password-feedback"></div>
        <div id="password-match-message" class="password-feedback"></div>
      </div>

        <div class="input-group">
          <i class="fas fa-image"></i>
          <input type="file" name="photo1" id="photo1" class="file-input" required />
        </div>

      <button type="submit" name="submit" value="submit">Register</button>
      <div class="bottom-link">Already have an account? <a href="../Guest/login.php">Login</a></div>
    </form>
  </div>


  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const password = document.getElementById('password');
      const confirmPassword = document.getElementById('confirm_password');
      const form = document.querySelector('form');
      const photo = document.getElementById('photo1');

      // File input handler
      photo.addEventListener('change', function() {
        const label = document.getElementById('fileLabelText');
        if (label) label.textContent = this.files[0]?.name || 'Choose Profile Picture';
      });

      // Show message helper
      function showMessage(element, text, isValid) {
        element.textContent = text;
        element.className = `password-feedback ${isValid ? 'password-match' : 'password-no-match'}`;
      }

      // Password validation
      function validatePasswords() {
        const pwd = password.value;
        const confirmPwd = confirmPassword.value;
        const reqMsg = document.getElementById('password-requirement-message');
        const matchMsg = document.getElementById('password-match-message');

        // Validate password length
        if (pwd.length === 0) {
          reqMsg.textContent = '';
          reqMsg.className = 'password-feedback';
        } else if (pwd.length < 6) {
          showMessage(reqMsg, '⚠ Password must be at least 6 characters', false);
          password.setCustomValidity('Please enter at least 6 characters');
        } else {
          showMessage(reqMsg, '✓ Password meets requirement', true);
          password.setCustomValidity('');
        }

        // Validate password match
        if (confirmPwd.length === 0) {
          matchMsg.textContent = '';
          matchMsg.className = 'password-feedback';
        } else if (pwd === confirmPwd && pwd.length >= 6) {
          showMessage(matchMsg, '✓ Passwords match', true);
          confirmPassword.setCustomValidity('');
        } else {
          showMessage(matchMsg, '✗ Passwords do not match', false);
          confirmPassword.setCustomValidity('Passwords do not match');
        }
      }

      // Event listeners
      password.addEventListener('input', validatePasswords);
      confirmPassword.addEventListener('input', validatePasswords);

      // Form validation
      form.addEventListener('submit', function(e) {
        const pwd = password.value;
        if (pwd.length < 6 || pwd !== confirmPassword.value) {
          e.preventDefault();
          Swal.fire({
            icon: 'warning',
            title: pwd.length < 6 ? 'Invalid Password' : 'Password Mismatch',
            text: pwd.length < 6 ? 'Password must be at least 6 characters' : 'Passwords do not match',
            confirmButtonColor: '#B78D65'
          });
        }
      });
    });
  </script>

  <?php if (isset($_GET['status'])): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const status = "<?php echo $_GET['status']; ?>";
      const messages = {
        success: { icon: 'success', title: 'Registered successfully' },
        exist: { icon: 'warning', title: 'Already Exists', text: 'Username already exists!' },
        empty: { icon: 'info', title: 'Empty Field', text: 'Please enter a username!' },
        error: { icon: 'error', title: 'Error', text: 'Something went wrong while creating profile.' }
      };

      if (messages[status]) {
        Swal.fire({ ...messages[status], confirmButtonColor: '#B78D65' });
      }

      window.history.replaceState({}, document.title, "customer_signup.php");
    });
  </script>
<?php endif; ?>
</body>
</html>
