
<html>
<head>
	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>RRHH | @yield('title', 'default') </title>
	<link rel="shortcut icon" href="{{asset('images/favicon.png')}}" type="image/x-icon">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css">-->

	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/datatables/css/dataTables.bootstrap4.css')}}"/>

	<link rel="stylesheet" href="{{ asset('plugins/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/bower_components/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/bower_components/Ionicons/css/ionicons.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css' ) }}"> 
  	<!--<link rel="stylesheet" href="{{ asset('plugins/bower_components/datatables-bs/css/dataTables.bootstrap.css') }}">-->
	<link rel="stylesheet" href="{{ asset('plugins/dist/css/AdminLTE.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/dist/css/skins/skin-blue.css') }}">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	@yield('css')
</head>

<body class="hold-transition skin-blue sidebar-mini">
  	@include('layouts.header')
  	@include('layouts.nav')
    <div class="content-wrapper">
	    @include('layouts.pagination')
	    	<section class="content container-fluid">
            	@include('flash::message')
		   		@include('layouts.errors')
			  	<section>
					@yield('content')
			  	</section>
	    	</section>
  	</div>
	@include('layouts.footer')
	<script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('plugins/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('plugins/dist/js/adminlte.min.js') }}"></script>
	<script src="{{ asset('plugins/bower_components/fastclick/lib/fastclick.js') }}"></script>
	<script src="{{ asset('plugins/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
	@yield('javascript')
</body>
</html>