<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/test', 'ScController::test');
$routes->get('/', 'Home::index');
$routes->get('/osca/sc-list', 'Home::scList');
$routes->get('/osca/add-record', 'Home::addrecord');
$routes->post('/osca/add-record', 'ScController::addRecord');

$routes->get('/osca/manage-record', 'Home::manageRecord');
