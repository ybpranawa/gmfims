<?php
session_start();
require '../../config/dbconnect.php';

$sql="SELECT MAX(rating_id) AS rating_id FROM rating";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$ratid=$row['rating_id']+1;

$ratingcode=strtoupper($_POST['ratingcode']);
$ratingdesc=$_POST['ratingdesc'];

$sql="SELECT rating_id FROM rating WHERE rating_id='".$ratid."'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
if ($row['rating_id']==NULL) {
	$sql="INSERT INTO rating VALUES ('".$ratid."','".$ratingcode."','".$ratingdesc."') ";
	$result=mysqli_query($conn,$sql);
}
$status=1;
$pesan="Rating has been submitted";
header("Location: ../../viewadmin/addrating.php?status=$status&pesan=$pesan");
?>