<script>

$( document ).ready(function()
    {
	$("#nutrientselect").chosen().change(function()
	  {
	  var str=$("#nutrientselect").val();
	  $.ajax({type: "POST",url:"getfoods.php?q="+str,success:function(result)
	    {
		$("#foodSelect").html(result);
		$("#foodSelect").trigger("liszt:updated");
		},
		error: function (xhr,err) {
                alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
                alert("responseText: " + xhr.responseText);
            }
		});
		
	  });
	 
    });
	
	$( document ).ready(function()
    {
	$("#foodSelect").change(function()
	  {
	  $("#additem").show();
	  $("#totNut").show();
	  var str=$("#foodSelect").val();
	  $.ajax({type: "POST",url:"getnutrition.php?q="+str,success:function(result)
	    {
		$("#nutFacts").html(result);
		},
		error: function (xhr,err) {
                alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
                alert("responseText: " + xhr.responseText);
            }
		});
		
	  });
    });
	
	$( document ).ready(function()
    {
	$("#additem").click(function()
	  {
	  var str=$("#foodSelect").val();
	  var tablename=$("#tablename").val();
	  $.ajax({type: "POST",url:"getfood.php?q="+str+"&r=1&t=0&s=1&p="+tablename,success:function(result)
	    {
		$("#totNut").html(result);
		},
		error: function (xhr,err) {
                alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
                alert("responseText: " + xhr.responseText);
            }
		});
	  });
    });

</script>

<?php require_once('../Connections/nutritionfacts.php'); ?>
<?php
mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getFoodGroup = "SELECT * FROM food_groups ORDER BY FdGrp_Desc";
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


     <div class="greenglass" style="margin-top:10px; min-height:500px; height:auto !important; height:500px; ">
      
           
         
          <select id="nutrientselect"  data-placeholder="Choose a food group..." name="nutrientselect" class="chzn-select" style="width:300px;">
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
	  <select data-placeholder="Search for your food..." name="foodSelect" id="foodSelect" size="15" style="width:620px;" class="chzn-select">
	  <option>Select a food group first...</option>
	  </select>
	  <script> $(".chzn-select").chosen(); </script>  
	<br> 
    <br> 
<div id="nutFacts" align="center">Select a food to see the nutrition facts...</div>
<div align="center">
<form>
 <input type="button" class="button" id="additem" value="Add Item" style="display:block; margin-top:10px;" align="middle">
 <input type="hidden" id="tablename" value="<?php echo $TempNutritionTable; ?>">
</form>
</div>
<br>
<div id="totNut" align="center">Select foods and click 'Add Item' to begin totaling your meal...</div>

    </div>

<div id="nutritionfacts" style="display:none;">Nutrition information goes here</div>
<div id="proteinfly" style="display:none;" title="Amino Acid Profile"></div>
<div id="fatfly" style="display:none;" title="Fatty Acid Profile"></div>


