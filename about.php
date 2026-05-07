<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Garenda's Salon Management System || About Us</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i%7cMontserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
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
        
        /* Thinking state */
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
                        <h2 class="page-title">About Us</h2>
                        <div class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li class="active">About Us</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="space-medium bg-default">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <img src="images/C2.jpeg" alt="Garenda's Salon" class="img-responsive">
                </div>
                
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    <div class="well-block">
                        <?php
                        $ret = mysqli_query($con, "select * from tblpage where PageType='aboutus' ");
                        while ($row = mysqli_fetch_array($ret)) {
                        ?>
                            <h1><?php echo $row['PageTitle']; ?></h1>
                            <h5 class="small-title">Best Experience Ever in Getafe, Bohol</h5>
                            
                            <p><strong>Garenda's Salon</strong> is your go-to destination for professional hair and grooming services. We provide high-quality haircuts, styling, and treatments to make you look and feel your best.</p>
                            
                            <hr>

                            <h3>Our Mission</h3>
                            <p>To deliver excellent salon services using the best products and techniques, ensuring every client leaves happy and confident.</p>

                            <h3>Our Vision</h3>
                            <p>To be the most trusted and innovative salon in Bohol, known for quality, style, and great customer care.</p>
                            
                        <?php } ?>
                    </div>
                </div>
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
            <div class="bot-msg">Welcome to Garenda's! Would you like to know more about our mission or our specific salon policies? I'm here to help!</div>
        </div>
        <div class="chatbot-footer" style="padding: 10px; border-top: 1px solid #ddd; display: flex; background: #fff;">
            <input type="text" id="chat-input" placeholder="Ask a question..." style="flex:1; border:none; outline:none; padding: 5px;">
            <button onclick="sendMessage()" style="background:none; border:none; color:#c32143; cursor:pointer;">
                <i class="fa fa-paper-plane"></i>
            </button>
        </div>
    </div>

    <?php include_once('includes/footer.php'); ?>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/menumaker.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/sticky-header.js"></script>

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

        async function sendMessage() {
            const input = document.getElementById('chat-input');
            const message = input.value.trim();
            
            if (message === "") return;

            // Show user message
            addMessage(message, 'user');
            input.value = "";

            // Show Thinking indicator
            const typingDiv = document.createElement('div');
            typingDiv.className = 'typing';
            typingDiv.id = 'temp-typing';
            typingDiv.innerText = "Garenda is checking...";
            document.getElementById('chat-content').appendChild(typingDiv);

            try {
                // Connect to the common chat logic file
                const response = await fetch('chat_handler.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ message: message })
                });
                
                const data = await response.json();
                
                document.getElementById('temp-typing').remove();
                addMessage(data.reply, 'bot');

            } catch (error) {
                document.getElementById('temp-typing').remove();
                addMessage("I'm currently in offline mode. Once online, I can answer your questions about Garenda's history and services!", "bot");
            }
        }

        // Allow "Enter" key to send
        document.getElementById('chat-input').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    </script>
</body>
</html>