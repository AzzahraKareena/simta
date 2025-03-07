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
                        <span class="card-label fw-bolder fs-3 mb-1">Form Logbook</span>
                        <span class="text-muted mt-1 fw-bold fs-7">Isi data Logbook dengan benar</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Form-->
                    <form class="form w-100" method="post" id="form_logbook"  action="<?= isset($logbook['id']) ? base_url('logbook/update/' . $logbook['id']) : base_url('logbook/store') ?>">
                        <?= csrf_field() ?>
                        <!--begin::Input group-->
                        <?php if (session()->getFlashdata('errorForm')) : ?>
                            <div class="fv-row">
                                <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                                    <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4. 93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="black"></path>
                                            <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="black"></path>
                                        </svg>
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
                                    <label class="form-label required fs-6 fw-bolder text-dark">Jadwal Bimbingan</label>
                                    <select class="form-select form-select-lg form-select-solid" name="id_jadwal" required>
                                        <option value="">Pilih Jadwal Bimbingan</option>
                                        <?php foreach ($schedules as $schedule): ?>
                                            <option 
                                                value="<?= $schedule['id'] ?>" 
                                                <?= (isset($logbook['id_jadwal']) && $schedule['id'] == $logbook['id_jadwal']) ? 'selected' : '' ?>
                                            >
                                                <?= $schedule['tanggal'] . ' - ' . $schedule['tempat'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="fv-row mb-10">
                                    <label class="form-label required fs-6 fw-bolder text-dark">Catatan Bimbingan</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="catatan" autocomplete="off" placeholder="Input catatan bimbingan"value="<?= old('catatan', $logbook['catatan'] ?? '') ?>" required />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                            </div>
                        </div>
                        <!--begin::Actions-->
                        <div class="text-center">
                            <!--begin::Submit button-->
                            <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">Submit</button>
                            <!--end::Submit button-->
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--begin::Body-->
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
        FormValidation.formValidation(document.getElementById('form_logbook'), {
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