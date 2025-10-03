<?php
session_start();
include("../dboperation.php");
include("header.php");

$arch_id = $_SESSION['architect_id'];
$obj = new dboperation();

// Fetch architect details
$sql_arch = "SELECT arch_name FROM tbl_architects WHERE architect_id = '$arch_id'";
$res_arch = $obj->executequery($sql_arch);
$arch_data = mysqli_fetch_assoc($res_arch);
$arch_name = $arch_data['arch_name'];

// Ensure architect is logged in
if (!isset($_SESSION['architect_id'])) {
    header("Location: login.php");
    exit();
}

$arch_id = $_SESSION['architect_id'];
$obj = new dboperation();

// Fetch distinct customers who messaged this architect
$sql = "SELECT DISTINCT c.customer_id, c.cname, c.email, c.phone, c.cprofile
        FROM tbl_messages m
        INNER JOIN tbl_customer c ON m.user_id = c.customer_id
        WHERE m.architect_id = '$arch_id'
        ORDER BY c.cname ASC";

$res = $obj->executequery($sql);
?>

<style>
        body, html {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
    }

    .main-content {
        flex: 1; /* pushes footer down */
    }
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

<div class="main-content">
  <!-- Page Header -->
  <div class="container-fluid page-header py-5 mb-5">
  <div class="container py-5">
    <h1 class="display-1 text-white">Dashboard</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb text-uppercase mb-0">
        <li class="breadcrumb-item text-primary active" aria-current="page">Dashboard</li>
      </ol>
    </nav>
  </div>
</div>

<!-- Main Section -->
<div class="container my-5">

  <!-- Welcome Message -->
  <div class="mb-5 text-center">
    <h2 class="fw-bold">Welcome Back, <?php echo ($arch_name); ?>!</h2>
    <p class="text-muted">Here are your recent customer messages.</p>
  </div>

  <!-- Customers Section -->
  <?php if (mysqli_num_rows($res) > 0) { ?>
    <?php while ($row = mysqli_fetch_assoc($res)) { ?>
      
      <div class="project-card mb-5">
        <div class="row align-items-center">

          <!-- Left: Customer Profile Picture -->
          <div class="col-md-3 d-flex justify-content-center">
            <?php if (!empty($row['cprofile'])) { ?>
                <img src="../uploads/<?php echo $row['cprofile']; ?>" 
                    alt="Customer Picture" 
                    style="width:120px;height:120px;object-fit:cover;
                            border-radius:50%;border:3px solid #B78D65;">
            <?php } else { ?>
                <!-- Fallback: Letter in circle -->
                <div class="glass text-center d-flex align-items-center justify-content-center" 
                    style="width:120px;height:120px;font-size:2rem;font-weight:600;color:#fff;
                            background:linear-gradient(135deg,#d8ad84ff,#B78D65);border-radius:50%;">
                  <?php echo strtoupper(substr($row['cname'],0,1)); ?>
                </div>
            <?php } ?>
          </div>

          <!-- Middle: Customer Details -->
          <div class="col-md-7 p-4">
            <h4 class="fw-bold mb-2"><?php echo $row['cname']; ?></h4>
            <p class="mb-1"><strong>Email:</strong> <?php echo $row['email']; ?></p>
            <p class="mb-1"><strong>Phone:</strong> <?php echo $row['phone']; ?></p>
          </div>

          <!-- Right: View Conversation Button -->
          <div class="col-md-2 text-center">
            <a href='view_message.php?cust_id=<?php echo $row['customer_id']; ?>' class='view-btn mt-2'>
                View Messages
            </a>
          </div>

        </div>
      </div>

    <?php } ?>
  <?php } else { ?>
    <div class="text-center py-5">
      <h4 class="text-muted">No customers have messaged you yet.</h4>
    </div>
  <?php } ?>
</div>
</div>

<?php include("footer.php"); ?>
