@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">{{ $event->title}}</div>

                    <div class="panel-body">
                        <table class="table table-responsive">
                            <tbody>
                                <tr>
                                    <td>{{ trans('event.description') }}</td>
                                    <td>{{ $event->description }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('event.start') }}</td>
                                    <td>
                                        <span data-toggle="tooltip"
                                              data-placement="top"
                                              title="{{ $event->start }}">
                                            {{ $event->startHuman }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ trans('event.end') }}</td>
                                    <td>
                                            <span data-toggle="tooltip"
                                                  data-placement="top"
                                                  title="{{ $event->end }}">
                                                {{ $event->endHuman }}
                                            </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
