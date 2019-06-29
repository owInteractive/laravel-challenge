<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <a href="javascript:;" data-toggle="nav-profile">
                    <div class="cover with-shadow"
                    @if(isset($config->background) and !empty($config->background))
                        style="background-image: url({{$config->background}}) !important;"
                    @endif
                    ></div>
                    <div class="image image-icon bg-black text-grey-darker">
                        @if(!empty(auth()->user()->imagem))
                            <img src="{{ route('imagem.render', 'user/p/' . auth()->user()->imagem) }}" alt="">
                        @else
                            <i class="fa fa-user"></i>
                        @endif
                        {{--  <i class="fa fa-user"></i>  --}}
                    </div>
                    <div class="info">
                        <b class="caret pull-right"></b>
                        {{ auth()->user()->name }}
                        {{--  <small>Front end developer</small>  --}}
                    </div>
                </a>
            </li>
            {{--  <li>
                <ul class="nav nav-profile">
                    <li><a href="javascript:;"><i class="fa fa-cog"></i> Settings</a></li>
                    <li><a href="javascript:;"><i class="fa fa-pencil-alt"></i> Send Feedback</a></li>
                    <li><a href="javascript:;"><i class="fa fa-question-circle"></i> Helps</a></li>
                </ul>
            </li>  --}}
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        @include('bredicoloradmin::includes.menu')
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>