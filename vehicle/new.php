<?php

// started nov 4 2015

include_once('../system/config.php');

if($_REQUEST['formSubmit'] == 1){
	$sthandle = $dbhandle->prepare("INSERT INTO fxwx_vehicles (customer_id, vin, make, model, trim, year, body, color, tag, plate, engine, transmission, notes, created_on) value (:customer_id,:vin, :make, :model, :trim, :year, :body, :color, :tag, :plate, :engine, :transmission, :notes, :created_on)");
	$sthandle->bindParam(':customer_id', $_REQUEST['customer_id']);
	$sthandle->bindParam(':vin', $_REQUEST['vin']);
	$sthandle->bindParam(':make', $_REQUEST['make']);
	$sthandle->bindParam(':model', $_REQUEST['model']);
	$sthandle->bindParam(':trim', $_REQUEST['trim']);
	$sthandle->bindParam(':year', $_REQUEST['year']);
	$sthandle->bindParam(':body', $_REQUEST['body']);
	$sthandle->bindParam(':color', $_REQUEST['color']);
	$sthandle->bindParam(':tag', $_REQUEST['tag']);
	$sthandle->bindParam(':plate', $_REQUEST['plate']);
	$sthandle->bindParam(':engine', $_REQUEST['engine']);
	$sthandle->bindParam(':transmission', $_REQUEST['transmission']);
	$sthandle->bindParam(':notes', $_REQUEST['notes']);
	$currentDateTime = date("Y-m-d H:i:s"); $sthandle->bindParam(':created_on', $currentDateTime);
	$sthandle -> execute($data);
	setStatus("Added a ".$_REQUEST['year']." ".$_REQUEST['make']." ".$_REQUEST['model'].".");
}

// handle "new vehicle for this customer" links from the customer list screen
if($_REQUEST['customer_id']){ $customer_id = $_REQUEST['customer_id']; }
else{ $customer_id = 0; }

?>

<h4>Add new vehicle</h4>
<form method="post">
	<table class="table">
		<tr>
			<td>Owner</td>
			<td><? echo customerSelect($customer_id); ?></td>
		</tr>
		<tr>
			<td>VIN</td>
			<td><input type="text" name="vin" value=""></td>
		</tr>
		<tr>
			<td>Make</td>
			<td><input type="text" name="make" value=""></td>
		</tr>
		<tr>
			<td>Model</td>
			<td><input type="text" name="model" value=""></td>
		</tr>
		<tr>
			<td>Trim</td>
			<td><input type="text" name="trim" value=""></td>
		</tr>
		<tr>
			<td>Model year</td>
			<td><input type="number" name="year" value=""></td>
		</tr>
		<tr>
			<td>Body</td>
			<td><input type="text" name="body" value=""></td>
		</tr>
		<tr>
			<td>color</td>
			<td><input type="text" name="color" value=""></td>
		</tr>
		<tr>
			<td>Tag #</td>
			<td><input type="number" name="tag" value=""></td>
		</tr>
		<tr>
			<td>License plate</td>
			<td><input type="text" name="plate" value=""></td>
		</tr>
		<tr>
			<td>Engine</td>
			<td><input type="text" name="engine" value=""></td>
		</tr>
		<tr>
			<td>Transmission</td>
			<td><input type="text" name="transmission" value=""></td>
		</tr>
		<tr>
			<td>Notes</td>
			<td><textarea type="text" name="notes" value=""></textarea></td>
		</tr>
	</table>
	<input type="hidden" name="formSubmit" value="1">
	<input class="btn btn-default" type="submit" value="Save new vehicle"> 
</form>

<?
include_once('../system/foot.php');