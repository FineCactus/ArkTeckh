<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("header.php");
include_once("../dboperation.php");
$obj = new dboperation();

$sql="SELECT * FROM tbl_architects";
$res=$obj->executequery($sql);
$display=mysqli_fetch_array($res);
?>

<style>
  /* Scoped Form Box (same lively design) */
  .bg-light.rounded.p-5.shadow {
    background: rgba(255,255,255,0.98);
    border-radius: 26px;
    box-shadow: 0 8px 32px rgba(183,141,101, 0.14), 0 1.5px 4px rgba(183,141,101,0.10);
    padding: 46px 38px 32px 38px;
    transition: all 0.25s;
    border: 2px solid transparent;
  }
  .bg-light.rounded.p-5.shadow:hover {
    border-image: linear-gradient(90deg, #B78D65, #ffd094 85%);
    border-image-slice: 1;
    box-shadow: 0 16px 54px rgba(183,141,101,0.22), 0 4px 16px rgba(184,143,34,0.09);
  }

  /* Floating inputs */
  .form-floating input, 
  .form-floating select {
    border-radius: 13px !important;
    border: 2px solid #eaeaeab5;
    transition: 0.3s;
    background: rgba(255,255,255,0.97);
    font-size: 1.04rem;
  }
  .form-floating input:focus, 
  .form-floating select:focus {
    border-color: #B78D65;
    box-shadow: 0 0 10px 2px #B78D65a7;
  }

  /* Labels */
  .bg-light.rounded.p-5.shadow .form-floating label,
  .bg-light.rounded.p-5.shadow label.form-label {
    color: #a36f3eff;
    font-weight: 500;
    font-size: 1rem;
  }

  /* Title */
  .bg-light.rounded.p-5.shadow h4 {
    font-weight: 800;
    color: #B78D65;
    margin-bottom: 32px;
    font-size: 2rem;
    text-align: center;
    position: relative;
  }
  .bg-light.rounded.p-5.shadow h4:after {
    content: "";
    width: 64px; height: 4px;
    margin: 20px auto 0 auto;
    display: block;
    border-radius: 2.5px;
    background: linear-gradient(90deg,#fdeab6,#B78D65 70%);
  }

  /* Buttons */
  .bg-light.rounded.p-5.shadow .btn-primary {
    background: linear-gradient(90deg, #B78D65 80%, #d6ad60 120%);
    border: none;
    border-radius: 30px;
    font-weight: 700;
    font-size: 1.08rem;
    letter-spacing: 0.7px;
    padding: 12px 20px;
    transition: 0.25s;
  }
  .bg-light.rounded.p-5.shadow .btn-primary:hover {
    background: linear-gradient(90deg, #ab763e 50%, #ffc48d 120%);
    transform: translateY(-2px) scale(1.04);
    box-shadow: 0 7px 19px -6px #B78D65b5;
  }

  /* Responsive */
  @media (max-width: 600px) {
    .bg-light.rounded.p-5.shadow {
      padding: 20px;
    }
  }
  .next-btn {
    display: inline-block;
    padding: 12px 35px;
    font-size: 1rem;
    font-weight: 700;
    color: #fff;
    background: linear-gradient(135deg, #d8ad84ff 0%, #B78D65 100%);
    border: none;
    border-radius: 50px;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    position: relative;
    overflow: hidden;
  }

  .next-btn::after {
    content: "";
    position: absolute;
    top: 0;
    left: -75%;
    width: 50%;
    height: 100%;
    background: rgba(255, 255, 255, 0.2);
    transform: skewX(-25deg);
    transition: all 0.5s ease;
  }

  .next-btn:hover::after {
    left: 125%;
  }

  .next-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 20px rgba(255, 255, 255, 0.3);
  }

</style>

<!-- Page Header -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
  <div class="container py-5">
    <h1 class="display-1 text-white animated slideInDown">Select Details</h1>
    <nav aria-label="breadcrumb animated slideInDown">
      <ol class="breadcrumb text-uppercase mb-0">
        <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
        <li class="breadcrumb-item text-primary active" aria-current="page">Hosting</li>
      </ol>
    </nav>
  </div>
</div>

<!-- Form Start -->
<div class="container-xxl py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.2s">
        <div class="bg-light rounded p-5 shadow">
          <h4 class="mb-4">Project Details</h4>
          <form action="get_locationaction.php" method="POST">
            <input type="hidden" name="architect_id" value="<?php echo $display['architect_id']; ?>">
            <div class="row g-3">

              <div class="col-md-12">
                <div class="form-floating">
                  <select class="form-select" name="category_id" id="category_id" required>
                    <option value="" selected disabled>Select Category</option>
                    <?php 
                    $locs = $obj->executequery("SELECT * FROM tbl_category");
                    while ($row = mysqli_fetch_assoc($locs)) {
                      echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
                    }?>
                  </select>
                  <label for="category_id">Category</label>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-floating">
                  <select class="form-select" name="district_id" id="district_id" required>
                    <option value="" selected disabled>Select District</option>
                    <?php 
                    $locs = $obj->executequery("SELECT * FROM tbl_district");
                    while ($row = mysqli_fetch_assoc($locs)) {
                      echo "<option value='{$row['district_id']}'>{$row['district_name']}</option>";
                    }?>
                  </select>
                  <label for="district_id">District</label>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-floating">
                  <input type="text" class="form-control" name="location_id" id="location_id" placeholder="Enter Location" required>
                  <label for="location_id">Location</label>
                </div>
              </div>

              <div class="col-12 text-center mt-4">
                <button type="submit" class="next-btn" name="submit">Next →</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Form End -->

<?php include("footer.php"); ?>
