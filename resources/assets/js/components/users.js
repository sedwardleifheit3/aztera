$(function () {

    // - CONFIRM MODAL
    // @require href / link for action
    // @example href="/users/delete" , executes via redirect or ajax request
    // =================================================================
    // Require Bootbox
    // http://bootboxjs.com/
    // =================================================================

    /**
     *
     *  Format last column (Action/Operation)
     * @param value
     * @param row
     * @param index
     * @returns {string}
     */
    function operateFormatter(value, row, index) {

        var operationCtrl = [
            '<a class="user-edit-btn btn btn-mint btn-icon"  href="/users/' + row.id + '/edit" title="Edit">',
            '<i class="psi-pen-5 icon-lg"></i>',
            '</a>  ',
            '<a class="user-delete-btn btn btn-icon btn-dark " href="javascript:void(0)" title="remove">',
            '<i class="psi-file-trash icon-lg">',
            '</a>'
        ];
 
        return operationCtrl.join('');
    }

    /**
     *  Add operate/action events
     *  @supports Edit and Block/UnBlock Operations
     * @type {{click .like: Function, click .remove: Function}}
     */
    window.operateEvents = {
        'click .user-delete-btn': function (e, value, row, index) {

            bootbox.confirm({
                size: 'small',
                message: 'Are you sure?',
                callback: function (result) {
                    if (result) {

                        var endpoint = (!_.isNull(row.deleted_at)) ? '/users/' + row.id + '?restore=true' : '/users/' + row.id;
                        var apiInstance = API.getAxiosInstance();

                        apiInstance.delete(endpoint).then(function (response) {
                            if (response.data) {
                                $.niftyNoty({
                                    type: 'success',
                                    icon: 'pli-like-2 icon-2x',
                                    message: 'User successfully removed',
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
        }
    };

    /**
     *  Initialise Users/Staffs list
     *
     *  Bootstrap table
     * @type {*|jQuery|HTMLElement}
     */
    const $table = $('#users-table');
    var apiKey = (_.isUndefined(API_KEY)) ? '' : API_KEY;
    $table.bootstrapTable({
        url: '/api/v1/users',
        pagination: true,
        sidePagination: "server",
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

            //include page number in get query param to enable laravel's pagination by page
            if (!_.isUndefined(options.pageNumber)) {
                params['page'] = options.pageNumber;
            }

            return params;
        },
        ajaxOptions: {
            headers: {
                'Authorization': ' Bearer ' + apiKey,
                'Accept': ' application/json'
            }
        },
        columns: [
            {
                field: 'name',
                title: 'Name',
                sortable: true,
                switchable: false      
            },
            {
                field: 'email',
                title: 'Email',
                sortable: true,
                switchable: false      
            },
            {
                field: 'roles',
                title: 'Role',
                sortable: false,
                switchable: true,      
                visible: false,
                formatter: function(value, row) {
                    return (!_.isUndefined(value[0])) ? value[0]['name'] : "Basic User";
                }                
            },
            {
                field: 'operate',
                title: '',
                align: 'center',
                width: '150',
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
    $('#is-blocked-checkbox').on('change', function(e) {
        $table.bootstrapTable('refresh');
    });


});