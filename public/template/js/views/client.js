$('[data-mask]').inputmask();
$('#cpf_cnpj').inputmask({
    mask: [
        '999.999.999-99',
        '99.999.999/9999-99',
    ],
    keepStatic: true,
});
$(document).ready(function() {
    $('.mask-money').maskMoney({thousands: '.', decimal: ','});
});

$(function() {
    $('.select2').select2();
});
