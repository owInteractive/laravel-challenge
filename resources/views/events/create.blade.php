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
                    <h1 class="h3 mb-4 text-gray-800">{{ $type == 'create'?'Create new event':'Import events' }}</h1>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="{{ route('events.store', ['type' => $type]) }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                @if($type == 'create')
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control form-control-user" id="title" name="title" placeholder="Title" value="{{ old('title') }}">

                                        @if ($errors->has('title'))
                                            <small class="mt-2 pl-3 text-danger">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </small>
                                        @endif
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="start_datetime">Start Datetime</label>
                                        <input type="datetime-local" class="form-control form-control-user" id="start_datetime" name="start_datetime" placeholder="Start Datetime" value="{{ old('start_datetime') }}">

                                        @if ($errors->has('start_datetime'))
                                            <small class="mt-2 pl-3 text-danger">
                                                <strong>{{ $errors->first('start_datetime') }}</strong>
                                            </small>
                                        @endif
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="end_datetime">End Datetime</label>
                                        <input type="datetime-local" class="form-control form-control-user" id="end_datetime" name="end_datetime" placeholder="End Datetime" value="{{ old('end_datetime') }}">

                                        @if ($errors->has('end_datetime'))
                                            <small class="mt-2 pl-3 text-danger">
                                                <strong>{{ $errors->first('end_datetime') }}</strong>
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control form-control-user" rows="10" placeholder="Description...">{{ old('description') }}</textarea>

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
                                @elseif($type == 'import')
                                    <div class="form-group">
                                        <label for="file">File</label>
                                        <input type="file" class="form-control form-control-user" id="file" name="file" placeholder="File" value="{{ old('file') }}">

                                        @if ($errors->has('file'))
                                            <small class="mt-2 pl-3 text-danger">
                                                <strong>{{ $errors->first('file') }}</strong>
                                            </small>
                                        @endif
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                          <i class="fas fa-upload"></i>
                                        </span>
                                            <span class="text">Import</span>
                                        </button>
                                    </div>
                                @endif
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
