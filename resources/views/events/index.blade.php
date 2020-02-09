@extends('layouts.app')

@section('content')
    <div class="container">
        @if($errors->any())
            <div class="callout">
                <h4>Oops</h4>
                <p>{{$errors->first()}}</p>
            </div>
        @endif
        <div class="page-title">
            <span class="page-title-text text-primary">My Events</span>
            <button onClick="window.open('{{route('event-new')}}', '_parent')" class="btn btn-primary btn-flat pull-right">Add new event</button>
        </div>
    </div>
    <div class="container">
        <div class="content-box">
            <div class="box-header with-border">
                <h3 class="box-title">List of all events</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-condensed table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Start Date</th>
                                        <th>Finish Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $event)
                                        <tr id="row{{$event['id']}}">
                                            <td>{{$event['id']}}</td>
                                            <td>{{$event['title']}}</td>
                                            <td>{{date('m/d/Y H:i', strtotime($event['start_date']))}}</td>
                                            <td>{{date('m/d/Y H:i', strtotime($event['finish_date']))}}</td>
                                            <td class="icons-col">
                                                <a href="{{route('event-new')}}"><i class="fa fa-eye"></i></a>
                                                <a href="/event/{{\Crypt::encryptString($event['id'])}}/update"><i class="fa fa-pencil"></i></a>
                                                <i class="fa fa-trash"></i>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>  
                        <div class="row">
                            <div class="col-xs-12">
                                {{$events->render()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection