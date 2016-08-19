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
	        Edit Manager
	        <small>> Edit current employee</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-plus"></i> Edit Data</a></li>
	        <li class="active">Edit manager</li>
	      </ol>
	    </section>

	    <?php
	    $sql="SELECT * FROM personil WHERE pic_flag='1' ";
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
	              <h3 class="box-title">Edit Manager</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
	              <table id="example1" class="table table-bordered table-striped">
	                <thead>
	                <tr>
	                  <th>Emp ID</th>
	                  <th>Emp Name</th>
	                  <th>Emp unit</th>
	                  <th>Emp Jobtitle</th>
	                  <th>Mgr Unit</th>
	                  <th>Action</th>
	                </tr>
	                </thead>
	                <tbody>
	                <?php
	                while ($row=mysqli_fetch_array($result)) {
	                	echo "
	                	<tr>
	                		<td>".$row['personil_id']."</td>
	                		<td>".$row['personil_name']."</td>
	                		<td>".$row['personil_unit']."</td>
	                		<td>".$row['personil_jobtitle']."</td>
	                		<td>".$row['mgr_unit']."</td>
	                		<td><center>
	                			<form method='post' action='formeditmanager.php'>
	                				<input type='submit' name='action' class='btn btn-success' value='Edit'/>
	                				<input type='submit' name='action' class='btn btn-danger' value='Del'/>
	                				<input type='hidden' name='empid' value='".$row['personil_id']."'/>
	                			</form>	
	                			</center>
	                		</td>
	                	</tr>

	                	";
	                }
	                ?>
					</tbody>
	                <tfoot>
	                <tr>
	                  <th>Emp ID</th>
	                  <th>Emp Name</th>
	                  <th>Emp unit</th>
	                  <th>Emp Jobtitle</th>
	                  <th>Mgr Unit</th>
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