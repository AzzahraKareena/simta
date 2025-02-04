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
                        <span class="card-label fw-bolder fs-3 mb-1">Form Penilaian Ujian Proposal</span>
                        <span class="text-muted mt-1 fw-bold fs-7">Isi data penilaian ujian proposal dengan benar</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Form-->
                    <form class="form w-100" method="post" enctype="multipart/form-data" id="form_pengajuanjudul" action="<?= base_url('penilaianproposal/store') ?>">
                        <?= csrf_field() ?>
                        <!--begin::Input group-->
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
                        <?php foreach ($mahasiswa as $mhs) : ?>
                            <input type="hidden" class="form-control form-control-lg form-control-solid" name="id_mhs" value="<?= $mhs['id_mhs'] ?>">
                            <input type="hidden" class="form-control form-control-lg form-control-solid" name="id_rilis_jadwal" value="<?= $mhs['id_rilis_jadwal'] ?>">
                            <table width="100%" celllpadding="5">
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
                        <?php endforeach ?>
                        <table width="100%" cellpadding="5" border="1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kriteria Penilaian</th>
                                    <th>Indikator Penilaian</th>
                                    <th>Nilai Maksimal</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1; // Inisialisasi counter
                                foreach ($indikator as $id_kriteria => $data) : ?>
                                    <tr>
                                        <td rowspan="<?= count($data['indikator']) ?>"><?= $no ?></td> <!-- Counter -->
                                        <td rowspan="<?= count($data['indikator']) ?>"><?= $data['kriteria_nama_kriteria'] ?></td>
                                        <?php
                                        $first = true;
                                        foreach ($data['indikator'] as $indi) : ?>
                                            <?php if (!$first) : ?>
                                    <tr>
                                    <?php endif; ?>
                                    <td><?= isset($indi['nama']) ? $indi['nama'] : 'N/A' ?></td>
                                    <input type="hidden" class="form-control form-control-lg form-control-solid" name="indikator[]" value="<?= $indi['id_indikator'] ?>">
                                    <td><?= isset($indi['max_nilai']) ? $indi['max_nilai'] : 'N/A' ?></td>
                                    <td><input type="number" class="form-control form-control-lg form-control-solid" name="nilai[<?= $indi['id_indikator'] ?>]" id="nilai_<?= $indi['id_indikator'] ?>" max="<?= $indi['max_nilai'] ?>" required></td>
                                    </tr>
                                <?php
                                            $first = false;
                                        endforeach;
                                        $no++; // Increment counter
                                ?>
                            <?php endforeach ?>
                            </tbody>
                        </table>
                        <!--begin::Actions-->
                        <div class="text-end">
                            <!--begin::Submit button-->
                            <button type="button" class="btn btn-lg btn-primary mb-5" data-bs-toggle="modal" data-bs-target="handleFormSubmit()">Submit</button>
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

<!-- Bootstrap Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah nilai yang anda masukkan benar?
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
        const form = document.getElementById('form_pengajuanjudul');
        const submitButton = document.getElementById('confirmSubmit');
        const mainSubmitButton = document.querySelector('button[data-bs-toggle="modal"]');

        function validateForm() {
            let isValid = true;
            const inputs = document.querySelectorAll('input[type="number"]');
            inputs.forEach(input => {
                if (input.value.trim() === '') {
                    isValid = false;
                    input.classList.add('is-invalid'); // Menandai input yang tidak valid
                } else {
                    input.classList.remove('is-invalid'); // Menghapus tanda input yang valid
                }
            });
            return isValid;
        }

        function handleFormSubmit(event) {
            if (validateForm()) {
                // Jika semua input valid, tampilkan modal konfirmasi
                console.log('Form valid. Menampilkan modal konfirmasi.');
                $('#confirmationModal').modal('show');
            } else {
                // Jika ada input yang kosong, tampilkan alert error
                console.log('Ada nilai yang kosong!. Menampilkan alert error.');
                Swal.fire({
                    icon: 'error',
                    title: 'Ada nilai yang kosong!',
                    text: 'Harap isi semua nilai sebelum melanjutkan.',
                    confirmButtonText: 'OK'
                });
                event.preventDefault(); // Mencegah form submit
            }
        }

        // Menangani klik pada tombol submit modal
        submitButton.addEventListener('click', function() {
            console.log('Men-submit form dari modal konfirmasi.');
            form.submit();
        });

        // Menangani klik pada tombol submit utama
        if (mainSubmitButton) {
            mainSubmitButton.addEventListener('click', handleFormSubmit);
        }

        // Validasi input nilai
        function validateInput(input) {
            const max = parseInt(input.getAttribute('max'));
            const value = parseInt(input.value);

            if (value > max) {
                Swal.fire({
                    icon: 'error',
                    title: 'Nilai tidak valid',
                    text: 'Nilai tidak boleh lebih dari ' + max,
                    confirmButtonText: 'OK'
                });
                input.value = max; // Kembalikan nilai ke nilai maksimum
            }
        }

        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', function() {
                validateInput(input);
            });
        });
    });
</script>

<?= $this->endSection() ?>


<!-- Add these in your head section -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>