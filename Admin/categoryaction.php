<?php
    include_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_POST['submit']))
    {
    $catname=$_POST['catname'];
    $photo=$_FILES['photo']['name'];
    move_uploaded_file($_FILES["photo"]["tmp_name"], "../uploads/" . $photo);

    $sqlquery="SELECT * FROM tbl_category where category_name='$catname'";
    $result=$obj->executequery($sqlquery);
    
    $rows=mysqli_num_rows($result);
    if($rows==1)
    {
          echo "<script>alert('Already Exist!!');window.location='category.php'</script>";
    
    }
    else
    {
       $sqlquery1="INSERT INTO tbl_category (category_name,photo) VALUES('$catname','$photo')";
        $result1=$obj->executequery($sqlquery1);
        if($result1==1)
        {
          echo "<script>alert('Registration Succesfully!!');window.location='category.php'</script>";
    
        }
        else
        {
        echo "<script>alert('Registration Failed!!');window.location='category.php'</script>";
}
}
}
?>