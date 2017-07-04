<script src="https://code.jquery.com/jquery-3.2.1.min.js" charset="utf-8"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{url('js/aplicaCuestionario.js')}}"></script>

<div class="contenidoCuestionario">
	<div class="titleCuestionario">
		<h4>Aplicaras Cuestionario</h4>
		<h2>{{$cuestionario['nombre']}}</h2>
	</div>
	<div class="contenidoPreguntas">
		@php
			if (count($cuestionario['seccion']) <= 0) {
				echo 'No se han cargado Preguntas';
			} else {
		@endphp

		@foreach ($cuestionario['seccion'] as $key => $value)

			<div class="secciones">
				<div class="divTitleSeccion">
					<h3>
						{{$value['seccion']}}
					</h3>
				</div>
				<div class="divPreguntas">
					<ol>
						@forelse ($value['pregunta'] as $kp => $vp)
							@if ($vp["tipoPregunta"] =="opciones" )
								<li>@include('plantillas.preguntas.opcion',['pregunta'=>$vp])</li>
							@endif
							@if ($vp["tipoPregunta"] =="relacion")
								<li>@include('plantillas.preguntas.relacion',['pregunta'=>$vp])</li>
							@endif
							@if ($vp["tipoPregunta"] =="verdaderoFalso")
								<li>@include('plantillas.preguntas.verdaderoFalso',['pregunta'=>$vp])</li>
							@endif
						@empty
							<p>Sin preguntas cargadas</p>
						@endforelse
					</ol>
				</div>
			</div>

		@endforeach


		@php


			}

		@endphp
	</div>
	<div class="">
		<button type="button" name="button" class="botonEnviar"> Enviar </button>
		<button type="button" name="button" class="volver"> Volver a contestar </button>
	</div>
</div>


<!-- Large modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Large modal</button> --}}

<div class="modal fade" tabindex="-1" id="modalRespuestas" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Resultados</h4>
      </div>
      <div class="modal-body">
				<ul>
					<li id="correctas">Correctas: </li>
					<li id="nocorrectas">Incorrectas: </li>
					<li id="nocontesta">Sin contestar:  </li>
				</ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary volver">Volver a contestar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
