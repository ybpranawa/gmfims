<?php
require 'config/dbconnect.php';
session_start();
if ($_POST['action']=='Del') {
	$sql="DELETE FROM request WHERE request_id='".$_POST['reqid']."'";
	$result=mysqli_query($conn, $sql);
	$sql="DELETE FROM request_qualification WHERE request_id='".$_POST['reqid']."'";
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
			  	<form class="form-horizontal" action="controller/editcurrequest.php" method="post">
		    		<div class="col-md-12">
		    			<div class="box box-info">
				            <div class="box-header with-border">
				              <h3 class="box-title">Request Form</h3>
				            </div>
				            <!-- /.box-header -->
				            <!-- form start -->
				            <?php
				            $reqid=$_POST['reqid'];
				            $sql="SELECT r.`station_origin`, r.`request_date`,  r.`status_request`, 
				            r.`request_total`, r.`reason`, r.`reimburstment`, r.`start_date`, r.`finish_date`, rq.`rq_note`, rq.`qualification_id`, rq.`pesawat_id`, rq.`rating_id`
		    				FROM request r INNER JOIN request_qualification rq ON r.`request_id`='".$reqid."' AND r.`request_id`=rq.`request_id`";
		    				$result=mysqli_query($conn,$sql);
		    				$row=mysqli_fetch_array($result);
				            ?>
				            
								<div class="box-body">
									<div class="col-md-4">
										<div class="form-group">
											<label for="station" class="col-md-4 control-label">Request ID :</label>
											<div class="input-group">
												<input type="text" value="<?php echo $reqid; ?>" id="requestid" name="requestid" class="form-control" placeholder=<?php echo $reqid;?> readonly="true">
											</div>
										</div>
									</div>
									<div class="col-md-4">
										
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label for="station" class="col-md-4 control-label">Origin :</label>
											<div class="input-group">
												<input type="text" value="<?php echo $row['station_origin']; ?>" id="requestid" name="requestid" class="form-control" readonly="true">
												
											</div>
										</div>
									</div>

									<div class="col-md-4">
										<!-- Date range -->
										<div class="form-group">
											<label for="reqdate" class="col-md-4 control-label">From :</label>
											<div class="input-group">
											  	<input type="text" class="form-control" id="reqdate" name="reqdate" value='<?php echo date('Y-m-d',strtotime($row['start_date']));?>' readonly="true">
											</div>
										</div>
										<!-- /.form group -->
									</div>

									<div class="col-md-4">
										<!-- Date range -->
										<div class="form-group">
											<label for="reqdate" class="col-md-4 control-label">To :</label>
											<div class="input-group">
											  	<input type="text" class="form-control" id="reqdate" name="reqdate" value='<?php echo date('Y-m-d',strtotime($row['finish_date']));?>' readonly="true">
											</div>
										</div>
										<!-- /.form group -->
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label for="qty" class="col-md-4 control-label">Qty :</label>
											<div class="input-group col-md-2">
												<input class="form-control" type="number" id="qty" value="<?php echo $row['request_total'];?>" name="qty" readonly="true">
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
						<?php
						$reason=$row['reason'];
						$reimburstment=$row['reimburstment'];
						$sql="SELECT * FROM request_qualification rq JOIN qualification q ON rq.`qualification_id`=q.`qualification_id` JOIN rating r ON rq.`rating_id`=r.`rating_id` WHERE request_id='".$reqid."'";
						$result=mysqli_query($conn,$sql);
						
												
						while ($row=mysqli_fetch_array($result)){ 
						?>
						<div class="col-md-6">
							<div class="box box-warning">
								<div class="box-body">
									<div class="hidden">
										<input type="text" value="<?php echo $row['rq_id'];?>" readonly="true" name="reqid[]" id="reqid[]">
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="qualification" class="col-md-6 control-label">Qualification :</label>
											<div class="input-group">
												<select class="form-control" name="qualification[]">
													<option value="<?php echo $row['qualification_id'];?>"><?php echo $row['qualification_code'];?></option>
													<?php
													$sql2="SELECT qualification_id, qualification_code FROM qualification";
													$result2=mysqli_query($conn,$sql2);
													
													while ($row2=mysqli_fetch_array($result2)) {
														if ($row2['qualification_id']!=$row['qualification_id']) {
															echo "<option value='".$row2['qualification_id']."'>".$row2['qualification_code']."</option>";
														}
													}
													?>
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group field_wrap">
											<label for="actype" class="col-md-6 control-label">Aircraft Type : </label>
											<div class="input-group ">
												<select class="form-control" name="actype[]">
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
									</div>

									<div class="col-md-9">
										<div class="form-group">
											<label for="rating" class="col-md-4 control-label">Rating up to :</label>
											<div class="input-group">
												<select class="form-control" name="rating[]">
													<option value="<?php echo $row['rating_id'];?>"><?php echo $row['rating_code'];?></option>
												    <?php

												   	$sql2="SELECT rating_id, rating_code FROM rating";
												    $result2=mysqli_query($conn,$sql2);
												    while ($row2=mysqli_fetch_array($result2)) {
												    	if ($row2['rating_id']!=$row['rating_id']) {
												    		echo "<option value='".$row2['rating_id']."'>".$row2['rating_code']."</option>";	
												    	}
												    }
												    ?>
												</select>

											</div>
										</div>
									

										<div class="form-group">
											<label for="note" class="col-md-4 control-label">Note :</label>
											<div class="input-group col-md-7">
												<textarea name="note[]" id="note" class="form-control"><?php echo $row['rq_note'];?></textarea>
											</div>
										</div>
									</div>
									

								</div>				            
				          </div>
		    		</div>
		    		<?php
		    		}
		    		?>

		    		<div class="col-md-6">
		    			<div class="box box-success">
		    				<div class="box-body">
									<div class="form-group">
										<label for="reason" class="col-md-4 control-label">Reason :</label>
										<div class="input-group">
											<input class="form-control" name="reason" id="reason" value="<?php echo $reason;?>" >
										</div>
									</div>
									<div class="form-group">
										<label for="reimburstment" class="col-md-4 control-label">Status Reimburstment :</label>
										<div class="input-group">
											<select class="form-control" name="reimburstment">
												<?php
												if ($reimburstment==1) {
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
		    			</div>
		    		</div>
	    		</form>
	    	</div>
	    </section>
	</div>
</div>
<?php
require 'template/footer.php';
?>	
<script type="text/javascript">
	//Date range picker
    $('#reqdates').daterangepicker();
    //Date range picker with time picker
    $('#reqdatestime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
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