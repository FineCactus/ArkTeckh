<?php
include_once("../../dboperation.php");

if (isset($_POST['update_amount'])) {
    $obj = new dboperation();
    
    $plan_id = $_POST['plan_id'];
    $amount = $_POST['amount'];
    
    // Validate input
    if (empty($amount) || $amount <= 0) {
        header("Location: ../subscription.php?status=empty");
        exit();
    }
    
    if (!is_numeric($amount)) {
        header("Location: ../subscription.php?status=invalid");
        exit();
    }
    
    // Update the plan amount
    $update_sql = "UPDATE tbl_plan SET amount = '$amount' WHERE plan_id = '$plan_id'";
    $result = $obj->executequery($update_sql);
    
    if ($result) {
        header("Location: ../subscription.php?status=success");
    } else {
        header("Location: ../subscription.php?status=error");
    }
} else {
    header("Location: ../subscription.php");
}
?>