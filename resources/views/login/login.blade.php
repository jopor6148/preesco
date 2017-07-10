@extends('mainframe')

@section('title','Login')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ url('css/login.css') }}">
@endsection

@section('dynamicContent')
	<div class="login">
		<h1>Login</h1>
		<form action="login" method="POST" id="loginForm">
			{{ csrf_field() }}
			<input type="text" name="usuario" placeholder="Nombre de usuario" required="required" value="testU" />
			<input type="password" name="contrasena" placeholder="Contraseña" required="required" value="123" />
			<button type="submit" class="btn btn-preesco btn-login">Enviar</button>
			@if($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div>
			@endif
		</form>
	</div>
@endsection
