<?php
include("../dboperation.php");
include("header.php");

$obj = new dboperation();
$id = $_GET['id'];

// Fetch project + category + architect_id
$sql = "SELECT pw.*, c.category_name, a.arch_name, a.architect_id
        FROM tbl_previous_works pw
        LEFT JOIN tbl_category c ON pw.category_id = c.category_id
        LEFT JOIN tbl_architects a ON pw.architect_id = a.architect_id
        WHERE pw.prev_work_id = '$id'";
$res = $obj->executequery($sql);
$project = mysqli_fetch_array($res);

// Fetch architect details separately
$arch_id = $project['architect_id'];
$sql2 = "SELECT * FROM tbl_architects WHERE architect_id = '$arch_id'";
$res2 = $obj->executequery($sql2);
$architect = mysqli_fetch_array($res2);
?>

<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
  <div class="container py-5">
    <h1 class="display-1 text-white animated slideInDown">
      <?php echo ($project['title'] ?: "Untitled Project"); ?>
    </h1>
    <nav aria-label="breadcrumb animated slideInDown">
      <ol class="breadcrumb text-uppercase mb-0">
        <li class="breadcrumb-item">
          <div class="text-white">Posted on <?php echo date('F j, Y', strtotime($project['created_at'])); ?></div>
        </li>
      </ol>
    </nav>
  </div>
</div>

<style>
  .view-architect-container {
    max-width: 1200px;
    margin: 0 auto 50px auto;
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 25px;
    background: rgba(255,255,255,0.98);
    border-radius: 26px;
    box-shadow: 0 8px 32px rgba(183,141,101, 0.14);
    padding: 40px;
  }

  /* Architect Card */
  .left-card {
    background: linear-gradient(145deg, #ffffff, #f7f2ee);
    border-radius: 20px;
    box-shadow: 0 8px 24px rgba(183,141,101,0.18);
    padding: 0;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .left-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 32px rgba(183,141,101,0.28);
  }

  .left-card-header {
    background: linear-gradient(135deg, #d8ad84, #eacbadff);
    padding: 18px;
    text-align: center;
    color: #fff;
  }

  .left-card-header h3 {
    margin: 0;
    font-size: 1.4rem;
    font-weight: 800;
    letter-spacing: 1px;
  }

  .arch-profile {
    padding: 30px 20px;
    text-align: center;
  }

  .arch-profile img {
    width: 140px;
    height: 140px;
    object-fit: cover;
    border-radius: 50%;
    margin-bottom: 15px;
    border: 6px solid #fff;
    box-shadow: 0 6px 16px rgba(0,0,0,0.2);
    transition: transform 0.3s ease;
  }

  .arch-profile img:hover {
    transform: scale(1.08);
  }

  .arch-profile h4 {
    color: #333;
    margin-bottom: 12px;
    font-weight: 700;
  }

  .arch-info {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .arch-info li {
    display: flex;
    align-items: center;
    margin: 10px 0;
    font-size: 0.95rem;
    color: #444;
    justify-content: center;
  }

  .arch-info li i {
    color: #b78d65;
    margin-right: 10px;
    font-size: 1.2rem;
  }

  .arch-info li span {
    color: #333;
    font-weight: 500;
  }

  /* Right Card */
  .right-card {
    background: rgba(255,255,255,0.97);
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(183,141,101,0.1);
    padding: 25px;
  }

  .right-card h3 {
    color: #B78D65;
    font-weight: 800;
    margin-bottom: 20px;
    font-size: 1.5rem;
    text-align: center;
  }

  .project-images {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 15px;
    margin-bottom: 20px;
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

  .card {
    background: rgba(255,255,255,0.97);
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(183,141,101,0.1);
    padding: 20px;
    margin-bottom: 15px;
  }
  .card h4, .card h5 {
    color: #B78D65;
    font-weight: 700;
    margin-bottom: 12px;
  }
  .details-list {
    list-style: none;
    padding: 0;
  }
  .details-list li {
    margin-bottom: 8px;
    font-size: 0.95rem;
    color: #333;
  }
  .details-list li strong {
    color: #B78D65;
  }

  /* Book Button */
  .book-btn {
    display: block;
    margin: 35px auto 0 auto;
    padding: 14px 40px;
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
  }
  .book-btn::after {
    content: "";
    position: absolute;
    top: 0;
    left: -75%;
    width: 50%;
    height: 100%;
    background: rgba(255,255,255,0.2);
    transform: skewX(-25deg);
    transition: all 0.5s ease;
  }
  .book-btn:hover::after {
    left: 125%;
  }
  .book-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 20px rgba(255, 255, 255, 0.3);
  }
  .arch-about {
  margin-top: 15px;
  background: #faf7f4; /* lighter tone */
  border-radius: 12px;
  padding: 12px 16px;  /* reduced padding */
  box-shadow: 0 4px 12px rgba(183,141,101,0.08);
  text-align: left;
  }

  .arch-about h4 {
    margin: 0 0 8px 0;
    font-size: 1.5rem;       /* smaller title */
    color: #b78d65;
    font-weight: 700;
    border-left: 3px solid #b78d65;
    padding-left: 8px;
  }

  .arch-about p {
    margin: 0;
    font-size: 0.9rem;     /* smaller text */
    color: #444;
    line-height: 1.5;
  }


    @media (max-width: 768px) {
      .view-architect-container {
        grid-template-columns: 1fr;
        padding: 20px;
      }
    }
</style>

<!-- Architect + Project Section -->
<div class="view-architect-container">
  <!-- Architect Details (Left) -->
  <div class="left-card">
    <div class="left-card-header">
      <h3>Architect Details</h3>
    </div>
    <div class="arch-profile">
      <img src="../uploads/<?php echo $architect['profiles'] ?: 'default.png'; ?>" alt="Architect">
      <h4><?php echo $architect['arch_name']; ?></h4>
      <ul class="arch-info">
        <li><i class="fas fa-user-tie"></i><span><?php echo $architect['status'] ?: "N/A"; ?></span></li>
        <div class="arch-about">
          <h4>About Me</h4>
          <p><?php echo $architect['about'] ?: "No details available."; ?></p>
        </div>
      </ul>
    </div>
  </div>

  <!-- Project Details (Right) -->
  <div class="right-card">
    <h3>Project Details</h3>

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
</div>

  <!-- Book Now Button -->
  <form id="bookForm" action="contact_architect.php" method="get" class="text-center">
    <input type="hidden" name="arch_id" value="<?php echo $architect['architect_id']; ?>">
    <input type="hidden" name="project_id" value="<?php echo $project['prev_work_id']; ?>">
    <button type="button" class="book-btn" id="bookBtn">
      <i class="fas fa-calendar-check"></i> Contact Architect
    </button>
  </form>


<script>
  document.getElementById("bookBtn").addEventListener("click", function() {
    Swal.fire({
      title: 'Do You Wish to Contact <?php echo addslashes($architect['arch_name']); ?>?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Yes, Contact',
      cancelButtonText: 'Cancel',
      confirmButtonColor: '#b78d65',
      cancelButtonColor: '#dd7676ff',
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById("bookForm").submit();
      }
    });
  });
</script>



<!-- FontAwesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<?php include("footer.php"); ?>
