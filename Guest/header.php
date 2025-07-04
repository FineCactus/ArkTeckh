<!-- THIS IS THE HEADER FILE OF EVERY INDEX FILES -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ArchTech-Architecture Booking</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Teko:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/hosting.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border position-relative text-primary" style="width: 6rem; height: 6rem;" role="status"></div>
        <img class="position-absolute top-50 start-50 translate-middle" src="img/icons/icon-1.png" alt="Icon">
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-dark p-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-3">
                    <a class="text-body px-2" href="tel:+0123456789"><i class="fa fa-phone-alt text-primary me-2"></i>+91 9554785241</a>
                    <a class="text-body px-2" href="mailto:info@example.com"><i class="fa fa-envelope-open text-primary me-2"></i>archtechbooking@gmail.com</a>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center py-3 me-2">
                    <a class="text-body px-2" href="">Terms</a>
                    <a class="text-body px-2" href="">Privacy</a>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn btn-sm-square btn-outline-body me-1" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-sm-square btn-outline-body me-1" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-sm-square btn-outline-body me-0" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="text-primary m-0"><img class="me-3" src="img/icons/icon-1.png" alt="Icon">ArkTech</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="#" class="nav-item nav-link active" onclick="openModal(event)">HOSTING</a>
                <a href="index.php" class="nav-item nav-link">HOME</a>
                <a href="booking.php" class="nav-item nav-link">BOOKING</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">ABOUT</a>
                    <div class="dropdown-menu border-0 m-0">
                        <a href="about.php" class="dropdown-item">ABOUT US</a>
                        <a href="project.php" class="dropdown-item">PROJECTS</a>                       
                        <a href="services.php" class="dropdown-item">SERVICES</a>
                        <a href="contact.php" class="dropdown-item">CONTACT US</a>
                    </div>
                </div>
            </div>
            <a href="/ArkTech/Guest/login.php" class="btn btn-primary py-2 px-4 d-none d-lg-block">LOGIN</a>
        </div>
    </nav>
    <!-- Navbar End -->

    <!--HOSTING BUTTON -->

<!-- Popup Modal -->
<!-- Popup Modal -->
<div id="fieldModal" class="modal-overlay">
  <div class="modal-box">
    <!-- Close Button at Top-Right -->
    <button class="close-btn" onclick="closeModal()">×</button>

    <h4>Specify your work fields</h4>
    <div class="field-grid">
      <div class="field-option" onclick="toggleSelection(this)">
        <img src="img/service-1.jpg" alt="Architecture">
        <span>Architecture</span>
      </div>
      <div class="field-option" onclick="toggleSelection(this)">
        <img src="img/service-2.jpg" alt="Landscape Design">
        <span>Landscape Design</span>
      </div>
      <div class="field-option" onclick="toggleSelection(this)">
        <img src="img/service-3.jpg" alt="House Planning">
        <span>House Planning</span>
      </div>
      <div class="field-option" onclick="toggleSelection(this)">
        <img src="img/service-4.jpg" alt="Interior Design">
        <span>Interior Design</span>
      </div>
      <div class="field-option" onclick="toggleSelection(this)">
        <img src="img/service-5.jpg" alt="Renovation">
        <span>Renovation</span>
      </div>
    </div>
    <div class="modal-actions">
      <button class="btn" style="background-color: #B78D65; color: white;">Confirm</button>
    </div>
  </div>
</div>




<!-- SCRIPT FOR HOST FEATURE -->
 
<script>
function openModal(event) {
  event.preventDefault(); // Prevents page reload
  document.getElementById('fieldModal').style.display = 'flex';
}


  function closeModal() {
    document.getElementById('fieldModal').style.display = 'none';
  }

  function toggleSelection(element) {
    element.classList.toggle('selected');
  }
</script>

