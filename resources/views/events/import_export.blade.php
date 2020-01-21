@extends('layout')

@section('title', 'OW Calendar | Import / Export events')

@section('content')

    <div class="card mt-3">

        <div class="card-header">
            <span>Import / Export events</span>
        </div>

        <div class="card-body row">

            <div class="col-md-6">

                <form action="/events/import" id="importForm" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <label for="inputFile" class="custom-btn-file">
                        <i class="fa fa-cloud-upload"></i><br>
                        <span>Import Events</span>
                    </label>
                    <input id="inputFile" type="file" name="ow_events"/>

                </form>

            </div>

            <div class="col-md-6 border-left">

                <form action="/events/export" method="post">

                    {{ csrf_field() }}

                    <button class="custom-btn-file" type="submit">
                        <i class="fa fa-cloud-download"></i><br>
                        <span>Export Events</span>
                    </button>

                </form>

            </div>

        </div>

    </div>

@endsection

@section('scripts')

    <script>
        document.getElementById("inputFile").onchange = function() {
            document.getElementById("importForm").submit();
        };
    </script>

@endsection
