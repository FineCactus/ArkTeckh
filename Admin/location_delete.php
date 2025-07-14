<?php
include("../dboperation.php");
$obj=new dboperation();

  $did=$_GET["location_id"];
  $sql="delete from tbl_location where location_id=$did";
  $res=$obj->executequery($sql);
 
  
  echo "<script>alert('Deleted Successfully!!');window.location='location_view.php'</script>";

?>