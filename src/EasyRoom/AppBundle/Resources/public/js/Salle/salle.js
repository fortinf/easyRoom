
  $(document).ready(function() {
    $('input#input_text, textarea#description-salle').characterCounter();
  });

  $('#description-salle').val('');
  $('#description-salle').trigger('autoresize');
        
        