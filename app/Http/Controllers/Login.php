<?php

namespace Preesco\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class Login extends Controller{

	public function loginInfo(Request $request){
		$selUserResutl = DB::select("SELECT * FROM usuarios WHERE usuario = '{$request->usuario}' AND contrasena = '{$request->contrasena}' AND estatus = 1");

		//-Se valida si el usuario existe
		if (count($selUserResutl) > 0) {

			$selUserResutl = $selUserResutl[0];

			session([
				'idUsuario' => $selUserResutl->idUsuario,
				'nombre' => $selUserResutl->nombre,
				'apellidos' => $selUserResutl->apellidos,
				'correo' => $selUserResutl->correo,
				'usuario' => $selUserResutl->usuario,
				'privilegios' => $selUserResutl->privilegios,
				]);

			return redirect('home');
		}else{
			return view('login.login',['loginError' => true]);
		}
	}

	private function loginError(){

	}
}
