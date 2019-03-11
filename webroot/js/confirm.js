function confirmar() {
    if(verificaMinimoOpcoes()){
        alert('Confirmado');
    }else{
        alertify.error('Selecione uma forma de pagamento');
    }
}

function cancelar() {
    
}

function verificaMinimoOpcoes() {
    var selects = $('select');
    try{
        selects.each(certificaMinimoPreechido);
        return true;
    }catch (e) {
        return false;
    }

}

function certificaMinimoPreechido(index, element) {
    var minOptions = 1;
    var selected = $('option:selected', element);
    console.log(selected);
    if(selected.length < minOptions || selected.val() == "false"){
        throw new Error('Não selecionada forma de pagamento');
        return;
    }
}