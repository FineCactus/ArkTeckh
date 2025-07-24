<?php
    include_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_POST['submit']))
    {
    $arch_name=$_POST['architectname'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $username=$_POST['username'];
    $password=$_POST['password'];

       $sqlquery1="INSERT INTO tbl_architects (arch_name,email,phone,username,passwords) VALUES('$arch_name','$email','$phone','$username','$password')";
        $result1=$obj->executequery($sqlquery1);
        if ($result1 == 1)
         {
            echo "<script>alert('Saved Successfully');window.location='architect_login.php' </script>";
        }
        
        else
        {
            echo "<script>alert('Registration failed');window.location='architect_login.php' </script>";
    }
}
?>