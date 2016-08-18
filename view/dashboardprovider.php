<?php
session_start();
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
	    <a href="index2.html" class="logo">
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
	?>
	<div class="content-wrapper" style="padding-top: 50px;">
		<!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Dashboard
	        <small>> View overall activity</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-plus"></i> Home</a></li>
	        <li class="active">Dashboard</li>
	      </ol>
	    </section>

	    <section class="content">
	    	<div class="row">
	    		<div class="col-md-12">
			  		<?php
					  if (isset($_GET['status'])) {
					    if  ($_GET['status']==0) {
					    ?>
					       <div class="alert alert-danger alert-dismissible" role="alert">
					          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					          <strong>FAILED!</strong> <?php echo $_GET['pesan'];?>
					        </div> 
					      <?php
					     }
					     if ($_GET['status']==1) {
					    ?>
					        <div class="alert alert-success alert-dismissible" role="alert">
					          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					          <strong>SUCCESS!</strong> <?php echo $_GET['pesan'];?>
					        </div>    
					  <?php
					      } 
					  }
					  ?>
			  	</div>
	    	</div>
	    	<?php
	    	$sql="SELECT COUNT(request_id) AS jmlreq FROM request WHERE provider_id='".$_SESSION['username']."'";
	    	$result=mysqli_query($conn,$sql);
	    	$row=mysqli_fetch_array($result);
	    	?>
	    	<div class="row">
	    		<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-yellow">
						<div class="inner">
					  		<h3><?php echo $row['jmlreq'];?></h3>

					  		<p>Requests Received</p>
						</div>
						<div class="icon">
					  		<i class="ion ion-bag"></i>
						</div>
						<a href="historyprovider.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>

					</div>
					<?php
			    	$sql="SELECT COUNT(request_id) AS jmlreq FROM request WHERE status_request='3' AND provider_id='".$_SESSION['username']."'";
			    	$result=mysqli_query($conn,$sql);
			    	$row=mysqli_fetch_array($result);
			    	?>
					<!-- ./col -->
					<div class="col-lg-3 col-xs-6">
					<!-- small box -->
						<div class="small-box bg-green">
							<div class="inner">
				  				<h3><?php echo $row['jmlreq'];?></h3>

				  				<p>Qualification Sent</p>
							</div>
							<div class="icon">
				  				<i class="ion ion-stats-bars"></i>
							</div>
							<a href="historyprovider.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<?php
			    	$sql="SELECT COUNT(request_id) AS jmlreq FROM request WHERE status_request='4' AND provider_id='".$_SESSION['username']."'";
			    	$result=mysqli_query($conn,$sql);
			    	$row=mysqli_fetch_array($result);
			    	?>
					<!-- ./col -->
					<div class="col-lg-3 col-xs-6">
					<!-- small box -->
						<div class="small-box bg-aqua">
							<div class="inner">
					  			<h3><?php echo $row['jmlreq'];?></h3>

					  			<p>Requests Done</p>
							</div>
							<div class="icon">
							  	<i class="ion ion-person-add"></i>
							</div>
							<a href="historyprovider.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<?php
			    	$sql="SELECT ROUND(AVG(request_total)) AS jmlreq FROM request  WHERE provider_id='".$_SESSION['username']."'";
			    	$result=mysqli_query($conn,$sql);
			    	$row=mysqli_fetch_array($result);
			    	?>
					<!-- ./col -->
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-red">
							<div class="inner">
							  	<h3><?php if ($row['jmlreq']==NULL) 
							  	echo "0";
							  	else
							  	echo $row['jmlreq'];?></h3>
							  	<p>Avg. Total Qualification</p>
							</div>
						<div class="icon">
						  	<i class="ion ion-pie-graph"></i>
						</div>
						<a href="historyprovider.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
	    	</div>
	    	<div class="row">
	    		<div class="col-md-7">
	    			<!-- TABLE: LATEST ORDERS -->
		          <div class="box box-info">
		            <div class="box-header with-border">
		              <h3 class="box-title">Latest Requests</h3>

		              <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		              </div>
		            </div>

		            <?php
		            $sql="SELECT r.`request_id`, r.`request_date`, r.`request_total`, r.`status_request`, s.`status_desc` FROM request r JOIN status_request s ON r.`status_request`=s.`status_id` WHERE provider_id='".$_SESSION['username']."' LIMIT 7";
		            $result=mysqli_query($conn,$sql);
		            ?>
		            <!-- /.box-header -->
		            <div class="box-body">
		              <div class="table-responsive">
		                <table class="table no-margin">
		                  <thead>
		                  <tr>
		                    <th>Request ID</th>
		                    <th>Date Request</th>
		                    <th>Qty</th>
		                    <th>Status</th>
		                  </tr>
		                  </thead>
		                  <tbody>
		                  <?php
		                  while ($row=mysqli_fetch_array($result)) {
		                  	echo "
		                  	<tr>
		                  		<td><a href='#'>".$row['request_id']."</a></td>
		                  		<td>".$row['request_date']."</td>
		                  		<td>".$row['request_total']."</td>
		                  		";
		                  		if ($row['status_request']=='0'||$row['status_request']=='5') {
		                  			echo "<td><span class='label label-danger'>".$row['status_desc']."</span></td>";
		                  		}
		                  		else if ($row['status_request']=='1') {
		                  			echo "<td><span class='label label-warning'>".$row['status_desc']."</span></td>";
		                  		}
		                  		else if ($row['status_request']=='2'||$row['status_request']=='4') {
		                  			echo "<td><span class='label label-success'>".$row['status_desc']."</span></td>";
		                  		}
		                  		else if ($row['status_request']=='3') {
		                  			echo "<td><span class='label label-info'>".$row['status_desc']."</span></td>";
		                  		}
		                  		"
		                  	</tr>
		                  	";
		                  }
		                  ?>
		                  </tbody>
		                </table>
		              </div>
		              <!-- /.table-responsive -->
		            </div>
		            <!-- /.box-body -->
		            <div class="box-footer clearfix">
		              <a href="viewassrequest.php" class="btn btn-sm btn-info btn-flat pull-left">View Request</a>
		              <a href="editassmanpower.php" class="btn btn-sm btn-default btn-flat pull-right">Edit Request</a>
		            </div>
		            <!-- /.box-footer -->
		          </div>
		          <!-- /.box -->
	    		</div>
	    		<div class="col-md-5">
					<div class="box box-solid bg-green-gradient">
			            <div class="box-header">
			              <i class="fa fa-calendar"></i>

			              <h3 class="box-title">Calendar</h3>
			              <!-- tools box -->
			              <div class="pull-right box-tools">
			                <!-- button with a dropdown -->
			                <div class="btn-group">
			                  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
			                    <i class="fa fa-bars"></i></button>
			                  <ul class="dropdown-menu pull-right" role="menu">
			                    <li><a href="viewassrequest.php">View Requests</a></li>
			                  </ul>
			                </div>
			                <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
			                </button>
			                <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
			                </button>
			              </div>
			              <!-- /. tools -->
			            </div>
			            <!-- /.box-header -->
			            <div class="box-body no-padding">
			              <!--The calendar -->
			              <div id="calendar" style="width: 100%"></div>
			            </div>
			            
					</div>
					<!-- /.box -->
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