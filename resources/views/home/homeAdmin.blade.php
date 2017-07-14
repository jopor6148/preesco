@extends('mainframe')

@section('title','Preesco Admin')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ url('css/styles.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('css/home.css') }}">
@endsection

@section('dynamicContent')
		<div>
	        <a class="btn btn-preesco" href="cuestionarios/create" role="button">Agregar cuestionario</a>
		</div>

	    <hr>

	    @if($numCuestionarios > 0)
		    <div id="mv-tiles" style="opacity: 1;">
				@foreach($cuestionarios as $cuestionario)
				    <a class="mv-tile" href="{{action('Preguntas@index', ['idCuestionario' => $cuestionario->idCuestionario])}}" title="{{$cuestionario->nombre}}">
				        <div class="mv-favicon">
				        	<img src="{{url('imgs/Check_16x16.png')}}" title="">
				        </div>
				        <div class="mv-title" style="direction: ltr;">
				        	{{$cuestionario->nombre}}
				        </div>
				        <div class="mv-thumb">
				        	<!-- <img title="{{$cuestionario->nombre}}" src="{{url('imgs/Check_128x128.png')}}"> -->
				        	<div>
				        		{{$cuestionario->descripcion}}
				        	</div>
				        </div>
				    </a>
				@endforeach
			</div>
		@else
			<div>
				No hay cuestionarios disponibles
			</div>
		@endif
@endsection
