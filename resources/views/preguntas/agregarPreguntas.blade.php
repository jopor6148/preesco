@extends('mainframe')

@section('title','Preguntas')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{url('css/preguntas.css')}}">
@endsection

@section('script')
	<script src="src/tinymce/tinymce.min.js"></script>
	<script>
		tinymce.init({
			selector: '#textareaPregunta'
		});
	</script>
@endsection

@section('dynamicContent')
	@php
		$cuestionario = $cuestionario[0];
		$seccion = $seccion[0];
	@endphp
	<div>
		<h1>{{$cuestionario->nombre}}</h1>
	</div>
	<div>
		<h2>{{$seccion->nombre}}</h2>
	</div>
	<div>
		<form action="{{action('Preguntas@guardarPregunta')}}" method="POST">
			{{ csrf_field() }}
			<input type="hidden" name="idSeccion" value="{{$seccion->idSeccion}}">
			<select name="tipoPregunta" class="form-control" onchange="showElement('tipoPregunta_'+this.value)">
				<option value="" disabled selected>Tipo de pregunta</option>
				<option value="1">Opciones</option>
				<option value="2">Relación</option>
				<option value="3">Lectura con opciones</option>
				<option value="4">Verdadero Falso</option>
			</select>
			<div id="tipoPregunta_1" style="display: none;">
				<div>
					<textarea name="pregunta" id="textareaPregunta">Hello, World!</textarea>
				</div>
				<div>
					<input class="form-control" type="´text" name="correcta" placeholder="opcion correcta" required>
					<input class="form-control" type="´text" name="opcion2" placeholder="opcion2" required>
					<input class="form-control" type="´text" name="opcion3" placeholder="opcion3" required>
					<input class="form-control" type="´text" name="opcion4" placeholder="opcion4" required>
				</div>
			</div>
			<input type="submit" class="btn btn-preesco" name="guardarPregunta" value="Guardar">
		</form>
	</div>
	<hr>
	
	@if(isset($preguntas) and count($preguntas) > 0)
		<div>
			<h1>Preguntas agregadas</h1>
		</div>
		@foreach ($preguntas as $key)
			<div class="blockShadow">
			 	{!!$key->pregunta!!}
			</div>
		@endforeach
	@endif
@endsection