@extends('layouts.template.page')

@section('breadcrumbs')
    <ol class="breadcrumb-item active">
        @lang('system.text.events')
    </ol>
@endsection

@section('content-page')
    <div class="card project_list">
        <div class="header">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <a class="btn bg-teal btn-icon float-right text-white"
                       href="{{ route('events.create') }}"
                       title="@lang('system.text.create_event')">
                        <em class="zmdi zmdi-plus"></em>
                    </a>
                </div>
            </div>
            <h2><strong>@lang('system.text.index_events')</strong></h2>
        </div>
        <div class="body">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-12 text-left">
                    <a class="btn bg-blue text-white"
                       title="@lang('system.text.filters')"
                       href="{{ route('events.index', ['filter' => 'all']) }}">
                        @lang('system.text.all_events')
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                    <a class="btn bg-blue text-white"
                       title="@lang('system.text.filters')"
                       href="{{ route('events.index', ['filter' => 'next']) }}">
                        @lang('system.text.next_events')
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 text-right">
                    <a class="btn bg-blue text-white"
                       title="@lang('system.text.filters')"
                       href="{{ route('events.index', ['filter' => 'today']) }}">
                        @lang('system.text.today_events')
                    </a>
                </div>
            </div>
            <hr>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                    <a class="btn bg-brown text-white"
                       href="{{ route('export') }}"
                       title="@lang('system.text.export')">
                        <em class="zmdi zmdi-download"></em> @lang('system.text.export')
                    </a>
                    <a class="btn bg-brown text-white"
                       href="{{ route('import') }}"
                       title="@lang('system.text.import')">
                        <em class="zmdi zmdi-upload"></em> @lang('system.text.import')
                    </a>
                </div>
            </div>
        </div>
        @if (count($events))
            <div class="table-responsive">
                <table class="table table-hover c_table"
                       aria-describedby="@lang('system.text.create_event')">
                    <thead class="thead-dark">
                    <tr>
                        <td class="text-center">#</td>
                        <td class="text-left">@lang('system.text.title')</td>
                        <td class="text-left">@lang('system.text.start')</td>
                        <td class="text-center">@lang('system.text.end')</td>
                        <td class="text-center">@lang('system.text.description')</td>
                        <td class="text-center">@lang('system.text.actions')</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($events as $event)
                        <tr>
                            <th class="text-center">{{ $event->id }}</th>
                            <td class="text-left">{{ $event->title }}</td>
                            <td class="text-left">{{ date('d/m/Y H:i:s', strtotime($event->start_at)) }}</td>
                            <td class="text-center">{{ date('d/m/Y H:i:s', strtotime($event->end_at)) }}</td>
                            <td class="text-center">{{ $event->description }}</td>
                            <td class="text-center">
                                <a href="{{ route('invite', $event->id) }}"
                                   class="btn btn-default btn-icon text-white"
                                   data-toggle="tooltip"
                                   title="@lang('system.text.edit_event')">
                                    <em class="zmdi zmdi-email"></em>
                                </a>
                                <a href="{{ route('events.edit', $event->id) }}"
                                   class="btn btn-warning btn-icon text-white"
                                   data-toggle="tooltip"
                                   title="@lang('system.text.edit_event')">
                                    <em class="zmdi zmdi-edit"></em>
                                </a>
                                <a class="btn bg-deep-orange btn-icon text-white"
                                   data-toggle="tooltip"
                                   title="@lang('system.text.destroy_event')"
                                   onclick="swalDestroy('{{ $event->id }}', '@lang('system.text.destroy_event_cancel')')">
                                    <em class="zmdi zmdi-delete"></em>
                                    <form style="display:none;"
                                          action="{{ route('events.destroy', $event->id) }}"
                                          method="post"
                                          id="form-destroy-{{ $event->id }}">
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
                {{ $events->links() }}
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