@extends('layouts.template')
@section('content')

  <!-- Page Heading -->
  <h2>{{$title}}</h2>
  <div class="d-sm-flex align-items-center justify-content-between mb-4" style='margin-bottom:-10px;'>
        
        
           <h1 class="h3 mb-0 text-gray-800">
           @if(isset($busca) && $busca <> '')
              @if($events->total() <= 0)
                  No results for Search 
              @else
                  @if($events->lastPage() == 1)
                   Results
                  @else
                          
                          Results -  Page {{$events->currentPage()}} / {{$events->lastPage()}}
                  @endif  
              @endif        
           @else
                    
                    Results -  Page {{$events->currentPage()}} / {{$events->lastPage()}}  
           @endif
            
             
            </h1>
         
                        <a href="{{route('event.create')}}" class="btn btn-primary " ><i class="fas fa-plus-circle"></i> New Event</a>
                        <a href="{{route('downloadCsv',['id'=>Auth::user()->id,'category'=>$title,'search'=>$busca])}}" class="btn btn-primary " ><i class="fas fa-download"></i> <i class="far fa-file-excel"></i> Export to Excel </a>
                        

        
        
        
      
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
             <button class="btn btn-outline-secondary my-2 my-sm-0" Onclick="Buscar('{{$title}}');">GO</button> 
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
            <th>Status Invite</th>
            <th>Action</th>
                        
          </tr>
        </thead>
        
        <tbody>
            @foreach ($events as $event)
            <tr role="row" class="odd">
                <td style= "width:50%;"  style="vertical-align:middle;">{{$event->title}}</td>
                <td style= "width:15%;"  style="vertical-align:middle;">{{ date('Y-m-d H:i',strtotime($event->start))}}</td>
                <td style= "width:15%;"  style="vertical-align:middle;">{{ date('Y-m-d H:i',strtotime($event->end))}}</td>
                <td style= "width:15%;"  style="vertical-align:middle;">{{ $event->invite_status }}</td>
                
                                            
                  <td style= "width:5%;">
                    
                  
                  <div class="col-sm-3" >
                      @if(Auth::user()->id == $event->owner)  <!--SE FOR O MESMO USUARIO O DONO O METHODO QUE CHAMA SERÁ O DE EDIÇÃO -->
                        <div class="input-group-append pull-right" >
                          
                            <span class="btn btn-outline-dark btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="sr-only">Toggle Dropdown</span>
                              Actions
                            </span>
                            
                            <div class="dropdown-menu">
                              
                              <a class="dropdown-item" href =" {{route('eventShow',['id' => $event->id_event, 'user'=> Auth::user()->id ])}}">  <i class="fas fa-edit text-warning " ></i> Edit</a>
                            
                              <div role="separator" class="dropdown-divider"></div>
                              <button class="dropdown-item" onClick="Enviar({{$event->id_event}},'{{$event->title}}')" > <i class="fas fa-trash text-danger" ></i> Delete</button>
                            </div>
                          </div>
                      @else
                        
                              
                              <a  href="{{route('eventShow',['id' => $event->id_event, 'user'=> Auth::user()->id ])}}">  <i class="fas fa-eye text-primary " ></i></a>
                            
                              
                         

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
       function Buscar(title){
              var busca = new String(document.getElementById('campoBusca').value);             
              
               if(title == 'My Invites' )
               {
                
                    if ((busca.replace(/ /g,"")).length > 0)
                  {
                      document.getElementById('formBusca').action="{{ route('invites',['id'=>Auth::user()->id,'search'=>'0']) }}";
                      var str = new String( document.getElementById('formBusca').action);
                      document.getElementById('formBusca').action=(str.substring(0,(str.length)-1))+busca;
                      document.getElementById('formBusca').submit();
                      
                      
                    
                  }
                  else
                  {
                    
                      document.getElementById('formBusca').action="{{ route('invites',['id'=>Auth::user()->id,'search'=>' ']) }}";
                      document.getElementById('FormBusca').submit();
                  }

               }
               if(title == 'My Pending Invites' )
               {
                
                    if ((busca.replace(/ /g,"")).length > 0)
                  {
                      document.getElementById('formBusca').action="{{ route('pedingdinvites',['id'=>Auth::user()->id,'search'=>'0']) }}";
                      var str = new String( document.getElementById('formBusca').action);
                      document.getElementById('formBusca').action=(str.substring(0,(str.length)-1))+busca;
                      document.getElementById('formBusca').submit();
                      
                      
                    
                  }
                  else
                  {
                    
                      document.getElementById('formBusca').action="{{ route('pedingdinvites',['id'=>Auth::user()->id,'search'=>' ']) }}";
                      document.getElementById('FormBusca').submit();
                  }

               }
               
           
              
       }

      

    </script>
    <script>
        $("#btnExport").click(function (e) {
            window.open('data:application/vnd.ms-excel,' +event);
            e.preventDefault();
        });
      </script>
@endsection

