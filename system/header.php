<?
$url = $_SERVER['REQUEST_URI'];	// all this is for highlighting the active nav menu item
if (strpos($url,'ticket') !== false) {
	$activeTickets = ' active';
} elseif (strpos($url,'/vehicle/') !== false) {
	$activeVehicles = ' active';
} elseif (strpos($url,'/customer/') !== false) {
	$activeCustomers = ' active';
} elseif (strpos($url,'/dev/') !== false) {
	$activeDev = ' active';
} else { /* nothing */ }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="originaldougal.com">
	<meta name="mobile-web-app-capable" content="yes">
	<title>fxwx <? echo $fxwx_version; ?></title>

	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="/fxwx/system/fxwx.css">
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
	<script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
	<script src="/fxwx/system/bootbox.min.js"></script>
	<script src="/fxwx/system/fxwx.js"></script>
	
	<!-- <script src="/fxwx/system/jquery.gaugeMeter-2.0.min.js"></script> -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<a name="thetop"></a>
	<div id="wrapper">
		<div class="container" id="main">
		<!-- Static navbar -->
		<nav class="navbar navbar-default navbar-top">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="/fxwx/index.php"><? require_once("icon.php") ?></a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
			  <ul class="nav navbar-nav">
				<li class="dropdown<?=$activeCustomers?>">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-id-card-o" aria-hidden="true"></i> Customers</a>
				  <ul class="dropdown-menu">
					<li><a href="/fxwx/customer/list.php"><i class="fa fa-search" aria-hidden="true"></i> Find</a></li>
					<li><a href="/fxwx/customer/new.php"><i class="fa fa-plus" aria-hidden="true"></i> Add new</a></li>
				  </ul>
				</li>
			  </ul>
				<ul class="nav navbar-nav">
				  <li class="dropdown<?=$activeVehicles?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-car" aria-hidden="true"></i> Vehicles</a>
					<ul class="dropdown-menu">
					  <li><a href="/fxwx/vehicle/list.php"><i class="fa fa-search" aria-hidden="true"></i> Find</a></li>
					  <li><a href="/fxwx/vehicle/new.php"><i class="fa fa-plus" aria-hidden="true"></i> Add new</a></li>
					</ul>
				  </li>
				</ul>
				<ul class="nav navbar-nav">
				  <li class="dropdown<?=$activeTickets?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file-text-o" aria-hidden="true"></i> Tickets</a>
					<ul class="dropdown-menu">
					  <li><a href="/fxwx/ticket/list.php"><i class="fa fa-search" aria-hidden="true"></i> Find</a></li>
					  <li><a href="/fxwx/ticket/new.php"><i class="fa fa-plus" aria-hidden="true"></i> Add new</a></li>
					</ul>
				  </li>
				</ul>
				<p class="navbar-text" id="statusbar"></p>
			<ul class="nav navbar-nav">
			  <li class="dropdown <?=$activeDev?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cogs" aria-hidden="true"></i> Dev</a>
				<ul class="dropdown-menu">
				  <li><a href="/fxwx/system/dev/"><i class="fa fa-cogs" aria-hidden="true"></i> Function tests</a></li>
				</ul>
			  </li>
			</ul>
			  <ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-o" aria-hidden="true"></i> Dougal</a>
					<ul class="dropdown-menu">
					  <li><a href="#"><i class="fa fa-gear" aria-hidden="true"></i> Settings</a></li>
					  <li><a href="#"><i class="fa fa-address-card" aria-hidden="true"></i> Account</a></li>
					  <li><a href="#"><i class="fa fa-times-circle" aria-hidden="true" style="color:red;"></i> Log out</a></li>
					</ul>
				</li>
			  </ul>
			</div><!--/.nav-collapse -->
		  </div><!--/.container-fluid -->
		</nav>