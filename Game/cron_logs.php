<?php
include("dbconnect.php");

// Clear Logs that are over 1 day old
mysqli_query($con,"DELETE FROM logs WHERE 'time' < (time() -86400)");

?>