<!DOCTYPE html>
<html lang="en">
<head>
    <title>Garenda's Best Salon Management System || Announcement Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i%7cMontserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include_once('includes/header.php'); ?>
    
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-caption">
                        <h2 class="page-title">Announcement</h2>
                        <div class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li class="active">Announcement</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="message-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Announcement from Admin</h2>
                            <div class="message-content">
                                <?php
                                $file = 'admin/message.txt';
                                if (file_exists($file)) {
                                    $message = file_get_contents($file);
                                    echo "<p>$message</p>";
                                } else {
                                    echo "<p>No announcement to display.</p>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        body {
            background-color: #f5f5f5;
        }

        .page-header {
            background-color: #007bff;
            color: #fff;
            padding: 20px 0;
        }

        .page-caption {
            text-align: center;
        }

        .page-title {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .breadcrumb {
            background-color: transparent;
            font-size: 18px;
        }

        .breadcrumb li a {
            color: #fff;
            transition: all 0.2s ease;
        }

        .breadcrumb li.active {
            color: #fff;
        }

        .card {
            background-color: #fff;
            border: none;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin: 0 auto;
            max-width: 809px;
            padding: 40px;
            text-align: center;
            transition: all 0.2s ease;
            margin-top: 48px;
            margin-left: 339px;
            margin-right: -59px;
            margin-bottom: 42px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
        }

        .card-title {
            color: #007bff;
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 30px;
            transition: all 0.2s ease;
        }

        .message-content {
            font-size: 20px;
            line-height: 1.5;
            margin-top: 20px;
        }

        .message-content p {
            margin-bottom: 0;
            margin-left: 15px;
            color: #ff0000;
            font-weight: 390;
        }

        @media screen and (max-width: 767px) {
            .card {
                margin-left: auto;
                margin-right: auto;
                padding: 20px;
            }
            .card-title {
                font-size: 20px;
            }
        }

        /* --- CHATBOT DESIGN --- */
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
        .bot-msg { background: #eee; align-self: flex-start; color: #333; text-align: left; }
        .user-msg { background: #c32143; color: white; align-self: flex-end; }
        
        .typing { font-style: italic; color: #888; font-size: 12px; margin-bottom: 10px; }
    </style>

    <div id="chatbot-launcher" onclick="toggleChat()">
        <i class="fa fa-comments"></i>
    </div>

    <div id="chatbot-window">
        <div class="chatbot-header">
            <span>Garenda Salon Assistant</span>
            <span onclick="toggleChat()" style="cursor:pointer">&times;</span>
        </div>
        <div class="chatbot-messages" id="chat-content">
            <div class="bot-msg">Welcome! Did you check our latest announcements? I can help you with bookings or answer questions about our latest news.</div>
        </div>
        <div class="chatbot-footer" style="padding: 10px; border-top: 1px solid #ddd; display: flex; background: #fff;">
            <input type="text" id="chat-input" placeholder="Type a message..." style="flex:1; border:none; outline:none; padding: 5px;">
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

        async function sendMessage() {
            const input = document.getElementById('chat-input');
            const message = input.value.trim();
            
            if (message === "") return;

            addMessage(message, 'user');
            input.value = "";

            // Show Thinking state
            const typingDiv = document.createElement('div');
            typingDiv.className = 'typing';
            typingDiv.id = 'temp-typing';
            typingDiv.innerText = "Garenda is typing...";
            document.getElementById('chat-content').appendChild(typingDiv);

            try {
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
                addMessage("I'm having trouble connecting to the server. Please check the announcement board above for urgent updates!", "bot");
            }
        }

        // Allow Enter key to send
        document.getElementById('chat-input').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    </script>
</body>
</html>