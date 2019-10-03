@extends('layouts.app')

@section('content')
<div class="container">

    @foreach ($events as $event)
        {{$event->title}}
    @endforeach
    <form action="{{url('export', ['archive'=>'csv', 'type'=>'all'])}}" enctype="multipart/form-data">
        <button class="btn btn-success" type="submit">Export CSV</button>
    </form>
    <form action="{{url('export', ['archive'=>'xls', 'type'=>'all'])}}" enctype="multipart/form-data">
        <button class="btn btn-success" type="submit">Export XLS</button>
    </form>
    <form action="{{url('export', ['archive'=>'txt', 'type'=>'all'])}}" enctype="multipart/form-data">
        <button class="btn btn-success" type="submit">Export TXT</button>
    </form>
    <div class="container d-flex justify-content-center">
        {{ $events->links() }}
    </div>    
</div>
@endsection