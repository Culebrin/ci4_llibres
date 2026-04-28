<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'LlibresController::index');
$routes->get('/', 'Home::index');
$routes->match(['get', 'post'], '/admin', 'LlibresController::kpacrud');

$routes->get('llibre/(:segment)', 'LlibresController::info/$1');
$routes->get('search', 'LlibresController::search');

// route for adding a book
$routes->match(['get', 'post'], '/add_by_ISBN', "LlibresController::add_by_ISBN");