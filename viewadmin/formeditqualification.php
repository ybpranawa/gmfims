<?php
session_start();
require '../config/dbconnect.php';

$postvar=$_POST['qualid'];

if ($_POST['action']=='Del') {
	$sql="DELETE FROM qualification WHERE qualification_id='".$postvar."' ";
	$result=mysqli_query($conn,$sql);

	$status=1;
	$pesan="Qualification has been deleted";
	header("Location: editqualification.php?status=$status&pesan=$pesan");
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
	        Add Qualification
	        <small>> Add qualification in database</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-plus"></i> Insert Data</a></li>
	        <li class="active">Add Qualification</li>
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
	    	$sql="SELECT * FROM qualification WHERE qualification_id='".$postvar."'";
	    	$result=mysqli_query($conn,$sql);
	    	$row=mysqli_fetch_array($result);
	    	?>
	    	<div class="row">
	    		<div class="col-md-6 col-md-offset-3">
		          <!-- Horizontal Form -->
		          <div class="box box-info">
		            <div class="box-header with-border">
		              <h3 class="box-title">Edit Qualification</h3>
		            </div>
		            <!-- /.box-header -->
		            <!-- form start -->
		            <form class="form-horizontal" action="../controller/admin/editqualification.php" method="post">
		              <div class="box-body">
		                <div class="form-group">
		                  <label for="qid" class="col-md-4 control-label">Qualification ID :</label>

		                  <div class="col-md-6">
		                    <input type="text" class="form-control" id="qid" name="qid" value="<?php echo $row['qualification_id'];?>" readonly="true">
		                  </div>
		                </div>
		                
		                <div class="form-group">
		                  <label for="qcode" class="col-md-4 control-label">Qualification Code :</label>

		                  <div class="col-md-6">
		                    <input type="text" class="form-control" id="qcode" name="qcode" value="<?php echo $row['qualification_code'];?>" required>
		                  </div>
		                </div>

		                <div class="form-group">
		                  <label for="qdesc" class="col-md-4 control-label">Qualification Desc :</label>

		                  <div class="col-md-6">
		                    <input type="text" class="form-control" id="qdesc" name="qdesc" value="<?php echo $row['qualification_desc'];?>" required>
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