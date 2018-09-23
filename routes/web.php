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

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');
Route::get('/home', function () {
	return redirect('/');
});

Auth::routes();


Route::group(['middleware' => ['auth']], function () {
	Route::get('/', 'HomeController@index');

	//Usuarios
	Route::group(['prefix'=>'usuarios'], function(){

	      Route::get('/','UsuariosController@index');
	      Route::get('datatables','UsuariosController@datatables');
	      Route::get('editar/{id}','UsuariosController@editar');
	      Route::get('eliminar/{id}','UsuariosController@eliminar');

	      Route::post('guardar','UsuariosController@guardar');
	      Route::post('actualizar','UsuariosController@actualizar');
	      Route::post('update_permisos','UsuariosController@update_permisos');      
	     
	});

	//Productos
	Route::group(['prefix'=>'productos'], function(){

	      Route::get('/','ProductosController@index');
	      Route::get('datatables','ProductosController@datatables');
	      Route::get('editar/{id}','ProductosController@editar');
	      Route::get('eliminar/{id}','ProductosController@eliminar');

	      Route::post('guardar','ProductosController@guardar');
	      Route::post('actualizar','ProductosController@actualizar');
	      Route::post('update_permisos','ProductosController@update_permisos');      
	     
	});

	//Configuracion/Parametros
	Route::group(['prefix'=>'parametros'], function(){

		Route::get('/', 'ParametrosController@index');
		Route::get('datatables', 'ParametrosController@datatables');
		Route::get('crear', 'ParametrosController@crear');
		Route::get('ver/{id}', 'ParametrosController@ver');
		Route::get('editar/{id}', 'ParametrosController@editar');
		Route::get('eliminar/{id}', 'ParametrosController@eliminar');

		Route::get('obtener/{id}', 'ParametrosController@obtener');

		Route::post('guardar','ParametrosController@guardar');
		Route::post('actualizar','ParametrosController@actualizar');

	});

	//Clientes
	/*Route::group(['prefix'=>'clientes'], function(){

		Route::get('/', 'ClientesController@index');
		Route::get('datatables', 'ClientesController@datatables');
		Route::get('crear', 'ClientesController@crear');
		Route::get('ver/{hash_id}', 'ClientesController@ver');
		Route::get('editar/{hash_id}', 'ClientesController@editar');
		Route::get('eliminar/{hash_id}', 'ClientesController@eliminar');
		Route::get('abrir/{id}','ClientesController@abrir');
		Route::get('contactos/{id}','ClientesController@contactos');
		Route::get('oportunidades/{id}','ClientesController@oportunidades');
		
		Route::post('guardar', 'ClientesController@guardar');
		Route::post('actualizar', 'ClientesController@actualizar');
		Route::post('cerrar','ClientesController@cerrar');

	});*/

	//Correos
	/*Route::group(['prefix'=>'correos'], function(){

		Route::get('/', 'CorreosController@index');
		Route::get('datatable', 'CorreosController@datatable');
		Route::get('crear', 'CorreosController@crear');			
		Route::get('ver/{id}', 'CorreosController@ver');
		Route::get('finalizar/{id}', 'CorreosController@finalizar');

		Route::post('guardar', 'CorreosController@guardar');

	});*/

    //Eventos
	/*Route::group(['prefix' => 'eventos'],function(){

        Route::get('/','EventosController@index');
        Route::get('supervisar','EventosController@supervisar');
        Route::get('datatables','EventosController@datatables');
        Route::get('crear','EventosController@crear');
        Route::get('editar/{id}','EventosController@editar');
        Route::get('eliminar/{id}','EventosController@eliminar');
        Route::get('calendario','EventosController@calendario');
        Route::get('ver/{id}','EventosController@ver');

        Route::post('imprimir','EventosController@imprimir');   

        Route::post('guardar','EventosController@guardar');
        Route::post('actualizar','EventosController@actualizar');
        Route::post('concluir','EventosController@concluir');

    	Route::group(['prefix' => 'notas'],function(){

            Route::get('obtener_notas/{id}','EventosNotasController@obtener_notas');
            //Route::get('eliminar/{id}','EventosNotasController@eliminar');

            Route::post('guardar','EventosNotasController@guardar');
            //Route::post('actualizar','EventosNotasController@actualizar');

        });

    });*/

});