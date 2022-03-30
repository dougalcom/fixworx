<?php
// Nov 3 2015
include_once('../system/config.php');

// **************************************************
// * update record									*
// **************************************************
if($_REQUEST['formSubmit'] == 1){
	$sql = "UPDATE fxwx_tickets SET shop_id=?, status=?, notes=?, mileage_in=?, mileage_out=?, phone_pref=?, updated_on=? WHERE ticket_id=?";
	$sthandle = $dbhandle->prepare($sql);
	$sthandle->execute(
		array(
			$_REQUEST['shop_id'],
			$_REQUEST['status'],
			$_REQUEST['notes'],
			$_REQUEST['mileage_in'],
			$_REQUEST['mileage_out'],
			$_REQUEST['phone_pref'],
			date("Y-m-d H:i:s"),
			$_REQUEST['ticket_id']
		));
	$IDforDisplay = $_REQUEST['ticket_id'];
	$status = 'Updated ticket <a href="/fxwx/ticket/edit.php?ticket_id='.$IDforDisplay.'">'.$IDforDisplay."</a>.";
	setStatus($status);
}

// **************************************************
// * get ticket info				    			*
// **************************************************
$sthandle = $dbhandle->prepare("SELECT * FROM fxwx_tickets WHERE ticket_id = ".$_REQUEST['ticket_id']);
$sthandle->setFetchMode(PDO::FETCH_ASSOC);
$sthandle->execute();
while($row = $sthandle->fetch()) {
	$ticket_id = $row['ticket_id'];
	$vehicle_id = $row['vehicle_id'];
	$shop_id = $row['shop_id'];
	$status = $row['status'];
	$notes = $row['notes'];
	$created_on = $row['created_on'];
	$created_by_user_id = $row['created_by_user_id'];
	$updated_on = $row['updated_on'];
	$updated_by_user_id = $row['updated_by_user_id'];
	$mileage_in = $row['mileage_in'];
	$mileage_out = $row['mileage_out'];
	$phone_pref = $row['phone_pref'];
}

// get vehicle basic info and link to vehicle record
if($vehicle_id){$vehicleInfoDisplay = vehicleInfo($vehicle_id);}
// gets the phone pref select dropdown form element
$phonePrefDisplay = phonePrefSelect($phone_pref);
?>

<h4>Ticket detail</h4>
<form method="post">
	<table class="table">
		<tr>
			<td>Ticket ID</td>
			<td><?=$ticket_id?></td>
		</tr>
		<tr>
			<td>Vehicle</td>
			<td><?=$vehicleInfoDisplay?></td>
		</tr>
		<tr>
			<td>Shop ID</td>
			<td><input type="number" name="shop_id" value="<?=$shop_id?>"></td>
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
			<td>Status</td>
			<td><input type="number" name="status" value="<?=$status?>"></td>
		</tr>
		<tr>
			<td>Mileage in</td>
			<td><input type="number" name="mileage_in" value="<?=$mileage_in?>"></td>
		</tr>
		<tr>
			<td>Mileage out</td>
			<td><input type="number" name="mileage_out" value="<?=$mileage_out?>"></td>
		</tr>
		<tr>
			<td>Phone pref</td>
			<td><?=$phonePrefDisplay?></td>
		</tr>
			<td>Notes</td>
			<td><textarea type="text" name="notes"><?=$notes?></textarea></td>
		</tr>
	</table>
	<input type="hidden" name="formSubmit" value="1">
	<input class="btn btn-default" type="submit" value="Save changes"> 
</form>
<br/>
<a href="/fxwx/ticket/delete.php?ticket_id=<?=$ticket_id?>">Delete ticket</a>

<? include_once('../system/foot.php');