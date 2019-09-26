function alternateFieldsCliente(check) {
    if($(check).prop('checked')){
        $("#cliente_nao_cadastrado").prop('disabled', 'disabled');
        $("#cliente_nao_cadastrado").val(null);
        $("#cliente_cadastrado").prop('disabled', false);
    }else{
        $("#cliente_cadastrado").prop('disabled', 'disabled');
        $("#cliente_cadastrado").val(null);
        $("#cliente_nao_cadastrado").prop('disabled', false);
    }
    setTimeout(function () {
        allSelectSearch();
        $('select').selectpicker('refresh');
    },100);
}

function alternateFieldsEndereco(check) {
    debugger;
    if($(check).prop('checked')){
        $("#area-endereco").css('display', 'none');
        $("#area-new-endereco").css('display', 'block');
        $("#rua").prop('required', true);
        $("#numero").prop('required', true);
        $("#bairro").prop('required', true);
        $("#cidade").prop('required', true);
        $("#cep").prop('required', true);
        $("#complemento").prop('required', true);
        $("#estado").prop('required', true);
    }else{
        $("#area-new-endereco").css('display', 'none');
        $("#area-endereco").css('display', 'block');
        $("#rua").removeAttr('required');
        $("#numero").removeAttr('required');
        $("#bairro").removeAttr('required');
        $("#cidade").removeAttr('required');
        $("#cep").removeAttr('required');
        $("#complemento").removeAttr('required');
        $("#estado").removeAttr('required');
    }
    setTimeout(function () {
        allSelectSearch();
        $('select').selectpicker('refresh');
    },100);
}