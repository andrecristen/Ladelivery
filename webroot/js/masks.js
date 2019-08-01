$(document).ready(function () {
    $('.cep').mask('00000-000');
    angular.forEach($('.money'), function (value) {
        value = $(value);
        var valor = parseFloat(value.val());
        valor = valor.toFixed(2);
        value.val(valor);
    });
    $('.money').mask('#.00', {reverse: true});
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
});