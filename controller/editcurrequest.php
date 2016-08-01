<?php
session_start();
require '../config/dbconnect.php';

$station=$_POST['station'];
$request_id=$_POST['requestid'];
$requester=$_SESSION['username'];
$reqdate=$_POST['reqdate'];
$date=explode(" - ", $reqdate);

$fromdate=$date[0];
$todate=$date[1];
$qty=$_POST['qty'];
$qualification=$_POST['qualification'];
$actype=$_POST['actype'];
$rating=$_POST['rating'];
$note=$_POST['note'];
$statusrequest="1";
$reason=$_POST['reason'];
$reimburstment=$_POST['reimburstment'];

$sql="UPDATE request SET station_origin='".$station."', requester_id='".$requester."', request_date='".$reqdate."', start_date='".date("Y-m-d", strtotime($fromdate))."',
finish_date='".date("Y-m-d",strtotime($todate))."', request_total='".$qty."', request_qualification='".$qualification."', pesawat_id='".$actype."',
request_rating='".$rating."', requester_msg='".$note."', status_request='".$statusrequest."', reason='".$reason."', reimburstment='".$reimburstment."'
WHERE request_id='".$request_id."'";
$result=mysqli_query($conn,$sql);

$status=1;
$pesan="Your request has been submitted";

header("Location: ../editrequest.php?status=$status&pesan=$pesan");
?>