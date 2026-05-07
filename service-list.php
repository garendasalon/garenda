<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Garenda's Best Salon Management System || Service List</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i%7cMontserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    <style>
        .service-table img {
            width: 100px; /* Set a standard width */
            height: 70px; /* Set a standard height */
            object-fit: cover; /* Ensure image covers the area without stretching */
            border-radius: 5px; /* Optional: adds rounded corners */
            border: 1px solid #ddd; /* Optional: adds a subtle border */
        }
        
        /* Ensure table content is vertically centered */
        .service-table td, .service-table th {
            vertical-align: middle !important;
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
        
        /* AI Thinking Animation */
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
                        <h2 class="page-title">Salon Service</h2>
                        <div class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li class="active">services</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-10 heading-section text-center ftco-animate" style="padding-bottom: 20px;">
                    <h2 class="servicess">Our Service Prices</h2>
                </div>
                
                <table class="table table-bordered service-table">
                    <thead>
                        <tr>
                            <th>S.Number <i class="fa fa-list-ol"></i></th>
                            <th>Service Image <i class="fa fa-picture-o"></i></th>
                            <th>Service Name <i class="fa fa-child"></i></th>
                            <th>Service Price <i class="fa fa-money"></i></th>
                            <th>Service Description <br> <i class="fa fa-align-justify"></i></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ret = mysqli_query($con, "select * from tblservices");
                        $cnt = 1;
                        while ($row = mysqli_fetch_array($ret)) {
                            $imageName = strtolower($row['ServiceName']) . ".jpg";
                            $imagePath = "images/" . $imageName;
                            $defaultImage = "images/default-service.jpg"; 
                            $displayImage = (file_exists($imagePath)) ? $imagePath : $defaultImage;
                        ?>
                            <tr>
                                <th scope="row"><?php echo $cnt; ?></th>
                                <td><img src="<?php echo $displayImage; ?>" alt="<?php echo $row['ServiceName']; ?>"></td>
                                <td><?php echo $row['ServiceName']; ?></td>
                                <td>₱<?php echo $row['Cost']; ?></td>
                                <td><?php echo $row['Description']; ?></td>
                            </tr>
                        <?php
                            $cnt = $cnt + 1;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="space-small bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-7 col-md-8 col-xs-12">
                    <h1 class="cta-title">Book your online Appointment</h1>
                </div>
                <div class="col-lg-4 col-sm-5 col-md-4 col-xs-12">
                    <a href="appointment.php" class="btn btn-white btn-lg mt20">Book Appointment <i class="fa fa-bookmark-o"></i></a>
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
            <div class="bot-msg">Browsing our services? I can recommend the best package for your hair type! Ask me about our prices or treatments.</div>
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
                addMessage("I'm having trouble connecting right now. You can check our price list above or book an appointment directly!", "bot");
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