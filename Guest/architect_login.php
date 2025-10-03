<?php 
include('header.php'); 
include_once("../dboperation.php");
$obj = new dboperation();

// Get logged-in customer details
$customer_data = null;
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT * FROM tbl_customer WHERE username = '$username'";
    $result = $obj->executequery($query);
    if ($result && mysqli_num_rows($result) > 0) {
        $customer_data = mysqli_fetch_assoc($result);
    }
}
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
          $("#location").html("<option>Error loading locations</option>");
        }
      });
    });
  });
</script>

<style>
    /* Modern lively form box styles */
    .bg-light.rounded.p-5.shadow {
      background: rgba(255,255,255,0.98);
      border-radius: 26px;
      box-shadow: 0 8px 32px rgba(183,141,101, 0.14), 0 1.5px 4px rgba(183,141,101,0.10);
      padding: 46px 38px 32px 38px;
      position: relative;
      transition: box-shadow 0.24s, border 0.28s, transform 0.25s cubic-bezier(.42,2,.44,.99);
      border: 2px solid transparent;
    }
    .bg-light.rounded.p-5.shadow:hover {
      border-image: linear-gradient(90deg, #B78D65, #ffd094 85%);
      border-image-slice: 1;
      transform: translateY(-7px) scale(1.012);
      box-shadow: 0 16px 54px rgba(183,141,101,0.22), 0 4px 16px rgba(184,143,34,0.09);
    }

    /* Form Inputs */
    .form-floating input, 
    .form-floating select {
      border-radius: 13px !important;
      border: 2px solid #eaeaeab5;
      transition: border-color 0.35s cubic-bezier(.16,.86,.67,.66), box-shadow 0.25s;
      background: rgba(255,255,255,0.97);
      font-size: 1.04rem;
    }
    .form-floating input:focus, 
    .form-floating select:focus {
      border-color: #B78D65;
      box-shadow: 0 0 10px 2px #B78D65a7;
      background: #fff;
    }

    /* Scoped ONLY for labels inside .bg-light.rounded.p-5.shadow */
    .bg-light.rounded.p-5.shadow .form-floating label,
    .bg-light.rounded.p-5.shadow label.form-label {
      color: #a36f3eff;
      font-weight: 500;
      letter-spacing: 0.02em;
      font-size: 1rem;
    }

    /* File input */
    input[type="file"].form-control {
      background: #faf6f3;
      border-radius: 13px;
      border: 2px solid #ece3d3;
      color: #B78D65;
      padding: 10px;
      font-weight: 500;
      margin-bottom: 4px;
    }

    /* Readonly input styling */
    .form-floating input[readonly], 
    .form-floating select[readonly] {
      background: #f8f9fa !important;
      border-color: #e0e0e0 !important;
      color: #6c757d !important;
      cursor: not-allowed;
    }
    
    .form-floating input[readonly]:focus, 
    .form-floating select[readonly]:focus {
      background: #f8f9fa !important;
      border-color: #e0e0e0 !important;
      box-shadow: none !important;
    }

    /* Scoped H4 inside form box only */
    .bg-light.rounded.p-5.shadow h4 {
      font-weight: 800;
      color: #B78D65;
      margin-bottom: 32px;
      letter-spacing: .7px;
      font-size: 2.04rem;
      position: relative;
    }
    .bg-light.rounded.p-5.shadow h4:after {
      display: block;
      content: "";
      width: 64px; height: 4px;
      margin: 20px auto 0 auto;
      border-radius: 2.5px;
      background: linear-gradient(90deg,#fdeab6,#B78D65 70%);
    }

    /* Scoped Buttons inside form box only */
    .bg-light.rounded.p-5.shadow .btn-primary {
      background: linear-gradient(90deg, #B78D65 80%, #d6ad60 120%);
      border: none;
      border-radius: 30px;
      font-weight: 700;
      font-size: 1.08rem;
      letter-spacing: 0.7px;
      box-shadow: 0 4px 15px -7px #B78D65a2;
      position: relative;
      overflow: hidden;
      transition: background 0.22s, box-shadow 0.32s, transform 0.11s;
    }
    .bg-light.rounded.p-5.shadow .btn-primary:hover {
      background: linear-gradient(90deg, #ab763e 50%, #ffc48d 120%);
      transform: translateY(-2px) scale(1.04);
      box-shadow: 0 7px 19px -6px #B78D65b5;
    }

    .bg-light.rounded.p-5.shadow .btn-outline-secondary {
      border: 2px solid #B78D65;
      color: #B78D65;
      border-radius: 30px;
      font-weight: 600;
      transition: all 0.19s;
    }
    .bg-light.rounded.p-5.shadow .btn-outline-secondary:hover,
    .bg-light.rounded.p-5.shadow .btn-outline-secondary:focus {
      background: #B78D65;
      color: #fff;
      transform: scale(1.04);
    }
    /* About Me Textarea */
    .form-floating textarea {
      border-radius: 13px !important;
      border: 2px solid #eaeaeab5;
      transition: border-color 0.35s cubic-bezier(.16,.86,.67,.66), box-shadow 0.25s;
      background: rgba(255,255,255,0.97);
      font-size: 1.04rem;
      resize: none; /* prevents awkward resize handles */
      padding-top: 20px; /* for better spacing inside */
      line-height: 1.5;
    }

    /* Focus Effect */
    .form-floating textarea:focus {
      border-color: #B78D65;
      box-shadow: 0 0 10px 2px #B78D65a7;
      background: #fff;
    }

    /* Label styling (same as inputs but scoped for textarea too) */
    .bg-light.rounded.p-5.shadow .form-floating textarea ~ label {
      color: #a36f3eff;
      font-weight: 500;
      letter-spacing: 0.02em;
      font-size: 1rem;
    }


    /* Responsive adjustment */
    @media (max-width: 600px) {
      .bg-light.rounded.p-5.shadow {
        padding: 18px 5px 18px 5px;
      }
    }

</style>

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
          <?php if ($customer_data): ?>
          <?php else: ?>
            <div class="alert alert-warning text-center mb-3">
              <i class="fas fa-exclamation-triangle me-2"></i>
              Please <a href="login.php" class="text-decoration-none"><strong>login</strong></a> to auto-fill your details, or enter them manually below.
            </div>
          <?php endif; ?>
          <form action="architect_loginaction.php" method="POST" enctype="multipart/form-data">
            <div class="row g-3">

              <!-- Hidden field for customer ID -->
              <?php if ($customer_data): ?>
              <input type="hidden" name="customer_id" value="<?php echo $customer_data['customer_id']; ?>">
              <?php endif; ?>

              <div class="col-md-12">
                <div class="form-floating">
                  <input type="text" class="form-control" name="architectname" id="name" placeholder="Full Name" 
                         value="<?php echo $customer_data ? ($customer_data['cname']) : ''; ?>" 
                         <?php echo $customer_data ? 'readonly' : ''; ?> required>
                  <label for="name">Full Name</label>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-floating">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" 
                         value="<?php echo $customer_data ? ($customer_data['email']) : ''; ?>" 
                         <?php echo $customer_data ? 'readonly' : ''; ?> required>
                  <label for="email">Email Address</label>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-floating">
                  <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number" 
                         value="<?php echo $customer_data ? ($customer_data['phone']) : ''; ?>" 
                         <?php echo $customer_data ? 'readonly' : ''; ?> required>
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

            <!--ABOUT ME-->
            <div class="col-md-12">
              <div class="form-floating">
                <textarea class="form-control" name="about" id="about" placeholder="About Me" style="height: 120px" required></textarea>
                <label for="about">About Me</label>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-floating">
                <input type="text" class="form-control" name="location" id="location" placeholder="Enter Location" 
                       value="<?php echo ($customer_data && $customer_data['locations'] !== '0') ?($customer_data['locations']) : ''; ?>" 
                       <?php echo ($customer_data && $customer_data['locations'] !== '0') ? 'readonly' : ''; ?> required>
                <label for="location">Location</label>
              </div>
            </div>


              <div class="col-md-6">
                <label for="profile_pic" class="form-label">Profile Picture</label>
                <input type="file" class="form-control" name="photo1" id="photo1">
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

<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php if (isset($_GET['status'])): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function (){
      let status = "<?php echo $_GET['status']; ?>";
      if (status === "success") {
        Swal.fire({
          icon: 'success',
          title: 'Registration Successful!',
          text: 'Please wait for admins approval.',
        });
      } else if (status === "exist") {
        Swal.fire({
          icon: 'warning',
          title: 'Already Exists',
          text: 'Username already exists!',
        });
      } else if (status === "already_registered") {
        Swal.fire({
          icon: 'info',
          title: 'Already Registered',
          text: 'You are already registered as an architect!',
          confirmButtonText: 'Go to Login'
        }).then(() => {
          window.location.href = 'login.php';
        });
      } else if (status === "error") {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Something went wrong while registration.',
        });
      }
      window.history.replaceState({}, document.title, "architect_login.php");
    });
  </script>
<?php endif; ?>

<?php include('../Guest/footer.php'); ?>
