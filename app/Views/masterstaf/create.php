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
                        <span class="card-label fw-bolder fs-3 mb-1">Form Data Staf</span>
                        <span class="text-muted mt-1 fw-bold fs-7">Isi data staf dengan benar</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Form-->
                    <form class="form w-100" method="post" id="form_masterstaf" action="<?= service('router')->getMatchedRoute()[0] == "masterstaf/create" ? base_url('masterstaf/store') : base_url('masterstaf/update/'.$dataForm->id_staf??"") ?>">
                        <?= csrf_field() ?>
                        <!--begin::Input group-->
                        <?php if (session()->getFlashdata('errorForm')) : ?>
                            <div class="fv-row">
                                <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                                    <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                                        <!-- SVG Icon Here -->
                                    </span>
                                    <div class="d-flex flex-column">
                                        <h4 class="mb-1 text-danger">This is an alert</h4>
                                        <span>
                                            <?= session()->getFlashdata('errorForm') ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="fv-row mb-10">
                                    <label class="form-label required fs-6 fw-bolder text-dark">Nama</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="nama" autocomplete="off" placeholder="Input nama" value="<?= old('nama') ?? $dataForm->nama ?? "" ?>" required />
                                </div>
                                <div class="fv-row mb-10">
                                    <label class="form-label required fs-6 fw-bolder text-dark">Email</label>
                                    <input class="form-control form-control-lg form-control-solid" type="email" name="email" autocomplete="off" placeholder="Input email" value="<?= old('email') ?? $dataForm->email ?? "" ?>" required />
                                </div>
                                <div class="fv-row mb-10">
                                    <label class="form-label required fs-6 fw-bolder text-dark">Username</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="username" autocomplete="off" placeholder="Input username" value="<?= old('username') ?? $dataForm->username ?? "" ?>" required />
                                </div>
                                <div class="fv-row mb-10">
                                    <label class="form-label required fs-6 fw-bolder text-dark">Password</label>
                                    <input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" placeholder="Input password"  />
                                </div>
                                <div class="fv-row mb-10">
                                <label class="form-label required fs-6 fw-bolder text-dark">Role</label>
                            
                            <select class="form-control form-control-lg form-control-solid" name="role" required>
                                    <option value="" disabled selected>Pilih Role</option>
                                    <option value="Admin" <?= (old('role') == 'Admin' || (!empty($dataForm) && isset($dataForm->role) && $dataForm->role == 'Admin')) ? 'selected' : '' ?>>Admin</option>
                                    <option value="Dosen" <?= (old('role') == 'Dosen' || (!empty($dataForm) && isset($dataForm->role) && $dataForm->role == 'Dosen')) ? 'selected' : '' ?>>Dosen</option>
                                    <option value="Koordinator" <?= (old('role') == 'Koordinator' || (!empty($dataForm) && isset($dataForm->role) && $dataForm->role == 'Koordinator')) ? 'selected' : '' ?>>Koordinator</option>

                                </select>
                            </div>
                                <div class="fv-row mb-10">
                                    <label class="form-label required fs-6 fw-bolder text-dark">NIP</label>
                                    <input class="form-control form-control-lg form-control-solid" type="number" name="nip" autocomplete="off" placeholder="Input nip" value="<?= old('nip') ?? $dataForm->nip ?? "" ?>" required />
                                </div>
                                <div class="fv-row mb-10">
                                    <label class="form-label required fs-6 fw-bolder text-dark">No.Telpon</label>
                                    <input class="form-control form-control-lg form-control-solid" type="number" name="no_telp" autocomplete="off" placeholder="Input no_telp" value="<?= old('no_telp') ?? $dataForm->no_telp ?? "" ?>" required />
                                </div>
                                <div class="fv-row mb-10">
                                    <label class="form-label required fs-6 fw-bolder text-dark">Alamat</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="alamat" autocomplete="off" placeholder="Input alamat" value="<?= old('alamat') ?? $dataForm->alamat ?? "" ?>" required />
                                </div>
                            </div>
                                <!--begin::Actions-->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">Submit</button>
                                </div>
                                <!--end::Actions-->
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Tables Widget 9-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
</div>
<?= $this->endSection() ?>

<?= $this->section('js_custom') ?>
<script>
    KTUtil.onDOMContentLoaded(function() {
        FormValidation.formValidation(document.getElementById('form_masterstaf'), {
            plugins: {
                declarative: new FormValidation.plugins.Declarative({
                    html5Input: true,
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: '.fv-row'
                }),
                defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
            },
        });
    });
</script>
<?= $this->endSection() ?>