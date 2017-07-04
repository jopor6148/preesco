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
			<input type="text" name="u" placeholder="usuario@dominio.com" required="required" />
			<input type="password" name="p" placeholder="Contraseña" required="required" />
			<button type="submit" class="btn btn-preesco btn-login">Let me in.</button>
		</form>
	</div>
@endsection