<?php
    include_once("../dboperation.php");
    $obj=new dboperation();
    if(isset($_POST['submit']))
    {
    $districtname=$_POST['district'];
    if(!$districtname)
    {
        echo "<script>alert('Please enter a valid data!!');window.location='district.php'</script>";
    }
    $sqlquery="SELECT * FROM tbl_district where district_name='$districtname'";
    $result=$obj->executequery($sqlquery);
    $rows=mysqli_num_rows($result);
    if($rows==1)
    {
          echo "<script>alert('Already Exist!!');window.location='district.php'</script>";
    
    }
    else
    {
       $sqlquery1="INSERT INTO tbl_district (district_name) VALUES('$districtname')";
        $result1=$obj->executequery($sqlquery1);
        if($result1==1)
        {
            header("Location: popup.php");
            exit();   
        }
        else
        {
        echo "<script>alert('Registration Failed!!');window.location='district.php'</script>";
    }
}
}
?>