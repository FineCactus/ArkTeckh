<!-- This is a php form to logout from the current session -->

<?php
session_start();
session_unset();
session_destroy();
header("Location: ../Guest/login.php"); // or your login page
exit;
?>
