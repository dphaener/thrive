<?php

$mealname=$_POST['mealname'];
$foodgroup=$_POST['foodgroup'];
$measure=$_POST['measure'];
$calories=$_POST['calories'];
$totalfat=$_POST['totalfat'];
$satfat=$_POST['satfat'];
$monofat=$_POST['monofat'];
$polyfat=$_POST['polyfat'];
$transfat=$_POST['transfat'];
$choles=$_POST['choles'];
$sodium=$_POST['sodium'];
$potassium=$_POST['potassium'];
$carbs=$_POST['carbs'];
$fiber=$_POST['fiber'];
$sugar=$_POST['sugar'];
$protein=$_POST['protein'];
$calcium=$_POST['calcium'];
$iron=$_POST['iron'];
$magnesium=$_POST['magnesium'];
$phosphorus=$_POST['phosphorus'];
$zinc=$_POST['zinc'];
$copper=$_POST['copper'];
$mang=$_POST['mang'];
$selenium=$_POST['selenium'];
$fluoride=$_POST['fluoride'];
$water=$_POST['water'];
$vitc=$_POST['vitc'];
$vitb1=$_POST['vitb1'];
$vitb2=$_POST['vitb2'];
$vitb3=$_POST['vitb3'];
$vitb5=$_POST['vitb5'];
$vitb6=$_POST['vitb6'];
$vitb9=$_POST['vitb9'];
$choline=$_POST['choline'];
$vitb12=$_POST['vitb12'];
$vita=$_POST['vita'];
$vite=$_POST['vite'];
$vitd=$_POST['vitd'];
$vitd2=$_POST['vitd2'];
$vitd3=$_POST['vitd3'];
$vitk=$_POST['vitk'];
$betac=$_POST['betac'];
$alphac=$_POST['alphac'];
$lycopene=$_POST['lycopene'];
$leutine=$_POST['leutine'];
$phyto=$_POST['phyto'];
$caffeine=$_POST['caffeine'];
$alcohol=$_POST['alcohol'];

if ($calcium != 0) {$calcium=($calcium/100)*1000;}
if ($iron != 0 ) {$iron=($iron/100)*8;}
if ($magnesium != 0) {$magnesium=($magnesium/100)*350;}
if ($phosphorus != 0) {$phosphorus=($phosphorus/100)*700;}
if ($zinc != 0) {$zinc=($zinc/100)*11;}
if ($copper != 0) {$copper=($copper/100)*.9;}
if ($mang != 0) {$mang=($mang/100)*2.3;}
if ($selenium != 0) {$selenium=($selenium/100)*55;}
if ($fluoride != 0) {$fluoride=($fluoride/100)*4000;}
if ($vitc != 0) {$vitc=($vitc/100)*75;}
if ($vitb1 != 0) {$vitb1=($vitb1/100)*1;}
if ($vitb2 != 0) {$vitb2=($vitb2/100)*1.1;}
if ($vitb3 !=0) {$vitb3=($vitb3/100)*12;}
if ($vitb5 != 0) {$vitb5=($vitb5/100)*5;}
if ($vitb6 != 0) {$vitb6=($vitb6/100)*1.4;}
if ($vitb9 != 0) {$vitb9=($vitb9/100)*400;}
if ($choline != 0) {$choline=($choline/100)*550;}
if ($vitb12 != 0) {$vitb12=($vitb12/100)*2.4;}
if ($vita != 0) {$vita=($vita/100)*3000;}
if ($vite != 0) {$vite=($vite/100)*12;}
if ($vitd != 0) {$vitd=($vitd/100)*600;}
if ($vitk != 0) {$vitk=($vitk/100)*120;}

require_once('../Connections/nutritionfacts.php');

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getNDB = "SELECT NDB_No FROM FOOD_DES ORDER BY NDB_No DESC LIMIT 1";
$getNDB = mysql_query($query_getNDB, $nutritionfacts) or die(mysql_error());
$row_getNDB = mysql_fetch_assoc($getNDB);

$newNDB=$row_getNDB['NDB_No']+1;
$shortname=str_replace(" ","",$mealname);

mysql_query("INSERT INTO FOOD_DES
					(NDB_No,
					 FdGrp_Cd,
					 Long_Desc,
					 Shrt_Desc)
			 VALUES
			 	    ('".$newNDB."',
					 '".$foodgroup."',
					 '".$mealname."',
					 '".$shortname."')");
					 
mysql_query("INSERT INTO WEIGHT
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
					 
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES
			 	    ('".$newNDB."',208,'".$calories."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',204,'".$totalfat."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',606,'".$satfat."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',645,'".$monofat."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',646,'".$polyfat."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',605,'".$transfat."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',601,'".$choles."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',307,'".$sodium."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',306,'".$potassium."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',205,'".$carbs."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',291,'".$fiber."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',269,'".$sugar."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',203,'".$protein."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',301,'".$calcium."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',303,'".$iron."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',304,'".$magnesium."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',305,'".$phosphorus."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',309,'".$zinc."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',291,'".$copper."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',315,'".$mang."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',317,'".$selenium."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',313,'".$fluoride."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',255,'".$water."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',401,'".$vitc."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',404,'".$vitb1."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',405,'".$vitb2."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',406,'".$vitb3."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',410,'".$vitb5."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',415,'".$vitb6."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',417,'".$vitb9."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',421,'".$choline."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',418,'".$vitb12."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',318,'".$vita."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',323,'".$vite."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',324,'".$vitd."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',325,'".$vitd2."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',326,'".$vitd3."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',430,'".$vitk."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',321,'".$betac."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',322,'".$alphac."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',337,'".$lycopene."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',338,'".$leutine."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',636,'".$phyto."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',262,'".$caffeine."')");
mysql_query("INSERT INTO NUT_DATA
					(NDB_No, Nutr_No, Nutr_Val)
			 VALUES					
					('".$newNDB."',221,'".$alcohol."')");
					 

?>



