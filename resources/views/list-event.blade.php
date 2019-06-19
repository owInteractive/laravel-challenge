@extends('layouts.template')
@section('content')

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4" style='margin-bottom:-10px;'>
        
        
           <h1 class="h3 mb-0 text-gray-800">
           @if(isset($busca) && $busca <> '')
              @if($events->total() <= 0)
                  No results for Serach
              @else
                  @if($events->lastPage() == 1)
                   Search Result 
                  @else
                     
                          Search Results -  Page {{$events->currentPage()}} / {{$events->lastPage()}}
                   @endif  
              @endif        
           @else
                    Events -  Page {{$events->currentPage()}} / {{$events->lastPage()}}
           @endif
            
             
            </h1>
         
                        <a href="{{route('event.create')}}" class="btn btn-primary " ><i class="fas fa-plus-circle"></i> New Event</a>

        
        
        
      
  </div>

<div class="card shadow mb-4">
  <div class="card-header py-3">

      <div class='row'>
          <div class="col-sm-4">
            <h6 class="m-0 font-weight-bold text-primary">Report of Events </h6>
            <p>Showing: {{$events->count()}} de {{$events->total()}}</p>
            
          </div>
          <div class="col-sm-8">
             <form class="form-inline" id="formBusca" method="GET">
             <input id="campoBusca"class="form-control mr-sm-2" style='width:80%;'type="search" placeholder="Search Event" aria-label="Buscar">
             <button class="btn btn-outline-secondary my-2 my-sm-0" Onclick="Buscar();">GO</button> 
              </form>
              
          </div>
          
        </div>
   
  </div>
  <div class="card-body">
    <div class="table-responsive">
    {!!$events->links()!!}
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Title</th>
            <th>Start</th>
            <th>End</th>
            <th>Action</th>
                        
          </tr>
        </thead>
        
        <tbody>
            @foreach ($events as $event)
            <tr role="row" class="odd">
                <td style= "width:50%;"  style="vertical-align:middle;">{{$event->title}}</td>
                <td style= "width:15%;"  style="vertical-align:middle;">{{$event->start}}</td>
                <td style= "width:15%;"  style="vertical-align:middle;">{{$event->end}}</td>
                
                                            
                  <td style= "width:5%;">
                    
                  
                  <div class="col-sm-3" >
                      @if(Auth::user()->id == $event->owner)  <!--SE FOR O MESMO USUARIO O DONO O METHODO QUE CHAMA SERÁ O DE EDIÇÃO -->
                        <div class="input-group-append pull-right" >
                          
                            <span class="btn btn-outline-dark btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="sr-only">Toggle Dropdown</span>
                              Actions
                            </span>
                            
                            <div class="dropdown-menu">
                              
                              <a class="dropdown-item " href="{{route('event.edit',$event->id)}}">  <i class="fas fa-edit text-warning " ></i> Edit</a>
                            
                              <div role="separator" class="dropdown-divider"></div>
                              <button class="dropdown-item" onClick="Enviar({{$event->id}},'{{$event->title}}')" > <i class="fas fa-trash text-danger" ></i> Delete</button>
                            </div>
                          </div>
                      @else
                        
                              
                              <a  href="{{route('event.edit',['id' => $event->id, 'user'=> Auth::user()->id ])}}">  <i class="fas fa-eye text-primary " ></i></a>
                            
                              
                         

                      @endif
                        




                                
                </td>
                
                
              </tr>
          @endforeach
          
        
        
        </tbody>
      
      </table>
         {!!$events->links()!!}
    </div>
    
  </div>
</div>
 

 @if(session()->has('message_sucesso'))
       
                    <script>
                      
                      toastr.success("{{session()->get('message_sucesso')}}");
                        </script>               
                  
             
@endif
@if(session()->has('message_erro'))
       
                    <script>
                      
                      toastr.error("{{session()->get('message_erro')}}");
                        </script>               
                  
             
@endif

  
<form id ="form" class ='form' method='post' action="" > 
                      {!! method_field('DELETE')!!}
                      {!! csrf_field()!!}
</form>

  


@endsection
@section('customjs')
    <link href="/css/toastr.css" rel="stylesheet"/>
    <script>
   
      function Enviar (id,event){
         toastr.error
         (" </br><button type='button' id='confirmationRevertNo' class='btn btn-primary '>No</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type='button' id='confirmationRevertYes' class='btn btn-success '>Yes, continue !</button>",'You will delete the Event<br/>'+event+'<br/>You want Continue ?',
        
      {
        closeButton: true,
        allowHtml: true,
        timeOut: 0,
        extendedTimeOut: 0,
        preventDuplicates: true,
        positionClass: "toast-top-full-width",
            onShown: function (toast) {
            $("#confirmationRevertYes").click(function(){
              
              Submeter(id);
              
          });

        }
  });
      function Submeter(id){
              
              document.getElementById('form').action="{{route('event.destroy',0)}}";
              var str = new String( document.getElementById('form').action);
              document.getElementById('form').action=(str.substring(0,(str.length)-1))+id;
              document.getElementById('form').submit();
                
      };
     
      }
       function Buscar(){
              var busca = new String(document.getElementById('campoBusca').value);             
               
           
              if ((busca.replace(/ /g,"")).length > 0)
              {
                  document.getElementById('formBusca').action="{{route('eventSearch')}}/"+busca;
                  
                  document.getElementById('FormBusca').submit();
                 
              }
              else
              {
                  document.getElementById('formBusca').action="{{route('event.index')}}";
                  document.getElementById('FormBusca').submit();
              }
       }

      

    </script>
@endsection

