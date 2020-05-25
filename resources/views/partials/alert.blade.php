<div class="position-absolute min-vw-100" id="alert-div">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-3 mx-auto w-25"  style="z-index: 999" role="alert"><strong>Success</strong> {{ __(session('success')) }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show m-3 mx-auto w-25"  style="z-index: 999" role="alert">
            <strong>Error!</strong> {{ __(session('error')) }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>


<script>
    $(document).ready(function () {
        $('button[id="buttonClose"]').click(function () {
            $('div[id="alert-div"]').hide();
        })
    })
</script>