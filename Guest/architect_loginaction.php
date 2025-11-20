<?php
    include_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_POST['submit']))
    {
    $arch_name=$_POST['architectname'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $customer_id = isset($_POST['customer_id']) ? $_POST['customer_id'] : 0;
    $photo1=$_FILES['photo1']['name'];
    $certificate=$_FILES['certificate']['name'];
    $location = $_POST['location'];
    $about=$_POST['about'];
    
   if(empty($arch_name) || empty($email) || empty($phone))
    {
        header("Location: architect_login.php?status=empty");
        exit();
    }
    else
    {
    move_uploaded_file($_FILES["photo1"]["tmp_name"], "../uploads/" . $photo1);
    move_uploaded_file($_FILES["certificate"]["tmp_name"], "../uploads/" . $certificate);
    
    // Check if customer is already registered as architect (cust_id uniqueness)
    if($customer_id > 0) {
        $cust_check_query="SELECT * FROM tbl_architects where cust_id='$customer_id'";
        $cust_result=$obj->executequery($cust_check_query);
        
        if(mysqli_num_rows($cust_result) >= 1)
        {
               header("Location: architect_login.php?status=already_registered");
                exit();
        }
    }
    
    // Insert architect record
    {
       $sqlquery1="INSERT INTO tbl_architects (cust_id,arch_name,email,phone,about,profiles,certificate_of_licensce,arch_locations,status) VALUES('$customer_id','$arch_name','$email','$phone','$about','$photo1','$certificate','$location','Pending')";
        $result1=$obj->executequery($sqlquery1);       
          if($result1==1)
        {
           header("Location: index.php?status=success");
           exit();
        }
        else
        {
           header("Location: architect_login.php?status=error");
           exit();
        }
    }
}
}
?>