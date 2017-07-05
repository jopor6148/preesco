<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="maestros, preescolar, educacion basica, estudio, capacitacion, simulador, examen, evaluacion docente" />
	<meta name="keywords" content="desarrollo, docente, docencia, maestros, preescolar, estudio, capacitacion" />
	<meta name="author" content="Ing. Paulino Figueroa - ing.paulino.figueroa@gmail.com" />
	<link rel="shortcut icon" href="" />
	<title>@yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{ url('css/normalize.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/bootstrap/css/bootstrap-theme.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('css/styles.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('css/mainframe.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	@yield('css')
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" charset="utf-8"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script type="text/javascript" src="{{url('js/js.js')}}"></script>
	@yield('script')
</head>
<body>
	<div class="container-fluid header">
		<header>
			<h1>Preesco</h1>
			<nav>
				<ul>
					<li><a href="/inicio/home">Home</a></li>
				</ul>
			</nav>
		</header>
	</div>
	<div class="container">
		@if(session('privilegios') === 2)
			<!-- <a href="homeAdmin">Administrar Cuestionaros</a> -->
		@endif

		@section('dynamicContent')
			<h1>dynamicContent</h1>
		@show
	</div>
</body>
</html>
