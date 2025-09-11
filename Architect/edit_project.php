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
      margin: 0;
      padding: 0;
      font-family: "Segoe UI", Tahoma, sans-serif;
      background: linear-gradient(135deg, #f9f9f9, #e8e4dd);
      overflow-x: hidden;
    }
    .edit-page {
      padding: 50px 20px;
      position: relative;
    }

    /* floating background circle */
    .edit-page::before {
      content: "";
      position: absolute;
      width: 400px;
      height: 400px;
      border-radius: 50%;
      background: radial-gradient(circle at center, rgba(183,141,101,0.3), transparent 70%);
      top: -150px;
      right: -100px;
      z-index: 0;
    }

    .form-container {
      position: relative;
      z-index: 1;
      max-width: 850px;
      margin: auto;
      background: #fff;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }
    .form-container h2 {
      margin-bottom: 30px;
      font-size: 2rem;
      font-weight: 700;
      color: #2c3e50;
      text-align: center;
      letter-spacing: 0.5px;
    }
    .form-container h2::after {
      content: "";
      display: block;
      width: 60px;
      height: 4px;
      background: #B78D65;
      margin: 12px auto 0;
      border-radius: 3px;
    }

    .form-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 22px;
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
      font-size: 0.95rem;
    }
    input, select, textarea {
      padding: 13px 15px;
      border-radius: 10px;
      border: 1px solid #ccc;
      font-size: 1rem;
      transition: all 0.3s ease;
      background: #fafafa;
    }
    input:focus, select:focus, textarea:focus {
      border-color: #B78D65;
      background: #fff;
      box-shadow: 0 0 0 4px rgba(183,141,101,0.15);
      outline: none;
    }
    textarea {
      resize: vertical;
      min-height: 140px;
    }
    .file-inputs {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    /* Preview styles */
    .preview {
      margin-top: 10px;
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
    }
    .preview img {
      width: 100px;
      height: 80px;
      object-fit: cover;
      border-radius: 10px;
      border: 2px solid #eee;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      transition: 0.3s;
    }
    .preview img:hover {
      transform: scale(1.05);
    }

    button {
      width: 100%;
      padding: 15px;
      border: none;
      border-radius: 12px;
      background: linear-gradient(135deg, #B78D65, #9e734a);
      color: white;
      font-size: 1.15rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      grid-column: span 2;
      box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    }
    button:hover {
      transform: translateY(-3px);
      background: linear-gradient(135deg, #9e734a, #B78D65);
      box-shadow: 0 8px 20px rgba(0,0,0,0.25);
    }

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
        <input type="file" name="image1" accept="image/*" onchange="previewImage(this,1)">
        <input type="file" name="image2" accept="image/*" onchange="previewImage(this,2)">
        <input type="file" name="image3" accept="image/*" onchange="previewImage(this,3)">
        <div class="preview" id="preview"></div>
      </div>

      <button type="submit"> Update Project</button>
    </form>
  </div>
</div>

<script>
  function previewImage(input, index) {
    const preview = document.getElementById("preview");
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        let img = document.getElementById("imgPreview" + index);
        if (!img) {
          img = document.createElement("img");
          img.id = "imgPreview" + index;
          preview.appendChild(img);
        }
        img.src = e.target.result;
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
</body>
</html>

<?php include("footer.php"); ?>
