window.onbeforeunload = function() {
    str=$("#tablename").val();
		       $.ajax(
			     {
				 
				 async:false, type: "POST",url:"droptable.php?q="+str,
				   success:function(result)
	                 {
		             $("#tableunloader").html(result);
		             },
		           error: function (xhr,err) 
			         {
                     alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
                     alert("responseText: " + xhr.responseText);
                     }
		         });
			   
}

$(document).ready(function()
    {
	  $("#additem").hide();
	  $("#totNut").hide();
	  $("#savemeal").hide();
	  var str=$("#tablename").val();
	  $( "#savedialog" ).dialog(
	  { 
	  autoOpen:false,
	  minWidth:690,
	  minHeight:100,
	  modal:true,
	  buttons: 
	    [ 
		{ 
		id:"okButton", 
		text: "Ok", 
		click: function() 
		  {  
		  var str=$("#mealname").val();
		  var foodgroup=$("#foodgroup").val();
		  var tablename=$("#tablename").val();
		  var measure=$("#measure").val();
	      $.ajax({async: false, type: "POST",url:"addmeal.php?q="+str+"&r="+foodgroup+"&s="+tablename+"&t="+measure,success:function(result)
	        {
		    $("#mealadd").html(result);
		    },
		  error: function (xhr,err) 
		    {
            alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
            alert("responseText: " + xhr.responseText);
            }
		  });
		  $( this ).dialog( "close" ) 
		  window.location.replace("mealtracker.php");
		  } 
		} 
		]  
		});
      $("#okButton").button("disable");
	  $( "#dialog" ).dialog({ buttons: [ { text: "Ok", click: function() { $( this ).dialog( "close" );}  } ] }, {minWidth:400});  
	});
	
$("#mealname").keyup(function() 
{
  var n = $("#mealname").val().length;
  var m = $("#measure").val().length;
  if (n>0 && m>0)
    {
	$("#okButton").button("enable");
	}
  else
    {
	$("#okButton").button("disable");
	}
});

$("#measure").keyup(function() 
{
  var n = $("#mealname").val().length;
  var m = $("#measure").val().length;
  if (n>0 && m>0)
    {
	$("#okButton").button("enable");
	}
  else
    {
	$("#okButton").button("disable");
	}
});
  
 $( document ).ready(function()
    {
	$("#nutrientselect").chosen().change(function()
	  {
	  var str=$("#nutrientselect").val();
	  $.ajax({type: "POST",url:"getfoods.php?q="+str,success:function(result)
	    {
		$("#foodSelect").html(result);
		$("#foodSelect").trigger("liszt:updated");
		},
		error: function (xhr,err) {
                alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
                alert("responseText: " + xhr.responseText);
            }
		});
		
	  });
	 
    });
	
	
	$( document ).ready(function()
    {
	$("#foodSelect").change(function()
	  {
	  $("#additem").show()
	  $("#totNut").show();
	  var str=$("#foodSelect").val();
	  $.ajax({type: "POST",url:"getnutrition.php?q="+str,success:function(result)
	    {
		$("#nutFacts").html(result);
		},
		error: function (xhr,err) {
                alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
                alert("responseText: " + xhr.responseText);
            }
		});
		
	  });
    });

	$( document ).ready(function()
    {
	$("#additem").click(function()
	  {
	  $("#savemeal").show();
	  var str=$("#foodSelect").val();
	  var tablename=$("#tablename").val();
	  $.ajax({type: "POST",url:"getfood.php?q="+str+"&r=1&t=0&s=1&p="+tablename,success:function(result)
	    {
		$("#totNut").html(result);
		},
		error: function (xhr,err) {
                alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
                alert("responseText: " + xhr.responseText);
            }
		});
	  });
    });

$( document ).ready(function()
    {
	$("#savemeal").click(function()
	  {
	  $("#savedialog").dialog('open');
	 
	  });
    });	

function notify(id, ndb, amount,idname){
		var tablename=$("#tablename").val(); 
		$.ajax({type: "POST",url:"getfood.php?q="+ndb+"&r="+id+"&t=1&s="+amount+"&p="+tablename,success:function(result)
	    {
		$("#totNut").html(result);
		},
		error: function (xhr,err) {
                alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
                alert("responseText: " + xhr.responseText);
            }
		});
		 }
		 
function deleteline(id, ndb, amount){
		var tablename=$("#tablename").val();
		$.ajax({type: "POST",url:"getfood.php?q="+ndb+"&r="+id+"&t=2&s="+amount+"&p="+tablename,success:function(result)
	    {
		$("#totNut").html(result);
		},
		error: function (xhr,err) {
                alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
                alert("responseText: " + xhr.responseText);
            }
		});
		 }