<div class="preguntaRelacion">
	<div class="Pregunta">
		<p>{!!$pregunta['pregunta']!!}</p>
		<table style="border: 1px solid #000">
			<tbody>
				@forelse ($pregunta['respuestas']['relA'] as $key => $value)
					<tr>
						<td>{{$value['indice'].'- '.$value['rel']}}</td>
						<td>{{$pregunta['respuestas']['relB'][$key]['indice'].') '.$pregunta['respuestas']['relB'][$key]['rel']}}</td>
					</tr>
				@empty
					<h3>No se cargaron relaciones</h3>
				@endforelse
			</tbody>
		</table>
	</div>
	<div class="respuestas">
		<input type="hidden" name="val-{{$pregunta['idPregunta']}}" value="">
		<p><label for="">La respuesta correcta corresponde al inciso:</label></p>
		<ol style="list-style-type: lower-latin">
			@php
				shuffle($pregunta['opciones']);
			@endphp
			@forelse ($pregunta['opciones'] as $key => $value)
				<li   > <input confirma="{{$value['correcta']== true ? 1:0}}" type="radio" name="opcion-{{$pregunta['idPregunta']}}" value=""> {{$value['opcion']}}</li>
			@empty
				<li><h4>No se cargaron respuestas</h4></li>
			@endforelse
		</ol>
	</div>
</div>
