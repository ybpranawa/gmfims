<?php
require '../config/dbconnect.php';

$unitid=$_GET['q'];

$sql="SELECT p.`personil_id`,p.`personil_name`, pd.`personil_email` FROM personil p INNER JOIN personil_detail pd ON p.`pic_flag`='1' AND p.`mgr_unit`='".$unitid."' AND p.`personil_id`=pd.`personil_id` ";
$result=mysqli_query($conn,$sql);

echo "
<div class='form-group'>
	<label for='manager' class='col-md-4 control-label'>Manager/PIC :</label>
	<div class='input-group'>
		<select class='form-control' name='manager'>";
		while ($row=mysqli_fetch_array($result)) {
			echo "
			<option value='".$row['personil_id']."'>".$row['personil_name']."</option>";
			$email=$row['personil_email'];
		}
echo "</select>
	</div>
</div>

<div class='form-group'>
	<label for='contact' class='col-md-4 control-label'>Contact :</label>
	<div class='input-group'>
		<input type='text'  id='reimburstment' value='".$email."' name='reimburstment' class='form-control' readonly='true'>
	</div>
</div>";
?>