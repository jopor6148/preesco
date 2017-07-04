@extends('mainframe')

@section('title','Nuevo Cuestionario')

@section('dynamicContent')
	<div class="form">
		<form action="{{action('Cuestionario@store')}}" method="POST">
			{{ csrf_field() }}

			<label>Cuestionario</label>
			<div class="form-group">
				<input type="text" class="form-control" id="cuestNombre" name="cuestNombre" placeholder="Nombre del cuestionario">
				<input type="text" class="form-control" id="formDescription" name="cuestDescripcion" placeholder="Descripción del cuestionario">
			</div>

			<label>Sección</label>
			<div class="form-group">
				<input type="text" class="form-control" id="formDescription" name="seccionNombre" placeholder="Nombre de sección" value="Sección Default">
				<input type="text" class="form-control" id="formDescription" name="seccionDescripcion" placeholder="Descripción de la sección" value="Descripción Default">
				<p>Todo cuestionario cuenta con una sección por default. Si el cuestioanrio solo cuenta con una sola sección, ésta no será mostrada al usuario, en cambio si se cuenta con mas de una sección, éstas sí serán mostradas.</p>
			</div>
			

			 <button type="submit" class="btn btn-default">Crear cuestionario</button>
		</form>
	</div>
@endsection