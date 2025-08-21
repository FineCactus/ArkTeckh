<?php
include_once("../dboperation.php");
$obj=new dboperation();
if (isset($_POST['submit']))
{
    $id=$_POST['district_id'];
    $district_name=$_POST['dname'];
    $sql1="UPDATE tbl_district set district_name='$district_name'where district_id=$id";
    $result=$obj->executequery($sql1);
    if ($result == 1){
     header("Location: districtview.php?status=success");
            exit();
    }
    else{
     header("Location: districtview.php?status=failed");
            exit();
    }
}
?>