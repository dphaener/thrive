(function($) {
	var openfitChart = {
		OPENFIT_DATA_URL: "/openfit/api/",
		min: 0,
		max: 0,
		pointInterval: 0,
		zoom: false,
		distanceEnabled: false,
		chartId: "",
		chart: null,
		tracks: null,
		axisSelect1: null,
		axisSelect2: null,
		
		options: {
			idPrefix: "openfit-chart-",
			timespan: true,
			minSize: 10,
			pointThreshold: 20,
		},
		
		init: function(activityId) {
			var self = this;
			
			var params = {
				op: 'get_track_data', 
				actid: activityId, 
		  };
			
			$(this).ajaxError(function(event, jqXHR, ajaxSettings, thrownError) {
				console.error(event);
				console.error(jqXHR);
				console.error(ajaxSettings);
				console.error(thrownError);
			});
			
			$.getJSON(this.OPENFIT_DATA_URL, params, function(response) {
			  
			  var derivedTracks = {
          "speed": {
            "color": "#0000F0",
            "title": "Speed",
            "conversion": {},
            "required": "distance",
            "function" : "_calcSpeed",
            "data": [],
          },
          "pace": {
            "color": "#00F000",
            "title": "Pace",
            "conversion": {},
            "required": "distance",
            "function" : "_calcPace",
            "data": [],
          },
        };
        
				if (response != null) {
				  //if (response.tracks["distance"] != null) response.tracks["distance"] = null;
					try {
						self._updateData(response.tracks, derivedTracks);
						self._createChart(self);
					} catch (err) {
						console.error(err);
					}
				} else {
					console.error("Response was null, cannot proceed.");
				}
			});
		},
		
		updateChart: function(context) {
			
			var placeholder = context.element.find("div.inner"),
			    axisHolder = $(document.body).find("#"+context.chartId+"-globals"),
          xAxis = axisHolder.find("div.xaxis"),
          yAxis = axisHolder.find("div.yaxis"),
          y2Axis = axisHolder.find("div.y2axis"),
  				selectedTracks = context._getSelectedTracks(context),
  				data = new Array(),
  				axisCounter = 0,
  				options = {
            series: {
              lines: {show: true},
              points: {show: false},
            },
            selection: { mode: "x" },
            xaxes: [ { position: "bottom" } ],
            yaxes: [
              { position: "left", }, 
              { position: "right", alignTicksWithAxis: 1 },
            ],
            legend: {
              show: false,
              position: "se",
            },
            grid: {
              show: true,
              aboveData: false,
              clickable: false,
              hoverable: true,
              autoHighlight: true,
            },
          };
			
			$.each(selectedTracks, function(trackType, track) {
				var series = { label: track.title, color: track.color, data: null, yaxis: axisCounter + 1, points: { show: false } };
				
				if (!context.options.timespan) {
          series.data = context._convertToDistance(track.data, context._roundUp(track.start[0], context.pointInterval), context);
        } else {
          series.data = track.data;
        }
        
				if (context.zoom == true) {
					series.data = context._zoomChart(series.data, context.min, context.max);
					if (series.data.length < context.options.pointThreshold) {
						series.points.show = true;
					}
				}
				
				data.push(series);
				
				options.yaxes[axisCounter].axisLabel = track.title;
				if (track.measurement != null) {
          var unit = track.measurement;
          options.yaxes[axisCounter].transform = function(value) {
            return context._convert(value, null, unit);
          };
          options.yaxes[axisCounter].tickFormatter = function(value) {
            return context._convert(value, null, unit).toFixed(2);
          };
          options.yaxes[axisCounter].inverseTransform = function(value) {
            return context._convert(value, unit, null);
          }
          //You must set the transform, tickformatter and inverseTransform functions in the axis even if they are none
          //Otherwise, flot might use the functions from the other axis.
          if (unit.unit_id != "none") {
            options.yaxes[axisCounter].axisLabel = options.yaxes[axisCounter].axisLabel + " (" + unit.unit_symbol + ")";
          }
        }
				axisCounter++;
			});
			
			context.axisCounter = axisCounter;
			//console.log(data);
			
			if (axisCounter > 1) {
				options.legend.show = true;
			}
			
			if (context.options.timespan) {
				options.xaxes[0].axisLabel = "Time (hh:mm:ss)";
				options.xaxes[0].tickFormatter = context._formatTimespan;
			} else if (context.distanceEnabled){
				var unit = context.tracks["distance"].measurement,
					text = unit.from.unit_id == "none" || unit.to.unit_id == "none" ? "Distance" : "Distance ("+unit.to.unit_symbol+")";
				
				options.xaxes[0].axisLabel = text;
				
				options.xaxes[0].transform = function(value) {
					return context._convert(value, unit.from, unit.to);
				};
				options.xaxes[0].tickFormatter = function(value) {
					return context._convert(value, unit.from, unit.to).toFixed(2);
				};
				options.xaxes[0].inverseTransform = function(value) {
					return context._convert(value, unit.to, unit.from);
				}
			} else {
			  console.error("Unknown error.  Distance might be null, or invalid options set.");
			}
			
			placeholder.unbind("plotselected");
			placeholder.bind("plotselected", function(event, ranges) {
			  console.log(ranges);
				var min = 0;
				var max = 0;
				var delta = ranges.xaxis.to - ranges.xaxis.from;
				if (delta < context.options.minSize * context.pointInterval) {
					var pad = Math.floor((context.options.minSize * context.pointInterval - delta)/2);
					min = ranges.xaxis.from - pad;
					max = ranges.xaxis.to + pad;
				} else {
					min = ranges.xaxis.from;
					max = ranges.xaxis.to;
				}
				context.zoom = true;
				context.min = min;
				context.max = max;
				context.updateChart(context);
			});
			
			placeholder.bind("plothover", function(event, pos, item) {
			  
			});
			
			$(window).unbind("resize");
			$(window).resize(function() {
			  context.redrawLabels(context);
			});
			
			context.chart = $.plot(placeholder, data, options);
			
			context.redrawLabels(context);
		},
		
		redrawLabels: function(context) {
		  
		  var placeholder = context.element.find("div.inner"),
          axisHolder = $(document.body).find("#"+context.chartId+"-globals"),
          xAxis = axisHolder.find("div.xaxis"),
          yAxis = axisHolder.find("div.yaxis"),
          y2Axis = axisHolder.find("div.y2axis"),
          graphCoords = placeholder.offset(),
          yAxisCounter = 0;
      
      $.each(context.chart.getAxes(), function(axisName, axis) {
		    var label = axis.options.axisLabel;
		    if (axis.direction == "x") {
		      xAxis.find("span").text(label);
		    } else {
		      if (axis.n == 1) {
		        yAxis.find("span").text(label);
		      } else if (axis.n == 2) {
		        y2Axis.find("span").text(label);
		      } else {
		        console.error("Too Many axes!");
		      }
		      yAxisCounter++;
		    }
		  });
     
      //Added pixel padding to prevent the axis label from colliding with the tick label.
      yAxis.offset({ 
        top: graphCoords.top + placeholder.innerHeight()/2 - yAxis.outerWidth(), 
        left: graphCoords.left - yAxis.outerHeight() - 10 
      }); 
      
      xAxis.offset({
        top: graphCoords.top + placeholder.innerHeight(),
        left: graphCoords.left + placeholder.innerWidth()/2 - xAxis.innerWidth()/2
      });
      
      //There is always an x-axis, so the # of y-axes is getAxes().length - 1 
      if (yAxisCounter == 2) {
        y2Axis.show();
        y2Axis.offset({
          top: graphCoords.top + placeholder.innerHeight()/2 - y2Axis.outerWidth(),
          left: graphCoords.left + placeholder.innerWidth(),
        });
      } else {
        y2Axis.hide();
      }
		},
		
		_create: function() {
			this.chartId = this.element.attr("id");
			$(document.body).append($("<div>", { "id": this.chartId+"-globals" } ));
		},
	  _updateData: function(tracks, derivedTracks) {
      newTracks = {};
      
      for (trackType in tracks) {
        if (tracks[trackType] != null) {
          this.pointInterval = tracks[trackType].interval;
          if (trackType == "distance") this.distanceEnabled = true;
          newTracks[trackType] = this._convertTrack(tracks[trackType]);
        } else {
          console.error("Error processing data, Track Type: "+trackType+" is null.  Ignoring track.");
        }
      }
      
      $.extend(newTracks, this._createDerivedTracks(tracks, derivedTracks));
       console.log(newTracks);
      this.tracks = newTracks;
    },
    
		_createChart: function() {
      this._initializeActionBar();
      this._initializeChart();
      this.updateChart(this);
    },
    
		_createDerivedTracks: function(tracks, derivedTracks) {
		  
		  var requiredTracks = {},
		      createdTracks = {},
		      lastDistance = 0,
		      lastTime = 0;
		  
		  $.each(derivedTracks, function(trackName, track) {
		    if (track.required != null) {
		      createdTracks[trackName] = track;
		      if (requiredTracks[track["required"]] == null) {
		        requiredTracks[track["required"]] = {};
		      }
		      requiredTracks[track["required"]][trackName] = track["function"];
		    }
		  });
		  
		  $.each(requiredTracks, function(trackName, derivedTracks) {
  		  $.each(tracks[trackName].data, function(i, value) {
  		      $.each(derivedTracks, function(targetTrack, functionName) {
  		        var result = openfitChart[functionName](value[0], value[1]);
  		        if (result != null) createdTracks[targetTrack].data.push([value[0], result]);
  		      });
  		  });
		  })
		  
		  return createdTracks;
		},
		
		_calcSpeed: function(time, distance) {
		  arguments.callee.lastTime = arguments.callee.lastTime || 0,
		  arguments.callee.lastDistance = arguments.callee.lastDistance || 0;
		  
		  var speed = null;
		  if ((time - arguments.callee.lastTime) != 0) {
		    speed = (distance - arguments.callee.lastDistance) / (time - arguments.callee.lastTime);
		  }
		  arguments.callee.lastTime = time;
		  arguments.callee.lastDistance = distance;
		  return speed;
		},
		
		_calcPace: function(time, distance) {
		  arguments.callee.lastTime = arguments.callee.lastTime || 0,
      arguments.callee.lastDistance = arguments.callee.lastDistance || 0;
      
      var pace = null;
      if ((distance - arguments.callee.lastDistance) != 0) {
        pace = (time - arguments.callee.lastTime) / (distance - arguments.callee.lastDistance);
      }
      arguments.callee.lastTime = time;
      arguments.callee.lastDistance = distance;
      return pace;
		},
		
		_convertToDistance: function(data, trackStart, context) {
			var distanceTrack = context.tracks["distance"],
			  	distanceData = new Array();
			
			//console.log({ data: data, distanceTrack: distanceTrack.data });
			
			$.each(data, function(i, coords) {
				var distanceIndex = (coords[0] - distanceTrack.start[0])/context.pointInterval;
				
				if (distanceIndex % 1 == 0 && distanceTrack.data[distanceIndex] != null) { //Most common case, time is in distance track
					distanceData.push([distanceTrack.data[distanceIndex][1], coords[1]]);
				} else if (distanceIndex < 0) {  //Special case: time is less than beginning of the distanceTrack
					distanceData.push([distanceTrack.start[1], coords[1]]);
				} else if (coords[0] > distanceTrack.end[0]) {  //Special case: time is greater than end of distanceTrack
					distanceData.push([distanceTrack.end[1], coords[1]]);
				} else if (distanceIndex % 1 != 0){ //Special case: Point lies between two intervals
					distanceData.push([context._interpolate(coords[0], trackStart, context), coords[1]]);
				} else { //Log as error and drop silently.
					console.error("Could not find distance for given point: "+coords+" index: "+distanceIndex);
				}
			});
			return distanceData;
		},
		
		_interpolate: function(timeValue, trackStart, context) {
			//console.log("timeValue: "+timeValue+" trackStart: "+trackStart);
			var distanceTrack = context.tracks["distance"],
				indexAprox = (timeValue - distanceTrack.start[0])/context.pointInterval;
			
			//Prevent negative indexing
			if (indexAprox < 0) return distanceTrack.start[0];
			
			var	lowerIndex = Math.floor(indexAprox),
  				upperIndex = Math.ceil(indexAprox),
  				lower = { time: distanceTrack.data[lowerIndex][0], distance: distanceTrack.data[lowerIndex][1] },
  				upper = { time:distanceTrack.data[upperIndex][0], distance: distanceTrack.data[upperIndex][1] },
  				timeDelta = upper.time - lower.time,
  				distanceDelta = upper.distance - lower.distance;
			
			if (lowerIndex == upperIndex) return distanceTrack.data[lowerIndex];
			
			return lower.distance + (timeValue - lower.time) * (distanceDelta/timeDelta);
		},
		
		_initializeActionBar: function() {
			var self = this,
				settings = $("<div>", { "class": "chart-settings" }),
				actionBar = $("<div>", {
					"class": "ui-widget-header action-bar",
				}),
				formatSelect = $("<select>", {
					"class": "format",
					"html": "<option value='timespan'>Timespan</option>" +
							(this.distanceEnabled ? "<option value='distance'>Distance</option>" : "")
				});
			
			formatSelect.change(function() {
				self.options.timespan = $(this).val() == "timespan" ? true : false;
			});
			
			settings.append($("<span>", { "text": "X-Axis Format" }), formatSelect);
			
			$("#"+self.chartId+"-globals").append(settings);
			
			settings.dialog({
				title: "Openfit Chart Settings",
				autoOpen: false,
				modal: false,
				draggable: false,
				resizable: false,
				height: 100,
				open: function() {
					$(this).find(".format").selectmenu({ width: 150 });
				},
				close: function() {
					$(this).find(".format").selectmenu('destroy');
					self.updateChart(self);
				}
			});
			
			self.element.append(actionBar);
			
			var updateChart = function() {
				self.updateChart(self);
			}
			
			actionBar.append($("<select>", { "class": "axis-select axis-1" }).change(updateChart));
			actionBar.append($("<select>", { "class": "axis-select axis-2" }).change(updateChart));
			
			actionBar.append($("<button>", { 
				"class": "button", 
				"click": function() { 
					self._resetZoom(self); 
				}
			}).button( { text: false, icons: { primary: "ui-icon-arrow-4-diag" } } ));
			
			actionBar.append($("<button>", {
				"class": "button",
				"click": function() {
					if (settings.dialog('isOpen')) {
						settings.dialog('close');
					} else {
						settings.dialog('open');
					}
				}
			}).button( { label: "Settings", icons: { primary: "ui-icon-gear" } } ));
			
			$("#"+self.chartId).find(".axis-select").each(function(i, element) {
				var select = $(element),
					selected = null;
				
				select.append($("<option>", { val: "", text: select.hasClass("axis-1") ? "Axis 1" : "Axis 2" }));
				
				$.each(self.tracks, function(trackType, track) {
					if (selected == null && select.hasClass("axis-1")) selected = trackType;
					var o = $("<option>", {
						val: trackType,
						text: track.title,
					});
					o.data("color", track.color);
					select.append(o);
				});
				
				if (selected != null) {	
					select.val(selected);
				} else {
					select.val("");
				}
				select.hasClass("axis-1") ? 
					self.axisSelect1 = select.selectmenu({width: 150}) 
						: self.axisSelect2 = select.selectmenu({width: 150}); 
			});
		},
		
		_getSelectedTracks: function(context) {
			var selected1 = context.axisSelect1.selectmenu('value'),
				selected2 = context.axisSelect2.selectmenu('value'),
				selectedTracks = {};
			
			if (selected1 != null && selected1 != "") {
				selectedTracks[selected1] = context.tracks[selected1];
			}
			
			if (selected2 != null && selected2 != "") {
				if (selected1 == selected2) {
					context.axisSelect2.selectmenu('value', "");
				} else {
					selectedTracks[selected2] = context.tracks[selected2];
				}
			}
			return selectedTracks;
		},
		
		_initializeChart: function() {
			var placeholder = $("<div>", { "class": "inner" }),
				xAxis = $("<div>", { "class": "xaxis", "html": "<span></span>" }),
				yAxis = $("<div>", { "class": "vertical yaxis", "html": "<span></span>" }),
				y2Axis = $("<div>", { "class": "vertical y2axis", "html": "<span></span>" });
			
			this.element.append(placeholder);
			$(document.body).find("#" + this.chartId + "-globals").append(yAxis, y2Axis, xAxis);
			// $(window).resize({ context: this }, function(event) {
        // var context = event.data.context;
        // if (context.chart != null) {
//           
        // }
			// });
		},
		
		_resetZoom: function(context) {
			context.zoom = false;
			context.min = 0;
			context.max = 0;
			context.updateChart(context);
		},
		
		_zoomChart: function(data, min, max) {
			var zoomed = new Array();
			for (var i = 0; i < data.length; i ++) {
				if (data[i][0] >= min && data[i][0] <= max) {
					zoomed.push(data[i]);
				}
			}
			return zoomed;
		},
		
		_quantize: function(data, sample_rate) {
		    quantization = new Array();
		    for (var i = 0; i < data.length; i += sample_rate) {
		      quantization.push(data[i]);
		    }
		    return quantization;
		},
		
		_nearestPow2: function(n) {
			return Math.pow(2, Math.ceil(Math.log(n)/Math.log(2)));
		},
		
		_formatTimespan: function(value, axis) {
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
			
		  hours = (hours > 0) ? openfitChart._str_pad(hours, "0", hour_digits, "left") + ":" : "";
			minutes = (minutes >= 0 || hours >= 0) ? openfitChart._str_pad(minutes, "0", minute_digits, "left") + ":" : "";
			seconds = (seconds >= 0 || minutes >= 0 || hours >= 0) ? openfitChart._str_pad(seconds, "0", second_digits, "left") : "";
			
			return sign + hours + minutes + seconds;
		},
		
		_str_pad: function(str, ch, len, dir) {
      str = str || "";
      str = (typeof str == "string") ? str : String(str);
      len = (typeof len == "number") ? len : 0;
      ch = (typeof ch == "string") ? ch : " ";
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
                  str = "" + repeat(ch, diff) + str;
                  break;
              case "both":
                  var half = repeat(ch, Math.ceil(diff / 2));
                  str = (half + str + half).substr(1, len);
                  break;
              default: // and "right"
                  str = "" + str + repeat(ch, diff);
          }
      }
      
      return str;
    },
		
		_convertTrack: function(track) {
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
			
			if (start % track.interval != 0) {
				start = this._roundUp(start, track.interval);
			} else {
				start += track.interval;
			}
			
			for (var i = 0; i < track.data.length; i++) {
				//Pass through data that already has an x and y
				if (track.data[i].length == null) {
					converted.push([Number(track.interval)*i + start, track.data[i]]);
				} else {
					converted.push(track.data[i]);
				}
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
		},
		
		_convert: function(value, unitFrom, unitTo) {
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
		    
		    return value;
		},
		
		_roundUp: function(numToRound, multiple) {
			if (numToRound == 0) return numToRound + multiple;
			if(multiple == 0) return numToRound;
			var remainder = numToRound % multiple; 
			
			if (remainder == 0) return numToRound;
			return numToRound + multiple - remainder; 
		}, 
		
		destroy: function() {
			this.chartId = null;
		},
		
		_setOption: function(option, value) {
			$.Widget.prototype._setOption.apply(this, arguments);
		}
	}
	$.widget("ui.openfitChart", openfitChart);
})(jQuery);