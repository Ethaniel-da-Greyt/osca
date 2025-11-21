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

// $routes->get('/sample', 'PdfController::generate'); //TESTINGGGGGGGGGGGGGGGGGGGGGGGGG

// $routes->get('/id-sample', function () {
//     return view('Osca-ID-front');
// }); //TESTINGGGGGGGGGGGGGGGGGGGGGGGGG IDDDDDDDDDDDDD

// $routes->get('/id-sample-back', function () {
//     return view('Osca-ID-back');
// }); //TESTINGGGGGGGGGGGGGGGGGGGGGGGGG IDDDDDDDDDDDDD

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


    //Select Batch for ID Printing
    $routes->get('select-batch', 'Home::listBatches');
    $routes->get('print-batch', 'Home::printBatch');
    $routes->get('osca/print-back', function () {
        return view('Osca-ID-back.php');
    });


    $routes->get('manage-record/print/(:num)', 'PdfController::printID/$1');

    //admin
    $routes->get('users', 'Home::users'); //View Users
    $routes->get('manage-user/(:num)', 'Home::manageUser/$1'); //View Record By ID
    $routes->post('users/add-user', 'UserController::addUser'); //Add User
    $routes->post('users/update-user/(:num)', 'UserController::updateUser/$1'); //Add User



    $routes->get('logout', 'AuthController::logout'); //Logout
});


// $routes->get('generate', 'PdfController::makeNewRecord'); //manifestinggggggggggggg