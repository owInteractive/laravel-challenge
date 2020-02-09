@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
       <div class="col-xs-12 col-md-3">
           <div class="box box-blue">
                <div class="inner">
                    <h3>0</h3>
                    <p>New access</p>
                </div>
                <div class="icon">
                    <i class="fa fa-plus"></i>
                </div>
           </div>
       </div>
       <div class="col-xs-12 col-md-3">
            <div class="box box-green">
                <div class="inner">
                    <h3>0</h3>
                    <p>Confirmed</p>
                </div>
                <div class="icon">
                    <i class="fa fa-check"></i>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <div class="box box-orange">
                <div class="inner">
                    <h3>0</h3>
                    <p>Interested</p>
                </div>
                <div class="icon">
                    <i class="fa fa-question"></i>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <div class="box box-red">
                <div class="inner">
                    <h3>0</h3>
                    <p>Denied</p>
                </div>
                <div class="icon">
                    <i class="fa fa-times"></i>
                </div>
            </div>
        </div>
   </div>
</div>
@endsection
