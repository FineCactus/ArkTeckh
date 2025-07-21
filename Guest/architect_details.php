<?php include('../Guest/header.php'); ?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
  <div class="container py-5">
    <h1 class="display-1 text-white animated slideInDown">Architect Registration</h1>
    <nav aria-label="breadcrumb animated slideInDown">
      <ol class="breadcrumb text-uppercase mb-0">
        <li class="breadcrumb-item"><a class="text-white" href="../index.php">Home</a></li>
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
          <form action="architect_register_action.php" method="POST" enctype="multipart/form-data">
            <div class="row g-3">

            <!-- District Dropdown -->
              <div class="col-md-6">
                <div class="form-floating">
                  <select class="form-select" name="district_id" id="district_id" required>
                    <option value="" selected disabled>Select District</option>
                    <?php
                      include_once("../dboperation.php");
                      $obj = new dboperation();
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
                <select class="form-select" name="location_id" id="location_id" required>
                <option value="" selected disabled>Select Location</option>
                </select>
                <label for="location_id">Location</label>
                  </div>
                </div>

                <div class="col-md-6">
                <label for="certificate" class="form-label">Certificate (PDF or Image)</label>
                <input type="file" class="form-control" name="certificate" id="certificate">
              </div>

              <div class="col-12">
                <div class="form-floating">
                  <textarea class="form-control" placeholder="Enter profile or bio" id="profile" name="profile" style="height: 100px"></textarea>
                  <label for="profile">Profile / Biography</label>
                </div>
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
