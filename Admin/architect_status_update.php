<?php
include("../dboperation.php");
$obj = new dboperation();

if (isset($_GET['id']) && isset($_GET['status'])) {
    $architectId = $_GET['id'];
    $status = $_GET['status']; // 'Accepted' or 'Rejected'

    // Sanitize input
    $architectId = intval($architectId);
    $status = ($status === 'Accepted' || $status === 'Rejected') ? $status : 'Pending';

    // Update the status
    $sql = "UPDATE tbl_architects SET status = '$status' WHERE architect_id = $architectId";
    $result = $obj->executequery($sql);

    if ($result) {
        header("Location: architect_view.php?msg=StatusUpdated");
        exit();
    } else {
        echo "Failed to update status.";
    }
} else {
    echo "Invalid request.";
}
?>
