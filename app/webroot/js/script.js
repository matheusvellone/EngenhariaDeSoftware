$(document).ready(function() {
    $('#close_flash').on('click', function() {
        $("#flashMessage").animate({
            left: "+=500",
            height: "toggle"
        }, 750);
    });
});