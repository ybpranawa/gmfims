<?php
session_start();
require '../config/dbconnect.php';
if ($statuskoneksi=1) 
{
	$username=$_POST['username'];
	$passwd=md5($username.$_POST['passwd']);	
	$query="SELECT * FROM user_account WHERE user_id='".$username."' AND user_passwd='".$passwd."'";
	$result=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($result);
	if ($row>0) 
	{
		$statuslogin=1;
		$_SESSION['username']=$username;
		$_SESSION['role']=$row['role_id'];
		$ipaddr=$_SERVER['REMOTE_ADDR'];
		$useragent=$_SERVER['HTTP_USER_AGENT'];
		$query="UPDATE user_account SET last_login='".date('Y-m-d H:i:sa')."', user_ip='".$ipaddr."', user_agent='".$useragent."' WHERE user_id='".$username."'";
		mysqli_query($conn,$query);
		$pesan="You have logged in successfully";
		if ($row['role_id']=='1') {
			header("Location: ../viewadmin/dashboardadmin.php?status=$statuslogin&pesan=$pesan");
		}
		if ($row['role_id']=='2') {
			header("Location: ../viewrequester/dashboard.php?status=$statuslogin&pesan=$pesan");
		}
		else if ($row['role_id']=='3') {
			header("Location: ../viewcentralplanner/dashboardcp.php?status=$statuslogin&pesan=$pesan");
		}
		else if ($row['role_id']=='4') {
			header("Location: ../viewprovider/dashboardprovider.php?status=$statuslogin&pesan=$pesan");	
		}
		
		
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