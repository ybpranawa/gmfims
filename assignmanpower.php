<?php
session_start();
require 'config/dbconnect.php';
$reqid=$_POST['reqid'];
$username=$_SESSION['username'];
$sql="UPDATE request SET status_request='3' WHERE request_id='".$reqid."'";
$result=mysqli_query($conn,$sql);

if ($_POST['action']=='Reject') {
	$sql="UPDATE request SET status_request='0' WHERE request_id='".$reqid."'";
	$result=mysqli_query($conn,$sql);
	$status=1;
	$pesan="Request has been rejected";
	header("Location: viewrequest.php?status=$status&pesan=$pesan");
}
elseif ($_POST['action']=='Assign') {
	$sql="SELECT * FROM request WHERE request_id='".$reqid."'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);
?>
<!DOCTYPE <!DOCTYPE html>
<html>
<head>
	<?php
	require 'template/header.php';
	?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	<header class="main-header">
		<!-- Logo -->
	    <a href="dashboard.php" class="logo">
	      <!-- mini logo for sidebar mini 50x50 pixels -->
	      <span class="logo-mini"><b>G</b>MF</span>
	      <!-- logo for regular state and mobile devices -->
	      <span class="logo-lg"><b>G </b>M F</span>
	    </a>
	    <nav class="navbar navbar-fixed-top">
	    	<?php
	    	require 'template/topnav.php';
	    	?>
	    </nav>
	</header>

	<?php
	require 'template/sidenav.php';
	?>

	<div class="content-wrapper" style="padding-top: 50px;">
		<section class="content-header">
	      <h1>
	        Assign to Manpower
	        <small>> Assign manpower to requester</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-plus"></i> Provide</a></li>
	        <li class="active">View Assigned Request</li>
	      </ol>
	    </section>
	    <section class="invoice">
	    	<div class="row">
				<div class="col-xs-12">
					<h2 class="page-header">
						<i class="fa fa-globe"></i> Request Summary
						<small class="pull-right">Date: <?php echo date("d-m-Y");?></small>
					</h2>
				</div>
				<!-- /.col -->
			</div>
			<div class="row">
				<div class="col-md-4">
					<h4>Request ID : #<?php echo $row['request_id'];?></h4>
				</div>
			</div>
			<div class="row invoice-info">
				<div class="col-sm-4 invoice-col">
					<b>Requester</b>
					<address>
						<strong><?php echo $row['requester_id'];?></strong><br>
						Station : <br>
						Ujung Pandang, ID 94107<br>
						Phone: (021) 123-5432<br>
						Email: requester@gmf-aeroasia.co.id
					</address>
		        </div>
		        <!-- /.col -->
		        <div class="col-sm-4 invoice-col">
		          	<b>Central Planner</b>
					<address>
						<strong><?php echo $row['centralplanner_id'];?></strong><br>
						Station :<br>
						Cengkareng, ID 94107<br>
						Phone: (021) 539-1037<br>
						Email: centralplanner@gmf-aeroasia.co.id
					</address>
		        </div>
		        <!-- /.col -->
		        <div class="col-sm-4 invoice-col">
		        	<b>Provider</b>
		        	<address>
		        		<strong><?php echo $row['provider_id'];?></strong>
						Station :<br>
						Unit :<br> 
						Cengkareng, ID<br>
						Phone:(021)555-5555<br>
						Email: provider@gmf-aeroasia.co.id
					</address>
		        </div>
		        <!-- /.col -->
			</div>
	    </section>
	</div>

</div>
<?php
require 'template/footer.php';
?>
</body>
</html>

<?php
}
?>