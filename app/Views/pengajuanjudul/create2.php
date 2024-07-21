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
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" href="<?= base_url('pengajuanbimbingan')?>">Pengajuan Bimbingan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" href="<?= base_url('pengajuanujianproposal')?>">Pengajuan Ujian Proposal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" href="<?= base_url('rilisjadwal')?>">Jadwal Ujian Proposal</a>
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
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Tambah Pengajuan Judul</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->
    <!--begin::Content-->
    <div id="kt_account_settings_profile_details" class="collapse show">
        <!--begin::Form-->
        <form id="kt_account_profile_details_form" class="form" method="post" enctype="multipart/form-data" action="<?= service('router')->getMatchedRoute()[0] == "pengajuanjudul/create" ? base_url('pengajuanjudul/store') : base_url('pengajuanjudul/update/'.$dataForm->id_pengajuanjudul??"") ?>">
            <?= csrf_field() ?>
            <div class="card-body border-top p-9">
                <?php if (session()->getFlashdata('errorForm')) : ?>
                    <div class="fv-row">
                        <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                            <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="black"></path>
                                    <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="black"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-danger">This is an alert</h4>
                                <span>
                                    <?= session()->getFlashdata('errorForm') ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label required fw-bold fs-6 text-end">Judul 1</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="nama_judul1" class="form-control form-control-lg form-control-solid" placeholder="Nama Judul ke-1" value="<?= old('nama_judul1')?? $dataForm->nama_judul1??"" ?>" required/>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label required fw-bold fs-6 text-end">Deskripsi Sistem 1</label>
                    <div class="col-lg-8 fv-row">
                        <input type="hidden" id="deskripsi_sistem1" name="deskripsi_sistem1" value="<?= old('deskripsi_sistem1')?? $dataForm->deskripsi_sistem1??"" ?>">
                        <trix-editor input="deskripsi_sistem1"><?= old('deskripsi_sistem1')?? $dataForm->deskripsi_sistem1??"" ?></trix-editor>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label required fw-bold fs-6 text-end">Judul 2</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="nama_judul2" class="form-control form-control-lg form-control-solid" placeholder="Nama Judul ke-2" value="<?= old('nama_judul2')?? $dataForm->nama_judul2??"" ?>" required/>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label required fw-bold fs-6 text-end">Deskripsi Sistem 2</label>
                    <div class="col-lg-8 fv-row">
                        <input type="hidden" id="deskripsi_sistem2" name="deskripsi_sistem2" value="<?= old('deskripsi_sistem2')?? $dataForm->deskripsi_sistem2??"" ?>">
                        <trix-editor input="deskripsi_sistem2"><?= old('deskripsi_sistem2')?? $dataForm->deskripsi_sistem2??"" ?></trix-editor>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label required fw-bold fs-6 text-end">Judul 3</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="nama_judul3" class="form-control form-control-lg form-control-solid" placeholder="Nama Judul ke-3" value="<?= old('nama_judul3')?? $dataForm->nama_judul3??"" ?>" required/>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label required fw-bold fs-6 text-end">Deskripsi Sistem 3</label>
                    <div class="col-lg-8 fv-row">
                        <input type="hidden" id="deskripsi_sistem3" name="deskripsi_sistem3" value="<?= old('deskripsi_sistem3')?? $dataForm->deskripsi_sistem3??"" ?>">
                        <trix-editor input="deskripsi_sistem3"><?= old('deskripsi_sistem3')?? $dataForm->deskripsi_sistem3??"" ?></trix-editor>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-bold fs-6 text-end">
                        <span class="required">Rekomendasi Dospem 1</span>
                        <!-- <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i> -->
                    </label>
                    <div class="col-lg-8 fv-row">
                        <select name="id_rekom_dospem1" aria-label="Pilih Rekomendasi Dospem" data-control="select2" data-placeholder="Pilih rekomendasi dospem..." class="form-select form-select-solid form-select-lg fw-bold">
                            <option value="">Select rekomendasi dospem</option>
                            <?php foreach ($rekomendasi_dosen as $rekomendasi): ?>
                                <option value="<?= $rekomendasi['id_user'] ?>" <?= ($rekomendasi['nama'] == old('id_rekom_dospem1') || (isset($dataForm->id_rekom_dospem1) && $rekomendasi['nama'] == $dataForm->id_rekom_dospem1)) ? 'selected' : '' ?>>
                                    <?= $rekomendasi['nama'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-3 col-form-label fw-bold fs-6 text-end">
                        <span class="required">Rekomendasi Dospem 2</span>
                        <!-- <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i> -->
                    </label>
                    <div class="col-lg-8 fv-row">
                        <select name="id_rekom_dospem2" aria-label="Pilih Rekomendasi Dospem" data-control="select2" data-placeholder="Pilih rekomendasi dospem..." class="form-select form-select-solid form-select-lg fw-bold">
                            <option value="">Select rekomendasi dospem</option>
                            <?php foreach ($rekomendasi_dosen as $rekomendasi): ?>
                                <option value="<?= $rekomendasi['id_user'] ?>" <?= ($rekomendasi['nama'] == old('id_rekom_dospem2') || (isset($dataForm->id_rekom_dospem2) && $rekomendasi['nama'] == $dataForm->id_rekom_dospem2)) ? 'selected' : '' ?>>
                                    <?= $rekomendasi['nama'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <!--end::Card body-->
            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Submit</button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
</div>
<?= $this->endSection() ?>