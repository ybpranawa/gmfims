<?php
session_start();
require '../config/dbconnect.php';
$sql="SELECT r.`station_origin`, r.`start_date`, r.`finish_date`, r.`status_request`, q.`qualification_code`, rt.`rating_code` FROM request r JOIN request_qualification rq ON 
r.request_id=rq.`request_id` JOIN qualification q ON q.`qualification_id`=rq.`qualification_id` JOIN rating rt ON rt.`rating_id`=rq.`rating_id`";
$result=mysqli_query($conn,$sql);

while ($row=mysqli_fetch_assoc($result)) {
	$ys=date('Y',strtotime($row['start_date']))-0;
	$ms=date('m',strtotime($row['start_date']))-1;
	$ds=date('d',strtotime($row['start_date']))-0;

	
	$yf=date('Y',strtotime($row['finish_date']))-0;
	$mf=date('m',strtotime($row['finish_date']))-1;
	$df=date('d',strtotime($row['finish_date']))-0;

	if ($row['status_request']=='0'||$row['status_request']=='5') {
		$color="#D50000";
	}
	elseif ($row['status_request']=='1') {
		$color="#FFC107";
	}
	elseif ($row['status_request']=='2') {
		$color="#43A047";
	}
	elseif ($row['status_request']=='3') {
		$color="#039BE5";
	}
	elseif ($row['status_request']=='4') {
		$color="#43A047";	
	}

	$arr[]= array(
		"title" => $row['station_origin']." ".$row['qualification_code']." Up to ".$row['rating_code'], 
		"start" => date("Y-m-d",strtotime($row['start_date'])),
		"end" => date("Y-m-d",strtotime($row['finish_date'])),
		"url" => "viewrequest.php",
		"color" => $color
	);
}

echo json_encode($arr);
/*$fp = fopen('jsondate', 'w');
fwrite($fp, json_encode($arr));
fclose($fp);*/

?>