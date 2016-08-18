<?php
session_start();
require '../../config/dbconnect.php';

$pesawatid=strtoupper($_POST['pesawatid']);
$pesawattype=$_POST['pesawattype'];
$pesawatdesc=$_POST['pesawatdesc'];

$sql="UPDATE pesawat SET pesawat_type='".$pesawattype."', pesawat_desc='".$pesawatdesc."' WHERE pesawat_id='".$pesawatid."' ";
$result=mysqli_query($conn,$sql);

$status=1;
$pesan="Aircraft has been submitted";
header("Location: ../../viewadmin/editaircraft.php?status=$status&pesan=$pesan");

?>