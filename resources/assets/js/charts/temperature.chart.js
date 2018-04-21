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
                                " : <strong> Temperature : " + y + "</strong> ");
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

    var initTemperatureChart = function(startDate, endDate) {


        var data1 = [];
        
        var dataset = [
            {
                label: "Temperature",
                data: data1,
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
                axisLabel: "Temperature",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 14,
                axisLabelPadding: 5,
                tickSize: 10
            },
          
          
        };

        $.plot($("#temperature-chart"), dataset, options);        
        $("#temperature-chart").UseTooltip();   

        //check if dosing point chart container exist
        if ( $("#temperature-chart").length < 1) return;

        var sensorId = $('#temperature-dates').attr('data-sensor_id');


        //required fields
        if (_.isUndefined(startDate) || _.isUndefined(endDate) || _.isUndefined(sensorId)) return;

        var params = {
            'start_date' : startDate,
            'end_date' : endDate,
            'sensor_id' : sensorId,
            'field' : 'temperature' //what kind of chart, which has the corresponding field in the db
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
                        label: "Temperature",
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

                $.plot($("#temperature-chart"), dataset, options);    
            }
          
          
        }).catch(function(e) {

        });           
        
    }       


    if ( $("#temperature-chart").length < 1) return;
    

    $('#temperature-dates').datepicker({
        inputs : $('.dp-t-start, .dp-t-end'), 
        format: "yyyy-mm-dd",
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true       
    });    

    $('#temperature-dates .dp-t-start').on('changeDate', function(e) {
        var $this = $(this);
        $this.text($this.datepicker('getFormattedDate'));
        initTemperatureChart($this.datepicker('getFormattedDate'), $('#temperature-dates .dp-t-end').datepicker('getFormattedDate'));

        
    });
 
        //end date
    $('#temperature-dates .dp-t-end').on('changeDate', function(e) {
        var $this = $(this);
        $this.text($this.datepicker('getFormattedDate'));
        initTemperatureChart($('#temperature-dates .dp-t-start').datepicker('getFormattedDate'), $this.datepicker('getFormattedDate'));
        
    });       

    initTemperatureChart( $('#temperature-dates .dp-t-start').datepicker('getFormattedDate'), $('#temperature-dates .dp-t-end').datepicker('getFormattedDate'));
    $(window).resize(function() {
        initTemperatureChart( $('#temperature-dates .dp-t-start').datepicker('getFormattedDate'), $('#temperature-dates .dp-t-end').datepicker('getFormattedDate'));
    });
        

    
});