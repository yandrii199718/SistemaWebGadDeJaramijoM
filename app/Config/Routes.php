<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'InicioController::index');
$routes->get('/prueba', 'InicioController::index1');
//$routes->get('/inicio', 'InicioController::index');
$routes->get('json', function(){
	$array = [
		'id' => 1,
		'name' => 'fredy',
	];
	echo json_encode($array);
});



//grupo de rutas que no hay que tener permisos para ingresar
$routes->group('/', [], function($routes){
	$routes->get('', function(){
		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
	});
	$routes->get('login', 'LoginController::index', ['as' => 'login.index']);
	$routes->get('login1', 'Login1Controller::index', ['as' => 'login1.index']);

	$routes->post('signin', 'LoginController::signin');
	$routes->get('signout', 'LoginController::signout');
});

// rutas que solo tiene permiso el administrador
$routes->group('/', ['filter' => 'Permisos:'.ROL_ADMIN], function($routes){

	$routes->get('admin', 'InicioController::index');

	//rutas de usuario
	$routes->get('usuarios', 'UsuariosController::index', ['as' => 'usuarios.index']);
	$routes->post('usuarios', 'UsuariosController::store', ['as' => 'usuarios.store']);
	$routes->post('usuarios/update', 'UsuariosController::update', ['as' => 'usuarios.update']);
	$routes->get('usuarios/(:num)', 'UsuariosController::show/$1', ['as' => 'usuarios.show']);
	$routes->delete('usuarios/delete/(:num)', 'UsuariosController::destroy/$1');
	$routes->get('tablaUsuarios', 'UsuariosController::tableUsuarios');
	$routes->get('reporteUsuarios', 'UsuariosController::reporte', ['as' => 'usuario.reporte']);

	//rutas de cargos
	$routes->get('cargos', 'CargosController::index', ['as' => 'cargos.index']);
	$routes->post('cargos', 'CargosController::store');
	$routes->post('cargos/update', 'CargosController::update');
	$routes->get('cargos/(:num)', 'CargosController::show/$1');
	$routes->delete('cargos/(:num)', 'CargosController::destroy/$1');
	$routes->get('tablaCargos', 'CargosController::tableCargos');
	$routes->get('reporteCargos', 'CargosController::report', ['as' => 'charges.report']);

	//rutas de areas
	$routes->get('areas', 'AreasController::index', ['as' => 'areas.index']);
	$routes->post('areas', 'AreasController::store');
	$routes->post('areas/update', 'AreasController::update');
	$routes->get('areas/(:num)', 'AreasController::show/$1');
	$routes->delete('areas/(:num)', 'AreasController::destroy/$1');
	$routes->get('tablaAreas', 'AreasController::tableAreas');
	$routes->get('reporteAreas', 'AreasController::report', ['as' => 'areas.report']);

	//rutas de sedes
	$routes->get('cites', 'SedesController::index', ['as' => 'sedes.index']);
	$routes->post('sedes', 'SedesController::store');
	$routes->post('sedes/update', 'SedesController::update');
	$routes->get('sedes/(:num)', 'SedesController::show/$1');
	$routes->delete('sedes/(:num)', 'SedesController::destroy/$1');
	$routes->get('tablaSedes', 'SedesController::tableSedes');
	$routes->get('reporteSedes', 'SedesController::report', ['as' => 'venues.report']);

	//rutas de marcas
	$routes->get('marcas', 'MarcasController::index', ['as' => 'marcas.index']);
	$routes->post('marcas', 'MarcasController::store');
	$routes->post('marcas/update', 'MarcasController::update');
	$routes->get('marcas/(:num)', 'MarcasController::show/$1');
	$routes->delete('marcas/(:num)', 'MarcasController::destroy/$1');
	$routes->get('tablaMarcas', 'MarcasController::tableMarcas');
	$routes->get('reporteMarcas', 'MarcasController::report', ['as' => 'trademarks.report']);

	//ruta de configuracion
	$routes->get('configuracion', 'ConfigController::index', ['as' => 'configuracion.index']);
	$routes->post('configuracion/update', 'ConfigController::update', ['as' => 'configuracion.update']);



});




// rutas que solo tiene permiso el empleado
$routes->group('/', ['filter' => 'Permisos:'.ROL_TECNICO], function($routes){

	$routes->get('dashboard', 'InicioController::tecnico', ['as' => 'tecnico']);

});



