@extends('layouts.template')
@section('content')

<!--- SE  -100 ESTÁ NO EVENTO DE CRIAÇÃO-->
@if($owner == -100)
      <!--FORMULARIO PARA CRIAÇÃO DO EVENTO -->
        <form class ='form' method='post' id='create' action="{{route('event.store')}}">
@endif


<!-- SE EXISTIR EVENTO NO FORMULARIO E O DONO ESTIVER LOGADO NA SEÇÃO -->
@if(isset($event) && $owner == Auth::user()->id )
  <!--FORMULARIO PARA UPDATE DO EVENTO -->
  <form class ='form' method='post' id='update' action="{{route('event.update',isset($event->id))}}">
  {!! method_field('PUT')!!} <!-- Metodo PUT -->
@endif



@if(isset($event) &&  $owner !== Auth::user()->id )
    <!-- FOMULARIO PARA ATUALIZAR PRESENÇA NO EVENTO -->
    <!-- Se não houve convite -->
    @if($stats == 'Nulo')
        <form class='form' method='post' id='presence_store' action="{{route('presence.store')}}">
        <input type="hidden" name='id_user' value="{{ Auth::user()->id }}" readonly> 
        <input type="hidden" name='id_event' value="{{$event->id }}" readonly>
    @endif
    <!--Se já houver confirmado -->
    @if($stats == 'Confirmado')   
        <form class='form' method='post' id='presença_update' action="{{route('presence.update','reject')}}">
        {!! method_field('PUT')!!} <!-- Metodo PUT -->
        <input type="hidden" name='id_user' value="{{ Auth::user()->id }}" readonly> 
        <input type="hidden" name='id_event' value="{{$event->id }}" readonly>  
        <input type="hidden" name='invite_status' value="Rejeitado" readonly>                    
    @endif
    <!--Se já houver Rejeitado -->
    @if($stats == 'Rejeitado')   
        <form class='form' method='post' id='presença_update' action="{{route('presence.update','accept')}}">
        {!! method_field('PUT')!!} <!-- Metodo PUT -->
        <input type="hidden" name='id_user' value="{{ Auth::user()->id }}" readonly> 
        <input type="hidden" name='id_event' value="{{$event->id}}" readonly>
        <input type="hidden" name='invite_status' value="Confirmado" readonly>                    
    @endif
    <!--Se já houver Convite -->
    @if($stats == 'Aguardando Resposta')
        <form class='form' method='post' id='presença_update' action="{{route('presence.update','answered')}}">
        {!! method_field('PUT')!!} <!-- Metodo PUT -->
        <input type="hidden" name='id_user' value="{{ Auth::user()->id }}" readonly> 
        <input type="hidden" name='id_event' value="{{$event->id}}" readonly>
    @endif
    
