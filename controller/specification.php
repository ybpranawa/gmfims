<?php
require '../config/dbconnect.php';
$numform=$_GET['q'];

$sql="SELECT * FROM request";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
for ($i=0;$i<$numform;$i++){
?>
	<div class="col-md-6">
		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title">Specification <?php echo $i+1;?></h3>
			</div>

			<div class="box-body">
				<div class="col-md-6">
					<div class="form-group">
						<label for="qualification" class="col-md-6 control-label">Qualification :</label>
						<div class="input-group">
							<select class="form-control" name="qualification[]">
								<?php
								$sql="SELECT * FROM qualification";
								$result=mysqli_query($conn,$sql);
								while ($row=mysqli_fetch_array($result)) {
									echo "<option value='".$row['qualification_id']."'>".$row['qualification_code']."</option> ";
								}
								?>
							</select>
						</div>
					</div>
				</div>

				<?php
				$sql="SELECT * FROM pesawat";
				$result=mysqli_query($conn,$sql);
				?>
				<div class="col-md-6">
					<div class="form-group">
						<label for="actype" class="col-md-6 control-label">Aircraft Type : </label>
						<div class="input-group ">
							<select class="form-control" name="actype[]">
							    <?php
							    while ($row=mysqli_fetch_array($result)) {
							    	echo "<option value='".$row['pesawat_id']."'>".$row['pesawat_id']."</option>";
							    }
							    ?>
							</select>
							<!-- <div class="input-group col-md-4" style="floating:left;"><a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus"></i></a></div> -->
						</div>									
					</div>
				</div>


				<?php
				$sql="SELECT * FROM rating";
				$result=mysqli_query($conn,$sql);
				?>
				<div class="col-md-9">
					<div class="form-group">
						<label for="rating" class="col-md-4 control-label">Rating :</label>
						<div class="input-group">
							<select class="form-control" name="rating[]">
							    <?php
							    while ($row=mysqli_fetch_array($result)) {
							    	echo "<option value='".$row['rating_id']."'> Up to ".$row['rating_code']."</option>";
							    }
							    ?>
							</select>

						</div>
					</div>

					<div class="form-group">
						<label for="note" class="col-md-4 control-label">Note :</label>
						<div class="input-group col-md-7">
							<textarea name="note[]" id="note" class="form-control"></textarea>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
<?php
}
?>
<div class="col-md-6">
	<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title">Submit Form</h3>
		</div>
		<div class="box-body">
			<div class="form-group">
				<label for="reason" class="col-md-4 control-label">Reason :</label>
				<div class="input-group">
					<input class="form-control" name="reason" id="reason">
				</div>
			</div>
			<div class="form-group">
				<label for="reimburstment" class="col-md-4 control-label">Status Reimburstment :</label>
				<div class="input-group">
					<select class="form-control" name="reimburstment">
					    <option value="PBTH">PBTH</option>
					    <option value="TMB">TMB</option>
					</select>
				</div>
			</div>
			<button type="submit" class="btn btn-info pull-right">Send Request</button>
		</div>
	</div>
</div>
