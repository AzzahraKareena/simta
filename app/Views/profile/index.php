<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <!--begin::Row-->
    <div class="row gy-5">
        <!--begin::Col-->
        <div class="col">
            <!--begin::Profile Card-->
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Profile</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-bolder text-dark">Nama</label>
                                <p class="form-control-static"><?= esc($user['nama']) ?></p>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bolder text-dark">Email</label>
                                <p class="form-control-static"><?= esc($user['email']) ?></p>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bolder text-dark">Username</label>
                                <p class="form-control-static"><?= esc($user['username']) ?></p>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bolder text-dark">No. Telepon</label>
                                <p class="form-control-static"><?= esc($mahasiswa->no_telp ?? $staf->no_telp ?? "N/A") ?></p>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bolder text-dark">Alamat</label>
                                <p class="form-control-static"><?= esc($mahasiswa->alamat ?? $staf->alamat ?? "N/A") ?></p>
                            </div>
                            <?php if (isset($mahasiswa)): ?>
                                <div class="mb-4">
                                    <label class="form-label fw-bolder text-dark">NIM</label>
                                    <p class="form-control-static"><?= esc($mahasiswa->nim) ?></p>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-bolder text-dark">Prodi</label>
                                    <p class="form-control-static"><?= esc($mahasiswa->prodi) ?></p>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-bolder text-dark">Kelas</label>
                                    <p class="form-control-static"><?= esc($mahasiswa->kelas) ?></p>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-bolder text-dark">Status</label>
                                    <p class="form-control-static"><?= esc($mahasiswa->status) ?></p>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-bolder text-dark">Tahun Masuk</label>
                                    <p class="form-control-static"><?= esc($mahasiswa->th_masuk) ?></p>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-bolder text-dark">Tahun Lulus</label>
                                    <p class="form-control-static"><?= esc($mahasiswa->th_lulus) ?></p>
                                </div>
                            <?php elseif (isset($staf)): ?>
                                <div class="mb-4">
                                    <label class="form-label fw-bolder text-dark">NIP</label>
                                    <p class="form-control-static"><?= esc($staf->nip ?? "N/A") ?></p>
                                </div>
   
                            <?php else: ?>
                                <div class="mb-4">
                                    <p class="form-control-static"></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- Button to Edit Profile -->
                    <div class="text-center">
                        <a href="<?= base_url('profile/edit') ?>" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Profile Card-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
</div>
<?= $this->endSection() ?>