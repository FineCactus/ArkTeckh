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
} 
else
{
$sqlquery="select * from tbl_customer where username='$username' and passwords='$password'";
$result= $obj->executequery($sqlquery);
   if(mysqli_num_rows($result) == 1) 
   {   
   $row = mysqli_fetch_array($result);
   $_SESSION["username"] = $username;
   $_SESSION["login_id"] =$row["customer_id"];
   $_SESSION["usertype"] = "customer";
   header("location:..\Guest\index.php");
   } 
}

$sqlquery= "select * from tbl_architects where username='$username' and passwords='$password' and status='Accepted'";
$result = $obj->executequery($sqlquery);

if(mysqli_num_rows($result) == 1) 
{
   $row = mysqli_fetch_array($result);
   $_SESSION["username"] = $username;
   $_SESSION["architect_id"] =$row["architect_id"];
   $_SESSION["usertype"] = "architect";
   header("location:../Architect/index.php");
} 
 else {
   
         // Invalid login, display an error message
         echo "<script>alert('Invalid Username/Password!!'); window.location='login.php'</script>";
      }
   // }


?>
