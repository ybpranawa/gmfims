<?php
session_start();
if (isset($_SESSION['username'])) {
	
require '../config/dbconnect.php';
$reqid=$_POST['reqid'];
$username=$_SESSION['username'];
if ($_POST['action']=='Del') {
	$sql="DELETE FROM request WHERE request_id='".$_POST['reqid']."'";
	$result=mysqli_query($conn, $sql);
	$sql="DELETE FROM request_qualification WHERE request_id='".$_POST['reqid']."'";
	$result=mysqli_query($conn, $sql);
	$status=1;
	$pesan="Assigned request has been deleted";
	header("Location: editsignrequest.php?status=$status&pesan=$pesan");
}
else
{
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	require '../template/header.php';
	?>
	<script type="text/javascript">
		function showUser(str) {
		    if (str == "") {
		        document.getElementById("txtHint").innerHTML = "";
		        return;
		    } else { 
		        if (window.XMLHttpRequest) {
		            // code for IE7+, Firefox, Chrome, Opera, Safari
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            // code for IE6, IE5
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","../controller/getmanager.php?q="+str,true);
		        xmlhttp.send();
		    }
		}
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
	        Assign Request
	        <small>> Assign request form</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-plus"></i> Request</a></li>
	        <li class="active">View Request</li>
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
			  	<form class="form-horizontal" action="../controller/accrequest.php" method="post">
		    		<div class="col-md-12">
		    			<div class="box box-info">
				            <div class="box-header with-border">
				              <h3 class="box-title">Assign Request Form</h3>
				            </div>
				            <!-- /.box-header -->
				            <!-- form start -->
				            <?php
							$sql="SELECT r.`station_origin`, r.`request_date`,  r.`status_request`, r.`requester_id`,
							r.`request_total`, r.`reason`, r.`reimburstment`, r.`start_date`, r.`finish_date`, rq.`rq_note`, rq.`qualification_id`, rq.`pesawat_id`, rq.`rating_id`,r.`centralplanner_msg`
			    				FROM request r INNER JOIN request_qualification rq ON r.`request_id`='".$reqid."' AND r.`request_id`=rq.`request_id`";
		    				$result=mysqli_query($conn,$sql);
		    				$row=mysqli_fetch_array($result);
				            ?>
			            
							<div class="box-body">
								<div class="col-md-4">
									<div class="form-group">
										<label for="requestid" class="col-md-4 control-label">Request ID :</label>
										<div class="input-group">
											<input type="text" value="<?php echo $reqid; ?>" id="requestid" name="requestid" class="form-control" readonly="true">
										</div>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label for="requesterid" class="col-md-4 control-label">Requester ID :</label>
										<div class="input-group">
											<input type="text" value="<?php echo $row['requester_id'];?>" id="requesterid" name="requesterid" class="form-control" readonly="true">
										</div>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label for="station" class="col-md-4 control-label">St. Origin :</label>
										<div class="input-group">
											<input type="text" value="<?php echo $row['station_origin'];?>" id="station" name="station" class="form-control" readonly="true">
										</div>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label for="startdate" class="col-md-4 control-label">Start :</label>
										<div class="input-group">
											<?php
											$startdate=date("Y-m-d",strtotime($row['start_date']));
											?>
											<input type="text" value="<?php echo $startdate;?>" id="startdate" name="startdate" class="form-control" readonly="true">
										</div>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label for="enddate" class="col-md-4 control-label">End :</label>
										<div class="input-group">
											<?php
											$enddate=date("Y-m-d",strtotime($row['finish_date']));
											?>
											<input type="text" value="<?php echo $enddate;?>" id="enddate" name="enddate" class="form-control" readonly="true">
										</div>
									</div>
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
							<!-- /.box-body -->
							
				          </div>
		    		</div>

		    		<?php
		    			$reason=$row['reason'];
		    			$reimburstment=$row['reimburstment'];
		    			$cpmsg=$row['centralplanner_msg'];
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
												<select class="form-control" name="qualification[]" readonly="true">
													<option value="<?php echo $row['qualification_id'];?>"><?php echo $row['qualification_code'];?></option>
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group field_wrap">
											<label for="actype" class="col-md-6 control-label">Aircraft Type : </label>
											<div class="input-group">
												<select class="form-control" name="actype[]" readonly="true">
													<option value="<?php echo $row['pesawat_id'];?>"><?php echo $row['pesawat_id'];?></option>
												</select>
											</div>									
										</div>
									</div>

									<div class="col-md-9">
										<div class="form-group">
											<label for="rating" class="col-md-4 control-label">Rating up to :</label>
											<div class="input-group">
												<select class="form-control" name="rating[]" readonly="true">
													<option value="<?php echo $row['rating_id'];?>"><?php echo $row['rating_code'];?></option>
												</select>

											</div>
										</div>
									

										<div class="form-group">
											<label for="note" class="col-md-4 control-label">Note :</label>
											<div class="input-group col-md-7">
												<textarea name="note[]" id="note" class="form-control" readonly="true"><?php echo $row['rq_note'];?></textarea>
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
										<input class="form-control" name="reason" id="reason" value="<?php echo $reason;?>" readonly="true">
									</div>
								</div>
								<div class="form-group">
									<label for="reimburstment" class="col-md-4 control-label">Status Reimburstment :</label>
									<div class="input-group">
										<select class="form-control" name="reimburstment" readonly="true">
											<?php
											if ($reimburstment==1) {
												echo "<option value='1'>PBTH</option>";	
											}
											else
											{
												echo "<option value='2'>TMB</option>";		
											}
											?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="unit" class="col-md-4 control-label">Assign to Unit :</label>
									<div class="input-group">
										<select class="form-control" name="unit" onchange="showUser(this.value)">
											<?php
											$sql2="SELECT unit_id FROM unit";
											$result2=mysqli_query($conn,$sql2);
											while ($row2=mysqli_fetch_array($result2)) {
												echo "<option value='".$row2['unit_id']."'>".$row2['unit_id']."</option>";
											}
											?>
										</select>
									</div>
								</div>
								
								<div class="form-group" id="txtHint">
									
								</div>

								<div class="form-group">
									<label for="message" class="col-md-4 control-label">Note :</label>
									<div class="input-group">
										<textarea name="message" id="message" class="form-control"><?php echo $cpmsg;?></textarea>
									</div>
								</div>

								<button type="submit" class="btn btn-success pull-right">Assign Unit</button>
							</div>
							<!-- /.box-footer -->
		    			</div>
		    		</div>

	    		</form>
	    	</div>
	    </section>
	</div>
</div>
<?php
require '../template/footer.php';
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
}
else{
	header("Location:../index.php");
}
?>