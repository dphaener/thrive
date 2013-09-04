<?php
$getcode=$_GET["q"];

require_once('../Connections/nutritionfacts.php');

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getProtein = "SELECT * FROM abbreviated WHERE abbreviated.NDB_No=".$getcode;
$getProtein = mysql_query($query_getProtein, $nutritionfacts) or die(mysql_error());
$row_getProtein = mysql_fetch_assoc($getProtein);
$totalRows_getProtein = mysql_num_rows($getProtein);

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getFoods = "SELECT * FROM food_descriptions WHERE food_descriptions.NDB_No=".$getcode." ORDER BY Long_Desc";
$getFoods = mysql_query($query_getFoods, $nutritionfacts) or die(mysql_error());
$row_getFoods = mysql_fetch_assoc($getFoods);

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$getcode." AND Seq=1";
$getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
$row_getWeight = mysql_fetch_assoc($getWeight);

$totalprotein = 0;

?>

<table border="1" class="blueglass"  style="color:#FFF; border-color:#FFF; margin:0 auto; border-collapse:collapse;" cellspacing="0" cellpadding="3">
  <tr><th colspan="4" style="border:0";><?php echo "Preview of nutritional data for a ".round($row_getWeight['Amount'])." ".$row_getWeight['Msre_Desc']." serving of"; ?></th>
    </tr>
  <tr><th colspan="4"  style="border:0";><?php echo $row_getFoods['Long_Desc']; ?> </th></tr>
  <tr style="border-color:#FFF;">
    <th>Calories</th>
	<th>Total Fat</th>
	<th>Carbs</th>
	<th>Protein</th>
  </tr>
  <tr style="border-color:#FFF;">
    <td style="text-align:center;"><?php echo round($row_getProtein['Energ_Kcal']*($row_getWeight['Gm_Wgt']/100)); ?></td>
  	<td style="text-align:center;"><?php echo round($row_getProtein['Lipid_Tot']*($row_getWeight['Gm_Wgt']/100))." grams"; ?></td>
	<td style="text-align:center;"><?php echo round($row_getProtein['Carbohydrt']*($row_getWeight['Gm_Wgt']/100))." grams"; ?></td>
	<td style="text-align:center;"><?php echo round($row_getProtein['Protein']*($row_getWeight['Gm_Wgt']/100))." grams"; ?></td>
  </tr>
</table>
  	


