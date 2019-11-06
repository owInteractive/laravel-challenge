@extends('core.base')

@section('content')

<div class="pl-3 pt-4 pb-4">
  <span class="h3">Importar Eventos</span>
</div>

<form class="form-group" action="{{ route('event.importData') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="file" name="fileCsv">
    <button class="btn btn-success" type="submit">Importar Dados</button>

</form>

@endsection
@section('scripts')
@parent
<script type="text/javascript">
    $(document).ready(function () {


    });
</script>
@endsection
