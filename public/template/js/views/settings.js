$('[data-mask]').inputmask();
$('#cpf_cnpj').inputmask({
    mask: [
        '999.999.999-99',
        '99.999.999/9999-99',
    ],
    keepStatic: true,
});
$(function() {
    $('.select2').select2();
});
