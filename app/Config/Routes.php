<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);

$routes->get('/', 'Home::index');
$routes->get('form/(:num)', 'Form::index/$1'); // Untuk menangani ID sebagai parameter

// $routes->get('admin2053/subdimensi/(:num)', 'Subdimensi::show/$1');
$routes->get('admin2053/bagian/(:num)', 'Bagian::index/$1');


// $routes->get('/form', 'Form::index');

$routes->add('admin2053/logout', 'Admin2053\Login::logout');

$routes->group('admin2053', ['filter' => 'noadmin'], function ($routes) {
    $routes->add('', 'Admin2053\Login::login');
    $routes->add('login', 'Admin2053\Login::login');
    $routes->add('lupapassword', 'Admin2053\Login::lupapassword');
    $routes->add('resetpassword', 'Admin2053\Login::resetpassword');
});
