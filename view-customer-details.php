<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
    $viewid = intval($_GET['viewid']);

    // 1. Fetch Customer Details
    $cust_query = mysqli_query($con, "SELECT * FROM tblcustomers WHERE ID='$viewid'");
    $cust_data = mysqli_fetch_array($cust_query);

    // 2. Fetch the Invoice Metadata (Billing ID and Date)
    $inv_meta_query = mysqli_query($con, "SELECT BillingId, PostingDate FROM tblinvoice WHERE Userid='$viewid' LIMIT 1");
    $inv_meta = mysqli_fetch_array($inv_meta_query);
    $billingId = $inv_meta['BillingId'];

    // 3. Fetch Itemized Services
    $invoice_items = mysqli_query($con, "
        SELECT tblservices.ServiceName, tblservices.Cost 
        FROM tblinvoice 
        JOIN tblservices ON tblservices.ID = tblinvoice.ServiceId 
        WHERE tblinvoice.Userid='$viewid'
    ");
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Receipt - <?php echo $cust_data['Name']; ?></title>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/font-awesome.css" rel="stylesheet"> 
    
    <style>
        body { background-color: #f8f9fa; font-family: 'Roboto', sans-serif; }
        .receipt-container {
            background: #fff;
            padding: 40px;
            margin: 30px auto;
            max-width: 850px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-top: 5px solid #e91e63;
        }
        .receipt-header { border-bottom: 2px solid #eee; padding-bottom: 20px; margin-bottom: 30px; }
        .parlor-logo { font-size: 24px; font-weight: bold; color: #111; text-transform: uppercase; }
        .table thead th { background: #f4f4f4; border-bottom: none; color: #333; }
        .total-section { width: 100%; margin-top: 10px; }
        .total-row { display: flex; justify-content: space-between; padding: 10px 0; }
        .grand-total { font-size: 20px; font-weight: bold; border-top: 2px solid #333; padding-top: 15px; color: #e91e63; }
        
        @media print {
            .no-print, .sidebar, .header-section, #showLeftPush { display: none !important; }
            .main-content { margin: 0 !important; padding: 0 !important; width: 100%; }
            #page-wrapper { margin: 0 !important; padding: 0 !important; }
            .receipt-container { box-shadow: none; border: none; margin: 0; width: 100%; }
            body { background: #fff; }
        }
    </style>
</head>
<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('includes/sidebar.php'); ?>
        <?php include_once('includes/header.php'); ?>
        
        <div id="page-wrapper">
            <div class="main-page">
                <div class="receipt-container">
                    
                    <div class="receipt-header">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="parlor-logo">Garenda's Salon</div>
                                <p>Poblacion, Getafe, Bohol<br>
                                Contact: 09661640377<br>
                                Email: garendasalon@gmail.com</p>
                            </div>
                            <div class="col-xs-6 text-right">
                                <h2 style="margin-top:0; font-weight: 900;">RECEIPT</h2>
                                <p><strong>Invoice #:</strong> <?php echo ($billingId ? $billingId : "N/A"); ?><br>
                                <strong>Date:</strong> <?php echo date("d M Y", strtotime($inv_meta['PostingDate'])); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 30px;">
                        <div class="col-xs-12">
                            <h5 style="border-bottom: 1px solid #ddd; padding-bottom: 5px;"><strong>CLIENT DETAILS:</strong></h5>
                            <p>
                                <strong>Name:</strong> <?php echo $cust_data['Name']; ?><br>
                                <strong>Email:</strong> <?php echo $cust_data['Email']; ?><br>
                                <strong>Mobile:</strong> <?php echo $cust_data['MobileNumber']; ?>
                            </p>
                        </div>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="10%">#</th>
                                <th>Service Description</th>
                                <th width="25%" class="text-right">Price (₱)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $cnt = 1;
                            $total = 0;
                            while ($row_items = mysqli_fetch_array($invoice_items)) {
                            ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $row_items['ServiceName']; ?></td>
                                <td class="text-right"><?php echo number_format($row_items['Cost'], 2); ?></td>
                            </tr>
                            <?php 
                                $total += $row_items['Cost'];
                                $cnt++; 
                            } 
                            ?>
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-xs-6">
                            <p class="text-muted" style="margin-top: 20px; font-style: italic;">
                                <strong>Note:</strong> This is a computer-generated receipt.<br>
                                Thank you for choosing Garenda's Salon!
                            </p>
                        </div>
                        <div class="col-xs-6">
                            <div class="total-section">
                                <div class="total-row grand-total">
                                    <span>Total Amount Paid</span>
                                    <span>₱<?php echo number_format($total, 2); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="no-print text-center" style="margin-top: 50px;">
                        <hr>
                        <button onclick="window.print()" class="btn btn-danger btn-lg" style="background-color: #e91e63; border: none;">
                            <i class="fa fa-print"></i> Print Receipt
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="js/classie.js"></script>
    <script src="js/bootstrap.js"> </script>
</body>
</html>
<?php } ?>