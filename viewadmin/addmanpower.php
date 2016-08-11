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
	    		<div class="col-md-6 col-md-offset-3">
		          <!-- Horizontal Form -->
		          <div class="box box-info">
		            <div class="box-header with-border">
		              <h3 class="box-title">Add Employee</h3>
		            </div>
		            <!-- /.box-header -->
		            <!-- form start -->
		            <form class="form-horizontal">
		              <div class="box-body">
		                <div class="form-group">
		                  <label for="empid" class="col-md-4 control-label">Employee ID :</label>

		                  <div class="col-md-6">
		                    <input type="text" class="form-control" id="stationid" name="stationid" placeholder="511111, etc." required>
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
		                  <label for="empauthno" class="col-md-4 control-label">Emp Auth No. :</label>

		                  <div class="col-md-6">
		                    <input type="text" class="form-control" id="empauthno" name="empauthno" placeholder="11111, etc." required>
		                  </div>
		                </div>

		                <div class="form-group">
		                  <label for="empvalidity" class="col-md-4 control-label">Auth Validity :</label>

		                  <div class="col-md-6">
		                    <input type="text" class="form-control" id="empvalidity" name="empvalidity" placeholder="YYYY-MM-DD, 2016-12-31" required>
		                  </div>
		                </div>

		                <div class="form-group">
		                  <label for="emp737cl" class="col-md-4 control-label">B737CL :</label>

		                  <div class="col-md-6">
		                  	<select name="emp737cl" class="form-control" required>
		                  		<option value="">-</option>
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

		                <div class="form-group">
		                  <label for="emp737ng" class="col-md-4 control-label">B737NG :</label>

		                  <div class="col-md-6">
		                  	<select name="emp737ng" class="form-control" required>
		                  		<option value="">-</option>
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

		                <div class="form-group">
		                  <label for="empcrj1000" class="col-md-4 control-label">CRJ1000 :</label>

		                  <div class="col-md-6">
		                  	<select name="empcrj1000" class="form-control" required>
		                  		<option value="">-</option>
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

		                <div class="form-group">
		                  <label for="emp747" class="col-md-4 control-label">B747 :</label>

		                  <div class="col-md-6">
		                  	<select name="emp747" class="form-control" required>
		                  		<option value="">-</option>
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

		                <div class="form-group">
		                  <label for="emp777" class="col-md-4 control-label">B777 :</label>

		                  <div class="col-md-6">
		                  	<select name="emp777" class="form-control" required>
		                  		<option value="">-</option>	
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

		                <div class="form-group">
		                  <label for="empa330" class="col-md-4 control-label">A330 :</label>

		                  <div class="col-md-6">
		                  	<select name="empa330" class="form-control" required>
		                  		<option value="">-</option>
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

		                <div class="form-group">
		                  <label for="empa320" class="col-md-4 control-label">A320 :</label>

		                  <div class="col-md-6">
		                  	<select name="empa320" class="form-control" required>
		                  		<option value="">-</option>
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

		                <div class="form-group">
		                  <label for="empatr" class="col-md-4 control-label">ATR :</label>

		                  <div class="col-md-6">
		                  	<select name="empatr" class="form-control" required>
		                  		<option value="">-</option>
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
		                  		<option value="MALE">MALE</option>
		                  		<option value="FEMALE">FEMALE</option>
		                  	</select>
		                  </div>
		                </div>

		                <div class="form-group">
		                  <label for="empmarital" class="col-md-4 control-label">Emp Marital :</label>
		                  <div class="col-md-6">
		                  	<select name="empmarital" class="form-control" required>
		                  		<option value="NIKAH">Nikah</option>
		                  		<option value="LAJANG">Lajang</option>
		                  		<option value="JANDA">Janda</option>
		                  		<option value="DUDA">Duda</option>
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

		                <div class="form-group">
		                  <label for="empgec" class="col-md-4 control-label">Emp GEC :</label>
		                  <div class="col-md-6">
		                  	<input type="text" name="empgec" id="empgec" class="form-control" placeholder="" required>
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
		                  	<input type="text" name="empbirh" id="empbirth" class="form-control" placeholder="YYYY-MM-DD 1945-08-17, etc." required>
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
		                  		<option value="PKWT EXT">PKWT</option>
		                  	</select>
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