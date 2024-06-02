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

//JUDUL ACC
$routes->group('judulacc', static function ($routes) {
    $routes->get('/', 'JudulAccController::table');
    // $routes->get('judulacc/', 'JudulAccController::table');
    $routes->get('create/(:num)', 'JudulAccController::create/$1');
    $routes->post('store', 'JudulAccController::store');
    // $routes->get('edit/(:num)', 'JudulAccController::edit/$1');
    // $routes->post('update/(:num)', 'JudulAccController::update/$1');
    $routes->post('delete/(:num)', 'JudulAccController::delete/$1');
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
$routes->post('update/tracking/(:num)', 'PengajuanBimbinganController::updateTracking/$1');
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
    $routes->get('berita-acara/(:num)', 'PengajuanUjianProposalController::beritaacara/$1');
    $routes->get('unduh-revisi/(:num)', 'PengajuanUjianProposalController::unduhRevisi/$1');
    // $routes->get('penilaian-proposal', 'PenilaianProposal::penilaian');
});

//RILIS JADWAL
$routes->group('rilisjadwal', static function ($routes) {
    $routes->get('/', 'JadwalUjianPropoController::table');
    $routes->get('create', 'JadwalUjianPropoController::create');
    $routes->post('store', 'JadwalUjianPropoController::store');
    $routes->get('edit/(:segment)', 'JadwalUjianPropoController::edit/$1');
    $routes->post('update/(:segment)', 'JadwalUjianPropoController::update/$1');
    $routes->post('delete/(:num)', 'JadwalUjianPropoController::delete/$1');
    $routes->get('berita-acara/(:num)', 'JadwalUjianPropoController::beritaacara/$1');
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
    $routes->post('update/(:segment)', 'MasterStafController::update/$1');
    $routes->post('delete/(:segment)', 'MasterStafController::delete/$1');
});

//DATA MASTER MAHASISWA
$routes->group('mastermahasiswa', static function ($routes) {
    $routes->get('/', 'MasterMahasiswaController::table');
    $routes->get('create', 'MasterMahasiswaController::create');
    $routes->post('store', 'MasterMahasiswaController::store');
    $routes->get('edit/(:num)', 'MasterMahasiswaController::edit/$1');
    $routes->post('update/(:segment)', 'MasterMahasiswaController::update/$1');
    $routes->post('delete/(:segment)', 'MasterMahasiswaController::delete/$1');
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

//INDIKATOR
$routes->group('indikator', static function ($routes) {
    $routes->get('/', 'IndikatorController::table');
    $routes->get('create', 'IndikatorController::create');
    $routes->post('store', 'IndikatorController::store');
    $routes->get('edit/(:num)', 'IndikatorController::edit/$1');
    $routes->post('update/(:num)', 'IndikatorController::update/$1');
    // $routes->get('delete/(:num)', 'IndikatorController::delete/$1');
    $routes->post('delete/(:num)', 'IndikatorController::delete/$1');

});

//INDIKATOR
$routes->group('penilaianproposal', static function ($routes) {
    $routes->get('/', 'PenilaianProposalController::table');
    $routes->get('create/(:num)', 'PenilaianProposalController::create/$1');
    $routes->post('store', 'PenilaianProposalController::store');
    $routes->get('edit/(:num)', 'PenilaianProposalController::edit/$1');
    $routes->get('pdf/(:num)', 'PenilaianProposalController::penilaian');
    $routes->post('update', 'PenilaianProposalController::update');
    $routes->post('delete/(:num)', 'PenilaianProposalController::delete/$1');
});

//PENGAJUAN SEMINAR HASIL
$routes->group('pengajuanseminarhasil', static function ($routes) {
    $routes->get('/', 'PengajuanSeminarHasilController::table');
    $routes->get('create', 'PengajuanSeminarHasilController::create');
    $routes->post('store', 'PengajuanSeminarHasilController::store');
    $routes->get('edit/(:segment)', 'PengajuanSeminarHasilController::edit/$1');
    $routes->post('update/(:segment)', 'PengajuanSeminarHasilController::update/$1');
    $routes->get('delete/(:num)', 'PengajuanSeminarHasilController::delete/$1');
}); 

//PENGAJUAN SIDANG
$routes->group('pengajuansidang', static function ($routes) {
    $routes->get('/', 'PengajuanSidangController::table');
    $routes->get('create', 'PengajuanSidangController::create');
    $routes->post('store', 'PengajuanSidangController::store');
    $routes->get('edit/(:segment)', 'PengajuanSidangController::edit/$1');
    $routes->post('update/(:segment)', 'PengajuanSidangController::update/$1');
    $routes->get('delete/(:num)', 'PengajuanSidangController::delete/$1');
});  


