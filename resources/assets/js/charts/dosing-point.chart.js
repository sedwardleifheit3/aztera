$(function() {
        
    function gd(year, month, day) {
        return new Date(year, month - 1, day).getTime();
    }
    
    var previousPoint = null, previousLabel = null;
    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    
    $.fn.UseTooltip = function () {
        $(this).bind("plothover", function (event, pos, item) {
            if (item) {
                if ((previousLabel != item.series.label) || (previousPoint != item.dataIndex)) {
                    previousPoint = item.dataIndex;
                    previousLabel = item.series.label;
                    $("#tooltip").remove();
                    
                    var x = item.datapoint[0];
                    var y = item.datapoint[1];
                    var date = new Date(x);
                    var color = item.series.color;
    
                    showTooltip(item.pageX, item.pageY, color,
                                "<strong>" + item.series.label + "</strong><br>"  +
                                (date.getMonth() + 1) + "/" + date.getDate() +
                                " : <strong> Dosing rate : " + y + "</strong> ");
                }
            } else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });
    };
    
    function showTooltip(x, y, color, contents) {
        $('<div id="tooltip">' + contents + '</div>').css({
            position: 'absolute',
            display: 'none',
            top: y - 40,
            left: x - 120,
            border: '2px solid ' + color,
            "z-index": "999999999999",
            padding: '3px',
            'font-size': '9px',
            'border-radius': '5px',
            'background-color': '#fff',
            'font-family': 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
            opacity: 0.9
        }).appendTo("body").fadeIn(200);
    }

    var initDosingPointChart  = function(startDate, endDate) {        
        
       var data = [];        
        
        var dataset = [
            {
                label: "Dosing Rate",
                data: data,
                points: { show: true ,radius: 4},
                lines: { 
                    show: true   ,
                    lineWidth:2,
                    fill:true,
                    fillColor: {
                        colors: [{opacity: 0.5}, {opacity: 0.5}]
                    } 
                }
            }
        ];
        
        var options = {
            series: {
                lines: {
                    show: true
                },
                points: {
                    show: true
                },
                shadowSize: 0	// Drawing is faster without shadows
           
            },
            colors: ['#177bbb', '#177bbb'],
            grid: {
                borderWidth: 0,
                hoverable: true,
                clickable: true,
                borderColor: null,
                color: "#177bbb"
            },           
            legend: {
                show: true,
                position: 'nw',
                margin: [15, 0],
            },             
            xaxis: {
                mode: "time",
                position: "bottom",
                timeformat: "%m/%d",
                tickSize: [1    , "day"],
                axisLabel: "Date",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 14,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 15
            },
            yaxis: {     
                axisLabel: "Dosing Rate",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 14,
                axisLabelPadding: 5,
                tickSize: 500
            },
          
          
        };

        $.plot($("#dosing-point-chart"), dataset, options);        
        $("#dosing-point-chart").UseTooltip();   

        //check if dosing point chart container exist
        if ( $("#dosing-point-chart").length < 1) return;

        var sensorId = $('#dosing-point-dates').attr('data-sensor_id');


        //required fields
        if (_.isUndefined(startDate) || _.isUndefined(endDate) || _.isUndefined(sensorId)) return;

        var params = {
            'start_date' : startDate,
            'end_date' : endDate,
            'sensor_id' : sensorId,
            'field' : 'dosing_point' //what kind of chart, which has the corresponding field in the db
        };
        
        var endpoint = '/sensor-readings?' + $.param(params);
        var apiInstance = API.getAxiosInstance();
        apiInstance.get(endpoint).then(function (response) {
            var graphData = [];

            if (response.data) {
                _.forEach(response.data, function(value, index) {
                    var timestamp = new Date(value[0]).getTime();
                    var yaxisValue = parseFloat(value[1]);
                    var newValue = [
                        timestamp,
                        yaxisValue
                    ];
                    graphData.push(newValue);

                });

                //new data set
                var dataset = [
                    {
                        label: "Dosing Rate",
                        data: graphData,
                        points: { show: true ,radius: 4},
                        lines: { 
                            show: true   ,
                            lineWidth:2,
                            fill:true,
                            fillColor: {
                                colors: [{opacity: 0.5}, {opacity: 0.5}]
                            } 
                        }
                    }
                ];

                $.plot($("#dosing-point-chart"), dataset, options);    
            }
          
          
        }).catch(function(e) {

        });          
        
    }  //End init

    if ( $("#dosing-point-chart").length < 1) return;
    

    $('#dosing-point-dates').datepicker({
        inputs : $('.dp-range-start, .dp-range-end'), 
        format: "yyyy-mm-dd",
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true       
    });    

    $('#dosing-point-dates .dp-range-start').on('changeDate', function(e) {
        var $this = $(this);
        $this.text($this.datepicker('getFormattedDate'));
        initDosingPointChart($this.datepicker('getFormattedDate'), $('#dosing-point-dates .dp-range-end').datepicker('getFormattedDate'));

        
    });
 
        //end date
    $('#dosing-point-dates .dp-range-end').on('changeDate', function(e) {
        var $this = $(this);
        $this.text($this.datepicker('getFormattedDate'));
        initDosingPointChart($('#dosing-point-dates .dp-range-start').datepicker('getFormattedDate'), $this.datepicker('getFormattedDate'));
        
    });       

    initDosingPointChart( $('#dosing-point-dates .dp-range-start').datepicker('getFormattedDate'), $('#dosing-point-dates .dp-range-end').datepicker('getFormattedDate'));
    $(window).resize(function() {
        initDosingPointChart( $('#dosing-point-dates .dp-range-start').datepicker('getFormattedDate'), $('#dosing-point-dates .dp-range-end').datepicker('getFormattedDate'));
    });
    
 
});