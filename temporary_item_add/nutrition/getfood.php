<script>

$("form").submit(function () { return false; });

$(".weightstuff").chosen().change(function(){	
  var WeightId; 
  WeightId = $(this).val();
  WeightId = eval(WeightId);
  notify(WeightId[0],WeightId[1],WeightId[2]);

});

$(".amountchange").on("spin",function(event, ui){
  var WeightId=$(this.form.weightnumber).val();
  var AmountId=ui.value;
  var NDBId=$(this.form.ndbno).val();
  notify(WeightId,NDBId,AmountId);
 
});

$(".amountchange").on("spinchange",function(event, ui){
  var WeightId=$(this.form.weightnumber).val();
  var AmountId=$(this.form.amountchange).spinner("value");
  var NDBId=$(this.form.ndbno).val();
  notify(WeightId,NDBId,AmountId);
 
});

$(".deletebutton2").click(function(){				
  var WeightId2=$(this.form.weightnumber2).val();
  var AmountId2=$(this.form.amountchange2).val();
  var NDBId2=$(this.form.ndbno2).val();
  $(".deletebutton").tooltip("close");
  deleteline(WeightId2,NDBId2,AmountId2);
 
});

$(".infobutton3").click(function(){		
  var WeightId3=$(this.form.weightnumber3).val();
  var AmountId3=$(this.form.amountchange3).val();
  var NDBId3=$(this.form.ndbno3).val();
  var foodid=$(this.form.foodname).val();
  $("#nutritionfacts").dialog("option","title",foodid);
  $.ajax(
			     {
				 
				 async:false, type: "POST",url:"../fullnut.php?q="+WeightId3+"&r="+AmountId3+"&s="+NDBId3,
				   success:function(result)
	                 {
 
		             $("#nutritionfacts").html(result);
					  
		             },
		           error: function (xhr,err) 
			         {
                     alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
                     alert("responseText: " + xhr.responseText);
                     }
		         });
	$("#nutritionfacts").dialog('open');
    } 
);

$(".infobutton4").click(function(){
  var tblname=$(this.form.tblname).val();		
  $("#nutritionfacts").dialog("option","title","Nutritional Totals");
  $.ajax(
			     {
				 
				 async:false, type: "POST",url:"../fullnuttotal.php?q="+tblname,
				   success:function(result)
	                 {
		             $("#nutritionfacts").html(result);
		             },
		           error: function (xhr,err) 
			         {
                     alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
                     alert("responseText: " + xhr.responseText);
                     }
		         });
  $("#nutritionfacts").dialog('open');
    } 
);

$( "#nutritionfacts" ).on( "dialogclose", function( event, ui ) {  $(".infobutton3").tooltip("close"); $(".infobutton4").tooltip("close");} );

</script>



<?php

$tablename=$_GET["p"];
$getcode=$_GET["q"];
$weightfactor=$_GET["r"];
$amount=$_GET["s"];
$updated=$_GET["t"];

require_once('../Connections/nutritionfacts.php');

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getProtein = "SELECT * FROM abbreviated WHERE abbreviated.NDB_No=".$getcode;
$getProtein = mysql_query($query_getProtein, $nutritionfacts) or die(mysql_error());
$row_getProtein = mysql_fetch_assoc($getProtein);
$totalRows_getProtein = mysql_num_rows($getProtein);

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getFood = "SELECT * FROM food_descriptions WHERE food_descriptions.NDB_No=".$getcode;
$getFood = mysql_query($query_getFood, $nutritionfacts) or die(mysql_error());
$row_getFood = mysql_fetch_assoc($getFood);
$totalRows_getFood = mysql_num_rows($getFood);

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getWeightFact = "SELECT Gm_Wgt FROM weights WHERE weights.NDB_No=".$getcode." AND weights.Seq=".$weightfactor;
$getWeightFact = mysql_query($query_getWeightFact, $nutritionfacts) or die(mysql_error());
$row_getWeightFact = mysql_fetch_assoc($getWeightFact);
$totalRows_getWeightFact = mysql_num_rows($getWeightFact);

$NutName=$row_getFood['Long_Desc'];

