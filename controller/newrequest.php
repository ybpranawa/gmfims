<?php
session_start();
require '../config/dbconnect.php';

$station=$_POST['station'];
$request_id=$station."GMF".date("y").date("m").date("d").date("h").date("i").date("s");
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

$sql="INSERT INTO request(request_id,station_origin,requester_id,request_date,requester_msg,request_total,request_qualification,request_rating,pesawat_id,start_date,finish_date,status_request,reason,reimburstment) 
VALUES ('".$request_id."','".$station."','".$requester."','".date("Y-m-d")."','".$note."','".$qty."','".$qualification."','".$rating."','".$actype."','".date("Y-m-d",strtotime($fromdate))."','".date("Y-m-d",strtotime($todate))."','".$statusrequest."','".$reason."','".$reimburstment."')";
$result=mysqli_query($conn,$sql);

$status=1;
$pesan="Your request has been submitted";

header("Location: ../addrequest.php?status=$status&pesan=$pesan");
/*echo "$station ";
echo "$reqdate ";
echo "$qty ";
echo "$qualification ";
echo "$actype ";
echo "$rating ";
echo "$note ";
echo "$reason ";
echo "$reimburstment ";*/


?>