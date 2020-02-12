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
        <label class="btn btn-primary btn-sm" >
            Import
            <input id="btnImport" type="file" name="events" style="display: none"/>
        </label>
    </form>
</div>
