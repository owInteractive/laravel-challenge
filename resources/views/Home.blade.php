@extends('layout')


@section('content')


    
    <div class="container">
    
    
        <div class="row">
        
            <div class="col-12 sm-10 col-lg-6 mx-auto">
                    
                <form class="bg-white py-3 px-4 shadow rounded"><div><h1>Bienvenido</h1></div><hr>
                <img class="img-fluid mb-4" src="/img/evento.svg">
                @auth
                <label>{{ auth()->user()->name }}<h5>Usuario</h5></label><br>
                <label>{{ auth()->user()->email }}<h5>Email</h5></label>  
                </form>                              
       
            </div>
        </div>

        @else
        
           
                <div class="col-12 sm-10 col-lg-6 mx-auto">
                <form class="bg-white py-3 px-3 shadow rounded">
                <label>Este aplicativo te ayudara a tener un orden en tus actividades
                a largo o corto plazo.</label>
                <hr>
                

             
               
        </div>
        </div>
</div>
                   
      
                    
            
    @endauth

@endsection
