<?php
    include_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_POST['submit']))
    {
    $catname=$_POST['catname'];
    $photo=$_FILES['photo']['name'];

    if((!$catname))
    {
        header("Location: category.php?status=empty");
            exit();
    }
    else
    {
    move_uploaded_file($_FILES["photo"]["tmp_name"], "../uploads/" . $photo);

    $sqlquery="SELECT * FROM tbl_category where category_name='$catname'";
    $result=$obj->executequery($sqlquery);
    
    $rows=mysqli_num_rows($result);
    if($rows==1)
    {
           header("Location: category.php?status=exist");
        exit();
    
    }
    else
    {
       $sqlquery1="INSERT INTO tbl_category (category_name,photo) VALUES('$catname','$photo')";
        $result1=$obj->executequery($sqlquery1);
        if($result1==1)
        {
          header("Location: category.php?status=success");
            exit();
    
        }
        else
        {
        header("Location: category.php?status=error");
            exit();
}
}
}
    }
?>