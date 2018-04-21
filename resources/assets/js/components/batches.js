
$(function () {

    /**
     *
     *  Format last column (Action/Operation)
     * @param value
     * @param row
     * @param index
     * @returns {string}
     */
    function operateFormatter(value, row, index) {
        if (_.isUndefined(API_KEY) || _.isEmpty(API_KEY)) return '';
        var operationCtrl = "";

        var editButton = [
            '<a class="batches-edit-btn btn btn-mint btn-icon"  href="/batches/' + row.batch_id + '/edit" title="Edit">',
            'Edit',
            '</a>  '
        ];

        var deleteBtn = [
            '<a class="batches-delete-btn btn btn-icon btn-dark " href="javascript:void(0)" title="archive">',
            'Archive',
            '</a>'            
        ];

        var restoreBtn = [
            '<a class="batches-restore-btn btn btn-icon btn-dark " href="javascript:void(0)" title="restore">',
            'Unarchive',
            '</a>'        
        ];

        // IS_ADMIN is declared in app layout
        //accessible by admin only
        if (IS_ADMIN) {
           operationCtrl = editButton.join('');       
            // do not allow to edit if sensor is attached
            if (!_.isNull(row.sensor_state_id) && _.isNull(row.is_archived)) {
                operationCtrl = deleteBtn.join('');  
            } else if (!_.isNull(row.is_archived)) {    
                operationCtrl = restoreBtn.join('');  
            } else {
                operationCtrl += deleteBtn.join('');  
            }                      
        }
        
        return operationCtrl;
    }

    /**
     *  Add operate/action events
     *  @supports Edit and Block/UnBlock Operations
     * @type {{click .like: Function, click .remove: Function}}
     */
    window.operateEvents = {
        'click .batches-delete-btn': function (e, value, row, index) {

            bootbox.confirm({
                size: 'small',
                title: "Archive",
                buttons: {
                    confirm: {
                        label: "Yes"
                    },
                    cancel: {
                        label: "No"
                    }
                },                    
                message: 'Are you sure you want to archive this batch?',
                callback: function (result) {
                    if (result) {

                        var endpoint = '/batches/' + row.batch_id;
                        var apiInstance = API.getAxiosInstance();

                        apiInstance.delete(endpoint).then(function (response) {
                            if (response.data) {
                                $.niftyNoty({
                                    type: 'success',
                                    icon: 'pli-like-2 icon-2x',
                                    message: 'Batch successfully archived.',
                                    container: 'floating',
                                    timer: 3000
                                });
                            }
                        });

                        $table.bootstrapTable('remove', {
                            field: 'id',
                            values: [row.id]
                        });

                    } else {
                        $.niftyNoty({
                            type: 'danger',
                            icon: 'pli-cross icon-2x',
                            message: 'Cancelled.',
                            container: 'floating',
                            timer: 5000
                        });
                    }
                    ;

                }
            });
        },
        'click .batches-restore-btn': function (e, value, row, index) {

            bootbox.confirm({
                size: 'small',
                title: "Unarchive",
                buttons: {
                    confirm: {
                        label: "Yes"
                    },
                    cancel: {
                        label: "No"
                    }
                },                    
                message: 'Are you sure you want to unarchive this batch?',
                callback: function (result) {
                    if (result) {

                        var endpoint = '/batches/' + row.batch_id + '?restore=true';
                        var apiInstance = API.getAxiosInstance();

                        apiInstance.delete(endpoint).then(function (response) {
                            if (response.data) {
                                $.niftyNoty({
                                    type: 'success',
                                    icon: 'pli-like-2 icon-2x',
                                    message: 'Batch successfully restored.',
                                    container: 'floating',
                                    timer: 3000
                                });
                            }
                        });

                        $table.bootstrapTable('remove', {
                            field: 'id',
                            values: [row.id]
                        });

                    } else {
                        $.niftyNoty({
                            type: 'danger',
                            icon: 'pli-cross icon-2x',
                            message: 'Cancelled.',
                            container: 'floating',
                            timer: 5000
                        });
                    }
                    ;

                }
            });
        },        
    };

    /**
     *  Initialise Users/Staffs list
     *
     *  Bootstrap table
     * @type {*|jQuery|HTMLElement}
     */
    const $table = $('#batches-table');

    $table.bootstrapTable({
        url: '/api/v1/batches',
        pagination: true,
        sidePagination: "server",
        sortOrder: 'desc',
        search: true,
        dataField: 'data',
        showFooter: false,
        sortName: 'id',
        pageNumber: 1,
        pageSize : 25,
        pageList: [25,50,100],
        queryParamsType: 'limit',
        showColumns: true,        
        queryParams: function(params) {
            var options = $table.bootstrapTable('getOptions');
            var isArchived = ($('#is-archived-checkbox').is(":checked")) ? 1 : 0;

            params['is_archived'] = isArchived;

            //include page number in get query param to enable laravel's pagination by page
            if (!_.isUndefined(options.pageNumber)) {
                params['page'] = options.pageNumber;
            }

            return params;
        },
        ajaxOptions: {
            headers: {
                'Authorization': ' Bearer ' + API_KEY,
                'Accept': ' application/json'
            }
        },
        columns: [
            {
                field: 'id',
                title: 'ID',
                sortable: true,   
                width: '100',  
                switchable: false           
            },
            {
                field: 'sensor_state_id',
                title: '',
                width: '100',
                sortable: false,
                switchable: false,
                formatter: function(value, row, index) {                    
                    
                    if (_.isNull(value) || _.isUndefined(value))  return "";
                    var statusString = "";

                    var statuses = value;
                    var statusName = row.sensor_state_name;
    
                    var statusString = "";
                    
                    //show first sensor status only
                    var colorStatus = 'default';
    
                    label = (_.isUndefined(statusName)) ? "Idle" : statusName;

                    if (statuses == 2) {
                        colorStatus = 'success';
                    } else if (statuses == 3 ) {
                        colorStatus = 'warning';
                    } else if (statuses >= 4) {
                        colorStatus = 'danger';
                    }

                    statusString += '<button class=" btn btn-' + colorStatus + ' btn-rounded">' + label + '</button>';
                    return statusString;

                    /*
                    //@supports for group concat, which means multiple sensor attached
                
                    var statuses = value.split(',');
                    var statusName = row.sensor_state_name.split(',');
    
                    var statusString = "";
                    
                    //show first sensor status only
                    var colorStatus = 'default';
    
                    label = (_.isUndefined(statusName[0])) ? "Idle" : statusName[0];

                    if (statuses[0] == 2) {
                        colorStatus = 'success';
                    } else if (statuses[0] == 3 ) {
                        colorStatus = 'warning';
                    } else if (statuses[0] >= 4) {
                        colorStatus = 'danger';
                    }

                    statusString += '<button class=" btn btn-' + colorStatus + ' btn-rounded">' + label + '</button>';
                    */
                    /*
                    // multi sensor support
                    $.each(statuses, function(i, status) {
    
                            var colorStatus = 'default';
    
                            label = (_.isUndefined(statusName[i])) ? "Idle" : statusName[i];
    
                            if (status == 2) {
                                colorStatus = 'success';
                            } else if (status == 3 ) {
                                colorStatus = 'warning';
                            } else if (status >= 4) {
                                colorStatus = 'danger';
                            }
    
                            statusString += '<button class=" mar-top btn btn-' + colorStatus + ' btn-rounded">' + label + '</button>';
    
                    });
                    */
    
                   
                    

                }
            },            
            {
                field: 'wine_id',
                title: 'Wine ID',
                sortable: true,
                switchable: true,
                visible: true
            },
            {
                field: 'vintage',
                title: 'Vintage',
                sortable: true,
                switchable: true,
                visible: false
            },
            {
                field: 'varietal',
                title: 'Varietal',
                switchable: true,
                sortable: true,
                visible: false
            },
            {
                field: 'tank',
                title: 'Tank',
                switchable: true,
                sortable: true,
                visible: false
            },
            {
                field: 'dose_end',
                title: 'Time Remaining',
                sortable: false,
                switchable: false,
                visible: false,
                formatter: function(value, row, index) {

                    //if deleted && dose_start is empty or null
                    if (!_.isNull(row.deleted_at)) return "";

                    if (_.isEmpty(value) || _.isNull(value)) return "";

                    if (_.isUndefined(row.sensor_state_name) || _.isNull(row.sensor_state_name)) return "";

                    return '<span class="countdown">' + moment(value).format('YYYY/MM/DD hh:mm:ss') + '</span>';
                }                
            },
            
            {
                field: 'operate',
                title: '',
                align: 'center',
                width: '150',
                switchable: false,
                events: operateEvents,
                formatter: operateFormatter
            }
        ]

    });

    // sometimes footer render error.
    setTimeout(function () {
        $table.bootstrapTable('resetView');
    }, 200);

    //is blocked checkbox
    $('#is-archived-checkbox').on('change', function(e) {
        $table.bootstrapTable('refresh');
    });

    $table.on('click-cell.bs.table', function (	field, value, row, $element) {

        if (value == 'operate') return;

        if (!_.isUndefined($element.id)) {
            if (!_.isNull($element.is_archived) ) {
                return
            };

            window.location.href= "/batches/" + $element.batch_id;
        }   
    });

    $table.on('load-success.bs.table', function(){
        //time remaining
       $('.countdown').each(function(index){
           var $text = $(this).text();
           $(this).countdown($text  , function(event) {
                $(this).text(
                event.strftime('%D days %H:%M:%S')
                );
            });
       });
    });

    $('.batch-archive-btn').on('click', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-batch-id');
        if (id) {
            bootbox.confirm({
                size: 'small',
                message: 'Are you sure you want to archive this batch?',
                callback: function (result) {
                    if (result) {
    
                        var endpoint = '/batches/' + id;
                        var apiInstance = API.getAxiosInstance();
                        
                        apiInstance.delete(endpoint).then(function (response) {
                            if (response.data) {
                                $.niftyNoty({
                                    type: 'success',
                                    icon: 'pli-like-2 icon-2x',
                                    message: 'Batch successfully updated.',
                                    container: 'floating',
                                    timer: 3000
                                });
                                window.location.href= "/";
                            }
                        });
    
    
                    } else {
                        $.niftyNoty({
                            type: 'danger',
                            icon: 'pli-cross icon-2x',
                            message: 'Cancelled.',
                            container: 'floating',
                            timer: 5000
                        });
                    }
                    ;
    
                }
            });   
        }

    });



   /**
    * 
    * MODALS
    */

    // BOOTBOX - CUSTOM HTML FORM
    // =================================================================
    // Require Bootbox
    // http://bootboxjs.com/
    // =================================================================

    $('#batch-analysis-modal').on('show.bs.modal', function (e) {
        var $this = $(this);
            $form = $this.find('#batch-analysis-form');
        
        $("#save-batch-analysis-btn").on("click", function(e) {
            e.preventDefault();
            var $this = $(this);
            var batch_id = $this.attr('data-batch-id');
            var endpoint = '/batch-analyses/' + batch_id;
            var apiInstance = API.getAxiosInstance();
            apiInstance.patch(endpoint,$form.serialize()).then(function (response) {
                if (response.data) {
                    $('#batch-analysis-modal').modal('hide');                    
                    $.niftyNoty({
                        type: 'success',
                        icon: 'pli-like-2 icon-2x',
                        message: 'Batch Anaylsis successfully updated.',
                        container: 'floating',
                        timer: 3000
                    });
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                }
            }).catch(function(e) {
                $('#batch-analysis-modal').modal('hide');                
                $.niftyNoty({
                    type: 'error',
                    icon: 'pli-like-2 icon-2x',
                    message: 'Unable to update batch analysis. Please try again later.',
                    container: 'floating',
                    timer: 3000
                });                
            });   
        });
    });

    $("#save-batch-analysis-btn")
    /*
    $('#sensors-form').on('click', function(){
        bootbox.dialog({
            title: "Attach Sensor",
            message: $('#sensors-modal').html(),
            buttons: {
                success: {
                    label: "Save",
                    className: "btn-success",
                    callback: function() {
                        
                        var name = $('#name').val();
                        var answer = $("input[name='awesomeness']:checked").val();
                        
                        $.niftyNoty({
                            type: 'purple',
                            icon : 'fa fa-check',
                            message : "Hello " + name + ".<br> You've chosen <strong>" + answer + "</strong>",
                            container : 'floating',
                            timer : 4000
                        });
                    }
                }
            }
        });

        $(".demo-modal-radio").niftyCheck();
    });
    */


    /**
     * SENSOR COMMAND CONTROLS
     * =============================================
     */

    /**
     * Sensor Attach/Migrate
     * ==============================
     */
    $('.sensor-migrate-btn, .sensor-attach-btn').on('click', function(e){
        e.preventDefault();
        var $this = $(this),
            batch_id = $this.attr('data-batch-id'),
            sensor_id = $this.attr('data-sensor-id');      
            
        if (_.isUndefined(batch_id) && _.isUndefined(sensor_id)) return false;


        var endpoint = '/sensors/' + sensor_id;
        var apiInstance = API.getAxiosInstance();
        
        apiInstance.patch(endpoint,{
            'batch_id' : batch_id
        }).then(function (response) {
            if (response.data) {
                $.niftyNoty({
                    type: 'success',
                    icon: 'pli-like-2 icon-2x',
                    message: 'Sensor successfully updated.',
                    container: 'floating',
                    timer: 3000
                });
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            }
        }).catch(function(e) {
            console.log(e);
        });        
    });

    /**
     * Sensor Detach
     * ======================================
     */
    $('.sensor-detach-btn').on('click', function(e) {
        e.preventDefault();
        var $this = $(this),
            sensor_id = $this.attr('data-sensor-id');      
            
        if (_.isUndefined(sensor_id)) return false;

        bootbox.confirm({
            title: "Detach Sensor",
            size: 'small',
            message: 'Are you sure you want to detach this sensor?',
            buttons: {
                confirm: {
                    label: "Yes"
                },
                cancel: {
                    label: "No"
                }
            },
            callback: function (result) {
                if (result) {

                    var endpoint = '/sensors/' + sensor_id;
                    var apiInstance = API.getAxiosInstance();
                    
                    apiInstance.patch(endpoint,{
                        'batch_id' : ""
                    }).then(function (response) {
                        if (response.data) {
                            $.niftyNoty({
                                type: 'success',
                                icon: 'pli-like-2 icon-2x',
                                message: 'Sensor successfully detached.',
                                container: 'floating',
                                timer: 3000
                            });

                            $this.closest('div.panel').fadeOut();
                        }
                    }).catch(function(e) {
                        console.log(e);
                    });        
                } 
            }
        });   
    });

    /**
     * For all senson command control
     * @since, we can not get Auth::id() in API because we bypassed the Auth process,
     * We need to pass the user_id in every request
     *  @todo get the user_id in layout and make it universal across JS scripts
     * 
     */

    //sensor fill button
    $('.sensor-fill-btn').on('click', function(e) {
        e.preventDefault();
        var $this = $(this),
            sensor_id = $this.attr('data-sensor-id'),
            user_id = $this.attr('data-user-id');                                      
            
        if (_.isUndefined(sensor_id)) return false;

        bootbox.confirm({
            title: "Fill",
            size: 'small',
            buttons: {
                confirm: {
                    label: "Yes"
                },
                cancel: {
                    label: "No"
                }
            },            
            message: 'Are you sure you want to fill its dosing line?',
            callback: function (result) {
                if (result) {

                    var endpoint = '/sensor-commands';
                    var apiInstance = API.getAxiosInstance();
                    
                    apiInstance.post(endpoint,{
                        'command_type' : 1,
                        "sensor_id": sensor_id,
                        "user_id": user_id
                    }).then(function (response) {
                        if (response.data) {
                            $.niftyNoty({
                                type: 'success',
                                icon: 'pli-like-2 icon-2x',
                                message: 'You have successfully filled the dosing line.',
                                container: 'floating',
                                timer: 3000
                            });
                            setTimeout(function() {
                                window.location.reload();
                            }, 1300);                            
                        }
                    }).catch(function(e) {
                        console.log(e);
                    });     
                } 
            }
        });   
    });

    //sensor empty button
    $('.sensor-empty-btn').on('click', function(e) {
        e.preventDefault();
        var $this = $(this),
            sensor_id = $this.attr('data-sensor-id'),
            user_id = $this.attr('data-user-id');                    
            
        if (_.isUndefined(sensor_id)) return false;

        bootbox.confirm({
            title: "Empty",
            size: 'small',
            buttons: {
                confirm: {
                    label: "Yes"
                },
                cancel: {
                    label: "No"
                }
            },            
            message: 'Are you sure you want to empty its dosing line?',
            callback: function (result) {
                if (result) {

                    var endpoint = '/sensor-commands';
                    var apiInstance = API.getAxiosInstance();
                    
                    apiInstance.post(endpoint,{
                        'command_type' : 2,
                        "sensor_id": sensor_id,
                        "user_id" : user_id
                    }).then(function (response) {
                        if (response.data) {
                            $.niftyNoty({
                                type: 'success',
                                icon: 'pli-like-2 icon-2x',
                                message: 'You have successfully emptied the dosing line.',
                                container: 'floating',
                                timer: 3000
                            });
                            setTimeout(function() {
                                window.location.reload();
                            }, 1300);                            
                            
                        }
                    }).catch(function(e) {
                        console.log(e);
                    });      
                    
                } 
            }
        });   
    });    
    
    //sensor start button
    $('.sensor-start-btn').on('click', function(e) {
        e.preventDefault();
        var $this = $(this),
            sensor_id = $this.attr('data-sensor-id'),
            user_id = $this.attr('data-user-id');                
            
        if (_.isUndefined(sensor_id)) return false;

        bootbox.confirm({
            title: "Start",
            size: 'small',
            buttons: {
                confirm: {
                    label: "Yes"
                },
                cancel: {
                    label: "No"
                }
            },            
            message: 'Are you sure you want to start dosing?',
            callback: function (result) {
                if (result) {

                    var endpoint = '/sensor-commands';
                    var apiInstance = API.getAxiosInstance();
                    
                    apiInstance.post(endpoint,{
                        'command_type' : 4,
                        "sensor_id": sensor_id,
                        "user_id" : user_id         
                    }).then(function (response) {
                        if (response.data) {
                            $.niftyNoty({
                                type: 'success',
                                icon: 'pli-like-2 icon-2x',
                                message: 'You have successfully started dosing.',
                                container: 'floating',
                                timer: 3000
                            });
                            setTimeout(function() {
                                window.location.reload();
                            }, 1300);                            
                            
                        }
                    }).catch(function(e) {
                        console.log(e);
                    });     
                    
                } 
            }
        });   
    });      

    //sensor stop button
    $('.sensor-stop-btn').on('click', function(e) {
        e.preventDefault();
        var $this = $(this),
            sensor_id = $this.attr('data-sensor-id'),
            user_id = $this.attr('data-user-id');

        if (_.isUndefined(sensor_id)) return false;

        bootbox.confirm({
            title: "Stop",
            size: 'small',
            buttons: {
                confirm: {
                    label: "Yes"
                },
                cancel: {
                    label: "No"
                }
            },            
            message: 'Are you sure you want to stop dosing?',
            callback: function (result) {
                if (result) {

                    var endpoint = '/sensor-commands';
                    var apiInstance = API.getAxiosInstance();
                    
                    apiInstance.post(endpoint,{
                        'command_type' : 5,
                        "sensor_id": sensor_id,
                        "user_id" : user_id                                                
                    }).then(function (response) {
                        if (response.data) {
                            $.niftyNoty({
                                type: 'success',
                                icon: 'pli-like-2 icon-2x',
                                message: 'You have successfully stopped dosing.',
                                container: 'floating',
                                timer: 3000
                            });
                            setTimeout(function() {
                                window.location.reload();
                            }, 1300);                            
                            
                        }
                    }).catch(function(e) {
                        console.log(e);
                    });     
                    
                } 
            }
        });   
    });     
    
    //sensor pause button
    $('.sensor-pause-btn').on('click', function(e) {
        e.preventDefault();
        var $this = $(this),
            sensor_id = $this.attr('data-sensor-id'),
            user_id = $this.attr('data-user-id');
            
        if (_.isUndefined(sensor_id)) return false;

        bootbox.confirm({
            title: "Pause",
            size: 'small',
            buttons: {
                confirm: {
                    label: "Yes"
                },
                cancel: {
                    label: "No"
                }
            },            
            message: 'Are you sure you want to pause dosing?',
            callback: function (result) {
                if (result) {

                    var endpoint = '/sensor-commands';
                    var apiInstance = API.getAxiosInstance();
                    
                    apiInstance.post(endpoint,{
                        'command_type' : 6,
                        "sensor_id": sensor_id,
                        "user_id" : user_id                        
                    }).then(function (response) {
                        if (response.data) {
                            $.niftyNoty({
                                type: 'success',
                                icon: 'pli-like-2 icon-2x',
                                message: 'You have successfully paused dosing.',
                                container: 'floating',
                                timer: 3000
                            });
                            setTimeout(function() {
                                window.location.reload();
                            }, 1300);                            
                            
                        }
                    }).catch(function(e) {
                        console.log(e);
                    });    
                    
                } 
            }
        });   
    });      
    
});