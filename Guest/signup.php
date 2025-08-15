<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Signup</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  />
  <style>
    :root {
      --light-brown: #B78D65;
      --background: #f9f5f1;
      --form-bg: rgba(255, 250, 245, 0.95);
      --text-color: #333;
      --input-border: #d9c1a7;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background: url('img/house.jpg') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background-color: rgba(255, 255, 255, 0.38);
      z-index: -1;
    }

    .auth-container {
      background-color: var(--form-bg);
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.3);
      padding: 2rem;
      width: 90%;
      max-width: 420px;
      transition: all 0.3s ease;
    }

    .tabs {
      display: flex;
      justify-content: space-around;
      margin-bottom: 1.5rem;
    }

    .tab {
      font-weight: bold;
      color: var(--text-color);
    }

    .input-group {
      position: relative;
      margin-bottom: 1.2rem;
    }

    .input-group i {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--light-brown);
    }

    .input-group input {
      width: 100%;
      padding: 0.75rem 0.75rem 0.75rem 2.5rem;
      border: 1px solid var(--input-border);
      border-radius: 6px;
      font-size: 1rem;
    }

    button {
      background-color: var(--light-brown);
      color: white;
      padding: 0.75rem;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 1rem;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #a7764f;
    }

    .bottom-link {
      text-align: center;
      margin-top: 1rem;
      font-size: 0.95rem;
    }

    .bottom-link a {
      color: var(--light-brown);
      text-decoration: none;
      font-weight: bold;
    }

    .bottom-link a:hover {
      text-decoration: underline;
    }

    @media (max-width: 480px) {
      .auth-container {
        padding: 1.5rem;
      }
    }
  </style>
</head>
<body>

  <div class="auth-container">
    <div class="tabs">
      <div class="tab">Signup</div>
    </div>

    <form id="sign-up" action="signupaction.php" method="POST">
      <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" name="username" placeholder="Username" required />
      </div>
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="email" placeholder="Email" required />
      </div>
      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" placeholder="Password" required />
      </div>
      <button type="submit" name="submit">Create Account</button>
      <div class="bottom-link">
        Already have an account? <a href="login.php">Login</a>
      </div>
    </form>
  </div>
</body>

<?php if (isset($_GET['status'])): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      let status = "<?php echo $_GET['status']; ?>";

      if (status === "success") {
        Swal.fire({
          icon: 'success',
          title: 'Registered successfully',
          confirmButtonColor: '#B78D65',
        });
      } else if (status === "exist") {
        Swal.fire({
          icon: 'warning',
          title: 'Already Exists',
          text: 'Username already exists!',
          confirmButtonColor: '#B78D65',
        });
      } else if (status === "empty") {
        Swal.fire({
          icon: 'info',
          title: 'Empty Field',
          text: 'Please enter a username name!',
          confirmButtonColor: '#B78D65',
        });
      } else if (status === "error") {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Something went wrong while creating profile.',
        });
      }

      // Remove status from URL
      window.history.replaceState({}, document.title, "login.php");
    });
  </script>
<?php endif; ?>
</html>
