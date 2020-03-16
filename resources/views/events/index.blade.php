@extends('layouts.app', ['bodyClass' => 'page-top'])

@section('content')
    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('layouts.includes.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                @include('layouts.includes.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @if (\Illuminate\Support\Facades\Session::has('message'))
                        <div class="alert alert-info">{{ \Illuminate\Support\Facades\Session::get('message') }}</div>
                    @endif

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Events</h1>

                    <div class="d-flex justify-content-between mb-4">
                        <a href="{{ route('events.create') }}" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                              <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Add new event</span>
                        </a>

                        <div>
                            <a href="{{ route('events.create', ['import' => true]) }}" class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                  <i class="fas fa-upload"></i>
                                </span>
                                <span class="text">Import events in CSV</span>
                            </a>

                            <a href="{{ route('events.index', [$activeType => true, 'export' => true]) }}" target="_blank" class="btn btn-info btn-icon-split">
                                <span class="icon text-white-50">
                                  <i class="fas fa-download"></i>
                                </span>
                                <span class="text">Export events in CSV</span>
                            </a>
                        </div>

                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="btn-group btn-block mb-3">
                                <a href="{{ route('events.index', ['today' => true]) }}" type="button" class="btn @if($activeType == 'today') btn-primary text-white @else btn-light @endif">Today Events</a>
                                <a href="{{ route('events.index', ['next5days' => true]) }}" type="button" class="btn @if($activeType == 'next5days') btn-primary text-white @else btn-light @endif">Next 5 Days Events</a>
                                <a href="{{ route('events.index') }}" type="button" class="btn @if($activeType == 'all') btn-primary text-white @else btn-light @endif">All Events</a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Start Date Time</th>
                                            <th>End Date Time</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($events as $event)
                                        <tr>
                                            <td>{{ $event->title }}</td>
                                            <td>{{ $event->start_datetime->format('d/m/Y H:i') }}</td>
                                            <td>{{ $event->end_datetime->format('d/m/Y H:i') }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('events.edit', ['event' => $event->id]) }}" class="btn btn-primary btn-icon-split d-inline-block">
                                                    <span class="icon text-white-50">
                                                      <i class="fas fa-edit"></i>
                                                    </span>
                                                    <span class="text">Edit</span>
                                                </a>
                                                <a href="#" data-toggle="modal" data-target="#inviteModal" class="btn btn-info btn-icon-split d-inline-block">
                                                    <span class="icon text-white-50">
                                                      <i class="fas fa-mail-bulk"></i>
                                                    </span>
                                                    <span class="text">Invite</span>
                                                </a>
                                                <form action="{{ route('events.destroy', ['event' => $event->id]) }}" method="post" class="form-destroy d-inline-block">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" class="btn btn-danger btn-icon-split">
                                                        <span class="icon text-white-50">
                                                          <i class="fas fa-trash"></i>
                                                        </span>
                                                        <span class="text">Delete</span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach

                                        @if(count($events) == 0)
                                            <tr>
                                                <td colspan="4" class="text-center">
                                                    Nenhum evento encontrado.
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>

                                {{ $events }}
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('layouts.includes.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    @include('layouts.includes.scroll-to-top')

    @include('layouts.includes.logout-modal')

    <!-- Invite Modal-->
    <div class="modal fade" id="inviteModal" tabindex="-1" role="dialog" aria-labelledby="inviteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inviteModalLabel">Who you want to invite?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="name">Name</label>
                                <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <small class="mt-2 pl-3 text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </small>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <small class="mt-2 pl-3 text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea name="message" id="message" class="form-control form-control-user" rows="10" placeholder="Message...">{{ old('message') }}</textarea>

                            @if ($errors->has('message'))
                                <small class="mt-2 pl-3 text-danger">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </small>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                        <button type="submit" class="btn btn-primary">Send invite</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.form-destroy').submit(function(e) {
                return confirm('Are you sure?');
            });
        });
    </script>
@endsection
