<?= $this->extend('layouts\main') ?>

<?= $this->section('content') ?>
    <div>
        <!--begin::Row-->
        <div class="row gy-5">
            <!--begin::Col-->
            <div class="col">
                <!--begin::Tables Widget 9-->
                <div class="card card-xl-stretch mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">Data Pengajuan Bimbingan</span>
                            <span class="text-muted mt-1 fw-bold fs-7">List data bimbingan tersedia</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Wrapper-->
                            <div class="d-flex flex-stack mb-5">
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative my-1">
                                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black"></path>
                                        </svg>
                                    </span>
                                    <input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Data"/>
                                </div>
                                <!--end::Search-->

                                <form action="/pengajuanbimbingan" method="get" class="d-flex align-items-center position-relative my-1 mt-3" id="myForm" role="form">
                                    <label for="" class="form-label me-3">Tahun</label>
                                    <select id="tahun_filter" name="tahun" class="selectFilter form-select form-select-solid w-150px">
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

                                <?php if(session()->get('role') == 'Mahasiswa'): ?>
                                <!--begin::Toolbar-->
                                <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                                    <!--begin::Add customer-->
                                    <a href="<?= base_url('pengajuanbimbingan/create')?>" class="btn btn-primary" data-bs-toggle="tooltip" title="Klik tambah data">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black"></rect>
                                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
                                            </svg>
                                        </span>
                                        Tambah Data
                                    </a>
                                    <!--end::Add customer-->
                                </div>
                                <?php endif; ?>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Wrapper-->
                        <!--begin::Table container-->
                        <?php if(session()->get('role') == 'Mahasiswa'): ?>
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4" id="dt_pengajuanbimbingan">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bolder text-muted">
                                        <th class="">Judul TA</th>
                                        <th class="">Lokasi Bimbingan</th>
                                        <!-- <th class="">Hasil Bimbingan</th> -->
                                        <th class="">Status Ajuan</th>
                                        <th class="">Waktu bimbingan</th>
                                        <th class="">Jadwal Bimbingan</th>
                                        <th class="">Agenda</th>
                                        <!-- <th class="">Tracking</th>  -->
                                        
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                <?php if (!empty($data) && is_array($data)) : ?>
                                    <?php foreach ($data as $vdata): ?>
                                        <tr>
                                            <td>
                                                <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['judul_judul_acc'] ?></span>
                                            </td>
                                            <td>
                                                <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['lokasi_bimbingan'] ?></span>
                                            </td>
                                            
                                            <td>
                                                <?php if ($vdata['status_ajuan'] == 'PENDING') : ?>
                                                    <div class="badge badge-warning"><?= $vdata['status_ajuan'] ?></div>
                                                <?php elseif ($vdata['status_ajuan'] == 'DITOLAK') : ?>
                                                    <div class="badge badge-danger"><?= $vdata['status_ajuan'] ?></div>
                                                <?php else : ?>
                                                    <div class="badge badge-success"><?= $vdata['status_ajuan'] ?></div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="text-dark fw-bolder text-hover-primary d-block fs-6"> <?= $vdata['waktu_bimbingan'] ?></span>
                                            </td>
                                            <td>
                                                <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['jadwal_bimbingan'] ?></span>
                                            </td>
                                            <td>
                                                <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['agenda'] ?></span>
                                            </td>
                                            <!-- <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                       <?= $vdata['tracking']?>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-dark">
                                                        <?php foreach ($tracking as $track): ?>
                                                            <li>
                                                                <form class="alert-verifikasi" action="/update/tracking/<?= $vdata['id_pengajuanbimbingan']; ?>" method="POST">
                                                                    <?= csrf_field() ?>
                                                                    <input type="hidden" value="<?= $track ?>" name="tracking">
                                                                    <button type="submit" class="dropdown-item" data-toggle="tooltip" title="Verifikasi"><?= $track ?></button>
                                                                </form>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            </td> -->
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5">Tidak ada data pengajuan.</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <?php elseif(session()->get('role') == 'Dosen'): ?>
                            <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4" id="dt_pengajuanbimbingan">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bolder text-muted">
                                        <th class="">Judul TA</th>
                                        <th class="">Nama Mahasiswa</th>
                                        <th class="">NIM</th>
                                        <th class="">Lokasi Bimbingan</th>
                                        <!-- <th class="">Hasil Bimbingan</th> -->
                                        <th class="">Status Ajuan</th>
                                        <th class="">Waktu Bimbingan</th>
                                        <th class="">Jadwal Bimbingan</th>
                                        <th class="">Agenda</th> 
                                        <!-- <th class="">Tracking</th>  -->
                                        <th class="min-w-20px text-end">#</th>
                                        <!-- <th class="min-w-20px text-end">#</th> -->
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                <?php if (!empty($data) && is_array($data)) : ?>
                                    <?php foreach ($data as $vdata): ?>
                                        <tr>
                                            <td class="nilaiId d-none"><?= $vdata['mahasiswa_nama'] ?></td>
                                            <td class="nama_mahasiswa"><?= $vdata['judul_judul_acc'] ?></td>
                                            <td contenteditable="false" class="nama_mahasiswa"><?= $vdata['mahasiswa_nama'] ?></td>
                                            <td contenteditable="false" class="nim"><?= $nim ?></td>
                                            <td data-id="<?= $vdata['id_pengajuanbimbingan'] ?>" contenteditable="false" class="lokasi_bimbingan"><?= $vdata['lokasi_bimbingan'] ?></td>
                                            <td>
                                                <?php if ($vdata['status_ajuan'] == 'PENDING') : ?>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-warning dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            PENDING
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-dark">
                                                            <li>
                                                                <a class="dropdown-item" href="#">
                                                                    <form class="alert-verifikasi" action="/update/status/<?= $vdata['id_pengajuanbimbingan']; ?>" method="POST">
                                                                    <?= csrf_field() ?>
                                                                    <input type="hidden" value="DITERIMA" name="status">
                                                                    <button type="submit" class="dropdown-item" data-toggle="tooltip" title="Verifikasi">DITERIMA</button>
                                                                    </form>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#">
                                                                    <form class="alert-verifikasi" action="/update/status/<?= $vdata['id_pengajuanbimbingan']; ?>" method="POST">
                                                                    <?= csrf_field() ?>
                                                                    <input type="hidden" value="DITOLAK" name="status">
                                                                    <button type="submit" class="dropdown-item" data-toggle="tooltip" title="Verifikasi">DITOLAK</button>
                                                                    </form>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                <?php elseif ($vdata['status_ajuan'] == 'DITOLAK') : ?>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-danger dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            DITOLAK
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-dark">
                                                            <li>
                                                                <a class="dropdown-item" href="#">
                                                                    <form class="alert-verifikasi" action="/update/status/<?= $vdata['id_pengajuanbimbingan']; ?>" method="POST">
                                                                    <?= csrf_field() ?>
                                                                    <input type="hidden" value="DITERIMA" name="status">
                                                                    <button type="submit" class="dropdown-item" data-toggle="tooltip" title="Verifikasi">DITERIMA</button>
                                                                    </form>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#">
                                                                    <form class="alert-verifikasi" action="/update/status/<?= $vdata['id_pengajuanbimbingan']; ?>" method="POST">
                                                                    <?= csrf_field() ?>
                                                                    <input type="hidden" value="PENDING" name="status">
                                                                    <button type="submit" class="dropdown-item" data-toggle="tooltip" title="Verifikasi">PENDING</button>
                                                                    </form>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                <?php elseif ($vdata['status_ajuan'] == 'DITERIMA') : ?>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-success dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            DITERIMA
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-dark">
                                                            <li>
                                                                <a class="dropdown-item" href="#">
                                                                    <form class="alert-verifikasi" action="/update/status/<?= $vdata['id_pengajuanbimbingan']; ?>" method="POST">
                                                                    <?= csrf_field() ?>
                                                                    <input type="hidden" value="DITOLAK" name="status">
                                                                    <button type="submit" class="dropdown-item" data-toggle="tooltip" title="Verifikasi">DITOLAK</button>
                                                                    </form>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#">
                                                                    <form class="alert-verifikasi" action="/update/status/<?= $vdata['id_pengajuanbimbingan']; ?>" method="POST">
                                                                    <?= csrf_field() ?>
                                                                    <input type="hidden" value="PENDING" name="status">
                                                                    <button type="submit" class="dropdown-item" data-toggle="tooltip" title="Verifikasi">PENDING</button>
                                                                    </form>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td data-id="<?= $vdata['id_pengajuanbimbingan'] ?>" contenteditable="false" class="waktu_bimbingan"><?= $vdata['waktu_bimbingan'] ?></td>
                                            <td data-id="<?= $vdata['id_pengajuanbimbingan'] ?>" contenteditable="false" class="jadwal_bimbingan"><?= $vdata['jadwal_bimbingan'] ?></td>
                                            <td data-id="<?= $vdata['id_pengajuanbimbingan'] ?>" contenteditable="false" class="agenda"><?= $vdata['agenda'] ?></td>
                                            <td>
                                                <!-- <div class="dropdown">
                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                       <?= $vdata['tracking']?>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-dark">
                                                        <?php foreach ($tracking as $track): ?>
                                                            <li>
                                                                <form class="alert-verifikasi" action="/update/tracking/<?= $vdata['id_pengajuanbimbingan']; ?>" method="POST">
                                                                    <?= csrf_field() ?>
                                                                    <input type="hidden" value="<?= $track ?>" name="tracking">
                                                                    <button type="submit" class="dropdown-item" data-toggle="tooltip" title="Verifikasi"><?= $track ?></button>
                                                                </form>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div> -->
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-end flex-shrink-0">
                                                <button id="editButton_<?php echo $vdata['id_pengajuanbimbingan']; ?>" onclick="editTable(<?php echo $vdata['id_pengajuanbimbingan']; ?>)"  class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-btn" title="Edit Data">
                                                    <!-- Icon SVG -->
                                                    <span id="editIcon_<?php echo $vdata['id_pengajuanbimbingan']; ?>" class="svg-icon svg-icon-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </button>
                                                    <form action="<?= base_url('pengajuanbimbingan/delete/'.$vdata['id_pengajuanbimbingan']) ?>">
                                                        <button type="submit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" title="Hapus Data">
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
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5">Tidak ada data pengajuan.</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>

                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <?php endif; ?>
                        <!--end::Table container-->
                    </div>
                    <!--begin::Body-->
                </div>
                <!--end::Tables Widget 9-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
        <!--begin::Modal - New Product-->
        <div class="modal fade" id="kt_modal_view_event" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header border-0 justify-content-end">
                        <!--begin::Edit-->
                        <div class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-primary me-2" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Edit Event" id="kt_modal_view_event_edit">
                            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                    <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Edit-->
                        <!--begin::Edit-->
                        <div class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-danger me-2" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Delete Event" id="kt_modal_view_event_delete">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
                                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Edit-->
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-primary" data-bs-toggle="tooltip" title="Hide Event" data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body pt-0 pb-20 px-lg-17">
                        <!--begin::Row-->
                        <div class="d-flex">
                            <!--begin::Icon-->
                            <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-muted me-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="black" />
                                    <path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="black" />
                                    <path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <!--end::Icon-->
                            <div class="mb-9">
                                <!--begin::Event name-->
                                <div class="d-flex align-items-center mb-2">
                                    <span class="fs-3 fw-bolder me-3" data-kt-calendar="event_name"></span>
                                    <span class="badge badge-light-success" data-kt-calendar="all_day"></span>
                                </div>
                                <!--end::Event name-->
                                <!--begin::Event description-->
                                <div class="fs-6" data-kt-calendar="event_description"></div>
                                <!--end::Event description-->
                            </div>
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="d-flex align-items-center mb-2">
                            <!--begin::Icon-->
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs050.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-success me-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <circle fill="#000000" cx="12" cy="12" r="8" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <!--end::Icon-->
                            <!--begin::Event start date/time-->
                            <div class="fs-6">
                                <span class="fw-bolder">Starts</span>
                                <span data-kt-calendar="event_start_date"></span>
                            </div>
                            <!--end::Event start date/time-->
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="d-flex align-items-center mb-9">
                            <!--begin::Icon-->
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs050.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-danger me-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <circle fill="#000000" cx="12" cy="12" r="8" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <!--end::Icon-->
                            <!--begin::Event end date/time-->
                            <div class="fs-6">
                                <span class="fw-bolder">Ends</span>
                                <span data-kt-calendar="event_end_date"></span>
                            </div>
                            <!--end::Event end date/time-->
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="d-flex align-items-center">
                            <!--begin::Icon-->
                            <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                            <span class="svg-icon svg-icon-1 svg-icon-muted me-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z" fill="black" />
                                    <path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <!--end::Icon-->
                            <!--begin::Event location-->
                            <div class="fs-6" data-kt-calendar="event_location"></div>
                            <!--end::Event location-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Modal body-->
                </div>
            </div>
        </div>
        <!--end::Modal - New Product-->
        <!--end::Modals-->
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    function editTable(id) {
        var cells = document.querySelectorAll('td[data-id="' + id + '"]');
        cells.forEach(function(cell) {
            cell.setAttribute('contenteditable', 'true');
        });
        
        // Mengubah ikon tombol dari Edit menjadi Check
        var editIcon = document.getElementById('editIcon_' + id);
        editIcon.innerHTML = '<!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Navigation/Check.svg--><button id="saveChanges'+ id +'" onclick="saveChanges('+ id +')"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><title>Submit</title><defs/><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><path d="M6.26193932,17.6476484 C5.90425297,18.0684559 5.27315905,18.1196257 4.85235158,17.7619393 C4.43154411,17.404253 4.38037434,16.773159 4.73806068,16.3523516 L13.2380607,6.35235158 C13.6013618,5.92493855 14.2451015,5.87991302 14.6643638,6.25259068 L19.1643638,10.2525907 C19.5771466,10.6195087 19.6143273,11.2515811 19.2474093,11.6643638 C18.8804913,12.0771466 18.2484189,12.1143273 17.8356362,11.7474093 L14.0997854,8.42665306 L6.26193932,17.6476484 Z" fill="#000000" fill-rule="nonzero" transform="translate(11.999995, 12.000002) rotate(-180.000000) translate(-11.999995, -12.000002) "/></g></svg></button><!--end::Svg Icon-->';
    }


    function saveChanges(id) {
        console.log("Changes saved for id:", id);
        var cells = document.querySelectorAll('td[data-id="' + id + '"]');
        var data = {};
        cells.forEach(function(cell) {
            data[cell.classList[0]] = cell.innerText;
            cell.setAttribute('contenteditable', 'false');
        });

        console.log("Data to be sent:", data);

        // Mengirim data menggunakan AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/update/bimbingan/" + id, true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    console.log("Data berhasil disimpan", xhr.responseText);
                    // Mengubah ikon tombol dari Check menjadi Edit setelah berhasil disimpan
                    var editIcon = document.getElementById('editIcon_' + id);
                    editIcon.innerHTML = '<!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Navigation/Edit.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><title>Edit</title><defs/><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><path d="M10.25,19.1614792 L10.25,20 L3,20 L3,12.75 L3.6767915,12.0732085 L10.25,5.5 L11.0606602,6.31066017 C11.2454599,6.49545992 11.3738866,6.74145715 11.4289322,7.00867322 L11.5,7.20710678 L11.5,9 L15,9 L15,10 L11.5,10 L11.5,19 L10.25,19 L10.25,19.1614792 Z M20.8535534,4.85355339 C21.0488155,5.04881554 21.0488155,5.36526891 20.8535534,5.56053107 L19.439,6.975 L17.025,4.561 L18.439,3.14644661 C18.6342621,2.95118446 18.9507155,2.95118446 19.1464466,3.14644661 L20.8535534,4.85355339 Z M16.5606602,8.14644661 L19.1464466,10.7322331 C19.3417087,10.9274953 19.3417087,11.2439487 19.1464466,11.4392108 L18.439,12.1464466 L17.878,11.5854466 L20.121,9.34244661 L20.682,9.90444661 C20.857357,10.0798042 21.1246605,10.0798042 21.3,9.90444661 C21.475337,9.72910961 21.475337,9.46180614 21.3,9.28644661 L16.5606602,4.54710678 C16.365398,4.35184462 16.0489446,4.35184462 15.8536824,4.54710678 L14.1464466,6.25434262 L16.391,8.499 L16.5606602,8.66866017 C16.7559214,8.86392133 17.0723748,8.86392133 17.2676062,8.66866017 C17.4628683,8.47339801 17.4628683,8.1569446 17.2676062,7.96168245 L16.5606602,8.14644661 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 12.000000) rotate(-135.000000) translate(-12.000000, -12.000000) "/></g></svg><!--end::Svg Icon-->';
                } else {
                    console.log("Error saving data", xhr.status, xhr.responseText);
                }
            }
        };
        xhr.send(JSON.stringify(data));

        //Reload halaman setelah file berhasil diunggah
        location.reload();
    }

    </script>
