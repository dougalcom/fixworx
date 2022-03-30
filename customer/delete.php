<?php
header('Location: http://originaldougal.com/fxwx/customer/list.php');
include_once('../system/config.php');

if($_REQUEST['customer_id']){
	$customer_id = $_REQUEST['customer_id'];
	$sql = "UPDATE fxwx_customers SET status=? WHERE customer_id=?";
	$sthandle = $dbhandle->prepare($sql);
	$sthandle->execute(array(0,$customer_id));
	$customerInfo = customerInfo($customer_id,false);
	setStatus("Deleted customer ".$customerInfo.".");
}

include_once('../system/foot.php');