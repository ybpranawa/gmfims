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

$sql="UPDATE personil SET personil_name='".$empname."', personil_dinas='".$empdinas."', personil_unit='".$empunit."', personil_officecode='".$empoffcode."', personil_station='".$empstation."', personil_actual='".$empactual."', personil_jobtitle='".$empjobtitle."',personil_gl='".$empqualify."', personil_crew='".$empcrew."' WHERE personil_id='".$empid."' ";
$result=mysqli_query($conn,$sql);

$sql="UPDATE personil_detail SET personil_jobcode='".$empjobcode."', personil_contact='".$empcontact."', personil_email='".$empemail."', personil_address='".$empaddress."', personil_lasteducation='".$empschool."', personil_sex='".$empsex."', personil_maritalstatus='".$empmarital."', personil_religion='".$empreligi."', personil_npwp='".$empnpwp."', personil_jamsostek='".$emphealth."', personil_inhealth='".$empinhealth."', personil_gec='".$empgec."', personil_direction='".$empdirect."', personil_place='".$empplace."', personil_birthdate='".$empbirth."', personil_employmentdate='".$empploy."', personil_pension='".$emppension."', personil_status='".$empstatus."' WHERE personil_id='".$empid."' ";
$result=mysqli_query($conn,$sql);

$sql="UPDATE personil_auth SET auth_no='".$empauthno."', validity='".$empvalidity."' WHERE personil_id='".$empid."' ";
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
header("Location: ../../viewadmin/editmanpower.php?status=$status&pesan=$pesan");
?>
