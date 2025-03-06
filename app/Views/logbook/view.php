<?= $this->extend('layouts\main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <h3>Logbook  <?= $mahasiswa->nama ?></h3> <!-- Display the name of the mahasiswa -->
        </div>
    </div>

    <?php if (!empty($logbook) && is_array($logbook)) : ?>
        <div class="card-body py-3">
            <div class="table-responsive">
                <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9" width="100%">
                    <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                        <tr>
                            <th width="10%">No</th>
                            <th width="10%" class="min-w-150px">Tanggal Bimbingan</th>
                            <th width="10%" class="min-w-150px">Waktu Bimbingan</th>
                            <th width="10%" class="min-w-150px">Lokasi</th>
                            <th width="10%" class="min-w-150px">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="fw-6 fw-bold text-gray-600">
                        <?php $counter = 1; ?>
                        <?php foreach ($logbook as $entry) : ?>
                            <tr>
                                <td class="ps-5"><?= $counter++; ?></td>
                                <td class="ps-5"><?= $entry['tanggal'] ?></td>
                                <td class="ps-5"><?= $entry['waktu'] ?></td>
                                <td class="ps-5"><?= $entry['tempat'] ?></td>
                                <td class="ps-5"><?= $entry['catatan'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <div class="card-body">
            <p class="text-center">Tidak ada data logbook yang tersedia untuk mahasiswa ini.</p>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>