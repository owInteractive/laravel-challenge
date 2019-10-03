@extends('layouts.app')

@section('content')
<div class="container">

    @forelse ($events as $event)
        <a href="{{ route('events.edit', ['user'=>Auth::id(), 'id'=>$event->id]) }}">{{$event->title}}</a>
    @empty
        <h3 class="text-center">Você Não Tem Evento Cadastrado</h3>
    @endforelse
    
    <div class="container d-flex justify-content-center display-inline">
        <form action="{{url('export', ['archive'=>'csv', 'type'=>'my'])}}" enctype="multipart/form-data">
            <button class="btn btn-success" type="submit">Export CSV</button>
        </form>
        <form action="{{url('export', ['archive'=>'xls', 'type'=>'my'])}}" enctype="multipart/form-data">
            <button class="btn btn-success" type="submit">Export XLS</button>
        </form>
        <form action="{{url('export', ['archive'=>'txt', 'type'=>'my'])}}" enctype="multipart/form-data">
            <button class="btn btn-success" type="submit">Export TXT</button>
        </form>
    </div>
  
</div>
@endsection