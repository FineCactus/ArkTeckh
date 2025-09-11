<?php
include("../dboperation.php");
include("header.php");

$obj = new dboperation();
$id = $_GET['id'];

// Fetch project
$sql = "SELECT * FROM tbl_previous_works WHERE prev_work_id = '$id'";
$res = $obj->executequery($sql);
$project = mysqli_fetch_array($res);

// Fetch dropdown data
$categories = $obj->executequery("SELECT * FROM tbl_category");
$locations  = $obj->executequery("SELECT * FROM tbl_location");

// Update logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $desc  = $_POST['descriptions'];
    $cat   = $_POST['category_id'];
    $loc   = $_POST['location_id'];

    // Handle image uploads
    $imgSql = "";
    for ($i=1; $i<=3; $i++) {
        if (!empty($_FILES["image$i"]['name'])) {
            $imgName = time() . "_" . $_FILES["image$i"]["name"];
            move_uploaded_file($_FILES["image$i"]["tmp_name"], "../uploads/" . $imgName);
            $imgSql .= ", image$i = '$imgName'";
        }
    }

    $updateSql = "UPDATE tbl_previous_works 
                  SET title='$title',
                      descriptions='$desc',
                      category_id='$cat',
                      location_id='$loc'
                      $imgSql
                  WHERE prev_work_id = '$id'";

    if ($obj->executequery($updateSql)) {
        echo "<script>alert('Project updated successfully!'); window.location='project_view.php?id=$id';</script>";
    } else {
        echo "<script>alert('Error updating project.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Project - <?php echo $project['title']; ?></title>
  <style>
    body {
      background: #f4f6f9;
      font-family: "Segoe UI", Tahoma, sans-serif;
      margin: 0;
      padding: 0;
    }
    .edit-page {
      padding: 40px 20px;
    }
    .form-container {
      max-width: 800px;
      margin: auto;
      background: #fff;
      padding: 35px;
      border-radius: 16px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }
    .form-container h2 {
      margin-bottom: 25px;
      font-size: 1.8rem;
      font-weight: 600;
      color: #2c3e50;
      text-align: center;
    }

    /* 👇 Added grid layout */
    .form-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 20px;
    }
    .form-group {
      display: flex;
      flex-direction: column;
    }
    .full-width {
      grid-column: span 2;
    }

    label {
      font-weight: 600;
      margin-bottom: 8px;
      color: #444;
    }
    input, select, textarea {
      padding: 12px 14px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 1rem;
      transition: 0.2s;
    }
    input:focus, select:focus, textarea:focus {
      border-color: #2c3e50;
      outline: none;
      box-shadow: 0 0 0 3px rgba(44,62,80,0.1);
    }
    textarea {
      resize: vertical;
      min-height: 120px;
    }
    .file-inputs {
        display: flex;
        flex-direction: column;
        gap: 12px;       /* spacing between file inputs */
    }
    .file-inputs input {
        margin-bottom: 0; /* remove extra margin since gap handles spacing */
    }

    button {
      width: 100%;
      padding: 14px;
      border: none;
      border-radius: 10px;
      background: #B78D65;
      color: white;
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
      grid-column: span 2; /* full width button */
    }
    button:hover {
      background: #B78D65;
      transform: translateY(-2px);
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    /* Responsive stacking */
    @media (max-width: 768px) {
      .form-grid {
        grid-template-columns: 1fr;
      }
      button {
        grid-column: span 1;
      }
    }
  </style>
</head>
<body>
<div class="edit-page">
  <div class="form-container">
    <h2>Edit Project</h2>
    <!-- 👇 Added form-grid -->
    <form action="" method="POST" enctype="multipart/form-data" class="form-grid">
      
      <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" value="<?php echo($project['title']); ?>" required>
      </div>

      <div class="form-group">
        <label>Category</label>
        <select name="category_id" required>
          <?php while($cat = mysqli_fetch_array($categories)) { ?>
            <option value="<?php echo $cat['category_id']; ?>" 
              <?php if($cat['category_id'] == $project['category_id']) echo "selected"; ?>>
              <?php echo $cat['category_name']; ?>
            </option>
          <?php } ?>
        </select>
      </div>

      <div class="form-group full-width">
        <label>Description</label>
        <textarea name="descriptions"><?php echo($project['descriptions']); ?></textarea>
      </div>

      <div class="form-group">
        <label>Location</label>
        <select name="location_id" required>
          <?php while($loc = mysqli_fetch_array($locations)) { ?>
            <option value="<?php echo $loc['location_id']; ?>" 
              <?php if($loc['location_id'] == $project['location_id']) echo "selected"; ?>>
              <?php echo $loc['location_name']; ?>
            </option>
          <?php } ?>
        </select>
      </div>

      <div class="form-group file-inputs full-width">
        <label>Update Images (optional)</label>
        <input type="file" name="image1">
        <input type="file" name="image2">
        <input type="file" name="image3">
        </div>


      <button type="submit">Update Project</button>
    </form>
  </div>
</div>
</body>
</html>

<?php include("footer.php"); ?>
