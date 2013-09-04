var OPENFIT_DATA_URL = "/openfit/api/api.php";

var dataMap = {};
var configMap = {};

Drupal.behaviors.openfitCharts = {
	attach: function (context, settings) {
		//updateCharts();
	}
};

function convertData(data, conversionFactors) {
	for (i = 0; i < data.length; i++) {
		value = data[i];
		if (value.length == null) {
			value = convert(value, conversionFactors.from, conversionFactors.to);
		} else {
			value[1] = convert(value[1], conversionFactors.from, conversionFactors.to);
		}
		data[i] = value;
	}
	return data;
}

function convert(value, unitFrom, unitTo) {
	//console.log(typeof value);
	// Convert the incoming value to SI units
    if (unitFrom != null) {
      if (Number(unitFrom.conversion_factor) != 1 || Number(unitFrom.conversion_offset != 0)) {
        value -= Number(unitFrom.conversion_offset);
        value *= Number(unitFrom.conversion_factor);
      }
    }
    
    // Convert from SI units to the outgoing value
    if (unitTo != null) {
      if (Number(unitTo.conversion_factor) != 1 || Number(unitTo.conversion_offset != 0)) {
        value /= Number(unitTo.conversion_factor);
        value += Number(unitTo.conversion_offset);
      }
    }
   // console.log(typeof value);
    return value;
}

function changeChart(selector) {
	jQuery(selector).siblings().removeClass("active");
	jQuery(selector).addClass("active");
	updateCharts();
	var offset = jQuery(selector).offset().left;
	jQuery(selector).siblings(".active-marker").animate({ left: offset }, 'slow');
}

function hideChart(index, chart) {
	jQuery(chart).hide();
}

function updateCharts() {
	jQuery(".openfit-chart").each(function(i, element) {
		var id = jQuery(element).attr("id");
		id = id.replace("openfit-chart-", "");
		console.log(id);
		getChartData(null, null,id);
	});
}

function getActiveChartIds(selector) {
	var activeCharts = {};
	jQuery(selector).find("select.axis-select").each(function(i, select) {
		if (jQuery(select).hasClass("axis-1")) {
			activeCharts["left"] = jQuery(select).val();
		} else {
			activeCharts["right"] = jQuery(select).val();
		}
	});
	return activeCharts;
}

function initializeChart(id, series, pointInterval, formatter) {
	if (!(id in dataMap)) dataMap[id] = new Array();
	
	var found = false;
	for (key in dataMap[id]) {
		if (dataMap[id][key].label == series.label) {
			found = true;
			dataMap[id][key] = series;
		}
	}
	
	if (!found) dataMap[id].push(series);
	
	var config = jQuery("#"+id).parent().find("div.config");
	
	var xAxis = jQuery("#"+id).parent().find(".xaxis span");
	var yAxis = jQuery("#"+id).parent().find(".yaxis span");
	
	xAxis.text(config.children(".xaxis").val());
	yAxis.text(config.children(".yaxis").val());
	
	var options = {
		series: {
			lines: {show: true},
			points: {show: false},
		},
		selection: { mode: "x" },
		xaxis: { },
		yaxis: { },
		legend: {
			show: false,
			position: "ne",
		},
	};
	
	if (dataMap[id].length > 1) {
		options.legend.show = true;
	}
	
	if (config.find("input.conversion-x").length != 0) {
		var xAxisUnit = jQuery.parseJSON(config.find("input.conversion-x").val());
		options.xaxis.transform = function(value) {
			return convert(value, xAxisUnit.from, xAxisUnit.to);
		};
		options.xaxis.tickFormatter = function(value) {
			return convert(value, xAxisUnit.from, xAxisUnit.to).toFixed(3);
		};
		options.xaxis.inverseTransform = function(value) {
			return convert(value, xAxisUnit.to, xAxisUnit.from);
		}
		if (!xAxis.text().match("("+xAxisUnit.to.unit_symbol+")"))
			xAxis.text(xAxis.text()+" ("+xAxisUnit.to.unit_symbol+")");
	}
	
	if (config.find("input.conversion-y").length != 0) {
		var yAxisUnit = jQuery.parseJSON(config.find("input.conversion-y").val());
		options.yaxis.transform = function(value) {
			return convert(value, yAxisUnit.from, yAxisUnit.to);
		};
		options.yaxis.tickFormatter = function(value) {
			return convert(value, yAxisUnit.from, yAxisUnit.to).toFixed(3);
		};
		options.yaxis.inverseTransform = function(value) {
			return convert(value, yAxisUnit.to, yAxisUnit.from);
		}
		if (!yAxis.text().match("("+yAxisUnit.to.unit_symbol+")"))
			yAxis.text(yAxis.text()+" ("+yAxisUnit.to.unit_symbol+")");
	}
	
	if (formatter != null) {
		options.xaxis.tickFormatter = formatter;
	}
	
	var placeholder = jQuery("#"+id+" > .inner");
	
	placeholder.addClass("has-legend");
	
	placeholder.bind("plotselected", getChartData);
	
	if (pointInterval == 1 && series.data.length < 50) {
		options.series.points.show = true;
	}
	
	jQuery.plot(placeholder, dataMap[id], options);
	
	
	var yAxisLen = yAxis.innerWidth();
	var graphHeight = placeholder.innerHeight();
	yAxis.parent().css({
		position: "relative",
		top: (graphHeight/2 - yAxisLen/2 + yAxis.outerHeight()) + "px" 
		//You have to subtract the outerHeight of yaxis span since the coord is the top left corner
	});
	
	xAxisLen = xAxis.innerWidth();
	var graphWidth = placeholder.innerWidth();
	xAxis.parent().css({
		position: "relative",
		left: (graphWidth/2) + "px"
	})
}

