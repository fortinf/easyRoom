function initDatePicker() {
    $.extend($.fn.pickadate.defaults, {
        monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        weekdaysFull: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        today: 'Aujourd\'hui',
        clear: 'Effacer',
        close: 'Valider',
        format: 'dd/mm/yyyy',
        formatSubmit: 'dd/mm/yyyy'
    });

    var $dateDebut = $('.datepicker#date_debut').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
    });

    var $dateFin = $('.datepicker#date_fin').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
    });

    $dateDebut.on('change', function() {
        var picker = $dateFin.pickadate('picker');
        picker.set('min',$(this).val());
        datePickerWorkaround();
    });

    $dateFin.on('change', function() {
        var picker = $dateDebut.pickadate('picker');
        picker.set('max',$(this).val());
        datePickerWorkaround();
    });
}

function initTimePicker() {
    $('.timepicker').pickatime({
        autoclose: false,
        twelvehour: false,
        default: 'now',
        donetext: 'Valider'     // done button text
    });
}

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
