<?php
session_start();
include("../dboperation.php");

// Ensure architect is logged in
if (!isset($_SESSION['architect_id'])) {
    header("Location: login.php");
    exit();
}

$arch_id = $_SESSION['architect_id'];
$cust_id = isset($_GET['cust_id']) ? intval($_GET['cust_id']) : 0;
$obj = new dboperation();

// Fetch architect details
$sql_arch = "SELECT arch_name, email, phone FROM tbl_architects WHERE architect_id = '$arch_id'";
$res_arch = $obj->executequery($sql_arch);
$arch = mysqli_fetch_assoc($res_arch);

// Handle normal reply
if (isset($_POST['send_message'])) {
    $msg = mysqli_real_escape_string($obj->con, $_POST['message']);
    $insert_sql = "INSERT INTO tbl_messages (user_id, architect_id, sender, message, free_time, created_at) 
                   VALUES ('$cust_id', '$arch_id', 'architect', '$msg', '', NOW())";
    $obj->executequery($insert_sql);

    header("Location: view_message.php?cust_id=$cust_id");
    exit();
}

// Handle Accept Work button
if (isset($_POST['accept_work']) && !isset($_GET['accepted'])) {
    $accept_msg = "Hello, I have accepted your work request. 
You can contact me at:
📞 " . $arch['phone'] . "
📧 " . $arch['email'];

    $insert_sql = "INSERT INTO tbl_messages (user_id, architect_id, sender, message, free_time, created_at) 
                   VALUES ('$cust_id', '$arch_id', 'architect', '" . mysqli_real_escape_string($obj->con, $accept_msg) . "', '', NOW())";
    $obj->executequery($insert_sql);

    header("Location: view_message.php?cust_id=$cust_id&accepted=1");
    exit();
}

// Fetch conversation
$sql = "SELECT m.*, c.cname 
        FROM tbl_messages m
        INNER JOIN tbl_customer c ON m.user_id = c.customer_id
        WHERE m.user_id = '$cust_id' AND m.architect_id = '$arch_id'
        ORDER BY m.created_at ASC";
$res = $obj->executequery($sql);

// Get customer name for header
$custName = "Customer";
if (mysqli_num_rows($res) > 0) {
    $firstRow = mysqli_fetch_assoc($res);
    $custName = $firstRow['cname'];
    mysqli_data_seek($res, 0); // reset pointer
}

// ✅ only include header AFTER all redirects and processing
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
        height: 75vh;
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

    /* Customer = left (grey) */
    .customer {
        background: #e4e6eb;
        margin-right: auto;
        border-bottom-left-radius: 4px;
    }

    /* Architect = right (greenish) */
    .architect {
        background: #d1f1d1;
        margin-left: auto;
        border-bottom-right-radius: 4px;
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
    }

    .btn-send {
        background: #B78D65;
        color: #fff;
    }

    .btn-accept {
        background: #28a745;
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
    <div class="chat-header">Chat with <?php echo $custName; ?></div>
    <div class="chat-box" id="chatBox">
        <?php
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $senderClass = ($row['sender'] == 'architect') ? "architect" : "customer";

                echo "
                <div class='chat-message {$senderClass}'>
                    <div class='message-text'>" . htmlspecialchars($row['message']) . "</div>
                    <div class='message-time'>" . date("d M Y h:i A", strtotime($row['created_at'])) . "</div>
                </div>";
            }
        } else {
            echo "<p class='no-msg'>No messages found with this customer</p>";
        }
        ?>
    </div>

    <!-- Message Form -->
    <form method="post" class="chat-form">
        <textarea name="message" rows="1" placeholder="Type your message..."></textarea>
        <button type="submit" name="send_message" class="btn-send">Send</button>
        <button type="submit" name="accept_work" class="btn-accept">Accept Work</button>
    </form>
</div>

<script>
    // auto scroll to bottom
    var chatBox = document.getElementById("chatBox");
    chatBox.scrollTop = chatBox.scrollHeight;
</script>

<?php include("footer.php"); ?>
