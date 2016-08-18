<?php
session_start();
require '../../config/dbconnect.php';

$userid=$_POST['userid'];
$passwd=md5($userid.$_POST['passwd']);
$role=$_POST['role'];

$sql="SELECT user_id FROM user_account WHERE user_id='".$userid."'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
if ($row['user_id']==NULL) {
	$sql="INSERT INTO user_account VALUES ('".$userid."','".$passwd."','".$role."','','','')";
	$result=mysqli_query($conn,$sql);

	$status=1;
	$pesan="User account has been submitted";
	header("Location: ../../viewadmin/adduser.php?status=$status&pesan=$pesan");
}
else {
	$status=0;
	$pesan="User accout is exist";
	header("Location: ../../viewadmin/adduser.php?status=$status&pesan=$pesan");
}
?>