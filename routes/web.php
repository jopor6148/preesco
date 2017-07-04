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
    return view('login.login');
});

Route::post('login', 'Login@loginInfo');

Route::group(['middleware' => 'AuthenticateUser'], function(){
	Route::get('home','Home@index');


	/**
				rutas pára examenes
	**/
	Route::group(['prefix'=>'aplicaQuiz'], function()
	{
	 Route::get('/{idExamen}',function($id){
		return (new Preesco\Http\Controllers\Cuestionario())->showUser($id);
	 });
	});



	Route::group(['middleware' => 'ValidateAdmin'], function(){
		Route::get('homeAdmin','HomeAdmin@index');
		Route::resource('cuestionarios','Cuestionario');
		Route::get('preguntas','Preguntas@index');
		Route::post('preguntas','Preguntas@guardarPregunta');
	});
});


/**
 *
 */
