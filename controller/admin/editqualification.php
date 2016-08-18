<?php
session_start();
require '../../config/dbconnect.php';

$qid=$_POST['qid'];
$qcode=$_POST['qcode'];
$qdesc=$_POST['qdesc'];

$sql="UPDATE qualification SET qualification_code='".$qcode."', qualification_desc='".$qdesc."' WHERE qualification_id='".$qid."' ";
$result=mysqli_query($conn,$sql);

$status=1;
$pesan="Qualification has been submitted";
header("Location: ../../viewadmin/editqualification.php?status=$status&pesan=$pesan");

?>