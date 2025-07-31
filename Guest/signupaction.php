<?php
include_once("../dboperation.php");
$obj = new dboperation();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!$username) {
        header("Location: signup.php?status=empty");
        exit();
    } else {
        $sqlquery = "SELECT * FROM tbl_customer WHERE username='$username'";
        $result = $obj->executequery($sqlquery);
        $rows = mysqli_num_rows($result);

        if ($rows == 1) {
            header("Location: signup.php?status=exist");
            exit();
        } else {
            $sqlquery1 = "INSERT INTO tbl_customer (username,email,passwords) VALUES('$username','$email','$password')";
            $result1 = $obj->executequery($sqlquery1);
            
            if ($result1 == 1) {
                header("Location: signup.php?status=success");
                exit();
            } else {
                header("Location: signup.php?status=error");
                exit();
            }
        }
    }
}
?>
