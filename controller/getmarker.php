<?php
session_start();
require '../config/dbconnect.php';

$sql="SELECT s.*, sd.*, r.*, rq.* FROM station s JOIN station_detail sd ON s.`station_id`=sd.`station_id` 
LEFT JOIN request r ON r.`station_origin`=s.`station_id` AND r.`status_request`='1' LEFT JOIN request_qualification rq ON rq.`request_id`=r.`request_id`";
$result=mysqli_query($conn,$sql);

$marker=array();

//L.marker([-7.370151, 112.788023], {icon: greenmarker}).addTo(mymap1).bindPopup("<b>SUB</b><br />Juanda Intl.");

echo "var marker = [";

for ($i=0; $i<mysqli_num_rows($result) ; $i++) { 
	$marker[]=mysqli_fetch_assoc($result);
	if ($marker[$i]['status_request']==1) {
		echo "'{icon:redmarker}'";
	}
	else {
		echo "'{icon:greenmarker}'";
	}

	if ($i<=(mysqli_num_rows($result)-2) ) {
		echo ",";
	}
}
echo "]";


mysqli_close($conn);
?>