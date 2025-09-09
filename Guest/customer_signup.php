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
        <div class="input-group"><i class="fas fa-lock"></i><input type="password" name="password" placeholder="Password" required /></div>
      </div>

      <div class="form-row">
        <div class="input-group">
          <i class="fas fa-map"></i>
          <select name="district_id" id="district_id" required>
            <option value="" disabled selected>Select District</option>
            <?php
              $locs = $obj->executequery("SELECT * FROM tbl_district");
              while ($row = mysqli_fetch_assoc($locs)) {
                echo "<option value='{$row['district_id']}'>{$row['district_name']}</option>";
              }
            ?>
          </select>
            </div>
            <div class="input-group"><i class="fas fa-location-dot"></i><input type="text" name="location" placeholder="Location" required /></div>
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
    document.getElementById("photo1").addEventListener("change", function () {
      const fileName = this.files[0] ? this.files[0].name : "Choose Profile Picture";
      document.getElementById("fileLabelText").textContent = fileName;
    });

  </script>

  <?php if (isset($_GET['status'])): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      let status = "<?php echo $_GET['status']; ?>";

      if (status === "success") {
        Swal.fire({
          icon: 'success',
          title: 'Registered successfully',
          confirmButtonColor: '#B78D65',
          allowOutsideClick: true,
          allowEscapeKey: true,
          allowEnterKey: true,
          focusConfirm: false 
        });
      } else if (status === "exist") {
        Swal.fire({
          icon: 'warning',
          title: 'Already Exists',
          text: 'Username already exists!',
          confirmButtonColor: '#B78D65',
          allowOutsideClick: true,
          allowEscapeKey: true,
          allowEnterKey: true,
          focusConfirm: false 
        });
      } else if (status === "empty") {
        Swal.fire({
          icon: 'info',
          title: 'Empty Field',
          text: 'Please enter a username!',
          confirmButtonColor: '#B78D65',
          allowOutsideClick: true,
          allowEscapeKey: true,
          allowEnterKey: true,
          focusConfirm: false 
        });
      } else if (status === "error") {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Something went wrong while creating profile.',
          allowOutsideClick: true,
          allowEscapeKey: true,
          allowEnterKey: true,
          focusConfirm: false 
        });
      }

      // Remove status from URL
      window.history.replaceState({}, document.title, "customer_signup.php");
    });
  </script>
<?php endif; ?>
</body>
</html>
