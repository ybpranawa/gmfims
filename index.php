<!DOCTYPE html>
<html>
<head>
	<?php
	require "config/dbconnect.php";
	?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!--
	This system created by : Yoga Bayu Aji Pranawa (ybpranawa)
	Under licensed by Institut Teknologi Sepuluh Nopember and PT. GMF AeroAsia
	You can not modify, sell, distribute, etc this system without have a permission
	copyright @ 2016
	-->
	<title>Integrated Manpower System | GMF AeroAsia</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- DataTables -->
	 <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	   folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
	<!-- Morris chart -->
	<link rel="stylesheet" href="plugins/morris/morris.css">
	<!-- Date Picker -->
	<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<link rel="stylesheet" href="plugins/iCheck/square/blue.css">
	<!-- Leaflet css -->
	<link href="plugins/leaflet/leaflet.css" rel="stylesheet">
	<!-- Leaflet Javascript -->
	<script src="plugins/leaflet/leaflet.js"></script>
	<style type="text/css">
	html,body{
		height: 100%;
	}
	</style>
	
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
<div class="row">
	<header class="main-header">
		<div class="col-sm-4">
			<!-- Logo -->
		    <a href="index.php" class="logo">
		      <!-- mini logo for sidebar mini 50x50 pixels -->
		      <span class="logo-mini"><b>G</b>MF</span>
		      <!-- logo for regular state and mobile devices -->
		      <span class="logo-lg"><b>G </b>M F</span>
		    </a>	   
		</div>
		<div class="col-md-8">
			<nav class="navbar navbar-fixed-top">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				  <span class="sr-only">Toggle navigation</span>
				</a>

				<div class="col-md-8 text-center" style="color: #FFFFFF;font-size: 24px; padding: 5px; floating:left;">
				  Integrated <b>Manpower </b>System
				</div>

				<div class="navbar-custom-menu" style="floating:left;">
				  <ul class="nav navbar-nav">
				    <?php
				    if (isset($_SESSION['username'])) {
				    ?>
				    <!-- Messages: style can be found in dropdown.less-->
				    <li class="dropdown messages-menu">
				      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				        <i class="fa fa-envelope-o"></i>
				        <span class="label label-success">4</span>
				      </a>
				      <ul class="dropdown-menu">
				        <li class="header">You have 4 messages</li>
				        <li>
				          <!-- inner menu: contains the actual data -->
				          <ul class="menu">
				            <li><!-- start message -->
				              <a href="#">
				                <div class="pull-left">
				                  <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
				                </div>
				                <h4>
				                  Support Team
				                  <small><i class="fa fa-clock-o"></i> 5 mins</small>
				                </h4>
				                <p>Why not buy a new awesome theme?</p>
				              </a>
				            </li>
				            <!-- end message -->
				            <li>
				              <a href="#">
				                <div class="pull-left">
				                  <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
				                </div>
				                <h4>
				                  AdminLTE Design Team
				                  <small><i class="fa fa-clock-o"></i> 2 hours</small>
				                </h4>
				                <p>Why not buy a new awesome theme?</p>
				              </a>
				            </li>
				            <li>
				              <a href="#">
				                <div class="pull-left">
				                  <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
				                </div>
				                <h4>
				                  Developers
				                  <small><i class="fa fa-clock-o"></i> Today</small>
				                </h4>
				                <p>Why not buy a new awesome theme?</p>
				              </a>
				            </li>
				            <li>
				              <a href="#">
				                <div class="pull-left">
				                  <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
				                </div>
				                <h4>
				                  Sales Department
				                  <small><i class="fa fa-clock-o"></i> Yesterday</small>
				                </h4>
				                <p>Why not buy a new awesome theme?</p>
				              </a>
				            </li>
				            <li>
				              <a href="#">
				                <div class="pull-left">
				                  <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
				                </div>
				                <h4>
				                  Reviewers
				                  <small><i class="fa fa-clock-o"></i> 2 days</small>
				                </h4>
				                <p>Why not buy a new awesome theme?</p>
				              </a>
				            </li>
				          </ul>
				        </li>
				        <li class="footer"><a href="#">See All Messages</a></li>
				      </ul>
				    </li>
				    <!-- Notifications: style can be found in dropdown.less -->
				    <li class="dropdown notifications-menu">
				      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				        <i class="fa fa-bell-o"></i>
				        <span class="label label-warning">10</span>
				      </a>
				      <ul class="dropdown-menu">
				        <li class="header">You have 10 notifications</li>
				        <li>
				          <!-- inner menu: contains the actual data -->
				          <ul class="menu">
				            <li>
				              <a href="#">
				                <i class="fa fa-users text-aqua"></i> 5 new members joined today
				              </a>
				            </li>
				            <li>
				              <a href="#">
				                <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
				                page and may cause design problems
				              </a>
				            </li>
				            <li>
				              <a href="#">
				                <i class="fa fa-users text-red"></i> 5 new members joined
				              </a>
				            </li>
				            <li>
				              <a href="#">
				                <i class="fa fa-shopping-cart text-green"></i> 25 sales made
				              </a>
				            </li>
				            <li>
				              <a href="#">
				                <i class="fa fa-user text-red"></i> You changed your username
				              </a>
				            </li>
				          </ul>
				        </li>
				        <li class="footer"><a href="#">View all</a></li>
				      </ul>
				    </li>
				    <!-- Tasks: style can be found in dropdown.less -->
				    <li class="dropdown tasks-menu">
				      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				        <i class="fa fa-flag-o"></i>
				        <span class="label label-danger">9</span>
				      </a>
				      <ul class="dropdown-menu">
				        <li class="header">You have 9 tasks</li>
				        <li>
				          <!-- inner menu: contains the actual data -->
				          <ul class="menu">
				            <li><!-- Task item -->
				              <a href="#">
				                <h3>
				                  Design some buttons
				                  <small class="pull-right">20%</small>
				                </h3>
				                <div class="progress xs">
				                  <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
				                    <span class="sr-only">20% Complete</span>
				                  </div>
				                </div>
				              </a>
				            </li>
				            <!-- end task item -->
				            <li><!-- Task item -->
				              <a href="#">
				                <h3>
				                  Create a nice theme
				                  <small class="pull-right">40%</small>
				                </h3>
				                <div class="progress xs">
				                  <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
				                    <span class="sr-only">40% Complete</span>
				                  </div>
				                </div>
				              </a>
				            </li>
				            <!-- end task item -->
				            <li><!-- Task item -->
				              <a href="#">
				                <h3>
				                  Some task I need to do
				                  <small class="pull-right">60%</small>
				                </h3>
				                <div class="progress xs">
				                  <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
				                    <span class="sr-only">60% Complete</span>
				                  </div>
				                </div>
				              </a>
				            </li>
				            <!-- end task item -->
				            <li><!-- Task item -->
				              <a href="#">
				                <h3>
				                  Make beautiful transitions
				                  <small class="pull-right">80%</small>
				                </h3>
				                <div class="progress xs">
				                  <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
				                    <span class="sr-only">80% Complete</span>
				                  </div>
				                </div>
				              </a>
				            </li>
				            <!-- end task item -->
				          </ul>
				        </li>
				        <li class="footer">
				          <a href="#">View all tasks</a>
				        </li>
				      </ul>
				    </li>
				    <!-- User Account: style can be found in dropdown.less -->
				    <li class="dropdown user user-menu">
				      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				        <img src="images/gmflogo.jpg" class="user-image" alt="User Image">
				        <span class="hidden-xs"><?php echo $_SESSION['username'];?></span>
				      </a>
				      <ul class="dropdown-menu">
				        <!-- User image -->
				        <li class="user-header">
				          <img src="images/gmflogo.jpg" class="img-circle" alt="User Image">

				          <p>
				            <?php echo $_SESSION['username'];?>
				            <small>last login : </small>
				          </p>
				        </li>
				        <!-- Menu Body -->
				        <li class="user-body">
				          <div class="row">
				            <div class="col-xs-4 text-center">
				              <a href="#">Followers</a>
				            </div>
				            <div class="col-xs-4 text-center">
				              <a href="#">Sales</a>
				            </div>
				            <div class="col-xs-4 text-center">
				              <a href="#">Friends</a>
				            </div>
				          </div>
				          <!-- /.row -->
				        </li>
				        <!-- Menu Footer-->
				        <li class="user-footer">
				          <div class="pull-left">
				            <a href="#" class="btn btn-default btn-flat">Profile</a>
				          </div>
				          <div class="pull-right">
				            <a href="controller/logoutmethod.php" class="btn btn-default btn-flat">Sign out</a>
				          </div>
				        </li>
				      </ul>
				    </li>
				    
				    <?php
				    }
				    else
				    {
				    ?>
				    <!-- User Account: style can be found in dropdown.less -->
				    <li class="dropdown user user-menu">
				      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				        <img src="images/gmflogo.jpg" class="user-image" alt="User Image">
				        <span class="hidden-xs">VISITOR</span>
				      </a>
				      <ul class="dropdown-menu">
				        <!-- User image -->
				        <li class="user-header">
				          <img src="images/gmflogo.jpg" class="img-circle" alt="User Image">

				          <p>
				            Welcome VISITOR, <small>Please login to access this system</small>
				            <small>Garuda Maintenance Facility Aeroasia</small>
				          </p>
				        </li>
				       
				        <!-- Menu Footer-->
				        <li class="user-footer">
				          <div class="pull-right">
				            <a href="internallogin.php" class="btn btn-default btn-flat">Login</a>
				          </div>
				        </li>
				      </ul>
				    </li>
				   
				    <?php
				    }
				    ?>
				  </ul>
				</div>
			</nav>
		</div>
	</header>
