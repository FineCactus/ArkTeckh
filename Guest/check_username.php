<?php
include_once("../dboperation.php");

if (isset($_POST['username'])) {
    $obj = new dboperation();
    $username = $_POST['username'];
    
    $query = "SELECT username FROM tbl_customer WHERE username = '$username'";
    $result = $obj->executequery($query);
    
    if (mysqli_num_rows($result) > 0) {
        echo "exists";
    } else {
        echo "available";
    }
}
?>