<?php
include_once("../../dboperation.php");
$obj = new dboperation();

if (isset($_POST['submit'])) {
    $location_name = trim($_POST['location']);
    $district_id = $_POST['districtid']; //  matches your form field name

    if (empty($location_name)) {
        header("Location: ../location.php?status=empty");
        exit();
    }

    // Check if location already exists for this district
    $sqlquery = "SELECT * FROM tbl_location WHERE location_name = '$location_name' AND district_id = '$district_id'";
    $result = $obj->executequery($sqlquery);
    $rows = mysqli_num_rows($result);

    if ($rows > 0) {
        header("Location: ../location.php?status=exist");
        exit();
    } else {
        //  Corrected INSERT with district_id
        $sqlquery1 = "INSERT INTO tbl_location (location_name, district_id) VALUES ('$location_name', '$district_id')";
        $result1 = $obj->executequery($sqlquery1);

        if ($result1 == 1) {
            header("Location: ../location_view.php?status=successs");
            exit();
        } else {
            header("Location: ../location.php?status=error");
            exit();
        }
    }
}
?>