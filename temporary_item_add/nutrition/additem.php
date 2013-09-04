<?php require_once('../Connections/nutritionfacts.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getFoodGroups = "SELECT * FROM FD_GROUP ORDER BY FdGrp_Desc";
$getFoodGroups = mysql_query($query_getFoodGroups, $nutritionfacts) or die(mysql_error());
$row_getFoodGroups = mysql_fetch_assoc($getFoodGroups);
$totalRows_getFoodGroups = mysql_num_rows($getFoodGroups);

?>



<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Thrive Nutrition and Fitness: Add Item to Database</title>
<link href="../styles/thrivenutritionfitness.css" rel="stylesheet"
      type="text/css">
<link href="../styles/chosen.css" rel="stylesheet"
      type="text/css">
<link href="../styles/smoothness/jquery-ui-1.10.0.custom.css" rel="stylesheet"
      type="text/css">

</head>
<body>
<div id="container">
  <div id="header"> <a href="../index.php">
    <?php include '../header2.php';?>
    </a> </div>
  <div id="menu-bar">
    <?php
	  	 if (isset($_SESSION['user_id'])) 
		 {
		 include '../NewMenu.php';
 		 }   
		 else 
		 {
		 include '../menu.php'; 
		 }
	  ?>
  </div>
  <div id="all_content">
    <div class="weight_loss_header" style="text-align:center; margin-top:10px;">
      <h3>Add Item</h3>
    </div>
    <div class="greenglass" style="margin-top:10px; color:#FFF;">
        
 <form method="POST" action="insertitem.php">        
<label for="mealname" style="width:350px; display:inline-block;">Please enter a name for this item:</label> 
<input id="mealname" name="mealname" style="width:350px; display:inline-block;"><br><br>
<label for="measure" style="width:350px; display:inline-block;">Please enter the measurement for this item:</label> 
<input id="measure" name="measure" title="Cup, ounce, bowl, meal, etc...." style="width:350px; display:inline-block;"><br><br>
<div style="color:#000;">
<label for="foodgroup" style="width:350px; display:inline-block; color:#FFF;">Select a food group:</label> 
<select id="foodgroup" data-placeholder="Choose a food group..." name="foodgroup" class="chzn-select" style="width:350px; display:inline-block;">
            <?php
do {  ?>
   	  	<option value="<?php echo $row_getFoodGroups['FdGrp_Cd']?>"><?php echo $row_getFoodGroups['FdGrp_Desc']?></option>	
 <?php           
} while ($row_getFoodGroups = mysql_fetch_assoc($getFoodGroups));
  $rows = mysql_num_rows($getFoodGroups);
  if($rows > 0) {
      mysql_data_seek($getFoodGroups, 0);
	  $row_getFoodGroups = mysql_fetch_assoc($getFoodGroups);
  }
  
  
?>  
</select>	
</div>  
<br> 
<hr> 

<label for="calories" class="names">Calories:</label> 
<input name="calories" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">Kcal</span>
<label for="totalfat" class="names">Total Fat:</label> 
<input name="totalfat" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">grams</span>
<label for="satfat" class="names">Saturated Fat:</label> 
<input name="satfat" style="width:40px; display:inline-block;" value="0">
<span class="labelslast">grams</span><br><hr>
<label for="monofat" class="names">Monounsaturated Fat:</label> 
<input name="monofat" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">grams</span>
<label for="polyfat" class="names">Polyunsaturated Fat:</label> 
<input name="polyfat" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">grams</span>
<label for="transfat" class="names">Trans Fat:</label> 
<input name="transfat" style="width:40px; display:inline-block;" value="0">
<span class="labelslast">grams</span><br><hr>
<label for="choles" class="names">Cholesterol:</label> 
<input name="choles" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">grams</span>
<label for="sodium" class="names">Sodium:</label> 
<input name="sodium" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">mg</span>
<label for="potassium" class="names">Potassium:</label> 
<input name="potassium" style="width:40px; display:inline-block;" value="0">
<span class="labelslast">mg</span><br><hr>
<label for="carbs" class="names">Carbohydrates:</label> 
<input name="carbs" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">grams</span>
<label for="fiber" class="names">Fiber:</label> 
<input name="fiber" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">grams</span>
<label for="sugar" class="names">Sugar:</label> 
<input name="sugar" style="width:40px; display:inline-block;" value="0">
<span class="labelslast">grams</span><br><hr>
<label for="protein" class="names">Protein:</label> 
<input name="protein" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">grams</span>
<label for="calcium" class="names">Calcium:</label> 
<input name="calcium" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">%</span>
<label for="iron" class="names">Iron:</label> 
<input name="iron" style="width:40px; display:inline-block;" value="0">
<span class="labelslast">%</span><br><hr>
<label for="magnesium" class="names">Magnesium:</label> 
<input name="magnesium" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">%</span>
<label for="phosphorus" class="names">Phosphorus:</label> 
<input name="phosphorus" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">%</span>
<label for="zinc" class="names">Zinc:</label> 
<input name="zinc" style="width:40px; display:inline-block;" value="0">
<span class="labelslast">%</span><br><hr>
<label for="copper" class="names">Copper:</label> 
<input name="copper" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">%</span>
<label for="mang" class="names">Manganese:</label> 
<input name="mang" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">%</span>
<label for="selenium" class="names">Selenium:</label> 
<input name="selenium" style="width:40px; display:inline-block;" value="0">
<span class="labelslast">%</span><br><hr>
<label for="fluoride" class="names">Fluoride:</label> 
<input name="fluoride" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">%</span>
<label for="water" class="names">Water:</label> 
<input name="water" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">grams</span>
<label for="vitc" class="names">Vitamin C:</label> 
<input name="vitc" style="width:40px; display:inline-block;" value="0">
<span class="labelslast">%</span><br><hr>
<label for="vitb1" class="names">Vitamin B1:</label> 
<input name="vitb1" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">%</span>
<label for="vitb2" class="names">Vitamin B2:</label> 
<input name="vitb2" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">%</span>
<label for="vitb3" class="names">Vitamin B3:</label> 
<input name="vitb3" style="width:40px; display:inline-block;" value="0">
<span class="labelslast">%</span><br><hr>
<label for="vitb5" class="names">Vitamin B5:</label> 
<input name="vitb5" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">%</span>
<label for="vitb6" class="names">Vitamin B6:</label> 
<input name="vitb6" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">%</span>
<label for="vitb9" class="names">Vitamin B9:</label> 
<input name="vitb9" style="width:40px; display:inline-block;" value="0">
<span class="labelslast">%</span><br><hr>
<label for="choline" class="names">Choline:</label> 
<input name="choline" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">%</span>
<label for="vitb12" class="names">Vitamin B12:</label> 
<input name="vitb12" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">%</span>
<label for="vita" class="names">Vitamin A:</label> 
<input name="vita" style="width:40px; display:inline-block;" value="0">
<span class="labelslast">%</span><br><hr>
<label for="vite" class="names">Vitamin E:</label> 
<input name="vite" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">%</span>
<label for="vitd" class="names">Vitamin D:</label> 
<input name="vitd" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">%</span>
<label for="vitd2" class="names">Vitamin D2:</label> 
<input name="vitd2" style="width:40px; display:inline-block;" value="0">
<span class="labelslast">mcg</span><br><hr>
<label for="vitd3" class="names">Vitamin D3:</label> 
<input name="vitd3" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">mcg</span>
<label for="vitk" class="names">Vitamin K:</label> 
<input name="vitk" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">%</span>
<label for="betac" class="names">Beta Carotene:</label> 
<input name="betac" style="width:40px; display:inline-block;" value="0">
<span class="labelslast">mcg</span><br><hr>
<label for="alphac" class="names">Alpha Carotene:</label> 
<input name="alphac" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">mcg</span>
<label for="lycopene" class="names">Lycopene:</label> 
<input name="lycopene" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">mcg</span>
<label for="leutine" class="names">Leutine:</label> 
<input name="leutine" style="width:40px; display:inline-block;" value="0">
<span class="labelslast">mcg</span><br><hr>
<label for="phyto" class="names">Phytosterols:</label> 
<input name="phyto" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">mg</span>
<label for="caffeine" class="names">Caffeine:</label> 
<input name="caffeine" style="width:40px; display:inline-block; margin-right:2px;" value="0">
<span class="labels">mg</span>
<label for="alcohol" class="names">Alcohol:</label> 
<input name="alcohol" style="width:40px; display:inline-block;" value="0">
<span class="labelslast">grams</span><br><hr>
<div id="savebutton" style="margin-bottom:35px;">
<input type="button" id="backbutton" value="Back to Meal Tracker" title="Go back to Meal Tracker and abandon your changes" style="display:inline-block; width:150px; float:left; cursor:pointer;">
<input type="submit" id="saveitem" value="Save Item" title="Save this item to the nutritional database." style="display:inline-block; float:right;">
</div>
</form>

<script src="../js/jquery-1.9.0.min.js"></script>
<script src="../js/chosen.jquery.js"></script>
<script src="../js/jquery-ui-1.10.0.custom.min.js"></script>
<script> $(".chzn-select").chosen(); </script>

<script>

$(document).ready(function()
    {
	  $("#saveitem").attr('disabled','disabled');
	});
	
$("#mealname").keyup(function() 
{
  var n = $("#mealname").val().length;
  var m = $("#measure").val().length;
  if (n>0 && m>0)
    {
	$("#saveitem").removeAttr('disabled');
	}
  else
    {
	$("#saveitem").attr('disabled','disabled');
	}
});

$("#measure").keyup(function() 
{
  var n = $("#mealname").val().length;
  var m = $("#measure").val().length;
  if (n>0 && m>0)
    {
	$("#saveitem").removeAttr('disabled');
	}
  else
    {
	$("#saveitem").attr('disabled','disabled');
	}
});

$("#backbutton").click(function(){
   window.location.replace("mealtracker.php");
});

</script>  
 
  </div>
</div>

<?php include '../footer.php'; ?>
</body>
</html>
<?php
mysql_free_result($getFoodGroups);


?>
