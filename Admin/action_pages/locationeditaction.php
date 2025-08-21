<?php
include_once("../../dboperation.php");
$obj=new dboperation();
if (isset($_POST['location_id']))
{
    $location_id=$_POST['location_id'];
    $location_name=$_POST['location_name'];
    $sql1="UPDATE tbl_location set location_name='$location_name'where location_id=$location_id";
    $result=$obj->executequery($sql1);
    if ($result == 1){
     header("Location: ../location_view.php?status=success");
            exit();
    }
    else{
     header("Location: ../location_view.php?status=error");
            exit();
    }
}
?>