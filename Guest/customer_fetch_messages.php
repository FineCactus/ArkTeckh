<?php
session_start();
include("../dboperation.php");

if (!isset($_SESSION['customer_id'])) {
    echo json_encode(["status" => "error", "message" => "Not logged in"]);
    exit();
}

$cust_id = intval($_SESSION['customer_id']);
$arch_id = intval($_GET['arch_id'] ?? 0);

$obj = new dboperation();

$sql = "SELECT m.*, a.arch_name 
        FROM tbl_messages m
        JOIN tbl_architects a ON m.architect_id = a.architect_id
        WHERE m.user_id = '$cust_id' AND m.architect_id = '$arch_id'
        ORDER BY m.created_at ASC";

$res = $obj->executequery($sql);

$messages = [];
while ($row = mysqli_fetch_assoc($res)) {
    $messages[] = [
        "sender"  => $row['sender'],
        "message" => nl2br( ($row['message'])),
        "time"    => date("d M Y h:i A", strtotime($row['created_at']))
    ];
}

echo json_encode(["status" => "success", "messages" => $messages]);
