<?php
session_start();
require '../config/dbconnect.php';

foreach ($_POST['reqid'] as $row) {
	$empid=$_POST[$row];
	$sql="UPDATE request_qualification SET personilsent_id='".$empid."' WHERE rq_id='".$row."' ";
	$result=mysqli_query($conn,$sql);
}

$status=1;

$pesan="Manpower has been sent";
header("Location: ../viewprovider/viewassrequest.php?status=$status&pesan=$pesan");
?>