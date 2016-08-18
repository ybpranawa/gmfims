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

$sql="INSERT INTO request(request_id,station_origin,requester_id,request_date,request_total,
	start_date,finish_date,status_request,reason,reimburstment) 
VALUES ('".$request_id."','".$station."','".$requester."','".date("Y-m-d")."','".$qty."',
	'".date("Y-m-d",strtotime($fromdate))."','".date("Y-m-d",strtotime($todate))."','".$statusrequest."','".$reason."','".$reimburstment."')";
$result=mysqli_query($conn,$sql);
$n=1;
for ($i=0; $i<$qty ; $i++) { 
	$rqid="REQDET".$station.date("Y").date("m").date("d").$num.$n;
	$sql="INSERT INTO request_qualification(rq_id, rq_note, request_id, qualification_id, pesawat_id, rating_id) 
	VALUES('".$rqid."','".$note[$i]."','".$request_id."','".$qualification[$i]."','".$actype[$i]."','".$rating[$i]."')";
	$result=mysqli_query($conn,$sql);
	$n++;
}

$status=1;
$pesan="Your request has been submitted";

header("Location: ../view/addrequest.php?status=$status&pesan=$pesan");
?>