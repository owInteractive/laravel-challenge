@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-title">
            <span class="page-title-text text-primary">Creating new event</span>
            <button onClick="window.open('{{route('event-list')}}', '_parent')" class="btn btn-primary btn-flat pull-right">My Events</button>
        </div>
    </div>
    <div class="container">
        <div class="content-box">
            <div class="box-header with-border">
                <h3 class="box-title">All fields are required</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12">
                        <label for="title">Title</label>
                        <input type="text" id="title" class="form-control input-lg" placeholder="Write the event title">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="7" class="form-control input-lg" placeholder="Write the event description"></textarea>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12 col-sm-3">
                        <label for="start_date">Start Date</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input id="start_date" type="date" value="<?=date('Y-m-d')?>" class="form-control input-lg">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <label for="start_time">Start Time</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input id="start_time" type="time" value="<?=date('H:i')?>" class="form-control input-lg">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <label for="finish_date">Finish Date</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input id="finish_date" type="date" value="<?=date('Y-m-d')?>" class="form-control input-lg">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <label for="finish_time">Finish Time</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input id="finish_time" type="time" value="<?=date('H:i')?>" class="form-control input-lg">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12">
                        <button id="btnDone" onClick="done()" class="btn btn-primary btn-lg btn-flat"><i class="fa fa-check"></i> Done!</button>
                        <a class="btn btn-default btn-lg btn-flat pull-right" href="{{route('event-list')}}">Go back!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function done(){
            let title = $("#title").val();
            let description = $("#description").val();
            let start_date = $("#start_date").val();
            let start_time = $("#start_time").val();
            let finish_date = $("#finish_date").val();
            let finish_time = $("#finish_time").val();

            let data = {
                title: title,
                description: description,
                start_date: start_date,
                start_time: start_time,
                finish_date: finish_date,
                finish_time: finish_time
            };

            $("#btnDone").html("<i class='fa fa-spinner fa-pulse'></i> Wait...").prop('disabled', true);

            $.ajax({
                url: '{{route("event-post")}}',
                type: 'POST',
                data: data,
                success: function(response) {
                    $("input").removeClass('input-error');
                    $("textarea").removeClass('input-error');
                    toastr['success']('Your event has been created!')
                    $("#btnDone").html('<i class="fa fa-check"></i> Done!').prop('disabled', false);

                    setTimeout(function(){window.open("{{route('event-new')}}", '_parent')},3000)
                },
                error: function(response) {
                    $("input").removeClass('input-error');
                    $("textarea").removeClass('input-error');
                    for(let i in response.responseJSON) {
                        $("#"+i).addClass('input-error');
                        for(let j in response.responseJSON[i]) {
                            toastr['error'](`${response.responseJSON[i][j]}`)
                        }
                    }
                    $("#btnDone").html('<i class="fa fa-check"></i> Done!').prop('disabled', false);
                }
            });

        }
    </script>
@endsection
