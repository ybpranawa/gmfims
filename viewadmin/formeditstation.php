<?php
session_start();
require '../config/dbconnect.php';

$statid=$_POST['statid'];

if ($_POST['action']=='Del') {
	$sql="DELETE FROM station WHERE station_id='".$statid."' ";
	$result=mysqli_query($conn,$sql);
	$sql="DELETE FROM station_detail WHERE station_id='".$statid."' ";
	$result=mysqli_query($conn,$sql);

	$status=1;
	$pesan="Station has been deleted";
	header("Location: editstation.php?status=$status&pesan=$pesan");
}
elseif ($_POST['action']=='Edit') 
{
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	require '../template/header.php';
	?>
	<script type="text/javascript">

	</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	<header class="main-header">
		<!-- Logo -->
	    <a href="dashboardadmin.php" class="logo">
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
	        Edit Station
	        <small>> Edit station in database</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-plus"></i> Edit Data</a></li>
	        <li class="active">Edit Station</li>
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
	    	$sql2="SELECT s.*, sd.* FROM station s JOIN station_detail sd ON s.`station_id`=sd.`station_id` WHERE s.`station_id`='".$statid."' ";
	    	$result2=mysqli_query($conn,$sql2);
	    	$row2=mysqli_fetch_array($result2);
	    	?>
	    	<div class="row">
	    		<div class="col-md-6 col-md-offset-3">
		          <!-- Horizontal Form -->
		          <div class="box box-info">
		            <div class="box-header with-border">
		              <h3 class="box-title">Edit Station</h3>
		            </div>
		            <!-- /.box-header -->
		            <!-- form start -->
		            <form class="form-horizontal" action="../controller/admin/editstation.php" method="post">
		              <div class="box-body">
		                <div class="form-group">
		                  <label for="stationid" class="col-md-4 control-label">Station ID :</label>

		                  <div class="col-md-6">
		                    <input type="text" class="form-control" id="stationid" name="stationid" value="<?php echo $row2['station_id'];?>" required>
		                  </div>
		                </div>
		                
		                <div class="form-group">
		                  <label for="stationname" class="col-md-4 control-label">Station Name :</label>

		                  <div class="col-md-6">
		                    <input type="text" class="form-control" id="stationname" name="stationname" value="<?php echo $row2['station_name'];?>" required>
		                  </div>
		                </div>
		                <?php
		                $sql="SELECT unit_id FROM unit";
		                $result=mysqli_query($conn,$sql);
		                ?>
		                <div class="form-group">
		                  <label for="unitid" class="col-md-4 control-label">Unit ID :</label>

		                  <div class="col-md-6">
		                  	<select name="unitid" class="form-control" required>
		                  		<option value="<?php echo $row2['unit_id'];?>"><?php echo $row2['unit_id'];?></option>
		                  	<?php
		                  	while ($row=mysqli_fetch_array($result)) {
		                  		if ($row['unit_id']!=$row2['unit_id']) {
		                  	?>
		                  		<option value="<?php echo $row['unit_id'];?>"><?php echo $row['unit_id'];?></option>
		                  	<?php
		                  		}
		                  	}
		                  	?>
		                    </select>
		                  </div>
		                </div>

		                <div class="form-group">
		                  <label for="lat" class="col-md-4 control-label">Lattitude :</label>

		                  <div class="col-md-6">
		                    <input type="text" class="form-control" id="lat" name="lat" value="<?php echo $row2['station_lat'];?>" required>
		                  </div>
		                </div>

		                <div class="form-group">
		                  <label for="long" class="col-md-4 control-label">Longitude :</label>

		                  <div class="col-md-6">
		                    <input type="text" class="form-control" id="long" name="long" value="<?php echo $row2['station_long'];?>" required>
		                  </div>
		                </div>


		              </div>
		              <!-- /.box-body -->
		              <div class="box-footer">
		                <button type="submit" class="btn btn-success pull-right">Submit</button>		                
		              </div>
		              <!-- /.box-footer -->
		            </form>
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
?>