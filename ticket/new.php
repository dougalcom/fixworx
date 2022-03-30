<?php
// /fxwx/ticket/new.php

// started nov 5 2015
// forked apr 15 2017 v.0.52

include_once('../system/config.php');

if($_REQUEST['createTicket'] == 1){		// to create new ticket
	$sthandle = $dbhandle->prepare("INSERT INTO fxwx_fixes (vehicle_id, status, mileage_in, mileage_out, phone_pref, notes, created_on) value (:vehicle_id, :status, :mileage_in, :mileage_out, :phone_pref, :notes, :created_on)");
	$sthandle->bindParam(':vehicle_id', $_REQUEST['vehicle_id']);
	$status = 1; $sthandle->bindParam(':status', $status);
	$sthandle->bindParam(':mileage_in', $_REQUEST['mileage_in']);
	$sthandle->bindParam(':mileage_out', $_REQUEST['mileage_out']);
	$sthandle->bindParam(':phone_pref', $_REQUEST['phone_pref']);
	$sthandle->bindParam(':notes', $_REQUEST['notes']);
	$currentDateTime = date("Y-m-d H:i:s"); $sthandle->bindParam(':created_on', $currentDateTime);
	$sthandle -> execute($data);
	$ticket_id = $dbhandle->lastInsertId();
	$status = 'Created ticket <a href="/fxwx/ticket/edit.php?ticket_id='.$ticket_id.'">'.$ticket_id.'</a>.';
	setStatus($status);
}

if($_REQUEST['createFix'] == 1){		// to add a repair to a ticket
	//prepare statement
	$sthandle = $dbhandle->prepare("INSERT INTO fxwx_tickets () value (:)");
	$sthandle->bindParam(':ticket_id', $_REQUEST['ticket_id']);
	$status = 1; $sthandle->bindParam(':status', $status);
	// set parameters
	$sthandle->bindParam(':mileage_in', $_REQUEST['mileage_in']);
	$sthandle->bindParam(':mileage_out', $_REQUEST['mileage_out']);
	$sthandle->bindParam(':phone_pref', $_REQUEST['phone_pref']);
	$sthandle->bindParam(':notes', $_REQUEST['notes']);
	$currentDateTime = date("Y-m-d H:i:s"); $sthandle->bindParam(':created_on', $currentDateTime);
	// execute mysql query
	$sthandle -> execute($data);
	$ticket_id = $dbhandle->lastInsertId();
	// set status
	$status = 'Created repair on ticket <a href="/fxwx/ticket/edit.php?ticket_id='.$_REQUEST["ticket_id"].'">'.$_REQUEST["ticket_id"].'</a>';
	setStatus($status);
}

$vehicleSelectDisplay = vehicleSelect($_REQUEST['customer_id'],'dropdown'); // gets a vehicle dropdown
$phonePrefDisplay = phonePrefSelect($_REQUEST['phone_pref']); // gets the phone pref dropdown
$customerName = customerInfo($_REQUEST['customer_id'],false);
$vehicleInfo = vehicleInfo($_REQUEST['vehicle_id'],false);
$mileage_in = $_REQUEST['mileage_in'];
$mileage_out = $_REQUEST['mileage_out'];
$notes = $_REQUEST['notes'];
// echo customerSelectModal('customerSelectModal','Select customer and vehicle'); // prepares the customer select modal

// ENDS DATABASE WORK, BEGIN HTML PRESENTATION

?>

<h4>Create new ticket</h4>

<? if ($_REQUEST['step']== 0 or !$_REQUEST['step']){
	$step = 0;
	echo 'step zero: select a customer or <a href="../customer/add.php">add new</a>.<hr/>';

	$sthandle = $dbhandle->prepare("SELECT * FROM fxwx_customers WHERE fxwx_customers.status = 1");
	$sthandle->setFetchMode(PDO::FETCH_ASSOC);
	$sthandle->execute();
	
	while($row = $sthandle->fetch()) {
		$outputCustomers .= 
		"<tr><td>".
		'<a href="/fxwx/ticket/new.php?step=1&customer_id='.$row['customer_id'].'">'.$row['lastname'].'</a>'
		."</td><td>".
		$row['firstname']
		."</td><td>".
		$row['phone1']
		."</td><td>".
		$row['email']
		."</td><td>".
		numberVehiclesByCustomer($row['customer_id'])
		."</td><td>".
		$row['address1'].' '.$row['city'].', '.$row['state']
		.'</td></tr>';
	}
?>
	<table name="sortTable" id="sortTable" class="display">
	<thead>
	<tr>
		<td>Last name</td>
		<td>First name</td>
		<td>Primary Phone</td>
		<td>Email</td>
		<td>Vehicles</td>
		<td>Address</td>
	</tr>
	</thead>
	<tbody>
	<?=$outputCustomers ?>
	</tbody>
	</table>
<? } //ends step 0<br>

