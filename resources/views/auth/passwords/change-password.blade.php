
@extends('layouts.dashboard.app')

@section('content')

<!-- Page-Title -->

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group">
               
            </div>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <h3 class="text-center mb-40">Alterar senha</h3>

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form class="form-horizontal" method="POST" action="{{ route('change-password') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                                <label for="new_password" class="col-md-4 control-label">Senha Atual</label>

                                <div class="col-md-12">
                                    <input id="current_password" type="password" class="form-control" name="current_password" required>

                                    @if ($errors->has('current_password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                                <label for="new_password" class="col-md-4 control-label">Nova Senha</label>

                                <div class="col-md-12">
                                    <input id="new_password" type="password" class="form-control" name="new_password" required>

                                    @if ($errors->has('new_password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="new_password_confirm" class="col-md-4 control-label">Confirme Nova Senha</label>

                                <div class="col-md-12">
                                    <input id="new_password_confirm" type="password" class="form-control" name="new_password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-dark block">
                                        Alterar Senha
                                    </button>
                                    <a href="javascript:history.back()" class="btn btn-danger block">Go Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
