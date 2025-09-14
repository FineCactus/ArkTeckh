<?php
include("../dboperation.php");
include("header.php");

$obj = new dboperation();
$id = $_GET['id'];

// Fetch project
$sql = "SELECT * FROM tbl_previous_works WHERE prev_work_id = '$id'";
$res = $obj->executequery($sql);
$project = mysqli_fetch_array($res);

// Fetch categories
$categories = $obj->executequery("SELECT * FROM tbl_category");

// Update logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $desc  = $_POST['descriptions'];
    $cat   = $_POST['category_id'];
    $loc   = $_POST['project_location'];

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
                      project_location='$loc'
                      $imgSql
                  WHERE prev_work_id = '$id'";

    if ($obj->executequery($updateSql)) {
        echo "<script>window.location='project_view.php?id=$id';</script>";
    } else {
        echo "<script>alert('Error updating project.');</script>";
    }
}
?>

<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
  <div class="container py-5">
    <h1 class="display-1 text-white animated slideInDown"><?php echo ($project['title'] ?: "Untitled Project"); ?></h1>
    <nav aria-label="breadcrumb animated slideInDown">
      <ol class="breadcrumb text-uppercase mb-0">
        <li class="breadcrumb-item">
          <div class="text-white">Last updated on <?php echo date('F j, Y', strtotime($project['created_at'])); ?></div>
        </li>
      </ol>
    </nav>
  </div>
</div>

<style>
/* Lively Add/Edit Form Style */
.bg-light.rounded.p-5.shadow {
    background: rgba(255,255,255,0.98);
    border-radius: 26px;
    box-shadow: 0 8px 32px rgba(183,141,101,0.14), 0 1.5px 4px rgba(183,141,101,0.10);
    padding: 46px 38px 32px 38px;
    transition: all 0.25s;
    border: 2px solid transparent;
    max-width: 900px;
    margin: 0 auto 50px auto;
}
.bg-light.rounded.p-5.shadow:hover {
    border-image: linear-gradient(90deg, #B78D65, #ffd094 85%);
    border-image-slice: 1;
    box-shadow: 0 16px 54px rgba(183,141,101,0.22), 0 4px 16px rgba(184,143,34,0.09);
}

.bg-light.rounded.p-5.shadow h4 {
    font-weight: 800;
    color: #B78D65;
    margin-bottom: 32px;
    font-size: 2rem;
    text-align: center;
    position: relative;
}
.bg-light.rounded.p-5.shadow h4:after {
    content: "";
    width: 64px; height: 4px;
    margin: 20px auto 0 auto;
    display: block;
    border-radius: 2.5px;
    background: linear-gradient(90deg,#fdeab6,#B78D65 70%);
}

.form-floating input, 
.form-floating textarea,
.form-floating select {
    border-radius: 13px !important;
    border: 2px solid #eaeaeab5;
    transition: 0.3s;
    background: rgba(255,255,255,0.97);
    font-size: 1.04rem;
}
.form-floating input:focus,
.form-floating textarea:focus,
.form-floating select:focus {
    border-color: #B78D65;
    box-shadow: 0 0 10px 2px #B78D65a7;
}

.bg-light.rounded.p-5.shadow label {
    color: #a36f3eff;
    font-weight: 500;
}

.upload-box {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 140px;
    border: 2px dashed #B78D65;
    border-radius: 16px;
    background: linear-gradient(135deg, #fffaf3, #fff);
    cursor: pointer;
    text-align: center;
    transition: all 0.3s ease;
    font-weight: 600;
    font-size: 1rem;
    color: #a36f3e;
    position: relative;
    overflow: hidden;
    margin-bottom: 15px;
}
.upload-box:hover {
    background: #fff6eb;
    box-shadow: 0 0 12px rgba(183,141,101,0.35);
    transform: scale(1.03);
}
.upload-box input[type="file"] {
    display: none;
}
.upload-box img {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 16px;
    top: 0;
    left: 0;
}

.next-btn {
    display: inline-block;
    padding: 12px 35px;
    font-size: 1rem;
    font-weight: 700;
    color: #fff;
    background: linear-gradient(135deg, #d8ad84ff 0%, #B78D65 100%);
    border: none;
    border-radius: 50px;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    position: relative;
    overflow: hidden;
    text-align: center;
}
.next-btn::after {
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
.next-btn:hover::after { left: 125%; }
.next-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 20px rgba(255, 255, 255, 0.3);
}

@media (max-width: 768px) {
    .bg-light.rounded.p-5.shadow {
        padding: 30px;
    }
}
</style>

<div class="bg-light rounded p-5 shadow">
  <h4>Edit Project</h4>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-floating mb-3">
      <input type="text" class="form-control" name="title" value="<?php echo($project['title']); ?>" required>
      <label>Title</label>
    </div>

    <div class="form-floating mb-3">
      <select class="form-control" name="category_id" required>
        <?php while($cat = mysqli_fetch_array($categories)) { ?>
          <option value="<?php echo $cat['category_id']; ?>" <?php if($cat['category_id']==$project['category_id']) echo "selected"; ?>>
            <?php echo $cat['category_name']; ?>
          </option>
        <?php } ?>
      </select>
      <label>Category</label>
    </div>

    <div class="form-floating mb-3">
      <textarea class="form-control" name="descriptions" style="height:120px;"><?php echo($project['descriptions']); ?></textarea>
      <label>Description</label>
    </div>

    <div class="form-floating mb-3">
      <input type="text" class="form-control" name="project_location" value="<?php echo($project['project_location']); ?>" required>
      <label>Location</label>
    </div>

    <label class="form-label">Update Images</label>
    <div class="row g-3 mb-3">
      <?php for($i=1;$i<=3;$i++){ ?>
      <div class="col-md-4">
        <label class="upload-box">
          <input type="file" name="image<?php echo $i; ?>" accept="image/*" onchange="previewImage(this)">
          <span>📷 Upload <?php echo $i; ?></span>
          <?php if(!empty($project["image$i"])){ ?>
            <img src="../uploads/<?php echo $project["image$i"]; ?>" alt="Preview">
          <?php } ?>
        </label>
      </div>
      <?php } ?>
    </div>

    <div class="text-center">
      <button type="submit" class="next-btn">Update Project</button>
    </div>
  </form>
</div>

<script>
function previewImage(input){
    if(input.files && input.files[0]){
        let reader = new FileReader();
        reader.onload = function(e){
            const box = input.closest('.upload-box');
            box.innerHTML = "<img src='"+e.target.result+"' alt='Preview'>";
            box.appendChild(input);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<?php include("footer.php"); ?>
