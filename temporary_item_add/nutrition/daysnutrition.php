<script>

$("form").submit(function () { return false; });

$(".meals").chosen().change(function(){
		   var entryid=$(this.form.entryid).val();
		   var mealname=$(this).val();
  		   $.ajax(
			     {
				 
				 async:false, type: "POST",url:"updatemeal.php?q="+entryid+"&r="+mealname,
				   success:function(result)
	                 {
		             $(this).html(result);
					 $(this).trigger("liszt:updated");
		             },
		           error: function (xhr,err) 
			         {
                     alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
                     alert("responseText: " + xhr.responseText);
                     }
		         });
          });
		  
$(".weightstuff").chosen().change(function(){
  var ndb=$(this.form.ndbno3).val();
  var newdate=$("#pickdate").val();
  var userid=$("#userid").val();
  var amount=$(this.form.amount).val();
  var seqid=$(this).val();
  var mealid=$(this.form.mealid).val();
  var entryid=$(this.form.entryid2).val();
  $.ajax(
    {
	async:false, type: "POST",url:"updatetable.php?q="+ndb+"&r="+userid+"&s="+newdate+"&t="+amount+"&u="+seqid+"&v="+mealid+"&w="+entryid,
	success:function(result)
	  {
	    $("#updatetable").html(result);
	  },
	  error: function (xhr,err) 
	  {
        alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
        alert("responseText: " + xhr.responseText);
      }
    });
  $.ajax(
    {
	async:false, type: "POST",url:"daysnutrition.php?q="+newdate+"&r="+userid,
	success:function(result)
	  {
        $("#nutinfoday").html(result);
	  },
    error: function (xhr,err) 
	  {
        alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
        alert("responseText: " + xhr.responseText);
      }
    });
});

$(".deletebutton").click(function(){	
  var NewDate=$(this.form.newdate).val();
  var UserId=$(this.form.userid).val();
  var EntryId=$(this.form.entryid).val();
  $(".deletebutton").tooltip("close");
  deleteitem(EntryId, NewDate, UserId);
});

