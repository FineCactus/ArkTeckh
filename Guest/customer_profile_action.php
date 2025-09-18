<?php
include_once("../dboperation.php");
$obj = new dboperation();

if (isset($_POST['submit'])) {
    $id     = $_POST['customer_id'];
    $phone  = $_POST['phone'];
    $email  = $_POST['email'];
    $addres = $_POST['addres'];
    $loc    = $_POST['locations'];

    // Fetch old profile picture
    $sql_old = "SELECT cprofile FROM tbl_customer WHERE customer_id=$id";
    $res_old = $obj->executequery($sql_old);
    $old_data = mysqli_fetch_assoc($res_old);
    $old_pic = $old_data['cprofile'];

    $profile_pic = "";
    if (!empty($_FILES["photo"]["name"])) {
        $profile_pic = $_FILES["photo"]["name"];

        // Delete old pic if exists
        if (!empty($old_pic) && $old_pic != "default.png" && file_exists("../uploads/" . $old_pic)) {
            unlink("../uploads/" . $old_pic);
        }

        move_uploaded_file($_FILES["photo"]["tmp_name"], "../uploads/" . $profile_pic);

        $sql = "UPDATE tbl_customer 
                SET phone='$phone', email='$email', addres='$addres', locations='$loc', cprofile='$profile_pic' 
                WHERE customer_id=$id";
    } else {
        $sql = "UPDATE tbl_customer 
                SET phone='$phone', email='$email', addres='$addres', locations='$loc' 
                WHERE customer_id=$id";
    }

    $result = $obj->executequery($sql);

    if ($result) {
        header("Location: profile.php?status=success");
        exit();
    } else {
        header("Location: update_customer_profile.php?status=error");
        exit();
    }
}
?>
