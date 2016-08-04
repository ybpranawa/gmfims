<?php
session_start();
require 'config/dbconnect.php';
$reqid=$_POST['reqid'];
$username=$_SESSION['username'];
$sql="UPDATE request SET centralplanner_id='".$username."' WHERE request_id='".$reqid."'";
$result=mysqli_query($conn,$sql);
if ($_POST['action']=='Reject') {
	$sql="UPDATE request SET status_request='0' WHERE request_id='".$reqid."'";
	$result=mysqli_query($conn,$sql);
	$status=1;
	$pesan="Request has been rejected";
	header("Location: viewrequest.php?status=$status&pesan=$pesan");
}
elseif ($_POST['action']=='Assign') {
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	require 'template/header.php';
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
		        xmlhttp.open("GET","controller/getmanager.php?q="+str,true);
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
	    		<div class="col-md-6">
	    			<div class="box box-success">
			            <div class="box-header with-border">
			              <h3 class="box-title">Assign Request Form</h3>
			            </div>
			            <!-- /.box-header -->
			            <!-- form start -->
			            <?php
			            $sql="SELECT station_origin, request_date, request_qualification, pesawat_id, status_request, request_total,request_rating, requester_msg, reason, reimburstment, requester_id,
			            start_date, finish_date
	    				FROM request WHERE request_id='".$reqid."'";
	    				$result=mysqli_query($conn,$sql);
	    				$row=mysqli_fetch_array($result);
			            ?>
			            <form class="form-horizontal" action="controller/accrequest.php" method="post">
							<div class="box-body">
								<div class="form-group">
									<label for="requestid" class="col-md-4 control-label">Request ID :</label>
									<div class="input-group">
										<input type="text" value="<?php echo $reqid; ?>" id="requestid" name="requestid" class="form-control" readonly="true">
									</div>
								</div>

								<div class="form-group">
									<label for="requesterid" class="col-md-4 control-label">Requester ID :</label>
									<div class="input-group">
										<input type="text" value="<?php echo $row['requester_id'];?>" id="requesterid" name="requesterid" class="form-control" readonly="true">
									</div>
								</div>

								<div class="form-group">
									<label for="station" class="col-md-4 control-label">Station Origin :</label>
									<div class="input-group">
										<input type="text" value="<?php echo $row['station_origin'];?>" id="station" name="station" class="form-control" readonly="true">
									</div>
								</div>

								<!-- Date range -->
								<div class="form-group">
									<label for="startdate" class="col-md-4 control-label">Start :</label>
									<div class="input-group">
										<?php
										$startdate=date("Y-m-d",strtotime($row['start_date']));
										?>
										<input type="text" value="<?php echo $startdate;?>" id="startdate" name="startdate" class="form-control" readonly="true">
									</div>
								</div>
								<!-- /.form group -->

								<!-- Date range -->
								<div class="form-group">
									<label for="enddate" class="col-md-4 control-label">End :</label>
									<div class="input-group">
										<?php
										$enddate=date("Y-m-d",strtotime($row['finish_date']));
										?>
										<input type="text" value="<?php echo $enddate;?>" id="enddate" name="enddate" class="form-control" readonly="true">
									</div>
								</div>
								<!-- /.form group -->

								<div class="form-group">
									<label for="qty" class="col-md-4 control-label">Qty :</label>
									<div class="input-group col-md-2">
										<input class="form-control" type="number" id="qty" value="<?php echo $row['request_total'];?>" name="qty" readonly="true">
									</div>
								</div>

								<div class="form-group">
									<label for="qualification" class="col-md-4 control-label">Qualification :</label>
									<div class="input-group">
										<select class="form-control" name="qualification" readonly="true">
											
											<?php
											$sql2="SELECT qualification_code FROM qualification WHERE qualification_id='".$row['request_qualification']."'";
											$result2=mysqli_query($conn,$sql2);
											$row2=mysqli_fetch_array($result2);
											?>
											<option value="<?php echo $row['request_qualification'];?>"><?php echo $row2['qualification_code'];?></option>
											
										</select>
									</div>
								</div>

								<div class="form-group field_wrap">
									<label for="actype" class="col-md-4 control-label">Aircraft Type : </label>
									<div class="input-group ">
										<input type="text" value="<?php echo $row['pesawat_id'];?>" id="actype" name="actype" class="form-control" readonly="true">
									</div>									
								</div>

								<div class="form-group">
									<label for="rating" class="col-md-4 control-label">Rating Up To :</label>
									<div class="input-group">
										<select class="form-control" name="rating" readonly="true">
											<?php

											$sql2="SELECT rating_code, rating_id FROM rating WHERE rating_id='".$row['request_rating']."'";
											$result2=mysqli_query($conn,$sql2);
											$row2=mysqli_fetch_array($result2);
											?>
											<option value="<?php echo $row2['rating_id'];?>"><?php echo $row2['rating_code'];?></option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="note" class="col-md-4 control-label">Additional note :</label>
									<div class="input-group col-md-7">
										<textarea name="note" id="note" class="form-control" readonly="true"><?php echo $row['requester_msg'];?></textarea>
									</div>
								</div>

								

							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<div class="form-group">
									<label for="reason" class="col-md-4 control-label">Reason :</label>
									<div class="input-group">
										<input class="form-control" name="reason" id="reason" value="<?php echo $row['reason'];?>" readonly="true">
									</div>
								</div>
								<div class="form-group">
									<label for="reimburstment" class="col-md-4 control-label">Status Reimburstment :</label>
									<div class="input-group">
										<input type="text" value="<?php echo $row['reimburstment'];?>" id="reimburstment" name="reimburstment" class="form-control" readonly="true">
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
										<textarea name="message" id="message" class="form-control"></textarea>
									</div>
								</div>

								<button type="submit" class="btn btn-success pull-right">Assign Unit</button>
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