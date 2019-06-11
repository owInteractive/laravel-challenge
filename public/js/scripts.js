$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
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
            })
        } else {
            return false;
        }
    });
}