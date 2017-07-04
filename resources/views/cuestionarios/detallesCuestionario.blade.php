
@extends('mainframe')

@section('title','Detalles')

@section('dynamicContent')
	<h4>estoy en detalles de cuestinario</h4>
	@foreach ($cuestionario as $value)
		{{$value->nombre}}
	@endforeach
	<select class="form-control">
			<option value="" disabled selected>Tipo de pregunta</option>
			<option>Opciones</option>
			<option>Relación</option>
			<option>Lectura con opciones</option>
			<option>Verdadero Falso</option>
		</select>
@endsection
