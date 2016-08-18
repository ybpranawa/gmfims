<?php
session_start();
require '../config/dbconnect.php';

$sql="SELECT s.*, sd.*, r.*, rq.* FROM station s JOIN station_detail sd ON s.`station_id`=sd.`station_id` 
LEFT JOIN request r ON r.`station_origin`=s.`station_id` AND r.`status_request`='1' LEFT JOIN request_qualification rq ON rq.`request_id`=r.`request_id`";
$result=mysqli_query($conn,$sql);

$data=array();

echo "var statcoordinate = [";

for ($i=0; $i < mysqli_num_rows($result) ; $i++) { 
	$data[]=mysqli_fetch_assoc($result);
	if ($data[$i]['status_request']==1) {
		echo "[","[",$data[$i]['station_lat'],",",$data[$i]['station_long'],"]",",",'"{icon:greenmarker}"',"]";
	}
	else{
		echo "[","[",$data[$i]['station_lat'],",",$data[$i]['station_long'],"]",",",'"{icon:redmarker}"',"]";
	}
	if ($i<=(mysqli_num_rows($result)-2) ) {
		echo ",";
	}
}

echo "]";
mysqli_close($conn);
?>