<?php
session_start();
include("../dboperation.php");

// Ensure architect is logged in
if (!isset($_SESSION['architect_id'])) {
    echo json_encode(["status" => "error", "message" => "Not logged in"]);
    exit();
}

$arch_id = intval($_SESSION['architect_id']);
$cust_id = intval($_POST['cust_id'] ?? 0);
$message = trim($_POST['message'] ?? '');
$type    = $_POST['type'] ?? 'message'; // normal or accept

$obj = new dboperation();

if ($cust_id > 0) {
    if ($type === 'accept') {
        // fetch architect contact
        $sql_arch = "SELECT email, phone FROM tbl_architects WHERE architect_id='$arch_id'";
        $res_arch = $obj->executequery($sql_arch);
        $arch     = mysqli_fetch_assoc($res_arch);

        $message = "Hello,\nYou can contact me at:\n📞 {$arch['phone']}\n📧 {$arch['email']}";
    }

    if ($message !== '') {
        $msg = mysqli_real_escape_string($obj->con, $message);

        $sql = "INSERT INTO tbl_messages (user_id, architect_id, sender, message, free_time, created_at)
                VALUES ('$cust_id', '$arch_id', 'architect', '$msg', '', NOW())";
        $obj->executequery($sql);

        echo json_encode([
            "status"  => "success",
            "sender"  => "architect",
            "message" => nl2br( ($message)),
            "time"    => date("d M Y h:i A")
        ]);
        exit();
    }
}

echo json_encode(["status" => "error", "message" => "Invalid request"]);
