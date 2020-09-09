<!DOCTYPE html>
<html>
    <head>
	 <meta charset="utf-8">
     <title>Laravel</title>
	 <link rel="stylesheet" href="css/aplication.css">
	 <script src="js/jquery_min.js"></script>
    </head>
    <body>
	 @yield('content')
	 
	 @section('sidebar')
	 <div class="sidebar">
		<h3>Sidebar</h3>
		This is the sidebar
	 </div>
    </body>
</html>
