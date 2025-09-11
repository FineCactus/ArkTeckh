<?php
include("../dboperation.php");
$obj=new dboperation();

  $did=$_GET["eid"];
  $sql="delete from tbl_previous_works where prev_work_id=$did";
  $res=$obj->executequery($sql);


  header("Location: architect_view.php?status=deleted");
        exit();

?>