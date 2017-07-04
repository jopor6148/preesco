@extends('mainframe')

@section('title','Login')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ url('css/login.css') }}">
@endsection
@section('dynamicContent')
	<div class="login">
		<h1>Login</h1>
		<form action="login" method="POST">
			{{ csrf_field() }}
			<input type="text" name="usuario" placeholder="Nombre de usuario" required="required" value="pafivi" />
			<input type="password" name="contrasena" placeholder="Contraseña" required="required" value="pau" />
			<button type="submit" class="btn btn-preesco btn-login">Enviar</button>
			@if(isset($loginError) && $loginError == true)
				<p class="errorMsj">Nombre de usuario o contraseña incorrectos</p>
			@endif
		</form>
	</div>
@endsection