<?php
// Nov 3 2015

include_once('../system/config.php');

// **************************************************
// * main program									*
// **************************************************

$sthandle = $dbhandle->prepare("SELECT * FROM fxwx_vehicles LEFT JOIN fxwx_customers ON fxwx_vehicles.customer_id = fxwx_customers.customer_id WHERE fxwx_vehicles.status = 1");
$sthandle->setFetchMode(PDO::FETCH_ASSOC);
$sthandle->execute();

while($row = $sthandle->fetch()) {
	$outputVehicles .= 
	"<tr><td>".
	'<a href="/fxwx/customer/edit.php?customer_id='.$row['customer_id'].'">'.$row['lastname'].", ".$row['firstname'].'</a> '
	."</td><td>".
	'<a href="/fxwx/vehicle/edit.php?vehicle_id='.$row['vehicle_id'].'">'.$row['make']." ".$row['model']." ".$row['year']." ".$row['trim']." (".$row['color'].")</a>"
	."</td><td>".
	$row['tag']
	."</td><td>".
	$row['plate']
	."</td><td>".
	$row['vin']
	.'</td></tr>';
}
?>
<h4>Find vehicle</h4>
<table class="table" id="sortTable">
	<thead>
		<tr>
			<td>Customer</td>
			<td>Vehicle</td>
			<td>Tag #</td>
			<td>Plate</td>
			<td>VIN</td>
		</tr>
	</thead>
	<tbody>
		<?=$outputVehicles ?>
	</tbody>
</table>

<? include_once('../system/foot.php');