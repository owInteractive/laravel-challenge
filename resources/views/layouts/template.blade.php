<!DOCTYPE html>
<html lang="pt">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Meu Painel - Index</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('b4/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

   <!-- Custom styles for this template -->
   <link href="{{ asset('b4/css/sb-admin-2.min.css')}}" rel="stylesheet">

   <!-- Custom styles for this page -->
    <link href="{{ asset('b4/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

   <link href="{{ asset('b4/css/toastr.min.css')}}" rel="stylesheet"/>
   <script src="{{ asset('b4/js/jquery-3.4.1.min.js') }}"></script>
   <script src="{{ asset('b4/js/toastr.min.js') }}"></script>
  

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    @if (Auth::guest())
    @else
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas  fa-calendar-alt"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Calendar <sup>App 2019</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">


      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Painel
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEvents" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-bullhorn"></i>
          <span>Events</span>
        </a>
        <div id="collapseEvents" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Event Actions:</h6>
            <a class="collapse-item" href="{{ route('event.create') }}"> Add New  </a>
            <a class="collapse-item" href="{{ route('importExcel') }}"> Import via Excel</a>
            <a class="collapse-item" href="{{ route('MyEvents',['id'=>Auth::user()->id,'search'=>' ']) }}"> My Events  </a>
            <a class="collapse-item" href="{{ route('ToDaysEvents',['search'=>' ']) }}"> Today Events  </a>
            <a class="collapse-item" href="{{ route('5DaysEvents',['search'=>' ']) }}"> Near for 5 days Events  </a>
            <a class="collapse-item" href="{{ route('event.index') }}"> All Events  </a>

          </div>
        </div>
      </li>
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseinvites" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-envelope-open-text"></i>
            <span>Invites</span>
          </a>
          <div id="collapseinvites" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Invite Page:</h6>
              <a class="collapse-item" href="{{ route('invites',['id'=>Auth::user()->id,'search'=>' ']) }}"> My Invites  </a>
              <a class="collapse-item" href="{{ route('pedingdinvites',['id'=>Auth::user()->id,'search'=>' ']) }}"> My Pending Invites  </a>
              
  
            </div>
          </div>
        </li>

      

      
     
      
    

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          @endif
      

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

                @if (Auth::guest())
                
            @else
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle @if($invitescount == 0) disabled @endif" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                
                @if($invitescount > 0)
                  <span class="badge badge-danger badge-counter">{{$invitescount}}</span>
                @endif
                
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Invite Center
                </h6>
                @foreach($invitesdet as $invite)
                  
                      <a class="dropdown-item d-flex align-items-center" href="{{route('eventShow',['id' => $invite->id_event, 'user'=> Auth::user()->id ])}}">
                          <div class="mr-3">
                            <div class="icon-circle bg-primary">
                              
                                <i class="far fa-calendar-plus text-white"></i>
                                
                              
                            </div>
                          </div>
                          <div>
                            <div class="small text-gray-600">{{ date('Y-m-d H:i',strtotime(old('end',$invite->created_at)))}}</div>
                            <span class="font-weight-bold">Convite para
                              
                              {{$invite->title}}</span>
                          </div>
                        </a>
                @endforeach

                
                <a class="dropdown-item text-center small text-gray-500" href="{{ route('pedingdinvites',['id'=>Auth::user()->id,'search'=>' ']) }}" >Show All Invites</a>
              </div>
            </li>
               
                <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="mr-2 d-none d-lg-inline text-gray-600 small"> {{ Auth::user()->name }}</span>
                          <img class="img-profile rounded-circle" src="{{ asset('/img/avatar.png')}}">
						  
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                          <a class="dropdown-item" href="{{ route('user.edit',Auth::user()->id) }}" >
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                          </a>                        
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                          </a>
                        </div>
                      </li>





            @endif

          <!-- Nav Item - User Information -->
            

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
       
     

    </div>
    <!-- End of Content Wrapper -->

<!-- End of Footer -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="{{ route('logout') }}"
          onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
          
          Logout</a>

          

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>


        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script  src="{{ asset('b4/vendor/jquery/jquery.js') }}"></script>
   <script src="{{ asset('b4/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('b4/vendor/jquery-easing/jquery.easing.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('b4/js/sb-admin-2.js') }}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('b4/vendor/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('b4/vendor/datatables/dataTables.bootstrap4.js') }}"></script>
  

  <script src="{{ asset('js/app.js') }}"></script>
  
   
  @yield('customjs')


 

</body>

</html>
