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
                            <span class="card-label fw-bolder fs-3 mb-1">Form Pengajuan Ujian Proposal</span>
                            <span class="text-muted mt-1 fw-bold fs-7">Isi data pengajuan ujian proposal dengan benar</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Form-->

                        <form class="form w-100" method="post" enctype="multipart/form-data" id="form_pengajuanujianproposal" action="<?= service('router')->getMatchedRoute()[0] == "pengajuanujianproposal/create" ? base_url('pengajuanujianproposal/store') : base_url('pengajuanujianproposal/update/'.$dataForm->id_ujianproposal??"") ?>">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="fv-row mb-10">
                                        <label class="form-label required fs-6 fw-bolder text-dark">Judul Tugas Akhir</label>
                                        <?php if (!empty($pjudul)): ?>
                                            <?php foreach ($pjudul as $judul): ?>
                                                <input class="form-control form-control-lg form-control-solid" type="text" name="judul_acc_id" autocomplete="off" disabled placeholder="Input abstrak" value="<?= $judul['judul_acc'] ?>" required />
                                                <input type="hidden" name="judul_acc_id" value="<?= $judul['id_accjudul']; ?>">
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <input class="form-control form-control-lg form-control-solid" type="text" name="judul_acc_title" autocomplete="off" disabled placeholder="Input abstrak" value="" required />
                                            <input type="hidden" name="judul_acc_id" value="">
                                        <?php endif; ?>
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label class="form-label required fs-6 fw-bolder text-dark">Abstrak</label>
                                        <textarea class="form-control" name="abstrak" id="" rows="10"><?= old('abstrak')?? $dataForm->abstrak??"" ?></textarea>
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label class="form-label required fs-6 fw-bolder text-dark">Proposal Tugas Akhir</label>
                                        <input class="form-control form-control-lg form-control-solid" type="file" name="proposal_ta" accept=".pdf" required />
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="fv-row mb-10">
                                                <label class="form-label required fs-6 fw-bolder text-dark">Ajuan Tanggal Ujian</label>
                                                <input class="form-control form-control-lg form-control-solid" type="datetime-local" name="ajuan_tgl_ujian" autocomplete="off" placeholder="Input Ajuan Tanggal Ujian Proposal" value="<?= old('ajuan_tgl_ujian')?? $dataForm->ajuan_tgl_ujian??"" ?>" required />
                                                <input type="hidden" value="PENDING" name="status">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-lg btn-primary mb-5">Submit</button>
                            </div>
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
            FormValidation.formValidation(document.getElementById('form_pengajuanujianproposal'), {
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
