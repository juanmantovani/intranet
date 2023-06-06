<?php

Auth::routes();

   //****************MENU INICIAL**********************
Route::get('/home', 'HomeController@index');

Route::get('/', 'HomeController@index');

Route::get('/internos','HomeController@internos');

Route::get('/sistemas','HomeController@sistemas')->middleware('auth');

Route::resource('permisos','PermisosController')->middleware('auth');

Route::resource('persona', 'PersonaController')->middleware('auth');

Route::resource('empleado', 'EmpleadoController')->middleware('auth');

Route::resource('medico','MedicoController')->middleware('auth');

Route::resource('visitas', 'VisitaController')->middleware('auth');


   //****************EMPLEADOS**********************
Route::get('/novedades','HomeController@novedades')->middleware('auth');

Route::post('/store_novedades','HomeController@store_novedades')->middleware('auth');

Route::get('destroy_empleado/{id}', ['uses' => 'EmpleadoController@destroy']);

Route::get('destroy_persona/{id}', ['uses' => 'PersonaController@destroy']);

Route::get('destroy_permiso/{id}', ['uses' => 'PermisosController@destroy']);


   //****************PUESTOS**********************
Route::get('create_puesto', 'EquipamientoController@create_puesto')->middleware('auth');

Route::get('/puestos', 'EquipamientoController@puestos')->middleware('auth');

Route::post('/store_puesto','EquipamientoController@store_puesto')->middleware('auth');

Route::get('edit_puesto/{id_puesto}', 'EquipamientoController@edit_puesto')->middleware('auth');

Route::post('/update_puesto','EquipamientoController@update_puesto')->middleware('auth');


   //****************EQUIPAMIENTO**********************
Route::resource('equipamiento', 'EquipamientoController')->middleware('auth');

Route::get('listado_ip', 'EquipamientoController@listado_ip')->middleware('auth');

Route::get('relacion/{id_equipamiento}', 'EquipamientoController@relacion')->middleware('auth');

Route::post('/store_relacion','EquipamientoController@store_relacion')->middleware('auth');

Route::get('destroy_relacion/{relacion}', ['uses' => 'EquipamientoController@destroy_relacion']);


   //****************INCIDENTES**********************
Route::get('create_incidente/{id_equipamiento}', 'EquipamientoController@create_incidente')->middleware('auth');

Route::post('/store_incidente','EquipamientoController@store_incidente')->middleware('auth');

Route::get('/incidentes', 'EquipamientoController@incidentes')->middleware('auth');

Route::post('/update_incidente','EquipamientoController@update_incidente')->middleware('auth');


   //****************VISITAS**********************
Route::get('/asignar','VisitaController@asignar')->middleware('auth');

Route::post('/baja','VisitaController@baja')->middleware('auth');

Route::get('/consulta','VisitaController@consulta')->middleware('auth');

Route::post('/añadir_empresa','VisitaController@añadir_empresa')->middleware('auth');

Route::post('/añadir_externo','VisitaController@añadir_externo')->middleware('auth');

Route::Get('ExternoByEmpresa/{id}', 'VisitaController@getExterno')->middleware('auth');


   //****************USUARIOS**********************
Route::get('/usuarios', 'EquipamientoController@usuarios')->middleware('auth');

Route::get('create_usuario', 'EquipamientoController@create_usuario')->middleware('auth');

Route::post('/acceso','EquipamientoController@accesos')->middleware('auth');

Route::get('destroy_usuario/{id}', ['uses' => 'EquipamientoController@destroy_usuario']);


   //****************MEDICO**********************
Route::post('/añadir_sintoma','MedicoController@añadir_sintoma')->middleware('auth');

Route::get('/historia_clinica','MedicoController@historia_clinica')->middleware('auth');


Route::get('error', function(){ 
    abort(500);
});