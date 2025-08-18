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
  <title><?php echo htmlspecialchars($project['title']); ?> | Project View</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      background: #f3f5f7;
      font-family: "Segoe UI", Arial, sans-serif;
      margin: 0;
      color: #373737;
    }
    .project-title {
      font-weight: 700;
      font-size: 2.1rem;
      margin-bottom: 8px;
      color: #2c343b;
    }
    .project-date {
      font-size: 1rem;
      color: #7d7d89;
      margin-bottom: 24px;
    }
    .img-row {
      display: grid;
      grid-template-columns: 2fr 1fr;
      grid-template-rows: repeat(2, 1fr);
      gap: 12px;
      margin-bottom: 32px;
      height: 400px;
    }
    .img-col {
      background: #e3e6ec;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(40,40,60,0.07);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: box-shadow .18s;
      position: relative;
    }
    .img-col img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 12px;
      transition: transform 0.18s;
      display: block;
    }
    .img-col:hover img {
      transform: scale(1.05);
    }
    .img-col:first-child {
      grid-row: span 2;
    }
    .description-card, .details-card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 12px rgba(60,60,80,0.06);
      padding: 28px 20px 22px;
      margin-bottom: 24px;
    }
    .description-card h4 {
      font-weight: 600;
      font-size: 1.2rem;
      margin-bottom: 12px;
      color: #253042;
    }
    .description-card p {
      margin-bottom: 0;
      color: #424f60;
      font-size: 1.06rem;
    }
    .details-card h5 {
      font-weight: 700;
      margin-bottom: 14px;
      color: #35374c;
      font-size: 1rem;
    }
    .details-list {
      list-style: none;
      padding: 0;
      margin-bottom: 0;
      font-size: 1rem;
      color: #485160;
      line-height: 1.7;
    }
    .details-list li {
      margin-bottom: 7px;
    }
    @media (max-width: 700px) {
      .img-row {
        grid-template-columns: 1fr;
        grid-template-rows: auto;
        height: auto;
      }
      .img-col:first-child {
        grid-row: auto;
      }
      .description-card, .details-card {
        padding: 17px 10px 13px;
      }
      .project-title {
        font-size: 1.32rem;
        margin-bottom: 2px;
      }
    }

    /* Modal image responsiveness and button positioning */
    .modal-dialog-centered {
      max-width: 520px;
    }
    .modal-content {
      background: transparent;     /* Remove white background */
      border: none;                /* Remove border */
      position: relative;
      padding: 0;
    }
    .modal-img {
      width: 100%;
      height: auto;
      border-radius: 12px;
      object-fit: contain;
      display: block;
    }
    .modal-arrow {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: rgba(0, 0, 0, 0.5);
      border: none;
      border-radius: 50%;
      font-size: 2.5rem;
      width: 48px;
      height: 48px;
      line-height: 44px;
      color: #fff;
      cursor: pointer;
      user-select: none;
      transition: background-color 0.2s ease;
      z-index: 1050;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0;
    }
    .modal-arrow:hover {
      background: rgba(0, 0, 0, 0.75);
    }
    .arrow-left {
      left: -60px;  /* Positioned outside on left */
      box-shadow: 0 0 8px rgba(0,0,0,0.3);
    }
    .arrow-right {
      right: -60px; /* Positioned outside on right */
      box-shadow: 0 0 8px rgba(0,0,0,0.3);
    }
    .btn-close {
      position: absolute;
      top: 12px;
      right: 12px;
      background: rgba(255, 255, 255, 0.85);
      border-radius: 50%;
      width: 32px;
      height: 32px;
      padding: 0;
      box-shadow: 0 1px 5px rgba(0,0,0,0.15);
      z-index: 1100;
    }
  </style>
</head>
<body>

<div class="container py-4" style="max-width:900px;">
  <h1 class="project-title"><?php echo htmlspecialchars($project['title'] ?: "Untitled Project"); ?></h1>
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
        <img src="../uploads/<?php echo htmlspecialchars($img ?: ''); ?>"
             alt="Project Image"
             onerror="this.onerror=null;this.src='https://via.placeholder.com/320x240?text=No+Image';">
      </div>
    <?php } ?>
  </div>

  <div class="row">
    <div class="col-lg-8">
      <div class="description-card">
        <h4>Description</h4>
        <p><?php echo htmlspecialchars($project['descriptions'] ?: "No description available."); ?></p>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="details-card">
        <h5>Project Details</h5>
        <ul class="details-list">
          <li><strong>Category ID:</strong> <?php echo htmlspecialchars($project['category_id']); ?></li>
          <li><strong>Location ID:</strong> <?php echo htmlspecialchars($project['location_id']); ?></li>
          <li><strong>Architect ID:</strong> <?php echo htmlspecialchars($project['architect_id']); ?></li>
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
      "<?php echo htmlspecialchars($img ?: ''); ?>",
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
