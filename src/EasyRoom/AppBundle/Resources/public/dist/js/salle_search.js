function setMenu() {
    $('.navbar-fixed li').removeClass("active");
    $('li.menu_recherche_salle').addClass("active");
}

$( document ).ready(function(){
    // Gestion du menu
    setMenu();
    initDatePicker();
    initTimePicker();
});
