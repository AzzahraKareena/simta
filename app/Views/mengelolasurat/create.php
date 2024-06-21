<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row gy-5">
    <div class="col">
        <div class="card card-xl-stretch mb-5 mb-xl-8">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Form Mengelola Surat Tugas Akhir</span>
                </h3>
            </div>
            <div class="card-body py-3">
                <form class="form" method="post" action="<?= base_url('mengelolasurat/store') ?>" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <?php if(session()->getFlashdata('errors')) : ?>
                        <div class="alert alert-danger mb-5" role="alert">
                            <ul>
                                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif ?>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="id_mhs" class="form-label required">ID Mahasiswa</label>
                                <input type="text" class="form-control" id="id_mhs" name="id_mhs" value="<?= old('id_mhs') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_staf" class="form-label required">ID Staf</label>
                                <input type="text" class="form-control" id="id_staf" name="id_staf" value="<?= old('id_staf') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="surat_undangan" class="form-label required">Surat Undangan (.pdf)</label>
                                <input type="file" class="form-control" id="surat_undangan" name="surat_undangan" required accept=".pdf">
                            </div>
                            <div class="mb-3">
                                <label for="surat_tugas" class="form-label required">Surat Tugas (.pdf)</label>
                                <input type="file" class="form-control" id="surat_tugas" name="surat_tugas" required accept=".pdf">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
