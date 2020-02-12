@extends('layouts.app')

@section('content')

<div class="container">
    @if(isset(\Auth::user()->id))
        <div class="row">
            <div class="col-xs-12 col-md-4" style="padding-right:5px;">
                <div class="box box-white">
                    <div class="inner">
                        <h3>{{$data['panels']['confirmed']}}</h3>
                        <p>Confirmed</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-check"></i>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4" style="padding-right:5px;">
                <div class="box box-white">
                    <div class="inner">
                        <h3>{{$data['panels']['interested']}}</h3>
                        <p>Interested</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-question"></i>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4" style="padding-right:5px;">
                <div class="box box-white">
                    <div class="inner">
                        <h3>{{$data['panels']['denied']}}</h3>
                        <p>Denied</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-times"></i>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="page-title">
        <span class="page-title-text text-primary">{{$data['title']}}</span>
    </div>
    <div class="row">
        @foreach ($data['data'] as $item)
            <div onClick="window.open('/event/{{\Crypt::encryptString($item['id'])}}/edit', '_blank')" class="col-xs-12 col-md-4" style="padding-right:5px;">
                <div class="event-item">
                    <div class="datetime datetime-left">
                        <span class="text-small">{{date('M', strtotime($item['start_date']))}}</span><br>
                        <span class="text-large text-primary">{{date('d', strtotime($item['start_date']))}}</span><br>
                        <span class="text-small">{{date('Y', strtotime($item['start_date']))}}</span>
                    </div>
                    <div class="description">
                        <span class="title text-primary">{{$item['title']}}</span>
                        <div class="icons">
                            <div title="Confirmed" class="icon">
                                <i class="fa fa-check"></i><br>
                                <span>{{isset($data['feedbacks'][$item['id']][2]) ? $data['feedbacks'][$item['id']][2] : 0}}</span>
                            </div>
                            <div title="Interested" class="icon" style="padding-left: 30%;">
                                <i class="fa fa-question"></i><br>
                                <span>{{isset($data['feedbacks'][$item['id']][1]) ? $data['feedbacks'][$item['id']][1] : 0}}</span>
                            </div>
                            <div title="Denied" class="icon" style="padding-left: 30%;">
                                <i class="fa fa-times"></i><br>
                                <span>{{isset($data['feedbacks'][$item['id']][3]) ? $data['feedbacks'][$item['id']][3] : 0}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if($data['paginate'])
            <div class="row">
                <div class="col-xs-12">
                    <center>{{$data['data']->render()}}</center>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

