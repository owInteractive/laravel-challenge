@extends('layouts.template.page')

@section('breadcrumbs')
    <ol class="breadcrumb-item">
        <a href="{{ route('events.index') }}"
           data-toggle="tooltip"
           title=""
           data-original-title="@lang('system.text.events')">
            <em class="zmdi zmdi-assignment zmdi-hc-lg"></em> @lang('system.text.events')
        </a>
    </ol>
    <ol class="breadcrumb-item active">
        @lang('system.text.event_invites')
    </ol>
@endsection

@section('content-page')
    <div class="card">
        <form action="{{ route('invite', ['id' => $event->id]) }}"
              method="POST"
              enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button type="submit"
                                class="btn bg-teal btn-icon float-right text-white"
                                data-toggle="tooltip"
                                title="@lang('system.text.invite_event')">
                            <span class="ti-save font-bold"></span>
                        </button>
                    </div>
                </div>
                <h2><strong>@lang('system.text.event_invites')</strong></h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="emails">@lang('system.text.emails')</label>
                        <div class="form-group">
                            <textarea name="emails" class="form-control" id="emails"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection