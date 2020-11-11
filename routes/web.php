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
	 //echo Hash::make('secret'); 
	return view('welcome');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);

// ------------ modify ---------------------------	
	Route::get('user/modify', function() {
		return view('admin.modify');
	})->name('modify');
	Route::get('Admin/user/modify', function() {
		return view('admin.modify');
	});

	Route::get('user/admin', ['as' => 'user.indUsuarioOrdenDetalle', 'uses' => 'UserController@indiceUsuarioTablaOrdenDetalle']);
	Route::get('user/admin2', ['as' => 'user.indiceSedeTablaUsuarios', 'uses' => 'UserController@indiceSedeTablaUsuarios']);
	Route::get('user/admin3', ['as' => 'user.indiceSedeTablaClientes', 'uses' => 'UserController@indiceSedeTablaClientes']);
	Route::get('user/admin4', ['as' => 'user.indiceUsuarioTablaCotizacionDetalles', 'uses' => 'UserController@indiceUsuarioTablaCotizacionDetalles']);
	Route::get('user/admin5', ['as' => 'user.randomsedeclientes', 'uses' => 'UserController@randomsedeclientes']);
//------------------------------------end----------------------


	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	//Rutas de Clientes.
	Route::resource('clientes', 'CClientes', ['except' => ['show']]);

	//Rutas Cotizaciones
	Route::get('cotizaciones/{cliente}/create', ['as' => 'cotizaciones.create', 'uses' => 'CotizacionController@create']);
	Route::put('cotizaciones', ['as' => 'cotizaciones.store', 'uses' => 'CotizacionController@store']);
	Route::get('cotizaciones/{cliente}', ['as' => 'cotizaciones.index', 'uses' => 'CotizacionController@index']);
	Route::get('cotizaciones/cotizacion/{cotizacion}', ['as' => 'cotizaciones.edit', 'uses' => 'CotizacionController@edit']);
	Route::get('cotizaciones/convertir/{cotizacion}', ['as' => 'cotizaciones.orden', 'uses' => 'CotizacionController@orden']);
	Route::put('cotizaciones/{cotizacion}', ['as' => 'cotizaciones.update', 'uses' => 'CotizacionController@update']);
	Route::put('cotizaciones/orden/{cotizacion}', ['as' => 'cotizaciones.convertir', 'uses' => 'CotizacionController@convertir']);
	Route::delete('cotizaciones/destroy/{cotizacion}', ['as' => 'cotizaciones.destroy', 'uses' => 'CotizacionController@destroy']);

	//Rutas Garantias
	Route::get('garantias/orden/{orden}', ['as' => 'garantias.create', 'uses' => 'GarantiaController@create']);
	Route::put('garantias', ['as' => 'garantias.store', 'uses' => 'GarantiaController@store']);
	Route::get('garantias/{cliente}', ['as' => 'garantias.index', 'uses' => 'GarantiaController@index']);
	Route::get('garantias/garantia/{garantia}', ['as' => 'garantias.edit', 'uses' => 'GarantiaController@edit']);
	Route::put('garantias/{garantia}', ['as' => 'garantias.update', 'uses' => 'GarantiaController@update']);
	Route::get('garantias/convertir/{garantia}', ['as' => 'garantias.convertirOrden', 'uses' => 'GarantiaController@convertirOrden']);
	Route::delete('garantias/destroy/{garantia}', ['as' => 'garantias.destroy', 'uses' => 'GarantiaController@destroy']);

	//Rutas Ordenes
	Route::get('ordenes/{cliente}/create', ['as' => 'ordenes.create', 'uses' => 'COrdenDetalles@create']);
	Route::post('ordenes', ['as' => 'ordenes.store', 'uses' => 'COrdenDetalles@store']);
	Route::get('ordenes/{cliente}', ['as' => 'ordenes.index', 'uses' => 'COrdenDetalles@index']);
	Route::get('ordenes/orden/{orden}', ['as' => 'ordenes.edit', 'uses' => 'COrdenDetalles@edit']);
	Route::get('ordenes/laboratorio/{orden}', ['as' => 'ordenes.editLab', 'uses' => 'COrdenDetalles@editLab']);
	Route::put('ordenes/{orden}', ['as' => 'ordenes.update', 'uses' => 'COrdenDetalles@update']);
	Route::put('ordenes/laboratorio/actualizar/{orden}', ['as' => 'ordenes.updatelab', 'uses' => 'COrdenDetalles@updatelab']);
	Route::delete('ordenes/delete/{orden}', ['as' => 'ordenes.delete', 'uses' => 'COrdenDetalles@delete']);
	Route::delete('ordenes/delete/mes/{orden}', ['as' => 'ordenes.deleteOrdenMes', 'uses' => 'COrdenDetalles@deleteOrdenMes']);
	//Route::resource('ordenes', 'COrdenDetalles', ['except' => ['show']]);

	//Rutas facturas
	Route::get('facturas/{orden}/create', ['as' => 'facturas.createItem', 'uses' => 'FacturaController@createItem']);
	Route::put('facturas/item/', ['as' => 'facturas.storeItem', 'uses' => 'FacturaController@storeItem']);
	Route::put('facturas/factura/', ['as' => 'facturas.store', 'uses' => 'FacturaController@store']);
	Route::get('facturas/factura/{orden}', ['as' => 'facturas.edit', 'uses' => 'FacturaController@edit']);
	Route::get('facturas/notaCredito/{orden}', ['as' => 'facturas.notaCredito', 'uses' => 'FacturaController@notaCredito']);
	Route::put('facturas/notaCredito/store/{orden}', ['as' => 'facturas.nCreditoStore', 'uses' => 'FacturaController@nCreditoStore']);
	Route::get('facturas/laboratorio/{orden}', ['as' => 'facturas.editLab', 'uses' => 'FacturaController@editLab']);
	Route::put('facturas/{orden}', ['as' => 'facturas.update', 'uses' => 'FacturaController@update']);
	Route::put('facturas/laboratorio/actualizar/{orden}', ['as' => 'facturas.updatelab', 'uses' => 'FacturaController@updatelab']);
	
	//Rutas HTML - PDF
	Route::get('PDF/orden/preview/{orden}', ['as' => 'PDF.orden', 'uses' => 'PDFController@orden']);
	Route::get('PDF/orden/{orden}', ['as' => 'PDF.ordenToPDF', 'uses' => 'PDFController@ordenToPDF']);
	Route::get('PDF/laboratorio/preview/{orden}', ['as' => 'PDF.laboratorio', 'uses' => 'PDFController@laboratorio']);
	Route::get('PDF/laboratorio/{orden}', ['as' => 'PDF.laboratorioToPDF', 'uses' => 'PDFController@laboratorioToPDF']);
	Route::get('PDF/certificado/preview/{orden}', ['as' => 'PDF.certificado', 'uses' => 'PDFController@certificado']);
	Route::get('PDF/certificado/{orden}', ['as' => 'PDF.certificadoToPDF', 'uses' => 'PDFController@certificadoToPDF']);
	Route::get('PDF/certificado/agregar/{orden}', ['as' => 'PDF.certificadoadd', 'uses' => 'PDFController@certificadoadd']);
	Route::put('PDF/certificado/agregar/', ['as' => 'PDF.certificadoStore', 'uses' => 'PDFController@certificadoStore']);
	Route::get('PDF/abono/preview/{orden}', ['as' => 'PDF.abono', 'uses' => 'PDFController@abono']);
	Route::get('PDF/abono/{orden}', ['as' => 'PDF.abonoToPDF', 'uses' => 'PDFController@abonoToPDF']);
	Route::get('PDF/factura/{orden}', ['as' => 'PDF.factura', 'uses' => 'PDFController@factura']);
	Route::get('PDF/cotizacion/preview/{cotizacion}', ['as' => 'PDF.cotizacion', 'uses' => 'PDFController@cotizacion']);
	Route::get('PDF/cotizacion/{cotizacion}', ['as' => 'PDF.cotizacionToPDF', 'uses' => 'PDFController@cotizacionToPDF']);
	
	//Abono
	Route::get('Abono/{orden}', ['as' => 'abono.index', 'uses' => 'AbonoController@index']);
	Route::get('Abono/crear/{orden}', ['as' => 'abono.create', 'uses' => 'AbonoController@create']);
	Route::put('Abono/edit/', ['as' => 'abono.edit', 'uses' => 'AbonoController@edit']);
	Route::put('Abono/store/', ['as' => 'abono.store', 'uses' => 'AbonoController@store']);
	Route::put('Abono/actualizar/{abono}', ['as' => 'abono.update', 'uses' => 'AbonoController@update']);

	//Admin Cartera
	Route::get('Admin/cartera', ['as' => 'admin.cartera', 'uses' => 'AdminController@cartera']);
	Route::get('Admin/cartera/excel', ['as' => 'admin.carteraExcel', 'uses' => 'AdminController@carteraExcel']);
	//Admin Sede
	Route::get('Admin/sede', ['as' => 'admin.sede', 'uses' => 'AdminController@sede']);
	Route::get('Admin/sede/create', ['as' => 'admin.createFacturaRango', 'uses' => 'AdminController@createFacturaRango']);
	Route::put('Admin/sede/sotre', ['as' => 'admin.storeFacturaRango', 'uses' => 'AdminController@storeFacturaRango']);
	Route::get('Admin/sede/edit/{facturaRango}', ['as' => 'admin.editFacturaRango', 'uses' => 'AdminController@editFacturaRango']);
	Route::put('Admin/sede/update/{facturaRango}', ['as' => 'admin.updateFacturaRango', 'uses' => 'AdminController@updateFacturaRango']);
	Route::delete('Admin/sede/delete/{facturaRango}', ['as' => 'admin.deleteFacturaRango', 'uses' => 'AdminController@deleteFacturaRango']);
	//Admin Bodega
	Route::get('Admin/bodega', ['as' => 'admin.bodega', 'uses' => 'AdminController@bodega']);
	Route::get('Admin/bodega/create', ['as' => 'admin.createBodega', 'uses' => 'AdminController@createBodega']);
	Route::put('Admin/bodega/create/store', ['as' => 'admin.storeBodega', 'uses' => 'AdminController@storeBodega']);
	Route::get('Admin/bodega/edit/{bodega}', ['as' => 'admin.editBodega', 'uses' => 'AdminController@editBodega']);
	Route::put('Admin/bodega/update/{bodega}', ['as' => 'admin.updateBodega', 'uses' => 'AdminController@updateBodega']);
	Route::delete('Admin/bodega/delete/{bodega}', ['as' => 'admin.deleteBodega', 'uses' => 'AdminController@deleteBodega']);
	//Admin Seleccionables
	Route::get('Admin/seleccionables', ['as' => 'admin.seleccionables', 'uses' => 'AdminController@seleccionables']);
	Route::put('Admin/seleccionables/create', ['as' => 'admin.createSelec', 'uses' => 'AdminController@createSeleccionables']);
	Route::get('Admin/seleccionables/delete/{seleccionable}', ['as' => 'admin.deleteSelec', 'uses' => 'AdminController@deleteSeleccionables']);
	Route::get('Admin/clientes/consolidado', ['as' => 'admin.clientesConsolidado', 'uses' => 'AdminController@clientesConsolidado']);
	//Admin Informe
	Route::get('Admin/informe/filtros', ['as' => 'admin.informeFiltro', 'uses' => 'AdminController@informeFiltro']);	
	Route::get('Admin/informe/garantias', ['as' => 'admin.informeGarantia', 'uses' => 'AdminController@informeGarantia']);
	Route::get('Admin/informe/cotizaciones', ['as' => 'admin.informeCotizacion', 'uses' => 'AdminController@informeCotizacion']);
	Route::get('Admin/informe/informe/mes', ['as' => 'admin.informeOrdenMes', 'uses' => 'AdminController@informeOrdenMes']);
	
	/*Route::get('clientes', ['as' => 'clientes.index', 'uses' => 'CClientes@index']);
	Route::get('clientes', ['as' => 'clientes.create', 'uses' => 'CClientes@create']);
	Route::put('clientes', ['as' => 'clientes.store', 'uses' => 'CClientes@store']);
	Route::get('clientes', ['as' => 'clientes.show', 'uses' => 'CClientes@show']);
	Route::get('clientes', ['as' => 'clientes.edit', 'uses' => 'CClientes@edit']);
	Route::put('clientes', ['as' => 'clientes.update', 'uses' => 'CClientes@update']);
	Route::delete('clientes', ['as' => 'clientes.destroy', 'uses' => 'CClientes@update']);*/
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('Admin/informe/{page}', ['as' => 'admin.indexAdmin', 'uses' => 'AdminController@indexAdmin']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('Admin/Informe/{page}', ['as' => 'admin.indexInforme', 'uses' => 'AdminController@indexInforme']);
});

