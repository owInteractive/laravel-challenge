@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                <div class="event" title="Create">
                    <div class="background" style="background: url('data:image/jpg;base64, {{$data['image']}}');background-position: center;background-size: cover;">
                    </div>
                    <div class="overlay">
                        <div class="buttons">
                            <span><a href="{{route('event-new')}}"><i class="fa fa-plus"></i></a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection