<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::loginPage');
$routes->get('/login', 'Home::loginPage');
$routes->post('/login', 'AuthController::login');

$routes->get('/osca-register', 'Home::register');
$routes->post('/osca-register', 'AuthController::register');


$routes->group('osca', ['filter' => 'auth'], function ($routes) {

    $routes->get('/', 'Home::index'); //Dashboard Page
    $routes->get('sc-list', 'Home::scList'); //SC list View Page
    $routes->get('add-record', 'Home::addrecord'); //Add Record View Page
    $routes->post('add-record', 'ScController::addRecord'); //Add New Record

    $routes->get('manage-record/(:num)', 'Home::manageRecord/$1'); //View Record By ID
    $routes->post('manage-record', 'ScController::update'); //Update Record 

    $routes->get('export-record', 'Home::exportView'); //View Export Record Page

    //Export Excel
    $routes->get('export-record/all', 'ExportController::exportExcel'); //Export Excel All Records
    $routes->post('export-record/barangay', 'ExportController::exportExcelByBarangay'); //Export Excel by Barangay 
    $routes->post('export-record/unit', 'ExportController::exportExcelByUnit'); //Export Excel by Barangay Unit

    //Export PDF
    $routes->get('export-record/pdf/all', 'ExportController::exportAllPDF'); //Export PDF all Records
    $routes->post('export-record/pdf/unit', 'ExportController::exportPdfByUnit'); //Export PDF by Barangay UNit
    $routes->post('export-record/pdf/barangay', 'ExportController::exportPdfByBarangay'); //Export PDF by Barangay


    $routes->get('logout', 'AuthController::logout'); //Logout
});
