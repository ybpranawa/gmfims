<?php
session_start();
require '../config/dbconnect.php';
$reqid=$_POST['requestid'];
$cp=$_SESSION['username'];
$approved=date("Y-m-d");
$msg=$_POST['message'];
$provid=$_POST['manager'];
$unit=$_POST['unit'];

$statusreq='2';
$sql="UPDATE request SET centralplanner_id='".$cp."', approved_date='".$approved."', centralplanner_msg='".$msg."', provider_id='".$provid."', status_request='".$statusreq."', unit_id='".$unit."'
WHERE request_id='".$reqid."' ";
$result=mysqli_query($conn,$sql);

$sql="SELECT p.`personil_email` FROM personil_detail p WHERE p.`personil_id`='".$provid."' ";
$result=mysqli_query($conn,$sql);
while ($row=mysqli_fetch_array($result)) {
	require 'sentmail.php';	
}

$status=1;

$pesan="Request has been accepted";
header("Location: ../view/viewrequest.php?status=$status&pesan=$pesan");

?>