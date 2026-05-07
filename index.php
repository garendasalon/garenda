<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index2.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Garenda's Salon Management System || Home Page</title>
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
        
        /* Added for AI thinking state */
        .typing { font-style: italic; color: #888; font-size: 12px; margin-bottom: 10px; }
    </style>

    </head>

<body>
    <?php include_once('includes/header.php'); ?>

    <div class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h1 class="hero-title">GARENDA'S SALON MANAGEMENT SYSTEM <i class="fa fa-scissors"></i></h1>
                    <p class="hero-text"><strong>YOUR TYPES <i class="fa fa-users"></i> , YOUR STYLE <i class="fa fa-angellist"></i> , YOUR COLOR <i class="fa fa-asterisk"></i> .</strong> </p>
                    <p class="hero-text2"><strong>IN: POBLACION, GETAFE, BOHOL</strong> </p>
                    <a href="appointment.php" class="btn btn-default">Make an Appointment <i class="fa fa-bookmark-o"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="what-we-do" style="padding-top: 60px;">
        <div class="container">
            <h2>What We Do</h2>
            <ul>
                <li> <i class="fa fa-check-circle-o"></i> <b>Haircuts:</b> Our stylists and barbers are experts in haircuts, from classic cuts to modern styles.</li>
                <li> <i class="fa fa-check-circle-o"></i><b> Beard and Mustache Grooming: </b> Our barbers have the skills to help you achieve the perfect look.</li>
                <li> <i class="fa fa-check-circle-o"></i> <b>Shaves:</b> We use the latest techniques and premium products for the smoothest shave possible.</li>
                <li> <i class="fa fa-check-circle-o"></i> <b>Coloring:</b> Our stylists can help you achieve the perfect hair color to suit your personality.</li>
                <li> <i class="fa fa-check-circle-o"></i><b> Styling: </b>From special occasions to everyday looks, we ensure your hair looks great all day.</li>
            </ul>
        </div>
    </div>
    <section id="why-choose">
        <div class="container">
            <h2 class="section-title">Why Choose Us?</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="why-choose-item">
                        <i class="fa fa-scissors"></i>
                        <h3>Experienced Stylists</h3>
                        <p>Our stylists have years of experience and are always up-to-date with the latest trends.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="why-choose-item">
                        <i class="fa fa-trophy"></i>
                        <h3>Quality Service</h3>
                        <p>We pride ourselves on top-notch service ensuring every customer leaves feeling great.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="why-choose-item">
                        <i class="fa fa-money"></i>
                        <h3>Affordable Prices</h3>
                        <p>Our prices are competitive and we offer a variety of packages to fit your budget.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="services">
        <div class="container">
            <h2>Our Services</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="service">
                        <img src="images/hair.jpg" alt="Haircut">
                        <h3>Haircut <i class="fa fa-scissors"></i> </h3>
                        <p>Expert haircuts from classic cuts to modern styles tailored to you.</p>
                        <a href="service-list.php" class="btn">View More <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service">
                        <img src="images/color.jpeg" alt="Color">
                        <h3>Color <i class="fa fa-adjust"></i> </h3>
                        <p>Achieve the perfect hair color to suit your style and personality.</p>
                        <a href="service-list.php" class="btn">View More <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service">
                        <img src="images/styling.jpeg" alt="Styling">
                        <h3>Styling <i class="fa fa-hand-peace-o"></i></h3>
                        <p>Perfect styling for special occasions or everyday looks using latest techniques.</p>
                        <a href="service-list.php" class="btn">View More <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="gallery">
        <div class="container text-center">
            <h2>Photo Gallery</h2>
            <div class="gallery-container">
                <img src="images/color.jpeg" alt="Photo 1">
                <img src="images/C2.jpeg" alt="Photo 2">
                <img src="images/rebond.jpeg" alt="Photo 3">
                <img src="images/styling.jpeg" alt="Photo 4">
                <img src="images/portfolio-4.jpg" alt="Photo 5">
                <img src="images/portfolio-5.jpg" alt="Photo 6">
            </div>
        </div>
    </section>

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
            <div class="bot-msg">Welcome to Garenda's! How can I help you style your look today? Feel free to ask about aftercare, pricing, or rescheduling.</div>
        </div>
        <div class="chatbot-footer" style="padding: 10px; border-top: 1px solid #ddd; display: flex; background: #fff;">
            <input type="text" id="chat-input" placeholder="Ask me anything..." style="flex:1; border:none; outline:none; padding: 5px;">
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
            typingDiv.innerText = "Garenda is thinking...";
            document.getElementById('chat-content').appendChild(typingDiv);

            try {
                // Call the chat handler (same one used in appointment.php)
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
                addMessage("I'm currently in offline mode. Once the system is live, I'll be able to answer your questions about aftercare, pricing, and availability!", "bot");
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