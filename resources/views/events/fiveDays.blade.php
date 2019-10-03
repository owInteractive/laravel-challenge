@extends('layouts.app')

@section('content')
<div class="container">

    @forelse ($events as $event)
        {{$event->title}}
    @empty
        <h3 class="text-center">Nenhum Evento Nos Próximos 5 Dias</h3>
    @endforelse

    <div class="container d-flex justify-content-center display-inline">
        <form action="{{url('export', ['archive'=>'csv', 'type'=>'fiveDays'])}}" enctype="multipart/form-data">
            <button class="btn btn-success" type="submit">Export CSV</button>
        </form>
        <form action="{{url('export', ['archive'=>'xls', 'type'=>'fiveDays'])}}" enctype="multipart/form-data">
            <button class="btn btn-success" type="submit">Export XLS</button>
        </form>
        <form action="{{url('export', ['archive'=>'txt', 'type'=>'fiveDays'])}}" enctype="multipart/form-data">
            <button class="btn btn-success" type="submit">Export TXT</button>
        </form>
    </div>
  
</div>
@endsection