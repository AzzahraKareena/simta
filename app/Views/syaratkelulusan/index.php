<?= $this->extend('layouts\main') ?>

<?= $this->section('content') ?>
<div class="card card-flush pb-0 bgi-position-y-top bgi-no-repeat mb-10" style="background-size: auto calc(50% + 5rem); background-position-x: 100%; background-image: url('assets/media/illustrations/sketchy-1/4.png')">
    <!--begin::Card header-->
    <div class="card-header pt-10">
        <div class="d-flex align-items-center">
            <!--begin::Icon-->
            <div class="symbol symbol-circle me-5">
                <div class="symbol-label bg-transparent text-primary border border-secondary border-dashed">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs020.svg-->
                    <span class="svg-icon svg-icon-2x svg-icon-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M17.302 11.35L12.002 20.55H21.202C21.802 20.55 22.202 19.85 21.902 19.35L17.302 11.35Z" fill="black" />
                            <path opacity="0.3" d="M12.002 20.55H2.802C2.202 20.55 1.80202 19.85 2.10202 19.35L6.70203 11.45L12.002 20.55ZM11.302 3.45L6.70203 11.35H17.302L12.702 3.45C12.402 2.85 11.602 2.85 11.302 3.45Z" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
            </div>
            <!--end::Icon-->
            <!--begin::Title-->
            <div class="d-flex flex-column">
                <h2 class="mb-1">Unggah SYarat Kelulusan</h2>
                <!-- <div class="text-muted fw-bolder">
                <a href="#">Keenthemes</a>
                <span class="mx-3">|</span>
                <a href="#">File Manager</a>
                <span class="mx-3">|</span>2.6 GB
                <span class="mx-3">|</span>758 items</div> -->
            </div>
            <!--end::Title-->
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pb-0">
        <!--begin::Navs-->
        <div class="d-flex overflow-auto h-55px">
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-6 fw-bold flex-nowrap">
                <!--begin::Nav item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" href="<?= base_url('pengajuanbimbingan') ?>">Pengajuan Bimbingan</a>
                </li>
                <!--end::Nav item-->
                <!--begin::Nav item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" href="<?= base_url('pengajuansidang') ?>">Pengajuan Sidang Tugas Akhir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" href="<?= base_url('rilisjadwalsidang') ?>">Jadwal Sidang Tugas Akhir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" href="<?= base_url('penilaiansidang') ?>">Penilaian Sidang Akhir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 active" href="<?= base_url('syaratkelulusan') ?>">Unggah Syarat Kelulusan</a>
                </li>
                <!--end::Nav item-->
            </ul>
        </div>
        <!--begin::Navs-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
