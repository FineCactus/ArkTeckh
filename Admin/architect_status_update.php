<?php
include("../dboperation.php");
$obj = new dboperation();

// Check if this is an AJAX request
$isAjax = isset($_GET['ajax']) && $_GET['ajax'] == '1';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $architectId = $_GET['id'];
    $status = $_GET['status']; // 'Accepted' or 'Rejected'

    // Sanitize input
    $architectId = intval($architectId);
    $status = ($status === 'Accepted' || $status === 'Rejected') ? $status : 'Pending';

    // Get architect details before updating status
    $selectSql = "SELECT arch_name, email, username, passwords FROM tbl_architects WHERE architect_id = $architectId";
    $architectDetails = $obj->executequery($selectSql);
    $row = mysqli_fetch_array($architectDetails);

    if (!$row) {
        if ($isAjax) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Architect not found.']);
            exit();
        } else {
            echo "Architect not found.";
            exit();
        }
    }

    // Update the status
    $sql = "UPDATE tbl_architects SET status = '$status' WHERE architect_id = $architectId";
    $result = $obj->executequery($sql);

    if ($result) {
        $emailSent = false;
        $emailError = '';
        
        // Send email if status is Accepted
        if ($status === 'Accepted' && $row) {
            try {
                $bodyContent = "Dear {$row['arch_name']},

Your registration for architect account has been successfully verified. You can now upload your works.

Your Login Credentials:
Username: {$row['username']}
Password: {$row['passwords']}

Thank you for joining ArkTech!

Best regards,
ArkTech Team";

                $mailtoaddress = $row['email'];
                
                // Include and execute phpmailer
                ob_start();
                require('phpmailer.php');
                $phpmailerOutput = ob_get_clean();
                
                $emailSent = true;
            } catch (Exception $e) {
                $emailError = $e->getMessage();
            }
        }
        
        if ($isAjax) {
            header('Content-Type: application/json');
            if ($status === 'Accepted') {
                if ($emailSent) {
                    echo json_encode(['success' => true, 'message' => 'Architect accepted and email sent successfully.']);
                } else {
                    echo json_encode(['success' => true, 'message' => 'Architect accepted but email could not be sent. ' . $emailError]);
                }
            } else {
                echo json_encode(['success' => true, 'message' => 'Architect status updated successfully.']);
            }
            exit();
        } else {
            header("Location: architect_view.php?msg=StatusUpdated");
            exit();
        }
    } else {
        if ($isAjax) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Failed to update status.']);
            exit();
        } else {
            echo "Failed to update status.";
        }
    }
} else {
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Invalid request parameters.']);
        exit();
    } else {
        echo "Invalid request.";
    }
}
?>
