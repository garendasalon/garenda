<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>SALON || Customer List</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
    <script>
         new WOW().init();
    </script>
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">

<style>
    .table-header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding: 10px;
    }
    .search-box {
        width: 300px;
    }
    /* Styling buttons to ensure they fit in one column */
    .btn-action {
        margin: 2px;
        padding: 4px 8px;
        font-size: 11px;
    }
    .table td {
        vertical-align: middle !important;
    }
</style>
</head> 
<body class="cbp-spmenu-push">
    <div class="main-content">
        <?php include_once('includes/sidebar.php');?>
        <?php include_once('includes/header.php');?>
        
        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                    <h3 class="title1">Customer List</h3>
                    
                    <div class="table-responsive bs-example widget-shadow">
                        <div class="table-header-container">
                            <h4>Customer Database:</h4>
                            <div class="search-box">
                                <div class="input-group">
                                    <input type="text" id="search" class="form-control" placeholder="Search by name or number...">
                                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                        </div>

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Apt_Number</th>
                                    <th>Mobile</th>
                                    <th>Creation Date</th>
                                    <th width="350">Action</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret=mysqli_query($con,"select * from tblcustomers");
                                $cnt=1;
                                while ($row=mysqli_fetch_array($ret)) {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $cnt;?></th>
                                    <td><?php echo $row['Name'];?></td>
                                    <td><?php echo $row['AptNumber'];?></td>
                                    <td><?php echo $row['MobileNumber'];?></td>
                                    <td><?php echo $row['CreationDate'];?></td>
                                    <td>
                                        <a href="edit-customer-detailed.php?editid=<?php echo $row['ID'];?>" class="btn btn-primary btn-action"><i class="fa fa-edit"></i> Edit</a>
                                        
                                        <a href="add-customer-services.php?addid=<?php echo $row['ID'];?>" class="btn btn-info btn-action"><i class="fa fa-plus"></i> Assign Service</a>
                                        
                                        <a href="view-customer-details.php?viewid=<?php echo $row['ID'];?>" class="btn btn-success btn-action"><i class="fa fa-eye"></i> View</a>
                                        
                                        <a href="delete-customer.php?deleteid=<?php echo $row['ID'];?>" class="btn btn-danger btn-action" onclick="return confirm('Are you sure you want to delete this customer?')"><i class="fa fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                                <?php 
                                $cnt=$cnt+1;
                                }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once('includes/footer.php');?>
    </div>

    <script>
        $(document).ready(function(){
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("table tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

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