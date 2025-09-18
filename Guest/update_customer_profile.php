<?php
session_start();
include("header.php");
include_once("../dboperation.php");
$obj = new dboperation();

if (!isset($_SESSION['customer_id'])) {
    header("Location: ../login.php");
    exit();
}
$customer_id = $_SESSION['customer_id'];

$sql = "SELECT * FROM tbl_customer WHERE customer_id='$customer_id'";
$res = $obj->executequery($sql);
$customer = mysqli_fetch_assoc($res);
?>

<link href="css/updatedashboard.css" rel="stylesheet">

<main>
  <div class="profile-edit-card">
    <div class="profile-header">
      <img src="<?php echo $customer['cprofile'] ? '../uploads/'.$customer['cprofile'] : '../uploads/default.png'; ?>"
           class="profile-pic-preview" alt="Profile Picture">
      <h2><?php echo  ($customer['cname']); ?></h2>
      <span>Edit your details (except Name)</span>
    </div>
    <form action="customer_profile_action.php" method="POST" enctype="multipart/form-data">
      <div>
        <label for="cname">Full Name</label>
        <input type="text" id="cname" name="cname"
               value="<?php echo  ($customer['cname']); ?>" readonly>
      </div>
      <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email"
               value="<?php echo  ($customer['email']); ?>" required>
      </div>
      <div>
        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone"
               value="<?php echo  ($customer['phone']); ?>" required>
      </div>
      <div>
        <label for="addres">Address</label>
        <input type="text" id="addres" name="addres"
               value="<?php echo  ($customer['addres']); ?>" required>
      </div>
      <div>
        <label for="locations">Location</label>
        <input type="text" id="locations" name="locations"
               value="<?php echo  ($customer['locations']); ?>" required>
      </div>
      <div>
        <label for="cprofile">Profile Picture</label>
        <input type="file" id="cprofile" name="photo" accept="image/*">
      </div>

      <input type="hidden" name="customer_id" value="<?php echo $customer['customer_id']; ?>">

      <button type="submit" name="submit">Save Changes</button>
    </form>
  </div>
</main>
<?php include("footer.php"); ?>
