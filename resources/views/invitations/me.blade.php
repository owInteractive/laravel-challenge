@extends('layouts.dashboard.app')
@section('content')


<div class="row text-center m-t-50">
    <div class="col-lg-12">
        <div class="card-box">
            <h4 class="header-title mb-4">
                Invitations for me

                ({{ $invitations->total()}})
            </h4>


            @if ($invitations->count() > 0)
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
                        @foreach ($invitations as $invitation)

                        <tr>
                            <td>

                                {{$invitation->event->title}}
                            </td>

                            <td>

                                {{ \Carbon\Carbon::parse($invitation->event->start)->diffForHumans() }}

                            </td>

                            <td>

                                {{ \Carbon\Carbon::parse($invitation->event->end)->diffForHumans() }}
                            </td>

                            <td>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-icon waves-effect btn-light btn-sm" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-options-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu">

                                        @if ($invitation->presence == true)
                                            <a href="#" class="dropdown-item">
                                                No actions
                                            </a>    
                                        @else
                                            <a href="{{ route('accept', ['token' => $invitation->token])}}" class="dropdown-item">
                                                Accept
                                            </a>
                                        @endif

                                    </div>
                                </div>
                            </td>
                        </tr>

                        @endforeach

                    </tbody>
                </table>


            </div>
            <div class="m-t-30" style="display: inline-grid;">
                {{ $invitations->links() }}
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