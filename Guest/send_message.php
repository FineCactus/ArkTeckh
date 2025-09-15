<?php
session_start();
include("../dboperation.php");

$obj = new dboperation();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $architect_id = $_POST['architect_id'];
    $customer_id  = $_SESSION['customer_id']; // safer than hidden field
    $message      = $_POST['message'];
    $free_time    = $_POST['free_time'];

    $sql = "INSERT INTO tbl_messages (user_id, architect_id, message, free_time, created_at) 
            VALUES ('$customer_id', '$architect_id', '$message', '$free_time', NOW())";

    $res = $obj->executequery($sql);

    if ($res) {
        echo "<script>alert('Message sent successfully!'); window.location.href='booking.php';</script>";
    } else {
        echo "<script>alert('Error sending message.'); window.history.back();</script>";
    }
}
?>
