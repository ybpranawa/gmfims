<?php
session_start();
require '../config/dbconnect.php';
$sql="SELECT `station_origin`, `start_date`, `finish_date` FROM request";
$result=mysqli_query($conn,$sql);

while ($row=mysqli_fetch_assoc($result)) {
	$ys=date('Y',strtotime($row['start_date']))-0;
	$ms=date('m',strtotime($row['start_date']))-1;
	$ds=date('d',strtotime($row['start_date']))-0;

	
	$yf=date('Y',strtotime($row['finish_date']))-0;
	$mf=date('m',strtotime($row['finish_date']))-1;
	$df=date('d',strtotime($row['finish_date']))-0;

	$arr= array(
		"title" => $row['station_origin'], 
		"start" => date("Y-m-d",strtotime($row['start_date'])),
		"end" => date("Y-m-d",strtotime($row['finish_date']))
	);
}

echo json_encode($arr);
?>