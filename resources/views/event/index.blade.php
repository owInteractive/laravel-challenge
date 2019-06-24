@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-4">
                                <span>{{ trans('event.events') }}</span>
                            </div>

                            <div class="col-xs-4">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('event.index') }}" class="btn btn-default">
                                        {{ trans('csv.all') }}
                                    </a>
                                    <a href="{{ route('event.index', [ 'filter' => 'today' ]) }}" class="btn btn-default">
                                        {{ trans('csv.today') }}
                                    </a>
                                    <a href="{{ route('event.index', [ 'filter' => 'next-five-days' ]) }}" class="btn btn-default">
                                        {{ trans('csv.next_five_days') }}
                                    </a>
                                </div>
                            </div>

                            <div class="col-xs-4">
                                <form class="form-inline pull-right" action="{{ route('csv.export') }}">
                                    <div class="input-group input-group-sm">
                                        <select name="filter" class="form-control">
                                            <option value="all">{{ trans('csv.all') }}</option>
                                            <option value="today">{{ trans('csv.today') }}</option>
                                            <option value="next-five-days">{{ trans('csv.next_five_days') }}</option>
                                        </select>
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-default">
                                                {{ trans('csv.export') }}
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>{{ trans('event.title') }}</th>
                                    <th>{{ trans('event.description') }}</th>
                                    <th>{{ trans('event.start') }}</th>
                                    <th>{{ trans('event.end') }}</th>
                                    <th>{{ trans('event.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($events as $event)
                                    <tr>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->description }}</td>
                                        <td>
                                            <span data-toggle="tooltip"
                                                  data-placement="top"
                                                  title="{{ $event->start }}">
                                                {{ $event->startHuman }}
                                            </span>
                                        </td>
                                        <td>
                                            <span data-toggle="tooltip"
                                                  data-placement="top"
                                                  title="{{ $event->end }}">
                                                {{ $event->endHuman }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('event.edit', $event) }}" title="{{ trans('event.edit_event') }}">
                                                <i class="glyphicon glyphicon-edit"></i>
                                            </a>
                                            <a href="{{ route('event.invitation.form', $event) }}" title="{{ trans('event.invitation_event') }}" style="margin-left: 12px;">
                                                <i class="glyphicon glyphicon-share"></i>
                                            </a>
                                            <form action="{{ route('event.destroy', $event) }}" method="post" style="display:inline;">
                                                {{ method_field('delete') }}
                                                {{ csrf_field() }}
                                                <button class="btn btn-link" type="submit" title="{{ trans('event.destroy_event') }}">
                                                    <i class="glyphicon glyphicon-remove"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
