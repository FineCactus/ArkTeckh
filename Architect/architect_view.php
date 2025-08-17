<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once("../dboperation.php");
$obj = new dboperation();

// fetch all previous works
$sql = "SELECT * FROM tbl_previous_works ORDER BY created_at DESC";
$res = $obj->executequery($sql);
?>

<?php include("header.php"); ?>
<link href="css/previousworks.css" rel="stylesheet">

<!-- Page Header -->
<div class="container-fluid page-header py-5 mb-5">
  <div class="container py-5">
    <h1 class="display-1 text-white">Previous Works</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb text-uppercase mb-0">
        <li class="breadcrumb-item"><a class="text-white" href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item text-primary active" aria-current="page">Previous Works</li>
      </ol>
    </nav>
  </div>
</div>

<!-- Projects Section -->
<div class="container my-5">
  <?php if (mysqli_num_rows($res) > 0) { ?>
    <?php while ($row = mysqli_fetch_assoc($res)) { ?>
      
      <div class="project-card mb-5">
        <div class="row align-items-center">
          
          <!-- Left: 3 images -->
          <div class="col-md-5 d-flex flex-wrap justify-content-center">
            <?php 
              $images = [];
              if (!empty($row['image1'])) $images[] = $row['image1'];
              if (!empty($row['image2'])) $images[] = $row['image2'];
              if (!empty($row['image3'])) $images[] = $row['image3'];

              if (count($images) == 0) {
                echo '<img src="https://via.placeholder.com/300x200?text=No+Image" class="glass-img">';
              } else {
                foreach ($images as $img) { ?>
                  <div class="glass" data-text="<?php echo ($row['title']); ?>">
                    <img src="../uploads/<?php echo ($img); ?>" 
                         alt="Project Image" class="glass-img">
                  </div>
              <?php }
              }
            ?>
          </div>

          <!-- Middle: Details -->
          <div class="col-md-5 p-4">
            <h4 class="fw-bold mb-2"><?php echo  ($row['title']); ?></h4>
            <p class="mb-1"><strong>Location:</strong> <?php echo  ($row['location_id']); ?></p>
            <p class="text-muted small mb-0"><em>Uploaded on: <?php echo date("d M Y", strtotime($row['created_at'])); ?></em></p>
          </div>

          <!-- Right: Button -->
          <div class="col-md-2 text-center">
            <button class="btn btn-primary px-4 rounded-pill">View</button>
          </div>
          
        </div>
      </div>

    <?php } ?>
  <?php } else { ?>
    <div class="text-center py-5">
      <h4 class="text-muted">No Previous Works Available</h4>
    </div>
  <?php } ?>
</div>

<?php include("../Guest/footer.php"); ?>
