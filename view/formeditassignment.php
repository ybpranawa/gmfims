<?php
session_start();
require '../config/dbconnect.php';
$reqid=$_POST['reqid'];
$username=$_SESSION['username'];
$sql="UPDATE request SET status_request='3' WHERE request_id='".$reqid."'";
$result=mysqli_query($conn,$sql);

if ($_POST['action']=='Del') {
	$sql="UPDATE request SET status_request='2' WHERE request_id='".$reqid."'";
	$result=mysqli_query($conn,$sql);
	$status=1;
	$pesan="Request has been rejected";
	header("Location: viewrequest.php?status=$status&pesan=$pesan");
}
elseif ($_POST['action']=='Edit') {
	$sql="SELECT * FROM request WHERE request_id='".$reqid."'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);
?>
<!DOCTYPE <!DOCTYPE html>
<html>
<head>
	<?php
	require '../template/header.php';
	?>
	<script>
	  $(function () {
	    $("#example1").DataTable();
	    $('#example2').DataTable({
	      "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false
	    });
	  });
	</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	<header class="main-header">
		<!-- Logo -->
	    <a href="dashboardprovider.php" class="logo">
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
		<section class="content-header">
	      <h1>
	        Assign to Manpower
	        <small>> Assign manpower to requester</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-plus"></i> Provide</a></li>
	        <li class="active">View Assigned Request</li>
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
			  	<form class="form-horizontal" action="../controller/sentmanpower.php" method="post">
		    		<div class="col-md-12">
		    			<div class="box box-info">
				            <div class="box-header with-border">
				              <h3 class="box-title">Assign Request Form</h3>
				            </div>
				            <!-- /.box-header -->
				            <!-- form start -->
				            <?php
							$sql="SELECT r.`station_origin`, r.`request_date`,  r.`status_request`, r.`requester_id`,
							r.`request_total`, r.`reason`, r.`reimburstment`, r.`start_date`, r.`finish_date`,
							rq.`rq_note`, rq.`qualification_id`, rq.`pesawat_id`, rq.`rating_id`, 
							r.`centralplanner_msg`,	r.`unit_id`, pd.`personil_email`, p.`personil_name`,rq.`personilsent_id`
							FROM request r INNER JOIN request_qualification rq ON 
							r.`request_id`='".$reqid."' AND r.`request_id`=rq.`request_id` INNER JOIN personil_detail pd ON pd.`personil_id`=r.`provider_id`
							INNER JOIN personil p ON p.`personil_id`=r.`provider_id`";
		    				$result=mysqli_query($conn,$sql);
		    				$row=mysqli_fetch_array($result);
		    				$unitid=$row['unit_id'];
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
										<label for="requesterid" class="col-md-5 control-label">Requester ID :</label>
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
										<label for="enddate" class="col-md-5 control-label">End :</label>
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

								<div class="col-md-4">
									<div class="form-group">
										<label for="reason" class="col-md-4 control-label">Reason :</label>
										<div class="input-group">
											<input class="form-control" name="reason" id="reason" value="<?php echo $row['reason'];?>" readonly="true">
										</div>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label for="reimburstment" class="col-md-5 control-label">Reimburstment :</label>
										<div class="input-group">
											<select class="form-control" name="reimburstment" readonly="true">
												<?php
												if ($row['reimburstment']==1) {
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
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label for="unit" class="col-md-4 control-label">Unit :</label>
										<div class="input-group">
											<select class="form-control" name="unit" onchange="showUser(this.value)" readonly="true">
												<option value="<?php echo $row['unit_id'];?>"><?php echo $row['unit_id'];?></option>
											</select>
										</div>
									</div>
								</div>
								
								<div class="col-md-4">
									<div class="form-group">
										<label for="PIC" class="col-md-4 control-label">PIC :</label>
										<div class="input-group">
											<input type="text" value="<?php echo $row['personil_name'];?>" class="form-control" readonly="true">
										</div>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label for="email" class="col-md-5 control-label">Contact :</label>
										<div class="input-group">
											<input type="text" value="<?php echo $row['personil_email'];?>" class="form-control" readonly="true">
										</div>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label for="message" class="col-md-4 control-label">Note :</label>
										<div class="input-group">
											<textarea name="message" id="message" class="form-control" readonly="true"><?php echo $row['centralplanner_msg'];?></textarea>
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
						
						$counter=0;
						while ($row=mysqli_fetch_array($result)){
						$reqdetid=$row['rq_id'];
						?>
						<div class="col-md-12">
							<div class="box box-warning">
								<div class="box-body">
									<div class="hidden">
										<input type="text" value="<?php echo $row['rq_id'];?>" readonly="true" name="reqid[]" id="reqid[]">
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="qualification" class="col-md-6 control-label">Qualification :</label>
											<div class="input-group">
												<select class="form-control" name="qualification[]" readonly="true">
													<option value="<?php echo $row['qualification_id'];?>"><?php echo $row['qualification_code'];?></option>
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group field_wrap">
											<label for="actype" class="col-md-6 control-label">Aircraft Type : </label>
											<div class="input-group">
												<select class="form-control" name="actype[]" readonly="true">
													<option value="<?php echo $row['pesawat_id'];?>"><?php echo $row['pesawat_id'];?></option>
												</select>
											</div>									
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label for="rating" class="col-md-4 control-label">Up to :</label>
											<div class="input-group">
												<select class="form-control" name="rating[]" readonly="true">
													<option value="<?php echo $row['rating_id'];?>"><?php echo $row['rating_code'];?></option>
												</select>

											</div>
										</div>
									</div>

									<div class="col-md-8">
										<div class="form-group">
											<label for="note" class="col-md-3 control-label">Note :</label>
											<div class="input-group col-md-8">
												<textarea name="note[]" id="note" class="form-control" readonly="true"><?php echo $row['rq_note'];?></textarea>
											</div>
										</div>
									</div>
									<?php
									$pesawatid=$row['pesawat_id'];
									$sql2="SELECT * FROM personil p JOIN personil_auth pa ON p.`personil_id`=pa.`personil_id` JOIN personil_detail pd ON pd.`personil_id`=p.`personil_id` 
									JOIN qualification q ON q.`qualification_id`=p.`personil_gl` JOIN rating rt ON rt.`rating_id`=pa.$pesawatid
									WHERE SUBSTRING(p.`personil_unit`,4,3)='".$unitid."' AND p.`personil_gl`='".$row['qualification_id']."' AND pa.`auth_no` != '' AND ".$row['pesawat_id']."<=".$row['rating_id']." AND ".$row['pesawat_id']." != ''";
									$result2=mysqli_query($conn,$sql2);
									?>
									<div class="col-md-12">
										<div class="box">
											<div class="box-header">
								              <h3 class="box-title">Choose Manpower</h3>
								            </div>
								            <div class="box-body">
								            	<table id="example1" class="table table-bordered table-striped">
								            		<thead>
								            			<tr>
								            				<th>Emp ID</th>
								            				<th>Name</th>
								            				<th>Contact</th>
								            				<th>Qualification</th>
								            				<th>Auth Validity</th>
								            				<th>Auth Rating</th>
								            				<th>Choose</th>
								            			</tr>
								            		</thead>
								            		<tbody>
								            			<?php
								            			$sql3="SELECT * FROM personil p JOIN personil_auth pa ON p.`personil_id`=pa.`personil_id` JOIN personil_detail pd ON pd.`personil_id`=p.`personil_id` 
														JOIN qualification q ON q.`qualification_id`=p.`personil_gl` JOIN rating rt ON rt.`rating_id`=pa.$pesawatid
														WHERE p.`personil_id`='".$row['personilsent_id']."'";
														$result3=mysqli_query($conn,$sql3);
								            			$row3=mysqli_fetch_array($result3);
								            			echo "
								            			<tr>
								            				<td>".$row3['personil_id']."</td>
								            				<td>".$row3['personil_name']."</td>
								            				<td>".$row3['personil_email']."</td>
								            				<td>".$row3['qualification_code']."</td>
								            				<td>".$row3['validity']."</td>
								            				<td>".$row3['rating_code']."</td>
								            				<td><center><input type='radio' name='".$reqdetid."' value='".$row['personilsent_id']."' checked></center></td>
								            			</tr>
								            			";
								            			while ($row2=mysqli_fetch_array($result2)) {
								            				if ($row2['personil_id']!=$row3['personil_id']) {
								            			?>
									            			<tr>
									            				<td><?php echo $row2['personil_id'];?></td>
									            				<td><?php echo $row2['personil_name'];?></td>
									            				<td><?php echo $row2['personil_email'];?></td>
									            				<td><?php echo $row2['qualification_code'];?></td>
									            				<td><?php echo $row2['validity'];?></td>
									            				<td><?php echo $row2['rating_code'];?></td>
									            				<td><center><?php echo "<input type='radio' name='".$reqdetid."' value='".$row2['personil_id']."'>";?></center></td>
									            			</tr>
								            			<?php
								            				}
								            			}
								            			?>
								            		</tbody>
								            		<tfoot>
								            			<tr>
								            				<th>Emp ID</th>
								            				<th>Name</th>
								            				<th>Contact</th>
								            				<th>Qualification</th>
								            				<th>Auth Validity</th>
								            				<th>Auth Rating</th>
								            				<th>Choose</th>
								            			</tr>
								            		</tfoot>
								            	</table>
								            </div>
										</div>
									</div>
									

								</div>				            
				          </div>
		    		</div>
		    		<?php
		    		$counter++;
		    		}
		    		?>

		    		<div class="col-md-12">
		    			<div class="box box-success">
		    				<div class="box-body">
			    				<div class="col-md-8">
			    					<p>Please make sure you have fill the input correctly </p>
								</div>
								<div class="col-md-4"><button type="submit" class="btn btn-success pull-right">Send</button></div>
							</div>
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
</body>
</html>

<?php
}
?>