//rutas que tiene permiso el administrador y empleado
$routes->group('/', ['filter' => 'Permisos:'.ROL_ADMIN.','.ROL_TECNICO], function($routes){

	//rutas de cliente
	$routes->get('provedor', 'ProvedorController::index', ['as' => 'provedor.index']);
	$routes->post('provedor', 'ProvedorController::store');
	$routes->post('provedor/update', 'ProvedorController::update');
	$routes->get('provedor/(:num)', 'ProvedorController::show/$1');
	$routes->delete('provedor/(:num)', 'ProvedorController::destroy/$1');
	$routes->get('tablaProvedor', 'ProvedorController::tableClientes');
	$routes->get('reporteProvedor', 'ProvedorController::report', ['as' => 'vendors.report']);


	//rutas de herramientas
	$routes->get('herramientas', 'HerramientasController::index', ['as' => 'herramientas.index']);
	$routes->post('herramientas', 'HerramientasController::store');
	$routes->post('herramientas/update', 'HerramientasController::update');
	$routes->get('herramientas/(:num)', 'HerramientasController::show/$1');
	$routes->delete('herramientas/(:num)', 'HerramientasController::destroy/$1');
	$routes->get('tablaHerramientas', 'HerramientasController::tableHerramientas');
	$routes->get('reporteHeramientas', 'HerramientasController::report', ['as' => 'tools.report']);

	//rutas de equipos
	$routes->get('equipos', 'EquiposController::index', ['as' => 'equipos.index']);
	$routes->post('equipos', 'EquiposController::store');
	$routes->post('equipos/update', 'EquiposController::update');
	$routes->get('equipos/(:num)', 'EquiposController::show/$1');
	$routes->delete('equipos/(:num)', 'EquiposController::destroy/$1');
	$routes->get('tablaEquipos', 'EquiposController::tableEquipos');
	$routes->get('visor-pdf/(:any)/(:num)', 'EquiposController::getPdf/$1/$2');
	$routes->get('reporteEquipos', 'EquiposController::report', ['as' => 'teams.report']);

	//rutas del PerfilController
	$routes->get('perfil', 'PerfilController::index', ['as' => 'perfil.index']);
	$routes->post('perfil/update', 'PerfilController::update');

	//rutas de ordenes
	$routes->get('ordenes', 'OrdenesController::index', ['as' => 'ordenes.index']);
	$routes->post('ordenes', 'OrdenesController::store');
	$routes->post('ordenes/update', 'OrdenesController::update');
	$routes->get('ordenes/(:num)', 'OrdenesController::show/$1');
	$routes->get('ordenes/(:num)/edit', 'OrdenesController::edit/$1');
	$routes->delete('ordenes/(:num)', 'OrdenesController::destroy/$1');
	$routes->get('tablaOrdenes', 'OrdenesController::tableOrdenes');
	$routes->get('reporteOrdenes', 'OrdenesController::report', ['as' => 'orders.report']);
	$routes->get('reporteOrden/(:num)', 'OrdenesController::reporteOrden/$1');


	//ruta cronograma
	$routes->post('cronograma', 'CronogramamantenimientoController::showCronograma');
	$routes->post('getcronograma', 'CronogramamantenimientoController::getCronograma');

	//rutas de mantenimiento
	$routes->get('mantenimiento', 'MantenimientoController::index', ['as' => 'mantenimientos.index']);
	$routes->get('mantenimiento/crear', 'MantenimientoController::create', ['as' => 'mantenimientos.create']);
	$routes->get('mantenimiento/(:num)/editar', 'MantenimientoController::edit/$1', ['as' => 'mantenimientos.edit']);
	$routes->post('mantenimiento', 'MantenimientoController::store', ['as' => 'mantenimientos.store']);
	$routes->post('mantenimiento/update', 'MantenimientoController::update', ['as' => 'mantenimientos.update']);
	$routes->delete('mantenimiento/delete/(:num)', 'MantenimientoController::destroy/$1', ['as' => 'mantenimientos.destroy']);
	$routes->get('mantenimiento/(:num)', 'MantenimientoController::show_ajax/$1', ['as' => 'mantenimientos.show']);
	$routes->delete('mantenimiento/(:num)', 'MantenimientoController::destroy/$1', ['as' => 'mantenimientos.destroy']);
	$routes->get('tablaMantenimientos', 'MantenimientoController::tableMantenimiento');
	$routes->get('reporteMantenimientos', 'MantenimientoController::report', ['as' => 'maintenances.report']);
	$routes->get('mantenimientos-equipos', 'MantenimientoController::getMantenimientoEquipo');
	$routes->get('prueba-calendar', 'MantenimientoController::prueba-calendar', ['as' => 'prueba-calendar']);


	//rutas de filtros
	$routes->get('reportes/(:any)/(:any)/(:any)', 'FiltrosController::reporte/$1/$2/$3', ['as' => 'filtros.reporte']);
	$routes->get('reportes', 'FiltrosController::index', ['as' => 'filtros.index']);
	$routes->post('reportes', 'FiltrosController::filter', ['as' => 'filtros.filter']);




});

//$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
