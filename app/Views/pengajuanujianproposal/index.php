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
                            <span class="card-label fw-bolder fs-3 mb-1">Data Pengajuan Ujian Proposal</span>
                            <span class="text-muted mt-1 fw-bold fs-7">List data ujian proposal tersedia</span>
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

                                <!--begin::Toolbar-->
                                <?php if(session()->get('role') == 'Mahasiswa' && !$mahasiswaSudahMengajukan): ?>
                                <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                                    <!--begin::Add customer-->
                                    <a href="<?= base_url('pengajuanujianproposal/create')?>" class="btn btn-primary" data-bs-toggle="tooltip" title="Klik tambah data">
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
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4" id="dt_pengajuanujianproposal">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bolder text-muted">
                                        <th class="min-w-20px text-center">Abstrak</th>
                                        <th class="min-w-20px text-center">Proposal TA</th>
                                        <th class="min-w-20px text-center">Ajuan Tanggal Ujian</th>
                                        <th class="min-w-20px text-center">Revisi Proposal</th>
                                        <th class="min-w-20px text-center">Action</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    <?php foreach ($data as $vdata): ?>
                                        <tr>
                                            <td>
                                                <span class="text-dark fw-bolder text-hover-primary d-block fs-6"><?= $vdata['abstrak'] ?></span>
                                                <span class="text-muted fw-bold text-muted d-block fs-7">Abstrak: <?=$vdata['abstrak']?></span>
                                            </td>
                                            <td>
                                                <span class="text-dark fw-bolder text-hover-primary d-block fs-6">Start: <?= $vdata['proposal_ta'] ?></span>
                                                <span class="text-muted fw-bold text-muted d-block fs-7">Proposal TA: <?=$vdata['proposal_ta']?></span>
                                            </td>
                                            <td>
                                                <span class="text-dark fw-bolder text-hover-primary d-block fs-6">Start: <?= $vdata['ajuan_tgl_ujian'] ?></span>
                                                <span class="text-muted fw-bold text-muted d-block fs-7">End: <?=$vdata['ajuan_tgl_ujian']?></span>
                                            </td>
                                            <td>
                                                <?php if(session()->get('role') == 'Dosen'): ?>
                                                    <?php if (!empty($vdata) && isset($vdata['status_pengajuan'])) : ?>
                                                        <?php if ($vdata['status_pengajuan'] == 'PENDING') : ?>
                                                            <div class="dropdown">
                                                                <button class="btn btn-sm btn-warning dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    PENDING
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-dark">
                                                                    <li>
                                                                        <a class="dropdown-item" href="#">
                                                                            <form class="alert-verifikasi" action="/update/status_up/<?= $vdata['id_ujianproposal']; ?>" method="POST">
                                                                                <?= csrf_field() ?>
                                                                                <input type="hidden" value="DITERIMA" name="status">
                                                                                <button type="submit" class="dropdown-item" data-toggle="tooltip" title="Verifikasi">DITERIMA</button>
                                                                            </form>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#">
                                                                            <form class="alert-verifikasi" action="/update/status_up/<?= $vdata['id_ujianproposal']; ?>" method="POST">
                                                                                <?= csrf_field() ?>
                                                                                <input type="hidden" value="REVISI" name="status">
                                                                                <button type="submit" class="dropdown-item" data-toggle="tooltip" title="Verifikasi">REVISI</button>
                                                                            </form>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#">
                                                                            <form class="alert-verifikasi" action="/update/status_up/<?= $vdata['id_ujianproposal']; ?>" method="POST">
                                                                                <?= csrf_field() ?>
                                                                                <input type="hidden" value="DITOLAK" name="status">
                                                                                <button type="submit" class="dropdown-item" data-toggle="tooltip" title="Verifikasi">DITOLAK</button>
                                                                            </form>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        <?php elseif ($vdata['status_pengajuan'] == 'REVISI') : ?>
                                                            <div class="dropdown">
                                                                <button class="btn btn-sm btn-info dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    REVISI
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-dark">
                                                                    <li>
                                                                        <a class="dropdown-item" href="#">
                                                                            <form class="alert-verifikasi" action="/update/status_up/<?= $vdata['id_ujianproposal']; ?>" method="POST">
                                                                                <?= csrf_field() ?>
                                                                                <input type="hidden" value="DITERIMA" name="status">
                                                                                <button type="submit" class="dropdown-item" data-toggle="tooltip" title="Verifikasi">DITERIMA</button>
                                                                            </form>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#">
                                                                            <form class="alert-verifikasi" action="/update/status_up/<?= $vdata['id_ujianproposal']; ?>" method="POST">
                                                                                <?= csrf_field() ?>
                                                                                <input type="hidden" value="DITOLAK" name="status">
                                                                                <button type="submit" class="dropdown-item" data-toggle="tooltip" title="Verifikasi">DITOLAK</button>
                                                                            </form>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        <?php elseif ($vdata['status_pengajuan'] == 'DITOLAK') : ?>
                                                            <div class="dropdown">
                                                                <button class="btn btn-sm btn-danger dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    DITOLAK
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-dark">
                                                                    <li>
                                                                        <a class="dropdown-item" href="#">
                                                                            <form class="alert-verifikasi" action="/update/status_up/<?= $vdata['id_ujianproposal']; ?>" method="POST">
                                                                                <?= csrf_field() ?>
                                                                                <input type="hidden" value="DITERIMA" name="status">
                                                                                <button type="submit" class="dropdown-item" data-toggle="tooltip" title="Verifikasi">DITERIMA</button>
                                                                            </form>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#">
                                                                            <form class="alert-verifikasi" action="/update/status_up/<?= $vdata['id_ujianproposal']; ?>" method="POST">
                                                                                <?= csrf_field() ?>
                                                                                <input type="hidden" value="REVISI" name="status">
                                                                                <button type="submit" class="dropdown-item" data-toggle="tooltip" title="Verifikasi">REVISI</button>
                                                                            </form>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        <?php elseif ($vdata['status_pengajuan'] == 'DITERIMA') : ?>
                                                            <div class="badge badge-success"><?= $vdata['status_pengajuan'] ?></div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                <?php elseif(session()->get('role') == 'Mahasiswa'): ?>
                                                    <!-- Button code here -->
                                                    <?php if (!empty($vdata) && isset($vdata['status_pengajuan'])) : ?>
                                                        <?php if ($vdata['status_pengajuan'] == 'PENDING') : ?>
                                                            <div class="badge badge-warning"><?= $vdata['status_pengajuan'] ?></div>
                                                        <?php elseif ($vdata['status_pengajuan'] == 'DITOLAK') : ?>
                                                            <div class="badge badge-danger"><?= $vdata['status_pengajuan'] ?></div>
                                                        <?php elseif ($vdata['status_pengajuan'] == 'DITERIMA') : ?>
                                                            <div class="badge badge-success"><?= $vdata['status_pengajuan'] ?></div>
                                                        <?php elseif ($vdata['status_pengajuan'] == 'REVISI') : ?>
                                                            <div class="badge badge-info"><?= $vdata['status_pengajuan'] ?></div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-end flex-shrink-0">
                                                    <?php if(session()->get('role') == 'Koordinator'): ?>
                                                        <!-- <div class="d-flex justify-content-end flex-shrink-0"> -->

                                                            <!-- <button onclick="openFileUploader(<?php echo $vdata['id_ujianproposal']; ?>)" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 mb-3" title="Upload Jadwal">
                                                                <span class="svg-icon svg-icon-3 svg-icon-dark">
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <title>Upload Jadwal</title>
                                                                    <defs/>
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24"/>
                                                                        <path d="M2,13 C2,12.5 2.5,12 3,12 C3.5,12 4,12.5 4,13 C4,13.3333333 4,15 4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 C2,15 2,13.3333333 2,13 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                                        <rect fill="#000000" opacity="0.3" x="11" y="2" width="2" height="14" rx="1"/>
                                                                        <path d="M12.0362375,3.37797611 L7.70710678,7.70710678 C7.31658249,8.09763107 6.68341751,8.09763107 6.29289322,7.70710678 C5.90236893,7.31658249 5.90236893,6.68341751 6.29289322,6.29289322 L11.2928932,1.29289322 C11.6689749,0.916811528 12.2736364,0.900910387 12.6689647,1.25670585 L17.6689647,5.75670585 C18.0794748,6.12616487 18.1127532,6.75845471 17.7432941,7.16896473 C17.3738351,7.57947475 16.7415453,7.61275317 16.3310353,7.24329415 L12.0362375,3.37797611 Z" fill="#000000" fill-rule="nonzero"/>
                                                                    </g>
                                                                </svg>
                                                                </span>
                                                            </button> -->
                                                    <?php endif; ?>

                                                    <!-- <?php if (!empty($vdata['jadwal_id'])): ?>
                                                        <a href="<?= base_url('pengajuanujianproposal/berita-acara/'. $vdata['id_ujianproposal']) ?>" target="_blank" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="tooltip" title="Unduh Berita Acara">
                                                            <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download">
                                                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                                    <polyline points="7 10 12 15 17 10"></polyline>
                                                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    <?php endif; ?> -->

                                                    <?php if(session()->get('role') == 'Mahasiswa' && $vdata['status_pengajuan'] == 'REVISI'): ?>
                                                        <button onclick="openFileUploaderRevisi(<?php echo $vdata['id_ujianproposal']; ?>)" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="tooltip" title="Upload Revisi">
                                                            <span class="svg-icon svg-icon-muted svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor"/>
                                                            <path d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.20001C9.70001 3 10.2 3.20001 10.4 3.60001ZM12 16.8C11 16.8 10.2 16.4 9.5 15.8C8.8 15.1 8.5 14.3 8.5 13.3C8.5 12.8 8.59999 12.3 8.79999 11.9L10 13.1V10.1C10 9.50001 9.6 9.10001 9 9.10001H6L7.29999 10.4C6.79999 11.3 6.5 12.2 6.5 13.3C6.5 14.8 7.10001 16.2 8.10001 17.2C9.10001 18.2 10.5 18.8 12 18.8C12.6 18.8 13 18.3 13 17.8C13 17.2 12.6 16.8 12 16.8ZM16.7 16.2C17.2 15.3 17.5 14.4 17.5 13.3C17.5 11.8 16.9 10.4 15.9 9.39999C14.9 8.39999 13.5 7.79999 12 7.79999C11.4 7.79999 11 8.19999 11 8.79999C11 9.39999 11.4 9.79999 12 9.79999C12.9 9.79999 13.8 10.2 14.5 10.8C15.2 11.5 15.5 12.3 15.5 13.3C15.5 13.8 15.4 14.3 15.2 14.7L14 13.5V16.5C14 17.1 14.4 17.5 15 17.5H18L16.7 16.2Z" fill="currentColor"/>
                                                            <path opacity="0.3" d="M12 16.8C11 16.8 10.2 16.4 9.5 15.8C8.8 15.1 8.5 14.3 8.5 13.3C8.5 12.8 8.59999 12.3 8.79999 11.9L7.29999 10.4C6.79999 11.3 6.5 12.2 6.5 13.3C6.5 14.8 7.10001 16.2 8.10001 17.2C9.10001 18.2 10.5 18.8 12 18.8C12.6 18.8 13 18.3 13 17.8C13 17.2 12.6 16.8 12 16.8Z" fill="currentColor"/>
                                                            <path opacity="0.3" d="M15.5 13.3C15.5 13.8 15.4 14.3 15.2 14.7L16.7 16.2C17.2 15.3 17.5 14.4 17.5 13.3C17.5 11.8 16.9 10.4 15.9 9.39999C14.9 8.39999 13.5 7.79999 12 7.79999C11.4 7.79999 11 8.19999 11 8.79999C11 9.39999 11.4 9.79999 12 9.79999C12.9 9.79999 13.8 10.2 14.5 10.8C15.1 11.5 15.5 12.4 15.5 13.3Z" fill="currentColor"/>
                                                            </svg>
                                                            </span>
                                                        </button>
                                                    <?php endif; ?>
                                                    
                                                    <?php if ($vdata['revisi_proposal'] != null) : ?>
                                                    <!-- Icon untuk unduh berkas -->
                                                        <a href="<?= base_url('pengajuanujianproposal/unduh-revisi/'. $vdata['id_ujianproposal']) ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="Unduh Revisi">
                                                            <span class="svg-icon svg-icon-muted svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor"/>
                                                            <path d="M9.2 3H3C2.4 3 2 3.4 2 4V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V7C22 6.4 21.6 6 21 6H12L10.4 3.60001C10.2 3.20001 9.7 3 9.2 3Z" fill="currentColor"/>
                                                            </svg>
                                                            </span>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
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
        <script>
            function openFileUploader(proposalId) {
                var fileInput = document.createElement('input');
                fileInput.type = 'file';
                fileInput.accept = 'application/pdf'; // Set hanya menerima file PDF
                fileInput.onchange = function(e) {
                    var file = e.target.files[0];
                    
                    if (!file || file.type !== 'application/pdf') {
                        alert('Mohon pilih file PDF.');
                        return;
                    }

                    var formData = new FormData();
                    formData.append('file', file);

                    // Ganti '(:num)' dengan nilai yang sesuai, misalnya idProposal
                    var route = 'upload/jadwal/' + proposalId; 

                    fetch(route, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Gagal mengunggah file');
                        }
                        return response.text();
                    })
                    .then(data => {
                        console.log('Respon dari server:', data);
                        console.log('File berhasil diunggah:', file.name); // Menampilkan nama file yang diunggah

                        //Reload halaman setelah file berhasil diunggah
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Terjadi kesalahan:', error);
                    });
                };

                fileInput.click();
            }

            function openFileUploaderRevisi(proposalId) {
                var fileInput = document.createElement('input');
                fileInput.type = 'file';
                fileInput.accept = 'application/pdf'; // Set hanya menerima file PDF
                fileInput.onchange = function(e) {
                    var file = e.target.files[0];
                    
                    if (!file || file.type !== 'application/pdf') {
                        alert('Mohon pilih file PDF.');
                        return;
                    }

                    var formData = new FormData();
                    formData.append('file', file);

                    // Ganti '(:num)' dengan nilai yang sesuai, misalnya idProposal
                    var route = 'upload/revisi/' + proposalId; 

                    fetch(route, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Gagal mengunggah file');
                        }
                        return response.text();
                    })
                    .then(data => {
                        console.log('Respon dari server:', data);
                        console.log('File berhasil diunggah:', file.name); // Menampilkan nama file yang diunggah

                        //Reload halaman setelah file berhasil diunggah
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Terjadi kesalahan:', error);
                    });
                };

                fileInput.click();
            }
        </script>



        <!--end::Modal - New Product-->
        <!--end::Modals-->
    </div>
<?= $this->endSection() ?>

<?= $this->section('js_custom') ?>
    <?= view('pengajuanujianproposal/javascript') ?>
<?= $this->endSection() ?>
