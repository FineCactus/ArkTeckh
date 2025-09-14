<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once("../dboperation.php");
$obj = new dboperation();

if (isset($_POST['submit'])) {
    $architect_id = $_SESSION['architect_id'];   
    $category_id = $_POST['category_id'];
    $district_id = $_POST['district_id'];
    $location_id = $_POST['location_id'];

    $sql = "INSERT INTO tbl_previous_works (architect_id, category_id, project_location, created_at) 
            VALUES ('$architect_id', '$category_id', '$location_id', NOW())";

    $result = $obj->executequery($sql);

    if ($result == 1) {
        $prev_work_id = mysqli_insert_id($obj->con);
        $_SESSION['prev_work_id'] = $prev_work_id;
        header("Location: projects.php");
        exit();
    } else {
        echo "<script>alert('Failed to create project entry.');window.location='projects.php';</script>";
    }
}
?>
