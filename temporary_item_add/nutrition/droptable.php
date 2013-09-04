<?php
$getcode=$_GET["q"];

require_once('../Connections/nutritionfacts.php');

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getFoods = "DROP TABLE IF EXISTS ".$getcode;
$getFoods = mysql_query($query_getFoods, $nutritionfacts) or die(mysql_error());


?>

<p><?php echo $getFoods; ?></p>


        
		
