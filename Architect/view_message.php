<?php
session_start();
include("../dboperation.php");

if (!isset($_SESSION['architect_id'])) {
    header("Location: login.php");
    exit();
}

$arch_id = $_SESSION['architect_id'];
$cust_id = isset($_GET['cust_id']) ? intval($_GET['cust_id']) : 0;
$obj = new dboperation();

// Get customer name for header
$custName = "Customer";
$sql = "SELECT cname FROM tbl_customer WHERE customer_id = '$cust_id'";
$res = $obj->executequery($sql);
if ($row = mysqli_fetch_assoc($res)) {
    $custName = $row['cname'];
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
        <!-- Messages will be loaded dynamically -->
    </div>

    <!-- Message Form -->
    <form id="chatForm" class="chat-form">
        <textarea name="message" rows="1" placeholder="Type your message..." required></textarea>
        <input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
        <button type="submit" class="btn-send">Send</button>
        <button type="button" id="acceptBtn" class="btn-accept">Send Contact</button>
    </form>
</div>

<script>
const chatBox = document.getElementById("chatBox");
const form = document.getElementById("chatForm");
const acceptBtn = document.getElementById("acceptBtn");

// Load messages
function loadMessages() {
    fetch("fetch_messages.php?cust_id=<?php echo $cust_id; ?>")
        .then(res => res.json())
        .then(data => {
            if (data.status === "success") {
                chatBox.innerHTML = "";
                data.messages.forEach(msg => {
                    let div = document.createElement("div");
                    div.className = "chat-message " + (msg.sender === "architect" ? "architect" : "customer");
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
    fetch("view_message_action.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(() => {
        form.reset();
        loadMessages(); // refresh instantly
    });
});

// Handle accept work
acceptBtn.addEventListener("click", function() {
    let formData = new FormData();
    formData.append("cust_id", "<?php echo $cust_id; ?>");
    formData.append("type", "accept");

    fetch("view_message_action.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(() => loadMessages());
});

// Refresh messages every 5 sec
setInterval(loadMessages, 5000);
loadMessages(); // initial load
</script>

<?php include("footer.php"); ?>
