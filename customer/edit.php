<?php
// Nov 3 2015
include_once('../system/config.php');

// **************************************************
// * update record									*
// **************************************************
if($_REQUEST['formSubmit'] == 1){
	$sql = "UPDATE fxwx_customers SET shop_id=?, status=?, language_pref=?, prefix=?, firstname=?, lastname=?, postfix=?, address1=?, address2=?, address3=?, city=?, state=?, postalcode=?, country=?, phone1=?, phone2=?, phone3=?, phone4=?, phone5=?, phone6=?, can_sms=?, email=?, notes=?, updated_on=? WHERE customer_id=?";
	$sthandle = $dbhandle->prepare($sql);
	$sthandle->execute(
		array(
			$_REQUEST['shop_id'],
			$_REQUEST['status'],
			$_REQUEST['language_pref'],
			$_REQUEST['prefix'],
			$_REQUEST['firstname'],
			$_REQUEST['lastname'],
			$_REQUEST['postfix'],
			$_REQUEST['address1'],
			$_REQUEST['address2'],
			$_REQUEST['address3'],
			$_REQUEST['city'],
			$_REQUEST['state'],
			$_REQUEST['postalcode'],
			$_REQUEST['country'],
			$_REQUEST['phone1'],
			$_REQUEST['phone2'],
			$_REQUEST['phone3'],
			$_REQUEST['phone4'],
			$_REQUEST['phone5'],
			$_REQUEST['phone6'],
			$_REQUEST['can_sms'],
			$_REQUEST['email'],
			$_REQUEST['notes'],
			date("Y-m-d H:i:s"),
			$_REQUEST['customer_id']
	));
	$updatedName = customerInfo($_REQUEST['customer_id'], true);
	$status = "Updated ".$updatedName."\'s customer record.";
	setStatus($status);
}

// **************************************************
// * get customer info				    			*
// **************************************************
$sthandle = $dbhandle->prepare("SELECT * FROM fxwx_customers WHERE customer_id = ".$_REQUEST['customer_id']);
$sthandle->setFetchMode(PDO::FETCH_ASSOC);
$sthandle->execute();
while($row = $sthandle->fetch()) {
	$customer_id = $row['customer_id'];
	$shop_id = $row['shop_id'];
	$created_on = $row['created_on'];
	$created_by_user_id = $row['created_by_user_id'];
	$updated_on = $row['updated_on'];
	$updated_by_user_id = $row['updated_by_user_id'];
	$status = $row['status'];
	$language_pref = $row['language_pref'];
	$prefix = $row['prefix'];
	$firstname = $row['firstname'];
	$lastname = $row['lastname'];
	$postfix = $row['postfix'];
	$address1 = $row['address1'];
	$address2 = $row['address2'];
	$address3 = $row['address3'];
	$city = $row['city'];
	$state = $row['state'];
	$postalcode = $row['postalcode'];
	$country = $row['country'];
	$phone1 = $row['phone1'];
	$phone2 = $row['phone2'];
	$phone3 = $row['phone3'];
	$phone4 = $row['phone4'];
	$phone5 = $row['phone5'];
	$phone6 = $row['phone6'];
	$can_sms = $row['can_sms'];
	$email = $row['email'];
	$notes = $row['notes'];
}
?>

<h4>Customer detail</h4>
<form method="post">
	<table class="table">
		<tr>
			<td>Customer ID</td>
			<td><?=$customer_id?></td>
		</tr>
		<tr>
			<td>Shop ID</td>
			<td><?=$shop_id?></td>
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
			<td><input type="text" name="status" value="<?=$status?>"></td>
		</tr>
		<tr>
			<td>Language</td>
			<td><input type="text" name="language_pref" value="<?=$language_pref?>"></td>
		</tr>
		<tr>
			<td>Prefix</td>
			<td><input type="text" name="prefix" value="<?=$prefix?>"></td>
		</tr>
		<tr>
			<td>First Name</td>
			<td><input type="text" name="firstname" value="<?=$firstname?>"></td>
		</tr>
		<tr>
			<td>Last Name</td>
			<td><input type="text" name="lastname" value="<?=$lastname?>"></td>
		</tr>
		<tr>
			<td>Postfix</td>
			<td><input type="text" name="postfix" value="<?=$postfix?>"></td>
		</tr>
		<tr>
			<td>Address 1</td>
			<td><input type="text" name="address1" value="<?=$address1?>"></td>
		</tr>
		<tr>
			<td>Address 2</td>
			<td><input type="text" name="address2" value="<?=$address2?>"></td>
		</tr>
		<tr>
			<td>Address 3</td>
			<td><input type="text" name="address3" value="<?=$address3?>"></td>
		</tr>
		<tr>
			<td>City</td>
			<td><input type="text" name="city" value="<?=$city?>"></td>
		</tr>
		<tr>
			<td>State/Provence</td>
			<td><input type="text" name="state" value="<?=$state?>"></td>
		</tr>
		<tr>
			<td>Postal code</td>
			<td><input type="text" name="postalcode" value="<?=$postalcode?>"></td>
		</tr>
		<tr>
			<td>Country</td>
			<td><input type="text" name="country" value="<?=$country?>"></td>
		</tr>
		<tr>
			<td>Phone 1</td>
			<td><input type="text" name="phone1" value="<?=$phone1?>"></td>
		</tr>
		<tr>
			<td>Phone 2</td>
			<td><input type="text" name="phone2" value="<?=$phone2?>"></td>
		</tr>
		<tr>
			<td>Phone 3</td>
			<td><input type="text" name="phone3" value="<?=$phone3?>"></td>
		</tr>
		<tr>
			<td>Phone 4</td>
			<td><input type="text" name="phone4" value="<?=$phone4?>"></td>
		</tr>
		<tr>
			<td>Phone 5</td>
			<td><input type="text" name="phone5" value="<?=$phone5?>"></td>
		</tr>
		<tr>
			<td>Phone 6</td>
			<td><input type="text" name="phone6" value="<?=$phone6?>"></td>
		</tr>
		<tr>
			<td>Can SMS</td>
			<td><input type="text" name="can_sms" value="<?=$can_sms?>"></td>
		</tr>
		<tr>
			<td>Email address</td>
			<td><input type="text" name="email" value="<?=$email?>"></td>
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
<a href="/fxwx/customer/delete.php?customer_id=<?=$customer_id?>">Delete customer</a>

<? include_once('../system/foot.php');