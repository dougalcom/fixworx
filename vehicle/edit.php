<?php
// Nov 3 2015
include_once('../system/config.php');

// **************************************************
// * update record									*
// **************************************************
if($_REQUEST['formSubmit'] == 1){
	$sql = "UPDATE fxwx_vehicles SET body=?, plate=?, make=?, model=?, trim=?, color=?, vin=?, year=?, tag=?, engine=?, transmission=?, notes=?, customer_id=?, updated_on=? WHERE vehicle_id=?";
	$sthandle = $dbhandle->prepare($sql);
	$sthandle->execute(array($_REQUEST['body'],$_REQUEST['plate'],$_REQUEST['make'],$_REQUEST['model'],$_REQUEST['trim'],$_REQUEST['color'],$_REQUEST['vin'],$_REQUEST['year'],$_REQUEST['tag'],$_REQUEST['engine'],$_REQUEST['transmission'],$_REQUEST['notes'],$_REQUEST['customer_id'],date("Y-m-d H:i:s"),$_REQUEST['vehicle_id']));
	$vehicleInfo = vehicleInfo($_REQUEST['vehicle_id']);
	$status = 'Updated a '.$vehicleInfo.'.';
	setStatus($status);
}

// **************************************************
// * get vehicle info				    			*
// **************************************************
$sthandle = $dbhandle->prepare("SELECT * FROM fxwx_vehicles WHERE vehicle_id = ".$_REQUEST['vehicle_id']);
$sthandle->setFetchMode(PDO::FETCH_ASSOC);
$sthandle->execute();
while($row = $sthandle->fetch()) {
	$vehicle_id = $row['vehicle_id'];
	$make = $row['make'];
	$model = $row['model'];
	$trim = $row['trim'];
	$color = $row['color'];
	$tag = $row['tag'];
	$vin = $row['vin'];
	$plate = $row['plate'];
	$year = $row['year'];
	$body = $row['body'];
	$engine = $row['engine'];
	$transmission = $row['transmission'];
	$notes = $row['notes'];
	$customer_id = $row['customer_id'];
	$created_on = $row['created_on'];
	$updated_on = $row['updated_on'];
	$created_by_user_id = $row['created_by_user_id'];
	$updated_by_user_id = $row['updated_by_user_id'];
}
?>

<h4>Vehicle detail</h4>
<form method="post">
	<table class="table">
		<tr>
			<td>ID #</td>
			<td><?=$vehicle_id?></td>
		</tr>
		<tr>
			<td>Creation date</td>
			<td><?=$created_on?> by <?=$created_by_user_id?></td>
		</tr>
		<tr>
			<td>Update date</td>
			<td><?=$updated_on?> by <?=$updated_by_user_id?></td>
		</tr>
		<tr>
			<td>Owner</td>
			<td><? echo customerSelect($customer_id); ?></td>
		</tr>
		<tr>
			<td>VIN</td>
			<td><input type="text" name="vin" value="<?=$vin?>"></td>
		</tr>
		<tr>
			<td>Make</td>
			<td><input type="text" name="make" value="<?=$make?>"></td>
		</tr>
		<tr>
			<td>Model</td>
			<td><input type="text" name="model" value="<?=$model?>"></td>
		</tr>
		<tr>
			<td>Trim</td>
			<td><input type="text" name="trim" value="<?=$trim?>"></td>
		</tr>
		<tr>
			<td>Model year</td>
			<td><input type="number" name="year" value="<?=$year?>"></td>
		</tr>
		<tr>
			<td>Body</td>
			<td><input type="text" name="body" value="<?=$body?>"></td>
		</tr>
		<tr>
			<td>color</td>
			<td><input type="text" name="color" value="<?=$color?>"></td>
		</tr>
		<tr>
			<td>Tag #</td>
			<td><input type="text" name="tag" value="<?=$tag?>"></td>
		</tr>
		<tr>
			<td>License plate</td>
			<td><input type="text" name="plate" value="<?=$plate?>"></td>
		</tr>
		<tr>
			<td>Engine</td>
			<td><input type="text" name="engine" value="<?=$engine?>"></td>
		</tr>
		<tr>
			<td>Transmission</td>
			<td><input type="text" name="transmission" value="<?=$transmission?>"></td>
		</tr>
		<tr>
			<td>Notes</td>
			<td><textarea type="text" name="notes" value=""><?=$notes?></textarea></td>
		</tr>
	</table>
	<input type="hidden" name="formSubmit" value="1">
	<input class="btn btn-default" type="submit" value="Save changes"> 
</form>
<br/>
<a href="/fxwx/vehicle/delete.php?vehicle_id=<?=$vehicle_id?>">Delete vehicle</a>

<? include_once('../system/foot.php');