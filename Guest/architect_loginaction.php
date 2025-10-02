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
    $location = $_POST['location'];
    $about=$_POST['about'];
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

       $sqlquery1="INSERT INTO tbl_architects (arch_name,email,phone,username,passwords,about,profiles,certificate_of_licensce,arch_locations) VALUES('$arch_name','$email','$phone','$username','$password','$about','$photo1','$certificate','$location')";
        $result1=$obj->executequery($sqlquery1);       
          if($result1==1)
        {
           $cid=mysqli_insert_id($obj->con);
          echo "<script>alert('Registration Succesfully!!');window.location='index.php?cid=$cid'</script>";
    
        }
        else
        {
       echo "<script>alert('Registration Failed!!');window.location='architect_login.php'</script>";
        }
    }
}
}
?>