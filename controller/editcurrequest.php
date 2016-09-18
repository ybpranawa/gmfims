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

$reqid=$_POST['reqid'];

$sql="UPDATE request SET reason='".$reason."', reimburstment='".$reimburstment."' ";
$result=mysqli_query($conn,$sql);

for ($i=0; $i < $qty; $i++) { 
	$sql="UPDATE request_qualification SET rq_note='".$note[$i]."', qualification_id='".$qualification[$i]."', pesawat_id='".$actype[$i]."', rating_id='".$rating[$i]."' WHERE rq_id='".$reqid[$i]."'";
	$result=mysqli_query($conn,$sql);
}

$status=1;
$pesan="Your request has been submitted";

header("Location: ../view/editrequest.php?status=$status&pesan=$pesan");
?>