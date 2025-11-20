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

// Check if user has architect account and can login with customer credentials
$sqlquery_arch_customer = "SELECT a.*, c.username as customer_username 
                          FROM tbl_architects a 
                          JOIN tbl_customer c ON a.cust_id = c.customer_id 
                          WHERE c.username='$username' AND c.passwords='$password' AND a.status='Accepted'";
$result_arch = $obj->executequery($sqlquery_arch_customer);

if(mysqli_num_rows($result_arch) == 1) 
{
   $row = mysqli_fetch_array($result_arch);
   $_SESSION["username"] = $username;
   $_SESSION["architect_id"] = $row["architect_id"];
   $_SESSION["customer_id"] = $row["cust_id"]; // Also set customer_id for backward compatibility
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
