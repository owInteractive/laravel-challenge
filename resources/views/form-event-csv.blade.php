@extends('layouts.template')
@section('content')





        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class='row'>
                <div class='col-10'>
                    <h1 class="h3 mb-2 text-gray-800">{{$title}}</h1>
                    <p class="mb-4">Choose here the excel file to load new events</a>.</p>
                </div>
                <div class='col-2'>
                    <button id= 'buttonsubmit'class='btn btn-success' onclick="save();" disabled>Save Events</button>
                </div>
            </div>
           
           
            <form>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="excelfile" onchange="ExportToTable()" onclick="ClearTable()">
                  <label class="custom-file-label" for="customFile">Choose CSV FILE</label>
                </div>
              </form>
              
              <script>
              // Add the following code if you want the name of the file appear on select
              $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
              });
              </script>
            <br>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Events to import</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                   
                        
                        
                     
                  </tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
  
          </div>
<form name='submitform' id='submitform' action = ''>
    <input type='hidden' name='campos[]' id='campos' required>
</form>

@endsection
@section('customjs')

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.7/xlsx.core.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/xls/0.7.4-a/xls.core.min.js"></script>  

<script>
  /*Clear the tables before to load information */
  function ClearTable(){
    var tableHeaderRowCount = 0;
    var table = document.getElementById('dataTable');
    var rowCount = table.rows.length;
    for (var i = tableHeaderRowCount; i < rowCount; i++) {
    table.deleteRow(tableHeaderRowCount);
}
    
  }
  /*Show CSV file information on html table */
  function ExportToTable() {  

    

     var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xlsx|.xls)$/;  
     /*Checks whether the file is a valid excel file*/  
     if (regex.test($("#excelfile").val().toLowerCase())) {  
         var xlsxflag = false; /*Flag for checking whether excel is .xls format or .xlsx format*/  
         if ($("#excelfile").val().toLowerCase().indexOf(".xlsx") > 0) {  
             xlsxflag = true;  
         }  
         /*Checks whether the browser supports HTML5*/  
         if (typeof (FileReader) != "undefined") {  
             var reader = new FileReader();  
             reader.onload = function (e) {  
                 var data = e.target.result;  
                 /*Converts the excel data in to object*/  
                 if (xlsxflag) {  
                     var workbook = XLSX.read(data, { type: 'binary' });  
                 }  
                 else {  
                     var workbook = XLS.read(data, { type: 'binary' });  
                 }  
                 /*Gets all the sheetnames of excel in to a variable*/  
                 var sheet_name_list = workbook.SheetNames;  
  
                 var cnt = 0; /*This is used for restricting the script to consider only first sheet of excel*/  
                 sheet_name_list.forEach(function (y) { /*Iterate through all sheets*/  
                     /*Convert the cell value to Json*/  
                     if (xlsxflag) {  
                         var exceljson = XLSX.utils.sheet_to_json(workbook.Sheets[y]);  
                     }  
                     else {  
                         var exceljson = XLS.utils.sheet_to_row_object_array(workbook.Sheets[y]);  
                     }  
                     if (exceljson.length > 0 && cnt == 0) {  
                         BindTable(exceljson, '#dataTable');  
                         cnt++;  
                     }  
                 });  
                 $('#dataTable').show();
                 CountRow();
             }  
             if (xlsxflag) {/*If excel file is .xlsx extension than creates a Array Buffer from excel*/  
                 reader.readAsArrayBuffer($("#excelfile")[0].files[0]);  
             }  
             else {  
                 reader.readAsBinaryString($("#excelfile")[0].files[0]);  
             }  
         }  
         else {  
             alert("Sorry! Your browser does not support HTML5!");  
         }  
     }  
     else {  
         alert("Please upload a valid Excel file!");
         ClearTable();
     } 
     var file =  document.getElementById('excelfile').value;
     if(file == null)
     {
           document.getElementById('buttonsubmit').disabled=true;
     }
     else{
          document.getElementById('buttonsubmit').disabled=false;
     }

 }  

 function BindTable(jsondata, tableid) {/*Function used to convert the JSON array to Html Table*/  
     var columns = BindTableHeader(jsondata, tableid); /*Gets all the column headings of Excel*/  
     for (var i = 0; i < jsondata.length; i++) {  
         var row$ = $('<tr/>');  
         for (var colIndex = 0; colIndex < columns.length; colIndex++) {  
             var cellValue = jsondata[i][columns[colIndex]];  
             if (cellValue == null)  
                 cellValue = "";  
             row$.append($('<td/>').html(cellValue));  
         }  
         $(tableid).append(row$);  
     }  
 }  
 function BindTableHeader(jsondata, tableid) {/*Function used to get all column names from JSON and bind the html table header*/  
     var columnSet = [];  
     var headerTr$ = $('<tr/>');  
     for (var i = 0; i < jsondata.length; i++) {  
         var rowHash = jsondata[i];  
         for (var key in rowHash) {  
             if (rowHash.hasOwnProperty(key)) {  
                 if ($.inArray(key, columnSet) == -1) {/*Adding each unique column names to a variable array*/  
                     columnSet.push(key);  
                     headerTr$.append($('<th/>').html(key));  
                 }  
             }  
         }  
     }  
     $(tableid).append(headerTr$);  
     return columnSet;  
 }  

/* cont rows and create a arrays of informarions and submit the form */
 function CountRow(){
  row = document.getElementById("dataTable").rows.length;
  colum = document.getElementById("dataTable").rows[0].cells.length;
  controw = 1;
  var table = document.getElementById('dataTable');
  listadeEventos = new Array();
  
   while(controw+1 <= row)
  {
    var event= {};
    
    event["title"] = table.rows[controw].cells[0].innerHTML;
    event["description"] = table.rows[controw].cells[1].innerHTML;
    event["start"] = table.rows[controw].cells[2].innerHTML;
    event["end"] = table.rows[controw].cells[3].innerHTML;
    event["owner"] = {{Auth::user()->id}};
    listadeEventos.push(event);
    
    controw++;
  }
  document.getElementById('campos').value = JSON.stringify(listadeEventos);
  
 }
 

/*Select the route and send the array to route */

 function save(){
                      document.getElementById('submitform').action="{{ route('sendCsv','0') }}";
                     
                      document.getElementById('submitform').submit();
 }
</script>

  
@endsection

