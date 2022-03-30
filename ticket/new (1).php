<?php

// started nov 5 2015

include_once('../system/config.php');

if($_REQUEST['formSubmit'] == 1){
	$sthandle = $dbhandle->prepare("INSERT INTO fxwx_tickets (vehicle_id, status, mileage_in, mileage_out, phone_pref, notes, created_on) value (:vehicle_id, :status, :mileage_in, :mileage_out, :phone_pref, :notes, :created_on)");
	$sthandle->bindParam(':vehicle_id', $_REQUEST['vehicle_id']);
	$status = 1; $sthandle->bindParam(':status', $status);
	$sthandle->bindParam(':mileage_in', $_REQUEST['mileage_in']);
	$sthandle->bindParam(':mileage_out', $_REQUEST['mileage_out']);
	$sthandle->bindParam(':phone_pref', $_REQUEST['phone_pref']);
	$sthandle->bindParam(':notes', $_REQUEST['notes']);
	$currentDateTime = date("Y-m-d H:i:s"); $sthandle->bindParam(':created_on', $currentDateTime);
	$sthandle -> execute($data);
	$ticket_id = $dbhandle->lastInsertId();
	$status = 'Added ticket <a href="/fxwx/ticket/edit.php?ticket_id='.$ticket_id.'">'.$ticket_id.'</a>.';
	setStatus($status);
}

$vehicleSelectDisplay = vehicleSelect(NULL,'dropdown'); // gets a vehicle dropdown
$phonePrefDisplay = phonePrefSelect(); // gets the phone pref dropdown
echo customerSelectModal('customerSelectModal','Select customer and vehicle'); // prepares the customer select modal
?>

<h4>Add new ticket</h4>
<form method="post">
	<table class="table">
		<tr>
			<td>Customer</td>
			<td><a data-toggle="modal" data-target="#customerSelectModal">select customer</a> <span id="customerNameArea"></span></td>
		</tr>
		<tr>
			<td>Vehicle</td>
			<td><?=$vehicleSelectDisplay?></td>
		</tr>
		<tr>
			<td>Shop ID</td>
			<td><input type="number" name="shop_id" value="<?=$shop_id?>"></td>
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
	<input class="btn btn-default" type="submit" value="Create ticket"> 
</form>
<?
include_once('../system/foot.php');