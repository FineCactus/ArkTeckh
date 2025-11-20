<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

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
    <a href="index.php" class="navbar-brand ms-4 ms-lg-0 d-flex align-items-center">
        <img class="me-2" src="img/icons/icon-1.png" alt="Icon" height="40">
        <h1 class="text-primary m-0" style="color: white;">ArkTech</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="#" class="nav-item nav-link active" id="registerBtn">HOSTING</a>
            <a href="index.php" class="nav-item nav-link">HOME</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">ABOUT</a>
                <div class="dropdown-menu border-0 m-0">
                    <a href="about.php" class="dropdown-item">ABOUT US</a>
                    <a href="project.php" class="dropdown-item">PROJECTS</a>                       
                    <a href="services.php" class="dropdown-item">SERVICES</a>
                </div>
            </div>
            <a href="booking.php" class="nav-item nav-link">BOOKING</a>
            <a href="customer_dashboard.php" class="nav-item nav-link require-login">DASHBOARD</a>
        </div>
        
        <?php if (isset($_SESSION['username'])): ?>
            <div class="dropdown d-none d-lg-block">
                <button class="btn btn-primary dropdown-toggle py-2 px-4" type="button"
                    id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                    style="outline: none; box-shadow: none; border-color: transparent;">
                    <?php echo $_SESSION['username']; ?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="/ArkTech/Guest/profile.php">My Profile</a></li>
                        <li><a class="dropdown-item" href="/ArkTech/Guest/logout.php">Logout</a></li>
                </ul>
            </div>
        <?php else: ?>
            <a href="/ArkTech/Guest/login.php" class="btn btn-primary py-2 px-4 d-none d-lg-block">LOGIN</a>
        <?php endif; ?>
    </div>
</nav>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Check if user is logged in (using PHP session variable)
    var isLoggedIn = <?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>;

    // SweetAlert for REGISTER - require login first
    document.getElementById('registerBtn').addEventListener('click', function (e) {
        e.preventDefault();
        
        if (!isLoggedIn) {
            // User not logged in - show login prompt first
            Swal.fire({
                title: 'Please Login First',
                text: 'You need to login before you can register as an architect',
                icon: 'warning',
                confirmButtonText: 'Go to Login',
                confirmButtonColor: '#B78D65'
            }).then(() => {
                window.location.href = '/ArkTech/Guest/login.php';
            });
        } else {
            // User is logged in - check if they have an architect account
            fetch('check_architect_account.php')
                .then(response => response.json())
                .then(data => {
                    if (data.hasArchAccount) {
                        // User already has architect account - automatically login and redirect
                        window.location.href = 'check_architect_account.php?redirect=true';
                    } else {
                        // User doesn't have architect account - show registration prompt
                        Swal.fire({
                            title: 'Register as an Architect',
                            text: 'You don\'t have an architect account yet. Would you like to register as an architect now?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, Register Now',
                            cancelButtonText: 'No, Cancel',
                            confirmButtonColor: '#B78D65',
                            cancelButtonColor: 'rgba(232, 93, 93, 1)'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'architect_login.php';
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error checking architect account:', error);
                    // Fallback to original behavior
                    Swal.fire({
                        title: 'Do you wish to register as an architect?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, Register',
                        cancelButtonText: 'No, Cancel',
                        confirmButtonColor: '#B78D65',
                        cancelButtonColor: 'rgba(232, 93, 93, 1)'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'architect_login.php';
                        }
                    });
                });
        }
    });

    // Attach SweetAlert for other protected links
    document.querySelectorAll('.require-login').forEach(function (link) {
        link.addEventListener('click', function (e) {
            if (!isLoggedIn) {
                e.preventDefault();
                Swal.fire({
                    title: 'You have to login first',
                    icon: 'warning',
                    confirmButtonText: 'Go to Login',
                    confirmButtonColor: '#B78D65'
                }).then(() => {
                    window.location.href = '/ArkTech/Guest/login.php';
                });
            }
        });
    });
});
</script>
