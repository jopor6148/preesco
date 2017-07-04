<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Sitio de desarrollo de habilidades para la práctica docente" />
	<meta name="keywords" content="desarrollo, docente, docencia, maestros, preescolar, estudio, capacitacion" />
	<meta name="author" content="Ing. Paulino Figueroa - ing.paulino.figueroa@gmail.com" />
	<link rel="shortcut icon" href="" />
	<title>@yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{ url('css/normalize.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/bootstrap/css/bootstrap-theme.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('css/styles.css') }}">
	@yield('css')
	<script type="text/javascript" src="{{url('js/js.js')}}"></script>
	@yield('script')
</head>
<body>
	@if(session('privilegios') === 2)
		<a href="homeAdmin">Administrar Cuestionaros</a>
	@endif

	@section('dynamicContent')
		<h1>dynamicContent</h1>
	@show
</body>
</html>
