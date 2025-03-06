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

//tambahan baru untuk notif wa dan timeline option select
$routes->get('/reminder', 'ReminderController::index');
$routes->get('timeline/table', 'TimelineController::table');

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
    $routes->post('delete/(:num)', 'PengajuanJudulController::delete/$1');
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

$routes->get('revisiproposal/create/(:num)', 'RevisiProposalController::create/$1');
$routes->post('revisiproposal/store', 'RevisiProposalController::store');
$routes->get('revisisemhas/create/(:num)', 'RevisiSemhasController::create/$1');
$routes->post('revisisemhas/store', 'RevisiSemhasController::store');
$routes->get('revisisidang/create/(:num)', 'RevisiSidangController::create/$1');
$routes->post('revisisidang/store', 'RevisiSidangController::store');

$routes->post('pengajuanjudul/update_status/(:num)', 'PengajuanJudulController::updateStatus/$1');
$routes->get('pengajuanjudul/ubah-status/(:num)', 'PengajuanJudulController::editStatus/$1');
$routes->post('update/status/(:num)', 'PengajuanBimbinganController::updateStatus/$1');
$routes->post('update/tracking/(:num)', 'PengajuanBimbinganController::updateTracking/$1');
$routes->post('upload/jadwal/(:num)', 'PengajuanUjianProposalController::uploadJadwal/$1');
$routes->post('update/bimbingan/(:num)', 'PengajuanBimbinganController::updateBimbingan/$1');

$routes->post('update/status_up/(:num)', 'PengajuanUjianProposalController::updateStatus/$1');
$routes->post('update/status_proposal/(:num)', 'PengajuanUjianProposalController::updateStatusProposal/$1');
$routes->post('upload/revisi/(:num)', 'PengajuanUjianProposalController::uploadRevisi/$1');
$routes->post('update/status_up/semhas/(:num)', 'PengajuanSeminarHasilController::updateStatus/$1');
$routes->post('update/status_laporan/semhas/(:num)', 'PengajuanSeminarHasilController::updateStatusLaporan/$1');
$routes->post('upload/revisi/semhas/(:num)', 'PengajuanSeminarHasilController::uploadRevisi/$1');
$routes->post('update/status_up/sidang/(:num)', 'PengajuanSidangController::updateStatus/$1');
$routes->post('update/status_laporan/sidang/(:num)', 'PengajuanSidangController::updateStatusLaporan/$1');
$routes->post('upload/revisi/sidang/(:num)', 'PengajuanSidangController::uploadRevisi/$1');
$routes->post('upload/surat-undangan/(:num)', 'JadwalSidangController::uploadSuratUndangan/$1');
$routes->post('upload/surat-tugas/(:num)', 'JadwalSidangController::uploadSuratTugas/$1');

$routes->get('rekapitulasi-nilai', 'RekapitulasiController::index');
$routes->get('rekapitulasi-nilai/cetak/(:num)', 'RekapitulasiController::cetak/$1');



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
    $routes->get('create-jadwal/(:num)', 'PengajuanUjianProposalController::createJadwal/$1');
    // $routes->get('penilaian-proposal', 'PenilaianProposal::penilaian');
});

//RILIS JADWAL
$routes->group('rilisjadwal', static function ($routes) {
    $routes->get('/', 'JadwalUjianPropoController::table');
    // $routes->get('create/(:num)', 'JadwalUjianPropoController::create/$1');
    $routes->post('store', 'JadwalUjianPropoController::store');
    $routes->get('edit/(:segment)', 'JadwalUjianPropoController::edit/$1');
    $routes->post('update/(:segment)', 'JadwalUjianPropoController::update/$1');
    $routes->post('delete/(:num)', 'JadwalUjianPropoController::delete/$1');
    $routes->get('berita-acara/(:num)', 'JadwalUjianPropoController::beritaacara/$1');
});

//RILIS JADWAL SEMINAR HASIL
$routes->group('rilisjadwalsemhas', static function ($routes) {
    $routes->get('/', 'JadwalSemhasController::table');
    // $routes->get('create', 'JadwalSemhasController::create');
    $routes->post('store', 'JadwalSemhasController::store');
    $routes->get('edit/(:segment)', 'JadwalSemhasController::edit/$1');
    $routes->post('update/(:segment)', 'JadwalSemhasController::update/$1');
    $routes->post('delete/(:num)', 'JadwalSemhasController::delete/$1');
    $routes->get('berita-acara/(:num)', 'JadwalSemhasController::beritaacara/$1');
    $routes->get('lembar-persetujuan/(:num)', 'JadwalSemhasController::persetujuan/$1');
});

