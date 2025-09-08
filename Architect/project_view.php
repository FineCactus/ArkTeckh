<?php
include("../dboperation.php");
include("header.php");

$obj = new dboperation();
$id = $_GET['id'];

$sql = "SELECT pw.*, 
               c.category_name, 
               l.location_name, 
               a.arch_name
        FROM tbl_previous_works pw
        LEFT JOIN tbl_category c ON pw.category_id = c.category_id
        LEFT JOIN tbl_location l ON pw.location_id = l.location_id
        LEFT JOIN tbl_architects a ON pw.architect_id = a.architect_id
        WHERE pw.prev_work_id = '$id'";

$res = $obj->executequery($sql);
$project = mysqli_fetch_array($res);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo ($project['title']); ?> | Project View</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    /* Scoped under .project-view-page to avoid affecting header/footer */
    .project-view-page {
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      background: #f5f7fa;
      color: #333;
      padding: 30px 0;
    }

    .project-view-page .container {
      max-width: 1000px;
      margin: auto;
      background: #fff;
      padding: 25px;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    }

    .project-view-page .project-title {
      font-size: 2rem;
      font-weight: 600;
      margin-bottom: 10px;
      color: #2c3e50;
    }

    .project-view-page .project-date {
      color: #777;
      font-size: 0.9rem;
      margin-bottom: 25px;
    }

    /* Image gallery */
    .project-view-page .img-row {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 15px;
      margin-bottom: 30px;
    }

    .project-view-page .img-col img {
      width: 100%;
      height: 220px;
      object-fit: cover;
      border-radius: 12px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .project-view-page .img-col img:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 15px rgba(0,0,0,0.2);
    }

    /* Content area */
    .project-view-page .row {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }

    .project-view-page .col-8 {
      flex: 2;
      min-width: 300px;
    }

    .project-view-page .col-4 {
      flex: 1;
      min-width: 250px;
    }

    .project-view-page .description-card,
    .project-view-page .details-card {
      background: #fdfdfd;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.08);
    }

    .project-view-page .description-card h4 {
      margin-bottom: 15px;
    }

    .project-view-page .details-card h5 {
      margin-bottom: 15px;
    }

    .project-view-page .details-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .project-view-page .details-list li {
      margin-bottom: 10px;
      font-size: 0.95rem;
    }

    .project-view-page .details-list strong {
      color: #34495e;
    }
  </style>
</head>
<body>

<div class="project-view-page">
  <div class="container">
    <h1 class="project-title"><?php echo ($project['title'] ?: "Untitled Project"); ?></h1>
    <div class="project-date">Created on <?php echo date('F j, Y', strtotime($project['created_at'])); ?></div>

    <!-- Image Gallery -->
    <div class="img-row">
      <?php
        $images = [$project['image1'], $project['image2'], $project['image3']];
        foreach ($images as $idx => $img) {
          if($img) {
            echo '<div class="img-col">
                    <img src="../uploads/'.$img.'" alt="Project Image">
                  </div>';
          }
        }
      ?>
    </div>

    <div class="row">
      <div class="col-8">
        <div class="description-card">
          <h4>Description</h4>
          <p><?php echo ($project['descriptions'] ?: "No description available."); ?></p>
        </div>
      </div>
      <div class="col-4">
        <div class="details-card">
          <h5>Project Details</h5>
<ul class="details-list">
  <li><strong>Category:</strong> <?php echo ($project['category_name'] ?: "N/A"); ?></li>
  <li><strong>Location:</strong> <?php echo ($project['location_name'] ?: "N/A"); ?></li>
  <li><strong>Created:</strong> <?php echo date('F j, Y', strtotime($project['created_at'])); ?></li>
</ul>

        </div>
      </div>
    </div>
  </div>
</div>

<?php include("footer.php"); ?>
</body>
</html>
