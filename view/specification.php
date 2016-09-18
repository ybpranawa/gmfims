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
	        Specification
	        <small>> View App Specification</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-plus"></i> Home</a></li>
	        <li class="active">App Specification</li>
	      </ol>
	    </section>

	    <section class="invoice">
	    	<div class="row">
	    		<div class="col-xs-12">
		          <h2 class="page-header">
		            <i class="fa fa-globe"></i> Integrated Manpower System
		            <small class="pull-right">Date: <?php echo date("Y-m-d");?></small>
		          </h2>
		        </div>
	    	</div>
	    	<div class="row invoice-info">
	    		<iframe src="../info.php" style="width:100%; height:410px;"></iframe>
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