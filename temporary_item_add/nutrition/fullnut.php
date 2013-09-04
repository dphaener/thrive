<script>

$("form").submit(function () { return false; });

$(".expandprotein").click(function(){				
  var WeightId5=$(this.form.weightnumber5).val();
  var AmountId5=$(this.form.amountchange5).val();
  var NDBId5=$(this.form.ndbno5).val();
  $.ajax(
			     {
				 
				 async:false, type: "POST",url:"profly.php?q="+WeightId5+"&r="+AmountId5+"&s="+NDBId5,
				   success:function(result)
	                 {
		             $("#proteinfly").html(result);
		             },
		           error: function (xhr,err) 
			         {
                     alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
                     alert("responseText: " + xhr.responseText);
                     }
		         });
  $("#proteinfly").dialog('open');
 
    } 
);

$(".expandfat").click(function(){				
  var WeightId6=$(this.form.weightnumber6).val();
  var AmountId6=$(this.form.amountchange6).val();
  var NDBId6=$(this.form.ndbno6).val();
  $.ajax(
			     {
				 
				 async:false, type: "POST",url:"fatfly.php?q="+WeightId6+"&r="+AmountId6+"&s="+NDBId6,
				   success:function(result)
	                 {
		             $("#fatfly").html(result);
		             },
		           error: function (xhr,err) 
			         {
                     alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
                     alert("responseText: " + xhr.responseText);
                     }
		         });
  $("#fatfly").dialog('open');
 
    } 
);

</script>

<?php
$weightid=$_GET["q"];
$amountid=$_GET["r"];
$ndbid=$_GET["s"];

require_once('../Connections/nutritionfacts.php');

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getName = "SELECT Long_Desc FROM food_descriptions WHERE food_descriptions.Ndb_No=".$ndbid;
$getName = mysql_query($query_getName, $nutritionfacts) or die(mysql_error());
$row_getName = mysql_fetch_assoc($getName);
$totalRows_getName = mysql_num_rows($getName);

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getDesc = "SELECT * FROM nutrients_definitions";
$getDesc = mysql_query($query_getDesc, $nutritionfacts) or die(mysql_error());
$row_getDesc = mysql_fetch_assoc($getDesc);
$totalRows_getDesc = mysql_num_rows($getDesc);

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$ndbid." AND weights.Seq=".$weightid;
$getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
$row_getWeight = mysql_fetch_assoc($getWeight);
$totalRows_getWeight = mysql_num_rows($getWeight);

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=".$row_getDesc['Nutr_No'];
$getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
$row_getNut = mysql_fetch_assoc($getNut);
$totalRows_getNut = mysql_num_rows($getNut);
$nutweight=round(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid);
$query_getUnit = "SELECT Units FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=".$row_getDesc['Nutr_No'];
$getUnit = mysql_query($query_getUnit, $nutritionfacts) or die(mysql_error());
$row_getUnit = mysql_fetch_assoc($getUnit);

$servingamount = ($row_getWeight['Amount']*$amountid)." ".$row_getWeight['Msre_Desc'];
$gramweight = round($row_getWeight['Gm_Wgt']*$amountid);
?>
		    
<table class="nutrition" cellpadding="0" cellspacing="0" style="padding:0; margin:0;">
<tr style="margin:0; padding:0;">
	<th colspan="2">Nutrition Facts</th>
	</tr>
	<tr id="servings">
		<td colspan="2"><?php echo "Serving Size ".$servingamount." (".$gramweight."g)" ?></td>
	</tr>
	<tr id="calories">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=208";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
		?>
		<td><strong>Calories</strong><?php echo " ".number_format($nutweight)?> </td>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=204";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $calfat=(round(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*9));
			  $percalfat=round($calfat/$nutweight*100);
		?>
		<td style="text-align:right; ">Calories from Fat</b><?php echo " ".$calfat." (".$percalfat."%)"?></td>
