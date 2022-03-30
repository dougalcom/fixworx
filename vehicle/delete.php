<?php
header('Location: http://originaldougal.com/fxwx/vehicle/list.php');
include_once('../system/config.php');

if($_REQUEST['vehicle_id']){
	$vehicle_id = $_REQUEST['vehicle_id'];
	$sql = "UPDATE fxwx_vehicles SET status=? WHERE vehicle_id=?";
	$sthandle = $dbhandle->prepare($sql);
	$sthandle->execute(array(0,$vehicle_id));
	$vehicleInfo = vehicleInfo($vehicle_id);
	setStatus("Deleted a ".$vehicleInfo.".");
}

include_once('../system/foot.php');