<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>{{ (!empty($config->nome) ? $config->nome : 'Área administrativa') }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <link href="/coloradmin/css/vendor.css" rel="stylesheet" />
    <link href="/plugins/gritter/css/gritter.css" rel="stylesheet" />
    
    <!-- ================== END BASE CSS STYLE ================== -->
    @yield('styles')
    <!-- ================== BEGIN BASE JS ================== -->
    {{-- <script src="/assets/plugins/pace/pace.min.js"></script> --}}
    <!-- ================== END BASE JS ================== -->
</head>
<body>
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade show"><span class="spinner"></span></div>
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">

            @yield('content')
        
    </div>
    <!-- end page container -->

    <!-- ================== END BASE JS ================== -->
        
    <script src="/coloradmin/js/vendor.js"></script>
    <script src="/plugins/gritter/js/gritter.js"></script>

    @yield('scripts')

    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
</body>
</html>