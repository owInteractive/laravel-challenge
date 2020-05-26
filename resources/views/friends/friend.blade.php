@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-10">Amigos </div>
                        <div class="col-md-2"><a href='{{ url("/add") }}'> ADICIONAR </a></div>
                    </div>
                </div>
                
                <div class="panel-body">
                    <div class="col-md-8">

                        @if( count($friends) > 0 )
                            @foreach( $friends->all() as $friend)
                                <h4> {{ $friend->name }} </h4>
                                <p> {{ $friend->email }} </p>                                

                                <ul class="nav nav-pills">
                                    <li role="presentation">
                                        <a href='{{ url("/edit/{$friend->user_id}/{$friend->email}") }}'> EDITAR </a>
                                    </li>
                                    <li role="presentation">
                                        <a href='{{ url("/deleteFriend/{$friend->user_id}/{$friend->email}") }}'> DELETAR </a>
                                    </li>
                                </ul>
                                <hr/>
                            @endforeach
                        @else
                            <p> Nenhum amigo inserido </p>
                        @endif

                        {{ $friends->links() }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
