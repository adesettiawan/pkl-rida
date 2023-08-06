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
$routes->post('register_processed', 'Auth::register_processed');
$routes->get('/forgot-password', 'Auth::forgot_password');
$routes->post('forgot_password_processed', 'Auth::forgot_password_processed');
$routes->get('/new-password/(:any)', 'Auth::new_password/$1');
$routes->post('new_password_processed/(:any)', 'Auth::new_password_processed/$1');


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
            $routes->get('dashboard', 'Dashboard::index');

            //data user route
            $routes->get('data_users', 'User::index');
            $routes->get('add_users', 'User::add');
            $routes->post('store', 'User::store');
            $routes->get('edit/(:num)', 'User::edit/$1');
            $routes->post('update/(:num)', 'User::update/$1');
            $routes->get('change-password/(:num)', 'User::changePassword/$1');
            $routes->post('change-password-processed/(:num)', 'User::changePasswordProcessed/$1');
            $routes->get('delete/(:num)', 'User::delete/$1');

            // route permohonan
            $routes->group(
                'data_permohonan_pkl',
                static function ($routes) {
                    $routes->get('/', 'Request::index');
                    $routes->get('add', 'Request::add');
                    $routes->post('store', 'Request::store');
                    $routes->post('verifikasiStatus/(:num)', 'Request::verifikasiStatus/$1');
                    $routes->get('detail/(:num)', 'Request::detail/$1');
                    $routes->get('edit/(:num)', 'Request::edit/$1');
                    $routes->post('update/(:num)', 'Request::update/$1');
                    $routes->get('delete/(:num)', 'Request::delete/$1');
                    $routes->get('exportPDF', 'Request::exportPDF');
                }
            );

            $routes->group(
                'data_permohonan_kkn',
                static function ($routes) {
                    $routes->get('/', 'RequestKKN::index');
                    $routes->get('add', 'RequestKKN::add');
                    $routes->post('store', 'RequestKKN::store');
                    $routes->post('verifikasiStatus/(:num)', 'RequestKKN::verifikasiStatus/$1');
                    $routes->get('detail/(:num)', 'RequestKKN::detail/$1');
                    $routes->get('edit/(:num)', 'RequestKKN::edit/$1');
                    $routes->post('update/(:num)', 'RequestKKN::update/$1');
                    $routes->get('delete/(:num)', 'RequestKKN::delete/$1');
                    $routes->get('exportPDF', 'RequestKKN::exportPDF');
                }
            );

            $routes->group(
                'data_permohonan_penelitian',
                static function ($routes) {
                    $routes->get('/', 'RequestPenelitian::index');
                    $routes->get('add', 'RequestPenelitian::add');
                    $routes->post('store', 'RequestPenelitian::store');
                    $routes->post('verifikasiStatus/(:num)', 'RequestPenelitian::verifikasiStatus/$1');
                    $routes->get('detail/(:num)', 'RequestPenelitian::detail/$1');
                    $routes->get('edit/(:num)', 'RequestPenelitian::edit/$1');
                    $routes->post('update/(:num)', 'RequestPenelitian::update/$1');
                    $routes->get('delete/(:num)', 'RequestPenelitian::delete/$1');
                    $routes->get('exportPDF', 'RequestPenelitian::exportPDF');
                }
            );

            // route balasan
            $routes->group(
                'data_balasan_pkl',
                static function ($routes) {
                    $routes->get('/', 'RepliesPKL::index');
                    $routes->get('add', 'RepliesPKL::add');
                    $routes->post('store', 'RepliesPKL::store');
                    $routes->post('verifikasiStatus/(:num)', 'RepliesPKL::verifikasiStatus/$1');
                    $routes->get('detail/(:num)', 'RepliesPKL::detail/$1');
                    $routes->get('edit/(:num)', 'RepliesPKL::edit/$1');
                    $routes->post('update/(:num)', 'RepliesPKL::update/$1');
                    $routes->get('delete/(:num)', 'RepliesPKL::delete/$1');
                    $routes->get('exportPDF', 'RepliesPKL::exportPDF');
                }
            );

            $routes->group(
                'data_balasan_kkn',
                static function ($routes) {
                    $routes->get('/', 'RepliesKKN::index');
                    $routes->get('add', 'RepliesKKN::add');
                    $routes->post('store', 'RepliesKKN::store');
                    $routes->post('verifikasiStatus/(:num)', 'RepliesKKN::verifikasiStatus/$1');
                    $routes->get('detail/(:num)', 'RepliesKKN::detail/$1');
                    $routes->get('edit/(:num)', 'RepliesKKN::edit/$1');
                    $routes->post('update/(:num)', 'RepliesKKN::update/$1');
                    $routes->get('delete/(:num)', 'RepliesKKN::delete/$1');
                    $routes->get('exportPDF', 'RepliesKKN::exportPDF');
                }
            );

            $routes->group(
                'data_balasan_penelitian',
                static function ($routes) {
                    $routes->get('/', 'RepliesPenelitian::index');
                    $routes->get('add', 'RepliesPenelitian::add');
                    $routes->post('store', 'RepliesPenelitian::store');
                    $routes->post('verifikasiStatus/(:num)', 'RepliesPenelitian::verifikasiStatus/$1');
                    $routes->get('detail/(:num)', 'RepliesPenelitian::detail/$1');
                    $routes->get('edit/(:num)', 'RepliesPenelitian::edit/$1');
                    $routes->post('update/(:num)', 'RepliesPenelitian::update/$1');
                    $routes->get('delete/(:num)', 'RepliesPenelitian::delete/$1');
                    $routes->get('exportPDF', 'RepliesPenelitian::exportPDF');
                }
            );

            // route laporan
            $routes->group(
                'laporan_pkl',
                static function ($routes) {
                    $routes->get('/', 'ReportPKL::index');
                    $routes->get('add', 'ReportPKL::add');
                    $routes->post('store', 'ReportPKL::store');
                    $routes->post('verifikasiStatus/(:num)', 'ReportPKL::verifikasiStatus/$1');
                    $routes->get('detail/(:num)', 'ReportPKL::detail/$1');
                    $routes->get('edit/(:num)', 'ReportPKL::edit/$1');
                    $routes->post('update/(:num)', 'ReportPKL::update/$1');
                    $routes->get('delete/(:num)', 'ReportPKL::delete/$1');
                    $routes->get('exportPDF', 'ReportPKL::exportPDF');
                }
            );

            $routes->group(
                'laporan_kkn',
                static function ($routes) {
                    $routes->get('/', 'ReportKKN::index');
                    $routes->get('add', 'ReportKKN::add');
                    $routes->post('store', 'ReportKKN::store');
                    $routes->post('verifikasiStatus/(:num)', 'ReportKKN::verifikasiStatus/$1');
                    $routes->get('detail/(:num)', 'ReportKKN::detail/$1');
                    $routes->get('edit/(:num)', 'ReportKKN::edit/$1');
                    $routes->post('update/(:num)', 'ReportKKN::update/$1');
                    $routes->get('delete/(:num)', 'ReportKKN::delete/$1');
                    $routes->get('exportPDF', 'ReportKKN::exportPDF');
                }
            );

            $routes->group(
                'laporan_penelitian',
                static function ($routes) {
                    $routes->get('/', 'ReportPenelitian::index');
                    $routes->get('add', 'ReportPenelitian::add');
                    $routes->post('store', 'ReportPenelitian::store');
                    $routes->post('verifikasiStatus/(:num)', 'ReportPenelitian::verifikasiStatus/$1');
                    $routes->get('detail/(:num)', 'ReportPenelitian::detail/$1');
                    $routes->get('edit/(:num)', 'ReportPenelitian::edit/$1');
                    $routes->post('update/(:num)', 'ReportPenelitian::update/$1');
                    $routes->get('delete/(:num)', 'ReportPenelitian::delete/$1');
                    $routes->get('exportPDF', 'ReportPenelitian::exportPDF');
                }
            );

            // supervisi
            $routes->group(
                'supervisi',
                static function ($routes) {
                    $routes->get('/', 'Supervisi::index');
                    $routes->get('add', 'Supervisi::add');
                    $routes->post('store', 'Supervisi::store');
                    $routes->post('verifikasiStatus/(:num)', 'Supervisi::verifikasiStatus/$1');
                    $routes->get('detail/(:num)', 'Supervisi::detail/$1');
                    $routes->get('edit/(:num)', 'Supervisi::edit/$1');
                    $routes->post('update/(:num)', 'Supervisi::update/$1');
                    $routes->get('delete/(:num)', 'Supervisi::delete/$1');
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
            $routes->get('dashboard', 'Dashboard::index');

            // route permohonan
            $routes->group(
                'data_permohonan_pkl',
                static function ($routes) {
                    $routes->get('/', 'Peserta\RequestPKL::index');
                    $routes->get('add', 'Peserta\RequestPKL::add');
                    $routes->post('store', 'Peserta\RequestPKL::store');
                    $routes->post('verifikasiToAdmin/(:num)', 'Peserta\RequestPKL::verifikasiToAdmin/$1');
                    $routes->get('detail/(:num)', 'Peserta\RequestPKL::detail/$1');
                    $routes->get('edit/(:num)', 'Peserta\RequestPKL::edit/$1');
                    $routes->post('update/(:num)', 'Peserta\RequestPKL::update/$1');
                    $routes->get('delete/(:num)', 'Peserta\RequestPKL::delete/$1');
                }
            );

            $routes->group(
                'data_permohonan_kkn',
                static function ($routes) {
                    $routes->get('/', 'Peserta\RequestKKN::index');
                    $routes->get('add', 'Peserta\RequestKKN::add');
                    $routes->post('store', 'Peserta\RequestKKN::store');
                    $routes->post('verifikasiToAdmin/(:num)', 'Peserta\RequestKKN::verifikasiToAdmin/$1');
                    $routes->get('detail/(:num)', 'Peserta\RequestKKN::detail/$1');
                    $routes->get('edit/(:num)', 'Peserta\RequestKKN::edit/$1');
                    $routes->post('update/(:num)', 'Peserta\RequestKKN::update/$1');
                    $routes->get('delete/(:num)', 'Peserta\RequestKKN::delete/$1');
                }
            );

            $routes->group(
                'data_permohonan_penelitian',
                static function ($routes) {
                    $routes->get('/', 'Peserta\RequestPenelitian::index');
                    $routes->get('add', 'Peserta\RequestPenelitian::add');
                    $routes->post('store', 'Peserta\RequestPenelitian::store');
                    $routes->post('verifikasiToAdmin/(:num)', 'Peserta\RequestPenelitian::verifikasiToAdmin/$1');
                    $routes->get('detail/(:num)', 'Peserta\RequestPenelitian::detail/$1');
                    $routes->get('edit/(:num)', 'Peserta\RequestPenelitian::edit/$1');
                    $routes->post('update/(:num)', 'Peserta\RequestPenelitian::update/$1');
                    $routes->get('delete/(:num)', 'Peserta\RequestPenelitian::delete/$1');
                }
            );

            // route balasan
            $routes->group(
                'data_balasan_pkl',
                static function ($routes) {
                    $routes->get('/', 'Peserta\RepliesPKL::index');
                    $routes->get('show/(:num)', 'Peserta\RepliesPKL::show/$1');
                }
            );

            $routes->group(
                'data_balasan_kkn',
                static function ($routes) {
                    $routes->get('/', 'Peserta\RepliesKKN::index');
                    $routes->get('show/(:num)', 'Peserta\RepliesKKN::show/$1');
                }
            );

            $routes->group(
                'data_balasan_penelitian',
                static function ($routes) {
                    $routes->get('/', 'Peserta\RepliesPenelitian::index');
                    $routes->get('show/(:num)', 'Peserta\RepliesPenelitian::show/$1');
                }
            );

            // route laporan
            $routes->group(
                'laporan_pkl',
                static function ($routes) {
                    $routes->get('/', 'Peserta\ReportPKL::index');
                    $routes->get('add', 'Peserta\ReportPKL::add');
                    $routes->post('store', 'Peserta\ReportPKL::store');
                    $routes->post('verifikasiToAdmin/(:num)', 'Peserta\ReportPKL::verifikasiToAdmin/$1');
                    $routes->get('detail/(:num)', 'Peserta\ReportPKL::detail/$1');
                    $routes->get('edit/(:num)', 'Peserta\ReportPKL::edit/$1');
                    $routes->post('update/(:num)', 'Peserta\ReportPKL::update/$1');
                    $routes->get('delete/(:num)', 'Peserta\ReportPKL::delete/$1');
                }
            );

            $routes->group(
                'laporan_kkn',
                static function ($routes) {
                    $routes->get('/', 'Peserta\ReportKKN::index');
                    $routes->get('add', 'Peserta\ReportKKN::add');
                    $routes->post('store', 'Peserta\ReportKKN::store');
                    $routes->post('verifikasiToAdmin/(:num)', 'Peserta\ReportKKN::verifikasiToAdmin/$1');
                    $routes->get('detail/(:num)', 'Peserta\ReportKKN::detail/$1');
                    $routes->get('edit/(:num)', 'Peserta\ReportKKN::edit/$1');
                    $routes->post('update/(:num)', 'Peserta\ReportKKN::update/$1');
                    $routes->get('delete/(:num)', 'Peserta\ReportKKN::delete/$1');
                }
            );

            $routes->group(
                'laporan_penelitian',
                static function ($routes) {
                    $routes->get('/', 'Peserta\ReportPenelitian::index');
                    $routes->get('add', 'Peserta\ReportPenelitian::add');
                    $routes->post('store', 'Peserta\ReportPenelitian::store');
                    $routes->post('verifikasiToAdmin/(:num)', 'Peserta\ReportPenelitian::verifikasiToAdmin/$1');
                    $routes->get('detail/(:num)', 'Peserta\ReportPenelitian::detail/$1');
                    $routes->get('edit/(:num)', 'Peserta\ReportPenelitian::edit/$1');
                    $routes->post('update/(:num)', 'Peserta\ReportPenelitian::update/$1');
                    $routes->get('delete/(:num)', 'Peserta\ReportPenelitian::delete/$1');
                }
            );

            // supervisi
            $routes->group(
                'supervisi',
                static function ($routes) {
                    $routes->get('/', 'Peserta\Supervisi::index');
                    $routes->get('add', 'Peserta\Supervisi::add');
                    $routes->post('store', 'Peserta\Supervisi::store');
                    $routes->post('verifikasiToAdmin/(:num)', 'Peserta\Supervisi::verifikasiToAdmin/$1');
                    $routes->get('detail/(:num)', 'Peserta\Supervisi::detail/$1');
                    $routes->get('edit/(:num)', 'Peserta\Supervisi::edit/$1');
                    $routes->post('update/(:num)', 'Peserta\Supervisi::update/$1');
                    $routes->get('delete/(:num)', 'Peserta\Supervisi::delete/$1');
                }
            );
        }
    );
}

