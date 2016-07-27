<?php
session_start();
require '../config/dbconnect.php';
if ($statuskoneksi=1) 
{
	$username=$_POST['username'];
	$passwd=$_POST['passwd'];	
	$query="SELECT * FROM user_account WHERE user_id='".$username."' AND user_passwd='".$passwd."'";
	$result=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($result);
	if ($row>0) 
	{
		$statuslogin=1;
		$pesan="You have logged in successfully";
		$_SESSION['username']=$username;
		header("Location: ../dashboard.php");
	}
	else
	{
		$statuslogin=0;
		$pesan="Wrong access authentication";
		header("Location: ../internallogin.php?statuslogin=$statuslogin&pesan=$pesan");
	}
}
else
{
	$statuslogin=0;
	$pesan="Database connection failed";
	header("Location: ../internallogin.php?statuslogin=$statuslogin&pesan=$pesan");
}
?>