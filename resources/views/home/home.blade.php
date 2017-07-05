@extends('mainframe')

@section('title','Preesco')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ url('css/home.css') }}">
@endsection

@section('dynamicContent')

	@if($numCuestionarios > 0)
		<div id="mv-tiles" style="opacity: 1;">
		@foreach($cuestionarios as $cuestionario)
		    <a class="mv-tile" data-tid="21" href="{{url('aplicaQuiz')."/$cuestionario->idCuestionario"}}" title="{{$cuestionario->nombre}}">
		        <div class="mv-favicon">
		        	<!-- <img src="{{url('imgs/Check_16x16.png')}}" title=""> -->
		        </div>
		        <div class="mv-title" style="direction: ltr;">
		        	
		        </div>
		        <div class="mv-thumb">
		        	<!-- <img title="{{$cuestionario->nombre}}" src="{{url('imgs/Check_128x128.png')}}"> -->
		        	<div>{{$cuestionario->nombre}}</div>
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
