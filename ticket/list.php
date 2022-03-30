<?php
// Nov 5 2015

include_once('../system/config.php');

//  **************************************************
//  * main program									 *
//  **************************************************
$sthandle = $dbhandle->prepare("SELECT * FROM fxwx_tickets WHERE fxwx_tickets.status = 1");
$sthandle->setFetchMode(PDO::FETCH_ASSOC);
$sthandle->execute();

while($row = $sthandle->fetch()) {
	// get the vehicle info but not without a blank argument
	if($row['vehicle_id']){$vehicleInfoDisplay = vehicleInfo($row['vehicle_id']);}
	$outputtickets .= 
	"<tr><td>".
	'<a href="/fxwx/ticket/edit.php?ticket_id='.$row['ticket_id'].'">'.$row['ticket_id'].'</a>'
	."</td><td>".
	$row['created_on']
	."</td><td>".
	$row['created_by_user_id']
	."</td><td>".
	$vehicleInfoDisplay
	."</td><td>".
	$row['status']
	.'</td></tr>'."\n";
}
?>

<script>
	$(document).ready(function() {
		$('#sortTable').DataTable( {
			"order": [[ 1, "desc" ]]
		} );
	} );
</script>

<h4>Find ticket</h4>
<table class="table" id="sortTable">
<thead>
	<tr>
		<td>Ticket ID</td>
		<td>Opened</td>
		<td>Manager</td>
		<td>Vehicle</td>
		<td>Status</td>
	</tr>
</thead>
	<tbody>
		<?=$outputtickets ?>
	<tbody>
</table>

<? include_once('../system/foot.php');