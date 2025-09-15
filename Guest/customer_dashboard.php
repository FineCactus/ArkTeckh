<?php
session_start();
include("../dboperation.php");
include("header.php");

if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$cust_id = $_SESSION['customer_id'];
$obj = new dboperation();

// Fetch distinct architects this customer has messaged
$sql = "SELECT DISTINCT a.architect_id, a.arch_name, a.email, a.phone 
        FROM tbl_messages m
        INNER JOIN tbl_architects a ON m.architect_id = a.architect_id
        WHERE m.user_id = '$cust_id'
        ORDER BY a.arch_name ASC";
$res = $obj->executequery($sql);
?>

<style>
    .project-card {
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      padding: 15px;
      background: #fff;
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
      box-shadow: 0 12px 20px rgba(0, 0, 0, 0.3);
    }
</style>

<!-- Page Header -->
<div class="container-fluid page-header py-5 mb-5">
  <div class="container py-5">
    <h1 class="display-1 text-white">Dashboard</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb text-uppercase mb-0">
        <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
        <li class="breadcrumb-item text-primary active" aria-current="page">Dashboard</li>
      </ol>
    </nav>
  </div>
</div>

<!-- Architects Section -->
<div class="container my-5">
  <?php if (mysqli_num_rows($res) > 0) { ?>
    <?php while ($row = mysqli_fetch_assoc($res)) { ?>
      
      <div class="project-card mb-5">
        <div class="row align-items-center">

          <!-- Left: Architect Initial (or placeholder) -->
          <div class="col-md-3 d-flex justify-content-center">
            <div class="glass text-center d-flex align-items-center justify-content-center" 
                 style="width:120px;height:120px;font-size:2rem;font-weight:600;color:#fff;background:linear-gradient(135deg,#d8ad84ff,#B78D65);">
              <?php echo strtoupper(substr($row['arch_name'],0,1)); ?>
            </div>
          </div>

          <!-- Middle: Architect Details -->
          <div class="col-md-7 p-4">
            <h4 class="fw-bold mb-2"><?php echo $row['arch_name']; ?></h4>
            <p class="mb-1"><strong>Email:</strong> <?php echo $row['email']; ?></p>
            <p class="mb-1"><strong>Phone:</strong> <?php echo $row['phone']; ?></p>
          </div>

          <!-- Right: View Messages Button -->
          <div class="col-md-2 text-center">
            <a href='view_message.php?arch_id=<?php echo $row['architect_id']; ?>' class='view-btn mt-2'>
                View Messages
            </a>
          </div>

        </div>
      </div>

    <?php } ?>
  <?php } else { ?>
    <div class="text-center py-5">
      <h4 class="text-muted">You haven’t messaged any architects yet.</h4>
    </div>
  <?php } ?>
</div>

<?php include("footer.php"); ?>
