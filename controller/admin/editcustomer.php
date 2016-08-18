<?php
session_start();
require '../../config/dbconnect.php';

$custid=strtoupper($_POST['custid']);
$custdesc=$_POST['custdesc'];

$sql="UPDATE customer SET customer_desc='".$custdesc."' WHERE customer_id='".$custid."'";
$result=mysqli_query($conn,$sql);
$status=1;
$pesan="Customer has been submitted";

header("Location: ../../viewadmin/editcustomer.php?status=$status&pesan=$pesan");
?>