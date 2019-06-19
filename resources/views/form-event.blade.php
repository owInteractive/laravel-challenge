@extends('layouts.template')
@section('content')

  

      @if(!isset($event))
          @if(Auth::user()->id == isset($event->owner))
             
              <form class ='form' method='post' id='update' action="{{route('event.update',$event->id)}}">
              {!! method_field('PUT')!!}
          @else
              <form class='form' method='post' id='presença' action=''>
              {!! csrf_field()!!}
              <input type="hidden" name='user_id' value="{{ Auth::user()->id }}" readonly> 
              <input type="hidden" name='event_id' value="{{isset($event->id) }}" readonly> 

          @endif
      
      @else
        <form class ='form' method='post' id='create' action="{{route('event.store')}}">
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
          
         
             @if(!isset($event))
               
                    <div class="col-sm-2">
                  <button class="btn btn-danger " type='reset'>Clear Fields </button>
                  </div>
                 
            @endif 
              
              
          
          
            @if(!isset($event))
               
                    <div class="col-sm-2">
                        <button class="btn btn-success " type='submit'>Save Event  </button>
                  </div>
                
                
              @else
                  @if( Auth::user()->id == $event->owner)
                      
                      <button class="btn btn-warning " type='submit'>Update Event </button>
                  @else
                       @if($stats == 'Nulo')
                          <input type="hidden" id='invite_status'name='invite_status' value="Confirmado" readonly> 
                          <button class="btn btn-success " type='submit'>Confirm presence</button>
                      @else
                           @if($stats == 'Confirmado')   
                            <input type="hidden" id='invite_status'name='invite_status' value="Rejeitado" readonly> 
                            <button class="btn btn-warning " type='submit'>Cancel Presence </button>
                    @endif

                      @endif
                      
                         
                          @if($stats == 'Rejeitado')
                              <input type="hidden" id='invite_status'name='invite_status' value="Confirmado" readonly> 
                              <button class="btn btn-success " type='submit'>Confirm Presence</button>
                            @endif
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
          
          <input class="form-control" id="start" name='start'  type="date" value="{{  old('start', date('d.m.Y H:i')) }}" @if($owner == -100 || $owner == Auth::user()->id) @else  readonly @endif />
          </div>
          <label for="exampleFormControlTextarea1">End Date</label>
          <input class="form-control" id="end" name='end' type="date" value="{{  old('end', date('dd-mm-YYYY')) }}"@if($owner == -100 || $owner == Auth::user()->id )  @else readonly  @endif >
         
 
        </div>
          
          </form>
 
@if(session()->has('message_sucesso'))
       
          <script>
            
            toastr.success("{{session()->get('message_sucesso')}}");
              </script>               
        
             
@endif



  

 

  

@endsection
@section('customjs')

  
@endsection

