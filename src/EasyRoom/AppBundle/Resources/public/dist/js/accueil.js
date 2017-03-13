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

    var $debut = $('.datepicker#debut').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
    });

    var $fin = $('.datepicker#fin').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
    });

    $debut.on('change', function() {
        var picker = $fin.pickadate('picker');
        picker.set('min',$(this).val());
    });

    $fin.on('change', function() {
        var picker = $debut.pickadate('picker');
        picker.set('max',$(this).val());
    });
}

function initSelect() {
    $('select').material_select();
}
$( document ).ready(function(){
    initDatePicker();
    initSelect();
    $(".button-collapse").sideNav();
    $(".dropdown-button").dropdown();
    // Extend the default picker options for all instances.
});