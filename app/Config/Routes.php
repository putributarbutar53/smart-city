<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);
$routes->get('/', 'Home::index');
$routes->get('form/(:num)', 'Form::index/$1'); // Untuk menangani ID sebagai parameter
// $routes->get('/form', 'Form::index');
