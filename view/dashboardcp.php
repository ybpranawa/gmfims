<?php
session_start();
if (isset($_SESSION['username'])) {
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="refresh" content="15">
	<?php
	require '../config/dbconnect.php';
	?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Integrated Manpower System | GMF AeroAsia</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- fullCalendar 2.2.5-->
	<link rel="stylesheet" href="../plugins/fullcalendar/fullcalendar.min.css">
	<link rel="stylesheet" href="../plugins/fullcalendar/fullcalendar.print.css" media="print">
	<!-- Theme style -->
	<link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	   folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
	<!-- Leaflet css -->
	<link href="../plugins/leaflet/leaflet.css" rel="stylesheet">
	<!-- Leaflet Javascript -->
	<script src="../plugins/leaflet/leaflet.js"></script>
	<script>
		ACCESS_TOKEN = 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw';
		MB_ATTR = 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
			'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="http://mapbox.com">Mapbox</a>';
		MB_URL = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=' + ACCESS_TOKEN;
		OSM_URL = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
		OSM_ATTRIB = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors';
	</script>
	
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	<header class="main-header">
		<!-- Logo -->
	    <a href="dashboardcp.php" class="logo">
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
	        Dashboard
	        <small>> View overall activity</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-plus"></i> Home</a></li>
	        <li class="active">Dashboard</li>
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
	    	$sql="SELECT COUNT(request_id) AS jmlreq FROM request WHERE centralplanner_id='".$_SESSION['username']."'";
	    	$result=mysqli_query($conn,$sql);
	    	$row=mysqli_fetch_array($result);
	    	?>
	    	<div class="row">
	    		<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-yellow">
						<div class="inner">
					  		<h3><?php echo $row['jmlreq'];?></h3>

					  		<p>Requests Received</p>
						</div>
						<div class="icon">
					  		<i class="ion ion-bag"></i>
						</div>
						<a href="historycp.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>

					</div>
					<?php
			    	$sql="SELECT COUNT(request_id) AS jmlreq FROM request WHERE status_request='2' AND centralplanner_id='".$_SESSION['username']."'";
			    	$result=mysqli_query($conn,$sql);
			    	$row=mysqli_fetch_array($result);
			    	?>
					<!-- ./col -->
					<div class="col-lg-3 col-xs-6">
					<!-- small box -->
						<div class="small-box bg-green">
							<div class="inner">
				  				<h3><?php echo $row['jmlreq'];?></h3>

				  				<p>Requests Accepted</p>
							</div>
							<div class="icon">
				  				<i class="ion ion-stats-bars"></i>
							</div>
							<a href="historycp.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<?php
			    	$sql="SELECT COUNT(request_id) AS jmlreq FROM request WHERE status_request='4' AND centralplanner_id='".$_SESSION['username']."'";
			    	$result=mysqli_query($conn,$sql);
			    	$row=mysqli_fetch_array($result);
			    	?>
					<!-- ./col -->
					<div class="col-lg-3 col-xs-6">
					<!-- small box -->
						<div class="small-box bg-aqua">
							<div class="inner">
					  			<h3><?php echo $row['jmlreq'];?></h3>

					  			<p>Requests Done</p>
							</div>
							<div class="icon">
							  	<i class="ion ion-person-add"></i>
							</div>
							<a href="historycp.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<?php
			    	$sql="SELECT ROUND(AVG(request_total)) AS jmlreq FROM request WHERE centralplanner_id='".$_SESSION['username']."'";
			    	$result=mysqli_query($conn,$sql);
			    	$row=mysqli_fetch_array($result);
			    	?>
					<!-- ./col -->
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-red">
							<div class="inner">
							  	<h3><?php if ($row['jmlreq']==NULL) 
							  	echo "0";
							  	else
							  	echo $row['jmlreq'];?></h3>

							  	<p>Avg. Total Qualification</p>
							</div>
						<div class="icon">
						  	<i class="ion ion-pie-graph"></i>
						</div>
						<a href="historycp.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
	    	</div>
	    	<div class="row">
	    		<div class="col-md-12">
	    			<div class="box box-success">
	    				<div class="box-header">
	    					<h4 class="box-title">Request by Station</h4>
	    				</div>
	    				<div class="box-body">
	    					<div id="mapid1" class="mapclass" style="height: 100%;">
	    						<div style="height:300px;">
	    							
	    						</div>	
	    					</div>	
	    				</div>
	    			</div>
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="col-md-3">
		          <div class="box box-solid">
		            <div class="box-header with-border">
		              <h4 class="box-title">Glossary</h4>
		            </div>
		            <div class="box-body">
		              <!-- the events -->
		              <div id="external-events">
		              	<div class="external-event bg-yellow">Requested</div>
		                <div class="external-event bg-green">Accepted by CP</div>
		                <div class="external-event bg-aqua">Processed by provider</div>
		                <div class="external-event bg-red">Canceled/Rejected</div>
		              </div>
		            </div>
		            <!-- /.box-body -->
		          </div>
		         
		        </div>
		        <!-- /.col -->
		        <div class="col-md-9">
		          <div class="box box-primary">
		            <div class="box-body no-padding">
		              <!-- THE CALENDAR -->
		              <div id="calendar"></div>
		            </div>
		            <!-- /.box-body -->
		          </div>
		          <!-- /. box -->
		        </div>
		        <!-- /.col -->
	    	</div>	    	
	    </section>
	</div>
</div>
<script>
<?php
include '../controller/getmap.php';
include '../controller/getmarker.php';
?>

//var statcoordinate = [-3.705791,128.088876]

//var hello="L.marker([-3.705791,128.088876], {icon:greenmarker}).addTo(mymap1)";

var datalength=statcoordinate.length;

var greenmarker = L.icon({
	iconUrl: '../plugins/leaflet/images/greenpoint.png',
	iconSize:     [10, 10]
});

var redmarker = L.icon({
	iconUrl: '../plugins/leaflet/images/redpoint.png',
	iconSize:     [10, 10]
});

var mymap1 = L.map('mapid1').setView([0.7893, 113.9213], 5);
L.tileLayer(MB_URL, {attribution: MB_ATTR, id: 'ybpranawa.0p0gee2o'}).addTo(mymap1);

for (var i = 0; i < datalength; i++) {
	L.marker(statcoordinate[i], marker[i]).addTo(mymap1);
	//console.log(marker[i]);
	//console.log(statcoordinate[i]);
};



</script>
<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Slimscroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="../plugins/fullcalendar/fullcalendar.min.js"></script>
<!-- Page specific script -->
<script>
  $(document).ready(function () {

	$('#calendar').fullCalendar({
		events:'../controller/getdaterequest.php',
		header: {
	        left: 'prev,next today',
	        center: 'title',
	        right: 'month,agendaWeek,agendaDay'
	      }
	});
  });
</script>
</body>
</html>
<?php
}
else{
	header("Location:../index.php");
}
?>