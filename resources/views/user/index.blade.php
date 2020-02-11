@extends('layouts.app')

@section('content')
    <div class="container">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <div class="page-title">
                    <span class="page-title-text text-primary">Update your information</span>
                </div>
                <div class="content-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">All fields are required</h3>
                    </div>
                    <div class="box-body">
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
                                <button id="btnConfirm" onClick="update()" class="btn btn-primary btn-flat">Confirm</button>
                            </div>
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

            $("#btnConfirm").html('Wait...').prop('disabled', true);

            $.ajax({
                url: '/user',
                type: 'PUT',
                data: {
                    name: name,
                    email: email
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