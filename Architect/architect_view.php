<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once("../dboperation.php");
$obj = new dboperation();

$current_arch_id = $_SESSION['architect_id'];

$sql = "SELECT * 
        FROM tbl_previous_works 
        WHERE architect_id = '$current_arch_id' 
        ORDER BY created_at DESC";

$res = $obj->executequery($sql);
?>


<?php include("header.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    box-shadow: 0 12px 20px rgba(255, 255, 255, 0.3);
  }

  .delete-btn {
    display: inline-block;
    padding: 10px 25px;
    font-size: 0.9rem;
    font-weight: 600;
    color: #fff;
    background: linear-gradient(135deg, #ff6b6b 0%, #c0392b 100%);
    border: none;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    position: relative;
    overflow: hidden;
  }

.delete-btn::after {
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

.delete-btn:hover::after {
    left: 125%;
  }

.delete-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 20px rgba(255, 0, 0, 0.3);
  }
  </style>

<!-- Page Header -->
<div class="container-fluid page-header py-5 mb-5">
  <div class="container py-5">
    <h1 class="display-1 text-white">Uploaded Works</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb text-uppercase mb-0">
        <li class="breadcrumb-item"><a class="text-white" href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item text-primary active" aria-current="page">Uploaded Works</li>
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

            <!-- Right: Buttons -->
<div class="col-md-2 d-flex justify-content-center align-items-center gap-2">
  <a href="project_view.php?id=<?php echo $row['prev_work_id']; ?>" 
     class="view-btn">View</a>

  <button data-id="<?php echo $row['prev_work_id']; ?>"
          class="delete-btn">Delete</button>
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


<?php if (isset($_GET['status'])): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      let status = "<?php echo $_GET['status']; ?>";

      if (status === "success") {
        Swal.fire({
          icon: 'success',
          title: 'Project Added!',
          text: 'Project has been successfully added.',
        });
      } else if (status === "error") {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Something went wrong while adding the project.',
        });
      }

      // Remove status from URL
      window.history.replaceState({}, document.title, "architect_view.php");
    });
  </script> 
<?php endif; ?>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const deleteButtons = document.querySelectorAll(".delete-btn");

  deleteButtons.forEach(function (btn) {
    btn.addEventListener("click", function () {
      const work_id = this.getAttribute("data-id");

      Swal.fire({
        title: 'Are you sure?',
        text: "This project will be permanently deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = `project_deleteaction.php?eid=${work_id}`;
        }
      });
    });
  });
});
</script>



<?php include("footer.php"); ?>
