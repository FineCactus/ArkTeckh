<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once("../dboperation.php");

// Get data from POST
$plan_id = $_POST['plan_id'];
$amount = $_POST['amount'];
$architect_id = $_POST['architect_id']; // Get architect_id from form
$regdate = date("Y-m-d");

// Fallback to session if architect_id not in POST
if (empty($architect_id) && isset($_SESSION['architect_id'])) {
    $architect_id = $_SESSION['architect_id'];
}

// Check if architect_id is available
if (empty($architect_id)) {
    echo "<script>alert('Error: Architect ID not found. Please login again.');window.location='../Guest/login.php'</script>";
    exit();
}

$obj = new dboperation();

$sql = "INSERT INTO tbl_subscriptionplan(plan_id, architect_id, amount, regdate) 
        VALUES ('$plan_id', '$architect_id', '$amount', '$regdate')";

$res = $obj->executequery($sql);

if ($res) 
    {
     echo "<script>alert('Plan selected successfully! Please proceed with payment.');window.location='paymentmain.php?cid=$architect_id'</script>";
} else {
    echo "<div class='container my-5'><div class='alert alert-danger'>Error while selecting plan.</div></div>";
}
?>
