/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $('select').material_select();
});


$('#delete_photo').click(function () {
    $('#modal_delete_photo').modal({
        dismissible: false, // Modal can be dismissed by clicking outside of the modal
        opacity: .5, // Opacity of modal background
        inDuration: 300, // Transition in duration
        outDuration: 200, // Transition out duration
        startingTop: '4%', // Starting top style attribute
        endingTop: '10%', // Ending top style attribute
        ready: function (modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
            //console.log(modal, trigger);
        },
        complete: function (modal, trigger) {
        } // Callback for Modal close
    });
});

$('#modale_delete_msg_oui').click(function () {
    // On supprime la photo : vide le champ caché contenant le nom de la photo
    $('#easyroom_appbundle_salle_nomPhoto').val('');
});

