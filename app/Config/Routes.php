<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Authentications::index');

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}


// Login and habeas data acceptation
/**Routes groups*/
$routes->group('login', ['namespace' => 'App\Controllers\Authentication'], function ($routes) {
    $routes->get('view', 'Authentications::index');
    $routes->post('login', 'Authentications::login');
    $routes->post('logout', 'Authentications::destroySession');
});


// Login and habeas data acceptation
/**Routes groups*/
$routes->group('home', ['namespace' => 'App\Controllers\Home'], function ($routes) {

    $routes->get('home','Home::index');
    $routes->post('validateView','Home::validateView');
    $routes->get('habeas_data','Home::habeas');
    $routes->post('accept','Home::acceptData');
});

// Login and habeas data acceptation
/**Routes groups*/
$routes->group('student', ['namespace' => 'App\Controllers\Content'], function ($routes) {
    $routes->post('module','Content_infos::module');
    $routes->get('module','Content_infos::showModule');
    $routes->post('content','Content_infos::content');
    $routes->get('infographic','Content_infos::showContent');
    $routes->get('video','Content_infos::showContent');
    $routes->get('podcast','Content_infos::showContent');
    $routes->get('quiz','Content_infos::showQuiz');
    $routes->post('quiz','Content_infos::createQuiz');
    $routes->post('lastQuestion','Content_infos::createLastQuestion');
    $routes->get('assessment','Content_infos::showQuiz');
    $routes->post('assessment','Content_infos::createAssessment');
    $routes->get('webinar','Content_infos::showContent');
    $routes->get('dashboard','Content_infos::index');
});

$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('dashboard','Reports::index');
    $routes->post('chart1','Reports::chart1');
    $routes->post('table','Reports::table');
    $routes->post('user','Reports::user');
});