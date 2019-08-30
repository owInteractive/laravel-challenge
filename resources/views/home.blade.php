@extends('adminlte::page')

@section('title', 'The Calendar App')

@section('content_header')
    <h1>{{$titulo}}</h1>
@stop

@section('content')
    <div id="app">
        <crud owner="{{Auth::user()->id}}" caminho="{{$caminho}}" fonte="{{$fonte}}" ></crud>
    </div>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
@stop
