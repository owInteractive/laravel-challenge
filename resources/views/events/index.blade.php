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
                                                <a href="/event/{{\Crypt::encryptString($event['id'])}}/edit"><i class="fa fa-pencil"></i></a>
                                                <i onClick="destroy(this, '{{\Crypt::encryptString($event['id'])}}')" class="fa fa-trash"></i>
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

    <script>
        function destroy(icon, id) {
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure you want to delete this event? Everything data related to this event will be lost!',
                buttons: {
                    "Yes! I am": function () {
                        $(icon).toggleClass("fa-trash fa-spinner").addClass('fa-pulse');
                        $.ajax({
                            url: `/event/${id}/`,
                            type: 'DELETE',
                            success: function(response) {
                                toastr['success']('Your event has been deleted!')
                                $(icon).parent().parent().fadeOut()
                            },
                            error: function(response) {
                                for(let i in response.responseJSON) {
                                    for(let j in response.responseJSON[i]) {
                                        toastr['error'](`${response.responseJSON[i][j]}`)
                                    }
                                }
                                $(icon).toggleClass("fa-trash fa-spinner").removeClass('fa-pulse');
                            }
                        });
                    },
                    "Nah! I am not": function () {
                        $.alert('Canceled!');
                    }
                }
            });
        }
    </script>
@endsection