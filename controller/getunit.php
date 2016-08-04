<?php
session_start();
require '../config/dbconnect.php';
$unitid=$_GET['q'];

$sql="SELECT p.`personil_id`,p.`personil_name`,p.`personil_unit`,pd.`personil_contact`,pd.`personil_email`,p.`personil_jobtitle` 
FROM personil p INNER JOIN personil_detail pd ON p.`pic_flag`='1' AND p.`mgr_unit`='".$unitid."' AND p.`personil_id`=pd.`personil_id` ";

$result=mysqli_query($conn,$sql);
	echo "<div class='box'>
		            <div class='box-header'>
		              <h3 class='box-title'>Manager Detail</h3>
		            </div>
		            <!-- /.box-header -->
		            <div class='box-body'>
		              <table id='example1' class='table table-bordered table-striped'>
		                <thead>
		                <tr>
		                  <th>Employee ID</th>
		                  <th>Name</th>
		                  <th>Unit</th>
		                  <th>Phone</th>
		                  <th>Email</th>
		                  <th>Job Title</th>
		                  <th>Action</th>
		                </tr>
		                </thead>
		                <tbody>
		                ";
		                while ($row=mysqli_fetch_array($result)) {
		                	echo "<tr>		                	
		                	<td>".$row['personil_id']."</td>
		                	<td>".$row['personil_name']."</td>
		                	<td>".$row['personil_unit']."</td>
		                	<td>".$row['personil_contact']."</td>
		                	<td>".$row['personil_email']."</td>
		                	<td>".$row['personil_jobtitle']."</td>
		                	<td>".$row['personil_id']."</td>
		                	</tr>";
		                }

						echo "
						</tbody>
		                <tfoot>
		                <tr>
		                  <th>Employee ID</th>
		                  <th>Name</th>
		                  <th>Unit</th>
		                  <th>Phone</th>
		                  <th>Email</th>
		                  <th>Job Title</th>
		                  <th>Action</th>
		                </tr>
		                </tfoot>
		              </table>
		            </div>
		            <!-- /.box-body -->
		          </div>
		          <!-- /.box -->";
?>