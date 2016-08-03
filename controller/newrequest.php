<?php
session_start();
require '../config/dbconnect.php';

$station=$_POST['station'];
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
$codenow="REQ".$station.date("Y").date("m").date("d");

$sql="SELECT MAX(request_id) as request_id FROM request WHERE SUBSTRING(request_id,1,14)='".$codenow."'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);

$datecode=substr($row['request_id'], 0, 14);
$num=substr($row['request_id'], 14);

$num=(int)$num;


if ($datecode==$codenow) {
	$num++;
	$num=sprintf("%04d",$num);	
}
else {
	$num=1;
	$num=sprintf("%04d",$num);		
}

$request_id="REQ".$station.date("Y").date("m").date("d").$num;

$sql="INSERT INTO request(request_id,station_origin,requester_id,request_date,requester_msg,request_total,request_qualification,request_rating,pesawat_id,start_date,finish_date,status_request,reason,reimburstment) 
VALUES ('".$request_id."','".$station."','".$requester."','".date("Y-m-d")."','".$note."','".$qty."','".$qualification."','".$rating."','".$actype."','".date("Y-m-d",strtotime($fromdate))."','".date("Y-m-d",strtotime($todate))."','".$statusrequest."','".$reason."','".$reimburstment."')";
$result=mysqli_query($conn,$sql);

$status=1;
$pesan="Your request has been submitted";

header("Location: ../addrequest.php?status=$status&pesan=$pesan");
?>