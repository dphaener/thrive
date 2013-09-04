<?php

$mealname=$_GET['q'];
$foodgroup=$_GET['r'];
$tablename=$_GET['s'];
$measure=$_GET['t'];

$hostname_nutritionfacts = "localhost";
$database_nutritionfacts = "dhaener_nutritionfacts";
$username_nutritionfacts = "dhaener_dhaener";
$password_nutritionfacts = "Marley!23";
$nutritionfacts = mysql_pconnect($hostname_nutritionfacts, $username_nutritionfacts, $password_nutritionfacts) or trigger_error(mysql_error(),E_USER_ERROR); 


mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getTotals = "SELECT * FROM ".$tablename;
$getTotals = mysql_query($query_getTotals, $nutritionfacts) or die(mysql_error());
$row_getTotals = mysql_fetch_assoc($getTotals);
$totalRows_getTotals = mysql_num_rows($getTotals);

do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=208";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $calories+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }

do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=204";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $totalfat+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=606";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $satfat+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	  			  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }

do {  
   	  		  			  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=645";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $monofat+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=646";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $polyfat+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=605";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $transfat+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=601";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $choles+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	 
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=307";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $sodium+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=306";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $potassium+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			 
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=205";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $carbs+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	 
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=291";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $fiber+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	 
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=269";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $sugar+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=203";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $protein+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	 
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=301";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $calcium+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=303";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $iron+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	 
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=304";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $magnesium+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=305";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $phosphorus+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	 
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=309";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $zinc+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	 
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=312";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $copper+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=315";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $mang+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=317";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $selenium+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=313";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $fluoride+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	 
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=255";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $water+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=401";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $vitc+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=404";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $vitb1+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=405";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $vitb2+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	 
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=406";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $vitb3+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	 
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=410";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $vitb5+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=415";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $vitb6+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	 
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=417";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $vitb9+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	 
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=421";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $choline+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=418";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $vitb12+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=318";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $vita+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=323";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $vite+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	 
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			 
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=324";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $vitd+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	  
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=325";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $vitd2+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=326";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $vitd3+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=430";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $vitk+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          	 
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=321";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $betac+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=322";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $alphac+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=337";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $lycopene+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=338";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $leutine+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=636";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $phyto+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=262";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $caffeine+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=221";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $alcohol+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
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
			  
			  $ala+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=629";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $epa+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=631";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $dpa+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=621";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $dha+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=675";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $la+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=685";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $gla+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=853";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $dgla+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=855";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $aa+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=674";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $oa+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=628";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $ga+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=676";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $ea+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=671";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $na+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=611";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $lauric+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=612";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $myristic+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=613";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $palmitic+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=614";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $stearic+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=503";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $iso+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }

do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=504";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $leucine+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=510";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $valine+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=501";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $trypto+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=502";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $threo+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=505";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $lysine+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=506";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $meth+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=507";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $cystine+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=508";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $phenyl+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=509";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $tyrosine+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=511";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $arg+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=512";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $hist+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=513";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $alanine+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=514";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $aspartic+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=515";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $glutamic+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=516";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $glycine+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=517";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $proline+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=518";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $serine+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }
			  
