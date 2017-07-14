<?php

namespace Preesco\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Session;

class Home extends Controller {

	public function index(){


    if(session()->has('idUsuario')){
      $selCuestRestul = DB::select('SELECT idCuestionario, nombre, descripcion FROM cuestionarios WHERE publico = 1');
      if (session('privilegios') != 2 ) {


    		if (count($selCuestRestul) > 0) {
    			return view('home.home', ['numCuestionarios' => count($selCuestRestul),'cuestionarios' => $selCuestRestul]);
    		}else{
    			return view('home.home', ['numCuestionarios' => 0]);
    		}
      }

      return view('home.homeAdmin', ['numCuestionarios' => count($selCuestRestul),'cuestionarios' => $selCuestRestul]);
    }else{
      return redirect('login')->withErrors('No has ingresado tus datos');
    }

	}
}
