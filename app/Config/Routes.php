<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/test', 'ScController::test');
$routes->get('/', 'Home::index');
$routes->get('/osca/sc-list', 'Home::scList');
