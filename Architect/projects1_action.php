<?php
include_once("../dboperation.php");
$obj = new dboperation();

if (isset($_POST['submit'])) {
    $prev_work_id = $_POST['prev_work_id'];  
    $project_title = $_POST['project_title'];
    $project_description = $_POST['project_description'];

    $photo1 = $_FILES['photo1']['name'];
    $photo2 = $_FILES['photo2']['name'];
    $photo3 = $_FILES['photo3']['name'];

    if (!empty($photo1)) {
        move_uploaded_file($_FILES["photo1"]["tmp_name"], "../uploads/" . $photo1);
        $sql1 = "UPDATE tbl_previous_works SET image1='$photo1' WHERE prev_work_id='$prev_work_id'";
        $obj->executequery($sql1);
    }

    if (!empty($photo2)) {
        move_uploaded_file($_FILES["photo2"]["tmp_name"], "../uploads/" . $photo2);
        $sql2 = "UPDATE tbl_previous_works SET image2='$photo2' WHERE prev_work_id='$prev_work_id'";
        $obj->executequery($sql2);
    }

    if (!empty($photo3)) {
        move_uploaded_file($_FILES["photo3"]["tmp_name"], "../uploads/" . $photo3);
        $sql3 = "UPDATE tbl_previous_works SET image3='$photo3' WHERE prev_work_id='$prev_work_id'";
        $obj->executequery($sql3);
    }

    $sql = "UPDATE tbl_previous_works 
            SET title='$project_title', descriptions='$project_description' 
            WHERE prev_work_id='$prev_work_id'";
    $result = $obj->executequery($sql);

    if ($result == 1) {
        echo "<script>alert('Project updated successfully');window.location='index.php';</script>";
    } else {
        echo "<script>alert('Update failed');window.location='projects.php';</script>";
    }
}
?>
