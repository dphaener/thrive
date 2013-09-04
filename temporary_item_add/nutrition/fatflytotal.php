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
		<td colspan="2" class="dv"><strong>Amount Per Serving</strong></td>
	</tr>
	<tr>
	   <td><strong>Omega 3</strong><td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=851";
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
		<td class = "sub">ALA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=629";
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
		<td class="sub">EPA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=631";
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
		<td class="sub">DPA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr id="calories">
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=621";
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
		<td class="sub">DHA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
	   <td><strong>Omega 6</strong><td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=675";
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
		<td class="sub">LA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=685";
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
		<td class="sub">GLA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=853";
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
		<td class="sub">DGLA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr id="calories">
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=855";
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
		<td class="sub">AA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
	   <td><strong>Omega 9</strong><td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=674";
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
		<td class="sub">OA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=628";
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
		<td class="sub">GA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=676";
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
		<td class="sub">EA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr id="calories">
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=671";
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
		<td class="sub">NA</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr id="calories">
	<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=675";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $omega6+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=851";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $omega3+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
			  if ($omega3==0) {$ratio="0:0";} else {$ratio=number_format($omega6/$omega3,1).":1";}
		?>
		
		<td>Omega 6:Omega 3 Ratio</td><td class="dv"><strong><?php echo " ".$ratio?></strong></td>
	</tr>
	<tr>
	   <td><strong>Saturated Fats</strong><td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=611";
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
		<td class="sub">Lauric Acid</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=612";
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
		<td class="sub">Myristic Acid</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=613";
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
		<td class="sub">Palmitic Acid</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=614";
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
		<td class="sub">Stearic Acid</td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
	</tr>
</table>
