function initDatePicker() {
    $.extend($.fn.pickadate.defaults, {
        monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        weekdaysFull: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        today: 'Aujourd\'hui',
        clear: 'Effacer',
        close: '',
        formatSubmit: 'yyyy/mm/dd'
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
    });

    $dateFin.on('change', function() {
        var picker = $dateDebut.pickadate('picker');
        picker.set('max',$(this).val());
    });
}

function initTimePicker() {
    $('.timepicker').pickatime({
        autoclose: false,
        twelvehour: false,
        default: '14:20:00'
    });
}


function initSelect() {
    $('select').material_select();
}

$( document ).ready(function(){
    initDatePicker();
    initTimePicker();
    //initSelect();
    $(".button-collapse").sideNav();
    $(".dropdown-button").dropdown();
    // Extend the default picker options for all instances.
});
