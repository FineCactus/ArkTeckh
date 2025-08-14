<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("../dboperation.php");
$obj = new dboperation();

// Check if user is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

// Fetch current customer details
$sql = "SELECT * FROM tbl_customer WHERE customer_id='$customer_id'";
$res = $obj->executequery($sql);
$customer = mysqli_fetch_assoc($res);

// Handle form submission
if (isset($_POST['update_profile'])) {
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Profile image handling
    if (!empty($_FILES['profile_img']['name'])) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $filename = time() . "_" . basename($_FILES["profile_img"]["name"]);
        $target_file = $target_dir . $filename;

        if (move_uploaded_file($_FILES["profile_img"]["tmp_name"], $target_file)) {
            $update_sql = "UPDATE tbl_customer 
                           SET phone='$phone', email='$email', profile_img='$filename' 
                           WHERE customer_id='$customer_id'";
        }
    } else {
        $update_sql = "UPDATE tbl_customer 
                       SET phone='$phone', email='$email' 
                       WHERE customer_id='$customer_id'";
    }

    if (isset($update_sql) && $obj->executequery($update_sql)) {
        header("Location: profile.php?updated=1");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Profile</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f8f8; margin: 0; padding: 0; }
        .profile-container { max-width: 500px; margin: 40px auto; background: #fff; padding: 20px; border-radius: 10px; text-align: center; }
        img.profile-pic { width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 2px solid #ccc; }
        .form-group { margin: 15px 0; text-align: left; }
        input[type="text"], input[type="email"], input[type="file"] {
            width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;
        }
        button { background: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #45a049; }
    </style>
</head>
<body>

<div class="profile-container">
    <h2>My Profile</h2>

    <img class="profile-pic" src="<?php echo !empty($customer['profile_img']) ? 'uploads/'.$customer['profile_img'] : 'default.png'; ?>" alt="Profile Picture">

    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Phone:</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($customer['phone']); ?>" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($customer['email']); ?>" required>
        </div>
        <div class="form-group">
            <label>Change Profile Picture:</label>
            <input type="file" name="profile_img" accept="image/*">
        </div>
        <button type="submit" name="update_profile">Update Profile</button>
    </form>

    <?php if (isset($_GET['updated'])) echo "<p style='color:green;'>Profile updated successfully!</p>"; ?>
</div>

</body>
</html>
