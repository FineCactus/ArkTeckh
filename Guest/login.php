<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    :root {
      --light-brown: #b78d65;
      --dark-brown: #9c6b42;
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
      background: url('img/house.jpg') no-repeat center center;
      background-size: cover;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      overflow: hidden;
      position: relative;
    }

    /* Animated gradient overlay */
    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background: linear-gradient(
        120deg,
        rgba(183,141,101,0.4),
        rgba(255,255,255,0.25),
        rgba(156,107,66,0.35)
      );
      background-size: 300% 300%;
      animation: gradientMove 8s ease infinite;
      z-index: -2;
      pointer-events: none;
    }

    @keyframes gradientMove {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* Floating glowing orbs */
    .orb {
      position: absolute;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.3);
      box-shadow: 0 0 20px rgba(183,141,101,0.6);
      animation: floatOrb 12s infinite ease-in-out;
      z-index: -1;
    }

    @keyframes floatOrb {
      0% { transform: translateY(0) translateX(0); opacity: 0.6; }
      50% { transform: translateY(-60px) translateX(40px); opacity: 1; }
      100% { transform: translateY(0) translateX(0); opacity: 0.6; }
    }

    .orb:nth-child(1) {
      width: 120px; height: 120px;
      top: 20%; left: 8%;
      animation-duration: 14s;
    }

    .orb:nth-child(2) {
      width: 90px; height: 90px;
      bottom: 18%; right: 12%;
      animation-duration: 11s;
    }

    .orb:nth-child(3) {
      width: 70px; height: 70px;
      top: 65%; left: 28%;
      animation-duration: 16s;
    }

    /* Form box */
    .auth-container {
      background-color: var(--form-bg);
      border-radius: 16px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.35);
      padding: 2.2rem;
      width: 90%;
      max-width: 420px;
      animation: fadeIn 0.8s ease;
      z-index: 10;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .tabs {
      display: flex;
      justify-content: space-around;
      margin-bottom: 1.5rem;
    }

    .tab {
      cursor: pointer;
      padding: 0.6rem 1.2rem;
      font-weight: bold;
      color: var(--text-color);
      border-bottom: 3px solid transparent;
      transition: all 0.3s ease;
    }

    .tab:hover {
      color: var(--dark-brown);
      transform: scale(1.05);
    }

    .tab.active {
      border-color: var(--light-brown);
      color: var(--light-brown);
    }

    form {
      display: none;
      flex-direction: column;
      animation: slideIn 0.5s ease;
    }

    form.active {
      display: flex;
    }

    @keyframes slideIn {
      from { opacity: 0; transform: translateY(15px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .input-group {
      position: relative;
      margin-bottom: 1.2rem;
      cursor: auto;
    }

    .input-group i {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--light-brown);
      font-size: 1rem;
    }

    .input-group input {
      width: 100%;
      padding: 0.8rem 0.8rem 0.8rem 2.5rem;
      border: 1px solid var(--input-border);
      border-radius: 8px;
      font-size: 1rem;
      transition: all 0.3s ease;
    }

    .input-group input:focus {
      border-color: var(--light-brown);
      box-shadow: 0 0 8px rgba(183,141,101,0.4);
      transform: scale(1.02);
      outline: none;
    }

    button {
      background: linear-gradient(135deg, var(--light-brown), var(--dark-brown));
      color: white;
      padding: 0.85rem;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 1rem;
      font-weight: bold;
      letter-spacing: 0.5px;
      transition: all 0.3s ease;
    }

    button:hover {
      background: linear-gradient(135deg, var(--dark-brown), var(--light-brown));
      transform: translateY(-2px);
      box-shadow: 0 6px 15px rgba(183,141,101,0.5);
    }

    .bottom-link {
      text-align: center;
      margin-top: 1.2rem;
      font-size: 0.95rem;
      animation: fadeIn 1s ease;
    }

    .bottom-link a {
      color: var(--light-brown);
      text-decoration: none;
      font-weight: bold;
      transition: color 0.3s;
    }

    .bottom-link a:hover {
      color: var(--dark-brown);
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <!-- Floating glowing orbs -->
  <div class="orb"></div>
  <div class="orb"></div>
  <div class="orb"></div>

  <div class="auth-container">
    <div class="tabs">
      <div class="tab active" id="customer-tab">Customer</div>
      <div class="tab" id="architect-tab">Architect</div>
    </div>

    <!-- Customer Login Form -->
    <form id="customer-form" class="active" action="loginaction.php" method="POST">
      <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" name="user" placeholder="Customer Username" required />
      </div>
      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="pass" placeholder="Password" required />
      </div>
      <button type="submit">Login as Customer</button>
      <div class="bottom-link">
        Don’t have an account? <a href="signup.php">Sign up</a>
      </div>
    </form>

    <!-- Architect Login Form -->
    <form id="architect-form" action="loginaction.php" method="POST">
      <div class="input-group">
        <i class="fas fa-user-tie"></i>
        <input type="text" name="user" placeholder="Architect Username" required />
      </div>
      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="pass" placeholder="Password" required />
      </div>
      <button type="submit">Login as Architect</button>
      <div class="bottom-link">
        Don’t have an account? <a href="architect_login.php">Sign up</a>
      </div>
    </form>
  </div>

  <script>
    const customerTab = document.getElementById('customer-tab');
    const architectTab = document.getElementById('architect-tab');
    const customerForm = document.getElementById('customer-form');
    const architectForm = document.getElementById('architect-form');

    customerTab.addEventListener('click', () => {
      customerTab.classList.add('active');
      architectTab.classList.remove('active');
      customerForm.classList.add('active');
      architectForm.classList.remove('active');
    });

    architectTab.addEventListener('click', () => {
      architectTab.classList.add('active');
      customerTab.classList.remove('active');
      architectForm.classList.add('active');
      customerForm.classList.remove('active');
    });

  </script>

  <?php if (isset($_GET['status'])): ?>
  <script>
    <?php if ($_GET['status'] == 'error'): ?>
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Invalid Username or Password.',
        confirmButtonColor: '#B78D65',
        allowOutsideClick: true,
        allowEscapeKey: true,
        allowEnterKey: true,
        focusConfirm: false 
      });
    <?php endif; ?>
  </script>
<?php endif; ?>

</body>
</html>