</tr>
<tr  style="margin:0; padding:0;">
<td  style="margin:0; padding:0; border-left:0;">
<table class="nutrition" style="margin:0; padding:0; border:0;" cellpadding="0" cellspacing="0">
	
	<tr style="border-right:4px solid black; border-left:0;">
		<td style="border-left:0;"></td>
		<td class="dv"><strong>Amount Per Serving</strong></td>
		<td class="dv" style="border-left:0;"><strong>% Daily Value *</strong></td>
	</tr>
	<tr style="border-right:4px solid black; border-left:0;">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=204";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=204";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Total Fat</strong>
		<form id="changed6" style="display:inline;">
		<input type="image" class="expandfat" src="../images/arrowdown.png" id="fatchange">
		<input type="hidden" value="<?php echo $amountid ?>" id="amountchange6">
		<input type="hidden" value="<?php echo $weightid ?>" id="weightnumber6" >
		<input type="hidden" value="<?php echo $ndbid ?>" id="ndbno6">
		</form>
		</td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>g</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=606";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=606";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td class="sub">Saturated Fat</td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>g</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=645";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid);
		?>
		<td class="sub">Monounsaturated Fat</td><td class="dv"><strong><?php echo " ".$nutweight?>g</strong></td>
		<td class="dv"></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=646";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid);
		?>
		<td class="sub">Polyunsaturated Fat</td><td class="dv"><strong><?php echo " ".$nutweight?>g</strong></td>
		<td class="dv"></td>
	</tr>

	<tr style="border-right:4px solid black;">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=605";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid);
		?>
		<td class="sub">Trans Fat</td><td class="dv"><strong><?php echo " ".$nutweight?>g</strong></td>
		<td></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=601";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=601";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Cholesterol</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>g</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=307";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=307";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Sodium</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=306";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=306";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Potassium</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=205";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=205";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Total Carbohydrate</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>g</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=291";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=291";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td class="sub">Dietary Fiber</td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>g</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=269";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid);
		?>
		<td class="sub">Sugars</td><td class="dv"><strong><?php echo " ".$nutweight?>g</strong></td>
		<td></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=203";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=203";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Protein</strong>
		<form id="changed5" style="display:inline;">
		<input type="image" class="expandprotein" src="../images/arrowdown.png" id="protchange">
		<input type="hidden" value="<?php echo $amountid ?>" id="amountchange5">
		<input type="hidden" value="<?php echo $weightid ?>" id="weightnumber5" >
		<input type="hidden" value="<?php echo $ndbid ?>" id="ndbno5">
		</form></td>
		<td class="dv"><strong><?php echo " ".number_format($nutweight)?>g</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr id="minerals"  style="border-right:4px solid black;">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=301";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=301";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Calcium</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=303";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=303";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Iron</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=304";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=304";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Magnesium</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=305";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=305";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Phosphorus</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>

	<tr style="border-right:4px solid black;">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=309";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=309";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Zinc</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=312";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=312";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Copper</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=315";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=315";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Manganese</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=317";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=317";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Selenium</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mcg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=313";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=313";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Fluoride</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mcg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black; border-bottom:0;">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=255";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid);
		?>
		<td><strong>Water</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>g</td>
		<td></td>
	</tr>
</table>
</td>
<td  style="margin:0; padding:0; border-left:0;">
<table class="nutrition" style="margin:0; padding:0; border:0;" cellpadding="0" cellspacing="0">
	
	<tr style="border-left:0;">
		<td style="border-left:0;"></td>
		<td class="dv"><strong>Amount Per Serving</strong></td>
		<td class="dv" style="border-left:0;"><strong>% Daily Value *</strong></td>
	</tr>

	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=401";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=401";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Vitamin C</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=404";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=404";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000;
			  $rda=round($nutweight/$row_getRDA['RDA']/10);
		?>
		<td><strong>Thiamin (B1)</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mcg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=405";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=405";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000;
			  $rda=round($nutweight/$row_getRDA['RDA']/10);
		?>
		<td><strong>Riboflavin (B2)</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mcg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=406";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=406";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000;
			  $rda=round($nutweight/$row_getRDA['RDA']/10);
		?>
		<td><strong>Niacin (B3)</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mcg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=410";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=410";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000;
			  $rda=round($nutweight/$row_getRDA['RDA']/10);
		?>
		<td><strong>Pantothenic Acid (B5)</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mcg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=415";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=415";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000;
			  $rda=round($nutweight/$row_getRDA['RDA']/10);
		?>
		<td><strong>Vitamin B6</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mcg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=417";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=417";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Folate (B9)</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mcg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=421";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=421";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Choline</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=418";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=418";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Vitamin B12</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mcg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=318";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=318";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Vitamin A</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>IU</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=323";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=323";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Vitamin E</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=324";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=324";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Vitamin D</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>IU</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=325";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid);
		?>
		<td class="sub">Vitamin D2</td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
		<td></td>
	</tr><tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=326";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid);
		?>
		<td class="sub">Vitamin D3</td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
		<td></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=430";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=430";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid;
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Vitamin K</strong></td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mcg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr id="minerals">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=321";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid);
		?>
		<td><strong>Beta Carotene</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
		<td></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=322";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid);
		?>
		<td><strong>Alpha Carotene</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
		<td></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=337";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid);
		?>
		<td><strong>Lycopene</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
		<td></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=338";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid);
		?>
		<td><strong>Leutine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
		<td></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=636";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid);
		?>
		<td><strong>Phytosterols</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
		<td></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=262";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid);
		?>
		<td><strong>Caffeine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
		<td></td>
	</tr>
	<tr style="border-bottom:2px;">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=221";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid);
		?>
		<td><strong>Alcohol</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>g</strong></td>
		<td></td>
	</tr>
</table>
</td>
</tr>
<tr>
		<td id="disclaimer" colspan="2">
			* The Percent Daily Values are based on a 2,000 calorie diet, so your values may change depending on your calorie needs.
			The values here may not be 100% accurate because the recipes have not been professionally evaluated nor have they been evaluated by the U.S. FDA.	
		</td>
	</tr>
</table>
<p style="font-style:italic; font-weight:bold; font-size:large;">Click on the arrows to get more detailed information for fats and proteins.</p>

<script>
$("#proteinfly").dialog("option","position",{ my: "left top", at: "right top", of: $("#changed5") });
$("#fatfly").dialog("option","position",{ my: "left top", at: "right top", of: $("#changed6") });
</script>