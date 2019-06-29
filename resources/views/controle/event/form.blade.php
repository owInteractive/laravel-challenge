@extends('bredicoloradmin::layouts.controle')

@section('content')
    <!-- begin breadcrumb -->
    @component('bredicoloradmin::components.migalha')
        <li class="breadcrumb-item"><a href="{{ route('controle.event.index') }}">Event</a></li>
    @endcomponent
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Event</h1>
    <!-- end page-header -->
    <div class="row">
        <div class="col-lg-8">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    </div>
                    <h4 class="panel-title">Event</h4>
                </div>
                <div class="panel-body">
                    {!! Form::model(isset($event) ? $event : null,['route' => (isset($event->id) ? ['controle.event.update', $event->id] : 'controle.event.store'), 'files' => true]) !!}
                        <fieldset>
                            <div class="form-group">
                                <label for="title">Title<span class="text-danger">*</span></label>
                                {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                                                                                                                                                                                                                                                    
                            <div class="form-group">
                                <label for="description">Description<span class="text-danger">*</span></label>
                                {!! Form::textarea('description',null, ['class' => 'form-control', 'required']) !!}
                            </div>
                                                                                                                                                                            
                            <div class="form-group row m-t-10">
                                <label for="start_date" class="col-sm-1">Start<span class="text-danger">*</span></label>
                                <div class="col-sm-3">
                                    {!! Form::date('start_date', null, ['class' => 'form-control', 'required']) !!}
                                </div>
                                <label for="start_time" class="col-sm-1">Time<span class="text-danger">*</span></label>
                                <div class="col-sm-3">
                                    {!! Form::time('start_time', null, ['class' => 'form-control ', 'required']) !!}
                                </div>
                            </div>
                                                                                                
                            <div class="form-group row m-t-10">
                                <label for="end_date" class="col-sm-1">End<span class="text-danger">*</span></label>
                                <div class="col-sm-3">
                                    {!! Form::date('end_date', null, ['class' => 'form-control', 'required']) !!}
                                </div>
                                <label for="end_time" class="col-sm-1">Time<span class="text-danger">*</span></label>
                                <div class="col-sm-3">
                                    {!! Form::time('end_time', null, ['class' => 'form-control ', 'required']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <legend>Invite</legend>
                                <label for="start">E-mails</label>
                                {{-- <div class="tags"></div> --}}
                                {!! Form::hidden('emails', null, ['class' => 'form-control', 'id' => 'tags']) !!}
                            </div>
                                
                            <button type="submit" class="btn btn-sm btn-primary m-r-5">Salvar</button>
                            
                            <a href="{{ route('controle.event.index') }}" class="btn btn-sm btn-default">Cancelar</a>
                        </fieldset>
                    {!! Form::close() !!}

                </div> <!-- panel-body -->
            </div>
            <!-- end panel -->

        </div>
    </div>
    
@stop

@section('styles')
<link rel="stylesheet" href="/admin/css/vendor.css">
<link rel="stylesheet" href="/plugins/jquery-tag-it/css/jquery.tagit.css">
@endsection

@section('scripts')
<script src="/admin/js/vendor.js"></script>
<script src="/plugins/jquery-tag-it/js/tag-it.min.js"></script>
<script>
    $(function() {

        $("#tags").tagit();

        {{-- $('.daterangepicker').daterangepicker(); --}}

        
        $('.daterangepicker').daterangepicker({
          singleDatePicker: true,
          showDropdowns: true,
          minYear: 1901,
          maxYear: parseInt(moment().format('YYYY'),10)
        }, function(start, end, label) {
          var years = moment().diff(start, 'years');
          alert("You are " + years + " years old!");
        });
       
    }); 
</script>
@endsection