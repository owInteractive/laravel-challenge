@extends('layouts.dashboard.app')
@section('content')
    <div class="row m-t-50">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title mb-4">
                    New Event

                </h4>
                @if(isset($event->id))
                    <form  method="POST" enctype="multipart/form-data" action="{{route('events.patch', $event->id)}}">
                @else
                    <form method="POST" class="form-horizontal" action="{{ route('events.store') }}">
                @endif
                {{ csrf_field() }}

                    <div class="form-group row m-b-20">
                        <div class="col-12">
                            <label for="title">{{ __('labels.Title') }}</label>

                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                    name="title" value="{{isset($event->title) ? $event->title : old('title')}}" required autofocus placeholder="{{ __('placeholders.Title') }}">

                                @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif

                        </div>
                    </div>

                    <div class="form-group row m-b-20">
                        <div class="col-12">
                            <label for="description">{{ __('labels.Description') }}</label>

                            <textarea row class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" 
                                value="{{isset($event->description) ? $event->description : old('description')}}" placeholder="{{ __('placeholders.Description') }}"
                                name="description" rows="3"></textarea>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group row m-b-20">
                        <div class="col-12">
                            <label for="start">{{ __('labels.Start') }}</label>

                            <input id="start" type="datetime-local" class="form-control{{ $errors->has('start') ? ' is-invalid' : '' }}"
                                name="start" value="{{isset($event->start) ? $event->start : old('start')}}" required>

                            @if ($errors->has('start'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('start') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group row m-b-20">
                        <div class="col-12">
                            <label for="end">{{ __('labels.End') }}</label>

                            <input id="end" type="datetime-local" class="form-control{{ $errors->has('end') ? ' is-invalid' : '' }}"
                                name="end" value="{{isset($event->end) ? $event->end : old('end')}}" required>

                            @if ($errors->has('end'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('end') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row text-center m-t-10">
                        <div class="col-12">
                            <button type="submit" class="btn btn-block btn-custom btn-dark waves-effect waves-light" type="submit">
                                {{ __('labels.Register') }}
                            </button>
                            <a href="javascript:history.back()" class="btn btn-danger btn-block">Go Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection
