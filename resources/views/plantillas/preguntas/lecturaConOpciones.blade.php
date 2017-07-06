
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