@endif

     
              

        
      {!! csrf_field()!!}
      <input type="hidden" name='owner' value="{{ Auth::user()->id }}" readonly>  
       
    
  
 
   

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4" style='margin-bottom:-10px;'>
        
          <div class="col-sm-8">
              <h1 class="h3 mb-0 text-gray-800">{{$title}}</h1>
              @if(isset($errors) && count($errors) > 0)
              

                    @foreach ( $errors->all() as $err)
                    <script>
                      toastr.error('{{$err}}');
                        </script>               
                    @endforeach  
             
              @endif
          </div>
          
         
          @if($owner == -100  )
               
                    <div class="col-sm-2">
                  <button class="btn btn-danger " type='reset'>Clear Fields </button>
                  </div>
                 
            @endif 
              
              
          
          
            @if($owner == -100 )
               
                    <div class="col-sm-2">
                        <button class="btn btn-success " type='submit'>Save Event  </button>
                  </div>
                
                
              @else
                   
                          @if( Auth::user()->id == $event->owner)
                              
                              <button class="btn btn-warning " type='submit'>Update Event </button>
                              <span class="btn btn-primary " data-toggle="modal" data-target="#friends" >Invite Friends </span>
                               <!-- The Modal Invite Friends-->
                                <div class="modal fade" id="friends">
                                    <div class="modal-dialog modal-xl">
                                      <div class="modal-content">
                                      
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                          <h4 class="modal-title">Invite Friends for {{$event->title}}</h4>
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                                <!-- DataTales Example -->
                                                <div class="card shadow mb-4">
                                                    <div class="card-header py-3">
                                                      <h6 class="m-0 font-weight-bold text-primary">Friends to invite</h6>
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="table-responsive">
                                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                        <thead>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Action</th>
                                                            <th>Invite Status</th>
                                                        </thead>                                           
                                                        </tbody>
                                                                                          
                                                            @foreach($users as $user)
                                                            
                                                                  @if($user->id != $event->owner)
                                                                  <?php
                                                                    $isinvited = 0 ;
                                                                  ?>
                                                                  <tr>
                                                                      <td>{{$user->name}}</td>
                                                                      <td>{{$user->email}}</td>
                                                                      @if(!($invites))
                                                                      <td><a  class='btn btn-success text-white' onClick="document.getElementById('user{{$user->id}}').submit();"> &nbsp <i class="fas fa-mail-bulk"></i>&nbsp&nbspInvite</a></td>
                                                                      <td>Not Invited</td>
                                                                      @else
                                                                          @foreach($invites as $invite)
                                                                          @if( $invite->invite_status == 'Confirmado' && $user->id == $invite->id_user && $invite->id_event == $event->id)
                                                                          <td><a  class='btn btn-success disabled text-white'onClick="document.getElementById('user{{$user->id}}').submit();"> &nbsp <i class="fas fa-check-double" ></i>&nbsp  Awesered &nbsp </a></td>
                                                                          <td>{{$invite->invite_status}}</td>
                                                                          <?php
                                                                            $isinvited = 1 ;
                                                                          ?>
                                                                          @else 
                                                                              @if( $invite->invite_status == 'Rejeitado')
                                                                                  <td><a  class='btn btn-success disabled text-white'onClick="document.getElementById('user{{$user->id}}').submit();"> &nbsp <i class="fas fa-check-double" ></i>&nbsp  Awesered &nbsp </a></td>
                                                                                  <td>{{$invite->invite_status}}</td>
                                                                                  <?php
                                                                                    $isinvited = 1 ;
                                                                                  ?>
                                                                              @else
                                                                                  @if($invite->invite_status == 'Aguardando Resposta' && $user->id == $invite->id_user && $invite->id_event == $event->id)
                                                                                    <td>
                                                                                        <a  class='btn btn-secondary disabled text-white' onClick="document.getElementById('user{{$user->id}}').submit();">
                                                                                          &nbsp <i class="fas fa-check"></i> &nbsp Invited &nbsp
                                                                                        </a>
                                                                                    </td>
                                                                                    <td>{{$invite->invite_status}}</td>
                                                                                    <?php
                                                                                        $isinvited = 1 ;
                                                                                      ?>
                                                                                  
                                                                                  @endif
                                                                                         
                                                                              @endif

                                                                          @endif
                                                                          
                                                                          
                                                                          @endforeach
                                                                      @endif

                                                                      @if($isinvited ==  0)
                                                                          <td><a  class='btn btn-success text-white' onClick="document.getElementById('user{{$user->id}}').submit();"> &nbsp <i class="fas fa-mail-bulk"></i>&nbsp&nbspInvite</a></td>
                                                                          <td>Not Invited</td>
                                                                      @endif
                                                                    </tr>
                                                                  @endif
                                                            @endforeach
                                                        </tbody>
                                                        </table>
                                                      </div>
                                                    </div>
                                                  </div>
                                        
                                                </div>
                                        
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                        
                                      </div>
                                    </div>
                                  </div>



                          @endif
                          
                          @if(isset($event) &&  $owner !== Auth::user()->id )
                          <!-- FOMULARIO PARA ATUALIZAR PRESENÇA NO EVENTO -->
                          <!-- Se não houve convite -->
                          @if($stats == 'Nulo')
                              <input type="hidden" id='invite_status'name='invite_status' value="Confirmado" readonly> 
                              <button class="btn btn-success " type='submit'>Confirm Event Presence</button>
                          @endif
                          <!--Se já houver confirmado -->
                          @if($stats == 'Confirmado')   
                              <input type="hidden" id='invite_status'name='invite_status' value="Rejeitado" readonly> 
                              <button class="btn btn-danger " type='submit'>Cancel Event Presence</button>             
                          @endif
                          <!--Se já houver Rejeitado -->
                          @if($stats == 'Rejeitado')   
                              <input type="hidden" id='invite_status'name='invite_status' value="Confirmado" readonly> 
                              <button class="btn btn-success " type='submit'>Confirm Event Presence</button>          
                          @endif
                          <!--Se já houver Convite -->
                          @if($stats == 'Aguardando Resposta')
                              <select name = 'invite_status' id='invite_status' class="form-control form-control-sm" required>
                                  <option value = ''>Choose one</option>
                                  <option value = 'Confirmado'>Accept</option>
                                  <option value = 'Rejeitado'>Reject</option>
                              </select>
                              <button class="btn-sm btn-primary " type='submit'>Send</button>
                          @endif
                          
                      @endif
                              
                 
                @endif 
            
            
            
        

        
              
              
          
        
    </div>


           <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            
            <input type="text" class="form-control" name ='title'id="title" aria-describedby="emailHelp" placeholder="Title Here" value ="{{$event->title or old('title')}}" @if($owner == -100 || $owner == Auth::user()->id)   @else readonly  @endif >
            </div>
          
         
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control" name ='description'id="description" rows="3" @if($owner == -100 || $owner == Auth::user()->id )  @else readonly  @endif >{{$event->description or old('description')}}</textarea> 
          </div>   
          <div class="form-group">
          <label for="exampleFormControlTextarea1">Start Date</label>
          
          <input class="form-control" id="datetimepicker" name='start'  type="text"        @if($owner == -100) value="" @else value="{{ date('Y-m-d H:i',strtotime(old('start',$event->start)))}}" @endif @if($owner == -100 || $owner == Auth::user()->id) @else  readonly @endif />
          </div>
          <label for="exampleFormControlTextarea1">End Date</label>
        <input class="form-control datepicker" id="end" name='end' type="text"  @if($owner == -100) value="{{null}}" @else value="{{ date('Y-m-d H:i',strtotime(old('end',$event->end)))}}" @endif @if($owner == -100 || $owner == Auth::user()->id )  @else readonly  @endif >
          <div class="form-group">
           
            
 
        </div>
        
          
          </form>

          @foreach($users as $user)
            @if($user->id != $event->owner)
              <form method='post' id='user{{$user->id}}' action="{{route('inviteFriend')}}">
                  <input type="hidden" name='id_user' value="{{ $user->id}}" readonly> 
                  <input type="hidden" name='id_event' value="{{$event->id }}" readonly>
                  <input type="hidden" name ='invite_status' value ='Aguardando Resposta'>
                  {!! csrf_field()!!}
                  </form>
                  @endif

          @endforeach
 
@if(session()->has('message_sucesso'))
       
          <script>
            
            toastr.success("{{session()->get('message_sucesso')}}");
            
           
              </script>               
        
             
@endif

@if($owner == -100 || (isset($event) && $owner == Auth::user()->id) )
<script>
    $(function() {
      $('input[name="start"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        timePicker: true,
        timePicker24Hour: true,
       
        opens: "right",
        drops: "up",
        
        locale: {
              format: 'Y-MM-DD HH:mm'
        },
      });
    });
    $(function() {
      $('input[name="end"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        timePicker: true,
        timePicker24Hour: true,
       
        opens: "right",
        drops: "up",
        
        locale: {
              format: 'Y-MM-DD HH:mm'
        },
      });
    });
    </script>
@endif

@endsection
@section('customjs')

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

  
@endsection

