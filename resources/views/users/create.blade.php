@extends('layouts.template.page')

@section('breadcrumbs')
    <ol class="breadcrumb-item">
        <a href="{{ route('users.index') }}"
           data-toggle="tooltip"
           title=""
           data-original-title="@lang('system.text.users')">
            @lang('system.text.users')
        </a>
    </ol>
    <ol class="breadcrumb-item active">
        @lang('system.text.create_user')
    </ol>
@endsection

@section('content-page')
    <div class="card">
        <form action="{{ route('users.store') }}"
              method="POST">
            {{ csrf_field() }}
            <div class="header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button type="submit"
                                class="btn bg-teal btn-icon float-right text-white"
                                data-toggle="tooltip"
                                title="@lang('system.text.save')">
                            <span class="ti-save font-bold"></span>
                        </button>
                    </div>
                </div>
                <h2><strong>@lang('system.text.create_user')</strong></h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-sm-6">
                        <label for="name">@lang('system.text.name')</label>
                        <div class="form-group">
                            <input type="text"
                                   class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                   placeholder="@lang('system.text.name')"
                                   id="name"
                                   value="{{ old('name') }}"
                                   name="name" />
                            @if ($errors->has('name'))
                                <label id="name-error"
                                       class="error"
                                       for="name"><strong>{{ $errors->first('name') }}</strong></label>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="email">@lang('system.text.email')</label>
                        <div class="form-group">
                            <input type="email"
                                   class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                   placeholder="@lang('system.text.email')"
                                   id="email"
                                   value="{{ old('email') }}"
                                   name="email" />
                            @if ($errors->has('email'))
                                <label id="email-error"
                                       class="error"
                                       for="email"><strong>{{ $errors->first('email') }}</strong></label>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="password">@lang('system.text.password')</label>
                        <div class="form-group">
                            <input type="password"
                                   class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                   placeholder="@lang('system.text.password')"
                                   id="password"
                                   value="{{ old('password') }}"
                                   name="password" />
                            @if ($errors->has('password'))
                                <label id="password-error"
                                       class="error"
                                       for="password"><strong>{{ $errors->first('password') }}</strong></label>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="password_confirmation">@lang('system.text.password_confirmation')</label>
                        <div class="form-group">
                            <input type="password"
                                   class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                   placeholder="@lang('system.text.password_confirmation')"
                                   id="password_confirmation"
                                   value="{{ old('password_confirmation') }}"
                                   name="password_confirmation" />
                            @if ($errors->has('password_confirmation'))
                                <label id="password_confirmation-error"
                                       class="error"
                                       for="password_confirmation"><strong>{{ $errors->first('password_confirmation') }}</strong></label>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('extra-styles')
@endsection

@section('extra-scripts')
    <script type="text/javascript">
    </script>
@endsection
