<?php
session_start();
include_once("C:\wamp64\www\ArkTech\dboperation.php");
$obj = new dboperation();
$username = $_POST["user"];
$password = $_POST["pass"];


$sqlquery = "select * from tbl_customer where username='$username' and passwords='$password'";
$result= $obj->executequery($sqlquery);
if (mysqli_num_rows($result) == 1) {
   $row = mysqli_fetch_array($result);
   $_SESSION["username"] = $username;
   $_SESSION["login_id"] = $row["login_id"];

   header("Location:/ArkTech/Guest/index.php");
   exit();
} else {
   
         // Invalid login, display an error message
         echo "<script>alert('Invalid Username/Password!!'); window.location='login.php'</script>";
      }
   // }

?>
