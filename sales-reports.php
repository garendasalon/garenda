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
    <title>SALON | Sales Reports</title>

    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/font-awesome.css" rel="stylesheet"> 
    
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/modernizr.custom.js"></script>
    
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script>new WOW().init();</script>
    
    <script src="js/metisMenu.min.js"></script>
    <script src="js/custom.js"></script>
    <link href="css/custom.css" rel="stylesheet">

    <style>
        .form-body {
            padding: 2.5em; /* Larger padding for a bigger look */
        }
        .form-group label {
            font-weight: 700;
            color: #4F52BA;
            margin-bottom: 10px;
            font-size: 16px;
        }
        .report-type-container {
            background: #fdfdfd;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #eee;
            margin-top: 25px;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
        }
        .btn-submit {
            background-color: #4F52BA;
            color: white;
            padding: 12px 40px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            margin-top: 25px;
            transition: all 0.3s ease;
        }
        .btn-submit:hover {
            background-color: #3e4095;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .form-control {
            height: 45px; /* Taller input fields */
            border-radius: 4px;
        }
    </style>
</head> 
<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('includes/sidebar.php');?>
        <?php include_once('includes/header.php');?>
        
        <div id="page-wrapper">
            <div class="main-page">
                <div class="forms">
                    <h3 class="title1">Sales Reports</h3>
                    
                    <div class="form-grids row widget-shadow"> 
                        <div class="form-title">
                            <h4>View Sales Performance:</h4>
                        </div>
                        <div class="form-body">
                            <form method="post" name="salesreport" action="sales-reports-detail.php">
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            <label>Report From Date</label> 
                                            <input type="date" class="form-control" name="fromdate" id="fromdate" required='true'> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            <label>Report To Date</label>
                                            <input type="date" class="form-control" name="todate" id="todate" required='true'> 
                                        </div>
                                    </div>
                                </div>

                                <div class="report-type-container">
                                    <div class="form-group" style="margin-bottom:0;"> 
                                        <label style="display: block; margin-bottom: 15px;">Choose Reporting Style</label>
                                        <label class="radio-inline" style="font-size: 15px;">
                                            <input type="radio" name="requesttype" value="mtwise" checked="true"> <strong>Month-wise</strong> (Shows totals by month)
                                        </label>
                                        <label class="radio-inline" style="font-size: 15px; margin-left: 30px;">
                                            <input type="radio" name="requesttype" value="yrwise"> <strong>Year-wise</strong> (Shows totals by year)
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="text-left">
                                    <button type="submit" name="submit" class="btn-submit">Generate Report</button>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php include_once('includes/footer.php');?>
    </div>

    <script src="js/classie.js"></script>
    <script>
        var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
            showLeftPush = document.getElementById( 'showLeftPush' ),
            body = document.body;
            
        showLeftPush.onclick = function() {
            classie.toggle( this, 'active' );
            classie.toggle( body, 'cbp-spmenu-push-toright' );
            classie.toggle( menuLeft, 'cbp-spmenu-open' );
        };
    </script>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/bootstrap.js"> </script>
</body>
</html>
<?php } ?>