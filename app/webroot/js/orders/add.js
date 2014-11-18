var serviceLastRow = 0;

var addService = function() {
    serviceLastRow++;
    $("#services #service0").clone(true).attr('id', 'service' + serviceLastRow).show().insertBefore("#services #trAdd");
    $("#service" + serviceLastRow + " .remove_service").attr('onclick', 'removeService(' + serviceLastRow + ')');
    $("#service" + serviceLastRow + " input:first").attr('name', 'data[Service][' + serviceLastRow + '][service_description]').attr('id', 'service_description_' + serviceLastRow);
    $("#service" + serviceLastRow + " input:eq(1)").attr('name', 'data[Service][' + serviceLastRow + '][service_count]').attr('id', 'service_count_' + serviceLastRow);
    $("#service" + serviceLastRow + " input:eq(2)").attr('name', 'data[Service][' + serviceLastRow + '][service_price]').attr('id', 'service_price_' + serviceLastRow);
    $("#service" + serviceLastRow + " select:first").attr('name', 'data[Service][' + serviceLastRow + '][services_employees]').attr('id', 'services_employees_' + serviceLastRow);
};

var removeService = function(x) {
    $("#service" + x).remove();
};

var partLastRow = 0;

var addPart = function() {
    partLastRow++;
    $("#parts #part0").clone(true).attr('id', 'part' + partLastRow).show().insertBefore("#parts #trAdd");
    $("#part" + partLastRow + " button").attr('onclick', 'removePart(' + partLastRow + ')');
    $("#part" + partLastRow + " input:first").attr('name', 'data[Part][' + partLastRow + '][part_description]').attr('id', 'part_description_' + partLastRow);
    $("#part" + partLastRow + " input:eq(1)").attr('name', 'data[Part][' + partLastRow + '][part_count]').attr('id', 'part_count_' + partLastRow);
    $("#part" + partLastRow + " input:eq(2)").attr('name', 'data[Part][' + partLastRow + '][part_price]').attr('id', 'part_price_' + partLastRow);
};

var removePart = function(x) {
    $("#part" + x).remove();
};

var addEmployeeToService = function() {
    $('.add_employee').click(function() {
        var td = $(this).parent();
        var selected = $(this).prev().children(':selected').val();
        var selected_name = $(this).prev().children(':selected').text();
        var select_name = $(this).prev().attr('name');
        
        if (td.find('input[value='+selected+']').length == 0) {
            td.append('<div class="added_employee"><input value="'+selected+'" type="hidden" name="'+select_name+'[]"><span onclick="delEmployee(this)" class="del_employee">'+selected_name+'</span></div>');
        }
    });
};

var delEmployee = function(elem) {
    $(elem).parent().remove();
};

$(function() {
   addEmployeeToService();
   
   //autocomplete
   var registration_plates = [jsVars.registration_plates];
   $( "#car_registration_plate" ).autocomplete({
      source: registration_plates,
      select: function( event, ui ) {
          $.get( BASE_URL+"orders/getAddFormData/"+ui.item.value+'.json', function( data ) {
            
            console.log(data.data.Car.registration_plate);
          
            $('[name="car_registration_plate"]').val(data.data.Car.registration_plate);
            $('[name="car_make"]').val(data.data.Car.make);
            $('[name="car_model"]').val(data.data.Car.model);
            $('[name="car_mileage"]').val(data.data.Car.mileage);
            $('[name="car_description"]').val(data.data.Car.description);
            
            $('[name="client_name"]').val(data.data.Client.name);
            $('[name="client_country"]').val(data.data.Client.country);
            $('[name="client_city"]').val(data.data.Client.city);
            $('[name="client_street"]').val(data.data.Client.street);
            $('[name="client_street_number"]').val(data.data.Client.street_number);
            $('[name="client_phone"]').val(data.data.Client.phone);
            $('[name="client_email"]').val(data.data.Client.email);
            
            if (data.data.Client.is_company) {
                $('.is_company').click();
                $('[name="client_mol"]').val(data.data.Client.mol);
                $('[name="client_bulstat"]').val(data.data.Client.bulstat);
            }
          });
      }
    });
   
   //datepicker
   $( ".datepicker" ).datepicker({dateFormat: 'yy-mm-dd'}).datepicker("setDate", new Date());
   
   //if is_company show more input fields
   $('.is_company').attr('checked', false).click(function() {
       if ($(this).is(':checked')) {
         $('.company').removeAttr('disabled').show();
         $('.company_label').show();
       } else {
         $('.company').attr('disabled', 'disabled').hide();
         $('.company_label').hide();
       } 
   });
});