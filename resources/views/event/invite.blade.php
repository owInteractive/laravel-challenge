@extends('core.base')

@section('content')

<div class="pl-3 pt-4 pb-4">
  <span class="h2">Convidar Amigo(s)</span>
</div>

<div class="pl-3"><span class="h4 text-secondary">Evento: {{$event->title}} ({{ date('d/m/Y H:i', strtotime(str_replace('-','/', $event->ts_start))) }})</span></div>


<form class="form-group" action="{{ route('event.sendInvite') }}" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <div class="content">
      <div class="pl-3 pt-3 pb-3">
          <input type="hidden" name="event" value="{{$event->id}}">
          <label>Nome:&nbsp;</label><input type="text" name="nome">
      </div>

      <div class="pl-3 pt-1 pb-3">
          <input type="hidden" name="event" value="{{$event->id}}">
          <label>Email:&nbsp;</label><input type="text" name="email">
      </div>

      <div class="pl-3 pt-3 pb-3">
          <button class="btn btn-success pl-3" type="submit">Enviar Convite</button>
      </div>

    </div>


</form>

@endsection
@section('scripts')
@parent
<script type="text/javascript">
    $(document).ready(function () {


    });
</script>
@endsection
