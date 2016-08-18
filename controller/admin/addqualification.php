<?php
session_start();
require '../../config/dbconnect.php';

$sql="SELECT MAX(qualification_id) AS id FROM qualification";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$id=$row['id']+1;

$qcode=$_POST['qcode'];
$qdesc=$_POST['qdesc'];

$sql="INSERT INTO qualification VALUES ('".$id."','".$qcode."','".$qdesc."')";
$result=mysqli_query($conn,$sql);

$status=1;
$pesan="Qualification has been submitted";
header("Location: ../../viewadmin/addqualification.php?status=$status&pesan=$pesan");

?>