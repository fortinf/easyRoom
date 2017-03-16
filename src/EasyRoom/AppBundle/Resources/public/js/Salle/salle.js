function setMenu() {
    $('.navbar-fixed li').removeClass("active");
    $('li.menu_salles').addClass("active");
}

$(document).ready(function () {
    // Gestion du menu
    setMenu();

    $('input#input_text, textarea#description-salle').characterCounter();
    $('#description-salle').val('');
    $('#description-salle').trigger('autoresize');
});