elseif ($_REQUEST['step'] == 1){
	echo 'step one: select customer\'s vehicle or <a href="../vehicle/new.php?customer_id='.$customer_id.'">add new</a>.<hr/>';
	echo "<h4>Vehicles for $customerName</h4>";
	echo vehicleSelect($_REQUEST['customer_id'],'newTicketVehicleSelector');
	echo '<hr/><button class="btn btn-warning" onclick="history.go(-1);">Back to customer selection</button>';
} //ends step 1

elseif ($_REQUEST['step'] == 2){
	echo 'step two: input ticket specifics<hr/>';
	?>
	<form method="post" action="new.php?step=3&customer_id=<?=$_REQUEST['customer_id']?>&vehicle_id=<?=$_REQUEST['vehicle_id']?>">
		<table class="table">
			<tr>
				<td>Customer</td>
				<td><?=$customerName?></td>
			</tr>
			<tr>
				<td>Vehicle</td>
				<td><?=$vehicleInfo?></td>
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
		<input type="hidden" name="createTicket" value="1">
	<hr/><button class="btn btn-warning" onclick="history.go(-1);"><i class="fa fa-arrow-left" aria-hidden="true"></i> back to vehicle selection</button>  <button class="btn btn-success" type="submit"><i class="fa fa-arrow-right" aria-hidden="true"></i> create ticket</button></form>
<?
} //ends step 2

elseif ($_REQUEST['step'] == 3){
	echo "step 3: successfully created new ticket #$ticket_id";
?>	<!-- EXPERI -->
	<form method="post" target="new.php?step=4&ticket_id=<?=$ticket_id?>">
		<table class="table">
			<tr>
				<td>Customer</td>
				<td><?=$customerName?></td>
			</tr>
			<tr>
				<td>Vehicle</td>
				<td><?=$vehicleInfo?></td>
			</tr>
			<tr>
				<td>Mileage in</td>
				<td><?=$mileage_in?></td>
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
		<input type="hidden" name="createTicket" value="1">
	<hr/><button class="btn btn-warning" onclick="history.go(-1);"><i class="fa fa-arrow-left" aria-hidden="true"></i> back to vehicle selection</button>  <button class="btn btn-success" type="submit"><i class="fa fa-arrow-right" aria-hidden="true"></i> create ticket</button></form>
<?
} // ends step 3

elseif ($_REQUEST['step'] == 4){
	echo "step 4: add repair to ticket #$ticket_id";
?>	<!-- EXPERI -->
	<form method="post" target="new.php?step=4&ticket_id=<?=$ticket_id?>">
		<table class="table"><!-- general ticket info table -->
			<tr>
				<td>Customer</td>
				<td><?=$customerName?></td>
			</tr>
			<tr>
				<td>Vehicle</td>
				<td><?=$vehicleInfo?></td>
			</tr>
			<tr>
				<td>Mileage in</td>
				<td><?=$mileage_in?></td>
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
		<hr/>
		<!-- existing repair lines will inject here? echo repairsForTicket($ticket_id);-->
		<form method="post" target="new.php?step=4&ticket_id=<?=$ticket_id?>&createFix=1">
		<table class="table"><!-- repair line table -->
			<tr>
				<td>Repair #</td>
				<td>1</td>
			</tr>
			<tr>
				<td>Status</td>
				<td><?=repairStatusSelect(1,2) ?></td>
			</tr>
			<tr>
				<td>Concern</td>
				<td><input type="text" name="concern_1"></input></td>
			</tr>
			<tr>
				<td>Technician</td>
				<td><input type="text" name="tech_1"></td>
			</tr>
		</table>
		
		<button class="btn btn-success" type="submit"><i class="fa fa-arrow-right" aria-hidden="true"></i> create repair</button>
	</form>
<?
} // ends step 4

elseif ($_REQUEST['step'] == 5){

} // ends step 5

else{
	echo "bad call on /ticket/new.php.. what step?";
}

include_once('../system/foot.php');