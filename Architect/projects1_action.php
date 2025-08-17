<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once("../dboperation.php");
$obj = new dboperation();

if (!isset($_SESSION['prev_work_id'])) {
    echo "<script>alert('No project started!');window.location='projects.php';</script>";
    exit();
}

$prev_work_id = $_SESSION['prev_work_id'];

if (isset($_POST['submit'])) {
    $project_title = $_POST['project_title'];
    $project_description = $_POST['project_description'];

    $photo1 = $_FILES['photo1']['name'];
    $photo2 = $_FILES['photo2']['name'];
    $photo3 = $_FILES['photo3']['name'];

    if ($photo1) move_uploaded_file($_FILES["photo1"]["tmp_name"], "../uploads/" . $photo1);
    if ($photo2) move_uploaded_file($_FILES["photo2"]["tmp_name"], "../uploads/" . $photo2);
    if ($photo3) move_uploaded_file($_FILES["photo3"]["tmp_name"], "../uploads/" . $photo3);

    $sql = "UPDATE tbl_previous_works 
            SET title='$project_title', 
                descriptions='$project_description',
                image1='$photo1',
                image2='$photo2',
                image3='$photo3'
            WHERE prev_work_id='$prev_work_id'";

    $res = $obj->executequery($sql);

    if ($res == 1) {
        unset($_SESSION['prev_work_id']); // clear session
        echo "<script>alert('Project details saved successfully.');window.location='projects.php';</script>";
    } else {
        echo "<script>alert('Failed to update details.');</script>";
    }
}
?>
