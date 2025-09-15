<?php
include_once("../../dboperation.php");
$obj=new dboperation();
if (isset($_POST['submit']))
{
    $id=$_POST['CategoryId'];
    $Category_name=$_POST['catname'];
    if($Categoryimg=='')
    {
    $sql1="UPDATE tbl_category set category_name='$Category_name'where category_id=$id";
    $result=$obj->executequery($sql1);
    }
    else{
        $sql="UPDATE tbl_category set category_name='$Category_name' where category_id=$id";
    $result=$obj->executequery($sql);
    }
    if ($result == 1){
     header("Location: ../categoryview.php?status=success");
        exit();
    }
    else{
     header("Location: ../category_edit.php?status=error");
        exit();
    }
}
?>