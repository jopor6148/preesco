<?php

namespace Preesco\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class Preguntas extends Controller {

	public function index(Request $request){

		$infoCuest = $this->getCuestionario($request->idCuestionario);
		$resSecciones = DB::select('SELECT * FROM secciones WHERE idCuestionario = '.$request->idCuestionario);
		$preguntas = $this->getPregunta();

		if (count($resSecciones) == 1) {
			//-Se despliega el formulario para registrar las preguntas del cuestionario
			return view('preguntas.agregarPreguntas', ['cuestionario' => $infoCuest,'seccion' => $resSecciones, 'preguntas' => $preguntas]);
		}else if(count($resSecciones) > 1) {
			//-Se muestran las diferentes secciones para definir en cuál se agergarán preguntas.
			return view('secciones.secciones', ['numSecciones' => count($resSecciones), 'secciones' => $resSecciones]);
		}
		
	}

	public function guardarPregunta(Request $request){
		
		//-Se inserta la pregunta al mismo tiempo que se obtiene el ID que se genere
		$idPregunta = DB::table('preguntas')->insertGetId([
			'idSeccion' => $request->idSeccion,
			'tipoPregunta' => $request->tipoPregunta,
			'pregunta' => $request->pregunta
			]);

		//-Se insertan las respuestas de la pregunta
		DB::insert("INSERT INTO resp_opciones (idPregunta, opcion, correcta) VALUES 
			({$idPregunta}, '{$request->correcta}', 1),
			({$idPregunta}, '{$request->opcion2}', 0),
			({$idPregunta}, '{$request->opcion3}', 0),
			({$idPregunta}, '{$request->opcion4}', 0)
			");

		//-Se vuelve a optender la información del cuestionario y la sección
		$infoCuest = $this->getCuestionario($request->idCuestionario);
		$resSecciones = DB::select('SELECT * FROM secciones WHERE idCuestionario = '.$request->idCuestionario);

		//-Se obtienen las preguntas registardas para mostrarlas
		$preguntas = $this->getPregunta();

		return view('preguntas.agregarPreguntas', ['cuestionario' => $infoCuest,'seccion' => $resSecciones, 'preguntas' => $preguntas]);
	}

	//-Retorna los cuestionariso registrados o uno específico si se proporcina el id
	private function getCuestionario($id = null){
		if ($id) {
			return DB::select('SELECT * FROM cuestionarios WHERE idCuestionario = '.$id);
		}else{
			return DB::select('SELECT * FROM cuestionarios');
		}
	}

	//-Retorna las secciones registradas o una específica si se proporcina el id
	private function getSeccion($id = null)
	{
		if ($id) {
			return DB::select('SELECT * FROM secciones WHERE idSeccion = '.$id);
		}else{
			return  DB::select('SELECT * FROM secciones');
		}
	}

	private function getPregunta($id = null)
	{
		if ($id) {
			return DB::select("SELECT * FROM preguntas WHERE idPregunta = ".$id);
		} else {
			return DB::select("SELECT * FROM preguntas");
		}
		
	}
}