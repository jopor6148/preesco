<?php

namespace Preesco\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class Login extends Controller{

	public function loginInfo(Request $request){

    

		$selUserResutl = DB::select("SELECT * FROM usuarios WHERE usuario = '{$request->usuario}' AND contrasena = '{$request->contrasena}'");

		//-Se valida si el usuario existe
		if (count($selUserResutl) > 0) {

			if ($selUserResutl[0]->estatus != 0) {
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
			}

      return redirect('login')->withErrors(['mensaje'=>'El usuario no se encuentra activo']);
		}else{
			return redirect('login')->withErrors(['mensaje'=>'Nombre de usuario o contraseña incorrectos']);
		}
	}

	private function loginError(){

	}

  public function signOut(Request $request)
  {
    session()->flush();

    return redirect('/');
  }

}
