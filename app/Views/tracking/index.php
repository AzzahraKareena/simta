<?= $this->extend('layouts\main') ?>

<?= $this->section('content') ?>
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
                <input type="text" data-kt-subscription-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Cari..." />
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
                    <form action="/mahasiswabimbingan" method="get" class="d-flex align-items-center position-relative my-1 mt-3" id="myForm" role="form">
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
                <div class="my-1 me-4">
                    <!--begin::Select-->
                    <div class="d-flex align-items-center position-relative my-1 mt-3">
                        <select id="tracking_filter" class="selectFilter form-select form-select-sm form-select-solid w-300px" data-control="select2" data-hide-search="false">
                            <option value="">Semua</option>
                            <option value="Pengajuan Judul">Pengajuan Judul</option>
                            <option value="Judul Acc">Judul Acc</option>
                            <option value="Pengajuan Bimbingan Ujian Proposal">Pengajuan Bimbingan Ujian Proposal</option>
                            <option value="Pengajuan Ujian Proposal">Pengajuan Ujian Proposal</option>
                            <option value="Pengumpulan Revisi Ujian Proposal">Pengumpulan Revisi Ujian Proposal</option>
                            <option value="Pengajuan Bimbingan Seminar Hasil">Pengajuan Bimbingan Seminar Hasil</option>
                            <option value="Pengajuan Seminar Hasil">Pengajuan Seminar Hasil</option>
                            <option value="Pengumpulan Revisi Seminar Hasil">Pengumpulan Revisi Seminar Hasil</option>
                            <option value="Ajuan Bimbingan Sidang">Ajuan Bimbingan Sidang</option>
                            <option value="Pengajuan Sidang">Pengajuan Sidang</option>
                            <option value="Revisi Sidang">Revisi Sidang</option>
                            <option value="Unggah Syarat Kelulusan">Unggah Syarat Kelulusan</option>
                        </select>
                    </div>
                </div>
            </div>
            <!--end::Toolbar-->
            <!-- begin::Button Reminder -->
            <div class="d-flex align-items-center position-relative my-1">
                <a href="<?= base_url('reminder') ?>" class="btn btn-primary ms-3">
                    <i class="bi bi-plus"></i> Reminder
                    <i class="bi bi-bell ms-1"></i>
                </a>
            </div>
            <!--end::Button Reminder-->
            <!--begin::Group actions-->
            <div class="d-flex justify-content-end align-items-center d-none" data-kt-subscription-table-toolbar="selected">
                <div class="fw-bolder me-5">
                    <span class="me-2" data-kt-subscription-table-select="selected_count"></span>Selected
                </div>
                <button type="button" class="btn btn-danger" data-kt-subscription-table-select="delete_selected">Delete Selected</button>
            </div>
            <!--end::Group actions-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Body-->
    <?php if (!empty($data) && is_array($data)) : ?>
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9" width="100%" id="dataTable">
                    <!--begin::Thead-->
                    <thead class="border-gray-200 fs-6 fw-bold bg-lighten">
                        <tr>
                            <th width="20%" class="min-w-150px">Nama Mahasiswa</th>
                            <th width="20%" class="min-w-150px ps-5">Angkatan</th>
                            <th width="20%" class="min-w-150px ps-5">Judul TA</th>
                            <th width="20%" class="min-w-150px ps-5">Tracking</th>
                            <th width="20%" class="min-w-150px ps-5">Dospem</th>
                        </tr>
                    </thead>
                    <!--end::Thead-->
                    <!--begin::Tbody-->
                    <tbody class="fw-6 fw-bold text-gray-600">
                        <?php foreach ($data as $item) : ?>
                            <tr>
                                <td>
                                    <span class="fw-bolder d-block fs-6"><?= ucwords($item['mahasiswa_nama']) ?></span>
                                </td>
                                <td class="ps-5"><?= $item['angkatan'] ?></td>
                                <td class="ps-5"><?= $item['judul_acc'] ?></td>
                                <td class="ps-5">
                                    <?php if (!empty($item) && isset($item['tracking'])) : ?>
                                        <?php if ($item['tracking'] == 'Pengajuan Judul') : ?>
                                            <div class="badge badge-light-dark"><?= $item['tracking'] ?></div>
                                        <?php elseif ($item['tracking'] == 'Judul Acc') : ?>
                                            <div class="badge badge-dark"><?= $item['tracking'] ?></div>
                                        <?php elseif ($item['tracking'] == 'Pengajuan Bimbingan Ujian Proposal') : ?>
                                            <div class="badge badge-danger"><?= $item['tracking'] ?></div>
                                        <?php elseif ($item['tracking'] == 'Pengajuan Ujian Proposal') : ?>
                                            <div class="badge badge-light-danger"><?= $item['tracking'] ?></div>
                                        <?php elseif ($item['tracking'] == 'Pengumpulan Revisi Ujian Proposal') : ?>
                                            <div class="badge badge-warning"><?= $item['tracking'] ?></div>
                                        <?php elseif ($item['tracking'] == 'Pengajuan Bimbingan Seminar Hasil') : ?>
                                            <div class="badge badge-light-warning"><?= $item['tracking'] ?></div>
                                        <?php elseif ($item['tracking'] == 'Pengajuan Seminar Hasil') : ?>
                                            <div class="badge badge-light-info"><?= $item['tracking'] ?></div>
                                        <?php elseif ($item['tracking'] == 'Pengumpulan Revisi Seminar Hasil') : ?>
                                            <div class="badge badge-info"><?= $item['tracking'] ?></div>
                                        <?php elseif ($item['tracking'] == 'Ajuan Bimbingan Sidang') : ?>
                                            <div class="badge badge-light-primary"><?= $item['tracking'] ?></div>
                                        <?php elseif ($item['tracking'] == 'Pengajuan Sidang') : ?>
                                            <div class="badge badge-primary"><?= $item['tracking'] ?></div>
                                        <?php elseif ($item['tracking'] == 'Revisi Sidang') : ?>
                                            <div class="badge badge-light-success"><?= $item['tracking'] ?></div>
                                        <?php elseif ($item['tracking'] == 'Unggah Syarat Kelulusan') : ?>
                                            <div class="badge badge-success"><?= $item['tracking'] ?></div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td class="ps-5"><?= $item['dospem_nama'] ?></td>
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
                <h2 class="fs-2x fw-bolder mb-0">Data Mahasiswa Bimbingan</h2>
                <!--end::Title-->
                <!--begin::Description-->
                <p class="text-gray-400 fs-4 fw-bold py-7">Belum ada data
                    <br />Mahasiswa Bimbingan.
                </p>
            </div>
            <!--end::Heading-->
            <!--begin::Illustration-->
            <div class="text-center px-5">
                <img src="<?= base_url('assets/media/illustrations/sketchy-1/17.png') ?>" alt="" class="mw-100 h-200px h-sm-325px" />
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php
        $alert_message = session()->getFlashdata('alert_message');
        $alert_type = session()->getFlashdata('alert_type');
        if ($alert_message) : ?>
            Swal.fire({
                icon: '<?php echo $alert_type; ?>',
                title: 'Pesan',
                html: '<?php echo nl2br(htmlspecialchars($alert_message)); ?>',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
    });
</script>

<?= $this->endSection() ?>