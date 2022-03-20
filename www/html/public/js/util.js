var APP_HOST = `${window.location.protocol}//${window.location.host}`;

$(document).ready(function(){
    $(`[id^="horaInicio"]`).mask("00:00:00");
    $(`[id^="horaFim"]`).mask("00:00:00");
    $(`[id^="numeroConteiner"]`).mask("AAAA0000000", {'translation': {
        A: {pattern: /[A-Za-z]/}
    }});

});

async function enviarPost(url, pagina, index = null, id = null){
    let dadosFormulario = await formatarDadosFormulario(index, id);

    $.ajax({
        type: "POST",
        url: `${APP_HOST}${url}`,
        data: dadosFormulario[pagina],   
    }).done(function (resposta) {
        alert(resposta);
        window.location.reload();
    }).fail(function (){
        alert('Erro inesperado.');
    });      
}

function enviarGet(url, id){
    $.ajax({
        type: "GET",
        url: `${APP_HOST}${url}`,
        data: {id: id},   
    }).done(function (resposta) {
        alert(resposta);
        window.location.reload();
    }).fail(function (){
        alert('Erro inesperado.');
    });   
}

function getComboBox(url, id, index){
    $.ajax({
        type: "GET",
        url: `${APP_HOST}${url}`,
        data: {id: id},   
    }).done(function (resposta) {
        
    }).fail(function (){
        alert('Erro inesperado.');
    });   
}

async function formatarDadosFormulario(index, id){
    let dadosFormulario = {}

    if(!index){
        dadosFormulario = {
            conteiner: {
                numeroConteiner: $("#numeroConteiner").val(),
                cliente: $("#cliente").val(),
                tipo: $("#tipo").val(),
                status: $("#status").val(),
                categoria: $("#categoria").val(),
            },
            movimentacoes: {
                numeroConteiner: $("#movimentacaoNumeroConteiner").val(),
                tipo: $("#tipoMovimentacao").val(),
                dataInicio: $("#dataInicio").val(),
                horaInicio: $("#horaInicio").val(),
                dataFim: $("#dataFim").val(),
                horaFim: $("#horaFim").val(),
            }
        };
    }else{
        dadosFormulario = {
            conteiner: {
                numeroConteinerAntigo: id,
                numeroConteinerNovo: $(`#numeroConteiner${index}`).val(),
                cliente: $(`#cliente${index}`).val(),
                tipo: $(`#tipo${index}`).val(),
                status: $(`#status${index}`).val(),
                categoria: $(`#categoria${index}`).val(),
            },
            movimentacoes: {
                numeroMovimentacao: id,
                numeroConteiner: $(`#movimentacaoNumeroConteiner${index}`).val(),
                tipo: $(`#tipoMovimentacao${index}`).val(),
                dataInicio: $(`#dataInicio${index}`).val(),
                horaInicio: $(`#horaInicio${index}`).val(),
                dataFim: $(`#dataFim${index}`).val(),
                horaFim: $(`#horaFim${index}`).val(),
            }
        };
    }

    return dadosFormulario;
}