<?php 
include('../Guest/header.php'); 
 include_once("../dboperation.php");
$obj = new dboperation();
?>

<script src="../jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function () {
    $("#district_id").change(function () {
      var district_id = $(this).val();
      $.ajax({
        url: "getlocation.php",
        method: "POST",
        data: { districtid: district_id },
        success: function (response) {
          $("#location").html(response);
        },
        error: function () {
          $("#location").html("<tr><td colspan='3'>Error loading locations</td></tr>");
        }
      });
    });
  });
</script>

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
  <div class="container py-5">
    <h1 class="display-1 text-white animated slideInDown">Architect Registration</h1>
    <nav aria-label="breadcrumb animated slideInDown">
      <ol class="breadcrumb text-uppercase mb-0">
        <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
        <li class="breadcrumb-item text-primary active" aria-current="page">Register</li>
      </ol>
    </nav>
  </div>
</div>
<!-- Page Header End -->

<!-- Registration Form Start -->
<div class="container-xxl py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10 wow fadeInUp" data-wow-delay="0.2s">
        <div class="bg-light rounded p-5 shadow">
          <h4 class="mb-4 text-center">Create Architect Account</h4>
          <form action="architect_loginaction.php" method="POST" enctype="multipart/form-data">
            <div class="row g-3">

              <div class="col-md-12">
                <div class="form-floating">
                  <input type="text" class="form-control" name="architectname" id="name" placeholder="Full Name" required>
                  <label for="name">Full Name</label>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-floating">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required>
                  <label for="email">Email Address</label>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-floating">
                  <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number" required>
                  <label for="phone">Phone Number</label>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-floating">
                  <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                  <label for="username">Username</label>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-floating">
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                  <label for="password">Password</label>
                </div>
              </div>

            <!-- District Dropdown -->
              <div class="col-md-6">
                <div class="form-floating">
                  <select class="form-select" name="district_id" id="district_id" required>
                    <option value="" selected disabled>Select District</option>
                    <?php
                     
                      $locs = $obj->executequery("SELECT * FROM tbl_district");
                      while ($row = mysqli_fetch_assoc($locs)) {
                      echo "<option value='{$row['district_id']}'>{$row['district_name']}</option>";
                      }
                      ?>
                      </select>
                    <label for="district_id">District</label>
                  </div>
                  </div>

                  <div class="col-md-6">
                <div class="form-floating">
                  <select class="form-select" name="location_id" id="location" required>
                    <option value="" selected disabled>Select Location</option>
                   
                      </select>
                    <label for="location_id">Location</label>
                  </div>
                  </div>

                <div class="col-md-6">
                <label for="profile_pic" class="form-label">Profile Picture</label>
                <input type="file" class="form-control" name="profile_pic" id="profile_pic">
              </div>

              <div class="col-md-6">
                <label for="certificate" class="form-label">Certificate (PDF or Image)</label>
                <input type="file" class="form-control" name="certificate" id="certificate">
              </div>


              <div class="col-12 text-center mt-4">
                <button type="submit" name="submit" class="btn btn-primary px-5 py-3">Register</button>
                <a href="../Guest/login.php" class="btn btn-outline-secondary px-5 py-3 ms-2">Back to Login</a>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Registration Form End -->

<?php include('../Guest/footer.php'); ?>
