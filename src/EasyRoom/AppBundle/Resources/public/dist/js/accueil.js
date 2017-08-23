function setMenu() {
    $('.navbar-fixed li').removeClass("active");
    $('li.menu_accueil').addClass("active");
}

$( document ).ready(function(){
    // Gestion du menu
    setMenu();
    initDatePicker();
    initTimePicker();
});