</div>
<div class="row" style="height:92%;">
	<!-- <div id="mapid1" class="mapclass" style="height: 100%;"></div>	 -->
	<img src="images/home.jpg" height="100%" width="100%">
</div>

<script>
<?php
//include 'controller/getmap.php';
?>


var greenmarker = L.icon({
	iconUrl: 'plugins/leaflet/images/greenmarker.png',
	iconSize:     [38, 38],
	iconAnchor:   [38, 38],
	popupAnchor:  [-20, -39]
});

//var datalength=statcoordinate.length;

var mymap1 = L.map('mapid1').setView([0.7893, 113.9213], 5);
L.tileLayer(MB_URL, {attribution: MB_ATTR, id: 'ybpranawa.0p0gee2o'}).addTo(mymap1);

/*L.marker([-7.370151, 112.788023], {icon: greenmarker}).addTo(mymap1).bindPopup("<b>SUB</b><br />Juanda Intl.");

L.marker([-6.131005, 106.65609], {icon: greenmarker}).addTo(mymap1).bindPopup("<b>CGK</b><br />Soekarno-Hatta Intl.");
*/
/*for (var i = 0; i < datalength; i++) {
	L.marker(statcoordinate[i], {icon:greenmarker}).addTo(mymap1);
};*/

</script>

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- iCheck js -->
<script src="plugins/iCheck/icheck.min.js"></script>

</body>
</html>