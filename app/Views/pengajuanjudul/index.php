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
                <h2 class="mb-1">Pengajuan Judul</h2>
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
                    <a class="nav-link text-active-primary me-6 active" href="<?= base_url('pengajuanjudul') ?>">Pengajuan Judul</a>
                </li>
                <!--end::Nav item-->
                <!--begin::Nav item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" href="<?= base_url('judulacc')?>">Judul yang Diterima</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" href="<?= base_url('pengajuanbimbingan')?>">Pengajuan Bimbingan</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" href="<?= base_url('pengajuanujianproposal')?>">Pengajuan Ujian Proposal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" href="<?= base_url('rilisjadwal')?>">Jadwal Ujian Proposal</a>
                </li>
                <?php if(session()->get('role') == 'Dosen' || session()->get('role') == 'Koordinator' || session()->get('nama') == 'Masbahah '): ?>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" href="<?= base_url('penilaianproposal')?>">Penilaian Ujian Proposal</a>
                </li>
                <?php endif; ?>
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
                <input type="text" data-kt-subscription-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Cari Pengajuan Judul" />
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
                    <form action="/pengajuanjudul" method="get" class="d-flex align-items-center position-relative my-1 mt-3" id="myForm" role="form">
                        <select id="tahun_filter" name="tahun" class="form-select form-select-sm form-select-solid w-125px" data-control="select2" data-placeholder="Select Tahun" data-hide-search="true">
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
                <!--begin::Add subscription-->
                <?php if (session()->get('role') == 'Mahasiswa' && !$mahasiswaSudahMengajukan): ?>
                    <a href="<?= base_url('pengajuanjudul/create') ?>" class="btn btn-sm btn-primary my-4">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                        </svg>
                    </span>Pengajuan</a>
                <?php endif; ?>
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
    <?php if (!empty($pengajuan) && is_array($pengajuan)) : ?>
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9" width="100%">
                    <!--begin::Thead-->
                    <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                        <tr>
                            <th width="25%" class="min-w-150px">Nama</th>
                            <th width="25%" class="min-w-150px ps-5">Judul</th>
                            <!-- <th width="15%" class="min-w-150px text-center">Status</th> -->
                            <th width="25%" class="min-w-150px ps-5">Dospem</th>
                            <th width="25%" class="min-w-150px ps-5"></th>
                        </tr>
                    </thead>
                    <!--end::Thead-->
                    <!--begin::Tbody-->
                    <tbody class="fw-6 fw-bold text-gray-600">
                        <?php foreach ($pengajuan as $item) : ?>
                            <?php 
                                if ($item['status_pj'] == 'DIAJUKAN') {
                                    $warna = 'dark';
                                } elseif ($item['status_pj'] == 'DISETUJUI') {
                                    $warna = 'success';
                                } elseif ($item['status_pj'] == 'DITOLAK') {
                                    $warna = 'danger';
                                } else {
                                    $warna = 'primary';
                                }
                            ?>
                            <tr>
                                <td>
                                    <span class="fw-bolder d-block fs-6"><?= ucwords($item['mahasiswa_nama']) ?></span>
                                    <!-- <span class="text-dark fw-bold text-hover-primary mb-1 fs-6"><?= $item['mahasiswa_nama'] ?></span> -->
                                    <!-- <span class="text-muted fw-bold text-muted d-block fs-7">NIM</span> -->
                                </td>
                                <td class="ps-5">
                                    <p>1. <?= $item['nama_judul1'] ?></p>
                                    <p>2. <?= $item['nama_judul2'] ?></p>
                                    <p>3. <?= $item['nama_judul3'] ?></p>
                                    <!-- <span class="badge badge-light-success fs-7 fw-bolder">OK</span> -->
                                </td>
                                <!-- <td class="text-center">
                                    <span class="badge badge-light-<?= $warna; ?> fs-7 fw-bolder"><?= $item['status_pj']; ?></span>
                                </td> -->
                                <td class="ps-5">
                                    <p>1. <?= $item['dospem1_nama'] ?></p>
                                    <p>2. <?= $item['dospem2_nama'] ?></p>
                                </td>
                                <td class="align-middle ps-5">
                                    <div class="d-flex justify-content-center">
                                        <a href="#" class="btn btn-icon btn-light-info btn-active-color-light btn-sm me-1" data-bs-toggle="modal" data-bs-target="#detailPengajuanJudul<?= $item['id_pengajuanjudul']; ?>">
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M15 12c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3zm9-.449s-4.252 8.449-11.985 8.449c-7.18 0-12.015-8.449-12.015-8.449s4.446-7.551 12.015-7.551c7.694 0 11.985 7.551 11.985 7.551zm-7 .449c0-2.757-2.243-5-5-5s-5 2.243-5 5 2.243 5 5 5 5-2.243 5-5z" fill="black"/></svg>
                                            </span>
                                        </a>
                                        <?php if(session()->get('role') == 'Koordinator' || session()->get('nama') == 'Masbahah '): ?>
                                            <a href="<?= base_url('judulacc/create/' . $item['id_pengajuanjudul']) ?>" class="btn btn-icon btn-light-primary btn-active-color-light btn-sm me-1">
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                                    </svg>
                                                </span>
                                            </a>
                                        <?php endif; ?>
                                        <form action="<?= base_url('pengajuanjudul/delete/' . $item['id_pengajuanjudul']) ?>" method="post">
                                            <?php csrf_field() ?>
                                            <button type="submit" class="btn btn-icon btn-light-danger btn-active-color-light btn-sm">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                                        <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
                                                        <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </button>
                                        </form>
                                    </div> 
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
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
                <h2 class="fs-2x fw-bolder mb-0"><?= session()->get('role') == 'Mahasiswa' ? 'Ajukan Pengajuan Judul' : 'Pengajuan Judul' ?></h2>
                <!--end::Title-->
                <!--begin::Description-->
                <p class="text-gray-400 fs-4 fw-bold py-7"><?= session()->get('role') == 'Mahasiswa' ? 'Klik tombol dibawah untuk menambahkan' : 'Belum ada data' ?>
                <br />Pengajuan Judul.</p>
                <!--end::Description-->
                <!--begin::Action-->
                <?php if(session()->get('role') == 'Mahasiswa'): ?>
                    <a href="<?= base_url('pengajuanjudul/create') ?>" class="btn btn-primary er fs-6 px-8 py-4" >Tambah Pengajuan Judul</a>
                <?php endif; ?>
                <!--end::Action-->
            </div>
            <!--end::Heading-->
            <!--begin::Illustration-->
            <div class="text-center px-5">
                <img src="<?= base_url('assets/media/illustrations/sketchy-1/17.png') ?>" alt="" class="mw-100 h-200px h-sm-325px" />
            </div>
        </div>
    <?php endif; ?>
