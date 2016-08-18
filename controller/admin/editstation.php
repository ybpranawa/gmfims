<?php
session_start();
require '../../config/dbconnect.php';

$stationid=strtoupper($_POST['stationid']);
$stationname=$_POST['stationname'];
$unit=$_POST['unitid'];
$lat=$_POST['lat'];
$long=$_POST['long'];

$sql="UPDATE station SET station_name='".$stationname."',unit_id='".$unit."' WHERE station_id='".$stationid."' ";
$result=mysqli_query($conn,$sql);
$sql="UPDATE station_detail SET station_lat='".$lat."', station_long='".$long."' WHERE station_id='".$stationid."' ";
$result=mysqli_query($conn,$sql);
$status=1;
$pesan="Station has been submitted";
header("Location:../../viewadmin/editstation.php?status=$status&pesan=$pesan");	
?>