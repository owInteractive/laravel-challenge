@section('scripts')
    <script>
        document.getElementById("btnImport").onchange = function () {
            document.getElementById("importForm").submit();
        };
    </script>
@endsection

<div>
    <form action="{{route('events.import')}}"
          method="post"
          id="importForm"
          enctype="multipart/form-data"
    >
        {{ csrf_field() }}
        <label for="inputFile">
            <i></i><br>
            <span>Import Events</span>
        </label>
        <input id="btnImport" type="file" name="events"/>
{{--        <button class="btn btn-primary btn-sm" id="btnImport">Import</button>--}}
    </form>
</div>
