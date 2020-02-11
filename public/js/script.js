$(function(){
    
    $('.btn-danger').on('click', function(){

        let id = $(this).attr('id');

        let route = "events/"+id;

       $('#delete_event').attr('action', route);            

    });

});