$(".infobutton").click(function(){		
  var WeightId7=$(this.form.weightnumber7).val();
  var AmountId7=$(this.form.amountchange7).val();
  var NDBId7=$(this.form.ndbno7).val();
  var foodid=$(this.form.foodname).val();
  $("#nutritionfacts").dialog("option","title",foodid);
  $.ajax(
			     {
				 
				 async:false, type: "POST",url:"fullnut.php?q="+WeightId7+"&r="+AmountId7+"&s="+NDBId7,
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

$(".infobutton2").click(function(){
  var newdate=$(this.form.newdate).val();
  var userid=$(this.form.userid).val();		
  $("#nutritionfacts").dialog("option","title","Nutritional Totals");
  $.ajax(
			     {
				 
				 async:false, type: "POST",url:"fullnuttotal.php?q="+newdate+"&r="+userid,
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

$( "#nutritionfacts" ).on( "dialogclose", function( event, ui ) {  $(".infobutton").tooltip("close"); $(".infobutton2").tooltip("close");} );

$(document).ready(function(){
 $(".amountchange").on("spin",function(event, ui){
  var ndb=$(this.form.ndbno2).val();
  var newdate=$("#pickdate").val();
  var userid=$("#userid").val();
  var amount=ui.value;
  var seqid=$(this.form.seqid).val();
  var mealid=$(this.form.mealid2).val();
  var entryid=$(this.form.entryid3).val();
  $.ajax(
    {
	async:false, type: "POST",url:"updatetablespin.php?q="+ndb+"&r="+userid+"&s="+newdate+"&t="+amount+"&u="+seqid+"&v="+mealid+"&w="+entryid,
	success:function(result)
	  {
	    $("#updatetable").html(result);
	  },
	  error: function (xhr,err) 
	  {
        alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
        alert("responseText: " + xhr.responseText);
      }
    });
  $.ajax(
    {
	async:false, type: "POST",url:"daysnutrition.php?q="+newdate+"&r="+userid,
	success:function(result)
	  {
        $("#nutinfoday").html(result);
	  },
    error: function (xhr,err) 
	  {
        alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
        alert("responseText: " + xhr.responseText);
      }
    });
 
});
});

$(".amountchange").on("spinchange",function(event, ui){
  var ndb=$(this.form.ndbno2).val();
  var newdate=$("#pickdate").val();
  var userid=$("#userid").val();
  var amount=$(this.form.amountchanged).spinner("value");
  var seqid=$(this.form.seqid).val();
  var mealid=$(this.form.mealid2).val();
  var entryid=$(this.form.entryid3).val();
  $.ajax(
    {
	async:false, type: "POST",url:"updatetablespin.php?q="+ndb+"&r="+userid+"&s="+newdate+"&t="+amount+"&u="+seqid+"&v="+mealid+"&w="+entryid,
	success:function(result)
	  {
	    $("#updatetable").html(result);
	  },
	  error: function (xhr,err) 
	  {
        alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
        alert("responseText: " + xhr.responseText);
      }
    });
  $.ajax(
    {
	async:false, type: "POST",url:"daysnutrition.php?q="+newdate+"&r="+userid,
	success:function(result)
	  {
        $("#nutinfoday").html(result);
	  },
    error: function (xhr,err) 
	  {
        alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
        alert("responseText: " + xhr.responseText);
      }
    });
 
});

</script>

<?php 

require_once('../Connections/nutritionfacts.php'); 

$originaldate=$_GET['q'];
$newdate=strtotime($_GET['q']);
$userid=$_GET['r'];

mysql_select_db($database_nutritionfacts, $nutritionfacts);
$query_getMeals = "SELECT * FROM NutritionTotals WHERE User_Id=".$userid." AND UNIX_TIMESTAMP(Create_Date)=".$newdate;
$getMeals = mysql_query($query_getMeals, $nutritionfacts) or die(mysql_error());
$row_getMeals = mysql_fetch_assoc($getMeals);
$totalRows_getMeals = mysql_num_rows($getMeals);

$query_getNames = "SELECT * FROM Meal_List";
$getNames = mysql_query($query_getNames, $nutritionfacts) or die(mysql_error());
$row_getNames = mysql_fetch_assoc($getNames);
$totalRows_getNames = mysql_num_rows($getNames);

if ($totalRows_getMeals==0) { echo "<h2>You do not have any data to display for this date</h2>";  } else {
?>
<table border="1" cellspacing="0" cellpadding="1" width="100%" style="border-left:0; border-top:0; border-bottom:0; border-right:0; color:#FFF; text-align:center;">  		  
<tr style="font-size:18px; border-style:double;">
    		  <th style="border-left:0; border-right:0; border-top:0; border-bottom:4; padding:3px;">Meal</th>
    		  <th style="border-left:0; border-right:0; border-top:0; border-bottom:4; padding:3px;">Food Name</th>
			  <th style="border-left:0; border-right:0; border-top:0; border-bottom:4; padding:3px;">Amount</th>
			  <th style="border-left:0; border-right:0; border-top:0; border-bottom:4; padding:3px;">Measure</th>
			  <th style="border-left:0; border-right:0; border-top:0; border-bottom:4; padding:3px;">Calories</th>
			  <th style="border-left:0; border-right:0; border-top:0; border-bottom:4; padding:3px;">Total Fat</th>
			  <th style="border-left:0; border-right:0; border-top:0; border-bottom:4; padding:3px;">Carbs</th>
			  <th style="border-left:0; border-right:0; border-top:0; border-bottom:4; padding:3px;">Protein</th>
			</tr>
			
			<?php
			  $caltotal = 0;
			  $fattotal = 0;
			  $carbtotal = 0;
			  $prottotal = 0;
			  $nutweight = 0;
			  $totalitems=0;
			  do { 
			  $totalitems+=1;
			  $mealid="meal".$totalitems;
              $weightPicker = "weightamount".$totalitems;
			   
			  mysql_select_db($database_nutritionfacts, $nutritionfacts);
			  $query_getFood = "SELECT * FROM food_descriptions WHERE NDB_No=".$row_getMeals['NDB_No'];
			  $getFood = mysql_query($query_getFood, $nutritionfacts) or die(mysql_error());
			  $row_getFood = mysql_fetch_assoc($getFood);
			  $totalRows_getFood = mysql_num_rows($getFood);
			  
			  $query_getWeight = "SELECT * FROM weights WHERE Seq=".$row_getMeals['Seq']." AND NDB_No=".$row_getMeals['NDB_No'];
			  $getWeight = mysql_query($query_getWeight, $nutritionfacts) or die(mysql_error());
			  $row_getWeight = mysql_fetch_assoc($getWeight);
			  $totalRows_getWeight = mysql_num_rows($getWeight);
			  
			  $query_getWeights = "SELECT * FROM weights WHERE NDB_No=".$row_getMeals['NDB_No'];
			  $getWeights = mysql_query($query_getWeights, $nutritionfacts) or die(mysql_error());
			  $row_getWeights = mysql_fetch_assoc($getWeights);
			  $totalRows_getWeights = mysql_num_rows($getWeights);
			  
			  $query_getMealName = "SELECT * FROM Meal_List WHERE Meal_Number=".$row_getMeals['Meal_Number'];
			  $getMealName = mysql_query($query_getMealName, $nutritionfacts) or die(mysql_error());
			  $row_getMealName = mysql_fetch_assoc($getMealName);
			  $totalRows_getMealName = mysql_num_rows($getMealName);
			  ?>
			  <tr>
			  <td style="color:#000; border-left:0; border-right:0; text-align:left;">
		      <form id="mealname" style="display:inline;">
			    <input type="hidden" value="<?php echo $row_getMeals['Entry_Id']; ?>" id="entryid">
				<select class="meals" name="mealnames" id="<?php echo $mealid;?>" title="<?php echo $row_getNames['Meal_Desc']; ?>" style="width:150px; margin-top:0px;">
                 <?php
                 do {  
                    switch ($row_getNames['Meal_Number'])
					  {
   		              case ($row_getNames['Meal_Number']=$row_getMeals['Meal_Number']):?>
		  	            <option value="<?php echo $row_getNames['Meal_Desc'];?>" selected ><?php echo $row_getNames['Meal_Desc']; ?></option>
                        <?php
			            break;
		              default:?>
		  	            <option value="<?php echo $row_getNames['Meal_Desc'];?>" ><?php echo $row_getNames['Meal_Desc']; ?></option>
			            <?php
			            break;
	         		  }?>
  	            <?php    
                    } while ($row_getNames = mysql_fetch_assoc($getNames));
                $rows = mysql_num_rows($getNames);
                if($rows > 0) 
				  {
                  mysql_data_seek($getNames, 0);
	              $row_getNames = mysql_fetch_assoc($getNames);
                  }?>
			   </select>
			 </form>
			 </td>
			 <td style="border-left:0; border-right:0;"><?php echo $row_getFood['Long_Desc']; ?></td>
			 <td style="border-left:0; border-right:0; font-size:12px;">
			 <form style="display:inline;" id="changed">
			 <input value="<?php echo $row_getMeals['Amount'] ?>" id="amountchanged" class="amountchange" style="width:30px; height:17px;">
			 <input type="hidden" value="<?php echo $row_getMeals['NDB_No'];?>" id="ndbno2">
			 <input type="hidden" value="<?php echo $row_getMeals['Meal_Number'];?>" id="mealid2">
			 <input type="hidden" value="<?php echo $row_getMeals['Entry_Id']; ?>" id="entryid3">
			 <input type="hidden" value="<?php echo $row_getMeals['Seq']; ?>" id="seqid">
			 </form>
			 </td>
			 <td style="border-left:0; border-right:0; color:#000; text-align:left;">
			 <form style="display:inline;">
			 <input type="hidden" value="<?php echo $row_getMeals['Amount'];?>" id="amount">
			 <input type="hidden" value="<?php echo $row_getMeals['NDB_No'];?>" id="ndbno3">
			 <input type="hidden" value="<?php echo $row_getMeals['Meal_Number'];?>" id="mealid">
			 <input type="hidden" value="<?php echo $row_getMeals['Entry_Id']; ?>" id="entryid2">
			 <select class="weightstuff" name="weights" id="<?php echo $weightPicker;?>" title="<?php echo $row_getWeight['Msre_Desc']; ?>" style="width:200px;">
             <?php
             do {  
               switch ($row_getWeights['Seq'])
			     {
   		         case ($row_getWeights['Seq']=$row_getMeals['Seq']):?>
		  	       <option selected ><?php echo round($row_getWeights['Amount'])." ".$row_getWeights['Msre_Desc']?></option>
			       <?php
			       break;
		         default:?>
		  	       <option><?php echo round($row_getWeights['Amount'])." ".$row_getWeights['Msre_Desc']?></option>
			       <?php
			       break;
			     }?>
  	         <?php    
             } while ($row_getWeights = mysql_fetch_assoc($getWeights));
             $rows = mysql_num_rows($getWeights);
             if($rows > 0) 
			   {
               mysql_data_seek($getWeights, 0);
	           $row_getWeights = mysql_fetch_assoc($getWeights);
               }?>
			 </select>
			 </form>
			 </td>
				<td style="border-left:0; border-right:0;"><?php 
				  $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getMeals['NDB_No']." AND nutrients.Nutr_No=208";
                  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			      $row_getNut = mysql_fetch_assoc($getNut); 
				  $nutweight=round(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getMeals['Amount']);
				  $caltotal += $nutweight;
		          echo $nutweight;?></td> 
				<td style="border-left:0; border-right:0;"><?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getMeals['NDB_No']." AND nutrients.Nutr_No=204";
                  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			      $row_getNut = mysql_fetch_assoc($getNut); 
			      $nutweight=round(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getMeals['Amount']);
				  $fattotal += $nutweight;
		          echo $nutweight;?></td> 
				<td style="border-left:0; border-right:0;"><?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getMeals['NDB_No']." AND nutrients.Nutr_No=205";
                  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			      $row_getNut = mysql_fetch_assoc($getNut); 
			      $nutweight=round(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getMeals['Amount']);
				  $carbtotal += $nutweight;
		          echo $nutweight;?></td> 
			  	<td style="border-left:0; border-right:0;"><?php $query_getNut = "SELECT Nutr_Val FROM nutrients WHERE nutrients.NDB_No=".$row_getMeals['NDB_No']." AND nutrients.Nutr_No=203";
                  $getNut = mysql_query($query_getNut, $nutritionfacts) or die(mysql_error());
			      $row_getNut = mysql_fetch_assoc($getNut); 
			      $nutweight=round(($row_getWeight['Gm_Wgt']/100)*$row_getNut['Nutr_Val']*$row_getMeals['Amount']);
				  $prottotal += $nutweight;
		          echo $nutweight;?></td>
				<td style="border:0">
				  <form id="changed2">
				    <input type="hidden" value="<?php echo $userid ?>" id="userid" >
				    <input type="hidden" value="<?php echo $originaldate ?>" id="newdate">
					<input type="hidden" value="<?php echo $row_getMeals['Entry_Id'] ?>" id="entryid">
				    <input id="deletebutton" style="float:left;" type="image" src="../images/deletebutton.png" value="Submit" alt="Submit" class="deletebutton" width="16" height="16" title="Click here to delete this item.">
				  </form>
				</td>
    			<td style="border:0">
				  <form id="changed3">
				    <input type="hidden" value="<?php echo $row_getMeals['Amount'] ?>" id="amountchange7">
				    <input type="hidden" value="<?php echo $row_getMeals['Seq'] ?>" id="weightnumber7" >
					<input type="hidden" value="<?php echo $row_getMeals['NDB_No'] ?>" id="ndbno7">
					<input type="hidden" value="<?php echo $row_getFood['Long_Desc']; ?>" id="foodname">
					<input id="infobutton" style="float:left;" type="image" src="../images/info-icon.png" value="Submit" alt="Submit" class="infobutton" width="16" height="16" title="Click here to view the full nutritional information for this item.">
				  </form>
				</td>
			  </tr> 	
			  <?php           
			  } while ($row_getMeals = mysql_fetch_assoc($getMeals));
			  $rows = mysql_num_rows($getMeals);
			  if($rows > 0) {
			  mysql_data_seek($getMeals, 0);
			  $row_getMeals = mysql_fetch_assoc($getMeals);
			  } ?>  	
			  <tr>
			    <td style="border-left:0; border-right:0; border-bottom:0;"></td>
			    <td style="border-left:0; border-right:0; border-bottom:0;"></td>
				<td style="border-left:0; border-right:0; border-bottom:0;"></td>
				<td style="border-left:0; border-right:0; border-bottom:0; text-align:right;">Totals:</td>
				<td style="border-left:0; border-right:0;"><?php echo $caltotal;?></td>
				<td style="border-left:0; border-right:0;"><?php echo $fattotal;?></td>
				<td style="border-left:0; border-right:0;"><?php echo $carbtotal;?></td>
				<td style="border-left:0; border-right:0;"><?php echo $prottotal;?></td> 
				<td style="border:0">
				  <form id="changed4">
				    <input type="hidden" value="<?php echo $newdate ?>" id="newdate">
					<input type="hidden" value="<?php echo $userid ?>" id="userid">
					<input id="totalinfo" style="float:left;" type="image" src="../images/info-icon.png" value="Submit" alt="Submit" class="infobutton2" width="16" height="16" title="Click here to view the total nutritional value for all items.">
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
    <td style="border:0;">
    </td> 
    <td style="border:0; font-size:18px; text-align:right;">
	% of calories:
      </td>
  
    <td style="border-left:0; border-right:0">
  <b><?php if ($fattotal+$carbtotal+$prottotal==0){echo "0"; } else { echo round(($fattotal/($fattotal+$carbtotal+$prottotal))*100)."%";} ?></b>
    </td>
  
    <td style="border-left:0; border-right:0">
  <b><?php if ($fattotal+$carbtotal+$prottotal==0){echo "0"; } else {echo round(($carbtotal/($fattotal+$carbtotal+$prottotal))*100)."%";} ?></b>
    </td>
  
    <td style="border-left:0; border-right:0">
  <b><?php if ($fattotal+$carbtotal+$prottotal==0){echo "0"; } else {echo round(($prottotal/($fattotal+$carbtotal+$prottotal))*100)."%"; }?></b>
    </td>
  
    </tr>
			  </table>
		<script>
		$(".amountchange").spinner({min:0}, {step:.1}, {page:10}, {numberFormat:"n"});
		$("#totalinfo").tooltip();
		$(".infobutton").tooltip();
		$(".deletebutton").tooltip();
		$(".editbutton").tooltip();
		$(".weightstuff").chosen();
		$(".meals").chosen();
		</script>
<?php } ?> 