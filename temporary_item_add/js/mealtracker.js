

$(document).ready(function()
    {
	  $("#additem").hide();
	  $("#totNut").hide(); 
	});
	
 $( document ).ready(function()
    {
	$("#pickdate").on('change',function()
	  {
	  var newdate=$("#pickdate").val();
	  var userid=$("#userid").val();
	  $.ajax({async:false, type: "POST",url:"daysnutrition.php?q="+newdate+"&r="+userid,success:function(result)
	    {
		$("#nutinfoday").html(result);
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
	  $("#additem").show();
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
		 
function deleteitem(entryid, newdate, userid){
		$.ajax({type: "POST",url:"deleteitem.php?q="+entryid,success:function(result)
	    {
		$.ajax({async:false, type: "POST",url:"daysnutrition.php?q="+newdate+"&r="+userid,success:function(result)
	    {
		$("#nutinfoday").html(result);
		},
		error: function (xhr,err) {
                alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
                alert("responseText: " + xhr.responseText);
            }
		});
		},
		error: function (xhr,err) {
                alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status);
                alert("responseText: " + xhr.responseText);
            }
		});
		 }

$("#additem").click(function(){
  var ndb=$("#foodSelect").val();
  var newdate=$("#pickdate").val();
  var userid=$("#userid").val();
  $.ajax(
    {
	async:false, type: "POST",url:"inserttable.php?q="+ndb+"&r="+userid+"&s="+newdate+"&t=1&u=1&v=1",
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

$("#mealstacker").click(function(){
   window.location.replace("mealstacker.php");
});

$("#newitem").click(function(){
   window.location.replace("additem.php");
   
});
