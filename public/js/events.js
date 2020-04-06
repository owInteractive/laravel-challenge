$(function(){
  $('.datepicker').datepicker({
    startView: 0,
    startDate: '+0d',
    format: 'dd/mm/yyyy'
  });
  $('.datepicker').mask('99/99/9999');

  $('#file_csv').change(function(e){
    form = new FormData();
    form.append('file_csv', e.target.files[0]);
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('input[name$="_token"]').val()
      },
      url: $(this).data('href'),
      data: form,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function (data) {
        // utilizar o retorno
        $('#file_csv').val('');
        alert('Data saved successfully!');
      },
      error: function (data) {
        // utilizar o retorno
        $('#file_csv').val('');
        alert('An error occurred while processing your request!');
      }
    });
  });

});//ready func.
