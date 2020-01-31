@extends('/layouts/app')
@section('content')
<div class="row">
    <div class="col-md-6">
        <form method="{{ isset($event) ? 'get' : 'post' }}" action="{{ isset($event)? route('event.update', $event->id) : route('event.create') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="hidden" name="id" value="{{ isset($event) ? $event->id : '' }}">
                <label>Título do evento*</label>
                <input type="text" value="{{ isset($event) ? $event->title : ''}}" name="title" class="form-control" placeholder="título" required>

                <label>Quando começa?*</label>
                <input type="string" id="date_begin" name="date_begin" value="{{ isset($event) ? $event->date_begin : ''}}" class="form-control" placeholder="título" required>
                <label>Q horas começa?*</label>
                <input type="string" id="time_begin" name="time_begin" value="{{ isset($event) ? $event->time_begin : ''}}" class="form-control" placeholder="título" required>

                <label>Quando deve encerrar?*</label>
                <input type="string" id="date_end" name="date_end" value="{{ isset($event) ? $event->date_end : ''}}" class="form-control" placeholder="título" required>
                <label>Que horas deve encerrar?*</label>
                <input type="string" id="time_end" name="time_end" value="{{ isset($event) ? $event->time_end : ''}}" class="form-control" placeholder="título" required>
            </div>
            <label>Mais detalhes*
                <textarea rows="4" maxlength="200" cols="200" name="description" type="text" class="form-control" placeholder="Descrição" required>{{ isset($event) ? $event->description : ''}}</textarea>
            </label><br />
            <button type="submit" class="btn btn-primary">Confirmar</button>
        </form>
    </div>
    <div class="col-md-6">
        <img src="">
    </div>
</div>
<!-- não tive tempo de fazer isso funcionar da melhor forma possível, então importei aqui msm !-->
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
<script>
    $(document).ready(function($) {
        $('#date_begin').mask('00/00');
        $('#date_end').mask('00/00');
        $('#time_begin').mask('00h00');
        $('#time_end').mask('00h00');
    });
</script>
@endsection