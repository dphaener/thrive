<?php
$getcode=$_GET["q"];
$userid=$_GET["r"];
$curdate=$_GET["s"];
$amount=$_GET["t"];
$seq=$_GET["u"];
$meal=$_GET["v"];

require_once('../Connections/nutritionfacts.php');

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getNuts = "SELECT * FROM nutrients WHERE NDB_No=".$getcode;
$getNuts = mysql_query($query_getNuts, $nutritionfacts) or die(mysql_error());
$row_getNuts = mysql_fetch_assoc($getNuts);
$totalRows_getNuts = mysql_num_rows($getNuts);

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getNuts = "SELECT Seq FROM weights WHERE NDB_No=".$getcode." AND Msre_Desc='".$seq."'";
$getNuts = mysql_query($query_getNuts, $nutritionfacts) or die(mysql_error());
$row_getNuts = mysql_fetch_assoc($getNuts);
$totalRows_getNuts = mysql_num_rows($getNuts);

switch ($seq) {
	   case 1:
	     break;
	   default:
	     $seq=$row_getNuts['Seq'];
	     break;
}

$date = date('Y-m-d', strtotime($curdate));

$changetable=mysql_query("INSERT INTO NutritionTotals (User_Id, Create_Date, Meal_Number, NDB_No, Seq, Amount) VALUES ('".$userid."','".$date."','".$meal."','".$getcode."','".$seq."','".$amount."')");

?>

<p><?php echo $changetable;?></p>