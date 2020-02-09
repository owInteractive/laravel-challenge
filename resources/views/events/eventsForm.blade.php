@extends('layouts.app')

@section('css')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('.datetimepicker').datetimepicker();
        });
    </script>
@endsection


@section('content')

    <form action="{{ route('events.store') }}" method="POST">
        {{ csrf_field() }}

        <div class="row" style="max-width: 90%; padding-left: 10px">
            <div class="col-sm-10">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" class="form-control" placeholder="Title">
                </div>
            </div>
            <div class="col-sm-10">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea class="form-control"
                              style="height:150px"
                              name="description"
                              placeholder="Description">
                    </textarea>
                </div>
            </div>

            <div class='col-sm-5'>
                <div class="form-group">
                    <strong>Start Date:</strong>
                    <div class='input-group date'>
                        <input type='text'
                               class="form-control datetimepicker"
                               name="start_date"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class='col-sm-5'>
                <div class="form-group">
                    <strong>End Date:</strong>
                    <div class='input-group date'>
                        <input type='text'
                               class="form-control datetimepicker"
                               name="end_date"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>

    </form>
@stop