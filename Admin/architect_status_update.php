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

    // Get architect details with customer credentials before updating status
    $selectSql = "SELECT a.arch_name, a.email, c.username, c.passwords 
                  FROM tbl_architects a 
                  JOIN tbl_customer c ON a.cust_id = c.customer_id 
                  WHERE a.architect_id = $architectId";
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
                $bodyContent = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <style>
        body { font-family: 'Arial', sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background-color: #f4f4f4; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 0 20px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 28px; font-weight: 300; }
        .content { padding: 40px 30px; }
        .welcome-text { font-size: 18px; color: #2c3e50; margin-bottom: 25px; }
        .credentials-box { background: #f8f9fa; border-left: 4px solid #667eea; padding: 20px; margin: 25px 0; border-radius: 5px; }
        .credentials-box h3 { color: #2c3e50; margin-top: 0; }
        .credential-item { margin: 10px 0; font-family: 'Courier New', monospace; }
        .btn { display: inline-block; background: #667eea; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; margin: 20px 0; }
        .footer { background: #2c3e50; color: white; padding: 20px; text-align: center; font-size: 14px; }
        .divider { height: 2px; background: linear-gradient(to right, #667eea, #764ba2); margin: 30px 0; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>Welcome to ArkTech</h1>
            <p>Your Architecture Network</p>
        </div>
        
        <div class='content'>
            <p class='welcome-text'>Dear <strong>{$row['arch_name']}</strong>,</p>
            
            <p>Congratulations! Your application to join the ArkTech professional network has been <strong>approved</strong>.</p>
            
            <p>As a verified member of our exclusive architect community, you now have access to:</p>
            <ul style='color: #555; line-height: 1.8;'>
                <li>Project portfolio management system</li>
                <li>Direct client consultation booking</li>
                <li>Professional profile showcase</li>
                <li>Analytics and performance insights</li>
                <li>Premium subscription benefits</li>
            </ul>
            
            <div class='divider'></div>
            
            <div class='credentials-box'>
                <h3>Your Account Credentials</h3>
                <p style='margin-bottom: 15px;'><strong>Please save these details securely:</strong></p>
                <div class='credential-item'>
                    <strong>Username:</strong> {$row['username']}
                </div>
                <div class='credential-item'>
                    <strong>Password:</strong> {$row['passwords']}
                </div>
            </div>
            
            <p style='background: #e8f5e8; padding: 15px; border-radius: 5px; border-left: 4px solid #28a745;'>
                <strong>Ready to get started?</strong><br>
                Log in to your account and complete your professional profile to start receiving client inquiries.
            </p>
            
            <div style='text-align: center; margin: 30px 0;'>
                <a href='#' class='btn' style='color: white; text-decoration: none;'>Access Your Dashboard</a>
            </div>
            
            <div style='background: #fff3cd; padding: 15px; border-radius: 5px; border-left: 4px solid #ffc107; margin: 20px 0;'>
                <strong>Pro Tip:</strong> Upload high-quality images of your previous works to attract more clients and showcase your expertise.
            </div>
            
            <p>If you have any questions or need assistance, our support team is here to help.</p>
            
            <p style='margin-top: 30px;'>
                Best regards,<br>
                <strong>The ArkTech Team</strong><br>
                <em>Building Tomorrow, Today</em>
            </p>
        </div>
        
        <div class='footer'>
            <p>© 2025 ArkTech - Professional Architecture Network</p>
            <p style='font-size: 12px; margin-top: 10px;'>
                This email was sent to {$row['email']}. Please do not reply to this automated message.
            </p>
        </div>
    </div>
</body>
</html>";

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
