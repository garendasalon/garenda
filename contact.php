<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Garenda's Best Salon Management System || Contact Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700%7cMontserrat:400,700" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    <style>
        .centered-form-container {
            display: flex;
            flex-direction: column;
            align-items: center; 
            width: 100%;
        }
        .form-inner-box {
            width: 100%;
            max-width: 650px; 
            display: flex;
            flex-direction: column;
            align-items: center; 
        }
        .custom-input {
            width: 100% !important;
            height: 50px !important;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 20px;
            background: #f4f4f4;
            border: 1px solid #ddd;
            font-size: 16px;
        }
        .custom-textarea {
            width: 100% !important;
            text-align: center;
            border-radius: 8px;
            background: #f4f4f4;
            border: 1px solid #ddd;
            padding-top: 15px;
            font-size: 16px;
            resize: none;
        }
        .form-label-centered {
            display: block;
            text-align: center;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 8px;
            text-transform: uppercase;
        }
        .btn-submit-small {
            width: auto !important; 
            min-width: 250px; 
            padding: 12px 40px;
            font-size: 16px;
            font-weight: bold;
            background-color: #c32143;
            color: #fff;
            border: none;
            border-radius: 30px;
            letter-spacing: 1px;
            margin-top: 10px;
            transition: 0.3s;
        }
        .btn-submit-small:hover {
            background-color: #a01a36;
            color: #fff;
        }

        /* --- MAP CSS --- */
        .map-container {
            width: 100%;
            height: 450px;
            margin-top: 50px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        /* --- CHATBOT CSS --- */
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
        .bot-msg { background: #eee; align-self: flex-start; }
        .user-msg { background: #c32143; color: white; align-self: flex-end; }
        .typing { font-style: italic; color: #888; font-size: 12px; margin-bottom: 10px; }
    </style>
</head>

<body>
    <?php include_once('includes/header.php');?>
    
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-caption">
                        <h2 class="page-title">Contact us</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="widget widget-contact" style="background: #f9f7f5; padding: 25px; border-radius: 10px;">
                        <?php
                        $ret=mysqli_query($con,"select * from tblpage where PageType='contactus' ");
                        while ($row=mysqli_fetch_array($ret)) {
                        ?>
                        <h3 class="widget-title">GET IN TOUCH <i class="fa fa-address-book"></i></h3>
                        <address>
                            <strong><i class="fa fa-phone"></i> Call/Text:</strong><br><?php echo $row['MobileNumber']; ?><br><br>
                            <strong><i class="fa fa-envelope"></i> Email:</strong><br><a href="mailto:<?php echo $row['Email'];?>" style="color: #c32143;"><?php echo $row['Email'];?></a><br><br>
                            <strong><i class="fa fa-clock-o"></i> Hours:</strong><br><?php echo $row['Timing'];?><br><br>
                            <strong><i class="fa fa-location-arrow"></i> Location:</strong><br><?php echo $row['PageDescription'];?>
                        </address>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="well-block" style="background: transparent; border: none; box-shadow: none;">
                        <h2 style="text-align: center; margin-bottom: 40px; color: #333;">SEND US A MESSAGE</h2>
                        
                        <form action="contact_process.php" method="post" class="centered-form-container">
                            <div class="form-inner-box">
                                <div class="form-group" style="width: 100%;">
                                    <label class="form-label-centered">Name</label>
                                    <input type="text" name="name" class="form-control custom-input" placeholder="Your Full Name" required>
                                </div>
                                <div class="form-group" style="width: 100%;">
                                    <label class="form-label-centered">Topic</label>
                                    <select name="topic" class="form-control custom-input" style="text-align-last: center;">
                                        <option value="Reschedule">Reschedule Appointment</option>
                                        <option value="General Question">General Question</option>
                                        <option value="Pricing">Pricing Question</option>
                                        <option value="Feedback">Feedback</option>
                                    </select>
                                </div>
                                <div class="form-group" style="width: 100%;">
                                    <label class="form-label-centered">Message</label>
                                    <textarea name="message" class="form-control custom-textarea" rows="6" placeholder="How can we help you?" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-default btn-submit-small">SUBMIT MESSAGE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="map-container">
                        <iframe 
                            width="100%" 
                            height="100%" 
                            frameborder="0" 
                            style="border:0" 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15689.658742792823!2d124.36017124314115!3d10.14682054256667!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a9ec15e024f2b9%3A0xc3f8f1704e90892!2sGetafe%2C%20Bohol!5e0!3m2!1sen!2sph!4v1715090000000!5m2!1sen!2sph" 
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once('includes/footer.php');?>

    <div id="chatbot-launcher" onclick="toggleChat()">
        <i class="fa fa-comments"></i>
    </div>

    <div id="chatbot-window">
        <div class="chatbot-header">
            <span>Garenda Salon Assistant</span>
            <span onclick="toggleChat()" style="cursor:pointer">×</span>
        </div>
        <div class="chatbot-messages" id="chat-content">
            <div class="bot-msg">Welcome to our contact page! Need help finding us? I'm here if you have questions.</div>
        </div>
        <div class="chatbot-footer" style="padding: 10px; border-top: 1px solid #ddd; display: flex; background: #fff;">
            <input type="text" id="chat-input" placeholder="Type a message..." style="flex:1; border:none; outline:none; padding: 5px;">
            <button onclick="sendMessage()" style="background:none; border:none; color:#c32143; cursor:pointer;">
                <i class="fa fa-paper-plane"></i>
            </button>
        </div>
    </div>

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

            addMessage(message, 'user');
            input.value = "";

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
                addMessage("I'm having trouble connecting. Feel free to use the form above!", "bot");
            }
        }

        document.getElementById('chat-input').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') sendMessage();
        });
    </script>
</body>
</html>