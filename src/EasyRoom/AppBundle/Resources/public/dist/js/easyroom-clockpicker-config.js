function initDatePicker() {
    $.extend($.fn.pickadate.defaults, {
        monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthsShort: ['Janv.', 'Févr.', 'Mars', 'Avr.', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Dec.'],
        weekdaysFull: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        weekdaysShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
        today: 'Aujourd\'hui',
        clear: 'Effacer',
        close: 'Valider',
        format: 'dd/mm/yyyy',
        formatSubmit: 'dd/mm/yyyy',
        min: true
    });

    var $dateDebut = $('.datepicker#date_debut').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
    });

    var $dateFin = $('.datepicker#date_fin').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
    });

    $dateDebut.on('change', function () {
        var picker = $dateFin.pickadate('picker');
        picker.set('min', $(this).val());
        datePickerWorkaround();
    });

    $dateFin.on('change', function () {
        var picker = $dateDebut.pickadate('picker');
        picker.set('max', $(this).val());
        datePickerWorkaround();
    });
}

function initTimePicker() {
    /*
    $('.timepicker').pickatime({
        default: 'now',
        twelvehour: false,
        donetext: 'Valider', // text for done-button
        autoclose: false
    });*/
    
  $('.timepicker').pickatime({
    default: 'now', // Set default time: 'now', '1:30AM', '16:30'
    fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
    twelvehour: false, // Use AM/PM or 24-hour format
    donetext: 'Valider', // text for done-button
    cleartext: 'Effacer', // text for clear-button
    canceltext: 'Cancel', // Text for cancel-button
    autoclose: false, // automatic close timepicker
    ampmclickable: true, // make AM PM clickable
    aftershow: function(){} //Function for after opening timepicker
  });
}