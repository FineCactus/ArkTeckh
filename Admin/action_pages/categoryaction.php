<?php
    include_once("../../dboperation.php");
    $obj=new dboperation();
    if(isset($_POST['submit']))
    {
    $catname=$_POST['catname'];

    if((!$catname))
    {
        header("Location: ../category.php?status=empty");
            exit();
    }
    else
    {
    $sqlquery="SELECT * FROM tbl_category where category_name='$catname'";
    $result=$obj->executequery($sqlquery);
    
    $rows=mysqli_num_rows($result);
    if($rows==1)
    {
           header("Location: ../category.php?status=exist");
        exit();
    
    }
    else
    {
       $sqlquery1="INSERT INTO tbl_category (category_name) VALUES('$catname')";
        $result1=$obj->executequery($sqlquery1);
        if($result1==1)
        {
          header("Location: ../categoryview.php?status=success");
            exit();
    
        }
        else
        {
        header("Location: ../category.php?status=error");
            exit();
}
}
}
    }
?>