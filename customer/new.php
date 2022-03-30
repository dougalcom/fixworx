<?php

// started nov 5 2015

include_once('../system/config.php');

if($_REQUEST['formSubmit'] == 1){
	$sthandle = $dbhandle->prepare("INSERT INTO fxwx_customers (status, language_pref, prefix, firstname, lastname, postfix, address1, address2, address3, city, state, postalcode, country, phone1, phone2, phone3, phone4, phone5, phone6, can_sms, email, notes, created_on) value (:status, :language_pref, :prefix, :firstname, :lastname, :postfix, :address1, :address2, :address3, :city, :state, :postalcode, :country, :phone1, :phone2, :phone3, :phone4, :phone5, :phone6, :can_sms, :email, :notes, :created_on)");
	$status = 1; $sthandle->bindParam(':status', $status);
	$sthandle->bindParam(':language_pref', $_REQUEST['language_pref']);
	$sthandle->bindParam(':prefix', $_REQUEST['prefix']);
	$sthandle->bindParam(':firstname', $_REQUEST['firstname']);
	$sthandle->bindParam(':lastname', $_REQUEST['lastname']);
	$sthandle->bindParam(':postfix', $_REQUEST['postfix']);
	$sthandle->bindParam(':address1', $_REQUEST['address1']);
	$sthandle->bindParam(':address2', $_REQUEST['address2']);
	$sthandle->bindParam(':address3', $_REQUEST['address3']);
	$sthandle->bindParam(':city', $_REQUEST['city']);
	$sthandle->bindParam(':state', $_REQUEST['state']);
	$sthandle->bindParam(':postalcode', $_REQUEST['postalcode']);
	$sthandle->bindParam(':country', $_REQUEST['country']);
	$sthandle->bindParam(':phone1', $_REQUEST['phone1']);
	$sthandle->bindParam(':phone2', $_REQUEST['phone2']);
	$sthandle->bindParam(':phone3', $_REQUEST['phone3']);
	$sthandle->bindParam(':phone4', $_REQUEST['phone4']);
	$sthandle->bindParam(':phone5', $_REQUEST['phone5']);
	$sthandle->bindParam(':phone6', $_REQUEST['phone6']);
	$sthandle->bindParam(':can_sms', $_REQUEST['can_sms']);
	$sthandle->bindParam(':email', $_REQUEST['email']);
	$sthandle->bindParam(':notes', $_REQUEST['notes']);
	$currentDateTime = date("Y-m-d H:i:s"); $sthandle->bindParam(':created_on', $currentDateTime);
	$sthandle -> execute($data);
	$status = "Added customer ".$_REQUEST["firstname"]." ".$_REQUEST["lastname"].".";
	setStatus($status);
}
?>

<h4>Add new customer</h4>
<form id="addCustomerForm" method="post">
	<table class="table">
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
	<input class="btn btn-default" type="submit" value="Add customer">
</form>
<?
include_once('../system/foot.php');