<?= $this->endSection() ?>

<?= $this->section('js_custom') ?>
    <?= view('pengajuanbimbingan/javascript') ?>
<?= $this->endSection() ?>


<!-- <script>
    $(document).ready(function() {
        $('#dt_pengajuanbimbingan').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= base_url('pengajuanbimbingan/get_data') ?>",
                "type": "POST"
            },
            "columns": [
                { "data": "lokasi_bimbingan" },
                { "data": "hasil_bimbingan" },
                { "data": "status_ajuan" },
                { "data": "waktu_bimbingan" },
                { "data": "jadwal_bimbingan" },
                { "data": "agenda" },
            ]
        });
    }); -->

    <script>
    // Fungsi untuk menangani klik tombol Edit
    $('.edit-btn').click(function() {
        var id = $(this).data('id');
        // Kirim permintaan Ajax untuk mengambil data yang akan diedit
        $.ajax({
            url: '/PengajuanBimbingan/get_data/' + id, // Ganti controller_name dengan nama controller Anda
            type: 'GET',
            success: function(response) {
                // Tampilkan data dalam formulir edit
                $('#edit-modal #name').val(response.name);
                $('#edit-modal #description').val(response.description);
                $('#edit-modal #price').val(response.price);
                // Tampilkan modal atau form edit
                $('#edit-modal').modal('show');
            }
        });
    });
</script>
