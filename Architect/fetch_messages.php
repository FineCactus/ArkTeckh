<?php
session_start();
include("../dboperation.php");

// Ensure architect is logged in
if (!isset($_SESSION['architect_id'])) {
    echo json_encode(["status" => "error", "message" => "Not logged in"]);
    exit();
}

$arch_id = intval($_SESSION['architect_id']);
$cust_id = intval($_GET['cust_id'] ?? 0);

$obj = new dboperation();

if ($cust_id <= 0) {
    echo json_encode(["status" => "error", "message" => "Invalid customer"]);
    exit();
}

$sql = "SELECT m.*, c.cname 
        FROM tbl_messages m
        INNER JOIN tbl_customer c ON m.user_id = c.customer_id
        WHERE m.user_id = '$cust_id' AND m.architect_id = '$arch_id'
        ORDER BY m.created_at ASC";

$res = $obj->executequery($sql);

$messages = [];
while ($row = mysqli_fetch_assoc($res)) {
    $messages[] = [
        "sender"  => $row['sender'],
        "message" => nl2br(htmlspecialchars($row['message'])),
        "time"    => date("d M Y h:i A", strtotime($row['created_at']))
    ];
}

echo json_encode(["status" => "success", "messages" => $messages]);
