<?php
require 'config/dbconnect.php';
session_start();
if ($_POST['action']=='Del') {
	$sql="DELETE FROM request WHERE request_id='".$_POST['reqid']."'";
	$result=mysqli_query($conn, $sql);
	$status=1;
	$pesan="Your request has been deleted";
	header("Location: editrequest.php?status=$status&pesan=$pesan");
}
else
{
?>
<!DOCTYPE html>
<html>
<head>
	<?php
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
		<!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        Edit Request
	        <small>> Edit request form</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-plus"></i> Request</a></li>
	        <li class="active">Edit Request</li>
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
	    			<div class="box box-info">
			            <div class="box-header with-border">
			              <h3 class="box-title">Request Form</h3>
			            </div>
			            <!-- /.box-header -->
			            <!-- form start -->
			            <?php
			            $reqid=$_POST['reqid'];
			            $sql="SELECT station_origin, request_date, request_qualification, pesawat_id, status_request, request_total,request_rating, requester_msg, reason, reimburstment
	    				FROM request WHERE request_id='".$reqid."'";
	    				$result=mysqli_query($conn,$sql);
	    				$row=mysqli_fetch_array($result);
			            ?>
			            <form class="form-horizontal" action="controller/editcurrequest.php" method="post">
							<div class="box-body">
								<div class="form-group">
									<label for="station" class="col-md-4 control-label">Request ID :</label>
									<div class="input-group">
										<input type="text" value="<?php echo $reqid; ?>" id="requestid" name="requestid" class="form-control" placeholder=<?php echo $reqid;?> readonly="true">
									</div>
								</div>

								<div class="form-group">
									<label for="station" class="col-md-4 control-label">Station Origin :</label>
									<div class="input-group">
										<select class="form-control" name="station">
											<option value="<?php echo $row['station_origin'];?>"><?php echo $row['station_origin'];?></option>
											<?php
											$sql2="SELECT station_id FROM station";
											$result2=mysqli_query($conn,$sql2);

											while ($row2=mysqli_fetch_array($result2)) {
												if ($row2['station_id']!=$row['station_origin']) {
													echo "<option value='".$row2['station_id']."'>".$row2['station_id']."</option>";	
												}
											}
											?>
										</select>
									</div>
								</div>

								<!-- Date range -->
								<div class="form-group">
									<label for="reqdate" class="col-md-4 control-label">Date range :</label>
									<div class="input-group col-md-7">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
									  	<input type="text" class="form-control" id="reqdate" name="reqdate">
									</div>
									<!-- /.input group -->
								</div>
								<!-- /.form group -->

								<div class="form-group">
									<label for="qty" class="col-md-4 control-label">Qty :</label>
									<div class="input-group col-md-2">
										<input class="form-control" type="number" id="qty" value="<?php echo $row['request_total'];?>" name="qty">
									</div>
								</div>

								<div class="form-group">
									<label for="qualification" class="col-md-4 control-label">Qualification :</label>
									<div class="input-group">
										<select class="form-control" name="qualification">
											<option value="<?php echo $row['request_qualification'];?>"><?php echo $row['request_qualification'];?></option>
											<?php
											$sql2="SELECT qualification_id FROM qualification";
											$result2=mysqli_query($conn,$sql2);
											while ($row2=mysqli_fetch_array($result2)) {
												if ($row2['qualification_id']!=$row['request_qualification']) {
													echo "<option value='".$row2['qualification_id']."'>".$row2['qualification_id']."</option>";
												}
											}
											
											?>
										</select>
									</div>
								</div>

								<?php
								$sql="SELECT * FROM pesawat";
								$result=mysqli_query($conn,$sql);
								?>
								<div class="form-group field_wrap">
									<label for="actype" class="col-md-4 control-label">Aircraft Type : </label>
									<div class="input-group ">
										<select class="form-control" name="actype">
											<option value="<?php echo $row['pesawat_id'];?>"><?php echo $row['pesawat_id'];?></option>
										    <?php
										    $sql2="SELECT pesawat_id FROM pesawat";
										    $result2=mysqli_query($conn,$sql2);
										    while ($row2=mysqli_fetch_array($result2)) {
										    	if ($row2['pesawat_id']!=$row['pesawat_id']) {
										    		echo "<option value='".$row2['pesawat_id']."'>".$row2['pesawat_id']."</option>";	
										    	}
										    }
										    ?>
										</select>
										<!-- <div class="input-group col-md-4" style="floating:left;"><a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus"></i></a></div> -->
									</div>									
								</div>

								<?php
								$sql="SELECT * FROM rating";
								$result=mysqli_query($conn,$sql);
								?>
								<div class="form-group">
									<label for="rating" class="col-md-4 control-label">Rating up to :</label>
									<div class="input-group">
										<select class="form-control" name="rating">
											<option value="<?php echo $row['request_rating'];?>"><?php echo $row['request_rating'];?></option>
										    <?php
										    $sql2="SELECT rating_id FROM rating";
										    $result2=mysqli_query($conn,$sql2);
										    while ($row2=mysqli_fetch_array($result2)) {
										    	if ($row2['rating_id']!=$row['request_rating']) {
										    		echo "<option value='".$row2['rating_id']."'>".$row2['rating_id']."</option>";	
										    	}
										    }
										    ?>
										</select>

									</div>
								</div>

								<div class="form-group">
									<label for="note" class="col-md-4 control-label">Additional note :</label>
									<div class="input-group col-md-7">
										<textarea name="note" id="note" class="form-control"><?php echo $row['requester_msg'];?></textarea>
									</div>
								</div>

								

							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<div class="form-group">
									<label for="reason" class="col-md-4 control-label">Reason :</label>
									<div class="input-group">
										<input class="form-control" name="reason" id="reason" value="<?php echo $row['reason'];?>" placeholder="<?php echo $row['reason'];?>">
									</div>
								</div>
								<div class="form-group">
									<label for="reimburstment" class="col-md-4 control-label">Status Reimburstment :</label>
									<div class="input-group">
										<select class="form-control" name="reimburstment">
											<?php
											if ($row['reimburstment']==1) {
												echo "<option value='1'>PBTH</option>
										    		<option value='2'>TMB</option>";	
											}
											else
											{
												echo "<option value='2'>TMB</option>
										    		<option value='1'>PBTH</option>";		
											}
											?>
										</select>
									</div>
								</div>
								<button type="submit" class="btn btn-info pull-right">Send Request</button>
							</div>
							<!-- /.box-footer -->
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
<script type="text/javascript">
	//Date range picker
    $('#reqdate').daterangepicker();
    //Date range picker with time picker
    $('#reqdatetime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );
</script>
</body>
</html>
<?php
}
?>