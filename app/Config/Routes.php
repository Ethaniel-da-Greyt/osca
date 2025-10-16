<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'Home::loginPage');

$routes->get('/', 'Home::index');
$routes->get('/osca/sc-list', 'Home::scList');
$routes->get('/osca/add-record', 'Home::addrecord');
$routes->post('/osca/add-record', 'ScController::addRecord');

$routes->get('/osca/manage-record/(:num)', 'Home::manageRecord/$1');
$routes->post('/osca/manage-record', 'ScController::update');

$routes->get('/osca/export-record', 'Home::exportView');

$routes->get('/osca/export-record/all', 'ExportController::exportExcel');
$routes->post('/osca/export-record/barangay', 'ExportController::exportExcelByBarangay');
$routes->post('/osca/export-record/unit', 'ExportController::exportExcelByUnit');


$routes->get('/osca/export-record/pdf/all', 'ExportController::exportAllPDF');
$routes->post('/osca/export-record/pdf/unit', 'ExportController::exportPdfByUnit');
$routes->post('/osca/export-record/pdf/barangay', 'ExportController::exportPdfByBarangay');
