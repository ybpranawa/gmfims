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
	        Search Unit
	        <small>> Search unit detail</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-plus"></i> Assign</a></li>
	        <li class="active">Search Unit</li>
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
			  	<div class="col-md-6">
			  		<div class="box box-success">
			  			<div class="box-header with-border">
							<h3 class="box-title">Search Unit</h3>
			            </div>
			            <form class="form-horizontal" action="" method="post">
			            	<div class="box box-body">
			            		<div class="form-group">
			            			<label for="unitid" class="col-md-4 control-label">Unit ID :</label>
			            			<div class="input-group">
			            				<select class="form-control select2">
			            					<option>Alaska</option>
                  <option>California</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
			            				</select>
			            			</div>
			            		</div>
			            	</div>
			            </form>
			  		</div>
			  	</div>
	    	</div>
	    </section>
	</div>
</div>

<?php
require 'template/footer.php';
?>
</body>
</html>