$(document).ready(function() {
    $('#help-equipamentos').popover({
        content: "Se o equipamento desejado não estiver na lista abaixo, selecione a primeira opção\n\
e na descrição coloque o nome do equipamento para que o técnico adicione o novo equipamento à lista.",
        delay: 100,
        placement: "auto bottom",
        trigger: "hover"
    });
    var content_fuel = '<div class="col-md-12">' + imagem_fuel + '</div>';
    $('#help-fuel').popover({
        content: content_fuel,
        delay: 100,
        placement: "auto bottom",
        trigger: "hover",
        html: true,
        title: 'Exemplo de FUEL'
    });
});