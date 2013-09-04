<?php

$hostname_nutritionfacts = "localhost";
$database_nutritionfacts = "dhaener_nutritionfacts";
$username_nutritionfacts = "dhaener_dhaener";
$password_nutritionfacts = "Marley!23";
$nutritionfacts = mysql_pconnect($hostname_nutritionfacts, $username_nutritionfacts, $password_nutritionfacts) or trigger_error(mysql_error(),E_USER_ERROR); 

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
$query_getFoodGroup = "SELECT * FROM FD_GROUP ORDER BY FdGrp_Desc";
$getFoodGroup = mysql_query($query_getFoodGroup, $nutritionfacts) or die(mysql_error());
$row_getFoodGroup = mysql_fetch_assoc($getFoodGroup);
$totalRows_getFoodGroup = mysql_num_rows($getFoodGroup);

$TempNutritionTable = "NutritionTotals".rand();

mysql_query("CREATE TABLE IF NOT EXISTS ".$TempNutritionTable." (
					NDB_No INT NOT NULL,
					Seq INT NOT NULL,
					Amount FLOAT NOT NULL,
					Calories INT NOT NULL,
					Fat INT NOT NULL,
					Carbs INT NOT NULL,
					Protein INT NOT NULL)", $nutritionfacts) or die(mysql_error());
?>



<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Thrive Nutrition and Fitness: Meal Stacker</title>
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
      <h3>Meal Stacker</h3>
    </div>
    <div class="greenglass" style="margin-top:10px; overflow:visible;">
        
         
          <select id="nutrientselect"  data-placeholder="Choose a food group..." name="nutrientselect" class="chzn-select" style="width:30%;">
            <option value=""></option>
			<?php
do {  ?>
   	  	<option value="<?php echo $row_getFoodGroup['FdGrp_Cd']?>"><?php echo $row_getFoodGroup['FdGrp_Desc']?></option>	
 <?php           
} while ($row_getFoodGroup = mysql_fetch_assoc($getFoodGroup));
  $rows = mysql_num_rows($getFoodGroup);
  if($rows > 0) {
      mysql_data_seek($getFoodGroup, 0);
	  $row_getFoodGroup = mysql_fetch_assoc($getFoodGroup);
  }
  
  
?>  	

  </select>
   
	 
	  
	  <select data-placeholder="Search for your food..." name="foodSelect" id="foodSelect" size="15" style="width:69%;" class="chzn-select">
	  <option>Select a food group first...</option>
	  </select>
	 
	 
	  
	 
	  
	<br> 
    <br> 
<div id="nutFacts" align="center">Select a food to see the nutrition facts...</div>
<div align="center">
<form>
 <input type="button" class="button" id="additem" value="Add Item" style="display:block; margin-top:10px;" align="middle">
 <input type="hidden" id="tablename" value="<?php echo $TempNutritionTable ?>" >
</form>
</div>
<br>
<div id="totNut" align="center" style="margin-bottom:5px:">Select foods and click 'Add Item' to begin totaling your meal...</div>
<form>
<input type="button" class="button" id="savemeal" value="Save Meal" title="Save this meal to the nutritional database." style="display:block; float:right; margin-top:-20px;">
</form>
<?php 

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getTotals = "SELECT * FROM ".$TempNutritionTable;
$getTotals = mysql_query($query_getTotals, $nutritionfacts) or die(mysql_error());
$row_getTotals = mysql_fetch_assoc($getTotals);
$totalRows_getTotals = mysql_num_rows($getTotals);

$getFirstRow = mysql_query("SELECT * FROM ".$TempNutritionTable." LIMIT 1");
$row_getFirstRow = mysql_fetch_assoc($getFirstRow);

switch ($totalRows_getTotals) {
	   case 0:
	   		break;
	   default:
	   		echo "<script> notify (".$row_getFirstRow['Seq'].", ".$row_getFirstRow['NDB_No'].", ".$row_getFirstRow['Amount'].") </script>";
 			break;
}			 
	   		
?>
    </div>
    <div id="savedialog" title="Save your meal" style="display:none; overflow:visible;">
	<?php
mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getFoodGroups = "SELECT * FROM FD_GROUP ORDER BY FdGrp_Desc";
$getFoodGroups = mysql_query($query_getFoodGroups, $nutritionfacts) or die(mysql_error());
$row_getFoodGroups = mysql_fetch_assoc($getFoodGroups);
$totalRows_getFoodGroups = mysql_num_rows($getFoodGroups); 
    
?> 
<label for="mealname" style="width:300px; display:inline-block;">Please enter a name for this meal:</label> 
<input id="mealname" style="width:350px; display:inline-block; border-color:black;"><br><br>
<label for="measure" style="width:300px; display:inline-block;">Please enter the measurement for this meal:</label> 
<input id="measure" title="Cup, ounce, bowl, meal, etc...." style="width:350px; border-color:black; display:inline-block;"><br><br>
<label for="foodgroup" style="width:300px; display:inline-block;">Select a food group:</label> 
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
    <script src="../js/jquery-1.9.0.min.js"></script>
     <script src="../js/chosen.jquery.js"></script>
	 <script src="../js/jquery-ui-1.10.0.custom.min.js"></script>
	 <script> $(".chzn-select").chosen(); </script>
	 <script src="../js/nutrition.js"></script>
	
   
  </div>
</div>
<div id="mealadd" style="display:inline; color:#FFF;"></div>
<?php include '../footer.php'; ?>
<div id="tableunloader"></div>
<div id="nutritionfacts" style="display:none;">Nutrition information goes here</div>
<div id="proteinfly" style="display:none;" title="Amino Acid Profile"></div>
<div id="fatfly" style="display:none;" title="Fatty Acid Profile"></div>
</body>
</html>
<?php
mysql_free_result($getFoodGroup);


?>
