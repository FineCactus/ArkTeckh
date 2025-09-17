<?php
session_start();
include("header.php");
include_once("../dboperation.php");
$obj = new dboperation();

if (!isset($_SESSION['architect_id'])) {
    header("Location: ../login.php");
    exit();
}
$architect_id = $_SESSION['architect_id'];

$sql = "SELECT * FROM tbl_architects WHERE architect_id='$architect_id'";
$res = $obj->executequery($sql);
$architect = mysqli_fetch_assoc($res);
?>

<link href="css/updatedashboard.css" rel="stylesheet">

<main>
  <div class="profile-edit-card">
    <div class="profile-header">
      <img src="<?php echo $architect['profiles'] ? '../uploads/'.$architect['profiles'] : '../uploads/default.png'; ?>"
           class="profile-pic-preview" alt="Profile Picture">
      <h2><?php echo ($architect['arch_name']); ?></h2>
      <span>Edit your details (except Name)</span>
    </div>
    <form action="profile_action.php" method="POST" enctype="multipart/form-data">
      <div>
        <label for="arch_name">Full Name </label>
        <input type="text" id="arch_name" name="arch_name"
               value="<?php echo ($architect['arch_name']); ?>" readonly>
      </div>
      <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email"
               value="<?php echo ($architect['email']); ?>" required>
      </div>
      <div>
        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone"
               value="<?php echo ($architect['phone']); ?>" required>
      </div>
      <div>
        <label for="location">Location</label>
        <input type="text" id="location" name="location"
               value="<?php echo ($architect['arch_locations']); ?>" required>
      </div>
      <div>
        <label for="profile_pic">Profile Picture</label>
        <input type="file" id="profile_pic" name="photo" accept="image/*">
      </div>

        <input type="hidden" name="architect_id" value="<?php echo $architect['architect_id']; ?>">

      <button type="submit" name="submit">Save Changes</button>
    </form>
  </div>
</main>
<?php include("footer.php"); ?>

