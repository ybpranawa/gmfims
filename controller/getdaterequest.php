<?php
session_start();
require '../config/dbconnect.php';
$sql="SELECT `station_origin`, `start_date`, `finish_date`, status_request FROM request";
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
		"title" => $row['station_origin'], 
		"start" => date("Y-m-d",strtotime($row['start_date'])),
		"end" => date("Y-m-d",strtotime($row['finish_date'])),
		"color" => $color
	);
}

echo json_encode($arr);
/*$fp = fopen('jsondate', 'w');
fwrite($fp, json_encode($arr));
fclose($fp);*/

?>