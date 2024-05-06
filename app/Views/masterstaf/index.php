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
                            <span class="card-label fw-bolder fs-3 mb-1">Data Staf</span>
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
                            <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                                <!--begin::Add customer-->
                                <a href="<?= base_url('masterstaf/create')?>" class="btn btn-primary" data-bs-toggle="tooltip" title="Klik tambah data">
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
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4" id="dt_masterstaf">
                                <!-- Table header -->
                                <thead>
                                    <tr class="fw-bolder text-muted">
                                        <th>Nama</th>
                                        <th>NIP</th>
                                        <th>No.Telp</th>
                                        <th>Alamat</th>
                                        <th>Jenis</th>
                                        <th class="min-w-20px text-end">#</th>
                                    </tr>
                                </thead>
                                <!-- Table body -->
                                <tbody>
                                    <?php foreach ($data as $vdata): ?>
                                        <tr>
                                            <td><?= $vdata->nama_staf?></td>
                                            <td><?= $vdata->nip ?></td>
                                            <td><?= $vdata->no_telp ?></td>
                                            <td><?= $vdata->alamat_staf ?></td>
                                            <td><?= $vdata->jenis_staf ?></td>
                                            <td>
                                                <!-- Your actions here -->
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--end::Body-->
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
                        <!-- Your header content here -->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body pt-0 pb-20 px-lg-17">
                        <!-- Your modal body content here -->
                    </div>
                    <!--end::Modal body-->
                </div>
            </div>
        </div>
        <!--end::Modal - New Product-->
    </div>
<?= $this->endSection() ?>

<?= $this->section('js_custom') ?>
    <?= view('masterstaf/javascript') ?>
<?= $this->endSection() ?>
