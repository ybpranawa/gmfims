<?php
session_start();
require '../../config/dbconnect.php';

$empid=$_POST['empid'];
$empname=$_POST['empname'];
$empdinas=strtoupper($_POST['empdinas']);
$empunit=strtoupper($_POST['empunit']);
$empoffcode=strtoupper($_POST['empoffcode']);
$empstation=strtoupper($_POST['empstation']);
$empactual=strtoupper($_POST['empactual']);
$empjobtitle=$_POST['empjobtitle'];
$empqualify=$_POST['empqualify'];
$empcrew=$_POST['empcrew'];

$empjobcode=strtoupper($_POST['empjobcode']);
$empcontact=$_POST['empcontact'];
$empemail=$_POST['empemail'];
$empaddress=$_POST['empaddress'];
$empschool=$_POST['empschool'];
$empsex=$_POST['empsex'];
$empmarital=$_POST['empmarital'];
$empreligi=$_POST['empreligi'];
$empnpwp=$_POST['empnpwp'];

$emphealth=$_POST['emphealth'];
$empinhealth=$_POST['empinhealth'];
$empgec=$_POST['empgec'];
$empdirect=$_POST['empdirect'];
$empplace=strtoupper($_POST['empplace']);
$empbirth=date("Y-m-d",strtotime($_POST['empbirth']));
$empploy=date("Y-m-d",strtotime($_POST['empploy']));
$emppension=date("Y-m-d",strtotime($_POST['emppension']));
$empstatus=$_POST['empstatus'];

$empauthno=$_POST['empauthno'];
if ($_POST['empvalidity']!='0') {
	$empvalidity=date("Y-m-d",strtotime($_POST['empvalidity']));	
}
else {
	$empvalidity=$_POST['empvalidity'];	
}

$sql2="SHOW COLUMNS FROM personil_auth";
$result2=mysqli_query($conn,$sql2);

$x=0;
$arr=array();
while ($row2=mysqli_fetch_array($result2)) {
	$arr[$x]=$row2['Field'];
	$x++;
}

/*$emp737cl=$_POST['emp737cl'];
$emp737ng=$_POST['emp737ng'];
$empcrj1000=$_POST['empcrj1000'];
$emp747=$_POST['emp747'];
$emp777=$_POST['emp777'];
$empa330=$_POST['empa330'];
$empa320=$_POST['empa320'];
$empatr=$_POST['empatr'];*/

$sql="SELECT personil_id FROM personil WHERE personil_id='".$empid."' ";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);

if ($row['personil_id']==NULL) {
	$sql="INSERT INTO personil VALUES(
		'".$empid."','".$empname."','".$empdinas."','".$empunit."','".$empoffcode."','".$empstation."',
		'".$empactual."','".$empjobtitle."','".$empqualify."','".$empcrew."','',''
		)";
	$result=mysqli_query($conn,$sql);

	$sql="INSERT INTO personil_detail VALUES(
		'".$empid."','".$empjobcode."','".$empcontact."','".$empemail."','".$empaddress."','".$empschool."',
		'".$empsex."','".$empmarital."','".$empreligi."','".$empnpwp."','".$emphealth."','".$empinhealth."',
		'".$empgec."','".$empdirect."','".$empplace."','".$empbirth."','".$empploy."','".$emppension."','".$empstatus."'
		)";
	$result=mysqli_query($conn,$sql);

	$sql="INSERT INTO personil_auth(personil_id,auth_no,validity) VALUES (
		'".$empid."','".$empauthno."','".$empvalidity."')";
	$result=mysqli_query($conn,$sql);

	for ($i=3; $i < mysqli_num_rows($result2) ; $i++) { 
		//echo $arr[$i]."<br>";
		//$arr[$i]=$_POST[$i];
		///echo $_POST['B737CL']."<br>";
		$input=$_POST['pesawatrating'][$i-3];
		//echo $input."<br>";
		$sql="UPDATE personil_auth SET  $arr[$i]='".$input."' WHERE personil_id='".$empid."' ";
		$result=mysqli_query($conn,$sql);
	}

	


	$status=1;
	$pesan="Data has been submitted";
	header("Location: ../../viewadmin/addmanpower.php?status=$status&pesan=$pesan");
}
else {
	$status=0;
	$pesan="Employee is exist";
	header("Location: ../../viewadmin/addmanpower.php?status=$status&pesan=$pesan");
}
?>
