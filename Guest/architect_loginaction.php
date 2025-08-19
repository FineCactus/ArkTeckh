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
    $photo1=$_FILES['photo1']['name'];
    $certificate=$_FILES['certificate']['name'];
    $location_id = $_POST['location_id'];
   if((!$username))
    {
        header("Location: architect_login.php?status=empty");
        exit();
    }
    else
    {
    move_uploaded_file($_FILES["photo1"]["tmp_name"], "../uploads/" . $photo1);
    move_uploaded_file($_FILES["certificate"]["tmp_name"], "../uploads/" . $certificate);
    $sqlquery="SELECT * FROM tbl_architects where username='$username'";
    $result=$obj->executequery($sqlquery);
    
    $rows=mysqli_num_rows($result);
    if($rows==1)
    {
           header("Location: architect_login.php?status=exist");
            exit();
    
    }
    else
    {

       $sqlquery1="INSERT INTO tbl_architects (arch_name,email,phone,username,passwords,profiles,certificate_of_licensce,location_id) VALUES('$arch_name','$email','$phone','$username','$password','$photo1','$certificate','$location_id')";
        $result1=$obj->executequery($sqlquery1);
        if ($result1 == 1)
         {
            header("Location: login.php?status=success");
            exit();
        }
        
        else
        {
            
    }
    }
}
}
?>