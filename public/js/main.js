// swalDestroy
function swalDestroy(id, cancelSuccessText, title, text) {
    swal({
        title: title !== undefined ? title : 'Tem certeza disso?',
        text: text !== undefined ? text : 'Esta ação pode ser irreverssível!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: "Sim",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            $('#form-destroy-' + id).submit();
        } else {
            swal("", cancelSuccessText, "error");
        }
    });
}
