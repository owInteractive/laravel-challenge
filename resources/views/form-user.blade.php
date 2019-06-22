@extends('layouts.template')
@section('content')

            <div class='container'>
                <form class ='form' method='post' id='update' action="{{route('user.update',Auth::user()->id)}}">
                    {!! method_field('PUT')!!} <!-- Metodo PUT -->
                    {!! csrf_field()!!}
              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label>Name</label>
                  <input type="text" class="form-control form-control-user" id="name" placeholder="Tell me your name" name="name" value="{{ $user->name or old('name') }}" required autofocus>

                  @if ($errors->has('name'))
                      <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
                </div>
                
              <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                  <label>Email</label>
                <input type="email" class="form-control form-control-user" id="email" placeholder="Put your email here"name="email" value="{{$user->email or  old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-group  {{ $errors->has('password') ? ' has-error' : '' }}">
                  <label>Password</label>
                  <input type="password" class="form-control form-control-user" id="password" placeholder="What is the password ?"name="password" required>

                  @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                
               
              </div>
              <button type='submit' class="btn btn-primary btn-user btn-block">
                Save Updates
              </button>
              
            </form>
          </div>

          @if(session()->has('message_sucesso'))
       
          <script>
            
            toastr.success("{{session()->get('message_sucesso')}}");
            
           
              </script>               
        
             
@endif
@endsection
@section('customjs')



  
@endsection

