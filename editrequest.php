<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	require 'config/dbconnect.php';
	require 'template/header.php';
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
	    <a href="index2.html" class="logo">
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
	        Edit Request
	        <small>> Edit submitted request</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-plus"></i> Request</a></li>
	        <li class="active">Edit Request</li>
	      </ol>
	    </section>

	    <?php
	    $sql="SELECT request_id, station_origin, request_date, request_qualification, pesawat_id, status_request
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
	              <h3 class="box-title">Edit Submitted Request</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
	              <table id="example1" class="table table-bordered table-striped">
	                <thead>
	                <tr>
	                  <th>Request ID</th>
	                  <th>Station Origin</th>
	                  <th>Request Date</th>
	                  <th>Qualification</th>
	                  <th>Aircraft Type</th>
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
	                		<td>".$row['station_origin']."</td>
	                		<td>".$row['request_date']."</td>
	                		<td>".$row['request_qualification']."</td>
	                		<td>".$row['pesawat_id']."</td>	                		
	                		<td>".$row2['status_desc']."</td>
	                		<td>
	                			<form method='post' action='formedit.php'>
	                				<input type='submit' name='action' class='btn btn-success' value='Edit'/>
	                				<input type='submit' name='action' class='btn btn-danger' value='Del'/>
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
	                  <th>Request Code</th>
	                  <th>Station Origin</th>
	                  <th>Request Date</th>
	                  <th>Qualification</th>
	                  <th>Aircraft Type</th>
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
require 'template/footer.php';
?>
</body>
</html>