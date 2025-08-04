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
  <style>
    :root {
      --light-brown: #B78D65;
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
    }

    .tabs {
      display: flex;
      justify-content: space-around;
      margin-bottom: 1.5rem;
    }

    .tab {
      cursor: pointer;
      padding: 0.5rem 1rem;
      font-weight: bold;
      color: var(--text-color);
      border-bottom: 3px solid transparent;
    }

    .tab.active {
      border-color: var(--light-brown);
      color: var(--light-brown);
    }

    form {
      display: none;
      flex-direction: column;
    }

    form.active {
      display: flex;
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
  </style>
</head>
<body>

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
        Don't have an account? <a href="signup.php">Sign up</a>
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
        Don't have an account? <a href="architect_login.php">Sign up</a>
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

</body>
</html>
