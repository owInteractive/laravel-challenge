$('#postcode').on('blur', function() {
    let postcode = $(this).val();
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('app-content')},
        url: urlPostcode,
        data: {'postcode': postcode, '_token': token, 'base': 'site'},
        type: 'post',
        dataType: 'json',
        success: function(json) {
            if (json.logradouro) {
                $('#address-address').val(json.logradouro);
                $('#neighborhood').val(json.bairro);
                $('#city').val(json.cidade);
                $('#city_ibge').val(json.cidade_info.codigo_ibge);
                $('#uf').val(json.estado);
                $('#state').val(json.estado_info.nome);
                $('#state_ibge').val(json.estado_info.codigo_ibge);
                $('#number_home').focus();
                $('#latitude').val(json.latitude);
                $('#longitude').val(json.longitude);
            } else {
                $('#address').val('');
                $('#neighborhood').val('');
                $('#city').val('');
                $('#city_id').val('');
                $('#state').val('');
                $('#state_id').val('');
                $('#latitude').val('');
                $('#longitude').val('');
                $('#postcode').focus();
                console.log(json.error);
            }
        },
        error: function(error, errorText) {
            console.log(error, errorText);
        },
    });
});

$('#number_home').on('blur', function() {
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('app-content')},
        url: urlAddress,
        data: {
            'uf': $('#uf').val(),
            'city': $('#city').val(),
            'address': $('#address-address').val(),
            'number_home': $('#number_home').val(),
            'neighborhood': $('#neighborhood').val(),
            '_token': token,
        },
        type: 'post',
        dataType: 'json',
        success: function(json) {
            if (json.latitude) {
                $('#latitude').val(json.latitude);
                $('#longitude').val(json.longitude);
            }
        },
        error: function(error) {
            console.log(error.responseText);
        },
    });
});