do {  
   	  		  		  
			  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getTotals['NDB_No']." AND nutrients.Nutr_No=521";
			  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			  $row_getNut = mysql_fetch_assoc($getNut);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE weights.NDB_No=".$row_getTotals['NDB_No']." AND weights.Seq=".$row_getTotals['Seq'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight); 
			  
			  $hydroxy+=($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getTotals['Amount'];
          
		  	  } while ($row_getTotals = mysql_fetch_assoc($getTotals));
  			  $rows = mysql_num_rows($getTotals);
  			  if($rows > 0) {
     		  mysql_data_seek($getTotals, 0);
	  		  $row_getTotals = mysql_fetch_assoc($getTotals);
  			  }

$query_getNDB = "SELECT NDB_No FROM food_descriptions ORDER BY NDB_No DESC LIMIT 1";
$getNDB = mysql_query($query_getNDB, $nutritionfacts) or die(mysql_error());
$row_getNDB = mysql_fetch_assoc($getNDB);

$newNDB=$row_getNDB['NDB_No']+1;
$shortname=str_replace(" ","",$mealname);

mysql_query("INSERT INTO abbreviated 
					(NDB_No,
					 Shrt_Desc,
					 Energ_Kcal,
					 Protein,
					 Lipid_Tot,
					 Carbohydrt)
			 VALUES 
			 		('".$newNDB."',
					 '".$shortname."',
					 '".$calories."',
					 '".$protein."',
					 '".$totalfat."',
					 '".$carbs."')");

mysql_query("INSERT INTO food_descriptions
					(NDB_No,
					 FdGrp_Cd,
					 Long_Desc,
					 Shrt_Desc)
			 VALUES
			 	    ('".$newNDB."',
					 '".$foodgroup."',
					 '".$mealname."',
					 '".$shortname."')");
					 
mysql_query("INSERT INTO weights
					(NDB_No,
					 Seq,
					 Amount,
					 Msre_Desc,
					 Gm_Wgt)
			 VALUES
			 	    ('".$newNDB."',
					 1,
					 1,
					 '".$measure."',
					 100)");
					 
mysql_query("INSERT INTO nutrients
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES
			 	    ('".$newNDB."',208,'".$calories."'),
					('".$newNDB."',204,'".$totalfat."'),
					('".$newNDB."',606,'".$satfat."'),
					('".$newNDB."',645,'".$monofat."'),
					('".$newNDB."',646,'".$polyfat."'),
					('".$newNDB."',605,'".$transfat."'),
					('".$newNDB."',601,'".$choles."'),
					('".$newNDB."',307,'".$sodium."'),
					('".$newNDB."',306,'".$potassium."'),
					('".$newNDB."',205,'".$carbs."'),
					('".$newNDB."',291,'".$fiber."'),
					('".$newNDB."',269,'".$sugar."'),
					('".$newNDB."',203,'".$protein."'),
					('".$newNDB."',301,'".$calcium."'),
					('".$newNDB."',303,'".$iron."'),
					('".$newNDB."',304,'".$magnesium."'),
					('".$newNDB."',305,'".$phosphorus."'),
					('".$newNDB."',309,'".$zinc."'),
					('".$newNDB."',291,'".$copper."'),
					('".$newNDB."',315,'".$mang."'),
					('".$newNDB."',317,'".$selenium."'),
					('".$newNDB."',313,'".$fluoride."'),
					('".$newNDB."',255,'".$water."'),
					('".$newNDB."',401,'".$vitc."'),
					('".$newNDB."',404,'".$vitb1."'),
					('".$newNDB."',405,'".$vitb2."'),
					('".$newNDB."',406,'".$vitb3."'),
					('".$newNDB."',410,'".$vitb5."'),
					('".$newNDB."',415,'".$vitb6."'),
					('".$newNDB."',417,'".$vitb9."'),
					('".$newNDB."',421,'".$choline."'),
					('".$newNDB."',418,'".$vitb12."'),
					('".$newNDB."',318,'".$vita."'),
					('".$newNDB."',323,'".$vite."'),
					('".$newNDB."',324,'".$vitd."'),
					('".$newNDB."',325,'".$vitd2."'),
					('".$newNDB."',326,'".$vitd3."'),
					('".$newNDB."',430,'".$vitk."'),
					('".$newNDB."',321,'".$betac."'),
					('".$newNDB."',322,'".$alphac."'),
					('".$newNDB."',337,'".$lycopene."'),
					('".$newNDB."',338,'".$leutine."'),
					('".$newNDB."',636,'".$phyto."'),
					('".$newNDB."',262,'".$caffeine."'),
					('".$newNDB."',221,'".$alcohol."'),
					('".$newNDB."',851,'".$ala."'),
					('".$newNDB."',629,'".$epa."'),
					('".$newNDB."',631,'".$dpa."'),
					('".$newNDB."',621,'".$dha."'),
					('".$newNDB."',675,'".$la."'),
					('".$newNDB."',685,'".$gla."'),
					('".$newNDB."',853,'".$dgla."'),
					('".$newNDB."',855,'".$aa."'),
					('".$newNDB."',674,'".$oa."'),
					('".$newNDB."',628,'".$ga."'),
					('".$newNDB."',676,'".$ea."'),
					('".$newNDB."',671,'".$na."'),
					('".$newNDB."',611,'".$lauric."'),
					('".$newNDB."',612,'".$myristic."'),
					('".$newNDB."',613,'".$palmitic."'),
					('".$newNDB."',614,'".$stearic."'),
					('".$newNDB."',503,'".$iso."'),
					('".$newNDB."',504,'".$leucine."'),
					('".$newNDB."',510,'".$valine."'),
					('".$newNDB."',501,'".$trypto."'),
					('".$newNDB."',502,'".$threo."'),
					('".$newNDB."',505,'".$lysine."'),
					('".$newNDB."',506,'".$meth."'),
					('".$newNDB."',507,'".$cystine."'),
					('".$newNDB."',508,'".$phenyl."'),
					('".$newNDB."',509,'".$tyrosine."'),
					('".$newNDB."',511,'".$arg."'),
					('".$newNDB."',512,'".$hist."'),
					('".$newNDB."',513,'".$alanine."'),
					('".$newNDB."',514,'".$aspartic."'),
					('".$newNDB."',515,'".$glutamic."'),
					('".$newNDB."',516,'".$glycine."'),
					('".$newNDB."',517,'".$proline."'),
					('".$newNDB."',518,'".$serine."'),
					('".$newNDB."',521,'".$hydroxy."')");
					 

?>



