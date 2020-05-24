<div class="row min-vw-100">
        <div class="col-2 navbar navbar-expand-lg navbar-light bg-grey">
            <a class="navbar-nav mx-auto" href="#">Welcome, {{ Auth::user()->name }}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="col-10 navbar navbar-expand-lg navbar-light bg-light-custom">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto p-2">
                    <li class="nav-item active">
                        <form method="POST" action="{{ url("/logout") }}">
                            {{ csrf_field() }}
                            <button class="btn btn-outline-danger" type="submit">
                                <i class="fas fa-sign-out-alt mr-1"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
</div>