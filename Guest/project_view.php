<?php
include("../dboperation.php");
include("header.php");

$obj = new dboperation();
$id = $_GET['id'];

$sql = "SELECT pw.*, 
               c.category_name, 
               a.arch_name
        FROM tbl_previous_works pw
        LEFT JOIN tbl_category c ON pw.category_id = c.category_id
        LEFT JOIN tbl_architects a ON pw.architect_id = a.architect_id
        WHERE pw.prev_work_id = '$id'";

$res = $obj->executequery($sql);
$project = mysqli_fetch_array($res);
?>

<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
  <div class="container py-5">
    <h1 class="display-1 text-white animated slideInDown"><?php echo ($project['title'] ?: "Untitled Project"); ?></h1>
    <nav aria-label="breadcrumb animated slideInDown">
      <ol class="breadcrumb text-uppercase mb-0">
        <li class="breadcrumb-item"><div class="text-white">Created on <?php echo date('F j, Y', strtotime($project['created_at'])); ?></div></li>
      </ol>
    </nav>
  </div>
</div>

<style>
  /* Lively Project View Design */
  .project-view-container {
    max-width: 900px;
    margin: 0 auto 50px auto;
    background: rgba(255,255,255,0.98);
    border-radius: 26px;
    box-shadow: 0 8px 32px rgba(183,141,101, 0.14), 0 1.5px 4px rgba(183,141,101,0.10);
    padding: 46px 38px 32px 38px;
    transition: all 0.25s;
    border: 2px solid transparent;
  }
  .project-view-container:hover {
    border-image: linear-gradient(90deg, #B78D65, #ffd094 85%);
    border-image-slice: 1;
    box-shadow: 0 16px 54px rgba(183,141,101,0.22), 0 4px 16px rgba(184,143,34,0.09);
  }

  /* Titles */
  .project-view-container h2 {
    color: #B78D65;
    font-weight: 800;
    text-align: center;
    margin-bottom: 30px;
    font-size: 2rem;
    position: relative;
  }
  .project-view-container h2:after {
    content: "";
    width: 64px; height: 4px;
    margin: 20px auto 0 auto;
    display: block;
    border-radius: 2.5px;
    background: linear-gradient(90deg,#fdeab6,#B78D65 70%);
  }

  /* Image gallery */
  .project-images {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 15px;
    margin-bottom: 30px;
  }
  .project-images img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    border-radius: 16px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .project-images img:hover {
    transform: scale(1.05);
    box-shadow: 0 16px 36px rgba(183,141,101,0.22);
  }

  /* Description & Details Cards */
  .card {
    background: rgba(255,255,255,0.97);
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(183,141,101,0.1);
    padding: 25px;
    margin-bottom: 20px;
  }
  .card h4, .card h5 {
    color: #B78D65;
    font-weight: 700;
    margin-bottom: 15px;
  }

  /* Details list */
  .details-list {
    list-style: none;
    padding: 0;
  }
  .details-list li {
    margin-bottom: 10px;
    font-size: 0.95rem;
    color: #333;
  }
  .details-list li strong {
    color: #B78D65;
  }
  /* Responsive */
  @media (max-width: 600px) {
    .project-view-container {
      padding: 20px;
    }
  }
</style>

<div class="project-view-container">
  <h2>Project Details</h2>
  <div class="project-images">
    <?php
    $images = [$project['image1'], $project['image2'], $project['image3']];
    foreach ($images as $img) {
        if ($img) echo '<img src="../uploads/'.$img.'" alt="Project Image">';
    }
    ?>
  </div>

  <div class="card">
    <h4>Description</h4>
    <p><?php echo ($project['descriptions'] ?: "No description available."); ?></p>
  </div>

  <div class="card">
    <h5>Details</h5>
    <ul class="details-list">
      <li><strong>Category:</strong> <?php echo ($project['category_name'] ?: "N/A"); ?></li>
      <li><strong>Location:</strong> <?php echo ($project['project_location'] ?: "N/A"); ?></li>
    </ul>
  </div>

</div>

<?php include("footer.php"); ?>
