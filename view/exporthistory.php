<?php
session_start();
if (isset($_SESSION['username'])) {
	
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	require '../config/dbconnect.php';
	require '../template/header.php';
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
		        xmlhttp.open("GET","../controller/specification.php?q="+str,true);
		        xmlhttp.send();
		    }
		}
	</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	<header class="main-header">
		<!-- Logo -->
	    <a href="dashboard.php" class="logo">
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
	        Export History
	        <small>> Export history to excel</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-plus"></i> History</a></li>
	        <li class="active">Export</li>
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
			  	<form class="form-horizontal" action="../plugins/phpexcel/Examples/01exporthistory.php" method="post">
		    		<div class="col-md-6 col-md-offset-3">
		    			<div class="box box-info">
				            <div class="box-header with-border">
				              <h3 class="box-title">Export History</h3>
				            </div>
				            <!-- /.box-header -->
				            <!-- form start -->
							<div class="box-body">

								<div class="col-md-12">
									<!-- Date range -->
									<div class="form-group">
										<label for="reqdate" class="col-md-4 control-label">Range History :</label>
										<div class="input-group col-md-6">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
										  	<input type="text" class="form-control" id="reqdate" name="reqdate">
										</div>
										<!-- /.input group -->
									</div>
									<!-- /.form group -->
								</div>
							</div>
							<div class="box-footer">
								<button class="btn btn-warning pull-right">Export</button>
							</div>
				          </div>
		    		</div>		    		
	    		</form>
	    	</div>
	    </section>
	</div>
	<?php
	require '../template/copyright.php';
	?>
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
else{
	header("Location:../index.php");
}
?>