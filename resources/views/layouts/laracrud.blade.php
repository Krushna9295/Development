<script>
function geocoding_add(input_id, lt, lg){
    var adlt = '#'+$(lt).attr('id');
    var adlg = '#'+$(lg).attr('id');

    var Autocomplete = new google.maps.places.Autocomplete(input_id);
                 

    Autocomplete.addListener('place_changed', function() {

    var place = Autocomplete.getPlace();
    if (!place.geometry) {
        // User entered the name of a Place that was not suggested and
        // pressed the Enter key, or the Place Details request failed.
        window.alert("No details available for input: '" + place.name + "'");
        return;
    }
    var lat = place.geometry.location.lat();
    var long = place.geometry.location.lng();
    $( adlt ).val(lat);
    $( adlg ).val(long); 
    if(place.address_components){
        var components = place.address_components;
        var street = null;
        for (var i = 0, component; component = components[i]; i++) {
     //    console.log(component);
        if (component.types[0] == 'locality') {
            var id  = component['long_name'];
         
            let _url = base_url+`/get_city_as_per_name/${id}`;
            let _url1 = base_url+`/get_tahshil_as_per_name/${id}`;
            $.ajax({
                type: 'GET',
                url: _url,
                data: {cityname: component['long_name']},
                dataType: 'json',
                success: function (data) {
                    if(data){
                        $('#city').val(data);
                    }else{
                        $('#city').val('');
                    }   
                }
                });

                $.ajax({
                type: 'GET',
                url: _url,
                data: {cityname: component['long_name']},
                dataType: 'json',
                success: function (data) {
                    if(data){
                        $('#tahshil').val(data);
                    }else{
                        $('#tahshil').val('');
                    }   
                }
                });

               
        }else if(component.types[0] == 'administrative_area_level_2'){
            var id  = component['long_name'];
            let _url = base_url+`/get_district_as_per_name/${id}`;
            $.ajax({
                type: 'GET',
                url: _url,
                data: {districtname: component['long_name']},
                dataType: 'json',
                success: function (data) {
                    if(data){
                        $('#district').val(data);
                    }else{    
                        $('#district').val('');
                    } 
                }
                });
        
        }else if(component.types[0] == 'administrative_area_level_1'){
            var id  = component['long_name'];
            let _url = base_url+`/get_state_as_per_name/${id}`;
           
            $.ajax({
                type: 'GET',
                url: _url,
                data: {statename: component['long_name']},
                dataType: 'json',
                success: function (data) {
                    if(data){
                $('#state').val(data);
                    }
                                        }
                });
        }else if(component.types[0] == 'postal_code'){
            var id  = component['long_name'];
                $('#pincode').val(id);
                 
        }
        }

        
     }
    });
   
}

$(document).on('change', '#state', function() {
  let _url = base_url+`/get_district_state`;
  var state = $(this).val();
  $.ajax({
                type: 'POST',
                url: _url,
                data: {"state": state, "_token": "{{ csrf_token() }}",},
                dataType: 'json',
                success: function (data) {
                    if(data){
                        $("#district").html('<option value="">Select District</option>');
        
                        $.each(data, function(i, data){
                            $("#district").append("<option value="+data.dst_code+">" + data.dst_name + "</option>");                
                        }); 
                    }else{
                        $('#district').html('<option value="">Select District</option>');
                    }   
                }
                });
});

$(document).on('change', '#district', function() {
  let _url = base_url+`/get_tahsil_district`;
  var district = $(this).val();
  $.ajax({
                type: 'POST',
                url: _url,
                data: {"district": district, "_token": "{{ csrf_token() }}",},
                dataType: 'json',
                success: function (data) {
                    if(data){
                        $("#tahsil").html('<option value="">Select Tahsil</option>');
        
                        $.each(data, function(i, data){
                            $("#tahsil").append("<option value="+data.thl_code+">" + data.thl_name + "</option>");                
                        }); 
                    }else{
                        $('#tahsil').html('<option value="">Select Tahsil</option>');
                    }   
                }
                });
});
$(document).on('change', '#tahsil', function() {
    let _url = base_url+`/get_city_tahsil`;
    var tahshil = $('#tahsil').val();
    $.ajax({
        type: 'POST',
        url: _url,
        data: {"tahshil": tahshil, "_token": "{{ csrf_token() }}",},
        dataType: 'json',
        success: function (data) {
            console.log(data)
            if(data){
                $("#city").html('<option value="">Select City</option>');
                $.each(data, function(i, data){
                    $("#city").append("<option value="+data.cty_id+">" + data.cty_name + "</option>");                
                }); 
            }else{
                $('#city').html('<option value="">Select City</option>');
            }   
        }
    });
});
$(document).on('change', '#atc', function() {
    let _url = base_url+`/get_po_as_per_atc`;
    var atc = $('#atc').val();
    $.ajax({
        type: 'POST',
        url: _url,
        data: {"atc": atc, "_token": "{{ csrf_token() }}",},
        dataType: 'json',
        success: function (data) {
            console.log(data)
            if(data){
                $("#po").html('<option value="">Select PO</option>');
                $.each(data, function(i, data){
                    $("#po").append("<option value="+data.po_id+">" + data.po_name + "</option>");                
                }); 
            }else{
                $('#po').html('<option value="">Select PO</option>');
            }   
        }
    });
});
$(document).on('change', '#call_type', function() {
    let _url = base_url+`/get_question_list`;
    var call_type = $('#call_type').val();
    $.ajax({
        type: 'POST',
        url: _url,
        data: {"call_type": call_type, "_token": "{{ csrf_token() }}",},
        dataType: 'json',
        success: function (data) {
            console.log(data)
            $('#questions').html(data);
            // if(data){
            //     $("#po").html('<option value="">Select PO</option>');
            //     $.each(data, function(i, data){
            //         $("#po").append("<option value="+data.po_id+">" + data.po_name + "</option>");                
            //     }); 
            // }else{
            //     $('#po').html('<option value="">Select PO</option>');
            // }   
        }
    });
});

</script>