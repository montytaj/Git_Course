<!DOCTYPE html>
<html dir="rtl">
<head>
	<title>BLC</title>

	<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">

	<link rel="stylesheet" type="text/css" href="{{asset('assets/font/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/font/css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/fontawesome.min.css')}}">	
	<link rel="stylesheet" type="text/css" href="{{asset('assets/font/css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/sweetalert.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">

</head>
<body>

  <div class="gradient-bg"></div> 

	@include('layout.admin.header') 

	@yield('content')

	{{--@include('footer')--}} 


	<script src="{{ URL::asset('public/assets/js/sweetalert.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/jquery-3.5.1.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/main.js') }}"></script>
	<script src="{{ URL::asset('assets/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/bootstrap5-1-3.bundle.min.js') }}"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables/datatable.css')}}">	
	<script src="{{ URL::asset('assets/js/datatables/datatable.js') }}"></script>
	<script src="{{ URL::asset('assets/js/datatables/datatable2.js') }}"></script>
</body>
</html>