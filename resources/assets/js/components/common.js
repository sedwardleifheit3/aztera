
//Bootstrap Table defaults
jQuery.fn.bootstrapTable.defaults.icons = {
    paginationSwitchDown: 'pli-arrow-down',
    paginationSwitchUp: 'pli-arrow-up',
    refresh: 'pli-repeat-2',
    toggle: 'pli-layout-grid',
    columns: 'pli-check',
    detailOpen: 'psi-add',
    detailClose: 'psi-remove'
};

$(document).ready(function() {

    //input mask
    $('input.ip-address-input').mask('099.099.099.099');
    
    //countdown
    $('.countdown').each(function(index){
        var $text = $(this).text();
        $(this).countdown($text  , function(event) {
             $(this).text(
             event.strftime('%D days %H:%M:%S')
             );
         });
    });    

   //alert auto remove /fadeout
   if ($('.alert').length > 0)  {
       setTimeout(function(){
        $('.alert').fadeOut();
       },2000);
   }
console.log($('.app-container').length );
   if ($('.app-container').length > 0) {

    var endpoint = '/sensor-states';
    var apiInstance = API.getAxiosInstance();
    
    apiInstance.get(endpoint).then(function (response) {
        if (response.data) {
 
             _.forEach(response.data, function(value, key) {
                 $.niftyNoty({
                     type: 'danger',
                     icon: 'pli-like-2 icon-2x',
                     message: 'Sensor ID #' + value.sensor_id + " - " + value.state.name + " (" + value.state.description + ")",
                     container: 'floating',
                     timer: 0
                 });
 
             });
           
        }
    }); 
   }
});
