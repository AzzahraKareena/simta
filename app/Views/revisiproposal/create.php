<?= $this->extend('layouts\main') ?>

<?= $this->section('content') ?>
<div>
    <h3><?= $title ?></h3>

    <h4>Data Mahasiswa</h4>
    <?php foreach ($mahasiswa as $mhs) : ?>
        <table width="100%" cellpadding="5">
            <tbody>
                <tr>
                    <td width="25%">Nama Mahasiswa</td>
                    <td width="2%">:</td>
                    <td width="73%"><?= $mhs['nama_mhs'] ?></td>
                </tr>
                <tr>
                    <td>NIM</td>
                    <td>:</td>
                    <td width="73%"><?= $mhs['nim'] ?></td>
                </tr>
                <tr>
                    <td>Jurusan / Program Studi</td>
                    <td>:</td>
                    <td width="73%"><?= $mhs['prodi'] ?></td>
                </tr>
                <tr>
                    <td>Judul Proposal TA</td>
                    <td>:</td>
                    <td width="73%"><?= $mhs['judul'] ?></td>
                </tr>
            </tbody>
        </table>
    <?php endforeach; ?>

    <form id="revisionForm" action="<?= base_url('revisiproposal/store') ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="id_rilis_jadwal" value="<?= $id_rilis_jadwal; ?>"> <!-- Pass the rilis jadwal ID -->
       
        <div id="revisionFields">
            <div class="mb-3">
                <label class="form-label">Catatan Revisi</label>
                <input type="text" class="form-control" name="catatan_revisi[]" placeholder="Masukkan catatan revisi">
            </div>
        </div>
        <button type="button" class="btn btn-secondary" id="addRevisionField">+</button>
        <button type="button" class="btn btn-primary" id="saveRevisions">Simpan Revisi</button>
    </form>
</div>

<!-- Bootstrap Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah catatan revisi yang anda masukkan sudah benar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="button" class="btn btn-primary" id="confirmSubmit">Ya</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js_custom') ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const addRevisionFieldButton = document.getElementById('addRevisionField');
        const revisionFieldsContainer = document.getElementById('revisionFields');
        const saveRevisionsButton = document.getElementById('saveRevisions');
        const form = document.getElementById('revisionForm');
        const submitButton = document.getElementById('confirmSubmit');

        addRevisionFieldButton.addEventListener('click', function() {
            const newField = document.createElement('div');
            newField.className = 'mb-3';
            newField.innerHTML = '<input type="text" class="form-control" name="catatan_revisi[]" placeholder="Masukkan catatan revisi">';
            revisionFieldsContainer.appendChild(newField);
        });

        saveRevisionsButton.addEventListener('click', function() {
            $('#confirmationModal').modal('show');
        });

        submitButton.addEventListener('click', function() {
            form.submit();
        });
    });
</script>
<?= $this->endSection() ?>