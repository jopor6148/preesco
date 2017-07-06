
<style media="screen">
  .lectura{
    color: #065ac9;
    cursor: pointer;
  }

  .lectura:hover{
    color: #397fdb;
  }

</style>

<div class="preguntaOpciones">
  <div class="lectura" lectura="{{$pregunta['idLectura']}}">
    Lectura haz click
  </div>
	<div class="Pregunta">
		<p>{!!$pregunta['pregunta']!!}</p>
	</div>
	<div class="respuestas">
		<input type="hidden" name="val-{{$pregunta['idPregunta']}}" value="">
		<p><label for="">La respuesta correcta corresponde al inciso:</label></p>
		<ol style="list-style-type: lower-latin">
			@php
				shuffle($pregunta['respuestas']);
			@endphp
			@forelse ($pregunta['respuestas'] as $key => $value)
				<li   > <input confirma="{{$value['correcta']== 1 ? 1:0}}" type="radio" name="opcion-{{$pregunta['idPregunta']}}" value=""> {{$value['opcion']}}</li>
			@empty
				<li><h4>No se cargaron respuestas</h4></li>
			@endforelse
		</ol>
	</div>
</div>

<div class="modal fade bs-example-modal-lg" id="modalLectura" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" id="contenidoModal">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title" id="myModalLabel">Lectura</h4>
     </div>
     <div class="modal-body" >

     </div>
     <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
     </div>
    </div>
  </div>
</div>
