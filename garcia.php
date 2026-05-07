<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid'] == 0)) {
	header('location:logout.php');
} else {
  if (isset($_GET['viewid'])) {
    $viewid = $_GET['viewid'];
    // die($viewid);
    $query = mysqli_query($con, "SELECT * FROM tblcustomers WHERE ID='$viewid'");
    if (mysqli_num_rows($query) > 0) {
      $row = mysqli_fetch_array($query);
      $namett = $row['Name'];
      $email = $row['Email'];
      $mobileNumber = $row['MobileNumber'];
      $gender = $row['Gender'];
      $details = $row['Details'];
      $date = $row['app_date'];
      $time = $row['app_time'];
      $creationDate = $row['CreationDate'];
    } else {
      header('location:manage-customers.php');
      exit();
    }
  } else {
    header('location:manage-customers.php');
    exit();
  }
}
?>

<!DOCTYPE HTML>
<html>

<head>
  <title>SALON|| Customer Details</title>
  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
  <!-- Custom CSS -->
  <link href="css/style.css" rel='stylesheet' type='text/css' />
  <!-- font-awesome icons -->
  <link href="css/font-awesome.css" rel="stylesheet">
  <!-- //font-awesome icons -->
  <!-- font CSS -->
  <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic'
    rel='stylesheet' type='text/css'>
  <!-- //font CSS -->
  <!-- jQuery -->
  <script src="js/jquery-1.10.2.min.js"></script>
  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>
</head>

<body class="cbp-spmenu-push">
  <div class="main-content">
    <?php include_once('includes/sidebar.php'); ?>
    <?php include_once('includes/header.php'); ?>
    <div id="page-wrapper">
      <div class="main-page">
        <div class="widget-shadow">
          <div class="form-group">
            <table class="table">
              <tr>
                <th>Name</th>
                <td>
                  <?php echo $namett; ?>
                </td>
              </tr>
              <tr>
                <th>Email</th>
                <td>
                  <?php echo $email; ?>
                </td>
              </tr>
              <tr>
                <th>Mobile Number</th>
                <td>
                  <?php echo $mobileNumber; ?>
                </td>
              </tr>
              <tr>
                <th>Gender</th>
                <td>
                  <?php echo $gender; ?>
                </td>
              </tr>
              <tr>
                <th>Service</th>
                <td>
                  <?php echo $details; ?>
                </td>
              </tr>
              <tr>
                <th>Date</th>
                <td>
                  <?php echo $date; ?>
                </td>
              </tr>              <tr>
                <th>Time</th>
                <td>
                  <?php echo $time; ?>
                </td>
              </tr>
              <tr>
                <th>Creation Date</th>
                <td>
                  <?php echo $creationDate; ?>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

<style>
  .form-group {
    margin-left: 18px;
    margin-top: 78px;
  }
</style>
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
		<title>SALON | Invoice</title>

		<script
			type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
		<!-- Custom CSS -->
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<!-- font CSS -->
		<!-- font-awesome icons -->
		<link href="css/font-awesome.css" rel="stylesheet">
		<!-- //font-awesome icons -->
		<!-- js-->
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/modernizr.custom.js"></script>
		<!--webfonts-->
		<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic'
			rel='stylesheet' type='text/css'>
		<!--//webfonts-->
		<!--animate-->
		<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
		<script src="js/wow.min.js"></script>
		<script>
			new WOW().init();
		</script>
		<!--//end-animate-->
		<!-- Metis Menu -->
		<script src="js/metisMenu.min.js"></script>
		<script src="js/custom.js"></script>
		<link href="css/custom.css" rel="stylesheet">
		<!--//Metis Menu -->
	</head>

	<body class="cbp-spmenu-push">
		<div class="main-content">
			<!--left-fixed -navigation-->
			<?php include_once('includes/sidebar.php'); ?>
			<!--left-fixed -navigation-->
			<!-- header-starts -->
			<?php include_once('includes/header.php'); ?>
			<!-- //header-ends -->
			<!-- main content start-->
			<div id="page-wrapper">
				<div class="main-page">
					<div class="tables">
						<h3 class="title1">Invoice List</h3>



						<div class="table-responsive bs-example widget-shadow">
							<h4>Invoice List:</h4>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>S.No</th>
										<th>Invoice Id</th>
										<th>Customer Name</th>
										<th>Invoice Date</th>
										<th>View Invoice</th>
										<th>Delete Invoice</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$ret = mysqli_query($con, "select distinct tblcustomers.Name,tblinvoice.BillingId,tblinvoice.PostingDate from  tblcustomers   
	join tblinvoice on tblcustomers.ID=tblinvoice.Userid  order by tblinvoice.ID desc");
									$cnt = 1;
									while ($row = mysqli_fetch_array($ret)) {
										?>

										<tr>
											<th scope="row">
												<?php echo $cnt; ?>
											</th>
											<td>
												<?php echo $row['BillingId']; ?>
											</td>
											<td>
												<?php echo $row['Name']; ?>
											</td>
											<td>
												<?php echo $row['PostingDate']; ?>
											</td>
											<td><a href="view-invoice.php?invoiceid=<?php echo $row['BillingId']; ?>">View</a>
											</td>
											<td>
  <a href="delete-invoice.php?invoiceid=<?php echo $row['BillingId']; ?>" onclick="return confirm('Are you sure you want to delete this invoice?')">Delete</a>
</td>

										</tr>
										<?php
										$cnt = $cnt + 1;
									} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!--footer-->
			<?php include_once('includes/footer.php'); ?>
			<!--//footer-->
		</div>
		<!-- Classie -->
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById('cbp-spmenu-s1'),
				showLeftPush = document.getElementById('showLeftPush'),
				body = document.body;

			showLeftPush.onclick = function () {
				classie.toggle(this, 'active');
				classie.toggle(body, 'cbp-spmenu-push-toright');
				classie.toggle(menuLeft, 'cbp-spmenu-open');
				disableOther('showLeftPush');
			};

			function disableOther(button) {
				if (button !== 'showLeftPush') {
					classie.toggle(showLeftPush, 'disabled');
				}
			}
		</script>
		<!--scrolling js-->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<!--//scrolling js-->
		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.js"> </script>
	</body>

	</html>
<?php } ?>