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
	        Add Employee
	        <small>> Add employee in database</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-plus"></i> Insert Data</a></li>
	        <li class="active">Add Employee</li>
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
	    		<form class="form-horizontal" action="../controller/admin/addmanpower.php" method="post">
		    		<div class="col-md-6">
			          <!-- Horizontal Form -->
			          <div class="box box-info">
			            <div class="box-header with-border">
			              <h3 class="box-title">Add Employee</h3>
			            </div>
			            <!-- /.box-header -->
			            <!-- form start -->
			            
			              <div class="box-body">
			                <div class="form-group">
			                  <label for="empid" class="col-md-4 control-label">Employee ID :</label>

			                  <div class="col-md-6">
			                    <input type="text" class="form-control" id="empid" name="empid" placeholder="511111, etc." required>
			                  </div>
			                </div>
			                
			                <div class="form-group">
			                  <label for="empname" class="col-md-4 control-label">Emp Name :</label>

			                  <div class="col-md-6">
			                    <input type="text" class="form-control" id="empname" name="empname" placeholder="John Doe, etc." required>
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="empdinas" class="col-md-4 control-label">Emp Dinas :</label>

			                  <div class="col-md-6">
			                    <input type="text" class="form-control" id="empdinas" name="empdinas" placeholder="JKTTF, etc." required>
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="empunit" class="col-md-4 control-label">Emp Unit :</label>

			                  <div class="col-md-6">
			                    <input type="text" class="form-control" id="empunit" name="empunit" placeholder="JKTTFS, JKTTFC, etc." required>
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="empoffcode" class="col-md-4 control-label">Emp Office Code :</label>

			                  <div class="col-md-6">
			                    <input type="text" class="form-control" id="empoffcode" name="empoffcode" placeholder="SOCMM, JKTTFC, etc." required>
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="empstation" class="col-md-4 control-label">Emp Station :</label>

			                  <div class="col-md-6">
			                    <input type="text" class="form-control" id="empstation" name="empstation" placeholder="PDG, SUB, TFC, etc." required>
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="empactual" class="col-md-4 control-label">Emp Actual :</label>

			                  <div class="col-md-6">
			                    <input type="text" class="form-control" id="empactual" name="empactual" placeholder="JKTTFD, JKTTFN, etc." required>
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="empjobtitle" class="col-md-4 control-label">Emp Jobtitle :</label>

			                  <div class="col-md-6">
			                    <input type="text" class="form-control" id="empjobtitle" name="empjobtitle" placeholder="SENIOR AIRCRAFT MAINTENANCE ENGINEER" required>
			                  </div>
			                </div>

			                <div class="form-group">
			                  <label for="empqualify" class="col-md-4 control-label">Emp Qualification :</label>

			                  <div class="col-md-6">
			                    <select name="empqualify" class="form-control" required>
			                    	<?php
			                    	$sql="SELECT * FROM qualification";
			                    	$result=mysqli_query($conn,$sql);
			                    	while ($row=mysqli_fetch_array($result)) {
			                    	?>
			                    	<option value="<?php echo $row['qualification_id'];?>"><?php echo $row['qualification_code'];?></option>
			                    	<?php
			                    	}
			                    	?>
			                    </select>
			                  </div>
			                </div>

			                <div class="form-group">
			                	<label for="empcrew" class="col-md-4 control-label">Emp Crew No.</label>
			                	<div class="col-md-6">
			                		<input type="text" class="form-control" id="empcrew" name="empcrew" placeholder="0, 1, 2, 3, etc." required>
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
					                  	<input type="text" name="empjobcode" id="empjobcode" class="form-control" placeholder="SAME, AME, etc." required>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empcontact" class="col-md-4 control-label">Emp Contact :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="empcontact" id="empcontact" class="form-control" placeholder="085xxxxx, etc." required>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empemail" class="col-md-4 control-label">Emp Email :</label>
					                  <div class="col-md-6">
					                  	<input type="email" name="empemail" id="empemail" class="form-control" placeholder="emp@gmf-aeroasia.co.id, etc." required>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empaddress" class="col-md-4 control-label">Emp Address :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="empaddress" id="empaddress" class="form-control" placeholder="Jl. Bandara, etc." required>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empschool" class="col-md-4 control-label">Emp Education :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="empschool" id="empschool" class="form-control" placeholder="Senior High School, Diploma/Academy, University, etc." required>
					                  </div>
					                </div>

									<div class="form-group">
					                  <label for="empsex" class="col-md-4 control-label">Emp Sex :</label>
					                  <div class="col-md-6">
					                  	<select name="empsex" class="form-control" required>
					                  		<option value="Male">MALE</option>
					                  		<option value="Female">FEMALE</option>
					                  	</select>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empmarital" class="col-md-4 control-label">Emp Marital :</label>
					                  <div class="col-md-6">
					                  	<select name="empmarital" class="form-control" required>
					                  		<option value="Nikah">Nikah</option>
					                  		<option value="Lajang">Lajang</option>
					                  		<option value="Janda">Janda</option>
					                  		<option value="Duda">Duda</option>
					                  	</select>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empreligi" class="col-md-4 control-label">Emp Religion :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="empreligi" id="empreligi" class="form-control" placeholder="Islam, Kristen, Katholik, Hindu, Budha, etc." required>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empnpwp" class="col-md-4 control-label">Emp NPWP :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="empnpwp" id="empnpwp" class="form-control" placeholder="47xxxxxxxxxxxxx, etc." required>
					                  </div>
					                </div>				                

					                <div class="form-group">
					                  <label for="emphealth" class="col-md-4 control-label">Emp Jamsostek :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="emphealth" id="emphealth" class="form-control" placeholder="100xxxxxxxxxx, etc." required>
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
					                  	<input type="text" name="empinhealth" id="empinhealth" class="form-control" placeholder="100xxxxxxxxxx, etc." required>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empgec" class="col-md-4 control-label">Emp GEC :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="empgec" id="empgec" class="form-control" placeholder="fill with - if not exist" required>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empdirect" class="col-md-4 control-label">Emp Direction :</label>
					                  <div class="col-md-6">
					                  	<select name="empdirect" class="form-control" required>
					                  		<option value="D">Direct</option>
					                  		<option value="ND">Not Direct</option>
					                  	</select>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empplace" class="col-md-4 control-label">Emp Place :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="empplace" id="empplace" class="form-control" placeholder="JAKARTA, SURABAYA etc." required>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empbirth" class="col-md-4 control-label">Emp Birthday :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="empbirth" id="empbirth" class="form-control" placeholder="YYYY-MM-DD 1945-08-17, etc." required>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empploy" class="col-md-4 control-label">Emp Employment Date :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="empploy" id="empploy" class="form-control" placeholder="YYYY-MM-DD 1945-08-17, etc." required>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="emppension" class="col-md-4 control-label">Emp Pension :</label>
					                  <div class="col-md-6">
					                  	<input type="text" name="emppension" id="emppension" class="form-control" placeholder="YYYY-MM-DD 1945-08-17, etc." required>
					                  </div>
					                </div>

					                <div class="form-group">
					                  <label for="empstatus" class="col-md-4 control-label">Emp Status :</label>
					                  <div class="col-md-6">
					                  	<select name="empstatus" class="form-control">
					                  		<option value="PT">Pegawai Tetap</option>
					                  		<option value="PKWT">PKWT</option>
					                  		<option value="PKWT EXT">PKWT EXT</option>
					                  		<option value="PENSIUN">Pensiun</option>
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
						/*for ($i=3; $i < mysqli_num_rows($result) ; $i++) { 
							echo $arr[$i]."<br>";
						}*/
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
				                    <input type="text" class="form-control" id="empauthno" name="empauthno" placeholder="Fill with 0 if not exist" required>
				                  </div>
				                </div>

				                <div class="form-group">
				                  <label for="empvalidity" class="col-md-4 control-label">Auth Validity :</label>

				                  <div class="col-md-6">
				                    <input type="text" class="form-control" id="empvalidity" name="empvalidity" placeholder="YYYY-MM-DD, 2016-12-31 or 0000-00-00" required>
				                  </div>
				                </div>
				                <?php
				                for ($i=3; $i < mysqli_num_rows($result)+3 ; $i++) { 
								?>
								<div class="form-group">
				                  <label for="pesawatrating[]" class="col-md-4 control-label"><?php echo $arr[$i];?> :</label>

				                  <div class="col-md-6">
				                  	<select name="pesawatrating[]" class="form-control" required>
					                  <?php
					                  $sql="SELECT * FROM rating";
					                  $result=mysqli_query($conn,$sql);
					                  while ($row=mysqli_fetch_array($result)) {
					                  ?>
					                  	<option value="<?php echo $row['rating_id'];?>"><?php echo $row['rating_code'];?></option>
					                  <?php
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