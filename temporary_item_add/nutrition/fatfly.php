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
		    
<table class="nutrition" cellpadding="0" cellspacing="0">
	
	<tr id="servings">
		<td colspan="2" class="dv"><strong>Amount Per Serving</strong></td>
	</tr>
	<tr>
	   <td><strong>Omega 3</strong><td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=851";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
			  $nutweight=number_format($nutweight);
		?>
		<td class = "sub">ALA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=629";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
			  $nutweight=number_format($nutweight);
		?>
		<td class="sub">EPA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=631";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
			  $nutweight=number_format($nutweight);
		?>
		<td class="sub">DPA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr id="calories">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=621";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
			  $nutweight=number_format($nutweight);
		?>
		<td class="sub">DHA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
	   <td><strong>Omega 6</strong><td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=675";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
			  $nutweight=number_format($nutweight);
		?>
		<td class="sub">LA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=685";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
			  $nutweight=number_format($nutweight);
		?>
		<td class="sub">GLA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=853";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
			  $nutweight=number_format($nutweight);
		?>
		<td class="sub">DGLA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr id="calories">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=855";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
			  $nutweight=number_format($nutweight);
		?>
		<td class="sub">AA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
	   <td><strong>Omega 9</strong><td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=674";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
			  $nutweight=number_format($nutweight);
		?>
		<td class="sub">OA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=628";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
			  $nutweight=number_format($nutweight);
		?>
		<td class="sub">GA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=676";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
			  $nutweight=number_format($nutweight);
		?>
		<td class="sub">EA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr id="calories">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=671";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
			  $nutweight=number_format($nutweight);
		?>
		<td class="sub">NA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr id="calories">
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=675";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  $omega6=$row_getNut['Nutr_Val'];
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=851";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  $omega3=$row_getNut['Nutr_Val'];
			  if ($omega3==0) {$ratio="0:0";} else {$ratio=number_format($omega6/$omega3,1).":1";}
		?>
		<td>Omega 6:Omega 3 Ratio</td><td class="dv"><strong><?php echo " ".$ratio?></strong></td>
	</tr>
	<tr>
	   <td><strong>Saturated Fats</strong><td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=611";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
			  $nutweight=number_format($nutweight);
		?>
		<td class="sub">Lauric Acid</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=612";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
			  $nutweight=number_format($nutweight);
		?>
		<td class="sub">Myristic Acid</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=613";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
			  $nutweight=number_format($nutweight);
		?>
		<td class="sub">Palmitic Acid</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=614";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
			  $nutweight=number_format($nutweight);
		?>
		<td class="sub">Stearic Acid</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
</table>
