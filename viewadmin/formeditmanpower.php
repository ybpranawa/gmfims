<?php
session_start();
require '../config/dbconnect.php';

$postvar=$_POST['reqid'];

if ($_POST['action']=='Del') {
	$sql="DELETE FROM personil WHERE personil_id='".$postvar."' ";
	$result=mysqli_query($conn,$sql);
	$sql="DELETE FROM personil_auth WHERE personil_id='".$postvar."' ";
	$result=mysqli_query($conn,$sql);
	$sql="DELETE FROM personil_detail WHERE personil_id='".$postvar."' ";
	$result=mysqli_query($conn,$sql);

	$status=1;
	$pesan="Manpower has been deleted";
	header("Location: editmanpower.php?status=$status&pesan=$pesan");
}
elseif ($_POST['action']=='Edit') 
{
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
	        Edit Employee
	        <small>> Edit employee in database</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-plus"></i> Insert Data</a></li>
	        <li class="active">Edit Employee</li>
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
	    	$sql2="SELECT p.*, pa.*, pd.*, q.* FROM personil p JOIN personil_auth pa ON p.`personil_id`=pa.`personil_id` JOIN personil_detail pd ON p.`personil_id`=pd.`personil_id` LEFT JOIN qualification q ON q.`qualification_id`=p.`personil_gl` WHERE p.`personil_id`='".$postvar."' ";
	    	$result2=mysqli_query($conn,$sql2);
	    	$row2=mysqli_fetch_array($result2);
	    	?>
	    	<div class="row">
	    		<form class="form-horizontal" action="../controller/admin/editmanpower.php" method="post">
		    		<div class="col-md-6">
			          <!-- Horizontal Form -->
			          <div class="box box-info">
			            <div class="box-header with-border">
			              <h3 class="box-title">Edit Employee</h3>
			            </div>
			            <!-- /.box-header -->
			            <!-- form start -->
			            
			              <div class="box-body">
			                <div class="form-group">
			                  <label for="empid" class="col-md-4 control-label">Employee ID :</label>

			                  <div class="col-md-6">
			                    <input type="text" class="form-control" id="empid" name="empid" value="<?php echo $row2['personil_id'];?>" readonly="true">
			                  </div>
			                </div>
			                
			                <div class="form-group">
			                  <label for="empname" class="col-md-4 control-label">Emp Name :</label>

			                  <div class="col-md-6">
			                    <input type="text" class="form-control" id="empname" name="empname" value="<?php echo $row2['personil_name'];?>" required>
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="empdinas" class="col-md-4 control-label">Emp Dinas :</label>

			                  <div class="col-md-6">
			                    <input type="text" class="form-control" id="empdinas" name="empdinas" value="<?php echo $row2['personil_dinas'];?>" required>
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="empunit" class="col-md-4 control-label">Emp Unit :</label>

			                  <div class="col-md-6">
			                    <input type="text" class="form-control" id="empunit" name="empunit" value="<?php echo $row2['personil_unit'];?>" required>
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="empoffcode" class="col-md-4 control-label">Emp Office Code :</label>

			                  <div class="col-md-6">
			                    <input type="text" class="form-control" id="empoffcode" name="empoffcode" value="<?php echo $row2['personil_officecode'];?>" required>
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="empstation" class="col-md-4 control-label">Emp Station :</label>

			                  <div class="col-md-6">
			                    <input type="text" class="form-control" id="empstation" name="empstation" value="<?php echo $row2['personil_station'];?>" required>
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="empactual" class="col-md-4 control-label">Emp Actual :</label>

			                  <div class="col-md-6">
			                    <input type="text" class="form-control" id="empactual" name="empactual" value="<?php echo $row2['personil_actual'];?>" required>
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="empjobtitle" class="col-md-4 control-label">Emp Jobtitle :</label>

			                  <div class="col-md-6">
			                    <input type="text" class="form-control" id="empjobtitle" name="empjobtitle" value="<?php echo $row2['personil_jobtitle'];?>" required>
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="empqualify" class="col-md-4 control-label">Emp Qualification :</label>

			                  <div class="col-md-6">
			                    <select name="empqualify" class="form-control" required>
			                    	<option value="<?php echo $row2['qualification_id'];?>"><?php echo $row2['qualification_code'];?></option>
			                    	<?php
			                    	$sql="SELECT * FROM qualification";
			                    	$result=mysqli_query($conn,$sql);
			                    	while ($row=mysqli_fetch_array($result)) {
			                    		if ($row['qualification_id']!=$row2['qualification_id']) {
			                    	?>
			                    		<option value="<?php echo $row['qualification_id'];?>"><?php echo $row['qualification_code'];?></option>
			                    	<?php
			                    		}
			                    	}
			                    	?>
			                    </select>
			                  </div>
			                </div>

			                <div class="form-group">
			                	<label for="empcrew" class="col-md-4 control-label">Emp Crew No.</label>
			                	<div class="col-md-6">
			                		<input type="text" class="form-control" id="empcrew" name="empcrew" value="<?php echo $row2['personil_crew'];?>" required>
			                	</div>
			                </div>
			            </div>
			          </div>
			        </div>

			        <div class="col-md-6">
			        	<div class="box box-info">
			        		<div class="box-header with-border">
			        			<h3 class="box-title">Employee Detail</h3>
			        		</div>

			        		<div class="box-body">
			        			<div class="form-group">
					                  <label for="empjobcode" class="col-md-4 control-label">Emp Jobcode :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="empjobcode" id="empjobcode" class="form-control" value="<?php echo $row2['personil_jobcode'];?>" required>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empcontact" class="col-md-4 control-label">Emp Contact :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="empcontact" id="empcontact" class="form-control" value="<?php echo $row2['personil_contact'];?>" required>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empemail" class="col-md-4 control-label">Emp Email :</label>
					                  <div class="col-md-6">
					                  	<input type="email" name="empemail" id="empemail" class="form-control" value="<?php echo $row2['personil_email'];?>" required>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empaddress" class="col-md-4 control-label">Emp Address :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="empaddress" id="empaddress" class="form-control" value="<?php echo $row2['personil_address'];?>" required>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empschool" class="col-md-4 control-label">Emp Education :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="empschool" id="empschool" class="form-control" value="<?php echo $row2['personil_lasteducation'];?>" required>
					                  </div>
					                </div>

									<div class="form-group">
					                  <label for="empsex" class="col-md-4 control-label">Emp Sex :</label>
					                  <div class="col-md-6">
					                  	<select name="empsex" class="form-control" required>
					                  		<?php
					                  		if ($row2['personil_sex']=='Male') {
					                  		?>
					                  			<option value="Male">MALE</option>
					                  			<option value="Female">FEMALE</option>
					                  		<?php
					                  		}
					                  		else{
					                  		?>
					                  			<option value="Female">FEMALE</option>
					                  			<option value="Male">MALE</option>
					                  		<?php
					                  		}
					                  		?>
					                  		
					                  	</select>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empmarital" class="col-md-4 control-label">Emp Marital :</label>
					                  <div class="col-md-6">
					                  	<select name="empmarital" class="form-control" required>
					                  		<option value="<?php echo $row2['personil_maritalstatus'];?>"><?php echo $row2['personil_maritalstatus'];?></option>
					                  		<?php
					                  		if ($row2['personil_maritalstatus']=='Nikah') {
					                  		?>
					                  		<option value="Lajang">Lajang</option>
					                  		<option value="Janda">Janda</option>
					                  		<option value="Duda">Duda</option>
					                  		<?php	
					                  		}
					                  		if ($row2['personil_maritalstatus']=='Lajang') {
					                  		?>
					                  		<option value="Nikah">Nikah</option>	
					                  		<option value="Janda">Janda</option>
					                  		<option value="Duda">Duda</option>
					                  		<?php
					                  		}
					                  		if ($row2['personil_maritalstatus']=='Janda') {
					                  		?>
					                  		<option value="Nikah">Nikah</option>
					                  		<option value="Lajang">Lajang</option>
					                  		<option value="Duda">Duda</option>	
					                  		<?php
					                  		}
					                  		if ($row2['personil_maritalstatus']=='Duda') {
					                  		?>
					                  		<option value="Nikah">Nikah</option>
					                  		<option value="Lajang">Lajang</option>
					                  		<option value="Janda">Janda</option>
					                  		<?php
					                  		}
					                  		?>
					                  	</select>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empreligi" class="col-md-4 control-label">Emp Religion :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="empreligi" id="empreligi" class="form-control" value="<?php echo $row2['personil_religion'];?>" required>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empnpwp" class="col-md-4 control-label">Emp NPWP :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="empnpwp" id="empnpwp" class="form-control" value="<?php echo $row2['personil_npwp'];?>" required>
					                  </div>
					                </div>				                

					                <div class="form-group">
					                  <label for="emphealth" class="col-md-4 control-label">Emp Jamsostek :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="emphealth" id="emphealth" class="form-control" value="<?php echo $row2['personil_jamsostek'];?>" required>
					                  </div>
					                </div>

								</div>
			              	</div>
			            </div>

			            <div class="col-md-6">
			            	<div class="box box-info">
			            		<div class=" box-header with-border">
			            			<h3 class="box-title">Employee Detail</h3>
			            		</div>

			            		<div class="box-body">
			            			
					                <div class="form-group">
					                  <label for="empinhealth" class="col-md-4 control-label">Emp Inhealth :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="empinhealth" id="empinhealth" class="form-control" value="<?php echo $row2['personil_inhealth'];?>" required>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empgec" class="col-md-4 control-label">Emp GEC :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="empgec" id="empgec" class="form-control" value="<?php echo $row2['personil_gec'];?>" required>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empdirect" class="col-md-4 control-label">Emp Direction :</label>
					                  <div class="col-md-6">
					                  	<select name="empdirect" class="form-control" required>
					                  	<?php
					                  	if ($row2['personil_direction']=='D') {
					                  	?>
					                  		<option value="D">Direct</option>
					                  		<option value="ND">Not Direct</option>
					                  	<?php
					                  	}
					                  	else
					                  	{
					                  	?>
					                  		<option value="ND">Not Direct</option>
					                  		<option value="D">Direct</option>
					                  	<?php
					                  	}
					                  	?>
					                  		
					                  	</select>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empplace" class="col-md-4 control-label">Emp Place :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="empplace" id="empplace" class="form-control" value="<?php echo $row2['personil_place'];?>" required>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empbirth" class="col-md-4 control-label">Emp Birthday :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="empbirth" id="empbirth" class="form-control" value="<?php echo date('Y-m-d', strtotime($row2['personil_birthdate']));?>" required>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empploy" class="col-md-4 control-label">Emp Employment Date :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="empploy" id="empploy" class="form-control" value="<?php echo date('Y-m-d',strtotime($row2['personil_employmentdate']));?>" required>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="emppension" class="col-md-4 control-label">Emp Pension :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="emppension" id="emppension" class="form-control" value="<?php echo $row2['personil_pension'];?>" required>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empstatus" class="col-md-4 control-label">Emp Status :</label>
					                  <div class="col-md-6">
					                  	<select name="empstatus" class="form-control">
										<?php
										if ($row2['personil_status']=="PT") {
										?>
											<option value="PT">Pegawai Tetap</option>
					                  		<option value="PKWT">PKWT</option>
					                  		<option value="PKWT EXT">PKWT EXT</option>
					                  		<option value="PENSIUN">Pensiun</option>
										<?php
										}
										elseif ($row2['personil_status']=="PKWT"){
										?>
					                  		<option value="PKWT">PKWT</option>
					                  		<option value="PT">Pegawai Tetap</option>
					                  		<option value="PKWT EXT">PKWT EXT</option>
					                  		<option value="PENSIUN">Pensiun</option>
										<?php
										}
										elseif ($row2['personil_status']=="PKWT EXT") {
										?>
											<option value="PKWT EXT">PKWT EXT</option>
											<option value="PT">Pegawai Tetap</option>
					                  		<option value="PKWT">PKWT</option>
					                  		<option value="PENSIUN">Pensiun</option>
										<?php
										}
										elseif ($row2['personil_status']=="PENSIUN") {
										?>
											<option value="PENSIUN">Pensiun</option>
											<option value="PT">Pegawai Tetap</option>
											<option value="PKWT">PKWT</option>
					                  		<option value="PKWT EXT">PKWT EXT</option>
										<?php
										}	
										?>			                  		
					                  		
					                  	</select>
					                  </div>
					                </div>
			            		</div>
			            	</div>
			            </div>
			            <?php
			            $sql="SHOW COLUMNS FROM personil_auth";
						$result=mysqli_query($conn,$sql);

						$numrows=mysqli_num_rows($result);

						$x=0;
						$arr=array();
						while ($row=mysqli_fetch_array($result)) {
							$arr[$x]=$row['Field'];
							$x++;
						}
			            ?>
			            <div class="col-md-6">
				        	<div class="box box-info">
				        		<div class="box-header with-border">
				        			<h3 class="box-title">Employee Authorization</h3>
				        		</div>

				        		<div class="box-body">
					                <div class="form-group">
				                  <label for="empauthno" class="col-md-4 control-label">Emp Auth No. :</label>

				                  <div class="col-md-6">
				                    <input type="text" class="form-control" id="empauthno" name="empauthno" value="<?php echo $row2['auth_no'];?>" required>
				                  </div>
				                </div>

				                <div class="form-group">
				                  <label for="empvalidity" class="col-md-4 control-label">Auth Validity :</label>

				                  <div class="col-md-6">
				                    <input type="text" class="form-control" id="empvalidity" name="empvalidity" value="<?php echo $row2['validity'];?>" required>
				                  </div>
				                </div>
				                <?php
				                for ($i=3; $i < mysqli_num_rows($result)+3 ; $i++) { 
				                	$sql="SELECT pa.$arr[$i], r.* FROM personil_auth pa  JOIN rating r ON r.`rating_id`=pa.$arr[$i] WHERE pa.`personil_id`='".$postvar."' ";
				                	$result=mysqli_query($conn,$sql);
				                	$row=mysqli_fetch_array($result);
								?>
								<div class="form-group">
				                  <label for="pesawatrating[]" class="col-md-4 control-label"><?php echo $arr[$i];?> :</label>

				                  <div class="col-md-6">
				                  	<select name="pesawatrating[]" class="form-control" required>
				                  		<option value="<?php echo $row['rating_id'];?>"><?php echo $row['rating_code'];;?></option>
					                  <?php
					                  $sql2="SELECT * FROM rating";
					                  $result2=mysqli_query($conn,$sql2);
					                  while ($row2=mysqli_fetch_array($result2)) {
					                  	if ($row2['rating_id']!=$row['rating_id']) {
					                  ?>
					                  	<option value="<?php echo $row2['rating_id'];?>"><?php echo $row2['rating_code'];?></option>
					                  <?php
					                  	}
					              		}
					                  ?>		                    	
				                    </select>
				                  </div>
				                </div>
								<?php
								}				                	
				                ?>

								</div>
								<!-- /.box-body -->
								<div class="box-footer">
								<button type="submit" class="btn btn-success pull-right">Submit</button>		                
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
</body>
</html>
<?php
}
?>