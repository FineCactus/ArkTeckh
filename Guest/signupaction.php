<?php
include_once("../dboperation.php");
$obj = new dboperation();

if (isset($_POST['submit'])) {
    $name=$_POST['customer_name'];
    $address=$_POST['address'];
    $email = $_POST['email'];
    $phone=$_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $location=$_POST['location'];
    $photo1=$_FILES['photo1']['name'];

    if (!$username) {
        header("Location: customer_signup.php?status=empty");
        exit();
    } else {
        move_uploaded_file($_FILES["photo1"]["tmp_name"], "../uploads/" . $photo1);
        $sqlquery = "SELECT * FROM tbl_customer WHERE username='$username'";
        $result = $obj->executequery($sqlquery);
        $rows = mysqli_num_rows($result);

        if ($rows == 1) {
            header("Location: login.php?status=exist");
            exit();
        } else {
            $sqlquery1 = "INSERT INTO tbl_customer (cname,addres,email,phone,username,passwords,locations,cprofile) VALUES('$name','$address','$email','$phone','$username','$password','$location','$photo1')";
            $result1 = $obj->executequery($sqlquery1);
            
            if ($result1 == 1) {
                header("Location: login.php?status=success");
                exit();
            } else {
                header("Location: customer_signup.php?status=error");
                exit();
            }
        }
    }
}
?>
