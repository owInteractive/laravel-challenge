@extends('layouts.page')
@section('content')
<div class="error">
    <div class="error-code m-b-10">Ops!</div>
    <div class="error-content">
        <div class="error-message">Invitation not found</div>
        <div class="error-desc m-b-30">
            Invitation not exists or expired
        </div>
        <div>
            {{-- <a href="index.html" class="btn btn-success p-l-20 p-r-20">Go Home</a> --}}
        </div>
    </div>
</div>
@endsection