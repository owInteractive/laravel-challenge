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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Edit event</h1>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="{{ route('events.update', ['event' => $event->id]) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control form-control-user" id="title" name="title" placeholder="Title" value="{{ old('title')?old('title'):$event->title }}">

                                        @if ($errors->has('title'))
                                            <small class="mt-2 pl-3 text-danger">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </small>
                                        @endif
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="start_datetime">Start Datetime</label>
                                        <input type="datetime-local" class="form-control form-control-user" id="start_datetime" name="start_datetime" placeholder="Start Datetime" value="{{ old('start_datetime')?old('start_datetime'):$event->start_datetime->format('Y-m-d\TH:i') }}">

                                        @if ($errors->has('start_datetime'))
                                            <small class="mt-2 pl-3 text-danger">
                                                <strong>{{ $errors->first('start_datetime') }}</strong>
                                            </small>
                                        @endif
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="end_datetime">End Datetime</label>
                                        <input type="datetime-local" class="form-control form-control-user" id="end_datetime" name="end_datetime" placeholder="End Datetime" value="{{ old('end_datetime')?old('end_datetime'):$event->end_datetime->format('Y-m-d\TH:i') }}">

                                        @if ($errors->has('end_datetime'))
                                            <small class="mt-2 pl-3 text-danger">
                                                <strong>{{ $errors->first('end_datetime') }}</strong>
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control form-control-user" rows="10" placeholder="Description...">{{ old('description')?old('description'):$event->description }}</textarea>

                                    @if ($errors->has('description'))
                                        <small class="mt-2 pl-3 text-danger">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </small>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                          <i class="fas fa-save"></i>
                                        </span>
                                        <span class="text">Save</span>
                                    </button>
                                </div>
                            </form>
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

@endsection
