<?php

session_start();

// previous_works.php
include("header.php");
include_once("../dboperation.php");

$obj = new dboperation();

// --- Category filter (sanitize)
$category = (isset($_GET['category']) && $_GET['category'] !== '') ? (int) $_GET['category'] : '';

// --- Fetch categories for the dropdown
$catSql = "SELECT * FROM tbl_category ORDER BY category_name ASC";
$catRes = $obj->executequery($catSql);

// --- Main query (apply category filter if set)
$sql = "SELECT pw.*, c.category_name
        FROM tbl_previous_works pw
        LEFT JOIN tbl_category c ON pw.category_id = c.category_id";

if ($category !== '') {
    $sql .= " WHERE pw.category_id = {$category}";
}

$sql .= " ORDER BY pw.created_at DESC";
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
  .filter-bar {
  background: #fff;
  border-radius: 15px;
  padding: 15px 20px;
  }

  .fancy-select,
  .fancy-input {
    border-radius: 50px;
    border: 1px solid #ddd;
    padding: 10px 20px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
  }

  .fancy-select:focus,
  .fancy-input:focus {
    border-color: #B78D65;
    box-shadow: 0 0 10px rgba(183,141,101,0.3);
  }

  .search-wrapper {
    position: relative;
  }
</style>

<!-- Page Header -->
<div class="container-fluid page-header py-5 mb-5">
  <div class="container py-5">
    <h1 class="display-1 text-white">Previous Works</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb text-uppercase mb-0">
        <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
        <li class="breadcrumb-item text-primary active" aria-current="page">Previous Works</li>
      </ol>
    </nav>
  </div>
</div>

<!-- Category Dropdown -->
<div class="container mb-5">
  <form method="get" class="row g-3 justify-content-left align-items-center filter-bar">    
    <div class="col-md-4">
      <select name="category" class="form-select fancy-select" onchange="this.form.submit()">
        <option value="">All Categories</option>
        <?php
        if ($catRes && mysqli_num_rows($catRes)) {
            while ($cat = mysqli_fetch_assoc($catRes)) {
                $selected = ($category == $cat['category_id']) ? 'selected' : '';
                echo "<option value='{$cat['category_id']}' $selected>".($cat['category_name'])."</option>";
            }
        } else {
            echo "<option value=''>No categories</option>";
        }
        ?>
      </select>
    </div>
  </form>
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
            <h4 class="fw-bold mb-2"><?php echo  ($row['title'] ?: "Untitled Project"); ?></h4>
            <p class="mb-1"><strong>Category:</strong> <?php echo  ($row['category_name']); ?></p>
            <p class="mb-1"><strong>Location:</strong> <?php echo ($row['project_location']); ?></p>
            <p class="text-muted small mb-0"><em>Uploaded on: <?php echo date("d M Y", strtotime($row['created_at'])); ?></em></p>
          </div>

          <!-- Right: Redirect Button -->
        <div class="col-md-2 text-center">
          <?php if (isset($_SESSION['customer_id']) || isset($_SESSION['arch_id']) || isset($_SESSION['admin_id'])) { ?>
              <a href="project_view.php?id=<?php echo $row['prev_work_id']; ?>" 
                class="view-btn mt-2">View More</a>
          <?php } else { ?>
              <button type="button" class="view-btn mt-2" onclick="loginAlert()">View More</button>
          <?php } ?>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function loginAlert() {
    Swal.fire({
        icon: 'warning',
        title: 'Login Required',
        text: 'Please login to view project details!',
        confirmButtonText: 'Go to Login',
        confirmButtonColor: '#B78D65'
    }).then(() => {
        window.location.href = 'login.php';
    });
}
</script>


<?php include("footer.php"); ?>
