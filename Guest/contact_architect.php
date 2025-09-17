<?php
include("../dboperation.php");
include("header.php");

$obj = new dboperation();

$arch_id = $_GET['arch_id'] ?? 0;
$project_id = $_GET['project_id'] ?? 0; 

// Fetch architect
$sql = "SELECT * FROM tbl_architects WHERE architect_id = '$arch_id'";
$res = $obj->executequery($sql);
$architect = mysqli_fetch_array($res);

// Fetch project details
$sql2 = "SELECT * FROM tbl_previous_works WHERE prev_work_id = '$project_id'";
$res2 = $obj->executequery($sql2);
$project = mysqli_fetch_array($res2);
?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-7">

      <!-- Architect Profile Card -->
      <div class="profile-card mb-5">
        <div class="profile-header"></div>
        <div class="profile-body text-center">
          <img src="../uploads/<?php echo $architect['profiles'] ?: 'default.png'; ?>" 
               class="profile-img" 
               alt="Architect">
          <h3 class="fw-bold mt-3"><?php echo $architect['arch_name']; ?></h3>

          <p class="text-muted">
            <i class="fas fa-briefcase"></i> 
           Selected Project: <?php echo $project['title'] ?: 'Untitled Work'; ?>
          </p>
          <p class="text-muted">
            <i class="fas fa-calendar-alt"></i> 
            Posted on <?php echo date('F j, Y', strtotime($project['created_at'])); ?>
          </p>
        </div>
      </div>

        <!-- Contact Form Card -->
        <div class="contact-card shadow-lg">
          <div class="contact-header text-center">
            <h4><i class="fas fa-envelope-open-text"></i> Contact Architect</h4>
          </div>
          <div class="contact-body">
            <form action="send_message.php" method="post">
              <input type="hidden" name="architect_id" value="<?php echo $architect['architect_id']; ?>">
              <input type="hidden" name="customer_id" value="<?php echo $_SESSION['customer_id']; ?>">
              <input type="hidden" name="project_id" value="<?php echo $project['prev_work_id']; ?>">
              <input type="hidden" name="message" value="I am interested in your work... Can you provide me your contact details?">

              <div class="mb-3">
                <label class="form-label fw-bold">Your Message</label>
                <textarea class="form-control custom-input" rows="4" disabled>I am interested in your work... Can you provide me your contact details?</textarea>
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-brown">
                  <i class="fas fa-paper-plane"></i> Send Message
                </button>
              </div>
            </form>
          </div>
        </div>


    </div>
  </div>
</div>

<style>
  /* Profile Card */
  .profile-card {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(183,141,101,0.15);
    transition: transform 0.3s ease;
  }
  .profile-card:hover {
    transform: translateY(-5px);
  }
  .profile-header {
    height: 100px;
    background: linear-gradient(135deg, #d8ad84, #b78d65);
  }
  .profile-body {
    padding: 20px;
  }
  .profile-img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 50%;
    margin-top: -60px;
    border: 5px solid #fff;
    box-shadow: 0 6px 16px rgba(0,0,0,0.15);
  }

  /* Contact Card */
  .contact-card {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
  }
  .contact-header {
    background: #faf7f4;
    padding: 15px;
    border-bottom: 1px solid #eee;
  }
  .contact-header h4 {
    margin: 0;
    color: #b78d65;
    font-weight: 700;
  }
  .contact-body {
    padding: 25px;
  }

  /* Input Fields */
  .custom-input {
    border-radius: 12px;
    border: 1px solid #ddd;
    padding: 12px;
    transition: 0.3s;
  }
  .custom-input:focus {
    border-color: #b78d65;
    box-shadow: 0 0 6px rgba(183,141,101,0.3);
  }

  /* Button */
  .btn-brown {
    background: linear-gradient(135deg, #d8ad84, #b78d65);
    color: #fff;
    font-weight: 600;
    border-radius: 50px;
    padding: 12px;
    transition: 0.3s;
  }
  .btn-brown:hover {
    background: linear-gradient(135deg, #b78d65, #8d6e50);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(183,141,101,0.3);
  }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<?php include("footer.php"); ?>
