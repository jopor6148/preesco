<?php

namespace Preesco\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class Cuestionario extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //-Comentado puesto que los cuestionarios se muestran en el home o homeAdmin
        // $cuestionarios = DB::select("SELECT * FROM cuestionarios");
        // return view('cuestionarios.cuestionarios',['cuestionarios' => $cuestionarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cuestionarios.nuevoCuestionario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //-Se inserta el nuevo cuestionario y su sección por default.
        $id = DB::table('cuestionarios')->insertGetId(['nombre' => $request->cuestNombre, 'descripcion' => $request->cuestDescripcion]);
        DB::insert("INSERT INTO secciones SET idCuestionario = {$id}, nombre = '{$request->seccionNombre}', descripcion = '{$request->seccionDescripcion}'");

        //-Se redirecciona al controller 'Preguntas'
        return redirect()->action('Preguntas@index', ['idCuestionario' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cuestionario = DB::select('SELECT * FROM cuestionarios WHERE idCuestionario = '.$id);
        return view('cuestionarios.detallesCuestionario', ['cuestionario' => $cuestionario]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


		public function showUser($id)
    {
        $res = DB::select("SELECT c.idCuestionario,c.descripcion descCuest, c.nombre nombreCuest, s.idSeccion, s.nombre seccion,
				p.idPregunta, p.pregunta, p.tipoPregunta, if(ISNULL(p.idLectura),'none',p.idLectura) idLectura , resp.*
														FROM cuestionarios c
														INNER JOIN secciones s USING (idCuestionario)
														INNER JOIN preguntas p USING (idSeccion)
														INNER JOIN ( SELECT
															idRespOpciones idRes,
															idPregunta,
															opcion,
															correcta,
															'' relA,
															'' relB,
															'opcion' tipo
														FROM
															resp_opciones
														UNION
															SELECT
																idRespRelacion idRes,
																idPregunta,
																'',
																'',
																relA,
																relB,
																'relacion' tipo
															FROM
																resp_relacion ) resp USING (idPregunta)
														WHERE idCuestionario = ".$id);

				$custionario = [];
				foreach ($res as $key => $value) {
					$cuestionario['idCuestionario']=$value->idCuestionario;
					$cuestionario['nombre']=$value->nombreCuest;
					$cuestionario['seccion'][$value->idSeccion]['idSeccion']=$value->idSeccion;
					$cuestionario['seccion'][$value->idSeccion]['seccion']=$value->seccion;
					$cuestionario['seccion'][$value->idSeccion]['pregunta'][$value->idPregunta]['idPregunta']=$value->idPregunta;
					$cuestionario['seccion'][$value->idSeccion]['pregunta'][$value->idPregunta]['pregunta']=$value->pregunta;
					$cuestionario['seccion'][$value->idSeccion]['pregunta'][$value->idPregunta]['tipoPregunta']=$value->tipoPregunta;
					$cuestionario['seccion'][$value->idSeccion]['pregunta'][$value->idPregunta]['idLectura']=$value->idLectura;

					switch ($value->tipoPregunta) {
						case 'opciones':
							$cuestionario['seccion'][$value->idSeccion]['pregunta'][$value->idPregunta]['respuestas'][$value->idRes]['idRespuesta']=$value->idRes;
							$cuestionario['seccion'][$value->idSeccion]['pregunta'][$value->idPregunta]['respuestas'][$value->idRes]['opcion']=$value->opcion;
							$cuestionario['seccion'][$value->idSeccion]['pregunta'][$value->idPregunta]['respuestas'][$value->idRes]['correcta']=$value->correcta;
							break;
						case 'relacion':
							$cuestionario['seccion'][$value->idSeccion]['pregunta'][$value->idPregunta]['respuestas']['relA'][$value->idRes]['idRespuesta']=$value->idRes;
							$cuestionario['seccion'][$value->idSeccion]['pregunta'][$value->idPregunta]['respuestas']['relA'][$value->idRes]['rel']=$value->relA;
							$cuestionario['seccion'][$value->idSeccion]['pregunta'][$value->idPregunta]['respuestas']['relB'][$value->idRes]['idRespuesta']=$value->idRes;
							$cuestionario['seccion'][$value->idSeccion]['pregunta'][$value->idPregunta]['respuestas']['relB'][$value->idRes]['rel']=$value->relB;
							break;
            case 'lecturaConOpciones':
							$cuestionario['seccion'][$value->idSeccion]['pregunta'][$value->idPregunta]['respuestas'][$value->idRes]['idRespuesta']=$value->idRes;
							$cuestionario['seccion'][$value->idSeccion]['pregunta'][$value->idPregunta]['respuestas'][$value->idRes]['opcion']=$value->opcion;
							$cuestionario['seccion'][$value->idSeccion]['pregunta'][$value->idPregunta]['respuestas'][$value->idRes]['correcta']=$value->correcta;
							break;
            case 'verdaderoFalso':
							$cuestionario['seccion'][$value->idSeccion]['pregunta'][$value->idPregunta]['respuestas'][$value->idRes]['idRespuesta']=$value->idRes;
							$cuestionario['seccion'][$value->idSeccion]['pregunta'][$value->idPregunta]['respuestas'][$value->idRes]['opcion']=$value->opcion;
							$cuestionario['seccion'][$value->idSeccion]['pregunta'][$value->idPregunta]['respuestas'][$value->idRes]['correcta']=$value->correcta;
							break;
					}


				}

				$cuestionario = $this->creaEstructuraCuestionario($cuestionario);

        return view('cuestionarios.aplicaCuestionario', ['cuestionario' => $cuestionario]);
    }


		public function creaEstructuraCuestionario($qz)
		{

			foreach ($qz['seccion'] as $key => $value) {
				$preguntas = [];
				$preguntasLectura = [];
				shuffle($value['pregunta']);
				$cuentaPregunta= 0;
				foreach ($value['pregunta'] as $kp => $vp) {

					if($vp['tipoPregunta'] == 'relacion'){
						$vp = $this->estucturaPreguntaRelacion ($vp);
					}

					if($vp['tipoPregunta']== 'lecturaConOpciones'){
						$preguntasLectura[$vp['idLectura']][]=$vp;
					}else{
						$preguntas[$cuentaPregunta]=$vp;
						$cuentaPregunta++;
					}
				}
				foreach ($preguntasLectura as $kpl => $vpl) {
					foreach ($vpl as $k => $v) {
						array_push($preguntas, $v);
					}
				}
				 $qz['seccion'][$key]['pregunta']=$preguntas;
			}
			return $qz;
		}



		public function estucturaPreguntaRelacion($pregunta)
		{

			$abc = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
			$count= 0;
			$opciones = [];

			shuffle($pregunta['respuestas']['relA']);
			shuffle($pregunta['respuestas']['relB']);

			foreach ($pregunta['respuestas']['relA'] as $kA => $vA) {
				$count++;
				$pregunta['respuestas']['relA'][$kA]['indice']=$count;
			}



			$count=0;
			foreach ($pregunta['respuestas']['relB'] as $kB => $vB) {
					$pregunta['respuestas']['relB'][$kB]['indice']=$abc[$count];
					$count++;
			}

			$correcta = '';
			foreach ($pregunta['respuestas']['relA'] as $kA => $vA) {

				foreach ($pregunta['respuestas']['relB'] as $kB => $vB) {
					if($vA['idRespuesta'] == $vB['idRespuesta']){
						$correcta .= " {$vA['indice']}{$vB['indice']}".((count($pregunta['respuestas']['relA']) - 1 ) == $kA ? '': ', ');
					}
				}

			}

			$opciones[]=['opcion'=>$correcta,'correcta'=>true];



			$abcusado = array_slice($abc, 0,count($pregunta['respuestas']['relA']));

			// if (count($pregunta['respuestas']['relA']) >= 4) {
			// 	$tope =4;
			// }else{}
			for ($i = 0; $i < 3 ; $i++) {
				shuffle($abcusado);
				$aux='';
				foreach ($abcusado as $key => $value) {
					$indice = $key+1;
					$aux .= " {$indice}{$value}".((count($abcusado) - 1 ) == $key ? '': ', ');
				}

				if ($correcta != $aux) {
					$opciones[]=['opcion'=>$aux,'correcta'=>false];
				}else{
					$i--;
				}

			}

			$pregunta['opciones']=$opciones;
			// dump($opciones);
			return $pregunta;

		}


    public function dameLectura (Request $request)
    {

      $respuesta = DB::connection('preesco')->table('lecturas')->where('idLectura', $request->lectura)->get();
      if(count($respuesta) > 0){
        return ['error'=>false,'respuesta'=>html_entity_decode($respuesta[0]->lectura)];
      }

      return ['error'=>true];

    }


}