function getChartData(event, ranges, activityId) {
	if (event != null) {
		var id = event.target.id;
		var min = Math.floor(ranges.xaxis.from);
		var max = Math.floor(ranges.xaxis.to);
	} else {
		var min = 0;
		var max = -1;
	}
	
	var params = {
		op: 'TrackHandler.getTrackData', 
		actid: activityId, 
    };
	
	jQuery(this).ajaxError(function(event, jqXHR, ajaxSettings, thrownError) {
		console.log(event);
		console.log(jqXHR);
		console.log(ajaxSettings);
		console.log(thrownError);
	});
	
	jQuery.getJSON(OPENFIT_DATA_URL, params, successHandler);
}

function successHandler(response) {
	if (response != null) {
		var id = null;
		jQuery(".openfit-chart .config").each(function(i, element) {
			if (jQuery(element).children("input.actid").val() == response.activity_id) {
				config = jQuery(element);
				id = jQuery(element).parent().attr("id");
			}
		});
		
		if (id == null) {
			console.error("Problem finding chart from given return data");
			console.log(response);
			return;
		}
		
		updateDataMap(response)
		initializeActionBar(response.activity_id);
		//updateCharts();
	} else {
		console.error("Response was null, cannot proceed.");
	}
}

function convertTrack(track) {
	var converted = new Array();
	var start;
	
	if (track.start != null) {
		if (track.start.length == 2) {	
			converted.push(track.start);
			start = Number(track.start[0]);
		} else {
			console.error("Invalid track, start not valid. Length: "+track.start.length);
		}
	} else {
		console.error("Invalid track, start is null");
	}
	
	while (start % track.interval != 0) {
		start++;
	}
	
	for (var i = 0; i < track.data.length; i++) {
		//Pass through data that already has an x and y
		if (track.data[i].length != null) {
			converted.push(track.data[i]);
			continue;
		}
		var x = Number(track.interval)*i + start;
		var y = track.data[i];
		
		converted.push(new Array(x, y));
	}
	
	if (track.end != null) {
		if (track.end.length == 2) {
			converted.push(track.end);
		} else {
			console.error("Invalid track, end not valid. Length: "+track.end.length);
		}
	} else {
		console.error("Invalid track, end is null");
	}
	
	track.data = converted;
	return track;
}

