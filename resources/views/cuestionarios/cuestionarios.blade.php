{{-- MUESTRA TODOS LOS CUESTIONARIOS DISPONIBLES --}}

@extends('mainframe')

@section('title','Cuestionarios')

@section('dynamicContent')
	<div class="custionariosContenedor">
	@foreach ($cuestionarios as $cuest)
		<a href="{{action('Cuestionario@show', [$cuest->idCuestionario])}}">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">{{$cuest->nombre}}</h3>
				</div>
			<div class="panel-body">{{$cuest->descripcion}}</div> </div>
		</a>
	@endforeach
	</div>
	<a class="btn btn-default" href="{{action('Cuestionario@create')}}" role="button">Link</a>
@endsection