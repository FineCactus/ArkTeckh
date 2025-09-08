<?php
session_start();
include_once("../dboperation.php");
$obj = new dboperation();
$username = $_POST["user"];
$password = $_POST["pass"];
$sqlquery = "select * from tbl_adminlogin where username='$username' and password='$password'";
$result= $obj->executequery($sqlquery);
if(mysqli_num_rows($result) == 1) 
{
   $row = mysqli_fetch_array($result);
   $_SESSION["username"] = $username;
   $_SESSION["login_id"] =$row["loginid"];
   header("location:..\Admin\index.php");
   exit();
} 
else
{
$sqlquery="select * from tbl_customer where username='$username' and passwords='$password'";
$result= $obj->executequery($sqlquery);
   if(mysqli_num_rows($result) == 1) 
   {   
   $row = mysqli_fetch_array($result);
   $_SESSION["username"] = $username;
   $_SESSION["customer_id"] =$row["customer_id"];
   header("location:../Guest/index.php");
   exit();
   } 
}

$sqlquery= "select * from tbl_architects where username='$username' and passwords='$password' and status='Accepted'";
$result = $obj->executequery($sqlquery);

if(mysqli_num_rows($result) == 1) 
{
   $row = mysqli_fetch_array($result);
   $_SESSION["username"] = $username;
   $_SESSION["architect_id"] =$row["architect_id"];
   header("location:../Architect/index.php");
   exit();
} 
 else {
   
         // Invalid login, display an error message
         header("Location: login.php?status=error");
         exit();
      }
   // }


?>
