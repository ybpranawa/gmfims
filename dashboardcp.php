<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	require 'config/dbconnect.php';
	?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Integrated Manpower System | GMF AeroAsia</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- fullCalendar 2.2.5-->
	<link rel="stylesheet" href="plugins/fullcalendar/fullcalendar.min.css">
	<link rel="stylesheet" href="plugins/fullcalendar/fullcalendar.print.css" media="print">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	   folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
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
						<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
							<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
							<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
						<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
	    	</div>
	    	<div class="row">
	    		<div class="col-md-8">
	    			<!-- MAP & BOX PANE -->
		          <div class="box box-success">
		            <div class="box-header with-border">
		              <h3 class="box-title">Visitors Report</h3>

		              <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		              </div>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body no-padding">
		              <div class="row">
		                <div class="col-md-9 col-sm-8">
		                  <div class="pad">
		                    <!-- Map will be created here -->
		                    <div id="world-map-markers" style="height: 325px;"></div>
		                  </div>
		                </div>
		                <!-- /.col -->
		                <div class="col-md-3 col-sm-4">
		                  <div class="pad box-pane-right bg-green" style="min-height: 280px">
		                    <div class="description-block margin-bottom">
		                      <div class="sparkbar pad" data-color="#fff">90,70,90,70,75,80,70</div>
		                      <h5 class="description-header">8390</h5>
		                      <span class="description-text">Visits</span>
		                    </div>
		                    <!-- /.description-block -->
		                    <div class="description-block margin-bottom">
		                      <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
		                      <h5 class="description-header">30%</h5>
		                      <span class="description-text">Referrals</span>
		                    </div>
		                    <!-- /.description-block -->
		                    <div class="description-block">
		                      <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
		                      <h5 class="description-header">70%</h5>
		                      <span class="description-text">Organic</span>
		                    </div>
		                    <!-- /.description-block -->
		                  </div>
		                </div>
		                <!-- /.col -->
		              </div>
		              <!-- /.row -->
		            </div>
		            <!-- /.box-body -->
		          </div>
		          <!-- /.box -->
	    		</div>

	    		<div class="col-md-4">
	    			<!-- Info Boxes Style 2 -->
		          <div class="info-box bg-yellow">
		            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-text">Inventory</span>
		              <span class="info-box-number">5,200</span>

		              <div class="progress">
		                <div class="progress-bar" style="width: 50%"></div>
		              </div>
		                  <span class="progress-description">
		                    50% Increase in 30 Days
		                  </span>
		            </div>
		            <!-- /.info-box-content -->
		          </div>
		          <!-- /.info-box -->
		          <div class="info-box bg-green">
		            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-text">Mentions</span>
		              <span class="info-box-number">92,050</span>

		              <div class="progress">
		                <div class="progress-bar" style="width: 20%"></div>
		              </div>
		                  <span class="progress-description">
		                    20% Increase in 30 Days
		                  </span>
		            </div>
		            <!-- /.info-box-content -->
		          </div>
		          <!-- /.info-box -->
		          <div class="info-box bg-red">
		            <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-text">Downloads</span>
		              <span class="info-box-number">114,381</span>

		              <div class="progress">
		                <div class="progress-bar" style="width: 70%"></div>
		              </div>
		                  <span class="progress-description">
		                    70% Increase in 30 Days
		                  </span>
		            </div>
		            <!-- /.info-box-content -->
		          </div>
		          <!-- /.info-box -->
		          <div class="info-box bg-aqua">
		            <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-text">Direct Messages</span>
		              <span class="info-box-number">163,921</span>

		              <div class="progress">
		                <div class="progress-bar" style="width: 40%"></div>
		              </div>
		                  <span class="progress-description">
		                    40% Increase in 30 Days
		                  </span>
		            </div>
		            <!-- /.info-box-content -->
		          </div>
		          <!-- /.info-box -->
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="col-md-3">
		          <div class="box box-solid">
		            <div class="box-header with-border">
		              <h4 class="box-title">Draggable Events</h4>
		            </div>
		            <div class="box-body">
		              <!-- the events -->
		              <div id="external-events">
		                <div class="external-event bg-green">Lunch</div>
		                <div class="external-event bg-yellow">Go home</div>
		                <div class="external-event bg-aqua">Do homework</div>
		                <div class="external-event bg-light-blue">Work on UI design</div>
		                <div class="external-event bg-red">Sleep tight</div>
		                <div class="checkbox">
		                  <label for="drop-remove">
		                    <input type="checkbox" id="drop-remove">
		                    remove after drop
		                  </label>
		                </div>
		              </div>
		            </div>
		            <!-- /.box-body -->
		          </div>
		          <!-- /. box -->
		          <div class="box box-solid">
		            <div class="box-header with-border">
		              <h3 class="box-title">Create Event</h3>
		            </div>
		            <div class="box-body">
		              <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
		                <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
		                <ul class="fc-color-picker" id="color-chooser">
		                  <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
		                  <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
		                  <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
		                  <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
		                  <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
		                  <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
		                  <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
		                  <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
		                  <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
		                  <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
		                  <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
		                  <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
		                  <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
		                </ul>
		              </div>
		              <!-- /btn-group -->
		              <div class="input-group">
		                <input id="new-event" type="text" class="form-control" placeholder="Event Title">

		                <div class="input-group-btn">
		                  <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Add</button>
		                </div>
		                <!-- /btn-group -->
		              </div>
		              <!-- /input-group -->
		            </div>
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

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/fullcalendar/fullcalendar.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 1070,
          revert: true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        });

      });
    }

    ini_events($('#external-events div.external-event'));

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week: 'week',
        day: 'day'
      },
      //Random default events
      events: [
        {
          title: 'All Day Event',
          start: new Date(y, m, 1),
          backgroundColor: "#f56954", //red
          borderColor: "#f56954" //red
        },
        {
          title: 'Long Event',
          start: new Date(y, m, d - 5),
          end: new Date(y, m, d - 2),
          backgroundColor: "#f39c12", //yellow
          borderColor: "#f39c12" //yellow
        },
        {
          title: 'Meeting',
          start: new Date(y, m, d, 10, 30),
          allDay: false,
          backgroundColor: "#0073b7", //Blue
          borderColor: "#0073b7" //Blue
        },
        {
          title: 'Lunch',
          start: new Date(y, m, d, 12, 0),
          end: new Date(y, m, d, 14, 0),
          allDay: false,
          backgroundColor: "#00c0ef", //Info (aqua)
          borderColor: "#00c0ef" //Info (aqua)
        },
        {
          title: 'Birthday Party',
          start: new Date(y, m, d + 1, 19, 0),
          end: new Date(y, m, d + 1, 22, 30),
          allDay: false,
          backgroundColor: "#00a65a", //Success (green)
          borderColor: "#00a65a" //Success (green)
        },
        {
          title: 'Click for Google',
          start: new Date(y, m, 28),
          end: new Date(y, m, 29),
          url: 'http://google.com/',
          backgroundColor: "#3c8dbc", //Primary (light-blue)
          borderColor: "#3c8dbc" //Primary (light-blue)
        }
      ],
      editable: true,
      droppable: true, // this allows things to be dropped onto the calendar !!!
      drop: function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject');

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject);

        // assign it the date that was reported
        copiedEventObject.start = date;
        copiedEventObject.allDay = allDay;
        copiedEventObject.backgroundColor = $(this).css("background-color");
        copiedEventObject.borderColor = $(this).css("border-color");

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
        }

      }
    });

    /* ADDING EVENTS */
    var currColor = "#3c8dbc"; //Red by default
    //Color chooser button
    var colorChooser = $("#color-chooser-btn");
    $("#color-chooser > li > a").click(function (e) {
      e.preventDefault();
      //Save color
      currColor = $(this).css("color");
      //Add color effect to button
      $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
    });
    $("#add-new-event").click(function (e) {
      e.preventDefault();
      //Get value and make sure it is not null
      var val = $("#new-event").val();
      if (val.length == 0) {
        return;
      }

      //Create events
      var event = $("<div />");
      event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
      event.html(val);
      $('#external-events').prepend(event);

      //Add draggable funtionality
      ini_events(event);

      //Remove event from text input
      $("#new-event").val("");
    });
  });
</script>
</body>
</html>