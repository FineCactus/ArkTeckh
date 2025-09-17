<?php
session_start();
include("../dboperation.php");

// Ensure customer is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$cust_id = $_SESSION['customer_id'];
$arch_id = isset($_GET['arch_id']) ? intval($_GET['arch_id']) : 0;
$obj = new dboperation();

// ✅ Handle customer sending message
if (isset($_POST['send_message'])) {
    $msg = mysqli_real_escape_string($obj->con, $_POST['message']);
    $insert_sql = "INSERT INTO tbl_messages (user_id, architect_id, sender, message, free_time, created_at) 
                   VALUES ('$cust_id', '$arch_id', 'customer', '$msg', '', NOW())";
    $obj->executequery($insert_sql);

    header("Location: view_message.php?arch_id=$arch_id");
    exit();
}

// Fetch messages for this customer & architect
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

// Check if architect has sent any message
$arch_sent = false;
$sql_arch = "SELECT * FROM tbl_messages 
             WHERE architect_id = '$arch_id' 
               AND user_id = '$cust_id' 
               AND sender = 'architect' 
             LIMIT 1";
$res_arch = $obj->executequery($sql_arch);

if (mysqli_num_rows($res_arch) > 0) {
    $arch_sent = true;
}


include("header.php");
?>
<style>
    body {
        background: #f2f2f2;
        font-family: Arial, sans-serif;
    }

    .chat-container {
        width: 60%;
        margin: 30px auto;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
        height: 70vh;
        overflow: hidden;
    }

    .chat-header {
        padding: 15px;
        background: #B78D65;
        color: #fff;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
    }

    .chat-box {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
        background: #fafafa;
        display: flex;
        flex-direction: column;
    }

    .chat-message {
        margin: 8px 0;
        max-width: 70%;
        padding: 10px 14px;
        border-radius: 15px;
        font-size: 14px;
        line-height: 1.4;
        word-wrap: break-word;
    }

    /* Customer = right side (greenish) */
    .customer {
        background: #d1f1d1;
        margin-left: auto;
        border-bottom-right-radius: 4px;
    }

    /* Architect = left side (grey) */
    .architect {
        background: #e4e6eb;
        margin-right: auto;
        border-bottom-left-radius: 4px;
    }

    .message-time {
        font-size: 11px;
        color: #555;
        margin-top: 4px;
        text-align: right;
    }

    .chat-form {
        display: flex;
        padding: 15px;
        border-top: 1px solid #ddd;
        background: #fff;
        gap: 10px;
    }

    .chat-form textarea {
        flex: 1;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 8px;
        resize: none;
        font-size: 14px;
    }

    .chat-form button {
        padding: 8px 15px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
        background: #B78D65;
        color: #fff;
    }

    .no-msg {
        text-align: center;
        color: #888;
        font-style: italic;
        margin-top: 20px;
    }
</style>

<div class="chat-container">
    <div class="chat-header">Chat with <?php echo $archName; ?></div>
    <div class="chat-box" id="chatBox">
        <?php
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $senderClass = ($row['sender'] == 'customer') ? "customer" : "architect";

                echo "
                <div class='chat-message {$senderClass}'>
                    <div class='message-text'>" . htmlspecialchars($row['message']) . "</div>
                    <div class='message-time'>" . date("d M Y h:i A", strtotime($row['created_at'])) . "</div>
                </div>";
            }
        } else {
            echo "<p class='no-msg'>No messages found with this architect</p>";
        }
        ?>
    </div>

    <!-- ✅ Message Form -->
        <form method="post" class="chat-form">
            <?php if ($arch_sent): ?>
                <textarea name="message" rows="1" placeholder="Type your message..." required></textarea>
                <button type="submit" name="send_message">Send</button>
            <?php else: ?>
                <textarea rows="1" disabled placeholder="You can send a message only after the architect replies"></textarea>
                <button type="submit" disabled>Send</button>
            <?php endif; ?>
        </form>

</div>

<script>
    // auto scroll to bottom
    var chatBox = document.getElementById("chatBox");
    chatBox.scrollTop = chatBox.scrollHeight;
</script>

<?php include("footer.php"); ?>
