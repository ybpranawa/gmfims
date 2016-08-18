<?php
session_start();
require '../../config/dbconnect.php';

$sql="SELECT MAX(role_id) as role_id FROM role";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_array($result);
$idrole=$row['role_id']+1;

$rolename=$_POST['rolename'];

$sql="INSERT INTO role VALUES ('".$idrole."','".$rolename."')";
$result=mysqli_query($conn,$sql);

$status=1;
$pesan="Role has been submitted";
header("Location: ../../viewadmin/addrole.php?status=$status&pesan=$pesan");
?>