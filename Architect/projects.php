<?php 
include("header.php"); 
include_once("../dboperation.php");
$obj = new dboperation();

$sql="SELECT * FROM tbl_previous_works";
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
  .form-floating textarea,
  .form-floating select {
    border-radius: 13px !important;
    border: 2px solid #eaeaeab5;
    transition: 0.3s;
    background: rgba(255,255,255,0.97);
    font-size: 1.04rem;
  }
  .form-floating input:focus,
  .form-floating textarea:focus,
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
  /* Fancy upload box */
  .upload-box {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 140px;
    border: 2px dashed #B78D65;
    border-radius: 16px;
    background: linear-gradient(135deg, #fffaf3, #fff);
    cursor: pointer;
    text-align: center;
    transition: all 0.3s ease;
    font-weight: 600;
    font-size: 1rem;
    color: #a36f3e;
    position: relative;
    overflow: hidden;
    }
    .upload-box:hover {
    background: #fff6eb;
    box-shadow: 0 0 12px rgba(183,141,101,0.35);
    transform: scale(1.03);
    }

    /* hide the real input */
    .upload-box input[type="file"] {
    display: none;
    }

    .upload-box span {
    pointer-events: none;
    }

    /* preview image */
    .upload-box img {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 16px;
    top: 0;
    left: 0;
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
    <h1 class="display-1 text-white animated slideInDown">Project Hosting</h1>
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
          <h4 class="mb-4">Add New Project</h4>
          <form action="projects1_action.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="prev_work_id" value="<?php echo $display['prev_work_id']; ?>">

            <!-- Project Title -->
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="project_title" name="project_title" placeholder="Enter project title" required>
              <label for="project_title">Project Title</label>
            </div>

            <!-- Project Description -->
            <div class="form-floating mb-3">
              <textarea class="form-control" id="project_description" name="project_description" placeholder="Enter project details" style="height: 120px;" required></textarea>
              <label for="project_description">Description</label>
            </div>

            <!-- Upload Images -->
            <label class="form-label">Upload Images</label>
            <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label class="upload-box">
                <input type="file" name="photo1" accept="image/*" required onchange="previewImage(this)">
                <span>📷 Upload 1</span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="upload-box">
                <input type="file" name="photo2" accept="image/*" required onchange="previewImage(this)">
                <span>📷 Upload 2</span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="upload-box">
                <input type="file" name="photo3" accept="image/*" required onchange="previewImage(this)">
                <span>📷 Upload 3</span>
                </label>
            </div>
            </div>

            <!-- Submit -->
            <div class="col-12 text-center mt-4">
              <button type="submit" class="next-btn" name="submit">Submit Project</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Form End -->

<!-- Script to display the image -->
<script>
function previewImage(input) {
  if (input.files && input.files[0]) {
    let reader = new FileReader();
    reader.onload = function(e) {
      const box = input.closest('.upload-box');
      box.innerHTML = "<img src='" + e.target.result + "' alt='Preview'>";
      box.appendChild(input);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
</script>

<?php include("footer.php"); ?>
