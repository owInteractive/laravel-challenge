<div class="container d-flex justify-content-center display-inline">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <span class="badge badge-danger badge-pill">
                {{ $error }}
            </span>
        @endforeach
    @endif
    @if( \Session::has('message') )
        <span id="success" class="badge badge-secondary badge-pill">
            {{ \Session::get('message') }}
        </span>
    @endif
    @if( \Session::has('error') )
        <span id="danger" class="badge badge-danger badge-pill">
            {{ \Session::get('error') }}
        </span>
    @endif
</div>