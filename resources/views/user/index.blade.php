@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="row">
                        <div class="col-xs-12">
                            <label>Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{Auth::user()->name}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <label>Email</label>
                            <input type="text" name="email" id="email" class="form-control" value="{{Auth::user()->email}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <label>Password</label>
                            <input type="password" name="password" id="password" class="form-control" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <label>Confirm password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button onClick="update()" class="btn btn-primary btn-flat">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function update() {
            let name = $("#name").val();
            let email = $("#email").val();
            let password = $("#password").val();
            let password_confirmation = $("#password_confirmation").val();

            $("#btnConfirm").html('Wait...').prop('disabled', true);

            $.ajax({
                url: '/user',
                type: 'PUT',
                data: {
                    name: name,
                    email: email,
                    password: password,
                    password_confirmation: password_confirmation
                },
                success: function(response) {
                    $("input").removeClass('input-error');
                    toastr['success']('Data saved successfully')
                    $("#btnConfirm").html('Confirm').prop('disabled', false);
                },
                error: function(response) {
                    for(let i in response.responseJSON) {
                        console.log(i);
                        $("#"+i).addClass('input-error');
                        for(let j in response.responseJSON[i]) {
                            toastr['error'](`${response.responseJSON[i][j]}`)
                        }
                    }
                    $("#btnConfirm").html('Confirm').prop('disabled', false);
                }
            });
        }
    </script>
@endsection