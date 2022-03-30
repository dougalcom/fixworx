<?php
include_once('../config.php');

echo customerSelectModal();
echo vehicleSelectModal();
echo "System time is ";
echo date('h:i:s A M d y');
?>
<hr/>
<a data-toggle="modal" data-target="#customerSelectModal">customerSelectModal</a><br/>
<a data-toggle="modal" data-target="#vehicleSelectModal">vehicleSelectModal</a>

<?php
phpinfo();
include_once('../foot.php');
?>