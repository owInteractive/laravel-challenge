@extends('layouts.app')

@section('content')
<div class="container justify-content-center">
    @if( \Session::has('error') )
        <span id="danger" class="badge badge-danger badge-pill">
            {{ \Session::get('error') }}
        </span>
    @endif
    @if (Auth::guest())
        @include('layouts.homeOff')
    @else
        @include('layouts.homeOn')
    @endif

    

</div>
@endsection
