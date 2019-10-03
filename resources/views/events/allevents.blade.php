@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">All Events</h1>

    @forelse ($events as $event)
        <a href="{{ route('events.show', ['id'=>$event->id]) }}">{{$event->title}}</a>
    @empty
        <h3 class="text-center">Nenhum Evento Cadastrado</h3>
    @endforelse
    
    <div class="container d-flex justify-content-center">
        {{ $events->links() }}
    </div>

    <div class="container d-flex justify-content-center display-inline">
        <form action="{{url('export', ['archive'=>'csv', 'type'=>'all'])}}" enctype="multipart/form-data">
            <button class="btn btn-success" type="submit">Export CSV</button>
        </form>
        <form action="{{url('export', ['archive'=>'xls', 'type'=>'all'])}}" enctype="multipart/form-data">
            <button class="btn btn-success" type="submit">Export XLS</button>
        </form>
        <form action="{{url('export', ['archive'=>'txt', 'type'=>'all'])}}" enctype="multipart/form-data">
            <button class="btn btn-success" type="submit">Export TXT</button>
        </form>
    </div>    
</div>
@endsection