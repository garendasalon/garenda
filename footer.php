<?php
include('includes/dbconnection.php');
error_reporting(0);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('mailer/Exception.php');
require('mailer/PHPMailer.php');
require('mailer/SMTP.php');

if (isset($_POST['sub'])) {
    $email = $_POST['email'];
    $query = mysqli_query($con, "insert into tblsubscriber(Email) value('$email')");
    
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'garenda@gmail.com'; 
        $mail->Password = 'garenda'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('garenda16333@gmail.com', 'Garenda');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Hello Dear; thanks for subscribing our Salon Website!';
        $mail->Body = "Dear Customer, <br><br>We are excited to welcome you to our newsletter community!<br><br>Best regards,<br>GARENDAS salon.";

        $mail->send();
        echo "<script>alert('Thank you for subscribing!')</script>";
    } catch (Exception $e) {
        echo "<script>alert('Error sending mail.')</script>";
    }
}
?>

<style>
    .footer {
        background-image: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url('footer-bg.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        padding: 80px 0 20px 0;
        color: #ffffff;
    }

    .footer .widget-title {
        color: #ffffff;
        font-size: 22px;
        margin-bottom: 20px;
        text-transform: uppercase;
    }

    .footer a { color: #ffffff; text-decoration: none; transition: 0.3s; }
    .footer a:hover { color: #4CAF50; }
    
    .contact-list { list-style: none; padding: 0; }
    .contact-list li { margin-bottom: 15px; display: flex; align-items: center; }
    .contact-list i { margin-right: 15px; color: #4CAF50; }

    .tiny-footer {
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        text-align: center;
        font-size: 13px;
    }
</style>

<div class="footer">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="footer-widget">
                    <h2 class="widget-title">Salon Address</h2>
                    <ul class="contact-list">
                        <li>
                            <i class="fa fa-map-marker"></i> 
                            Poblacion, Getafe, Bohol
                        </li>
                        <li>
                            <i class="fa fa-phone"></i> 
                            <a href="tel:09345678907">09345678907</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope-o"></i> 
                            <a href="mailto:garendasalon@gmail.com">garendasalon@gmail.com</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="footer-widget">
                    <h2 class="widget-title">Social Feed</h2>
                    <ul class="contact-list">
                        <li><a href="#"><i class="fa fa-facebook"></i> Facebook</a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i> LinkedIn</a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i> Instagram</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-5 col-md-5 col-sm-12">
                <div class="footer-widget">
                    <h2 class="widget-title">Newsletters</h2>
                    <p>Get the latest discounts and grooming tips in your inbox.</p>
                    <form method="post">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Email Address" name="email" required>
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="submit" name="sub" style="background-color:#4CAF50; border:none;">Subscribe</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <div class="tiny-footer">
            <p>&copy; 2026 Garenda's Salon Management System || Created by Group HAG</p>
        </div>
    </div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    $('.nav-link-custom').on('mousedown', function() {
        // Remove active class from others and add to the one clicked
        $('.nav-link-custom').removeClass('active');
        $(this).addClass('active');
        
        // Adds a deeper shadow specifically for the "press" moment
        $(this).css('box-shadow', '0 2px 5px rgba(0,0,0,0.2)');
    });
});
</script>