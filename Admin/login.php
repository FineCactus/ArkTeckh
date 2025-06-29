<?php
session_start();
$_SESSION['username'] = $_POST['user']; // ✅ Store username
header("Location: index.php"); // or your dashboard
exit();
?>
