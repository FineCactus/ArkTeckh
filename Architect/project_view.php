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


<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <meta charset="UTF-8">
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
    .project-view-page .book-section {
      max-width: 1000px;
      margin: 30px auto 0 auto;
      display: flex;
      justify-content: center;
    }

    /* Book form matches section width, centers content, removes default space */
    .project-view-page .book-form {
      width: 100%;
      max-width: 400px;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* Button takes full form width and inherits style */
    .project-view-page .book-btn {
      display: block;
      width: 100%;
      padding: 16px 0;
      background: #B78D65;
      color: #fff;
      font-size: 1.2rem;
      font-weight: 600;
      border: none;
      border-radius: 10px;
      text-align: center;
      text-decoration: none;
      box-shadow: 0 3px 8px rgba(26,115,232,0.07);
      transition: background 0.2s;
      cursor: pointer;
      max-width: 400px;
    }

    /* Button hover effect */
    .project-view-page .book-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 20px rgba(0, 0, 0, 0.3);
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
          <h5>Details</h5>
            <ul class="details-list">
              <li><strong>Category:</strong> <?php echo ($project['category_name'] ?: "N/A"); ?></li>
              <li><strong>Location:</strong> <?php echo ($project['project_location'] ?: "N/A"); ?></li>
            </ul>
        </div>
      </div>
    </div>
  </div>
<div class="book-section">
  <form action="index.php" method="post" class="book-form">
      <input type="hidden" name="architect_id" value="<?php echo $project['architect_id']; ?>">
      <input type="hidden" name="project_id" value="<?php echo $project['prev_work_id']; ?>">
      <button type="button" class="book-btn" id="editProjectBtn">Update Details</button>
    </form>
</div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const editBtn = document.getElementById("editProjectBtn");

    editBtn.addEventListener("click", function () {
      Swal.fire({
        title: 'Edit Project',
        text: "Do you want to edit this project?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#B78D65',
        cancelButtonColor: '#e28181ff',
        confirmButtonText: 'Yes, edit it!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "edit_project.php?id=<?php echo $project['prev_work_id']; ?>";
        }
      });
    });
  });
</script>

<?php include("footer.php"); ?>
</body>
</html>