//RILIS JADWAL SIDANG
$routes->group('rilisjadwalsidang', static function ($routes) {
    $routes->get('/', 'JadwalSidangController::table');
    // $routes->get('create', 'JadwalSidangController::create');
    $routes->post('store', 'JadwalSidangController::store');
    $routes->get('edit/(:segment)', 'JadwalSidangController::edit/$1');
    $routes->post('update/(:segment)', 'JadwalSidangController::update/$1');
    $routes->post('delete/(:num)', 'JadwalSidangController::delete/$1');
    $routes->get('berita-acara/(:num)', 'JadwalSidangController::beritaacara/$1');
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
    $routes->get('/', 'StafController::table');
    $routes->get('create', 'StafController::create');
    $routes->post('store', 'StafController::store');
    $routes->get('edit/(:num)', 'StafController::edit/$1');
    $routes->post('update/(:segment)', 'StafController::update/$1');
    $routes->post('delete/(:segment)', 'StafController::delete/$1');
});

//DATA MASTER MAHASISWA
$routes->group('mastermahasiswa', static function ($routes) {
    $routes->get('/', 'MahasiswaController::table');
    $routes->get('create', 'MahasiswaController::create');
    $routes->post('store', 'MahasiswaController::store');
    $routes->get('edit/(:num)', 'MahasiswaController::edit/$1');
    $routes->post('update/(:segment)', 'MahasiswaController::update/$1');
    $routes->post('delete/(:segment)', 'MahasiswaController::delete/$1');
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

//PENILAIAN PROPOSAL
$routes->group('penilaianproposal', static function ($routes) {
    $routes->get('/', 'PenilaianProposalController::table');
    $routes->get('create/(:num)', 'PenilaianProposalController::create/$1');
    $routes->post('store', 'PenilaianProposalController::store');
    $routes->get('edit/(:num)', 'PenilaianProposalController::edit/$1');
    $routes->get('pdf/(:num)', 'PenilaianProposalController::penilaian/$1');
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
    $routes->get('unduh-revisi/(:num)', 'PengajuanSeminarHasilController::unduhRevisi/$1');
    $routes->get('create-jadwal/(:num)', 'PengajuanSeminarHasilController::createJadwal/$1');
    $routes->get('rekomendasi/(:num)', 'PengajuanSeminarHasilController::rekomendasi/$1');
}); 

//PENGAJUAN SIDANG
$routes->group('pengajuansidang', static function ($routes) {
    $routes->get('/', 'PengajuanSidangController::table');
    $routes->get('create', 'PengajuanSidangController::create');
    $routes->post('store', 'PengajuanSidangController::store');
    $routes->get('edit/(:segment)', 'PengajuanSidangController::edit/$1');
    $routes->post('update/(:segment)', 'PengajuanSidangController::update/$1');
    $routes->get('delete/(:num)', 'PengajuanSidangController::delete/$1');
    $routes->get('unduh-revisi/(:num)', 'PengajuanSidangController::unduhRevisi/$1');
    $routes->get('create-jadwal/(:num)', 'PengajuanSidangController::createJadwal/$1');
});  

//MAHASISWA BIMBINGAN
$routes->group('mahasiswabimbingan', static function ($routes) {
    $routes->get('/', 'MahasiswaBimbinganController::table');
    $routes->get('create', 'MahasiswaBimbinganController::create');
    $routes->post('store', 'MahasiswaBimbinganController::store');
    $routes->get('edit/(:segment)', 'MahasiswaBimbinganController::edit/$1');
    $routes->post('update/(:segment)', 'MahasiswaBimbinganController::update/$1');
    $routes->get('delete/(:num)', 'MahasiswaBimbinganController::delete/$1');
}); 

//TRACKING
$routes->group('tracking', static function ($routes) {
    $routes->get('/', 'TrackingController::table');
});


//UNGGAH SYARAT KELULUSAN
$routes->group('syaratkelulusan', static function ($routes) {
    $routes->get('/', 'SyaratKelulusanController::get_data');
    $routes->get('create', 'SyaratKelulusanController::create');
    $routes->post('store', 'SyaratKelulusanController::store');
    $routes->get('edit/(:segment)', 'SyaratKelulusanController::edit/$1');
    $routes->post('update/(:num)', 'SyaratKelulusanController::update/$1');
    // $routes->post('update/status/(:num)', 'PengajuanBimbinganController::updateStatus/$1');
    $routes->get('delete/(:num)', 'SyaratKelulusanController::delete/$1');
    $routes->get('data', 'SyaratKelulusanController::get_data');
    $routes->post('updateValidationStatus/(:num)', 'SyaratKelulusanController::updateValidationStatus/$1');
});

//KRITERIA SEMHAS
$routes->group('kriteria_semhas', static function ($routes) {
    $routes->get('/', 'KriteriaSemhasController::table');
    $routes->get('create', 'KriteriaSemhasController::create');
    $routes->post('store', 'KriteriaSemhasController::store');
    $routes->get('edit/(:num)', 'KriteriaSemhasController::edit/$1');
    $routes->post('update/(:num)', 'KriteriaSemhasController::update/$1');
    // $routes->get('delete/(:num)', 'KriteriaSemhasController::delete/$1');
    $routes->post('delete/(:num)', 'KriteriaSemhasController::delete/$1');

});

//INDIKATOR SEMHAS
$routes->group('indikator_semhas', static function ($routes) {
    $routes->get('/', 'IndikatorSemhasController::table');
    $routes->get('create', 'IndikatorSemhasController::create');
    $routes->post('store', 'IndikatorSemhasController::store');
    $routes->get('edit/(:num)', 'IndikatorSemhasController::edit/$1');
    $routes->post('update/(:num)', 'IndikatorSemhasController::update/$1');
    // $routes->get('delete/(:num)', 'IndikatorSemhasController::delete/$1');
    $routes->post('delete/(:num)', 'IndikatorSemhasController::delete/$1');
});

//PENILAIAN SEMHAS
$routes->group('penilaiansemhas', static function ($routes) {
    $routes->get('/', 'PenilaianSemhasController::table');
    $routes->get('create/(:num)', 'PenilaianSemhasController::create/$1');
    $routes->post('store', 'PenilaianSemhasController::store');
    $routes->get('edit/(:num)', 'PenilaianSemhasController::edit/$1');
    $routes->get('pdf/(:num)', 'PenilaianSemhasController::penilaian/$1');
    $routes->post('update', 'PenilaianSemhasController::update');
    $routes->post('delete/(:num)', 'PenilaianSemhasController::delete/$1');
});

//KRITERIA SIDANG
$routes->group('kriteria_sidang', static function ($routes) {
    $routes->get('/', 'KriteriaSidangController::table');
    $routes->get('create', 'KriteriaSidangController::create');
    $routes->post('store', 'KriteriaSidangController::store');
    $routes->get('edit/(:num)', 'KriteriaSidangController::edit/$1');
    $routes->post('update/(:num)', 'KriteriaSidangController::update/$1');
    // $routes->get('delete/(:num)', 'KriteriaSidangController::delete/$1');
    $routes->post('delete/(:num)', 'KriteriaSidangController::delete/$1');

});

//INDIKATOR SIDANG
$routes->group('indikator_sidang', static function ($routes) {
    $routes->get('/', 'IndikatorSidangController::table');
    $routes->get('create', 'IndikatorSidangController::create');
    $routes->post('store', 'IndikatorSidangController::store');
    $routes->get('edit/(:num)', 'IndikatorSidangController::edit/$1');
    $routes->post('update/(:num)', 'IndikatorSidangController::update/$1');
    // $routes->get('delete/(:num)', 'IndikatorSidangController::delete/$1');
    $routes->post('delete/(:num)', 'IndikatorSidangController::delete/$1');
});

//PENILAIAN SIDANG
$routes->group('penilaiansidang', static function ($routes) {
    $routes->get('/', 'PenilaianSidangController::table');
    $routes->get('create/(:num)', 'PenilaianSidangController::create/$1');
    $routes->post('store', 'PenilaianSidangController::store');
    $routes->get('edit/(:num)', 'PenilaianSidangController::edit/$1');
    $routes->get('pdf/(:num)', 'PenilaianSidangController::penilaian/$1');
    $routes->post('update', 'PenilaianSidangController::update');
    $routes->post('delete/(:num)', 'PenilaianSidangController::delete/$1');
});

//PROFILE
$routes->group('profile', static function ($routes) {
    $routes->get('/', 'ProfileController::index');
    $routes->get('edit', 'ProfileController::edit');
    $routes->post('update', 'ProfileController::update');
});


$routes->group('jadwalbimbingan', function($routes) {
    $routes->get('/', 'JadwalBimbinganController::index');
    $routes->get('create', 'JadwalBimbinganController::create');
    $routes->post('store', 'JadwalBimbinganController::store');
    $routes->get('edit/(:num)', 'JadwalBimbinganController::edit/$1');
    $routes->post('update/(:num)', 'JadwalBimbinganController::update/$1');
    $routes->post('delete/(:num)', 'JadwalBimbinganController::delete/$1');
});

$routes->group('logbook', function($routes) {
    $routes->get('/', 'LogbookController::index');
    $routes->get('show/(:num)', 'LogbookController::show/$1');
    $routes->get('create', 'LogbookController::create');
    $routes->post('store', 'LogbookController::store');
    $routes->get('edit/(:num)', 'LogbookController::edit/$1');
    $routes->post('update/(:num)', 'LogbookController::update/$1');
    $routes->post('delete/(:num)', 'LogbookController::delete/$1');
});
$routes->get('logbook/view/(:num)', 'LogbookController::view/$1');