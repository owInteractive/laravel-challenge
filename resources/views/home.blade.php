@extends('template.template')
@section('content')
        <div class="container">
            <div class="row">
                @if(Session::has('status'))
                    <div class="alert alert-primary" role="alert" style="width: 100%; margin-top: 20px;">
                        {{ session('status') }}
                    </div>
                @endif
                <p style="margin: auto; margin-top: 35px;">
                    This is a challenge project made by Fábio Costa to OW Interactive. This is just an example of text that can be here!
                </p>
            </div>
        </div>
@endsection
