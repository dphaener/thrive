<?php
$getcode=$_GET["q"];

require_once('../Connections/nutritionfacts.php');

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getFoods = "DELETE FROM NutritionTotals WHERE Entry_Id='".$getcode."'";
$getFoods = mysql_query($query_getFoods, $nutritionfacts) or die(mysql_error());


?>

<p><?php echo $getFoods; ?></p>


        
		
