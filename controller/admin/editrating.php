<?php
session_start();
require '../../config/dbconnect.php';

$ratid=$_POST['ratingid'];
$ratingcode=strtoupper($_POST['ratingcode']);
$ratingdesc=$_POST['ratingdesc'];

$sql="UPDATE rating SET rating_code='".$ratingcode."', rating_description='".$ratingdesc."' WHERE rating_id='".$ratid."' ";
$result=mysqli_query($conn,$sql);

$status=1;
$pesan="Rating has been submitted";
header("Location: ../../viewadmin/editrating.php?status=$status&pesan=$pesan");
?>