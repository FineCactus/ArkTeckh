<?php
session_start();
include("header.php");
include_once("../dboperation.php");
$obj = new dboperation();

if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] != 'architect') {
    header("Location: ../login.php");
    exit();
}

$architect_id = $_SESSION['architect_id'];

// Fetch architect details
$sql = "SELECT * FROM tbl_architects WHERE architect_id='$architect_id'";
$res = $obj->executequery($sql);
$architect = mysqli_fetch_assoc($res);
?>

<style>
    main {
        font-family: "Segoe UI", sans-serif;
        background: linear-gradient(135deg, #e0f7fa, #f1f8e9);
        padding: 40px 0;
        min-height: 90vh;
    }
    .profile-edit-card {
        width: 90%;
        max-width: 650px;
        margin: auto;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 18px rgba(0,0,0,0.07);
        padding: 0 0 35px 0;
        overflow: hidden;
    }
    .profile-header {
        background: #B78D65;
        color: #fff;
        text-align: center;
        padding: 36px 24px 24px 24px;
        border-top-left-radius: 14px;
        border-top-right-radius: 14px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .profile-pic-preview {
        width: 112px;
        height: 112px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #fff;
        margin-bottom: 12px;
        background: #eee;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    }
    .profile-header h2 {
        margin: 0 0 7px 0;
        font-size: 25px;
        font-weight: 600;
    }
    .profile-header span {
        font-size: 15px;
        opacity: .88;
    }
    form {
        padding: 24px 30px 0 30px;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }
    label {
        font-weight: 500;
        margin-bottom: 4px;
        color: #3e3127;
    }
    input[type="text"],
    input[type="email"],
    input[type="file"] {
        width: 100%;
        padding: 10px;
        border-radius: 7px;
        border: 1px solid #ccc;
        box-sizing: border-box;
        background: #fafafa;
    }
    input[readonly] {
        background: #f2efef;
        color: #999;
    }
    button {
        background: #B78D65;
        color: white;
        padding: 13px 0;
        border: none;
        border-radius: 7px;
        font-size: 18px;
        font-weight: bold;
        letter-spacing: 0.5px;
        margin-top: 8px;
        cursor: pointer;
        transition: background .24s;
    }
    button:hover {
        background: #a6784f;
    }
    @media(max-width: 600px) {
        .profile-edit-card { padding: 0 0 20px 0; }
        form { padding: 18px 10px 0 10px; }
        .profile-header { padding: 28px 8px 15px 8px; }
    }
</style>

<main>
  <div class="profile-edit-card">
    <div class="profile-header">
      <img src="<?php echo $architect['profiles'] ? '../uploads/'.$architect['profiles'] : '../uploads/default.png'; ?>"
           class="profile-pic-preview" alt="Profile Picture">
      <h2><?php echo ($architect['arch_name']); ?></h2>
      <span>Edit your details (except Name)</span>
    </div>
    <form method="POST" enctype="multipart/form-data">
      <div>
        <label for="arch_name">Full Name (Read only)</label>
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
               value="<?php echo ($architect['location_id']); ?> "readonly>
      </div>
      <div>
        <label for="profile_pic">Profile Picture</label>
        <input type="file" id="profile_pic" name="profile_pic" accept="image/*">
      </div>
      <button type="submit">Save Changes</button>
    </form>
  </div>
</main>


<?php include("footer.php"); ?>
