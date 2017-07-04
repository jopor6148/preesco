<?php

namespace Preesco\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class HomeAdmin extends Controller {

	public function index(){

		$selCuestRestul = DB::select('SELECT * FROM cuestionarios');

		if (count($selCuestRestul) > 0) {
			return view('home.homeAdmin', ['numCuestionarios' => count($selCuestRestul),'cuestionarios' => $selCuestRestul]);
		}else{
			return view('home.homeAdmin', ['numCuestionarios' => 0]);
		}
	}
}