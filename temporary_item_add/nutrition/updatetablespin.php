<?php
$getcode=$_GET["q"];
$userid=$_GET["r"];
$curdate=$_GET["s"];
$amount=$_GET["t"];
$seq=$_GET["u"];
$meal=$_GET["v"];
$entryid=$_GET["w"];

require_once('../Connections/nutritionfacts.php');

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getNuts = "SELECT * FROM nutrients WHERE NDB_No=".$getcode;
$getNuts = mysql_query($query_getNuts, $nutritionfacts) or die(mysql_error());
$row_getNuts = mysql_fetch_assoc($getNuts);
$totalRows_getNuts = mysql_num_rows($getNuts);

$date = date('Y-m-d', strtotime($curdate));
$changetable=mysql_query("UPDATE NutritionTotals SET User_Id='".$userid."', Create_Date='".$date."', Meal_Number='".$meal."', NDB_No='".$getcode."', Seq='".$seq."', Amount='".$amount."' WHERE Entry_Id=".$entryid);

?>

<p></p>