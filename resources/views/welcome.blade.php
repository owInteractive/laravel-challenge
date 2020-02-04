@extends('layouts.app')
@section('content')
<style>
    .container-fluid {
    padding: 0px;
    }
    .navbar {
        padding: 5px;
        margin: 0px;
    }
}
</style>    
<link rel="stylesheet" href="{{ asset('css/jquery.mosaic.css') }}" crossorigin="anonymous">
<div class="container-fluid">
    <div id="mosaic" class="mosaic">
        <img src="{{ asset('images/mosaic/1.jpg') }}"  width="640" height="494">
        <img src="{{ asset('images/mosaic/2.jpg') }}"  width="640" height="427" >
        <img src="{{ asset('images/mosaic/3.jpg') }}"  width="640" height="425" >
        <img src="{{ asset('images/mosaic/4.png') }}"  width="538" height="640" >
        <img src="{{ asset('images/mosaic/5.jpg') }}"  width="640" height="558" >
        <img src="{{ asset('images/mosaic/6.jpg') }}"  width="640" height="354" >
    </div>
</div>
<script src="{{ asset('js/jquery.mosaic.js') }}"></script>
<script>    
    $(function() {
        $('#mosaic').Mosaic();
    });
</script>    
@endsection