</div>

<?php foreach ($pengajuan as $item) : ?>
<div class="modal fade" id="detailPengajuanJudul<?= $item['id_pengajuanjudul']; ?>" tabindex="-1" aria-hidden="true">
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
                    <h1 class="mb-3">Detail Pengajuan Judul</h1>
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
                                        <th width="40%" class="fs-6 fw-bolder">Nama</th>
                                        <td width="60%">
                                            <span class="text-dark fs-6"><?= ucwords($item['mahasiswa_nama']) ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="fs-6 fw-bolder">Judul 1</th>
                                        <td>
                                            <p class="fw-bolder text-dark fs-6"><?= $item['nama_judul1'] ?></p>
                                            <p class="text-dark fs-6"><?= $item['deskripsi_sistem1'] ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="fs-6 fw-bolder">Judul 2</th>
                                        <td>
                                            <p class="fw-bolder text-dark fs-6"><?= $item['nama_judul2'] ?></p>
                                            <p class="text-dark fs-6"><?= $item['deskripsi_sistem2'] ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="fs-6 fw-bolder">Judul 3</th>
                                        <td>
                                            <p class="fw-bolder text-dark fs-6"><?= $item['nama_judul3'] ?></p>
                                            <p class="text-dark fs-6"><?= $item['deskripsi_sistem3'] ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="fs-6 fw-bolder">Dosen Pembimbing 1</th>
                                        <td class="text-dark fs-6"><?= $item['dospem1_nama'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="fs-6 fw-bolder">Dosen Pembimbing 2</th>
                                        <td class="text-dark fs-6"><?= $item['dospem2_nama'] ?></td>
                                    </tr>
                                    <!-- <tr>
                                        <th class="fs-6 fw-bolder">Status Pengajuan</th>
                                        <td>
                                            <span class="badge badge-light-<?= $warna; ?> fs-7 fw-bolder"><?= $item['status_pj']; ?></span>
                                        </td>
                                    </tr> -->
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
<?= $this->endSection() ?>