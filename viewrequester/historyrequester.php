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
	<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
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
	?>
	<div class="content-wrapper" style="padding-top: 50px;">
		<section class="content-header">
	      <h1>
	        History Request
	        <small>> View submitted request</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-plus"></i> Request</a></li>
	        <li class="active">History</li>
	      </ol>
	    </section>

	    <?php
	  	$sql="SELECT request_id, requester_id, station_origin, request_date, request_total, status_request
	    FROM request WHERE requester_id='".$_SESSION['username']."'";
	    $result=mysqli_query($conn,$sql);
	    ?>

	    <!-- Main content -->
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
	        <div class="col-xs-12">
	          <div class="box">
	            <div class="box-header">
	              <h3 class="box-title">View Submitted Request</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
	              <table id="example1" class="table table-bordered table-striped">
	                <thead>
	                <tr>
	                  <th>Request ID</th>
	                  <th>Requester ID</th>
	                  <th>Station Origin</th>
	                  <th>Request Date</th>
	                  <th>Total Request</th>
	                  <th>Status</th>
	                  <th>Action</th>
	                </tr>
	                </thead>
	                <tbody>
	                <?php
	                while ($row=mysqli_fetch_array($result)) {
	                	$sql2="SELECT status_desc FROM status_request WHERE status_id='".$row['status_request']."'";
	                	$result2=mysqli_query($conn,$sql2);
	                	$row2=mysqli_fetch_array($result2);
	                	echo "
	                	<tr>
	                		<td>".$row['request_id']."</td>
	                		<td>".$row['requester_id']."</td>
	                		<td>".$row['station_origin']."</td>
	                		<td>".$row['request_date']."</td>
	                		<td>".$row['request_total']."</td>";
	                		if ($row['status_request']=='0'||$row['status_request']=='5') {
		                  			echo "<td><span class='label label-danger'>".$row2['status_desc']."</span></td>";
		                  		}
		                  		else if ($row['status_request']=='1') {
		                  			echo "<td><span class='label label-warning'>".$row2['status_desc']."</span></td>";
		                  		}
		                  		else if ($row['status_request']=='2'||$row['status_request']=='4') {
		                  			echo "<td><span class='label label-success'>".$row2['status_desc']."</span></td>";
		                  		}
		                  		else if ($row['status_request']=='3') {
		                  			echo "<td><span class='label label-info'>".$row2['status_desc']."</span></td>";
		                  		}
		                  	echo 
	                		"	                		
	                		<td>
	                			<form method='post' action='detailrequest.php'>
	                				<input type='submit' name='action' class='btn btn-info' value='Detail'/>
	                				<input type='hidden' name='reqid' value='".$row['request_id']."'/>
	                			</form>	
	                		</td>
	                	</tr>

	                	";
	                }
	                ?>
					</tbody>
	                <tfoot>
	                <tr>
	                  <th>Request ID</th>
	                  <th>Requester ID</th>
	                  <th>Station Origin</th>
	                  <th>Request Date</th>
	                  <th>Total Request</th>
	                  <th>Status</th>
	                  <th>Action</th>
	                </tr>
	                </tfoot>
	              </table>
	            </div>
	            <!-- /.box-body -->
	          </div>
	          <!-- /.box -->
	        </div>
	        <!-- /.col -->
	      </div>
	      <!-- /.row -->
	    </section>
	    <!-- /.content -->
	</div>
</div>
<?php
require '../template/footer.php';
?>
</body>
</html>