$(document).ready(function() {
    $('#close_flash').on('click', function() {
        $("#flashMessage").animate({
            left: "+=500",
            height: "toggle"
        }, 750);
    });
    $('#help-equipamentos').popover({
        content: "Se o equipamento desejado não estiver na lista abaixo, selecione a primeira opção\n\
e na descrição coloque o nome do equipamento para que o técnico adicione o novo equipamento à lista.",
        delay: 100,
        placement: "auto bottom",
        trigger: "hover"
    });
});