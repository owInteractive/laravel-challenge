<div class="panel panel-default">
    @isset($heading)
    <div class="panel-heading">
        {{ $heading }}        
    </div>
    @endisset
    @isset($body)
    <div class="panel-body">
        {{ $body }}
    </div>
    @endisset
</div>