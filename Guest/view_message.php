<?php
session_start();
include("../dboperation.php");
include("header.php");

// Ensure customer is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$cust_id = $_SESSION['customer_id'];
$arch_id = isset($_GET['arch_id']) ? intval($_GET['arch_id']) : 0;
$obj = new dboperation();

// Fetch messages only for this customer and selected architect
$sql = "SELECT m.*, a.arch_name 
        FROM tbl_messages m
        INNER JOIN tbl_architects a ON m.architect_id = a.architect_id
        WHERE m.user_id = '$cust_id' AND m.architect_id = '$arch_id'
        ORDER BY m.created_at ASC";
$res = $obj->executequery($sql);

// Get architect name for header
$archName = "Architect";
if (mysqli_num_rows($res) > 0) {
    $firstRow = mysqli_fetch_assoc($res);
    $archName = $firstRow['arch_name'];
    mysqli_data_seek($res, 0);
}
?>
<style>
    .chat-container {
        width: 70%;
        margin: 40px auto;
        background: #f8f9fa;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        padding: 20px;
    }

    .chat-header {
        text-align: center;
        font-size: 22px;
        margin-bottom: 20px;
        color: #333;
    }

    .chat-box {
        background: #fff;
        border-radius: 12px;
        padding: 15px;
        height: 500px;
        overflow-y: auto;
    }

    .chat-message {
        margin: 12px 0;
        max-width: 75%;
        padding: 12px 15px;
        border-radius: 18px;
        font-size: 15px;
        line-height: 1.5;
        position: relative;
        word-wrap: break-word;
        margin-left: auto; /* push to right */
        background: #dcf8c6; /* WhatsApp green bubble */
        border-bottom-right-radius: 4px;
    }

    .message-text {
        color: #222;
    }

    .message-time {
        font-size: 11px;
        color: #555;
        margin-top: 6px;
        text-align: right;
    }

    .no-msg {
        text-align: center;
        color: #888;
        font-style: italic;
    }
</style>

<div class="chat-container">
    <h2 class="chat-header">Messages Sent to <?php echo $archName; ?></h2>
    <div class="chat-box">
        <?php
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                echo "
                <div class='chat-message customer'>
                    <div class='message-text'>
                        {$row['message']}
                    </div>
                    <div class='message-time'>Free Time: {$row['free_time']} | Sent: {$row['created_at']}</div>
                </div>";
            }
        } else {
            echo "<p class='no-msg'>No messages found with this architect</p>";
        }
        ?>
    </div>
</div>

<?php include("footer.php"); ?>
