<?php
session_start();
include("header.php");
include_once("../dboperation.php");

$obj = new dboperation();

// ✅ Session check
if (!isset($_SESSION['customer_id'])) {
    header("Location: ../login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

// ✅ Fetch customer details
$sql = "SELECT * FROM tbl_customer WHERE customer_id='$customer_id'";
$res = $obj->executequery($sql);
$customer = mysqli_fetch_assoc($res);

// ✅ Defensive values (avoid warnings)
$name     = $customer['cname'] ?? "Not available";
$email    = $customer['email'] ?? "Not available";
$phone    = $customer['phone'] ?? "Not available";
$username = $customer['username'] ?? "Not provided";
$addres  = $customer['addres'] ?? "Not provided";
?>

<!-- Custom CSS -->
<link href="css/dashboard.css" rel="stylesheet">
<style>
.profile-container {
    display: flex;
    gap: 30px;
    padding: 30px;
    background: #f9f9f9;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.left, .right {
    flex: 1;
}
.architect-info h1 {
    font-size: 24px;
    margin-bottom: 10px;
}
.detail {
    margin-bottom: 15px;
    padding: 12px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
}
.detail strong {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #444;
}
.update-btn {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background: #B78D65;
    color: #fff;
    text-decoration: none;
    border-radius: 8px;
    transition: background 0.3s;
}
.update-btn:hover {
    transform: translateY(-3px);
}
</style>

<main>
    <div class="profile-container">
        <!-- Left Section -->
         <div class="left">
            <img src="<?php echo $customer['cprofile'] ? '../uploads/'.$customer['cprofile'] : '../uploads/default.png'; ?>" 
                 class="profile-pic" 
                 alt="Profile Picture">
            <div class="architect-info">
                <h1><?php echo $name; ?></h1>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Phone:</strong> <?php echo $phone; ?></p>
            </div>
        </div>

        <!-- Right Section -->
        <div class="right">
            <div class="detail">
                <strong>Full Name</strong>
                <?php echo $name; ?>
            </div>
            <div class="detail">
                <strong>Email</strong>
                <?php echo $email; ?>
            </div>
            <div class="detail">
                <strong>Phone</strong>
                <?php echo $phone; ?>
            </div>
            <div class="detail">
                <strong>Username</strong>
                <?php echo $username; ?>
            </div>
            <div class="detail">
                <strong>Address</strong>
                <?php echo $addres; ?>
            </div>

            <a href="update_customer_profile.php" class="update-btn">Update Profile</a>
        </div>
    </div>
</main>

<?php include("footer.php"); ?>
