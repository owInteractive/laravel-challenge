$(function () {

    /**
     * AJAX SETUP
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /**
     * SEND INVITE
     */
    $('form[name="form_send_invite"]').submit(function (event) {
        event.preventDefault();

        var form = $(this);
        var form_action = form.attr('action');
        var form_data = form.serialize(form);
        var form_button = form.find('button[type="submit"]');

        $.ajax({
            url: form_action,
            type: 'POST',
            dataType: 'json',
            data: form_data,
            beforeSend: function(){
                form_button.html('Aguarde...');
            },
            success: function (response) {
                if (!response.error) {
                    form_button.html('Enviar');
                    swal(response.message, '', response.type);
                    $('#modalSendInvite').modal('hide');
                }
            }
        });

    });

});

/**
 * DELETE EVENT
 * @param id
 */
function deleteEvent(element) {
    var action = $(element).data('action');
    var id = $(element).data('id');

    swal({
        title: 'Excluir',
        text: 'Tem certeza que deseja excluir o registro?',
        icon: 'warning',
        buttons: true,
        buttons: ['Não', 'Sim, excluir'],
        closeOnClickOutside: false
    }).then(function (response) {
        if (response) {
            $.ajax({
                url: action,
                type: 'DELETE',
                dataType: 'json',
                data: {event: id},
                success: function (response) {
                    swal({
                        title: response.message,
                        text: '',
                        icon: response.type,
                        closeOnClickOutside: false
                    }).then(function () {
                        // window.location.href = response.redirect;
                        $(element).parent('td').parent('tr').remove();
                    });
                }
            });
        } else {
            return false;
        }
    });
}


function showModal(id_modal, id_event) {

    $('#event_id').val(id_event);
    $('#modalSendInvite').modal({
        show: true,
        backdrop: 'static'
    });
}