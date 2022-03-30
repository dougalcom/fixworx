<?php

// /customer/list.php

// Nov 4 2015

include_once('../system/config.php');

// **************************************************
// * main program									*
// **************************************************
$sthandle = $dbhandle->prepare("SELECT * FROM fxwx_customers WHERE fxwx_customers.status = 1");
$sthandle->setFetchMode(PDO::FETCH_ASSOC);
$sthandle->execute();

while($row = $sthandle->fetch()) {
	$outputCustomers .= 
	"<tr><td>".
	'<a href="/fxwx/customer/edit.php?customer_id='.$row['customer_id'].'">'.$row['lastname'].'</a>'
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

// **************************************************
// * presentation									*
// **************************************************
?>
<h4>Find customer</h4>
<table name="sortTable" class="table" id="sortTable">
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
<? include_once('../system/foot.php');