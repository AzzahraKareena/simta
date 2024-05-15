<?php

use App\Controllers\TimelineController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//ROUTE LANDING
$routes->get('/', 'HomeController::index');
// $routes->get('/dashboard', 'HomeController::dashboard');

$routes->get('/login', 'Auth::index');
$routes->post('/auth/processLogin', 'Auth::processLogin');
$routes->get('/logout', 'Auth::logout');

//TIMELINE
// $routes->group('timeline', ['filter' => 'AuthFilter'], static function ($routes) {
$routes->group('timeline', ['filter' => 'AuthFilter'], static function ($routes) {
    $routes->get('/', [TimelineController::class, 'table']);
    $routes->get('create', [TimelineController::class, 'create']);
    $routes->get('edit/(:segment)', [TimelineController::class, 'edit/$1']);
    $routes->post('store', [TimelineController::class, 'store']);
    $routes->post('update/(:segment)', [TimelineController::class, 'update/$1']);
    $routes->post('delete/(:segment)', [TimelineController::class, 'delete/$1']);
});

//USERS
$routes->group('users', ['filter' => 'AuthFilter'], static function ($routes) {
    $routes->get('/', 'UsersController::table');
    $routes->get('create', 'UsersController::create');
    $routes->post('store', 'UsersController::store');
    $routes->get('edit/(:num)', 'UsersController::edit/$1');
    $routes->post('update/(:num)', 'UsersController::update/$1');
    $routes->get('delete/(:num)', 'UsersController::delete/$1');
});

$routes->group('api/users', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'UsersController::index');
    $routes->get('(:num)', 'UsersController::show/$1');
    $routes->post('/', 'UsersController::store');
    $routes->put('(:num)', 'UsersController::update/$1');
    $routes->post('(:num)', 'UsersController::delete/$1');
});

//PENGAJUAN JUDUL
$routes->group('pengajuanjudul', static function ($routes) {
    $routes->get('/', 'PengajuanJudulController::table');
    $routes->get('create', 'PengajuanJudulController::create');
    $routes->post('store', 'PengajuanJudulController::store');
    $routes->get('edit/(:num)', 'PengajuanJudulController::edit/$1');
    $routes->post('update/(:num)', 'PengajuanJudulController::update/$1');
    $routes->get('delete/(:num)', 'PengajuanJudulController::delete/$1');
});

$routes->group('api/pengajuanjudul', static function ($routes) {
    $routes->get('/', 'PengajuanJudulController::index');
    $routes->get('staff', 'PengajuanJudulController::getStaf');
    $routes->get('create', 'PengajuanJudulController::create');
    $routes->post('store', 'PengajuanJudulController::store');
    $routes->get('edit/(:num)', 'PengajuanJudulController::edit/$1');
    $routes->post('update/(:num)', 'PengajuanJudulController::update/$1');
    $routes->get('delete/(:num)', 'PengajuanJudulController::delete/$1');
});

$routes->post('pengajuanjudul/update_status/(:num)', 'PengajuanJudulController::updateStatus/$1');
$routes->get('pengajuanjudul/ubah-status/(:num)', 'PengajuanJudulController::editStatus/$1');
$routes->post('update/status/(:num)', 'PengajuanBimbinganController::updateStatus/$1');
$routes->post('upload/jadwal/(:num)', 'PengajuanUjianProposalController::uploadJadwal/$1');
$routes->post('update/bimbingan/(:num)', 'PengajuanBimbinganController::updateBimbingan/$1');

$routes->post('update/status_up/(:num)', 'PengajuanUjianProposalController::updateStatus/$1');
$routes->post('upload/revisi/(:num)', 'PengajuanUjianProposalController::uploadRevisi/$1');


//PENGAJUAN BIMBINGAN
$routes->group('pengajuanbimbingan', static function ($routes) {
    $routes->get('/', 'PengajuanBimbinganController::get_data');
    $routes->get('create', 'PengajuanBimbinganController::create');
    $routes->post('store', 'PengajuanBimbinganController::store');
    $routes->get('edit/(:segment)', 'PengajuanBimbinganController::edit/$1');
    $routes->post('update/(:num)', 'PengajuanBimbinganController::update/$1');
    $routes->get('delete/(:num)', 'PengajuanBimbinganController::delete/$1');
    $routes->get('data', 'PengajuanBimbinganController::get_data');
});

//PENGAJUAN UJIAN PROPOSAL
$routes->group('pengajuanujianproposal', static function ($routes) {
    $routes->get('/', 'PengajuanUjianProposalController::table');
    $routes->get('create', 'PengajuanUjianProposalController::create');
    $routes->post('store', 'PengajuanUjianProposalController::store');
    $routes->get('edit/(:segment)', 'PengajuanUjianProposalController::edit/$1');
    $routes->post('update/(:segment)', 'PengajuanUjianProposalController::update/$1');
    $routes->get('delete/(:num)', 'PengajuanUjianProposalController::delete/$1');
    $routes->get('berita-acara', 'PengajuanUjianProposalController::beritaacara');
});

//MASTER FILE BERKAS
$routes->group('berkasTA', static function ($routes) {
    $routes->get('/', 'BerkasTAController::table');
    $routes->get('create', 'BerkasTAController::create');
    $routes->post('store', 'BerkasTAController::store');
    $routes->get('edit/(:segment)', 'BerkasTAController::edit/$1');
    $routes->post('update/(:segment)', 'BerkasTAController::update/$1');
    $routes->get('delete/(:num)', 'BerkasTAController::delete/$1');
});

//DATA MASTER STAF
$routes->group('masterstaf', static function ($routes) {
    $routes->get('/', 'MasterStafController::table');
    $routes->get('create', 'MasterStafController::create');
    $routes->post('store', 'MasterStafController::store');
    $routes->get('edit/(:num)', 'MasterStafController::edit/$1');
    $routes->post('update/(:num)', 'MasterStafController::update/$1');
    $routes->get('delete/(:num)', 'MasterStafController::delete/$1');
});

//KRITERIA
$routes->group('kriteria', static function ($routes) {
    $routes->get('/', 'KriteriaController::table');
    $routes->get('create', 'KriteriaController::create');
    $routes->post('store', 'KriteriaController::store');
    $routes->get('edit/(:num)', 'KriteriaController::edit/$1');
    $routes->post('update/(:num)', 'KriteriaController::update/$1');
    // $routes->get('delete/(:num)', 'KriteriaController::delete/$1');
    $routes->post('delete/(:num)', 'KriteriaController::delete/$1');

});