switch ($totalRows_getWeightFact) {
	   case 0:
	   		$AdjCalories=$row_getProtein['Energ_Kcal'];
			$Cals=$row_getProtein['Energ_Kcal'];
			$Fats=$row_getProtein['Lipid_Tot'];
			$Carbs=$row_getProtein['Carbohydrt'];
			$Protein=$row_getProtein['Protein'];
			break;
		default:
			$AdjCalories=$row_getProtein['Energ_Kcal']*($row_getWeightFact['Gm_Wgt']/100)*$amount;
			$Cals=$row_getProtein['Energ_Kcal']*($row_getWeightFact['Gm_Wgt']/100)*$amount;
			$Fats=$row_getProtein['Lipid_Tot']*($row_getWeightFact['Gm_Wgt']/100)*$amount;
			$Carbs=$row_getProtein['Carbohydrt']*($row_getWeightFact['Gm_Wgt']/100)*$amount;
			$Protein=$row_getProtein['Protein']*($row_getWeightFact['Gm_Wgt']/100)*$amount;
			break;
}

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getTotals = "SELECT * FROM ".$tablename;
$getTotals = mysql_query($query_getTotals, $nutritionfacts) or die(mysql_error());
$row_getTotals = mysql_fetch_assoc($getTotals);
$totalRows_getTotals = mysql_num_rows($getTotals);

switch ($totalRows_getTotals) {
	   case 0:
	   		if ($updated==2)
			  {
			  echo "Select foods and click 'Add Item' to begin totaling your meal..."; 
			  return;
			  }
			break; 
}

switch ($updated) {
	   case 0: mysql_query("INSERT INTO ".$tablename." (NDB_No, Seq, Amount, Calories, Fat, Carbs, Protein) VALUES ('".$getcode."','".$weightfactor."','".$amount."','".$AdjCalories."','".$Fats."','".$Carbs."','".$Protein."')") or die(mysql_error($nutritionfacts));
			   break;
	   case 1: mysql_query("UPDATE ".$tablename." SET Seq='".$weightfactor."', Amount='".$amount."', Calories='".$AdjCalories."', Fat='".$Fats."', Carbs='".$Carbs."', Protein='".$Protein."' WHERE NDB_No=".$getcode) or die(mysql_error($nutritionfacts));
	   		   break;
	   case 2:
	   		   mysql_query("DELETE FROM ".$tablename." WHERE NDB_No=".$getcode);
			   break;
}

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getTotals = "SELECT * FROM ".$tablename;
$getTotals = mysql_query($query_getTotals, $nutritionfacts) or die(mysql_error());
$row_getTotals = mysql_fetch_assoc($getTotals);
$totalRows_getTotals = mysql_num_rows($getTotals);

switch ($totalRows_getTotals) {
	   case 0:
	   		echo "<script> $('#savemeal').hide(); </script>";
			echo "Select foods and click 'Add Item' to begin totaling your meal..."; 
			return;
			break; 
}



?>

