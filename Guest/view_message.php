<?php
session_start();
include("../dboperation.php");

// ✅ Ensure customer is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$cust_id  = $_SESSION['customer_id'];
$arch_id  = isset($_GET['arch_id']) ? intval($_GET['arch_id']) : 0;
$obj      = new dboperation();

// ✅ Fetch architect name
$archName = "Architect";
$sql_arch = "SELECT arch_name FROM tbl_architects WHERE architect_id='$arch_id'";
$res_arch = $obj->executequery($sql_arch);
if ($row = mysqli_fetch_assoc($res_arch)) {
    $archName = $row['arch_name'];
}

// ✅ Check if architect has replied at least once
$arch_sent = mysqli_num_rows(
    $obj->executequery("SELECT 1 FROM tbl_messages 
                        WHERE user_id='$cust_id' 
                          AND architect_id='$arch_id' 
                          AND sender='architect' 
                        LIMIT 1")
) > 0;

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
        <!-- Messages will load dynamically -->
    </div>

    <!-- ✅ Message Form -->
    <form id="chatForm" class="chat-form">
        <textarea name="message" id="messageInput" rows="1" placeholder="Type your message..."
            <?php echo $arch_sent ? "" : "disabled"; ?>></textarea>
        <input type="hidden" name="arch_id" value="<?php echo $arch_id; ?>">
        <button type="submit" <?php echo $arch_sent ? "" : "disabled"; ?>>Send</button>
    </form>
</div>

<script>
const chatBox = document.getElementById("chatBox");
const form = document.getElementById("chatForm");
const input = document.getElementById("messageInput");

// Load messages
function loadMessages() {
    fetch("customer_fetch_messages.php?arch_id=<?php echo $arch_id; ?>")
        .then(res => res.json())
        .then(data => {
            if (data.status === "success") {
                chatBox.innerHTML = "";
                data.messages.forEach(msg => {
                    let div = document.createElement("div");
                    div.className = "chat-message " + (msg.sender === "customer" ? "customer" : "architect");
                    div.innerHTML = `
                        <div class="message-text">${msg.message}</div>
                        <div class="message-time">${msg.time}</div>
                    `;
                    chatBox.appendChild(div);
                });
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        });
}

// Handle send message
form.addEventListener("submit", function(e) {
    e.preventDefault();
    let formData = new FormData(form);

    fetch("customer_message_action.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === "success") {
            input.value = "";
            loadMessages(); // refresh instantly
        }
    });
});

// Refresh messages every 5 sec
setInterval(loadMessages, 5000);
loadMessages(); // initial load
</script>

<?php include("footer.php"); ?>
