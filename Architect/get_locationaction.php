<?php
include_once("../dboperation.php");
$obj = new dboperation();

if (isset($_POST['submit'])) {
    $category_id = $_POST['category_id'];
    $location_id = $_POST['location_id'];
    $architect_id  = $_POST['architect_id'];

    $sqlquery1 = "INSERT INTO tbl_previous_works (architect_id, category_id, location_id) VALUES ('$architect_id', '$category_id', '$location_id')";
    $result1 = $obj->executequery($sqlquery1);

    if ($result1) {
        echo "<script>window.location='projects.php';</script>";
    } else {
        echo "<script>alert('Failed to save project details.');window.location='project1.php';</script>";
    }
}
?>
