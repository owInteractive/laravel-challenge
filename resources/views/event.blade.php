@extends('/layouts/app')
@section('content')
<h1>eventos
    <a class="btn btn-primary" type="button" href="{{ route('event.form') }}">Adicionar</a>
</h1>


<div class="row">
    @foreach($events as $event)
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <div class="caption" style="height: 220px;">
                <h3>{{ $event->title}}</h3>
                <h4>
                    @if($event->date_begin == $event->date_end)
                    {{$event->date_begin}}<br />
                    @else
                    {{$event->date_begin}} até {{$event->date_end}} <br />
                    @endif
                    {{$event->time_begin}} até {{$event->time_end}}

                </h4>
                <p>{{$event->description}}</p>
            </div>
            <div class="caption">
                <a href="{{ route('event.form', $event->id) }}" class="btn btn-default" role="button">Editar</a>
                <a href="{{ route('event.delete', $event->id) }}" class="btn btn-danger" role="button">Deletar</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection