<?php namespace Config;

use App\Controllers\Dashboard;

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

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->match(['get', 'post'],'/', 'Controller::index');
$routes->match(['get', 'post'], 'register', 'Controller::register');
$routes->match(['get', 'post'],'forgotPass', 'Controller::forgotPass');
$routes->match(['get', 'post'],'index', 'Controller::index');
$routes->match(['get', 'post'], 'index', 'Dashboard::index');
$routes->match(['get', 'post'], 'create', 'Dashboard::create');
$routes->match(['get', 'post'], 'createdTest', 'Dashboard::createdTest');
$routes->match(['get', 'post'], 'contact', 'Dashboard::contact');
$routes->get('logout', 'Controller::logout');
$routes->get('read', 'Dashboard::read');
$routes->match(['get', 'post'],'created', 'Dashboard::created');
$routes->match(['get', 'post'],'created/(:any)', 'Dashboard::created/$1');
$routes->get('used', 'Dashboard::used');
$routes->get('used/(:any)', 'Dashboard::used/$1');
$routes->get('pending', 'Dashboard::pending');
$routes->get('pending/(:any)', 'Dashboard::pending/$1');
$routes->get('clients', 'Dashboard::clients');
$routes->get('clients/(:any)', 'Dashboard::clients/$1');
$routes->get('codeqr', 'Dashboard::codeqr');
$routes->get('giftedclients', 'Dashboard::giftedclients');
$routes->get('giftedclients(:any)', 'Dashboard::giftedclients/$1');
$routes->match(['get', 'post'], 'codeqr/(:any)', 'Dashboard::codeqr/$1');
$routes->match(['get', 'post'], 'resetpass', 'Controller::resetpass');
$routes->match(['get', 'post'], 'resetpass/(:any)', 'Controller::resetpass');
$routes->match(['get', 'post'], 'accounting', 'Dashboard::accounting');
$routes->match(['get', 'post'], 'qrcode/(:any)', 'Dashboard::qrcode/$1');



/**
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
