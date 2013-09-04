<?php
include '../login/dbc.php';
session_start();
?>
<script>



</script>
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
$query_getMeals = "SELECT * FROM NutritionTotals WHERE User_Id=".$_SESSION['user_id']." AND DATE_FORMAT(Create_Date,GET_FORMAT(DATE,'USA'))=DATE_FORMAT(CURDATE(),GET_FORMAT(DATE,'USA'))";
$getMeals = mysql_query($query_getMeals, $nutritionfacts) or die(mysql_error());
$row_getMeals = mysql_fetch_assoc($getMeals);
$totalRows_getMeals = mysql_num_rows($getMeals);

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getFoodGroup = "SELECT * FROM food_groups ORDER BY FdGrp_Desc";
$getFoodGroup = mysql_query($query_getFoodGroup, $nutritionfacts) or die(mysql_error());
$row_getFoodGroup = mysql_fetch_assoc($getFoodGroup);
$totalRows_getFoodGroup = mysql_num_rows($getFoodGroup);

?>



<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Thrive Nutrition and Fitness: Meal Tracker</title>
<link href="../styles/thrivenutritionfitness.css" rel="stylesheet"
      type="text/css">
<link href="../styles/chosen.css" rel="stylesheet"
      type="text/css">
<link href="../styles/smoothness/jquery-ui-1.10.0.custom.css" rel="stylesheet"
      type="text/css">

</head>
<body>
<div id="container" style="overflow:visible;">
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
    <input type="hidden" id="userid" value="<?php echo $_SESSION['user_id']; ?>">
    <div class="weight_loss_header" style="text-align:center; margin-top:10px;">
      <h3>Meal Tracker</h3>
    </div>
    <div style="margin-top:10px;">
    <table border="1" class="greenglass" width="100%" style="color:#FFF; text-align:center;" cellspacing="0" cellpadding="1">
	  <tr style="border-bottom-width:medium;">
	    <th colspan="2" style="border-left:0; border-right:0; border-top:0; border-bottom-width:medium;">
			    <h2 style="font-size:32px;">Your nutritional information for: <input type="text" id="pickdate" value="<?php echo date('m/d/Y', time()); ?>" style="background:transparent; border:0; color:#FFF; font-size:28px;" size="9"></h2>
		</th>
	  </tr>
	  <tr>
	    <td style="border-left:0; border-right:0; border-top:0; border-bottom-width:medium;">
		  <form style="display:inline;">
		    <input type="button" class="button" title="Add a new food item to the database" value="New Item" id="newitem" style="padding:2px; margin-top:5px; margin-bottom:5px;">
		  </form>
		  <form style="display:inline;">
		    <input type="button" class="button" title="Stack a meal to add to the database" value="Meal Stacker" id="mealstacker" style="padding:2px; margin-top:5px; margin-bottom:5px;">
		  </form>
		</td>
	  </tr>
	  <tr>
	    <td style="text-align:left; color:#000; border-left:0; border-right:0; border-top:0; border-bottom-width:medium;">
		 <select id="nutrientselect"  data-placeholder="Choose a food group..." name="nutrientselect" class="chzn-select" style="width:300px;">
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
	    <select data-placeholder="Search for your food..." name="foodSelect" id="foodSelect" size="15" style="width:600px;" class="chzn-select">
	      <option>Select a food group first...</option>
	    </select> 
	    <br> 
        <br> 
        <div id="nutFacts" align="center" style="color:#FFF;">Select a food to see the nutrition facts...</div>
        <div align="center">
          <form>
            <input type="button" class="button" id="additem" value="Add Item" style="display:block; margin-top:10px;" align="middle">
          </form>
        </div>
      </td>
    </tr>
	  <tr>
	    <td style="border:0;">  
		<div id="nutinfoday">
		<h2>You do not have any data to display for this date</h2> 
		</div>
        </td>
      </tr>
	</table>            
    </div>
    
<div id="nutritionfacts" style="display:none;"></div>
<div id="nutritionfacts2" style="display:none;"></div>
<div id="proteinfly" style="display:none;" title="Amino Acid Profile"></div>
<div id="fatfly" style="display:none;" title="Fatty Acid Profile"></div>
<div id="proteinfly2" style="display:none;" title="Amino Acid Profile"></div>
<div id="fatfly2" style="display:none;" title="Fatty Acid Profile"></div>
<div id="tableunloader" style="display:none;"></div>
<div id="updatetable"></div>
    <script src="../js/jquery-1.9.0.min.js"></script>
     <script src="../js/chosen.jquery.js"></script>
	 <script> $(".chzn-select").chosen(); </script>
	 <script src="../js/jquery-ui-1.10.0.custom.min.js"></script>
	 <script src="../js/mealtracker.js"></script>
	 <script> 
	 $("#pickdate").attr("readonly", "true");
	 $(function() {
	 		   	  $( "#pickdate" ).datepicker({
				  showOn: 'button',
				  maxDate: 0,
   				  buttonImage: '../images/calendar_edit.png',
				  buttonText: 'Choose a date',
   				  buttonImageOnly: true,
   				  showAnim: 'slideDown',
   				  duration: 'fast'});
				  });
	var newdate=$("#pickdate").val();
	  var userid=$("#userid").val();
	  $.ajax({async:false, type: "POST",url:"daysnutrition.php?q="+newdate+"&r="+userid,success:function(result)
	    {
		$("#nutinfoday").html(result);
		},
		error: function (xhr,err) {
                alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
                alert("responseText: " + xhr.responseText);
            }
		});
	</script>
	<script>
	$("#nutritionfacts").dialog({
        autoOpen: false,
        show: "blind",
        hide: "clip",
		width: 810,
		modal: true,
		dialogClass: "noTitleStuff",
		buttons: [ { text: "Close", click: function() { $( this ).dialog( "close" ); } } ]
    });
			 
	
	$("#proteinfly").dialog({
        autoOpen: false,
        show: "blind",
        hide: "clip",
		width: "auto",
		modal: true,
		dialogClass: "noTitleStuff",
		resizable: false,
		buttons: [ { text: "Close", click: function() { $("#proteinfly").dialog( "close" ); } } ]
    });
  

  $("#fatfly").dialog({
        autoOpen: false,
        show: "blind",
        hide: "clip",
		width: "auto",
		modal: true,
		dialogClass: "noTitleStuff",
		resizable: false,
		buttons: [ { text: "Close", click: function() { $("#fatfly").dialog( "close" ); } } ]
    });
	
	$("#newitem").tooltip();
	$("#mealstacker").tooltip();  
 
	</script>
   
  </div>
</div>

<?php include '../footer.php'; ?>

</body>

</html>

