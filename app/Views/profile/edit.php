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
                    <!--begin::Form-->
                    <form class="form w-100" method="post" id="form-edit-profile" action="<?= base_url('profile/update') ?>">
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
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="nama" autocomplete="off" placeholder="Input nama" value="<?= old('nama') ?? $user['nama'] ?? "" ?>" required />
                                </div>
                                <div class="fv-row mb-10">
                                    <label class="form-label required fs-6 fw-bolder text-dark">Email</label>
                                    <input class="form-control form-control-lg form-control-solid" type="email" name="email" autocomplete="off" placeholder="Input email" value="<?= old('email') ?? $user['email'] ?? "" ?>" required />
                                </div>
                                <div class="fv-row mb-10">
                                    <label class="form-label required fs-6 fw-bolder text-dark">Username</label>
                                    <input class="form-control form-control-lg form-control-solid" type="text" name="username" autocomplete="off" placeholder="Input username" value="<?= old('username') ?? $user['username'] ?? "" ?>" required />
                                </div>
                                <div class="fv-row mb-10">
                                    <label class="form-label required fs-6 fw-bolder text-dark">Password</label>
                                    <input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" placeholder="Input password" />
                                </div>
    
                            </div>
                        </div>
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">Submit</button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
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