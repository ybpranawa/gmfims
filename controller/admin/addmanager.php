<?php
session_start();
require '../../config/dbconnect.php';

$unitid=$_POST['unitid'];
$empid=$_POST['empid'];

$sql="SELECT personil_id FROM personil WHERE personil_id='".$empid."' ";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);

if ($row['personil_id']!=NULL) {
	$sql="UPDATE personil SET pic_flag='1', mgr_unit='".$unitid."' WHERE personil_id='".$empid."' ";
	$result=mysqli_query($conn,$sql);	
	$status=1;
	$pesan="Manager has been submitted";
	header("Location: ../../viewadmin/addmanager.php?status=$status&pesan=$pesan");
}
else
{
	$status=0;
	$pesan="Employee ID is not exist";
	header("Location: ../../viewadmin/addmanager.php?status=$status&pesan=$pesan");
}




?>