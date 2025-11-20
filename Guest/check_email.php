<?php
include_once("../dboperation.php");

if (isset($_POST['email'])) {
    $obj = new dboperation();
    $email = $_POST['email'];
    
    $query = "SELECT email FROM tbl_customer WHERE email = '$email'";
    $result = $obj->executequery($query);
    
    if (mysqli_num_rows($result) > 0) {
        echo "exists";
    } else {
        echo "available";
    }
}
?>