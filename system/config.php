<?php
// **************************************************
// * config.php version history						*
// **************************************************


// **************************************************
// * configuration									*
// **************************************************
$dbhost = "";			//	mysql database hostname
$dbname	= "";				//  mysql database name
$dbuser = "";		//  mysql database username
$dbpass = "";				//  mysql database password
$GLOBALS['fxwx_path'] = "";		// application absolute root path
$GLOBALS['fxwx_version'] = 0.58;							// application version
ini_set("date.timezone", "America/Chicago");

// **************************************************
// * main db connector								*
// **************************************************
try {
  $dbhandle = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
  $dbhandle -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(PDOException $e) {
	echo $e->getMessage();
	echo "<br/>A database anomaly has been logged.<br/>";
	file_put_contents('error_log', $e->getMessage(), FILE_APPEND);
}

// **************************************************
// * read last line of file							*
// **************************************************
function read_last_line ($file_path){
	$line = '';
	$f = fopen($file_path, 'r');
	$cursor = -1;
	fseek($f, $cursor, SEEK_END);
	$char = fgetc($f);
	//Trim trailing newline chars of the file
	while ($char === "\n" || $char === "\r") {
		fseek($f, $cursor--, SEEK_END);
		$char = fgetc($f);
	}
	// Read until the start of file or first newline char
	while ($char !== false && $char !== "\n" && $char !== "\r") {
		// Prepend the new char
		$line = $char . $line;
		fseek($f, $cursor--, SEEK_END);
		$char = fgetc($f);
	}
	return $line;
}

// **************************************************
// * write a status entry							*
// **************************************************
function setStatus ($status_string){
	file_put_contents($GLOBALS['fxwx_path']."system/status.txt",date("m/d g:ia").": ".$status_string."\n",FILE_APPEND);
}

// **************************************************
// * display a customer dropdown form element		*
// **************************************************
function customerSelect ($selected_customer_id = 0){
	global $dbhandle;
	$sthandle = $dbhandle->prepare("SELECT * FROM fxwx_customers where status = 1 ORDER BY lastname ASC");
	$sthandle->setFetchMode(PDO::FETCH_ASSOC);
	$sthandle->execute();
	$output = '<select name="customer_id" id="customer_id">';
	if($selected_customer_id == 0){
		$output .= '<option value="">Select an owner</option>';
	}
	while($row = $sthandle->fetch()) {
		if($row['customer_id'] == $selected_customer_id){
			$isSelected = 'selected';
		}
		else{
			$isSelected = '';
		}
		$output .= '
			<option value="'.$row['customer_id'].'" '.$isSelected.'>'.$row['lastname'].', '.$row['firstname'].'</option>
		';
	}
	$output .= '</select>';
	return $output;
}

// **********************************************************
// * display a contact preference dropdown form element		*
// **********************************************************
function phonePrefSelect ($phonePrefData = NULL){
	if($phonePrefData == 'phone1'){$isSelectedPhone1 = 'selected';}
	if($phonePrefData == 'email'){$isSelectedEmail = 'selected';}
	if($phonePrefData == 'sms'){$isSelectedSMS = 'selected';}
	if($phonePrefData == 'phone2'){$isSelectedPhone2 = 'selected';}
	if($phonePrefData == 'phone3'){$isSelectedPhone3 = 'selected';}
	if($phonePrefData == 'phone4'){$isSelectedPhone4 = 'selected';}
	if($phonePrefData == 'phone5'){$isSelectedPhone5 = 'selected';}
	if($phonePrefData == 'phone6'){$isSelectedPhone6 = 'selected';}
	$output = '
		<select name="phone_pref">
			<option value="">Not set</option>
			<option value="phone1" '.$isSelectedPhone1.'>Phone 1</option>
			<option value="email" '.$isSelectedEmail.'>Email</option>
			<option value="sms" '.$isSelectedSMS.'>SMS</option>
			<option value="phone2" '.$isSelectedPhone2.'>Phone 2</option>
			<option value="phone3" '.$isSelectedPhone3.'>Phone 3</option>
			<option value="phone4" '.$isSelectedPhone4.'>Phone 4</option>
			<option value="phone5" '.$isSelectedPhone5.'>Phone 5</option>
			<option value="phone6" '.$isSelectedPhone6.'>Phone 6</option>
	   </select>
		   ';
	return $output;
}

// **********************************************************
// * display a repair status dropdown form element			*
// **********************************************************
function repairStatusSelect ($repair_id = NULL, $val = NULL){	// repair_id, val
	if($val == 0){$isSelected0 = 'selected';}
	if($val == 1){$isSelected1 = 'selected';}
	if($val == 2){$isSelected2 = 'selected';}
	if($val == 3){$isSelected3 = 'selected';}
	if($val == 4){$isSelected4 = 'selected';}
	$output = '
		<select name="repair_'.$repair_id.'_status">
			<option value="">Not set</option>
			<option value="0" '.$isSelected0.'>0</option>
			<option value="1" '.$isSelected1.'>1</option>
			<option value="2" '.$isSelected2.'>2</option>
			<option value="3" '.$isSelected3.'>3</option>
			<option value="4" '.$isSelected4.'>4</option>
	   </select>
		   ';
	return $output;
}

// **************************************************
// * display a vehicle selection form element		*
// **************************************************
function vehicleSelect ($selected_customer_id = false, $displayType = 'list'){
	global $dbhandle;
	if($selected_customer_id){
			// get vehicles for customer
			$sthandle = $dbhandle->prepare("SELECT * FROM fxwx_vehicles where status = 1 && customer_id = $selected_customer_id ORDER BY updated_on DESC");
			$sthandle->setFetchMode(PDO::FETCH_ASSOC);
			$sthandle->execute();
			// check how many results there are gonna be
			$nRows = $dbhandle->query("SELECT count(*) FROM fxwx_vehicles where status = 1 && customer_id = $selected_customer_id ORDER BY updated_on DESC")->fetchColumn();
		}// closes the part that runs IF there is a customer id
		else{ // if there is no vehicle id sent to the function...
			// get vehicles for customer
			$sthandle = $dbhandle->prepare("SELECT * FROM fxwx_vehicles where status = 1 ORDER BY updated_on DESC");
			$sthandle->setFetchMode(PDO::FETCH_ASSOC);
			$sthandle->execute();
			// check how many results there are gonna be
			$nRows = $dbhandle->query("SELECT count(*) FROM fxwx_vehicles where status = 1 ORDER BY updated_on DESC")->fetchColumn();
		}
	if($nRows == 0){ // no vehicles for this customer
		$output .= 'No vehicles for this customer.';
	}
	if($displayType == 'dropdown'){

		if($nRows == 1){ // only one vehicle for this customer
			while($row = $sthandle->fetch()) {
				$output .= '
					<a href="/fxwx/vehicle/edit.php?vehicle_id='.$row['vehicle_id'].'">'.$row['make'].' '.$row['model'].'</a>
				';
			}
		}
		if($nRows > 1){ // multiple rows -- make dropdown
			$output = '<select name="vehicle_id" id="vehicle_id">';
			$output .= '<option value="">'.$nRows.' vehicles</option>'; // display number of vehicles for this customer
			while($row = $sthandle->fetch()) {
				$output .= '<option value="'.$row['vehicle_id'].'" >'.$row['make'].' '.$row['model'].'</option>';
			}
			$output .= '</select>';
		} // /else
	} // if dropdown
	elseif($displayType == 'newTicketVehicleSelector'){
		$output .= '<ol>';
		while($row = $sthandle->fetch()) { // displays list of vehicles for given customer_id in linked list format
			$output .= '<li><a href="/fxwx/ticket/new.php?step=2&customer_id='.$selected_customer_id.'&vehicle_id='.$row['vehicle_id'].'">'.$row['year'].' '.$row['make'].' '.$row['model'].'</a></li>';
		}
		$output .= '</ol>';
	}
	elseif($displayType == 'modalSelector'){	// displays list of vehicles for given customer_id in a format that works in modal selectors

		while($row = $sthandle->fetch()) {
			$output = '<form action="">';
			$output .=

			'<a href="#" class="close" data-dismiss="modal" id="'.$row['vehicle_id'].'" name="vehicleSelectModalButton">'.
			$row['year']
			.' '.
			$row['make']
			.' '.
			$row['model']
			.'</a>
			'
			;	$output .= '</form>';
		}

	}
	return $output;
}

// **************************************************
// * get brief info on a specific vehicle			*
// **************************************************
function vehicleInfo ($vehicle_id, $displayType = true){
	if($vehicle_id){
		global $dbhandle;
		$sthandle = $dbhandle->prepare("SELECT * FROM fxwx_vehicles where vehicle_id = $vehicle_id LIMIT 1");
		$sthandle->setFetchMode(PDO::FETCH_ASSOC);
		$sthandle->execute();
		while($row = $sthandle->fetch()) {
			if($displayType == true){ $output = '<a href="/fxwx/vehicle/edit.php?vehicle_id='.$vehicle_id.'">'.$row['year'].' '.$row['make'].' '.$row['model'].'</a>'; } // displays vehicle info with link to EDIT
			else{ $output = $row['year'].' '.$row['make'].' '.$row['model']; } // displays vehicle info, simply unlinked
		}
		return $output;
	}
}

// **************************************************
// * get brief info on a specific customer			*
// **************************************************
function customerInfo ($customer_id, $linkFlag = false){
	global $dbhandle;
	if($customer_id){
		$sthandle = $dbhandle->prepare("SELECT * FROM fxwx_customers where customer_id = $customer_id LIMIT 1");
		$sthandle->setFetchMode(PDO::FETCH_ASSOC);
		$sthandle->execute();
		while($row = $sthandle->fetch()) {
			if($linkFlag == true)
			{
				$output = '<a href="/fxwx/customer/edit.php?customer_id='.$customer_id.'">'.$row['firstname'].' '.$row['lastname'].'</a>';
			}
			else{
				$output = $row['firstname'].' '.$row['lastname'];
			}
		}
		return $output;
	}
	else
	{
		return 'error: bad call to customerInfo() in config.php';
	}
}

// **************************************************
// * display a modal								*
// **************************************************
function modal ($id, $title, $body, $footer){
	$output = '
	<div id="'.$id.'" class="modal" role="dialog">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">'.$title.'</h4>
		  </div>
		  <div class="modal-body">
			'.$body.'
		  </div>
		  <div class="modal-footer">
		  	'.$footer.'
		  </div>
		</div>
	  </div>
	</div>
	';
	return $output;
}

// **************************************************
// * display a modal for selecting customer			*
// **************************************************
function customerSelectModal($id = 'customerSelectModal', $title = 'Select customer'){
	global $dbhandle;
	$sthandle = $dbhandle->prepare("SELECT * FROM fxwx_customers WHERE fxwx_customers.status = 1");
	$sthandle->setFetchMode(PDO::FETCH_ASSOC);
	$sthandle->execute();
	while($row = $sthandle->fetch()) {
		$outputCustomers .=
		"<tr><td>".
		$row['lastname']
		."</td><td>".
		$row['firstname']
		."</td><td>".
		vehicleSelect($row['customer_id'],'modalSelector')
		.'</td></tr>';
	}
	$body = '
	<table name="sortTable" class="table" id="sortTable">
	<thead>
	<tr>
		<td>Last name</td>
		<td>First name</td>
		<td>Vehicles</td>
	</tr>
	</thead>
	<tbody>
	'.$outputCustomers.'
	</tbody>
	</table>';
	$output = modal($id, $title, $body, $footer);
	return $output;
}

// **************************************************
// * get number of vehicles by customer_id			*
// **************************************************
function numberVehiclesByCustomer($customer_id) {
	global $dbhandle;
	$sthandle = $dbhandle->prepare("SELECT count(*) FROM fxwx_vehicles WHERE fxwx_vehicles.customer_id = $customer_id AND fxwx_vehicles.status = 1");
	$sthandle->setFetchMode(PDO::FETCH_ASSOC);
	$sthandle->execute();
	$numRows = $sthandle->fetchColumn();
	return $numRows;
}

// **************************************************
// * display a modal for selecting vehicle			*
// **************************************************
function vehicleSelectModal($id = 'vehicleSelectModal', $title = 'Select vehicle'){
	global $dbhandle;
	$body = vehicleSelect();
	$output = modal($id, $title, $body, $footer);
	return $output;
}
include_once($fxwx_path."system/header.php");
?>