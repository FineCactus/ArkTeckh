<?php
session_start();
include("../dboperation.php");

// Ensure customer is logged in
if (!isset($_SESSION['customer_id'])) {
    echo json_encode(["status" => "error", "message" => "Not logged in"]);
    exit();
}

$cust_id = intval($_SESSION['customer_id']);
$arch_id = intval($_POST['arch_id'] ?? 0);
$message = trim($_POST['message'] ?? '');

$obj = new dboperation();

if ($arch_id > 0 && $message !== '') {
    $msg = mysqli_real_escape_string($obj->con, $message);

    $sql = "INSERT INTO tbl_messages (user_id, architect_id, sender, message, free_time, created_at)
            VALUES ('$cust_id', '$arch_id', 'customer', '$msg', '', NOW())";
    $obj->executequery($sql);

    echo json_encode([
        "status"  => "success",
        "sender"  => "customer",
        "message" => nl2br(htmlspecialchars($message)),
        "time"    => date("d M Y h:i A")
    ]);
    exit();
}

echo json_encode(["status" => "error", "message" => "Invalid request"]);
