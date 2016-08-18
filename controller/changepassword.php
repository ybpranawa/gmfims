<?php
session_start();
require '../config/dbconnect.php';

$userid=$_SESSION['username'];
$oldpass=$_POST['oldpass'];
$newpass=$_POST['newpass'];
$confnewpass=$_POST['confnewpass'];
$insertpass=md5($userid.$newpass);

$sql="SELECT * FROM user_account WHERE user_id='".$userid."'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);

if ($row['user_passwd']!=md5($userid.$oldpass)) {
	$status=0;
	$pesan="Your old pass is wrong";
}
elseif ($newpass!=$confnewpass) {
	$status=0;
	$pesan="Your password did not match";
}
else {
	$sql2="UPDATE user_account SET user_passwd='".$insertpass."' WHERE userid='".$userid."'";
	$result2=mysqli_query($conn,$sql2);
	$status=1;
	$pesan="Your password has been changed";
}

if ($row['role_id']==1) {
	header("Location: ../view/editprofile.php?status=$status&pesan=$pesan");	
}
elseif ($row['role_id']==2) {
	header("Location: ../view/editprofile.php?status=$status&pesan=$pesan");
}
elseif ($row['role_id']==3) {
	header("Location: ../view/editprofile.php?status=$status&pesan=$pesan");
}
elseif ($row['role_id']==4) {
	header("Location: ../view/editprofile.php?status=$status&pesan=$pesan");
}
elseif ($row['role_id']==5) {
	header("Location: ../viewguest/editprofile.php?status=$status&pesan=$pesan");
}

?>