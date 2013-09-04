<?php
$userid=$_GET["q"];
$newdate=$_GET["r"];

require_once('../Connections/nutritionfacts.php');

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getTotals = "SELECT * FROM NutritionTotals WHERE User_Id=".$userid." AND UNIX_TIMESTAMP(Create_Date)=".$newdate;
$getTotals = mysql_query($query_getTotals, $nutritionfacts) or die(mysql_error());
$row_getTotals = mysql_fetch_assoc($getTotals);
$totalRows_getTotals = mysql_num_rows($getTotals);
?>
		    
<table class="nutrition" cellpadding="0" cellspacing="0">
	
	<tr id="servings">
		<td class="dv" colspan="2"><strong>Amount Per Serving</strong></td>
	</tr>
	<tr>
		<td colspan="2"><strong>BCAA's</strong></td>
	<tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=503";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $totbcaa+=$nutweight;
		?>
		<td class="sub">Isoleucine</td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=504";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $totbcaa+=$nutweight;
		?>
		<td class="sub">Leucine</td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=510";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $totbcaa+=$nutweight;
		?>
		<td class="sub">Valine</td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>mg</strong></td>
	</tr>
	<tr id="calories">
		<td><strong>Total BCAA's</strong></td><td class="dv"><strong><?php echo " ".number_format($totbcaa)?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=501";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Tryptophan</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=502";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Threonine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=505";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Lysine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=506";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Methionine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=507";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Cystine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=508";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Phenylalanine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=509";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Tyrosine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=511";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Arginine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=512";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Histidine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=513";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Alanine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=514";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Aspartic Acid</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=515";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Glutamic Acid</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=516";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Glycine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=517";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Proline</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=518";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Serine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=521";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Hydroxyproline</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
</table>
