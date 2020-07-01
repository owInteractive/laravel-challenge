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
        
           
                <div class="col-12 sm-10  mx-auto">
                <form class="bg-white py-3 px-3 shadow rounded">
                <label>Con esta aplicación podrás organizar tus eventos de forma conjunta con tu equipo de trabajo, todos los integrantes registrados podrán observar 
                las programaciones creadas por sus colegas de trabajo con el fin de estar sincronizados, podrán modificar, crear, eliminar y 
                descargar la información si lo requiere.</label>
                <hr>
                

             
               
        </div>
        </div>
</div>
                   
      
                    
            
    @endauth

@endsection
