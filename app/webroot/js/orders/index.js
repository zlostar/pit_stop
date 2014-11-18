$(function() {
    //datepicker
   $( ".datepicker" ).datepicker({ 
       dateFormat: 'yy-mm-dd',
       defaultDate: new Date(jsVars.date),
       onSelect: function(dateText){
            window.location.href = '/Orders/index/'+dateText;
        }
   });
});
