<?php
session_start();
include("../dboperation.php");

// Check if user is logged in
if (!isset($_SESSION['customer_id'])) {
    if (isset($_GET['redirect']) && $_GET['redirect'] === 'true') {
        header('Location: /ArkTech/Guest/login.php');
        exit();
    }
    header('Content-Type: application/json');
    echo json_encode(['hasArchAccount' => false, 'error' => 'Not logged in']);
    exit();
}

$customer_id = $_SESSION['customer_id'];
$obj = new dboperation();

// Check if this customer has an accepted architect account
$sql = "SELECT architect_id, arch_name FROM tbl_architects WHERE cust_id = '$customer_id' AND status = 'Accepted'";
$result = $obj->executequery($sql);

if (mysqli_num_rows($result) > 0) {
    $architect = mysqli_fetch_array($result);
    
    // If redirect parameter is set, automatically login to architect area
    if (isset($_GET['redirect']) && $_GET['redirect'] === 'true') {
        $_SESSION['architect_id'] = $architect['architect_id'];
        header('Location: /ArkTech/Architect/index.php');
        exit();
    }
    
    // Otherwise return JSON response
    header('Content-Type: application/json');
    echo json_encode(['hasArchAccount' => true]);
} else {
    header('Content-Type: application/json');
    echo json_encode(['hasArchAccount' => false]);
}
?>