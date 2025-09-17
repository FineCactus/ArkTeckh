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

<link href="css/dashboard.css" rel="stylesheet">
<style>
</style>

<main>
    <div class="profile-container">
        <!-- Left section -->
        <div class="left">
            <img src="<?php echo $architect['profiles'] ? '../uploads/'.$architect['profiles'] : '../uploads/default.png'; ?>" 
                 class="profile-pic" 
                 alt="Profile Picture">

            <div class="architect-info">
                <h1><?php echo $architect['arch_name']; ?></h1>
                <p><strong>Email:</strong> <?php echo $architect['email']; ?></p>
                <p><strong>Phone:</strong> <?php echo $architect['phone']; ?></p>
            </div>
        </div>

        <!-- Right section -->
        <div class="right">
            <div class="detail">
                <strong>Full Name</strong>
                <?php echo $architect['arch_name']; ?>
            </div>
            <div class="detail">
                <strong>Email</strong>
                <?php echo $architect['email']; ?>
            </div>
            <div class="detail">
                <strong>Phone</strong>
                <?php echo $architect['phone']; ?>
            </div>
            <div class="detail">
                <strong>Username</strong>
                <?php echo $architect['username'] ?? "Not provided"; ?>
            </div>
            <div class="detail">
                <strong>Location</strong>
                <?php echo $architect['arch_locations'] ?? "Not provided"; ?>
            </div>

            <a href="update_architect_profile.php" class="update-btn">Update Profile</a>
        </div>
    </div>
</main>

<?php if (isset($_GET['status'])): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    let status = "<?php echo $_GET['status']; ?>";

    if (status === "success") {
        Swal.fire({
            icon: 'success',
            title: 'Profile Updated!',
            text: 'Your profile details were saved successfully.',
            timer: 1000, 
            iconColor: '#e9c6a5ff',
            confirmButtonColor: '#B78D65'
        });
    } else if (status === "error") {
        Swal.fire({
            icon: 'error',
            title: 'Update Failed',
            text: 'Something went wrong. Please try again.',
        });
    }

    // Clean the URL (remove ?status=...)
    window.history.replaceState({}, document.title, "architect_dashboard.php");
});
</script>
<?php endif; ?>


<?php include("footer.php"); ?>
