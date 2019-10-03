@forelse ($events as $event)
    <a href="{{ route('events.show', ['id'=>$event->id]) }}">{{$event->title}}</a>
@empty
    <h3 class="text-center">Nenhum Evento Hoje</h3>
@endforelse

<div class="container d-flex justify-content-center display-inline">
    <form action="{{url('export', ['archive'=>'csv', 'type'=>'today'])}}" enctype="multipart/form-data">
        <button class="btn btn-success" type="submit">Export CSV</button>
    </form>
    <form action="{{url('export', ['archive'=>'xls', 'type'=>'today'])}}" enctype="multipart/form-data">
        <button class="btn btn-success" type="submit">Export XLS</button>
    </form>
    <form action="{{url('export', ['archive'=>'txt', 'type'=>'today'])}}" enctype="multipart/form-data">
        <button class="btn btn-success" type="submit">Export TXT</button>
    </form>
</div>    