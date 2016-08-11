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
	    	<div class="row">
	    		<div class="col-md-12">
	    			<div class="box box-default">
	    				<div class="box-header with-border">
			              <i class="fa fa-warning"></i>

			              <h3 class="box-title">Warning</h3>
			            </div>
			            <div class="box-body">
			            	<div class="callout callout-danger">
			            		<h4>Caution!</h4>

				                <p>This is restricted area, admin access only. Change data in the menu beside may cause error on this system.
				                Please be aware and give the correct input for each fields.</p>
			            	</div>
			            </div>
	    			</div>
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