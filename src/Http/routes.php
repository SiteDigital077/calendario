<?php




Route::group(['middleware' => ['auths','administrador']], function (){

 Route::get('gestion/calendario', 'DigitalsiteSaaS\Calendario\Http\CalendarioController@index');
 Route::get('gestion/majo', 'DigitalsiteSaaS\Calendario\Http\CalendarioController@majo');
 Route::post('gestion/calendario/crear', 'DigitalsiteSaaS\Calendario\Http\CalendarioController@create');
 Route::post('gestion/calendario/crear-tipo', 'DigitalsiteSaaS\Calendario\Http\CalendarioController@createtipo');
 Route::get('gestion/calendario/editar-tipo/{id}', 'DigitalsiteSaaS\Calendario\Http\CalendarioController@editipo');
 Route::post('gestion/calendario/updatetipo/{id}', 'DigitalsiteSaaS\Calendario\Http\CalendarioController@updatetipo');
 Route::get('gestion/tipos/calendario', 'DigitalsiteSaaS\Calendario\Http\CalendarioController@tipos');
 Route::get('gestion/calendario/editar/{id}', 'DigitalsiteSaaS\Calendario\Http\CalendarioController@edit');
 Route::get('gestion/calendario/editar-evento/{id}', 'DigitalsiteSaaS\Calendario\Http\CalendarioController@editar');
 Route::post('gestion/calendario/actualizar/{id}', 'DigitalsiteSaaS\Calendario\Http\CalendarioController@update');
 Route::get('gestion/calendario/eliminar/{id}', 'DigitalsiteSaaS\Calendario\Http\CalendarioController@delete');
 Route::get('gestion/calendario/eliminar-tipo/{id}', 'DigitalsiteSaaS\Calendario\Http\CalendarioController@deletetipo');
 Route::get('gestion/registro/eventos', 'DigitalsiteSaaS\Calendario\Http\CalendarioController@registros');

Route::get('gestion/crear-evento', 'DigitalsiteSaaS\Calendario\Http\CalendarioController@creareventoweb');

 Route::get('/gestion/crear-tipo', function(){
  return View::make('calendario::crear-tipo');
 });

});

Route::group(['middleware' => ['web']], function (){

 Route::resource('gestion/calendario/registroa', 'DigitalsiteSaaS\Pagina\Http\WebController@registrara');

 
});
