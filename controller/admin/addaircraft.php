<?php
session_start();
require '../../config/dbconnect.php';

$pesawatid=strtoupper($_POST['pesawatid']);
$pesawattype=$_POST['pesawattype'];
$pesawatdesc=$_POST['pesawatdesc'];

$sql="SELECT pesawat_id FROM pesawat WHERE pesawat_id='".$pesawatid."'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
if ($row['pesawat_id']==NULL) {
	$sql="INSERT INTO pesawat VALUES ('".$pesawatid."','".$pesawattype."','".$pesawatdesc."')";
	$result=mysqli_query($conn,$sql);

	$sql="ALTER TABLE personil_auth ADD COLUMN $pesawatid VARCHAR(100) DEFAULT '' NULL ";
	$result=mysqli_query($conn,$sql);

	$sql="UPDATE personil_auth SET $pesawatid='0' ";
	$result=mysqli_query($conn,$sql);

	$status=1;
	$pesan="Aircraft has been submitted";
	header("Location: ../../viewadmin/addaircraft.php?status=$status&pesan=$pesan");
}
else {
	$status=0;
	$pesan="Aircraft has been exist";
	header("Location: ../../viewadmin/addaircraft.php?status=$status&pesan=$pesan");
}

?>