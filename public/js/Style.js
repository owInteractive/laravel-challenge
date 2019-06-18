$(document).ready(function(){
    url = window.location.href;
    urlAtual = url.split("0/")[1];
    if(urlAtual == "usuario"){
        $('.table').removeClass('active');
        $('.user').addClass('active');        
    }else{
        $('.user').removeClass('active');
        $('.table').addClass('active');
    }
});

$("#allDay").on('click',function(){
    location.href="/home";
});
$("#nowDay").on('click',function(){
    $.ajaxSetup({
        headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
     });
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: '/event/get/nowDay',
        success: function (data)
        {	
            $(".eventBody").html("");
            $(".pagination").html("");
            var obj = JSON.parse(data);
            obj.forEach(function(o){
            $(".eventBody").append("<tr><td>"+o.id+"</td><td>"+o.titulo+"</td><td>"+o.dataInicio+"</td><td><a href='event/"+o.id+"/edit'><input type='button' value='alterar' class='btn btn-warning'></a></td><td><a href='event/deletar/"+o.id+"'><input type='button'value='excluir'class='btn btn-danger'></a></td><td><input type='button'value='Convidar' class='btn btn-info convite' data-toggle='modal'data-target='#Modal'><input type='text'  class ='idConvite' value='"+o.id+"' hidden></td></tr>");
            });
            

        }
    });    
});

$("#nextDay").on('click',function(){
    $.ajaxSetup({
        headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
     });
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: '/event/get/nextDay',
        success: function (data)
        {	
            $(".eventBody").html("");
            $(".pagination").html("");
            var obj = JSON.parse(data);
            obj.forEach(function(o){
            $(".eventBody").append("<tr><td>"+o.id+"</td><td>"+o.titulo+"</td><td>"+o.dataInicio+"</td><td><a href='event/"+o.id+"/edit'><input type='button' value='alterar' class='btn btn-warning'></a></td><td><a href='event/deletar/"+o.id+"'><input type='button' value='excluir' class='btn btn-danger'></a></td><td><input type='button' value='Convidar' class='btn btn-info convite' data-toggle='modal' data-target='#Modal'><input type='text'  class ='idConvite' value='"+o.id+"' hidden></td></tr>");
            });
            

        }
    });
});



$(document).on('click','.convite',function(){
    id = $(this).parent().find('.idConvite').val();
    alert(id);
    $(".idEnviarConvite").val(id);
});

$(".envModal").on('click',function(){
    alert('Verificando E-mails e enviando, aguarde um momento...');
});
