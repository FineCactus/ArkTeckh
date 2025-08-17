<?php
include_once("../dboperation.php");
$obj = new dboperation();

if (isset($_POST['submit'])) {
    $id     = $_POST['architect_id'];
    $phone  = $_POST['phone'];
    $email  = $_POST['email'];

    $sql_old = "SELECT profiles FROM tbl_architects WHERE architect_id=$id";
    $res_old = $obj->executequery($sql_old);
    $old_data = mysqli_fetch_assoc($res_old);
    $old_pic = $old_data['profiles'];

    $profile_pic = "";
    if (!empty($_FILES["photo"]["name"])) {
        $profile_pic = $_FILES["photo"]["name"];

        if (!empty($old_pic) && $old_pic != "default.png" && file_exists("../uploads/" . $old_pic)) {
            unlink("../uploads/" . $old_pic);
        }

        move_uploaded_file($_FILES["photo"]["tmp_name"], "../uploads/" . $profile_pic);

        $sql = "UPDATE tbl_architects 
                SET phone='$phone', email='$email', profiles='$profile_pic' 
                WHERE architect_id=$id";
    } else {
        
        $sql = "UPDATE tbl_architects 
                SET phone='$phone', email='$email' 
                WHERE architect_id=$id";
    }

    $result = $obj->executequery($sql);

    if ($result) {
        echo "<script>alert('Saved Successfully');window.location='architect_dashboard.php'</script>";
    } else {
        echo "<script>alert('Update failed');window.location='architect_dashboard.php'</script>";
    }
}
?>
