<?php
session_start();
require '../config/dbconnect.php';

$sql="SELECT s.*, sd.*, r.*, rq.* FROM station s JOIN station_detail sd ON s.`station_id`=sd.`station_id` 
LEFT JOIN request r ON r.`station_origin`=s.`station_id` AND r.`status_request`='1' LEFT JOIN request_qualification rq ON rq.`request_id`=r.`request_id`";
$result=mysqli_query($conn,$sql);

$row=array();
while ($r=mysqli_fetch_assoc($result)) {
	$row[]=$r;
}

print json_encode($row);
mysqli_close($conn);
?>