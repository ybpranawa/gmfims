<?php
session_start();
require '../../config/dbconnect.php';

$custid=strtoupper($_POST['custid']);
$custdesc=$_POST['custdesc'];

$sql="SELECT customer_id FROM customer WHERE customer_id='".$custid."'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
if ($row['customer_id']==NULL) {
	$sql="INSERT INTO customer VALUES('".$custid."','".$custdesc."')";
	$result=mysqli_query($conn,$sql);

	$status=1;
	$pesan="Customer has been submitted";
}
else{
	$status=0;
	$pesan="Customer has been exist";
}

header("Location: ../../viewadmin/addcustomer.php?status=$status&pesan=$pesan");
?>