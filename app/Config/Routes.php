<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
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
$routes->get('/', 'LoginController::index');
$routes->get('/logout', 'LoginController::logout', ['filter' => 'authfilter']);
$routes->get('/setting-account', 'LoginController::setting', ['filter' => 'authfilter']);
// Dashboard
$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'authfilter']);
// User
$routes->get('/data-user', 'UserController::index', ['filter' => 'authfilter']);
$routes->get('/data-user/edit/(:num)', 'UserController::edit/$1', ['filter' => 'authfilter']);
$routes->get('/atur-area-spv/(:num)', 'UserController::aturArea/$1', ['filter' => 'authfilter']);
// Data barang
$routes->get('/data-barang', 'BarangController::index', ['filter' => 'authfilter']);
$routes->get('/data-barang/edit/(:num)', 'BarangController::edit/$1', ['filter' => 'authfilter']);
// Data toko
$routes->get('/data-toko', 'TokoController::index', ['filter' => 'authfilter']);
$routes->get('/data-toko/edit/(:num)', 'TokoController::edit/$1', ['filter' => 'authfilter']);
// Data program diskon
$routes->get('/data-program', 'DiscController::index', ['filter' => 'authfilter']);
$routes->get('/data-program/edit/(:num)', 'DiscController::edit/$1', ['filter' => 'authfilter']);
// Pengajuan
$routes->get('/form-pengajuan', 'PengajuanController::index', ['filter' => 'authfilter']);
$routes->get('/update-pengajuan', 'PengajuanController::updatePengajuan', ['filter' => 'authfilter']);
$routes->get('/print-pengajuan', 'PengajuanController::printPer', ['filter' => 'authfilter']);
$routes->get('/print-pengajuan/print/(:num)', 'PengajuanController::print/$1', ['filter' => 'authfilter']);
// Logo
$routes->get('/logo', 'logoController::index', ['filter' => 'authfilter']);
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
