<script>

$("form").submit(function () { return false; });

$(".expandprotein").click(function(){				
  var userid=$(this.form.userid2).val();
  var newdate=$(this.form.newdate2).val();
  $.ajax(
			     {
				 
				 async:false, type: "POST",url:"proflytotal.php?q="+userid+"&r="+newdate,
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
  var userid=$(this.form.userid).val();
  var newdate=$(this.form.newdate).val();
  $.ajax(
			     {
				 
				 async:false, type: "POST",url:"fatflytotal.php?q="+userid+"&r="+newdate,
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
$newdate=$_GET["q"];
$userid=$_GET["r"];

require_once('../Connections/nutritionfacts.php');

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getDesc = "SELECT * FROM nutrients_definitions";
$getDesc = mysql_query($query_getDesc, $nutritionfacts) or die(mysql_error());
$row_getDesc = mysql_fetch_assoc($getDesc);
$totalRows_getDesc = mysql_num_rows($getDesc);

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getTotals = "SELECT * FROM NutritionTotals WHERE User_Id=".$userid." AND UNIX_TIMESTAMP(Create_Date)=".$newdate;
$getTotals = mysql_query($query_getTotals, $nutritionfacts) or die(mysql_error());
$row_getTotals = mysql_fetch_assoc($getTotals);
$totalRows_getTotals = mysql_num_rows($getTotals);

$gramweight=0;

do {  
   	  	mysql_select_db($database_nutritionfacts, $nutritionfacts);
		$query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
		$getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
		$row_getWeight = mysql_fetch_assoc($getWeight);
		$totalRows_getWeight = mysql_num_rows($getWeight);
		
		$gramweight+=round($row_getWeight['Gm_Wgt']*$row_getTotals['Amount']);
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
$gramweight = round($gramweight);
?>
		    
<table class="nutrition" cellpadding="0" cellspacing="0" style="padding:0; margin:0;">
<tr style="margin:0; padding:0;">
	<th colspan="2">Nutrition Facts</th>
	</tr>
	<tr id="servings">
		<td colspan="2"><?php echo "Total Serving Size ".$gramweight." grams" ?></td>
	</tr>
	<tr id="calories">
		<?php do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=208";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
		?>
		<td><strong>Calories</strong><?php echo " ".number_format($nutweight)?> </td>
		<?php 
			  $fatweight=0;
			  
			  do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=204";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $fatweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
		
			  $calfat=$fatweight*9;
			  if ($calfat>$nutweight) {$calfat=$nutweight;}
			  $percalfat=number_format($calfat/$nutweight*100);
		?>
		<td style="text-align:right; ">Calories from Fat</b><?php echo " ".number_format($calfat)." (".$percalfat."%)"?></td>
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
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=204";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=204";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td><strong>Total Fat</strong>
		<form id="changed6" style="display:inline;">
		<input type="image" class="expandfat" src="../images/arrowdown.png" id="fatchange">
		<input type="hidden" value="<?php echo $newdate ?>" id="newdate">
		<input type="hidden" value="<?php echo $userid ?>" id="userid">
		</form>
		</td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>g</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=606";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=606";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
		?>
		<td class="sub">Saturated Fat</td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>g</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php 
		$nutweight=0;
		do {  
   	  		  			  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=645";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
		?>
		<td class="sub">Monounsaturated Fat</td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>g</strong></td>
		<td class="dv"></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php 
		$nutweight=0;
		do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=646";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
		?>
		<td class="sub">Polyunsaturated Fat</td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>g</strong></td>
		<td class="dv"></td>
	</tr>

	<tr style="border-right:4px solid black;">
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=605";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
		?>
		<td class="sub">Trans Fat</td><td class="dv"><strong><?php echo " ".number_format($nutweight)?>g</strong></td>
		<td></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=601";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=601";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Cholesterol</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>g</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=307";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=307";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Sodium</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=306";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=306";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Potassium</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=205";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=205";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Total Carbohydrate</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>g</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=291";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=291";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
			  $nutweight=number_format($nutweight);
		?>
		<td class="sub">Dietary Fiber</td><td class="dv"><strong><?php echo " ".$nutweight?>g</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=269";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td class="sub">Sugars</td><td class="dv"><strong><?php echo " ".$nutweight?>g</strong></td>
		<td></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=203";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=203";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Protein</strong>
		<form id="changed5" style="display:inline;">
		<input type="image" class="expandprotein" src="../images/arrowdown.png" id="protchange">
		<input type="hidden" value="<?php echo $newdate ?>" id="newdate2">
		<input type="hidden" value="<?php echo $userid ?>" id="userid2">
		</form></td>
		<td class="dv"><strong><?php echo " ".$nutweight?>g</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr id="minerals"  style="border-right:4px solid black;">
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=301";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=301";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Calcium</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=303";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=303";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Iron</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=304";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=304";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
           	  $rda=round($nutweight/$row_getRDA['RDA']*100);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Magnesium</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=305";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=305";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
          	  $rda=round($nutweight/$row_getRDA['RDA']*100);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Phosphorus</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>

	<tr style="border-right:4px solid black;">
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=309";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=309";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
          	  $rda=round($nutweight/$row_getRDA['RDA']*100);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Zinc</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=312";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=291";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
          	  $rda=round($nutweight/$row_getRDA['RDA']*100);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Copper</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=315";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=315";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Manganese</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=317";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=317";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Selenium</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black;">
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=313";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=313";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Fluoride</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr style="border-right:4px solid black; border-bottom:0;">
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=255";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
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
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=401";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=401";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Vitamin C</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=404";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=404";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']/10);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Thiamin (B1)</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=405";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=405";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']/10);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Riboflavin (B2)</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=406";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=406";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']/10);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Niacin (B3)</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=410";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=410";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']/10);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Pantothenic Acid (B5)</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=415";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=415";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount']*1000;
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']/10);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Vitamin B6</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=417";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=417";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Folate (B9)</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=421";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=421";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Choline</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=418";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=418";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Vitamin B12</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=318";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=318";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Vitamin A</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>IU</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=323";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=323";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Vitamin E</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=324";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=324";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Vitamin D</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>IU</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=325";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td class="sub">Vitamin D2</td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
		<td></td>
	</tr><tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=326";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td class="sub">Vitamin D3</td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
		<td></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=430";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $query_getRDA = "SELECT RDA FROM nutrients_definitions WHERE nutrients_definitions.Nutr_No=430";
			  $getRDA = mysql_query($query_getRDA, $nutritionfacts) or die(mysql_error());
			  $row_getRDA = mysql_fetch_assoc($getRDA); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $rda=round($nutweight/$row_getRDA['RDA']*100);
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Vitamin K</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
		<td class="dv"><?php echo $rda."%"?></td>
	</tr>
	<tr id="minerals">
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=321";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Beta Carotene</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
		<td></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=322";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Alpha Carotene</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
		<td></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=337";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Lycopene</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
		<td></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=338";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Leutine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mcg</strong></td>
		<td></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=636";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Phytosterols</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
		<td></td>
	</tr>
	<tr>
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=262";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
		?>
		<td><strong>Caffeine</strong></td><td class="dv"><strong><?php echo " ".$nutweight?>mg</strong></td>
		<td></td>
	</tr>
	<tr style="border-bottom:2px;">
		<?php 
		$nutweight=0;
		do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=221";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $nutweight+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  $nutweight=number_format($nutweight);
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
  $("#proteinfly").dialog("option","position",{ my: "left top", at: "right top", of: $("#changed5") });

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
  $("#fatfly").dialog("option","position",{ my: "left top", at: "right top", of: $("#changed6") });

</script>
