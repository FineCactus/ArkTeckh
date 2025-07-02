
<?php include('header.php');?>

<!-- POPUP BOX -->

<?php if (isset($_GET['status'])): ?>
  <?php
    $status = $_GET['status'];
    $message = '';
    $image = '';

    if ($status == 'success') {
      $message = 'Data Added Successfully!';
      $image = 'img/tick.png';
    } elseif ($status == 'exist') {
      $message = 'Data Already Exists!';
      $image = 'img/error.png';
    } elseif ($status == 'error') {
      $message = 'Something Went Wrong!';
      $image = 'img/fail.png';
    } elseif ($status == 'empty') {
      $message = 'Please Enter a valid data!';
      $image = 'img/fail.png';
    }
  ?>
  <div class="popup" id="popup">
    <img src="<?php echo $image; ?>" alt="Status Icon" />
    <h5><?php echo $message; ?></h5>
    <button onclick="closePopup()">OK</button>
  </div>

  <script>
    function closePopup() {
      document.getElementById("popup").style.display = "none";
      window.history.replaceState({}, document.title, "district.php");
    }
  </script>

  <style>
    .popup {
      width: 400px;
      align-items: center;
      background: #ddd9d9;
      border-radius: 6px;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) scale(0.5);
      opacity: 0;
      text-align: center;
      padding: 0 30px 30px;
      animation: popupShow 0.4s ease forwards;
      z-index: 9999;
    }

    @keyframes popupShow {
      to {
        transform: translate(-50%, -50%) scale(1);
        opacity: 1;
      }
    }

    .popup img {
      width: 100px;
      margin-top: -50px;
      border-radius: 50%;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .popup h5 {
      font-size: 20px;
      font-weight: 400;
      margin: 30px 0 10px;
    }

    .popup button {
      width: 100%;
      margin-top: 20px;
      padding: 5px 0;
      background:rgb(1, 45, 106);
      color: #fff;
      border: 0;
      outline: none;
      font-size: 18px;
      border-radius: 4px;
      cursor: pointer;
      box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
    }
  </style>
<?php endif; ?>


<form action="categoryaction.php" method="POST" enctype="multipart/form-data">

<div class="container" >
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">Forms</h3>
              <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                  <a href="#">
                    <i class="icon-home"></i>
                  </a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Forms</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Basic Form</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Category</div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="email2">Name</label>
                          <input
                            type="text"
                            class="form-control"
                            name="catname"
                            placeholder="Enter Your Name"
                          />
                          </div>
                          <div class="form-group">
                          <label for="email2">Image</label>
                          <input
                            type="file"
                            class="form-control"
                            name="photo"
                          />
                        </div><br>
                    <button class="btn btn-success" type="submit" name="submit">Submit</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
</form>

<!-- FORM ending -->

<!-- Footer -->

<?php include("footer.php"); ?>