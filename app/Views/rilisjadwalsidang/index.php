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
                <h2 class="mb-1">Jadwal Sidang TA</h2>
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
                    <a class="nav-link text-active-primary me-6 active" href="<?= base_url('rilisjadwalsidang') ?>">Jadwal Sidang Tugas Akhir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" href="<?= base_url('penilaiansidang') ?>">Penilaian Sidang Akhir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" href="<?= base_url('syaratkelulusan') ?>">Unggah Syarat Kelulusan</a>
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
                    <input type="text" data-kt-subscription-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Cari Jadwal Sidang" />
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
                        <form action="/rilisjadwalsidang" method="get" class="d-flex align-items-center position-relative my-1 mt-3" id="myForm" role="form">
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
                    <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                        <tr>
                            <th width="25%" class="min-w-175px text-center">Nama Mahasiswa</th>
                            <th width="22%" class="min-w-150px text-center">NIM</th>
                            <th width="15%" class="min-w-150px text-center">Judul TA</th>
                            <th width="22%" class="min-w-150px text-center">Tanggal Ujian</th>
                            <th width="22%" class="min-w-150px text-center">Waktu</th>
                            <!-- <th width="22%" class="min-w-150px text-center">Penguji 1</th>
                            <th width="22%" class="min-w-150px text-center">Penguji 2</th>
                            <th width="22%" class="min-w-150px text-center">Penguji 3</th>
                            <?php if(session()->get('role') == 'Admin' || session()->get('role') == 'Mahasiswa') : ?>
                                <th width="22%" class="min-w-150px text-center">Surat Undangan</th>
                                <th width="22%" class="min-w-150px text-center">Surat Tugas</th>
                            <?php endif; ?> -->
                            <th width="15%" class="min-w-150px text-center">#</th>
                        </tr>
                    </thead>
                    <!--end::Thead-->
                    <!--begin::Tbody-->
                    <tbody class="fw-6 fw-bold text-gray-600">
                        <?php foreach ($data as $vdata) : ?>
                            
                            <tr>
                                <td><?= $vdata['nama_mhs'] ?></td>
                                <td><?= $vdata['nim'] ?></td>
                                <td><?= $vdata['judul'] ?></td>
                                <td><?= $vdata['tgl_ujian'] ?></td>
                                <td><?= $vdata['jam_start'] ?> - <?= $vdata['jam_end']; ?></td>
                                <!-- <td><?= $vdata['penguji1'] ?></td>
                                <td><?= $vdata['penguji2'] ?></td>
                                <td><?= $vdata['penguji3'] ?></td>
                                <?php if(session()->get('role') == 'Admin' || session()->get('role') == 'Mahasiswa') : ?>
                                <td class="text-center">
                                    <?php if($vdata['surat_undangan'] == null && session()->get('role') == 'Admin') : ?>
                                        <button onclick="uploadSuratUndangan(<?php echo $vdata['id_rilis_jadwal_sidang']; ?>)" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="tooltip" title="Upload Surat Undangan">
                                            <span class="svg-icon svg-icon-muted svg-icon-3">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.3" d="M11 13H7C6.4 13 6 12.6 6 12C6 11.4 6.4 11 7 11H11V13ZM17 11H13V13H17C17.6 13 18 12.6 18 12C18 11.4 17.6 11 17 11Z" fill="currentColor"/>
                                                    <path d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM17 11H13V7C13 6.4 12.6 6 12 6C11.4 6 11 6.4 11 7V11H7C6.4 11 6 11.4 6 12C6 12.6 6.4 13 7 13H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V13H17C17.6 13 18 12.6 18 12C18 11.4 17.6 11 17 11Z" fill="currentColor"/>
                                                </svg>
                                            </span>
                                        </button>
                                    <?php elseif($vdata['surat_undangan'] == null && session()->get('role') != 'Admin') : ?>
                                        -
                                    <?php else : ?>
                                        <a href="<?= base_url('public/assets/surat-undangan/'. $vdata['surat_undangan']) ?>" target="_blank" class="btn btn-sm btn-info">
                                            download
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if($vdata['surat_tugas'] == null && session()->get('role') == 'Admin') : ?>
                                        <button onclick="uploadSuratTugas(<?php echo $vdata['id_rilis_jadwal_sidang']; ?>)" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="tooltip" title="Upload Surat Tugas">
                                            <span class="svg-icon svg-icon-muted svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M11 13H7C6.4 13 6 12.6 6 12C6 11.4 6.4 11 7 11H11V13ZM17 11H13V13H17C17.6 13 18 12.6 18 12C18 11.4 17.6 11 17 11Z" fill="currentColor"/>
                                            <path d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM17 11H13V7C13 6.4 12.6 6 12 6C11.4 6 11 6.4 11 7V11H7C6.4 11 6 11.4 6 12C6 12.6 6.4 13 7 13H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V13H17C17.6 13 18 12.6 18 12C18 11.4 17.6 11 17 11Z" fill="currentColor"/>
                                            </svg>
                                            </span>
                                        </button>
                                    <?php elseif($vdata['surat_tugas'] == null && session()->get('role') != 'Admin') : ?>
                                        -
                                    <?php else : ?>
                                        <a href="<?= base_url('public/assets/surat-tugas/'. $vdata['surat_tugas']) ?>" target="_blank" class="btn btn-sm btn-info">
                                            download
                                        </a>
                                    <?php endif; ?>
                                </td> -->
                                <?php endif; ?>
                                <td>
                                    <div class="d-flex justify-content-end flex-shrink-0">
                                        <a href="<?= base_url('rilisjadwalsidang/berita-acara/'. $vdata['id_rilis_jadwal_sidang']) ?>" target="_blank" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="tooltip" title="Unduh Berita Acara">
                                            <span class="svg-icon svg-icon-muted svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z" fill="currentColor"/>
                                                <rect x="7" y="17" width="6" height="2" rx="1" fill="currentColor"/>
                                                <rect x="7" y="12" width="10" height="2" rx="1" fill="currentColor"/>
                                                <rect x="7" y="7" width="6" height="2" rx="1" fill="currentColor"/>
                                                <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/>
                                                </svg>
                                            </span>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-light-info btn-active-color-light btn-sm me-1" data-bs-toggle="modal" data-bs-target="#detailJadwalSidang<?= $vdata['id_rilis_jadwal_sidang'] ?>">
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M15 12c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3zm9-.449s-4.252 8.449-11.985 8.449c-7.18 0-12.015-8.449-12.015-8.449s4.446-7.551 12.015-7.551c7.694 0 11.985 7.551 11.985 7.551zm-7 .449c0-2.757-2.243-5-5-5s-5 2.243-5 5 2.243 5 5 5 5-2.243 5-5z" fill="black"/>
                                                </svg>
                                            </span>
                                        </a>
                                        <?php if(session()->get('role') == 'Dosen'): ?>
                                            <a href="<?= base_url('penilaiansidang/create/' . $vdata['id_rilis_jadwal_sidang']) ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="Penilian Sidang Akhir">
                                                <span class="svg-icon svg-icon-muted svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M14 18V16H10V18L9 20H15L14 18Z" fill="currentColor"/>
                                                    <path opacity="0.3" d="M20 4H17V3C17 2.4 16.6 2 16 2H8C7.4 2 7 2.4 7 3V4H4C3.4 4 3 4.4 3 5V9C3 11.2 4.8 13 7 13C8.2 14.2 8.8 14.8 10 16H14C15.2 14.8 15.8 14.2 17 13C19.2 13 21 11.2 21 9V5C21 4.4 20.6 4 20 4ZM5 9V6H7V11C5.9 11 5 10.1 5 9ZM19 9C19 10.1 18.1 11 17 11V6H19V9ZM17 21V22H7V21C7 20.4 7.4 20 8 20H16C16.6 20 17 20.4 17 21ZM10 9C9.4 9 9 8.6 9 8V5C9 4.4 9.4 4 10 4C10.6 4 11 4.4 11 5V8C11 8.6 10.6 9 10 9ZM10 13C9.4 13 9 12.6 9 12V11C9 10.4 9.4 10 10 10C10.6 10 11 10.4 11 11V12C11 12.6 10.6 13 10 13Z" fill="currentColor"/>
                                                    </svg>
                                                </span>
                                            </a>
                                        <?php endif ?>
                                        <?php if(session()->get('role') == 'Koordinator'  || session()->get('nama') == 'Masbahah '): ?>
                                            <a href="<?= base_url('rilisjadwalsidang/edit/'.$vdata['id_rilis_jadwal_sidang']) ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="Edit Data">
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                                    </svg>
                                                </span>
                                            </a>
                                            <form action="<?= base_url('rilisjadwalsidang/delete/'.$vdata['id_rilis_jadwal_sidang']) ?>" method="POST">
                                                <button type="submit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" title="Hapus Data">
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                                            <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V7H5V5Z" fill="black" />
                                                            <path opacity="0.5" d="M9 3C9 2.44772 9.44772 2 10 2H14C14.5523 2 15 2.44772 15 3V5H9V3Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                </button>
                                            </form>
                                        <?php endif ?>
                                        
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
                <h2 class="fs-2x fw-bolder mb-0">Ajukan Jadwal Sidang TA</h2>
                <!--end::Title-->
                <!--begin::Description-->
                <p class="text-gray-400 fs-4 fw-bold py-7">Klik tombol dibawah untuk menambahkan
                <br />Pengajuan Jadwa Sidang TA.</p>
                <!--end::Description-->
                <!--begin::Action-->
                <a href="<?= base_url('rilisjadwalsidang/create') ?>" class="btn btn-primary er fs-6 px-8 py-4" >Tambah Pengajuan Sidang</a>
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
    <div class="modal fade" id="detailJadwalSidang<?= $vdata['id_rilis_jadwal_sidang'] ?>" tabindex="-1" aria-hidden="true">
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
                        <h1 class="mb-3">Detail Jadwal Sidang</h1>
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
                                            <th width="40%" class="fs-6 fw-bolder">Penguji 1</th>
                                            <td width="60%">
                                                <a href="<?= base_url('public/assets/proposal/' . $vdata['nama_mhs']) ?>" target="_blank">
                                                    <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['penguji1'] ?></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fs-6 fw-bolder">Penguji 2</th>
                                            <td>
                                                <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['penguji2'] ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fs-6 fw-bolder">Penguji 3</th>
                                            <td>
                                                <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['penguji3'] ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fs-6 fw-bolder">Surat Undangan</th>
                                            <td>
                                                <?php if($vdata['surat_undangan'] == null && session()->get('role') == 'Admin') : ?>
                                                    <button onclick="uploadSuratUndangan(<?php echo $vdata['id_rilis_jadwal_sidang']; ?>)" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="tooltip" title="Upload Surat Undangan">
                                                        <span class="svg-icon svg-icon-muted svg-icon-3">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path opacity="0.3" d="M11 13H7C6.4 13 6 12.6 6 12C6 11.4 6.4 11 7 11H11V13ZM17 11H13V13H17C17.6 13 18 12.6 18 12C18 11.4 17.6 11 17 11Z" fill="currentColor"/>
                                                                <path d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM17 11H13V7C13 6.4 12.6 6 12 6C11.4 6 11 6.4 11 7V11H7C6.4 11 6 11.4 6 12C6 12.6 6.4 13 7 13H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V13H17C17.6 13 18 12.6 18 12C18 11.4 17.6 11 17 11Z" fill="currentColor"/>
                                                            </svg>
                                                        </span>
                                                    </button>
                                                <?php elseif($vdata['surat_undangan'] == null && session()->get('role') != 'Admin') : ?>
                                                    -
                                                <?php else : ?>
                                                    <a href="<?= base_url('public/assets/surat-undangan/'. $vdata['surat_undangan']) ?>" target="_blank" class="btn btn-sm btn-info">
                                                        download
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="fs-6 fw-bolder">Surat Tugas</th>
                                            <td class="text-dark fs-6">
                                                <?php if($vdata['surat_tugas'] == null && session()->get('role') == 'Admin') : ?>
                                                    <button onclick="uploadSuratTugas(<?php echo $vdata['id_rilis_jadwal_sidang']; ?>)" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="tooltip" title="Upload Surat Tugas">
                                                        <span class="svg-icon svg-icon-muted svg-icon-3">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path opacity="0.3" d="M11 13H7C6.4 13 6 12.6 6 12C6 11.4 6.4 11 7 11H11V13ZM17 11H13V13H17C17.6 13 18 12.6 18 12C18 11.4 17.6 11 17 11Z" fill="currentColor"/>
                                                                <path d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM17 11H13V7C13 6.4 12.6 6 12 6C11.4 6 11 6.4 11 7V11H7C6.4 11 6 11.4 6 12C6 12.6 6.4 13 7 13H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V13H17C17.6 13 18 12.6 18 12C18 11.4 17.6 11 17 11Z" fill="currentColor"/>
                                                            </svg>
                                                        </span>
                                                    </button>
                                                <?php elseif($vdata['surat_tugas'] == null && session()->get('role') != 'Admin') : ?>
                                                    -
                                                <?php else : ?>
                                                    <a href="<?= base_url('public/assets/surat-tugas/'. $vdata['surat_tugas']) ?>" target="_blank" class="btn btn-sm btn-info">
                                                        download
                                                    </a>
                                                <?php endif; ?>
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
<?= $this->endSection() ?>

