@extends('layouts.dashboard.app')
@section('content')


<div class="row text-center m-t-50">
    <div class="col-lg-12">
        <div class="card-box">
            <h4 class="header-title mb-4">
                All Events

                ({{ $events->count()}})
            </h4>
            <a href="{{ route('events.create') }}" class="pull-right btn btn-dark w-md waves-effect waves-light mb-4">
                <i class="mdi mdi-plus-circle"></i>
                New Event
            </a>
            @if ($events->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-centered m-0">

                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Start at</th>
                            <th>End in</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)

                        <tr>
                            <td>

                                {{$event->title}}
                            </td>

                            <td>

                                {{ \Carbon\Carbon::parse($event->start)->diffForHumans() }}

                            </td>

                            <td>

                                {{ \Carbon\Carbon::parse($event->end)->diffForHumans() }}
                            </td>

                            <td>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-icon waves-effect btn-light btn-sm" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-options-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('events.edit', ['id' => $event->id])}}" class="dropdown-item">
                                            Edit
                                        </a>

                                        <form action="{{ route('events.destroy', ['id' => $event->id])}}" method="post">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button title="Deletar" class="dropdown-item">Delete</button>
                                        </form>

                                    </div>
                                </div>
                            </td>
                        </tr>

                        @endforeach

                    </tbody>
                </table>


            </div>
            <div class="m-t-30" style="display: inline-grid;">
                {{ $events->links() }}
            </div>

            @else

            <div class="alert alert-dark" role="alert">
                <h4 class="alert-heading">
                    <i class="mdi mdi-timer-sand-empty"></i>
                    No new events found!
                </h4>
                <p>
                    New eventsregistered will appear here!
                </p>
                <hr>

            </div>

            @endif


        </div>

    </div>

</div>
<!-- end row -->

<!-- end row -->
@endsection