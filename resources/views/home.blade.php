@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.messages')
    
    @if (Auth::guest())
        @include('layouts.homeOff')
    @else
        @include('layouts.homeOn')
    @endif

    

</div>
@endsection
