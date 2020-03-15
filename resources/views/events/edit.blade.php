@extends('layouts.template.page')


@section('breadcrumbs')
    <ol class="breadcrumb-item">
        <a href="{{ route('events.index') }}"
           data-toggle="tooltip"
           title=""
           data-original-title="@lang('system.text.events')">
            @lang('system.text.events')
        </a>
    </ol>
    <ol class="breadcrumb-item active">
        @lang('system.text.edit_event')
    </ol>
@endsection

@section('content-page')
    <div class="card">
        <form action="{{ route('events.update', $event->id) }}"
              method="POST">
            {{ csrf_field() }}
            <input name="_method"
                   type="hidden"
                   value="PATCH">
            <input type="hidden"
                   name="id"
                   value="{{ $event->id }}" />
            <div class="header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button type="submit"
                                class="btn bg-teal btn-icon float-right text-white"
                                data-toggle="tooltip"
                                title="@lang('system.text.save')">
                            <span class="ti-save font-bold"></span>
                        </button>
                    </div>
                </div>
                <h2><strong>@lang('system.text.edit_event')</strong></h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="title">@lang('system.text.title')</label>
                        <div class="form-group">
                            <input type="text"
                                   class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                   placeholder="@lang('system.text.title')"
                                   id="title"
                                   value="{{ $event->title }}"
                                   name="title" />
                            @if ($errors->has('title'))
                                <label id="title-error"
                                       class="error"
                                       for="title"><strong>{{ $errors->first('title') }}</strong></label>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="start_at">
                            @lang('system.text.start')
                        </label>
                        <div class="form-group">
                            <input class="form-control datetimepicker {{ $errors->has('start_at') ? 'is-invalid' : '' }}"
                                   type="text"
                                   id="start_at"
                                   placeholder="@lang('system.text.start')"
                                   value="{{ date('Y-m-d H:i', strtotime($event->start_at)) }}"
                                   name="start_at" />
                            @if ($errors->has('start_at'))
                                <label id="start_at-error"
                                       class="error"
                                       for="start_at"><strong>{{ $errors->first('start_at') }}</strong></label>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="end_at">
                            @lang('system.text.end')
                        </label>
                        <div class="form-group">
                            <input class="form-control datetimepicker {{ $errors->has('end_at') ? 'is-invalid' : '' }}"
                                   type="text"
                                   id="end_at"
                                   placeholder="@lang('system.text.end')"
                                   value="{{ date('Y-m-d H:i', strtotime($event->end_at)) }}"
                                   name="end_at" />
                            @if ($errors->has('end_at'))
                                <label id="end_at-error"
                                       class="error"
                                       for="end_at"><strong>{{ $errors->first('end_at') }}</strong></label>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="description">@lang('system.text.description')</label>
                        <div class="form-group">
                            <textarea class="form-control {{ $errors->has('end_at') ? 'is-invalid' : '' }}"
                                      name="description"
                                      id="description"
                                      rows="10"
                                      placeholder="@lang('system.text.description')">{{ $event->description }}</textarea>
                            @if ($errors->has('description'))
                                <label id="description-error"
                                       class="error"
                                       for="description"><strong>{{ $errors->first('description') }}</strong></label>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('extra-styles')
    <link rel="stylesheet"
          href="{{ asset('template/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" />
@endsection

@section('extra-scripts')
    <script src="{{ asset('template/plugins/momentjs/moment.js') }}"></script>
    <script src="{{ asset('template/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
    <script type="text/javascript">
        $('.datetimepicker').bootstrapMaterialDatePicker({
            lang: 'pt-br',
            format: 'YYYY-MM-DD HH:mm',
            clearButton: true,
            // nowButton: true,
            weekStart: 1,
            time: true,
            cancelText: 'Cancelar',
            clearText: 'Limpar',
            // nowText: "Data atual",
            okText: 'Salvar',
        });
    </script>
@endsection