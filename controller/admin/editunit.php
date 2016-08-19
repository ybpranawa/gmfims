<?php
session_start();
require '../../config/dbconnect.php';

$unitid=strtoupper($_POST['unitid']);
$unitname=$_POST['unitname'];
$unitdesc=$_POST['unitdesc'];

$sql="UPDATE unit SET unit_code='".$unitname."', unit_desc='".$unitdesc."' WHERE unit_id='".$unitid."' ";
$result=mysqli_query($conn,$sql);

$status=1;
$pesan="Unit has been submitted";
header("Location:../../viewadmin/editunit.php?status=$status&pesan=$pesan");

?>