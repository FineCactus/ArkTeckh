<?php
include("../dboperation.php");
$obj = new dboperation();

if (isset($_GET["eid"])) {
    $did = $_GET["eid"];

    //Get the photo filename from the database
    $sql = "SELECT photo FROM tbl_category WHERE category_id = $did";
    $result = $obj->executequery($sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $imageFile = $row['photo'];
        $imagePath = "../uploads/" . $imageFile;

        // Delete the image file if it exists
        if (!empty($imageFile) && file_exists($imagePath)) {
            unlink($imagePath);
        }

        //Delete the category record
        $deleteSql = "DELETE FROM tbl_category WHERE category_id = $did";
        $obj->executequery($deleteSql);
    }
}

header("Location: categoryview.php?status=deleted");
exit();
?>