function updateDataMap(response) {
	for (trackType in response.tracks) {
		response.tracks[trackType] = convertTrack(response.tracks[trackType]);
	}
	dataMap[response.activity_id] = response.tracks;
}

function createChartSkeleton() {
	
}

function initializeActionBar(activityId) {
	
	jQuery("#openfit-chart-"+activityId).find(".axis-select").each(function(i, container) {
		var selectContainer = jQuery(container);
		
		selectContainer.append(jQuery("<div>", {className: "selectbox"}));
		selectContainer.append(jQuery("<ul>", { className: "dropdown" }).append(jQuery("<li>", { html: "<span>--</span>" })));
		
		var selectBox = selectContainer.find(".selectbox");
		var dropDown = selectContainer.find(".dropdown");
		var selected = null;
		
		tracks = dataMap[activityId];
		
		jQuery.each(tracks, function(trackType, track) {
			if (trackType != "distance") {
				if (selected == null) selected = track;
				var element = jQuery("<li>", {
					html: "<div style='background-color: "+track.color+"'></div>" +
							"<span>"+track.title+"</span>" +
								"<input type='hidden' class='value' value='"+track.type+"' />"
				});
				
				dropDown.append(element);
			}
		});
		
		dropDown.find("li").click(function() {
			selectBox.html(jQuery(this).html());
			dropDown.trigger("hide");
			return false;
		});
		
		if (selected != null) {
			selectContainer.filter(".axis-1").find(".selectbox").html(
				"<div style='background-color: "+selected.color+"'></div><span>"+selected.title+"</span><input type='hidden' class='selected' value='"+selected.type+"' />"
			);
		}
		
		selectContainer.append(dropDown.hide());
		
		dropDown.bind('show', function() {
			if (dropDown.is(":animated")) {
				return false;
			}
			selectBox.addClass("expanded");
			dropDown.slideDown();
		}).bind('hide', function() {
			if (dropDown.is(":animated")) {
				return false;
			}
			selectBox.removeClass("expanded");
			dropDown.slideUp();
		}).bind('toggle', function() {
			if (selectBox.hasClass("expanded")) {
				dropDown.trigger("hide");
			} else dropDown.trigger("show");
		});
		
		selectBox.click(function() {
			dropDown.trigger('toggle');
			return false;
		});
		
		jQuery(document).click(function() {
			dropDown.trigger("hide");
		});
	});
}

function formatTimespan(value, axis) {
	
	sign = value < 0 ? "-" : "";
	value = Math.abs(value);
	hours = Math.floor(value/3600);
	value -= hours*3600;
	minutes = Math.floor(value/60);
	value -= minutes*60;
	seconds = Math.round(value);
	value -= seconds;
	
	hour_digits = 1;
    minute_digits = 2;
	second_digits = 2;
	
    hours = (hours >= 0) ? str_pad(hours, "0", hour_digits, "left") + ":" : "";
	minutes = (minutes >= 0 || hours >= 0) ? str_pad(minutes, "0", minute_digits, "left") + ":" : "";
	seconds = (seconds >= 0 || minutes >= 0 || hours >= 0) ? str_pad(seconds, "0", second_digits, "left") : "";
	
	return sign + hours + minutes + seconds;
}

function str_pad(str, replace, len, dir) {
  //str = str || "";
	str = (typeof str == "string") ? str : String(str);
	len = (typeof len == "number") ? len : 0;
	replace = (typeof replace == "string") ? replace : " ";
	dir = (/left|right|both/i).test(dir) ? dir : "right";
	var repeat = function(c, l) { // inner "character" and "length"
	    var repeat = "";
	    while (repeat.length < l) {
	        repeat += c;
	    }
	    return repeat.substr(0, l);
	};
	
	var diff = len - str.length;
	
	if (diff > 0) {
	    switch (dir) {
	        case "left":
	            str = "" + repeat(replace, diff) + str;
	            break;
	        case "both":
	            var half = repeat(replace, Math.ceil(diff / 2));
	            str = (half + str + half).substr(1, len);
	            break;
	        default: // and "right"
	            str = "" + str + repeat(replace, diff);
	    }
	}
	
	return str;
};