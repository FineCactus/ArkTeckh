<?php
include("../dboperation.php");
$obj = new dboperation();

if (isset($_GET['id']) && isset($_GET['status'])) {
    $architectId = $_GET['id'];
    $status = $_GET['status']; // 'Accepted' or 'Rejected'

    // Sanitize input
    $architectId = intval($architectId);
    $status = ($status === 'Accepted' || $status === 'Rejected') ? $status : 'Pending';

    // Get architect details before updating status
    $selectSql = "SELECT arch_name, email FROM tbl_architects WHERE architect_id = $architectId";
    $architectDetails = $obj->executequery($selectSql);
    $row = mysqli_fetch_array($architectDetails);

    // Update the status
    $sql = "UPDATE tbl_architects SET status = '$status' WHERE architect_id = $architectId";
    $result = $obj->executequery($sql);

    if ($result) {
        // Send email if status is Accepted
        if ($status === 'Accepted' && $row) {
            $bodyContent = "Dear $row[arch_name],
                                    Your registering is sucessfully completed in the website. You can access the Arktech website now.";
            $mailtoaddress = $row['email'];
            require('phpmailer.php');
        }
        
        header("Location: architect_view.php?msg=StatusUpdated");
        exit();
    } else {
        echo "Failed to update status.";
    }
} else {
    echo "Invalid request.";
}
?>
