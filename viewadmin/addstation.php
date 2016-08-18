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
	        Add Station
	        <small>> Add station in database</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-plus"></i> Insert Data</a></li>
	        <li class="active">Add Station</li>
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
	    	<div class="row">
	    		<div class="col-md-6 col-md-offset-3">
		          <!-- Horizontal Form -->
		          <div class="box box-info">
		            <div class="box-header with-border">
		              <h3 class="box-title">Add Station</h3>
		            </div>
		            <!-- /.box-header -->
		            <!-- form start -->
		            <form class="form-horizontal" action="../controller/admin/addstation.php" method="post">
		              <div class="box-body">
		                <div class="form-group">
		                  <label for="stationid" class="col-md-4 control-label">Station ID :</label>

		                  <div class="col-md-6">
		                    <input type="text" class="form-control" id="stationid" name="stationid" placeholder="CGK, SUB, KNO, etc." required>
		                  </div>
		                </div>
		                
		                <div class="form-group">
		                  <label for="stationname" class="col-md-4 control-label">Station Name :</label>

		                  <div class="col-md-6">
		                    <input type="text" class="form-control" id="stationname" name="stationname" placeholder="Soekarno-Hatta Intl. Airpot, etc." required>
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
		                  	<?php
		                  	while ($row=mysqli_fetch_array($result)) {
		                  	?>
		                  		<option value="<?php echo $row['unit_id'];?>"><?php echo $row['unit_id'];?></option>
		                  	<?php
		                  	}
		                  	?>
		                    </select>
		                  </div>
		                </div>

		                <div class="form-group">
		                  <label for="lat" class="col-md-4 control-label">Lattitude :</label>

		                  <div class="col-md-6">
		                    <input type="text" class="form-control" id="lat" name="lat" placeholder="11,12345 (based on google lattitude)" required>
		                  </div>
		                </div>

		                <div class="form-group">
		                  <label for="long" class="col-md-4 control-label">Longitude :</label>

		                  <div class="col-md-6">
		                    <input type="text" class="form-control" id="long" name="long" placeholder="11,12345 (based on google longitude)" required>
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