<?php
session_start();
require '../config/dbconnect.php';

$requestid=$_POST['requestid'];
$provmsg=$_POST['provmsg'];

$sql2="SELECT personil_station FROM personil WHERE personil_id='".$_SESSION['username']."' ";
$result2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_array($result2);

$sql="UPDATE request SET station_provider='".$row2['personil_station']."', provider_msg='".$provmsg."' WHERE request_id='".$requestid."' ";
$result=mysqli_query($conn,$sql);

foreach ($_POST['reqid'] as $row2) {
	$empid=$_POST[$row2];
	$sql="UPDATE request_qualification SET personilsent_id='".$empid."' WHERE rq_id='".$row2."' ";
	$result=mysqli_query($conn,$sql);

	$sql="SELECT p.`personil_email` FROM personil_detail p WHERE personil_id='".$empid."' ";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);
	
}


$status=1;

$pesan="Manpower has been sent";
header("Location: ../view/viewassrequest.php?status=$status&pesan=$pesan");
?>