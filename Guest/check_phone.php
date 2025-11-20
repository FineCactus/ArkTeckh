<?php
include_once("../dboperation.php");

if (isset($_POST['phone'])) {
    $obj = new dboperation();
    $phone = $_POST['phone'];
    
    $query = "SELECT phone FROM tbl_customer WHERE phone = '$phone'";
    $result = $obj->executequery($query);
    
    if (mysqli_num_rows($result) > 0) {
        echo "exists";
    } else {
        echo "available";
    }
}
?>