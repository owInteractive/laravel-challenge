@extends('core.base')

@section('content')

<div class="pl-3 pt-4">
  <span class="h3">Editar Evento</span>
</div>

{!! Form::model($event ,['id'=>'formEditEvent', 'route'=>['event.update',$event->id], 'method'=>'put']) !!}
<div class="form-group col-12 pt-3 row">
        <div class="col-12">
            {!! Form::label('title', 'Titulo: ', ['class' => 'color-blue']) !!}
            {!! Form::text('title', null, ['class'=>'form-control','id' => 'title', 'autocomplete' => 'off']) !!}
            @if ($errors->has('title'))
                <small class="help-block text-danger">
                    {{ $errors->first('title') }}
                </small>
             @endif
        </div>

        <div class="col-12 pt-3">
            {!! Form::label('description', 'Descrição: ', ['class' => 'color-blue']) !!}
            {!! Form::text('description', null, ['class'=>'form-control','id' => 'description', 'autocomplete' => 'off']) !!}
            @if ($errors->has('description'))
              <small class="help-block text-danger">
                    {{ $errors->first('description') }}
              </small>
             @endif
        </div>

        <div class="col-5 pt-3">
            {!! Form::label('ts_start', 'Data Inicio: ', ['class' => 'color-blue']) !!}
            {!! Form::text('ts_start', $event->ts_start, ['class'=>'form-control','id' => 'ts_start', 'autocomplete' => 'off']) !!}
            @if ($errors->has('ts_start'))
                  <small class="help-block text-danger">
                    {{ $errors->first('ts_start') }}
                </small>
             @endif
        </div>

        <div class="col-4 pt-3">
            {!! Form::label('time_start', 'Horário Inicio: ', ['class' => 'color-blue']) !!}
            {!! Form::text('time_start', $timeStart, ['class'=>'form-control','id' => 'time_start', 'autocomplete' => 'off']) !!}
            @if ($errors->has('time_start'))
                  <small class="help-block text-danger">
                    {{ $errors->first('time_start') }}
                </small>
             @endif
        </div>

        <div class="col-5 pt-3">
            {!! Form::label('ts_end', ' Data Término: ', ['class' => 'color-blue']) !!}
            {!! Form::text('ts_end', null, ['class'=>'form-control','id' => 'ts_end', 'autocomplete' => 'off']) !!}
            @if ($errors->has('ts_end'))
                  <small class="help-block text-danger">
                    {{ $errors->first('ts_end') }}
                </small>
             @endif
        </div>

        <div class="col-4 pt-3">
            {!! Form::label('time_end', 'Horário Término: ', ['class' => 'color-blue']) !!}
            {!! Form::text('time_end', $timeEnd, ['class'=>'form-control','id' => 'time_end', 'autocomplete' => 'off']) !!}
            @if ($errors->has('time_end'))
                  <small class="help-block text-danger">
                    {{ $errors->first('time_end') }}
                </small>
             @endif
        </div>


</div>

   <div class="col-md-12 text-right">
      <button class="btn btn-success" type="submit" data-toggle="tooltip" title="Cadastrar" > <span>Atualizar</span></button>
   </div>

  {!! Form::close() !!}

@endsection
@section('scripts')
@parent
<script type="text/javascript">
    $(document).ready(function () {

      $('#ts_start').datepicker({
           format: "yyyy-mm-dd",
           language: "pt-BR",
           autoclose: true
     });

     $('#ts_end ').datepicker({
          format: "yyyy-mm-dd",
          language: "pt-BR",
          autoclose: true
    });

    $('#time_start').timepicker({
      showMeridian: false,
      showSeconds: true,
      maxHours: 24,
      defaultTime: '08:00:00'
    });

     $('#time_end').timepicker({
       showMeridian: false,
       showSeconds: true,
       maxHours: 24,
       defaultTime: '18:00:00'
     });

    });
</script>
@endsection
