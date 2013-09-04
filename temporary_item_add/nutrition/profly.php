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
		<td class="dv" colspan="2"><strong>Amount Per Serving</strong></td>
	</tr>
	<tr>
		<td colspan="2"><strong>BCAA's</strong></td>
	<tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=503";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000;
			  $totbcaa+=$nutweight;
		?>
		<td class="sub">Isoleucine</td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=504";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000;
			  $totbcaa+=$nutweight;
		?>
		<td class="sub">Leucine</td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=510";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000;
			  $totbcaa+=$nutweight;
		?>
		<td class="sub">Valine</td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mg</strong></td>
	</tr>
	<tr id="calories">
		<td><strong>Total BCAA's</strong></td><td class="dv"><strong><?php echo " ".number_format($totbcaa)?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=501";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
		?>
		<td><strong>Tryptophan</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=502";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
		?>
		<td><strong>Threonine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=505";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
		?>
		<td><strong>Lysine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=506";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
		?>
		<td><strong>Methionine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=507";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
		?>
		<td><strong>Cystine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=508";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
		?>
		<td><strong>Phenylalanine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=509";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
		?>
		<td><strong>Tyrosine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=511";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
		?>
		<td><strong>Arginine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=512";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
		?>
		<td><strong>Histidine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=513";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
		?>
		<td><strong>Alanine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=514";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
		?>
		<td><strong>Aspartic Acid</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=515";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
		?>
		<td><strong>Glutamic Acid</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=516";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
		?>
		<td><strong>Glycine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=517";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
		?>
		<td><strong>Proline</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=518";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
		?>
		<td><strong>Serine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$ndbid." AND nutrients.Nutr_No=521";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut); 
			  $nutweight=number_format(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$amountid*1000);
		?>
		<td><strong>Hydroxyproline</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
</table>
