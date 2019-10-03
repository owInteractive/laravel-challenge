@extends('layouts.app')

@section('content')
<div class="container">

    @foreach ($events as $event)
        {{$event->title}}
    @endforeach
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
@endsection