<?php
include("../dboperation.php");
include("header.php");  // 🔹 Your default header

$obj = new dboperation();

$id = $_GET['id'];
$sql = "SELECT * FROM tbl_previous_works WHERE prev_work_id = '$id'";
$res = $obj->executequery($sql);
$project = mysqli_fetch_array($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo ($project['title']); ?> | Project View</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/project_view.css" rel="stylesheet">
  <style>

  </style>
</head>
<body>

<div class="container py-4" style="max-width:900px;">
  <h1 class="project-title"><?php echo ($project['title'] ?: "Untitled Project"); ?></h1>
  <div class="project-date">Created on <?php echo date('F j, Y', strtotime($project['created_at'])); ?></div>

  <!-- Image Gallery -->
  <div class="img-row mb-4">
    <?php
      $images = [
        $project['image1'],
        $project['image2'],
        $project['image3']
      ];
      foreach ($images as $idx => $img) {
    ?>
      <div class="img-col" data-idx="<?php echo $idx; ?>" tabindex="0" role="button" aria-label="Open image <?php echo $idx+1; ?>">
        <img src="../uploads/<?php echo ($img ?: ''); ?>"
             alt="Project Image"
             >
      </div>
    <?php } ?>
  </div>

  <div class="row">
    <div class="col-lg-8">
      <div class="description-card">
        <h4>Description</h4>
        <p><?php echo ($project['descriptions'] ?: "No description available."); ?></p>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="details-card">
        <h5>Project Details</h5>
        <ul class="details-list">
          <li><strong>Category ID:</strong> <?php echo  ($project['category_id']); ?></li>
          <li><strong>Location ID:</strong> <?php echo  ($project['location_id']); ?></li>
          <li><strong>Architect ID:</strong> <?php echo  ($project['architect_id']); ?></li>
          <li><strong>Created:</strong> <?php echo date('F j, Y', strtotime($project['created_at'])); ?></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap Modal for image viewer -->
<div class="modal fade" id="imgModal" tabindex="-1" aria-hidden="true" aria-labelledby="imgModalLabel" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <button type="button" class="modal-arrow arrow-left" style="display:none" aria-label="Previous image">&#8249;</button>
      <img id="modalImg" src="" alt="Image Preview" class="modal-img">
      <button type="button" class="modal-arrow arrow-right" style="display:none" aria-label="Next image">&#8250;</button>
      <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const images = [
    <?php foreach ($images as $img): ?>
      "<?php echo  ($img ?: ''); ?>",
    <?php endforeach; ?>
  ];

  const modal = new bootstrap.Modal(document.getElementById('imgModal'));
  const modalImg = document.getElementById('modalImg');
  const leftBtn = document.querySelector('.arrow-left');
  const rightBtn = document.querySelector('.arrow-right');

  let current = 0;
  function showImg(idx) {
    current = idx;
    let imgSrc = images[idx] ? "../uploads/" + images[idx] : "https://via.placeholder.com/320x240?text=No+Image";
    modalImg.src = imgSrc;
    leftBtn.style.display = idx > 0 ? 'flex' : 'none';  // Using flex to center arrow content
    rightBtn.style.display = idx < images.length - 1 ? 'flex' : 'none';
    modal.show();
  }

  document.querySelectorAll('.img-col').forEach(function(col) {
    col.addEventListener('click', function() {
      let idx = parseInt(this.getAttribute('data-idx'));
      showImg(idx);
    });
    col.addEventListener('keypress', function(e){
      if(e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        let idx = parseInt(this.getAttribute('data-idx'));
        showImg(idx);
      }
    });
  });

  leftBtn.onclick = function() {
    if(current > 0) showImg(current - 1);
  };
  rightBtn.onclick = function() {
    if(current < images.length - 1) showImg(current + 1);
  };
</script>

<?php include("footer.php"); // 🔹 Your default footer ?>
</body>
</html>
