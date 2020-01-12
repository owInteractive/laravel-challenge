@extends('layout')

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

    <style>
        input[type="file"] {
            display: none;
        }
        .custom-btn-file {
            border: 1px solid #ccc;
            padding: 80px;
            cursor: pointer;
            text-align: center;
            display: block;
            border-radius: 10px;
            font-size: 20px;
            width: 100%;
            background: whitesmoke;
        }
        .custom-btn-file:hover {
            background-color: #e8e8e8;
        }
        .custom-btn-file i {
            font-size: 35px;
        }
    </style>

    <script>
        document.getElementById("inputFile").onchange = function() {
            document.getElementById("importForm").submit();
        };
    </script>

@endsection