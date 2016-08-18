<?php
session_start();
require '../../config/dbconnect.php';

$idrole=$_POST['roleid'];

$rolename=$_POST['rolename'];

$sql="UPDATE role SET role_name='".$rolename."' WHERE role_id='".$idrole."' ";
$result=mysqli_query($conn,$sql);

$status=1;
$pesan="Role has been submitted";
header("Location: ../../viewadmin/editrole.php?status=$status&pesan=$pesan");
?>