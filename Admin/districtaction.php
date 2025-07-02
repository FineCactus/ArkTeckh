<?php
    include_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_POST['submit']))
    {
    $districtname=$_POST['district'];
    if(!$districtname)
    {
        header("Location: district.php?status=empty");
            exit();
    }
    else{
    $sqlquery="SELECT * FROM tbl_district where district_name='$districtname'";
    $result=$obj->executequery($sqlquery);
    $rows=mysqli_num_rows($result);
    if($rows==1)
    {
        header("Location: district.php?status=exist");
        exit();
    
    }
    else
    {
       $sqlquery1="INSERT INTO tbl_district (district_name) VALUES('$districtname')";
        $result1=$obj->executequery($sqlquery1);
        if ($result1 == 1)
         {
            header("Location: district.php?status=success");
            exit();
        }
        
        else
        {
            header("Location: district.php?status=error");
            exit();
    }
}
}
}
?>