<?php include('header.php'); ?>

<?php
include("../dboperation.php");
$obj=newdboperation();
$a="SELECT * FROM tbl_district"
$res=$obj->query($a);
?>