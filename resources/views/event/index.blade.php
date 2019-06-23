@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-success">
                    <div class="panel-heading">{{ trans('event.events') }}</div>

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
                                                  title="{{ $event->start->toDateTimeString() }}">
                                                {{ $event->startHuman }}
                                            </span>
                                        </td>
                                        <td>
                                            <span data-toggle="tooltip"
                                                  data-placement="top"
                                                  title="{{ $event->start->toDateTimeString() }}">
                                                {{ $event->endHuman }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('event.edit', $event) }}" title="{{ trans('event.edit_event') }}">
                                                <i class="glyphicon glyphicon-edit"></i>
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
