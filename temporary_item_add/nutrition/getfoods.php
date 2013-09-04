<?php
$getcode=$_GET["q"];

require_once('../Connections/nutritionfacts.php');

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getFoods = "SELECT * FROM FOOD_DES WHERE FOOD_DES.FdGrp_Cd=".$getcode." ORDER BY Long_Desc";
$getFoods = mysql_query($query_getFoods, $nutritionfacts) or die(mysql_error());
$row_getFoods = mysql_fetch_assoc($getFoods);
$totalRows_getFoods = mysql_num_rows($getFoods);
$foodnumber=$row_getFoods['NDB_No'];
?>

<?php
do {  
?>
            <option value="<?php echo $row_getFoods['NDB_No']?>"><?php echo $row_getFoods['Long_Desc']?></option>
<?php            
} while ($row_getFoods = mysql_fetch_assoc($getFoods));
  $rows = mysql_num_rows($getFoods);
  if($rows > 0) {
      mysql_data_seek($getFoods, 0);
	  $row_getFoods = mysql_fetch_assoc($getFoods);
  }
?>

        
		
