<?php
header('Location: http://originaldougal.com/fxwx/ticket/list.php');
include_once('../system/config.php');

if($_REQUEST['ticket_id']){
	$ticket_id = $_REQUEST['ticket_id'];
	$sql = "UPDATE fxwx_tickets SET status=? WHERE ticket_id=?";
	$sthandle = $dbhandle->prepare($sql);
	$sthandle->execute(array(0,$ticket_id));
	$ticketInfo = ticketInfo($ticket_id,false);
	setStatus("Deleted ticket ".$ticketInfo.".");
}

include_once('../system/foot.php');