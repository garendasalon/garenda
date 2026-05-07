<?php
session_start();
error_reporting(E_ALL); 
include('includes/dbconnection.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobilenum = $_POST['mobilenum'];
    $gender = $_POST['gender'];
    $details = $_POST['details']; 
    $date = $_POST['date'];
    $time = $_POST['time'];
    $aptnumber = mt_rand(100000000, 999999999);
    $billingid = mt_rand(100000, 999999); 

    $query = mysqli_query($con, "insert into tblcustomers(AptNumber,Name,Email,MobileNumber,Gender,Details,app_date,app_time) value('$aptnumber','$name','$email','$mobilenum','$gender','$details','$date','$time')");
    
    if ($query) {
        $lastid = mysqli_insert_id($con); 
        $assign_query = mysqli_query($con, "insert into tblinvoice(Userid, ServiceId, BillingId) value('$lastid', '$details', '$billingid')");
        
        if($assign_query){
            echo "<script>alert('Appointment Booked and Receipt Ready!');</script>";
            echo "<script>window.location.href = 'thank-you.php'</script>";
        }
    } else {
        echo "<script>alert('Something Went Wrong. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Salon | Book Appointment</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    
    <style>
        .center-screen {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* --- CHATBOT STYLING --- */
        #chatbot-launcher {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background-color: #c32143;
            border-radius: 50%;
            color: white;
            text-align: center;
            line-height: 60px;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            z-index: 9999;
        }
        #chatbot-window {
            position: fixed;
            bottom: 100px;
            right: 30px;
            width: 350px;
            height: 450px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.15);
            display: none;
            flex-direction: column;
            overflow: hidden;
            z-index: 9999;
        }
        .chatbot-header {
            background: #c32143;
            color: white;
            padding: 15px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
        }
        .chatbot-messages {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            background: #f9f9f9;
            font-size: 14px;
            display: flex;
            flex-direction: column;
        }
        .bot-msg, .user-msg {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 10px;
            max-width: 80%;
        }
        .bot-msg { background: #eee; align-self: flex-start; color: #333; }
        .user-msg { background: #c32143; color: white; align-self: flex-end; }
        
        /* Typing indicator styling */
        .typing { font-style: italic; color: #888; font-size: 12px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <?php include_once('includes/header.php'); ?>

    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-caption">
                        <h2 class="page-title">Book Appointment</h2>
                        <div class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li class="active">Book Appointment</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-3">
                <form method="post" class="well">
                    <h3 class="text-center">Book Your Service</h3>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" name="mobilenum" class="form-control" maxlength="11" required>
                    </div>
                    <div class="form-group">
                        <label>Gender</label><br>
                        <input type="radio" name="gender" value="Male" checked> Male 
                        <input type="radio" name="gender" value="Female"> Female
                    </div>
                    <div class="form-group">
                        <label>Select Service</label>
                        <select name="details" class="form-control" required>
                            <option value="">-- Select --</option>
                            <?php 
                            $s_query = mysqli_query($con, "select * from tblservices");
                            while($row = mysqli_fetch_array($s_query)) { ?>
                                <option value="<?php echo $row['ServiceName'];?>"><?php echo $row['ServiceName'];?> (₱<?php echo $row['Cost'];?>)</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control" required min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Time</label>
                        <input type="time" name="time" class="form-control" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Book Now</button>
                </form>
            </div>
        </div>
    </div>

    <div id="chatbot-launcher" onclick="toggleChat()">
        <i class="fa fa-comments"></i>
    </div>

    <div id="chatbot-window">
        <div class="chatbot-header">
            <span>Garenda Salon Assistant</span>
            <span onclick="toggleChat()" style="cursor:pointer">&times;</span>
        </div>
        <div class="chatbot-messages" id="chat-content">
            <div class="bot-msg">Hello! I am your AI assistant. You can ask me anything about our services, aftercare, availability, or rescheduling. How can I help you today?</div>
        </div>
        <div class="chatbot-footer" style="padding: 10px; border-top: 1px solid #ddd; display: flex; background: #fff;">
            <input type="text" id="chat-input" placeholder="Type your question..." style="flex:1; border:none; outline:none; padding: 5px;">
            <button onclick="sendMessage()" style="background:none; border:none; color:#c32143; cursor:pointer;">
                <i class="fa fa-paper-plane"></i>
            </button>
        </div>
    </div>

    <?php include_once('includes/footer.php'); ?>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script>
        function toggleChat() {
            var win = document.getElementById('chatbot-window');
            win.style.display = (win.style.display === 'flex') ? 'none' : 'flex';
        }

        function addMessage(text, type) {
            var content = document.getElementById('chat-content');
            var div = document.createElement('div');
            div.className = type === 'bot' ? 'bot-msg' : 'user-msg';
            div.innerText = text;
            content.appendChild(div);
            content.scrollTop = content.scrollHeight;
        }

        // Logic to send message to your "chat_handler.php"
        async function sendMessage() {
            const input = document.getElementById('chat-input');
            const message = input.value.trim();
            
            if (message === "") return;

            // 1. Show user message
            addMessage(message, 'user');
            input.value = "";

            // 2. Show "Thinking" indicator
            const typingDiv = document.createElement('div');
            typingDiv.className = 'typing';
            typingDiv.id = 'temp-typing';
            typingDiv.innerText = "Garenda is thinking...";
            document.getElementById('chat-content').appendChild(typingDiv);

            try {
                // This will call your offline/online handler
                const response = await fetch('chat_handler.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ message: message })
                });
                
                const data = await response.json();
                
                // Remove thinking indicator and show AI response
                document.getElementById('temp-typing').remove();
                addMessage(data.reply, 'bot');

            } catch (error) {
                document.getElementById('temp-typing').remove();
                addMessage("I'm currently in offline mode. Once the system is live, I'll be able to answer all your questions dynamically!", "bot");
            }
        }

        // Allow "Enter" key to send message
        document.getElementById('chat-input').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    </script>
</body>
</html>