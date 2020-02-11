$(document).ready(function() {
    $('#datatables').DataTable({
      "paging": false,
      "pagingType": "full_numbers",
      "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ],
      buttons: [
        'csv', 'excel', 'pdf', 'print'
    ],
      responsive: true,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Search events",
      }
    });

    var table = $('#datatable').DataTable();

    // Edit record
    table.on('click', '.edit', function() {
      $tr = $(this).closest('tr');
      var data = table.row($tr).data();
      alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
    });

    // Delete a record
    table.on('click', '.remove', function(e) {
      $tr = $(this).closest('tr');
      table.row($tr).remove().draw();
      e.preventDefault();
    });

    //Like record
    table.on('click', '.like', function() {
      alert('You clicked on Like button');
    });

    $( "input" ).each(function() {

      if ($(this).hasClass('date_time')) {
        $(this).mask('00/00/0000 00:00:00');
      }      
    });



    $("#file-csv").change(function(){
      $("#frm-import").submit();
  
    });

    
  });