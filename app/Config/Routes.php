<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// routes auth login
$routes->get('/', 'Auth::index');
$routes->get('/register', 'Auth::register');
$routes->post('login_processed', 'Auth::login_processed');
if (session()->is_login) {
    $routes->get('logout', 'Auth::logout');
    $routes->get('profile/(:num)', 'Auth::profile/$1');
    $routes->post('update-profile/(:num)', 'Auth::updateProfileUser/$1');
    $routes->get('change-password-profile/(:num)', 'Auth::changePasswordProfile/$1');
    $routes->post('change-password-profile-processed/(:num)', 'Auth::changePasswordProfileProcessed/$1');
}

// routes admin page
if (session()->get('level') == 1) {
    $routes->group(
        'admin',
        ['filter' => 'auth'],
        static function ($routes) {
            $routes->get('/', 'Dashboard::index');

            //data user route
            $routes->get('data_users', 'User::index');
            $routes->get('add_users', 'User::add');
            $routes->post('store', 'User::store');
            $routes->get('edit/(:num)', 'User::edit/$1');
            $routes->post('update/(:num)', 'User::update/$1');
            $routes->get('change-password/(:num)', 'User::changePassword/$1');
            $routes->post('change-password-processed/(:num)', 'User::changePasswordProcessed/$1');
            $routes->get('delete/(:num)', 'User::delete/$1');

            $routes->group(
                'data_permohonan_pkl',
                static function ($routes) {
                    //data permohonan route
                    $routes->get('/', 'Request::index');
                    $routes->post('store', 'Request::store');
                    $routes->get('detail/(:num)', 'Request::detail/$1');
                    $routes->get('edit/(:num)', 'Request::edit/$1');
                    $routes->post('update/(:num)', 'Request::update/$1');
                    $routes->get('delete/(:num)', 'Request::delete/$1');
                }
            );
        }
    );
}

// routes user page
if (session()->get('level') == 2) {
    $routes->group(
        'user',
        ['filter' => 'auth'],
        static function ($routes) {
            $routes->get('/', 'Dashboard::index');
        }
    );
}

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
