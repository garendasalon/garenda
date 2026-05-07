<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Admin Dashboard | Garenda's Salon Management System</title>

    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/font-awesome.css" rel="stylesheet"> 
    
    <style>
        .widget {
            margin-bottom: 30px;
        }
        
        /* Constant Black for the Title side */
        .stats-left {
            width: 70%;
            float: left;
            padding: 35px 20px;
            min-height: 170px;
            border-radius: 10px 0 0 10px;
            background-color: #111111; /* Constant Black */
        }
        
        /* Constant Pink for the Number side */
        .stats-right {
            width: 30%;
            float: left;
            background-color: #e91e63; /* Constant Pink */
            padding: 35px 10px;
            min-height: 170px;
            text-align: center;
            border-radius: 0 10px 10px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e91e63;
        }
        
        .stats-left h5 {
            color: #fff;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 15px;
            opacity: 0.8;
        }
        
        .stats-left h4 {
            color: #fff;
            font-size: 24px;
            font-weight: 700;
        }
        
        /* Constant Black for the Place Number */
        .stats-right label {
            font-size: 28px; 
            color: #000000;  /* Pure Black Number */
            font-weight: 900;
            margin: 0;
        }

        #page-wrapper {
            padding: 2em 2em;
            background-color: #f4f4f4;
        }
    </style>

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/modernizr.custom.js"></script>
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script>new WOW().init();</script>
    <script src="js/metisMenu.min.js"></script>
    <script src="js/custom.js"></script>
    <link href="css/custom.css" rel="stylesheet">
</head> 
<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('includes/sidebar.php');?>
        <?php include_once('includes/header.php');?>
        
        <div id="page-wrapper">
            <div class="main-page">
                
                <div class="row">
                    <div class="col-md-3 widget">
                        <?php $q1=mysqli_query($con,"Select * from tblcustomers"); $t_cust=mysqli_num_rows($q1); ?>
                        <div class="stats-left">
                            <h5>Total</h5>
                            <h4>Customers</h4>
                        </div>
                        <div class="stats-right">
                            <label><?php echo $t_cust; ?></label>
                        </div>
                        <div class="clearfix"> </div>
                    </div>

                    <div class="col-md-3 widget">
                        <?php $q3=mysqli_query($con,"Select * from tblservices"); $t_serv=mysqli_num_rows($q3); ?>
                        <div class="stats-left">
                            <h5>Total</h5>
                            <h4>Services</h4>
                        </div>
                        <div class="stats-right">
                            <label><?php echo $t_serv; ?></label>
                        </div>
                        <div class="clearfix"> </div>
                    </div>

                    <div class="col-md-3 widget">
                        <?php 
                        $tday_s = 0;
                        $q4=mysqli_query($con,"SELECT tblservices.Cost FROM tblinvoice JOIN tblservices ON tblservices.ID=tblinvoice.ServiceId WHERE DATE(PostingDate)=CURDATE()");
                        while($r4=mysqli_fetch_array($q4)){ $tday_s += $r4['Cost']; } 
                        ?>
                        <div class="stats-left">
                            <h5>Today</h5>
                            <h4>Sales</h4>
                        </div>
                        <div class="stats-right">
                            <label><?php echo number_format($tday_s); ?></label>
                        </div>
                        <div class="clearfix"> </div>
                    </div>

                    <div class="col-md-3 widget">
                        <?php 
                        $total_s = 0;
                        $q6=mysqli_query($con,"SELECT tblservices.Cost FROM tblinvoice JOIN tblservices ON tblservices.ID=tblinvoice.ServiceId");
                        while($r6=mysqli_fetch_array($q6)){ $total_s += $r6['Cost']; } 
                        ?>
                        <div class="stats-left">
                            <h5>Grand Total</h5>
                            <h4>Sales</h4>
                        </div>
                        <div class="stats-right">
                            <label><?php echo number_format($total_s); ?></label>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>

                <div class="clearfix"> </div>
            </div>
        </div>

        <?php include_once('includes/footer.php');?>
    </div>

    <script src="js/classie.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/bootstrap.js"> </script>
</body>
</html>
<?php } ?>