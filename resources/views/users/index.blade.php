@extends('layouts.template.page')

@section('breadcrumbs')
    <ol class="breadcrumb-item active">
        @lang('system.text.users')
    </ol>
@endsection

@section('content-page')
    <div class="card project_list">
        <div class="header">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <a class="btn bg-teal btn-icon float-right text-white"
                       href="{{ route('users.create') }}"
                       title="@lang('system.text.create_user')">
                        <em class="zmdi zmdi-plus"></em>
                    </a>
                </div>
            </div>
            <h2><strong>@lang('system.text.index_users')</strong></h2>
        </div>
        @if ($users)
            <div class="table-responsive">
                <table class="table table-hover c_table"
                       aria-describedby="@lang('system.text.create_user')">
                    <thead class="thead-dark">
                    <tr>
                        <td class="text-center">#</td>
                        <td class="text-left">@lang('system.text.name')</td>
                        <td class="text-left">@lang('system.text.email')</td>
                        <td class="text-center">@lang('system.text.created_at')</td>
                        <td class="text-center">@lang('system.text.actions')</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th class="text-center">{{ $user->id }}</th>
                            <td class="text-left">{{ $user->name }}</td>
                            <td class="text-left">{{ $user->email }}</td>
                            <td class="text-center">{{ date('d/m/Y H:i:s', strtotime($user->created_at)) }}</td>
                            <td class="text-center">
                                <a href="{{ route('users.edit', $user->id) }}"
                                   class="btn btn-warning btn-icon text-white"
                                   data-toggle="tooltip"
                                   title="@lang('system.text.edit_user')">
                                    <em class="zmdi zmdi-edit"></em>
                                </a>
                                <a class="btn bg-deep-orange btn-icon text-white"
                                   data-toggle="tooltip"
                                   title="@lang('system.text.destroy_user')"
                                   onclick="swalDestroy('{{ $user->id }}', '@lang('system.text.destroy_user_cancel')')">
                                    <em class="zmdi zmdi-delete"></em>
                                    <form style="display:none;"
                                          action="{{ route('users.destroy', $user->id) }}"
                                          method="post"
                                          id="form-destroy-{{ $user->id }}">
                                        {{ csrf_field() }}
                                        <input name="_method"
                                               type="hidden"
                                               value="DELETE">
                                    </form>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="justify-content-center">
                {{ $users->links() }}
            </div>
        @else
            <div class="alert alert-dismissible alert-danger text-center"
                 role="alert">
                <div class="container">
                    <strong>@lang('system.text.no_results')</strong>
                    <button class="close"
                            type="button"
                            data-dismiss="alert"
                            aria-label="Close">
                        <span aria-hidden="true"><em class="zmdi zmdi-close"></em></span>
                    </button>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('extra-styles')
    <link href="{{ asset('template/plugins/sweetalert/sweetalert.css') }}"
          rel="stylesheet" />
@endsection
@section('extra-scripts')
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('template/js/pages/ui/sweetalert.js') }}"></script>
@endsection
