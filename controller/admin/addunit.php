<?php
session_start();
require '../../config/dbconnect.php';

$unitid=strtoupper($_POST['unitid']);
$unitname=$_POST['unitname'];
$unitdesc=$_POST['unitdesc'];

$sql="SELECT unit_id FROM unit WHERE unit_id='".$unitid."'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);

if ($row['unit_id']==NULL) {
	$sql="INSERT INTO unit VALUES('".$unitid."','".$unitname."','".$unitdesc."')";
	$result=mysqli_query($conn,$sql);

	$status=1;
	$pesan="Unit has been submitted";
	header("Location:../../viewadmin/addunit.php?status=$status&pesan=$pesan");
}
else {
	$status=0;
	$pesan="Unit is exist";
	header("Location:../../viewadmin/addunit.php?status=$status&pesan=$pesan");
}
?>