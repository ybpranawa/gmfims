<?php
session_start();
require '../../config/dbconnect.php';
$sql="SHOW COLUMNS FROM personil_auth";
$result=mysqli_query($conn,$sql);

$numrows=mysqli_num_rows($result);

$x=0;
$arr=array();
while ($row=mysqli_fetch_array($result)) {
	$arr[$x]=$row['Field'];
	$x++;
}

//echo $numrows;
for ($i=3; $i < mysqli_num_rows($result) ; $i++) { 
	//var_dump($row);
//print_r($arr[$i]);
	echo $arr[$i]."<br>";
}

?>