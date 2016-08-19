<?php
session_start();
require '../../config/dbconnect.php';

$unitid=$_POST['unitid'];
$empid=$_POST['empid'];

$sql="UPDATE personil SET pic_flag='1', mgr_unit='".$unitid."' WHERE personil_id='".$empid."' ";
$result=mysqli_query($conn,$sql);	
$status=1;
$pesan="Manager has been submitted";
header("Location: ../../viewadmin/editmanager.php?status=$status&pesan=$pesan");
?>