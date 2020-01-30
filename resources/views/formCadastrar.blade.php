@extends('/layouts/app')
@section('content')
<div class="row">
    <div class="col-md-6">
        <form method="{{ isset($event) ? 'get' : 'post' }}" action="{{ isset($event)? route('event.update', $event->id) : route('event.create') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="hidden" name="id" value="{{ isset($event) ? $event->id : '' }}">
                <label>Título do evento</label>
                <input type="text" value="{{ isset($event) ? $event->title : ''}}" name="title" class="form-control" placeholder="título">

                <label>Quando começa?</label>
                <input type="string" name="date_begin" value="{{ isset($event) ? $event->date_begin : ''}}" class="form-control" placeholder="título">
                <label>Q horas começa?</label>
                <input type="string" name="time_begin" value="{{ isset($event) ? $event->time_begin : ''}}" class="form-control" placeholder="título">

                <label>Quando deve encerrar?</label>
                <input type="string" name="date_end" value="{{ isset($event) ? $event->date_end : ''}}" class="form-control" placeholder="título">
                <label>Que horas deve encerrar?</label>
                <input type="string" name="time_end" value="{{ isset($event) ? $event->time_end : ''}}" class="form-control" placeholder="título">
            </div>
            <label>Mais detalhes
                <textarea rows="4" maxlength="200" cols="200" name="description" type="text" class="form-control" placeholder="Descrição">{{ isset($event) ? $event->description : ''}}</textarea>
            </label><br />
            <button type="submit" class="btn btn-primary">Confirmar</button>
        </form>
    </div>
    <div class="col-md-6">
        <img src="">
    </div>
</div>
@endsection