<table border="1" class="blueglass" width="100%" style="color:#FFF; text-align:center; margin-bottom:25px;" cellspacing="0">
  <tr style="font-size:18px; border-style:double;">
    <th style="border-left:0; border-right:0; border-top:0; border-bottom:4;">Food Name</th>
	<th style="border-left:0; border-right:0; border-top:0; border-bottom:4;">Amount</th>
    <th style="border-left:0; border-right:0; border-top:0; border-bottom:4;">Measure</th>
    <th style="border-left:0; border-right:0; border-top:0; border-bottom:4;">Calories</th>
    <th style="border-left:0; border-right:0; border-top:0; border-bottom:4;">Total Fat</th>
    <th style="border-left:0; border-right:0; border-top:0; border-bottom:4;">Carbs</th>
    <th style="border-left:0; border-right:0; border-top:0; border-bottom:4;">Protein</th>
  </tr>
  <?php
 $totalCals=0;
 $totalCarbs=0;
 $totalFat=0;
 $totalProtein=0; 
 $totalItems=0;

 do { 
 	$totalItems+=1;
	$weightPicker = "weightamount".$totalItems;
	 
	mysql_select_db($database_nutritionfacts, $nutritionfacts);
	$query_getWeights = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No'];
	$getWeights = mysql_query($query_getWeights, $nutritionfacts) or die(mysql_error());
	$row_getWeights = mysql_fetch_assoc($getWeights);
	$totalRows_getWeights = mysql_num_rows($getWeights);

	mysql_select_db($database_nutritionfacts, $nutritionfacts);
	$query_getFood = "SELECT * FROM food_descriptions WHERE food_descriptions.NDB_No=".$row_getTotals['NDB_No'];
	$getFood = mysql_query($query_getFood, $nutritionfacts) or die(mysql_error());
	$row_getFood = mysql_fetch_assoc($getFood);
	$totalRows_getFood = mysql_num_rows($getFood);
 	 
  ?>
    
    <tr>
  
  <td style="border-left:0; border-right:0"><?php echo $row_getFood['Long_Desc']; ?></td>
    <td style="border-left:0; border-right:0;">
	<form id="changed">
	<input value="<?php echo $row_getTotals['Amount'] ?>" id="amountchange" class="amountchange" style="width:30px; height:18px;">
	<input type="hidden" value="<?php echo $row_getTotals['Seq'] ?>" id="weightnumber" >
	<input type="hidden" value="<?php echo $row_getTotals['NDB_No'] ?>" id="ndbno">
	</form>
	</td>
	<td style="color:#000; text-align:left; padding-right:0px; border-left:0; border-right:0; border-color:#FFF;">
  
  
   <select class="weightstuff" name="weights" id="<?php echo $weightPicker ?>" title="<?php echo $row_getWeights['Msre_Desc']; ?>" style="width:200px; vertical-align:middle;">
  
  <?php
do {  
   $myarray="['".$row_getWeights['Seq']."', '".$row_getTotals['NDB_No']."', '".$row_getTotals['Amount']."']";

   switch ($row_getWeights['Seq']){
   		  case ($row_getWeights['Seq']=$row_getTotals['Seq']):
		  	   
	       ?>
		  	   <option value="<?php echo $myarray?>" selected ><?php echo round($row_getWeights['Amount'])." ".$row_getWeights['Msre_Desc']?></option>
			   <?php
			   break;
		  default:
		  ?>
		  	   <option value="<?php echo $myarray?>" ><?php echo round($row_getWeights['Amount'])." ".$row_getWeights['Msre_Desc']?></option>
			   <?php
			   break;
			   }
?>
  	 
  <?php    
       
} while ($row_getWeights = mysql_fetch_assoc($getWeights));
  $rows = mysql_num_rows($getWeights);
  if($rows > 0) {
      mysql_data_seek($getWeights, 0);
	  $row_getFoodGroup = mysql_fetch_assoc($getWeights);
  }
  
 ?></select>
    </td>
    <?php
	$AdjCalories=$row_getTotals['Calories'];
	$Fats=$row_getTotals['Fat'];
	$Carbs=$row_getTotals['Carbs'];
	$Protein=$row_getTotals['Protein'];
  ?>
    <td style="border-left:0; border-right:0">
  <?php echo round($AdjCalories); ?>
    </td>
  
    <td style="border-left:0; border-right:0">
  <?php echo round($Fats)." grams"; ?>
    </td>
  
    <td style="border-left:0; border-right:0">
  <?php echo round($Carbs)." grams"; ?>
    </td>
  
    <td style="border-left:0; border-right:0">
  <?php echo round($Protein)." grams"; ?>
    </td>
	<td style="border:0">
	<form id="changed2">
	<input type="hidden" value="<?php echo $row_getTotals['Amount'] ?>" id="amountchange2">
	<input type="hidden" value="<?php echo $row_getTotals['Seq'] ?>" id="weightnumber2" >
	<input type="hidden" value="<?php echo $row_getTotals['NDB_No'] ?>" id="ndbno2">
	<input id="deletebutton2" style="float:left;" type="image" src="../images/deletebutton.png" value="Submit" alt="Submit" class="deletebutton2" width="16" height="16" title="Click here to delete this item.">
	</form>
	
	</td>
    <td style="border:0">
	<form id="changed3">
	<input type="hidden" value="<?php echo $row_getTotals['Amount'] ?>" id="amountchange3">
	<input type="hidden" value="<?php echo $row_getTotals['Seq'] ?>" id="weightnumber3" >
	<input type="hidden" value="<?php echo $row_getTotals['NDB_No'] ?>" id="ndbno3">
	<input type="hidden" value="<?php echo $row_getFood['Long_Desc']; ?>" id="foodname">
	<input id="infobutton3" style="float:left;" type="image" src="../images/info-icon.png" value="Submit" alt="Submit" class="infobutton3" width="16" height="16" title="Click here to view the full nutritional information for this item.">
	</form>
	
	</td>
    </tr>
  
  <?php   
  
	$totalCals += $AdjCalories;
	$totalFat += $Fats;
	$totalCarbs += $Carbs;
	$totalProtein += $Protein; 
	         
} while ($row_getTotals = mysql_fetch_assoc($getTotals));
  $rows = mysql_num_rows($getTotals);
  if($rows > 0) {
      mysql_data_seek($getTotals, 0);
	  $row_getTotals = mysql_fetch_assoc($getTotals);
  }
  ?>
    <input type="hidden" id="numRows" value="<?php echo $totalItems ?>" />
    <tr>
  
    <td style="border:0;">
	</td>
	<td style="border:0;">
	</td>
	  
    <td style="border:0; font-size:18px; text-align:right;">
    <b>Totals:</b>
    </td>
  
    <td style="border-left:0; border-right:0">
  <b><?php echo round($totalCals); ?></b>
    </td>
  
    <td style="border-left:0; border-right:0">
  <b><?php echo round($totalFat)." grams"; ?></b>
    </td>
  
    <td style="border-left:0; border-right:0">
  <b><?php echo round($totalCarbs)." grams"; ?></b>
    </td>
  
    <td style="border-left:0; border-right:0">
  <b><?php echo round($totalProtein)." grams"; ?></b>
    </td>
   <td style="border:0">
	<form id="changed4">
	<input type="hidden" value="<?php echo $tablename ?>" id="tblname">
	<input id="totalinfo2" style="float:left;" type="image" src="../images/info-icon.png" value="Submit" alt="Submit" class="infobutton4" width="16" height="16" title="Click here to view the total nutritional value for all items.">
	</form>
	
	</td>
    </tr>
  <tr>
  
    <td style="border:0;">
    </td>
	<td style="border:0;">
	</td>
	  
    <td style="border:0;">
    </td>
  
    <td style="border:0; font-size:18px; text-align:right;">
	% of calories:
      </td>
  
    <td style="border-left:0; border-right:0">
  <b><?php if ($totalFat+$totalCarbs+$totalProtein==0){echo "0"; } else { echo round(($totalFat/($totalFat+$totalCarbs+$totalProtein))*100)."%";} ?></b>
    </td>
  
    <td style="border-left:0; border-right:0">
  <b><?php if ($totalFat+$totalCarbs+$totalProtein==0){echo "0"; } else {echo round(($totalCarbs/($totalFat+$totalCarbs+$totalProtein))*100)."%";} ?></b>
    </td>
  
    <td style="border-left:0; border-right:0">
  <b><?php if ($totalFat+$totalCarbs+$totalProtein==0){echo "0"; } else {echo round(($totalProtein/($totalFat+$totalCarbs+$totalProtein))*100)."%"; }?></b>
    </td>
  
    </tr>
</table>

<script> 

$(".amountchange").spinner({min:0}, {step:.1}, {page:10}, {numberFormat:"n"}); 
$(".weightstuff").chosen();

$("#totalinfo2").tooltip();
$(".infobutton3").tooltip();
$(".deletebutton2").tooltip();
 $("#nutritionfacts").dialog({
        autoOpen: false,
        show: "blind",
        hide: "clip",
		width: 810,
		modal: true,
		dialogClass: "noTitleStuff2",
		buttons: [ { text: "Close", click: function() { $( this ).dialog( "close" ); } } ]
    });
</script>

