<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row gy-5">
    <div class="col">
        <div class="card card-xl-stretch mb-5 mb-xl-8">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Daftar Surat Tugas Akhir</span>
                </h3>
            </div>
            <div class="card-body py-3">
                <?php if(session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success mb-5" role="alert">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif ?>

                <?php if(session()->get('role') == 'Admin') : ?>
                    <a href="<?= base_url('mengelolasurat/create') ?>" class="btn btn-primary mb-3">Tambah Surat</a>
                <?php endif ?>

                <table class="table">
                    <thead>
                        <tr>
                            <?php if(session()->get('role') == 'Admin') : ?>
                                <th>ID Mahasiswa</th>
                                <th>ID Staf</th>
                            <?php endif ?>
                            <th>Surat Undangan</th>
                            <th>Surat Tugas</th>
                            <?php if(session()->get('role') == 'Admin') : ?>
                                <th>Aksi</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($surat as $s) : ?>
                            <tr>
                                <?php if(session()->get('role') == 'Admin') : ?>
                                    <td><?= $s['id_mhs'] ?></td>
                                    <td><?= $s['id_staf'] ?></td>
                                <?php endif ?>
                                <td><a href="<?= base_url('public/assets/surat/' . $s['surat_undangan']) ?>" target="_blank"><?= $s['surat_undangan'] ?></a></td>
                                <td><a href="<?= base_url('public/assets/surat/' . $s['surat_tugas']) ?>" target="_blank"><?= $s['surat_tugas'] ?></a></td>
                                <?php if(session()->get('role') == 'Admin') : ?>
                                    <td>
                                        <form action="<?= base_url('mengelolasurat/delete/' . $s['id_surat']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE" />
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                <?php endif ?>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
