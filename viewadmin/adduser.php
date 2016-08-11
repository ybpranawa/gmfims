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
	        Add User Account
	        <small>> Add user in database</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-plus"></i> Insert Data</a></li>
	        <li class="active">Add User</li>
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
		              <h3 class="box-title">Add User Account</h3>
		            </div>
		            <!-- /.box-header -->
		            <!-- form start -->
		            <form class="form-horizontal">
		              <div class="box-body">
		                <div class="form-group">
		                  <label for="userid" class="col-md-4 control-label">User ID :</label>

		                  <div class="col-md-6">
		                    <input type="text" class="form-control" id="userid" name="userid" placeholder="Please use employee id" required>
		                  </div>
		                </div>
		                
		                <div class="form-group">
		                  <label for="passwd" class="col-md-4 control-label">Password :</label>

		                  <div class="col-md-6">
		                    <input type="password" class="form-control" id="passwd" name="passwd" required>
		                  </div>
		                </div>

		                <div class="form-group">
		                  <label for="role" class="col-md-4 control-label">Role :</label>
		                  <div class="col-md-6">
		                  	<select name="role" class="form-control" required>
		                  <?php
		                  $sql="SELECT * FROM role";
		                  $result=mysqli_query($conn,$sql);
		                  while ($row=mysqli_fetch_array($result)) {
		                  	?>
		                  		<option value="<?php echo $row['role_id'];?>"><?php echo $row['role_name'];?></option>
		                  	<?php
		                  }
		                  ?>

		                  	
		                  	</select>
		                    
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