<?php
include("../dboperation.php");
include("header.php");

$obj = new dboperation();

// Get architect id from query string
$arch_id = $_GET['arch_id'] ?? 0;

// Fetch architect details
$sql = "SELECT * FROM tbl_architects WHERE architect_id = '$arch_id'";
$res = $obj->executequery($sql);
$architect = mysqli_fetch_array($res);
?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <!-- Architect Card -->
      <div class="card shadow-lg mb-4">
        <div class="card-body text-center">
          <img src="../uploads/<?php echo $architect['profiles'] ?: 'default.png'; ?>" 
               class="rounded-circle mb-3" 
               width="120" height="120" alt="Architect">
          <h4 class="fw-bold"><?php echo $architect['arch_name']; ?></h4>
          <p class="text-muted mb-1"><i class="fas fa-phone"></i> <?php echo $architect['phone'] ?: 'N/A'; ?></p>
          <p class="text-muted"><i class="fas fa-envelope"></i> <?php echo $architect['email'] ?: 'N/A'; ?></p>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="card shadow-lg">
        <div class="card-header bg-light">
          <h5 class="mb-0 text-center text-brown">📩 Contact Architect</h5>
        </div>
        <div class="card-body">
          <form action="send_message.php" method="post">
            <input type="hidden" name="architect_id" value="<?php echo $architect['architect_id']; ?>">

            <div class="mb-3">
              <label class="form-label fw-bold">Your Message</label>
              <textarea name="message" class="form-control" rows="4" placeholder="Write your message..." required></textarea>
            </div>

            <div class="mb-3">
              <label class="form-label fw-bold">Preferred Free Time</label>
              <input type="text" name="free_time" class="form-control" placeholder="Eg: Evening after 6 PM, Weekend, etc." required>
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
  .btn-brown {
    background: linear-gradient(135deg, #d8ad84, #b78d65);
    color: #fff;
    font-weight: 600;
    border-radius: 50px;
    padding: 10px;
    transition: 0.3s;
  }
  .btn-brown:hover {
    background: linear-gradient(135deg, #b78d65, #8d6e50);
    transform: translateY(-2px);
  }
  .text-brown { color: #b78d65; }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<?php include("footer.php"); ?>
