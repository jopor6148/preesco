<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 *
 */
//-
Route::get('login', function () {
    if(session()->has('idUsuario')){
      return redirect('home');
    }
    return view('login.login');
});

Route::post('login', 'Login@loginInfo');



Route::group(['middleware' => 'AuthenticateUser'], function(){
// 	Route::get('home','Home@index');


// 	/**
// 				rutas pára examenes
// 	**/
// 	Route::group(['prefix'=>'aplicaQuiz'], function()
// 	{
// 	 Route::get('/{idExamen}',function($id){
// 		return (new Preesco\Http\Controllers\Cuestionario())->showUser($id);
// 	 });
// 	});

Route::get('signOut', 'Login@signOut');

Route::get('home','Home@index');


/**
      rutas pára examenes
**/


	Route::group(['middleware' => 'ValidateAdmin'], function(){

    Route::group(['prefix'=>'aplicaQuiz'], function()
    {

     Route::post('/damelectura',['as'=>'damelectura','uses'=>'Cuestionario@dameLectura']);

     Route::get('/{idExamen}',function($id){
      return (new Preesco\Http\Controllers\Cuestionario())->showUser($id);
    })->where('id','[0-9]+');


    });

		Route::get('homeAdmin','HomeAdmin@index');
		Route::resource('cuestionarios','Cuestionario');
		Route::get('preguntas','Preguntas@index');
		Route::post('preguntas','Preguntas@guardarPregunta');
	});


});

/**
 *
 */
