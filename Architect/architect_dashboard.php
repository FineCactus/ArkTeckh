<?php
session_start();
include("header.php");
include_once("../dboperation.php");
$obj = new dboperation();

// Check if logged in and is architect
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
    }



    /* Left side: profile picture & name */
    .left {
        flex: 1;
        background:#B78D65;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 30px;
        color: white;
    }

    .profile-pic {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid rgba(255,255,255,0.7);
        box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        transition: transform 0.3s ease;
    }

    .profile-pic:hover {
        transform: scale(1.05) rotate(2deg);
    }

    .left h1 {
        margin: 15px 0 5px;
    }

    .left p {
        margin: 0;
        font-size: 16px;
        opacity: 0.9;
    }

    /* Right side: details */
    .right {
        flex: 2;
        padding: 40px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .detail {
        background: #f9f9f9;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0px 2px 6px rgba(0,0,0,0.05);
    }

    .detail strong {
        display: block;
        color: #B78D65;
        margin-bottom: 5px;
    }

    /* Update button */
    .update-btn {
        grid-column: span 2;
        padding: 12px;
        background: #B78D65;
        color: white;
        text-align: center;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
        transition: background 0.3s ease;
    }

    .update-btn:hover {
        background: #B78D65;
    }
</style>

<main>
    <div class="container">
        <!-- Left section -->
        <div class="left">
            <img src="<?php echo $architect['profiles'] ? '../uploads/'.$architect['profiles'] : '../uploads/default.png'; ?>" class="profile-pic" alt="Profile Picture">
            <h1><?php echo $architect['arch_name']; ?></h1>
            <p><?php echo $architect['email']; ?></p>
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
                <strong>Experience</strong>
                <?php echo $architect['experience'] ?? "Not provided"; ?>
            </div>
            <div class="detail">
                <strong>Specialization</strong>
                <?php echo $architect['specialization'] ?? "Not provided"; ?>
            </div>
            <div class="detail">
                <strong>Location</strong>
                <?php echo $architect['location'] ?? "Not provided"; ?>
            </div>

            <a href="update_architect_profile.php" class="update-btn">Update Profile</a>
        </div>
    </div>
</div>
</main>

<?php include("footer.php"); ?>
