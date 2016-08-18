<?php
session_start();
require '../../config/dbconnect.php';

$stationid=strtoupper($_POST['stationid']);
$stationname=$_POST['stationname'];
$unit=$_POST['unitid'];
$lat=$_POST['lat'];
$long=$_POST['long'];

$sql="SELECT station_id FROM station WHERE station_id='".$stationid."'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
if ($row['station_id']==NULL) {
	$sql="INSERT INTO station VALUES('".$stationid."','".$stationname."','".$unit."')";
	$result=mysqli_query($conn,$sql);
	$sql="INSERT INTO station_detail VALUES('".$stationid."','".$lat."','".$long."')";
	$result=mysqli_query($conn,$sql);
	$status=1;
	$pesan="Station has been submitted";
	header("Location:../../viewadmin/addstation.php?status=$status&pesan=$pesan");	
}
else {
	$status=0;
	$pesan="Station is Exist (refers to station ID)";
	header("Location:../../viewadmin/addstation.php?status=$status&pesan=$pesan");
}
?>