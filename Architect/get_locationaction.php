<?php
include_once("../dboperation.php");
$obj = new dboperation();

if (isset($_POST['submit'])) {
    $category_id = $_POST['category_id'];
    $location_id = $_POST['location_id'];

    $sqlquery1 = "INSERT INTO tbl_previous_works (category_id, location_id) VALUES ('$category_id', '$location_id')";
    $result1 = $obj->executequery($sqlquery1);

    if ($result1) {
        echo "<script>alert('Project details saved successfully!'); window.location='success.php';</script>";
    } else {
        echo "<script>alert('Failed to save project details.');</script>";
    }
}
?>