<!--begin::Card-->
<div class="card card-flush">
    <!--begin::Card header-->
    <!-- <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bolder fs-3 mb-1">New Arrivals</span>
            <span class="text-muted mt-1 fw-bold fs-7">Over 500 new products</span>
        </h3>
        <div class="card-toolbar">
            <a href="#" class="btn btn-sm btn-light-primary">
            <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                    <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                </svg>
            </span>New Member</a>
        </div>
    </div> -->
    <!--end::Header-->
    <?php if (!empty($data) && is_array($data)) : ?>
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input type="text" data-kt-subscription-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Cari Syarat Kelulusan" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-subscription-table-toolbar="base">
                    <!--begin::Filter-->
                    <div class="my-1 me-4">
                        <!--begin::Select-->
                        <form action="/pengajuansidang" method="get" class="d-flex align-items-center position-relative my-1 mt-3" id="myForm" role="form">
                            <select id="tahun_filter" name="tahun" class="form-select form-select-sm form-select-solid w-125px" data-control="select2" data-placeholder="Select Tahun" data-hide-search="true">
                                <!-- <option value="1" selected="selected">1 Hours</option>
                                <option value="2">6 Hours</option>
                                <option value="3">12 Hours</option>
                                <option value="4">24 Hours</option> -->
                                <?php
                                    $thn_skr = date('Y');
                                    for ($x = $thn_skr; $x >= 2020; $x--) {
                                    ?>
                                    <option value="<?= $x; ?>" <?= ($x == $tahun) ? 'selected' : ''; ?>><?= $x; ?></option>
                                    <?php
                                    }
                                ?>
                            </select>
                        </form>
                        <!--end::Select-->
                    </div>
                    <!--end::Filter-->
                    
                    <!--end::Add subscription-->
                </div>
                <!--end::Toolbar-->
                <!--begin::Group actions-->
                <div class="d-flex justify-content-end align-items-center d-none" data-kt-subscription-table-toolbar="selected">
                    <div class="fw-bolder me-5">
                    <span class="me-2" data-kt-subscription-table-select="selected_count"></span>Selected</div>
                    <button type="button" class="btn btn-danger" data-kt-subscription-table-select="delete_selected">Delete Selected</button>
                </div>
                <!--end::Group actions-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9" width="100%">
                    <!--begin::Thead-->
                    <?php if(session()->get('role') == 'Mahasiswa'): ?>
                        <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                            <tr>
                                <th width="25%" class="min-w-175px text-center">Nama Mahasiswa</th>
                                <th width="22%" class="min-w-150px text-center">NIM</th>
                                <!-- <th width="15%" class="min-w-150px text-center">Poster</th>
                                <th width="22%" class="min-w-150px text-center">Lembar Pengesahan</th>
                                <th width="22%" class="min-w-150px text-center">Lembar Persetujuan</th>
                                <th width="22%" class="min-w-150px text-center">Bukti Pelunasan UKT</th>
                                <th width="22%" class="min-w-150px text-center">Surat Bebas Lab</th>
                                <th width="22%" class="min-w-150px text-center">Aplikasi TA</th>
                                <th width="23%"class="min-w-150px text-center">Laporan TA (PDF)</th>
                                <th width="23%"class="min-w-150px text-center">KTP</th> -->
                                <th width="23%"class="min-w-150px text-center">Status Syarat</th>
                                <th width="15%" class="min-w-150px text-center">#</th>
                            </tr>
                        </thead>
                        <!--end::Thead-->
                        <!--begin::Tbody-->
                        <tbody class="fw-6 fw-bold text-gray-600">
                            <?php foreach ($data as $vdata) : ?>
                                <tr>
                                    <td class="text-dark fw-bolder"><?= $vdata['mahasiswa_nama']; ?></td>
                                    <td class="text-dark fw-bolder"><?= $vdata['nim']; ?></td>
                                    <!-- <td>
                                        <?php if (!empty($vdata['poster'])): ?>
                                            <div>
                                                <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['poster']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['poster'] ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($vdata['lembar_pengesahan'])): ?>
                                            <div>
                                                <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['lembar_pengesahan']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['lembar_pengesahan'] ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                    <?php if (!empty($vdata['lembar_persetujuan'])): ?>
                                            <div>
                                                <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['lembar_persetujuan']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['lembar_persetujuan'] ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($vdata['bukti_pelunasan_ukt'])): ?>
                                            <div>
                                                <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['bukti_pelunasan_ukt']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['bukti_pelunasan_ukt'] ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($vdata['surat_bebas_lab'])): ?>
                                            <div>
                                                <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['surat_bebas_lab']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['surat_bebas_lab'] ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($vdata['aplikasi_ta'])): ?>
                                            <div>
                                                <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['aplikasi_ta']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['aplikasi_ta'] ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($vdata['laporan_ta_pdf'])): ?>
                                            <div>
                                                <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['laporan_ta_pdf']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['laporan_ta_pdf'] ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['ktp']) ?>" target="_blank">
                                                <?php if (!empty($vdata['ktp'])): ?>
                                                    <span class="text-dark text-center fw-bolder text-hover-primary d-block fs-6"><?= $vdata['ktp'] ?></span>
                                                <?php else: ?>
                                                    <span class="text-dark text-center fw-bolder text-hover-primary d-block fs-6">-</span>
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                    </td> -->
                                    <td>
                                        <?php if ($vdata['status_syarat'] == 'Sedang Diproses') : ?>
                                            <div class="badge badge-warning"><?= $vdata['status_syarat'] ?></div>
                                        <?php elseif ($vdata['status_syarat'] == 'Validasi') : ?>
                                            <div class="badge badge-success"><?= $vdata['status_syarat'] ?></div>
                                        <?php else : ?>
                                            <div class="badge badge-success"><?= $vdata['status_syarat'] ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-icon btn-light-info btn-active-color-light btn-sm me-1" data-bs-toggle="modal" data-bs-target="#detailSyaratKelulusan<?= $vdata['id_syarat_kelulusan'] ?>">
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M15 12c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3zm9-.449s-4.252 8.449-11.985 8.449c-7.18 0-12.015-8.449-12.015-8.449s4.446-7.551 12.015-7.551c7.694 0 11.985 7.551 11.985 7.551zm-7 .449c0-2.757-2.243-5-5-5s-5 2.243-5 5 2.243 5 5 5 5-2.243 5-5z" fill="black"/>
                                                </svg>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    <?php elseif(session()->get('role') == 'Admin'): ?>
                        <thead>
                            <tr class="fw-bolder text-muted">
                                <th width="25%" class="min-w-175px text-center">Nama Mahasiswa</th>
                                <th width="22%" class="min-w-150px text-center">NIM</th>
                                <!-- <th width="15%" class="min-w-150px text-center">Poster</th>
                                <th width="22%" class="min-w-150px text-center">Lembar Pengesahan</th>
                                <th width="22%" class="min-w-150px text-center">Lembar Persetujuan</th>
                                <th width="22%" class="min-w-150px text-center">Bukti Pelunasan UKT</th>
                                <th width="22%" class="min-w-150px text-center">Surat Bebas Lab</th>
                                <th width="22%" class="min-w-150px text-center">Aplikasi TA</th>
                                <th width="23%"class="min-w-150px text-center">Laporan TA (PDF)</th>
                                <th width="23%"class="min-w-150px text-center">KTP</th> -->
                                <th width="23%"class="min-w-150px text-center">Status Syarat</th>
                                <th width="15%" class="min-w-150px text-center">#</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <?php foreach ($data as $vdata): ?>
                                <tr>
                                    <td class="text-dark fw-bolder"><?= $vdata['mahasiswa_nama']; ?></td>
                                    <td class="text-dark fw-bolder"><?= $vdata['nim']; ?></td>
                                    <!-- <td>
                                        <?php if (!empty($vdata['poster'])): ?>
                                            <div>
                                                <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['poster']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['poster'] ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($vdata['lembar_pengesahan'])): ?>
                                            <div>
                                                <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['lembar_pengesahan']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['lembar_pengesahan'] ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                    <?php if (!empty($vdata['lembar_persetujuan'])): ?>
                                            <div>
                                                <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['lembar_persetujuan']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['lembar_persetujuan'] ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($vdata['bukti_pelunasan_ukt'])): ?>
                                            <div>
                                                <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['bukti_pelunasan_ukt']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['bukti_pelunasan_ukt'] ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($vdata['surat_bebas_lab'])): ?>
                                            <div>
                                                <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['surat_bebas_lab']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['surat_bebas_lab'] ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($vdata['aplikasi_ta'])): ?>
                                            <div>
                                                <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['aplikasi_ta']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['aplikasi_ta'] ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($vdata['laporan_ta_pdf'])): ?>
                                            <div>
                                                <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['laporan_ta_pdf']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['laporan_ta_pdf'] ?></span>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="">
                                        <div>
                                            <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['ktp']) ?>" target="_blank">
                                                <?php if (!empty($vdata['ktp'])): ?>
                                                    <span class="text-dark text-center fw-bolder text-hover-primary d-block fs-6"><?= $vdata['ktp'] ?></span>
                                                <?php else: ?>
                                                    <span class="text-dark text-center fw-bolder text-hover-primary d-block fs-6">-</span>
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                    </td> -->
                                    <td>
                                        <select name="status" id="status_validasi" onchange="updateValidationStatus(<?= $vdata['id_syarat_kelulusan'] ?>, this.value)">
                                            <option value="Sedang Diproses" <?= ($vdata['status_syarat'] == 'Sedang Diproses') ? 'selected' : '' ?> class="btn-warning">Sedang Diproses</option>
                                            <option value="Validasi" <?= ($vdata['status_syarat'] == 'Validasi') ? 'selected' : '' ?> class="btn-success">Validasi</option>
                                        </select>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-icon btn-light-info btn-active-color-light btn-sm me-1" data-bs-toggle="modal" data-bs-target="#detailSyaratKelulusan<?= $vdata['id_syarat_kelulusan'] ?>">
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M15 12c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3zm9-.449s-4.252 8.449-11.985 8.449c-7.18 0-12.015-8.449-12.015-8.449s4.446-7.551 12.015-7.551c7.694 0 11.985 7.551 11.985 7.551zm-7 .449c0-2.757-2.243-5-5-5s-5 2.243-5 5 2.243 5 5 5 5-2.243 5-5z" fill="black"/>
                                                </svg>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>`
                    <?php endif; ?>
                    <!--end::Tbody-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
    <?php else : ?>
        <div class="card-body pb-0">
            <!--begin::Heading-->
            <div class="card-px text-center pt-20 pb-5">
                <!--begin::Title-->
                <h2 class="fs-2x fw-bolder mb-0">Ajukan Syarat Kelulusan</h2>
                <!--end::Title-->
                <!--begin::Description-->
                <p class="text-gray-400 fs-4 fw-bold py-7">Klik tombol dibawah untuk menambahkan
                <br />Pengajuan Syarat Kelulusan.</p>
                <!--end::Description-->
                <!--begin::Action-->
                <a href="<?= base_url('syaratkelulusan/create') ?>" class="btn btn-primary er fs-6 px-8 py-4" >Tambah Syarat</a>
                <!--end::Action-->
            </div>
            <!--end::Heading-->
            <!--begin::Illustration-->
            <div class="text-center px-5">
                <img src="<?= base_url('assets/media/illustrations/sketchy-1/17.png') ?>" alt="" class="mw-100 h-200px h-sm-325px" />
            </div>
            <!--end::Illustration-->
        </div>
    <?php endif; ?>
</div>

<?php foreach ($data as $vdata) : ?>
    <div class="modal fade" id="detailSyaratKelulusan<?= $vdata['id_syarat_kelulusan'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-650px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                    <!--begin::Heading-->
                    <div class="text-center mb-13">
                        <!--begin::Title-->
                        <h1 class="mb-3">Detail Syarat Kelulusan</h1>
                    </div>
                    <!--end::Heading-->
                    <!--begin::Users-->
                    <div class="mb-15">
                        <!--begin::List-->
                        <div class="mh-375px scroll-y me-n7 pe-7">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table table-flush align-middle table-row-bordered table-row-solid gy-3 gs-2" width="100%">
                                    <tbody>
                                        <tr>
                                            <th width="40%" class="fs-6 fw-bolder">Poster</th>
                                            <td width="60%">
                                                <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['poster']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['poster'] ?></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fs-6 fw-bolder">Lembar Pengesahan</th>
                                            <td>
                                            <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['lembar_pengesahan']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['lembar_pengesahan'] ?></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fs-6 fw-bolder">Lembar Persetujuan</th>
                                            <td>
                                                <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['lembar_persetujuan']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['lembar_persetujuan'] ?></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fs-6 fw-bolder">Bukti Pelunasan UKT</th>
                                            <td>
                                                <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['bukti_pelunasan_ukt']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['bukti_pelunasan_ukt'] ?></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fs-6 fw-bolder">Surat Bebas Lab</th>
                                            <td class="text-dark fs-6">
                                                <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['surat_bebas_lab']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['surat_bebas_lab'] ?></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fs-6 fw-bolder">Aplikasi TA</th>
                                            <td class="text-dark fs-6">
                                                <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['aplikasi_ta']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['aplikasi_ta'] ?></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fs-6 fw-bolder">Laporan TA (PDF)</th>
                                            <td class="text-dark fs-6">
                                                <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['laporan_ta_pdf']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['laporan_ta_pdf'] ?></span>
                                                </a>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <th class="fs-6 fw-bolder">KTP</th>
                                            <td class="text-dark fs-6">
                                                <a href="<?= base_url('public/assets/syarat-kelulusan/' . $vdata['ktp']) ?>" target="_blank">
                                                    <?php if (!empty($vdata['ktp'])): ?>
                                                        <span class="text-dark text-center fw-bolder text-hover-primary d-block fs-6"><?= $vdata['ktp'] ?></span>
                                                    <?php else: ?>
                                                        <span class="text-dark text-center fw-bolder text-hover-primary d-block fs-6">-</span>
                                                    <?php endif; ?>
                                                </a>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                    <!--end::Tbody-->
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::List-->
                    </div>
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
<?php endforeach; ?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('td[contenteditable=true]').on('blur', function() {
                var cell = $(this);
                var column = cell.index();
                var rowId = cell.closest('tr').find('.nilaiId').text();
                var value = cell.text();
                
                // Prepare data to send
                var data = {
                    column: column,
                    value: value,
                    rowId: rowId
                };

                // Send data to server
                $.ajax({
                    url: 'pengajuanbimbingan/update/' + rowId,
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        console.log('Data updated successfully:', response);
                        // You can provide feedback to the user here if needed
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating data:', error);
                        // Handle errors here
                    }
                });
            });
        });
    </script>
    <script>
    function updateValidationStatus(id, status) {
        $.ajax({
            url: '<?= base_url('syaratkelulusan/updateValidationStatus/') ?>' + id,
            type: 'POST',
            data: {
                status: status
            },
            success: function(response) {
                // Handle success response
                alert('Status validasi berhasil diperbarui.');
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    }
</script>
<?= $this->endSection() ?>