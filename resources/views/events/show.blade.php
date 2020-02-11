@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="content-box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <center>
                                            <span class="text-primary event-title">{{$event['title']}}</span><br>
                                            <span>{{date('m/d/Y', strtotime($event['start_date']))}} {{date('H:i', strtotime($event['start_date']))}} to
                                            {{date('m/d/Y', strtotime($event['finish_date']))}} {{date('H:i', strtotime($event['finish_date']))}}</span>
                                        </center>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p class="event-description">{{$event['description']}}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-12" style="font-size: 2rem; text-align: center; font-weight: bolder">
                                        <i class="fa fa-clock-o"></i> Starts in
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 text-primary" style="font-size: 4rem; text-align: center; font-weight: bolder">
                                        <center>
                                            <span id="countdown_start"></span>
                                        </center>
                                    </div>
                                </div>
                                @if (date('Y-m-d H:i:s') > $event['finish_date'])
                                <hr>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <center>
                                            <div class="btn-group">
                                                <button onClick="showModalInvite('2')" class="btn btn-primary btn-flat btn-lg">I'm going</button>
                                                <button onClick="showModalInvite('1')" class="btn btn-warning btn-flat btn-lg">I'm interested</button>
                                                <button onClick="showModalInvite('3')" class="btn btn-danger btn-flat btn-lg">I'm not interested</button>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                                @endif
                                <div class="row invite" style="display: none">
                                    <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="input-group">
                                                    <input id="email" type="search" class="form-control" placeholder="We need your email first">
                                                    <span class="input-group-btn">
                                                        <button onClick="confirm()" class="btn btn-primary btn-flat" type="button"><i class="fa fa-check"></i> Confirm!</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="start_time" value="{{$event['start_date']}}">
    <input type="hidden" id="event_id" value="{{\Crypt::encryptString($event['id'])}}">

    <script>
        var invite_status = 0;

        function showModalInvite(status) {
            invite_status = status;
            $(".invite").fadeIn();
            $("#email").focus();
        }
        
        function confirm(){
            let email = $("#email").val();
            let id = $("#event_id").val();

            $.ajax({
                method: 'POST',
                url: '{{route("invite-new")}}',
                data: {
                    event_id: id,
                    status: invite_status,
                    email: email
                },
                success: function(response) {
                    $("input").removeClass('input-error');
                    toastr['success']('Thanks for your feedback!');
                },
                error: function(response) {
                    $("input").removeClass('input-error');
                    for(let i in response.responseJSON) {
                        $("#"+i).addClass('input-error');
                        for(let j in response.responseJSON[i]) {
                            toastr['error'](`${response.responseJSON[i][j]}`)
                        }
                    }
                    $("#btnConfirm").html('<i class="fa fa-check"></i> Confirm!').prop('disabled', false);
                }
            })
        }

        // Set the date we're counting down to
        var countDownDate = new Date($("#start_time").val()).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {
            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById("countdown_start").innerHTML = days + "d " + hours + "h "
            + minutes + "m " + seconds + "s ";

            if(seconds < 0) {
                document.getElementById("countdown_start").innerHTML = "0d 0h 0m 0s";
            }
        }, 1000);
    </script>
@endsection