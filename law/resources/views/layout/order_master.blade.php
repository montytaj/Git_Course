<!DOCTYPE html>
<html dir="rtl">
<head>
	<title>BLC</title>
	 <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/assets/img/tekkeh.ico')}}" />
	<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">

	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/font/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/font/css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/fontawesome.min.css')}}">	
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/font/css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/sweetalert.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/style.css')}}">

</head>
<body>

	@include('layout.header') 

	@yield('content')

	@yield('Payment')

	@include('layout.footer') 

	
	<script src="{{ URL::asset('public/assets/js/jquery-3.5.1.min.js') }}"></script>
	<script src="{{ URL::asset('public/assets/js/main.js') }}"></script>
	<script src="{{ URL::asset('public/assets/js/bootstrap5-1-3.bundle.min.js') }}"></script>
	<script src="{{ URL::asset('public/assets/js/sweetalert.min.js') }}"></script>
</body>
</html>