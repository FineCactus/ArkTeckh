<?php
include("header.php");
include_once("../dboperation.php");

$obj = new dboperation();

// Fetch all previous works with category, location, district
$sql = "SELECT pw.*, 
               c.category_name, 
               l.location_name, 
               d.district_name 
        FROM tbl_previous_works pw
        LEFT JOIN tbl_category c ON pw.category_id = c.category_id
        LEFT JOIN tbl_location l ON pw.location_id = l.location_id
        LEFT JOIN tbl_district d ON l.district_id = d.district_id
        ORDER BY pw.created_at DESC";

$res = $obj->executequery($sql);
?>

<style>
    .project-card {
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 15px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.1);
  padding: 15px;
  background: #fff;
}

.project-card .glass {
  position: relative;
  width: 120px;
  height: 120px;
  margin: 10px;
  background: linear-gradient(#fff2, transparent);
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
  border-radius: 10px;
  overflow: hidden;
  transition: 0.3s ease;
  backdrop-filter: blur(10px);
}

.project-card .glass:hover {
  transform: translateY(-5px) scale(1.03);
}

.glass-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 10px;
}

.view-btn {
  display: inline-block;
  padding: 10px 25px;
  font-size: 0.9rem;
  font-weight: 600;
  color: #fff;
  background: linear-gradient(135deg, #d8ad84ff 0%, #B78D65 100%);
  border: none;
  border-radius: 50px;
  text-decoration: none;
  transition: all 0.3s ease;
  box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
  position: relative;
  overflow: hidden;
}

.view-btn::after {
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

.view-btn:hover::after {
  left: 125%;
}

.view-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 20px rgba(0, 0, 0, 0.3);
}


</style>

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
          
          <!-- Left: Up to 3 Images -->
          <div class="col-md-5 d-flex flex-wrap justify-content-center">
            <?php 
              $images = array_filter([$row['image1'] ?? "", $row['image2'] ?? "", $row['image3'] ?? ""]);
              
              if (empty($images)) {
                echo '<img src="https://via.placeholder.com/300x200?text=No+Image" class="glass-img">';
              } else {
                foreach ($images as $img) { ?>
                  <div class="glass" data-text="<?php echo  ($row['title']); ?>">
                    <img src="../uploads/<?php echo  ($img); ?>" 
                         alt="Project Image" class="glass-img">
                  </div>
              <?php }
              }
            ?>
          </div>

          <!-- Middle: Details -->
          <div class="col-md-5 p-4">
            <h4 class="fw-bold mb-2"><?php echo  ($row['title'] ?: "Untitled Project"); ?></h4>
            <p class="mb-1"><strong>Category:</strong> <?php echo  ($row['category_name'] ?? "N/A"); ?></p>
            <p class="mb-1"><strong>District:</strong> <?php echo  ($row['district_name'] ?? "N/A"); ?></p>
            <p class="mb-1"><strong>Location:</strong> <?php echo  ($row['location_name'] ?? "N/A"); ?></p>
            <p class="text-muted small mb-0"><em>Uploaded on: <?php echo date("d M Y", strtotime($row['created_at'])); ?></em></p>
          </div>

          <!-- Right: Button -->
          <div class="col-md-2 text-center">
            <form action="customer_select_work.php" method="POST">
              <input type="hidden" name="prev_work_id" value="<?php echo $row['prev_work_id']; ?>">
              <button type="submit" class="view-btn mt-2">Book Now</button>
            </form>
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

<?php include("footer.php"); ?>
