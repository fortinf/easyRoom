$( document ).ready(function(){
    $(".button-collapse").sideNav();
    $(".dropdown-button").dropdown();
    // Extend the default picker options for all instances.
    datePickerWorkaround();
});

function datePickerWorkaround() {
    $('.datepicker').each(function() {
        if($(this).val() != "") {
            $(this).parent().find("label").addClass("active");
        } else {
            $(this).parent().find("label").removeClass("active");
        }
    });
}