// routes pimpinan page
if (session()->get('level') == 0) {
    $routes->group(
        'admin',
        ['filter' => 'auth'],
        static function ($routes) {
            $routes->get('dashboard', 'Dashboard::index');

            //data user route
            $routes->get('data_users', 'User::index');
            $routes->get('add_users', 'User::add');
            $routes->post('store', 'User::store');
            $routes->get('edit/(:num)', 'User::edit/$1');
            $routes->post('update/(:num)', 'User::update/$1');
            $routes->get('change-password/(:num)', 'User::changePassword/$1');
            $routes->post('change-password-processed/(:num)', 'User::changePasswordProcessed/$1');
            $routes->get('delete/(:num)', 'User::delete/$1');

            // route permohonan
            $routes->group(
                'data_permohonan_pkl',
                static function ($routes) {
                    $routes->get('/', 'Request::index');
                    $routes->get('add', 'Request::add');
                    $routes->post('store', 'Request::store');
                    $routes->post('verifikasiStatus/(:num)', 'Request::verifikasiStatus/$1');
                    $routes->get('detail/(:num)', 'Request::detail/$1');
                    $routes->get('edit/(:num)', 'Request::edit/$1');
                    $routes->post('update/(:num)', 'Request::update/$1');
                    $routes->get('delete/(:num)', 'Request::delete/$1');
                    $routes->get('exportPDF', 'Request::exportPDF');
                }
            );

            $routes->group(
                'data_permohonan_kkn',
                static function ($routes) {
                    $routes->get('/', 'RequestKKN::index');
                    $routes->get('add', 'RequestKKN::add');
                    $routes->post('store', 'RequestKKN::store');
                    $routes->post('verifikasiStatus/(:num)', 'RequestKKN::verifikasiStatus/$1');
                    $routes->get('detail/(:num)', 'RequestKKN::detail/$1');
                    $routes->get('edit/(:num)', 'RequestKKN::edit/$1');
                    $routes->post('update/(:num)', 'RequestKKN::update/$1');
                    $routes->get('delete/(:num)', 'RequestKKN::delete/$1');
                    $routes->get('exportPDF', 'RequestKKN::exportPDF');
                }
            );

            $routes->group(
                'data_permohonan_penelitian',
                static function ($routes) {
                    $routes->get('/', 'RequestPenelitian::index');
                    $routes->get('add', 'RequestPenelitian::add');
                    $routes->post('store', 'RequestPenelitian::store');
                    $routes->post('verifikasiStatus/(:num)', 'RequestPenelitian::verifikasiStatus/$1');
                    $routes->get('detail/(:num)', 'RequestPenelitian::detail/$1');
                    $routes->get('edit/(:num)', 'RequestPenelitian::edit/$1');
                    $routes->post('update/(:num)', 'RequestPenelitian::update/$1');
                    $routes->get('delete/(:num)', 'RequestPenelitian::delete/$1');
                    $routes->get('exportPDF', 'RequestPenelitian::exportPDF');
                }
            );

            // route balasan
            $routes->group(
                'data_balasan_pkl',
                static function ($routes) {
                    $routes->get('/', 'RepliesPKL::index');
                    $routes->get('add', 'RepliesPKL::add');
                    $routes->post('store', 'RepliesPKL::store');
                    $routes->post('verifikasiStatus/(:num)', 'RepliesPKL::verifikasiStatus/$1');
                    $routes->get('detail/(:num)', 'RepliesPKL::detail/$1');
                    $routes->get('edit/(:num)', 'RepliesPKL::edit/$1');
                    $routes->post('update/(:num)', 'RepliesPKL::update/$1');
                    $routes->get('delete/(:num)', 'RepliesPKL::delete/$1');
                    $routes->get('exportPDF', 'RepliesPKL::exportPDF');
                }
            );

            $routes->group(
                'data_balasan_kkn',
                static function ($routes) {
                    $routes->get('/', 'RepliesKKN::index');
                    $routes->get('add', 'RepliesKKN::add');
                    $routes->post('store', 'RepliesKKN::store');
                    $routes->post('verifikasiStatus/(:num)', 'RepliesKKN::verifikasiStatus/$1');
                    $routes->get('detail/(:num)', 'RepliesKKN::detail/$1');
                    $routes->get('edit/(:num)', 'RepliesKKN::edit/$1');
                    $routes->post('update/(:num)', 'RepliesKKN::update/$1');
                    $routes->get('delete/(:num)', 'RepliesKKN::delete/$1');
                    $routes->get('exportPDF', 'RepliesKKN::exportPDF');
                }
            );

            $routes->group(
                'data_balasan_penelitian',
                static function ($routes) {
                    $routes->get('/', 'RepliesPenelitian::index');
                    $routes->get('add', 'RepliesPenelitian::add');
                    $routes->post('store', 'RepliesPenelitian::store');
                    $routes->post('verifikasiStatus/(:num)', 'RepliesPenelitian::verifikasiStatus/$1');
                    $routes->get('detail/(:num)', 'RepliesPenelitian::detail/$1');
                    $routes->get('edit/(:num)', 'RepliesPenelitian::edit/$1');
                    $routes->post('update/(:num)', 'RepliesPenelitian::update/$1');
                    $routes->get('delete/(:num)', 'RepliesPenelitian::delete/$1');
                    $routes->get('exportPDF', 'RepliesPenelitian::exportPDF');
                }
            );

            // route laporan
            $routes->group(
                'laporan_pkl',
                static function ($routes) {
                    $routes->get('/', 'ReportPKL::index');
                    $routes->get('add', 'ReportPKL::add');
                    $routes->post('store', 'ReportPKL::store');
                    $routes->post('verifikasiStatus/(:num)', 'ReportPKL::verifikasiStatus/$1');
                    $routes->get('detail/(:num)', 'ReportPKL::detail/$1');
                    $routes->get('edit/(:num)', 'ReportPKL::edit/$1');
                    $routes->post('update/(:num)', 'ReportPKL::update/$1');
                    $routes->get('delete/(:num)', 'ReportPKL::delete/$1');
                    $routes->get('exportPDF', 'ReportPKL::exportPDF');
                }
            );

            $routes->group(
                'laporan_kkn',
                static function ($routes) {
                    $routes->get('/', 'ReportKKN::index');
                    $routes->get('add', 'ReportKKN::add');
                    $routes->post('store', 'ReportKKN::store');
                    $routes->post('verifikasiStatus/(:num)', 'ReportKKN::verifikasiStatus/$1');
                    $routes->get('detail/(:num)', 'ReportKKN::detail/$1');
                    $routes->get('edit/(:num)', 'ReportKKN::edit/$1');
                    $routes->post('update/(:num)', 'ReportKKN::update/$1');
                    $routes->get('delete/(:num)', 'ReportKKN::delete/$1');
                    $routes->get('exportPDF', 'ReportKKN::exportPDF');
                }
            );

            $routes->group(
                'laporan_penelitian',
                static function ($routes) {
                    $routes->get('/', 'ReportPenelitian::index');
                    $routes->get('add', 'ReportPenelitian::add');
                    $routes->post('store', 'ReportPenelitian::store');
                    $routes->post('verifikasiStatus/(:num)', 'ReportPenelitian::verifikasiStatus/$1');
                    $routes->get('detail/(:num)', 'ReportPenelitian::detail/$1');
                    $routes->get('edit/(:num)', 'ReportPenelitian::edit/$1');
                    $routes->post('update/(:num)', 'ReportPenelitian::update/$1');
                    $routes->get('delete/(:num)', 'ReportPenelitian::delete/$1');
                    $routes->get('exportPDF', 'ReportPenelitian::exportPDF');
                }
            );

            // supervisi
            $routes->group(
                'supervisi',
                static function ($routes) {
                    $routes->get('/', 'Supervisi::index');
                    $routes->get('add', 'Supervisi::add');
                    $routes->post('store', 'Supervisi::store');
                    $routes->post('verifikasiStatus/(:num)', 'Supervisi::verifikasiStatus/$1');
                    $routes->get('detail/(:num)', 'Supervisi::detail/$1');
                    $routes->get('edit/(:num)', 'Supervisi::edit/$1');
                    $routes->post('update/(:num)', 'Supervisi::update/$1');
                    $routes->get('delete/(:num)', 'Supervisi::delete/$1');
                }
            );
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
