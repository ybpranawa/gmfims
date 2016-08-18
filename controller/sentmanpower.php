<?php
session_start();
require '../config/dbconnect.php';

foreach ($_POST['reqid'] as $row2) {
	$empid=$_POST[$row];
	$sql="UPDATE request_qualification SET personilsent_id='".$empid."' WHERE rq_id='".$row2."' ";
	$result=mysqli_query($conn,$sql);

	$sql="SELECT p.`personil_email` FROM personil_detail p WHERE personil_id='".$empid."' ";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);
	require 'sentmail';
}


$status=1;

$pesan="Manpower has been sent";
header("Location: ../view/viewassrequest.php?status=$status&pesan=$pesan");
?>