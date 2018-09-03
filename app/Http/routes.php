<?php

Route::any('/', 'PagesController@index');

// Authentication routes...
Route::get('auth/login', ['as' =>'auth/login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as' =>'auth/login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth/logout', 'uses' => 'Auth\AuthController@logout']);

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', ['as' => 'auth/register', 'uses' => 'Auth\AuthController@postRegister']);

//Ruta al search de Usuarios
Route::post('usuarios/search', ['as' => 'usuarios/search', 'uses' => 'UserController@search']);
Route::get('usuarios/{id}/delete', ['as' => 'deleteusuarios', 'uses' => 'UserController@delete']);
//Rutas al cambio de password para administradores
Route::get('usuarios/{id}/password', ['as' => 'cambiarpass', 'uses' => 'UserController@cambiarPass']);
Route::post('usuarios/cambiar', ['as' => 'usuarios/cambiar', 'uses' => 'UserController@cambio']);
//Rutas al cambio de password de un usuario
Route::get('usuarios/cambioclave', ['as' => 'cambioDePass', 'uses' => 'PassController@cambioDePass']);
Route::post('usuarios/cambioclave', ['as' => 'usuarios/cambioclave', 'uses' => 'PassController@cambioUser']);
//Ruta al cambio de avatar de un usuario
Route::post('usuarios/cambioavatar', ['as' => 'cambioavatar', 'uses' => 'PassController@cambioavatar']);
//Ruta al resource de Usuarios
Route::resource('usuarios', 'UserController');

//Rutas de pais
Route::post('paises/buscar', ['as' => 'paises.buscar', 'uses' => 'PaisController@buscar']);
Route::get('paises/{id}/borrar', ['as' => 'paises.borrar', 'uses' => 'PaisController@delete']);
//Ruta al resource de paises
Route::resource('paises', 'PaisController');

//Rutas de servicios
Route::get('servicios/{id}/borrar', ['as' => 'servicios.borrar', 'uses' => 'ServiciosController@delete']);
Route::post('servicios/buscar', ['as' => 'servicios/buscar', 'uses' => 'ServiciosController@buscar']);
//Ruta al resource de servicios
Route::resource('servicios', 'ServiciosController');

//Rutas de bandas
Route::get('bandas/{id}/borrar', ['as' => 'bandas.borrar', 'uses' => 'BandasController@delete']);
Route::get('bandas/{id}/integrantes', ['as' => 'bandas.integrantes', 'uses' => 'BandasController@integrantes']);
Route::post('bandas/buscar', ['as' => 'bandas.buscar', 'uses' => 'BandasController@buscar']);
//Ruta al resource de bandas
Route::resource('bandas', 'BandasController');

//Rutas de discos
Route::get('discos/{id}/borrar', ['as' => 'discos.borrar', 'uses' => 'DiscosController@delete']);
Route::post('discos/buscar', ['as' => 'discos.buscar', 'uses' => 'DiscosController@buscar']);
//Ruta al resource de discos
Route::resource('discos', 'DiscosController');

//Rutas de periodos
Route::get('periodos/{id}/borrar', ['as' => 'periodos.borrar', 'uses' => 'PeriodosController@delete']);
Route::post('periodos/buscar', ['as' => 'periodos.buscar', 'uses' => 'PeriodosController@buscar']);
Route::post('periodos/cargardiscos', ['as' => 'cargardiscos', 'uses' => 'PeriodosController@cargardiscos']);
Route::post('periodos/{id}/cargardiscos2', ['as' => 'cargardiscos2', 'uses' => 'PeriodosController@cargardiscos']);
//Ruta al resource de periodos
Route::resource('periodos', 'PeriodosController');

//Ruta al search de miembros
Route::post('miembros/buscar', ['as' => 'miembros.buscar', 'uses' => 'MiembrosController@buscar']);
//Ruta al resource de miembros
Route::resource('miembros', 'MiembrosController');