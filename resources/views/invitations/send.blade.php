@extends('layouts.dashboard.app')
@section('content')
<div class="row m-t-50">
    <div class="col-lg-12">
        <div class="card-box">
            <h4 class="header-title mb-4">
                New invitation

            </h4>

            <form method="POST" class="form-horizontal" action="{{ route('process') }}">
                {{ csrf_field() }}

                <input type="hidden" id="event_id" name="event_id" value="{{$event->id}}">

                <div class="form-group row m-b-20">
                    <div class="col-4">
                        <label for="title">{{ __('labels.Title') }}</label>

                        <p>{{$event->title}}</p>

                    </div>

                    <div class="col-4">
                        <label for="start">{{ __('labels.Start') }}</label>

                        <p>{{$event->start}}</p>

                    </div>


                    <div class="col-4">
                        <label for="end">{{ __('labels.End') }}</label>

                        <p>{{$event->end}}</p>

                    </div>
                </div>

                <div class="form-group row m-b-20">
                    <div class="col-12">
                        <label for="title">{{ __('labels.Email') }}</label>

                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                name="email" value="{{isset($invite->email) ? $invite->email : old('email')}}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif

                    </div>

                </div>

                <div class="form-group row text-center m-t-10">
                    <div class="col-12">
                        <button type="submit" class="btn btn-block btn-custom btn-dark waves-effect waves-light"
                            type="submit">
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