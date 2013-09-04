<?php
$entryid=$_GET["q"];
$mealname=$_GET["r"];

require_once('../Connections/nutritionfacts.php');
mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getNames = "SELECT Meal_Number FROM Meal_List WHERE Meal_Desc='".$mealname."'";
$getNames = mysql_query($query_getNames, $nutritionfacts) or die(mysql_error());
$row_getNames = mysql_fetch_assoc($getNames);
$mealnum=$row_getNames['Meal_Number'];

$getFoods=mysql_query("UPDATE NutritionTotals SET Meal_Number='".$mealnum."' WHERE Entry_Id='".$entryid."'");
$getFoods = mysql_query($query_getFoods, $nutritionfacts) or die(mysql_error());

?>

<p><?php echo $getFoods; ?></p>