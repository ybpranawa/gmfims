<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	require 'config/dbconnect.php';
	require 'template/header.php';
	?>
	<script type="text/javascript">
	$(document).ready(function(){
	    var maxField = 10; //Input fields increment limitation
	    var addButton = $('.add_button'); //Add button selector
	    var wrapper = $('.field_wrap'); //Input field wrapper
	    var fieldHTML = '<div class="input-group"><select class="form-control" name="actype[]"><option>B777 NG</option><option>B747</option><option>B777</option><option>A330</option><option>CRJ</option><option>ATR</option><option>B737 CL</option><option>A320</option></select><span class="input-group-addon"><a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-minus"></i></a></span></div>'; //New input field html 
	    var x = 1; //Initial field counter is 1
	    $(addButton).click(function(){ //Once add button is clicked
	        if(x < maxField){ //Check maximum number of input fields
	            x++; //Increment field counter
	            $(wrapper).append(fieldHTML); // Add field html
	        }
	    });
	    $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
	        e.preventDefault();
	        $(this).parent('div').remove(); //Remove field html
	        x--; //Decrement field counter
	    });
	});
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
	        Make Request
	        <small>> Request to central planner</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-plus"></i> Request</a></li>
	        <li class="active">Make Request</li>
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
			            $sql="SELECT * FROM station";
			            $result=mysqli_query($conn,$sql);			            
			            ?>
			            <form class="form-horizontal" action="controller/newrequest.php" method="post">
							<div class="box-body">
								<div class="form-group">
									<label for="station" class="col-md-4 control-label">Station Origin :</label>
									<div class="input-group">
										<select class="form-control" name="station">
											<?php
											while ($row=mysqli_fetch_array($result)) {
												echo "<option value='".$row['station_id']."'>".$row['station_id']."</option>";
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
										<input class="form-control" type="number" id="qty" name="qty">
									</div>
								</div>

								<div class="form-group">
									<label for="qualification" class="col-md-4 control-label">Qualification :</label>
									<div class="input-group">
										<select class="form-control" name="qualification">
											<?php
											$sql="SELECT * FROM qualification";
											$result=mysqli_query($conn,$sql);
											while ($row=mysqli_fetch_array($result)) {
												echo "<option value='".$row['qualification_id']."'>".$row['qualification_code']."</option> ";
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
										    <?php
										    while ($row=mysqli_fetch_array($result)) {
										    	echo "<option value='".$row['pesawat_id']."'>".$row['pesawat_id']."</option>";
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
										    <?php
										    while ($row=mysqli_fetch_array($result)) {
										    	echo "<option value='".$row['rating_id']."'>".$row['rating_code']."</option>";
										    }
										    ?>
										</select>

									</div>
								</div>

								<div class="form-group">
									<label for="note" class="col-md-4 control-label">Additional note :</label>
									<div class="input-group col-md-7">
										<textarea name="note" id="note" class="form-control"></textarea>
									</div>
								</div>

								

							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<div class="form-group">
									<label for="reason" class="col-md-4 control-label">Reason :</label>
									<div class="input-group">
										<input class="form-control" name="reason" id="reason">
									</div>
								</div>
								<div class="form-group">
									<label for="reimburstment" class="col-md-4 control-label">Status Reimburstment :</label>
									<div class="input-group">
										<select class="form-control" name="reimburstment">
										    <option value="1">PBTH</option>
										    <option value="2">TMB</option>
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