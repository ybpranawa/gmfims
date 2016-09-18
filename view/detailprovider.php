<?php
session_start();
if (isset($_SESSION['username'])) {
	
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	require '../config/dbconnect.php';
	require '../template/header.php';
	?>
	<script type="text/javascript">

	</script>
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
	    	require '../template/topnav.php';
	    	?>
	    </nav>
	</header>
	<?php
	require '../template/sidenav.php';
	$reqid=$_POST['reqid'];
	$sql="SELECT * FROM request JOIN request_qualification ON request.`request_id`=request_qualification.`request_id` JOIN status_request ON status_request.`status_id`=request.`status_request` WHERE request.`request_id`='".$reqid."'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);
	$start=$row['start_date'];
	$end=$row['finish_date'];
	?>
	<div class="content-wrapper" style="padding-top: 50px;">
		<section class="content-header">
			<h1>
				Request Detail
				<small><?php echo "#".$row['request_id'];?></small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Request</a></li>
				<li><a href="#">History</a></li>
			</ol>
		</section>
		<section class="invoice">
			<div class="row">
				<div class="col-md-12">
					<h2 class="page-header">
						<i class="fa fa-globe"></i> Request #<?php echo $row['request_id'];?>
						<small class="pull-right">Date: <?php echo date("Y-m-d",strtotime($row['request_date']));?></small>
					</h2>
				</div>
			</div>
			<?php
			$sql2="SELECT * FROM personil JOIN request ON personil.`personil_id`=request.`requester_id` JOIN personil_detail ON personil.`personil_id`=personil_detail.`personil_id` WHERE request.`request_id`='".$reqid."'";
			$result2=mysqli_query($conn,$sql2);
			$row2=mysqli_fetch_array($result2);
			?>
			<div class="row invoice-info">
		        <div class="col-sm-3 invoice-col">
		          Requester
		          <address>
		            <strong><?php echo $row2['personil_name'];?></strong><br>
		            <?php echo $row2['personil_unit'];?><br>
		            <?php echo $row2['personil_station'];?><br>
		            <?php echo $row2['personil_contact'];?><br>
		            <?php echo $row2['personil_email'];?>
		          </address>
		        </div>
		        <?php
				$sql2="SELECT * FROM personil JOIN request ON personil.`personil_id`=request.`centralplanner_id` JOIN personil_detail ON personil.`personil_id`=personil_detail.`personil_id` WHERE request.`request_id`='".$reqid."'";
				$result2=mysqli_query($conn,$sql2);
				$row2=mysqli_fetch_array($result2);
				?>
		        <!-- /.col -->
		        <div class="col-sm-3 invoice-col">
		          Central Planner
		          <address>
		            <strong><?php echo $row2['personil_name'];?></strong><br>
		            <?php echo $row2['personil_unit'];?><br>
		            <?php echo $row2['personil_station'];?><br>
		            <?php echo $row2['personil_contact'];?><br>
		            <?php echo $row2['personil_email'];?>
		          </address>
		        </div>
		        <?php
				$sql2="SELECT * FROM personil JOIN request ON personil.`personil_id`=request.`Provider_id` JOIN personil_detail ON personil.`personil_id`=personil_detail.`personil_id` WHERE request.`request_id`='".$reqid."'";
				$result2=mysqli_query($conn,$sql2);
				$row2=mysqli_fetch_array($result2);
				?>
		        <!-- /.col -->
		        <div class="col-sm-3 invoice-col">
		          Provider
		          <address>
		            <strong><?php echo $row2['personil_name'];?></strong><br>
		            <?php echo $row2['personil_unit'];?><br>
		            <?php echo $row2['personil_station'];?><br>
		            <?php echo $row2['personil_contact'];?><br>
		            <?php echo $row2['personil_email'];?>
		          </address>
		        </div>
		        <!-- /.col -->
		        <div class="col-sm-3 invoice-col">
		          <b>Request #<?php echo $reqid;?></b><br>
		          <br>
		          <b>Request ID:</b> <?php echo $reqid;?><br>
		          <b>Request Date:</b> <?php echo date("Y-m-d",strtotime($row['request_date']));?><br>
		          <b>Accepted Date:</b> <?php echo date("Y-m-d",strtotime($row['approved_date']));?></br>
		        </div>
		        <!-- /.col -->
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-md-12 table-responsive">
					<table class="table table-striped">
						<thead>
							<tr valign="top">
								<th rowspan="2" valign="center">Req Detail No.</th>
								<th rowspan="2">Aircraft Type</th>
								<th rowspan="2">Qualification</th>
								<th rowspan="2">Rating</th>
								<th colspan="2">Manpower Sent</th>
								<th rowspan="2">Note</th>
							</tr>
							<tr>
								<th>Emp ID</th>
								<th>Name</th>
								
							</tr>
						</thead>
						<tbody>
							<?php
							$sql="SELECT request.*, request_qualification.*, qualification.*, rating.*, personil.`personil_id`, personil.`personil_name` FROM request JOIN request_qualification ON request.`request_id`=request_qualification.`request_id` JOIN qualification ON qualification.`qualification_id`=request_qualification.`qualification_id` JOIN rating ON rating.`rating_id`=request_qualification.`rating_id` JOIN personil ON personil.`personil_id`=request_qualification.`personilsent_id` WHERE request.`request_id`='".$reqid."'";
							$result=mysqli_query($conn,$sql);
							while ($rows=mysqli_fetch_array($result)) {
								?>
								<tr>
									<td><?php echo $rows['rq_id'];?></td>
									<td><?php echo $rows['pesawat_id'];?></td>
									<td><?php echo $rows['qualification_code'];?></td>
									<td><?php echo $rows['rating_code'];?></td>
									<td><?php echo $rows['personil_id'];?></td>
									<td><?php echo $rows['personil_name'];?></td>
									<td><?php echo $rows['rq_note'];?></td>
								</tr>
								<?php
							}
							?>
						</tbody>

					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<p class="lead">Schedule:</p>
					<div class="col-md-6">
						<p>Start: <?php echo date("Y-m-d",strtotime($start));?></p>
					</div>
					<div class="col-md-6">
						<p>End: <?php echo date("Y-m-d",strtotime($end));?></p>
					</div>
					<div class="col-md-12">
						 <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
				           This document contains detail or summary for request number #<?php echo $reqid;?>. To edit the request, please click on menu beside before this document has been printed.
				          </p>
					</div>
				</div>

				<div class="col-md-6">
					<p class="lead">Summary:</p>
					<div class="table-responsive">
						<table class="table">
							<tr>
								<th style="width:50%;">Total Request</th>
								<td><?php echo $row['request_total'];?></td>
							</tr>
							<tr>
								<th>Status</th>
								<td><?php echo $row['status_desc'];?></td>
							</tr>
							<tr>
								<th>Reason</th>
								<td><?php echo $row['reason'];?></td>
							</tr>
							<tr>
								<th>Reimburstment</th>
								<td><?php echo $row['reimburstment'];?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="row no-print">
				<div class="col-md-12">
					 <a href="printdetailrequest.php" target="_blank" class="btn btn-success pull-right"><i class="fa fa-print"></i> Print</a>
				</div>
			</div>
		</section>
	</div>
</div>

<?php
require '../template/footer.php';
?>
</body>
</html>
<?php
}
else{
	header("Location:../index.php");
}
?>