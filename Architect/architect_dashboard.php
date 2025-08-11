<?php include("../Guest/header.php"); ?>

<link rel="stylesheet" href="style.css">

<div class="dashboard-container">
  <!-- Sidebar -->
  <div class="sidebar">
    <ul>
      <li><i class="fas fa-home"></i> Dashboard</li>
      <li><i class="fas fa-clipboard-list"></i> Projects</li>
      <li><i class="fas fa-user"></i> Profile</li>
      <li onclick="logoutConfirm()"><i class="fas fa-sign-out-alt"></i> Logout</li>
    </ul>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <h2 style="margin-bottom: 2rem;">Welcome Architect!</h2>
    <div class="dashboard-boxes">
      <div class="box">
        <i class="fas fa-building"></i>
        <h4>Active Projects</h4>
        <p>5 ongoing</p>
      </div>
      <div class="box">
        <i class="fas fa-check-circle"></i>
        <h4>Completed Projects</h4>
        <p>12 total</p>
      </div>
      <div class="box">
        <i class="fas fa-envelope"></i>
        <h4>Messages</h4>
        <p>3 unread</p>
      </div>
      <div class="box">
        <i class="fas fa-calendar-check"></i>
        <h4>Upcoming Bookings</h4>
        <p>2 this week</p>
      </div>
    </div>
  </div>
</div>

<script>
  function logoutConfirm() {
    if (confirm("Are you sure you want to logout?")) {
      window.location.href = "logout.php";
    }
  }
</script>

<?php include("../Guest/footer.php"); ?>
