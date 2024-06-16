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
                            <span class="card-label fw-bolder fs-3 mb-1">Form Rilis Jadwal Seminar Hasil</span>
                            <span class="text-muted mt-1 fw-bold fs-7">Isi data jadwal seminar hasil dengan benar</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Form-->

                        <form class="form w-100" method="post" enctype="multipart/form-data" id="form_rilis_jadwal" action="<?= service('router')->getMatchedRoute()[0] == "rilisjadwalsemhas/create" ? base_url('rilisjadwalsemhas/store') : base_url('rilisjadwalsemhas/update/'.$dataForm['id_rilis_jadwal_semhas']??"") ?>">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <?php if(service('router')->getMatchedRoute()[0] == "rilisjadwalsemhas/create") : ?>
                                        <div class="fv-row mb-10">
                                            <label class="form-label required fs-6 fw-bolder text-dark">NIM</label>
                                            <select class="form-select form-select-lg form-select-solid" name="nim" id="nim" required>
                                                <option value="">Pilih NIM Mahasiswa</option>
                                                <?php foreach ($pengajuan as $pengaju): ?>
                                                    <option value="<?= $pengaju['nim'] ?>" <?= ($pengaju['nim'] == old('nim') || (isset($dataForm->nim) && $pengaju['nim'] == $dataForm->nim)) ? 'selected' : '' ?>>
                                                        <?= $pengaju['nim'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <input type="hidden" name="id_pengajuansemhas" id="id_pengajuansemhas" value="">
                                        <div class="fv-row mb-10 row">
                                            <div class="col-md-6">
                                                <label class="form-label required fs-6 fw-bolder text-dark">Nama</label>
                                                <input type="text" class="form-control form-control-lg form-control-solid" name="nama" id="nama" disabled>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label required fs-6 fw-bolder text-dark">Judul Tugas Akhir</label>
                                                <input type="text" class="form-control form-control-lg form-control-solid" name="judul" id="judul" disabled>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="fv-row mb-10">
                                        <label class="form-label required fs-6 fw-bolder text-dark">Ruangan</label>
                                        <input type="text" class="form-control form-control-lg form-control-solid" name="ruangan" id="ruangan" value="<?= old('ruangan') ?? $dataForm['ruangan'] ?? '' ?>">
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label class="form-label required fs-6 fw-bolder text-dark">Tanggal</label>
                                        <input type="date" class="form-control form-control-lg form-control-solid" name="tgl_ujian" id="tgl_ujian" value="<?= old('tgl_ujian') ?? $dataForm['tgl_ujian'] ?? '' ?>">
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label class="form-label required fs-6 fw-bolder text-dark">Jam Mulai</label>
                                        <input type="time" class="form-control form-control-lg form-control-solid" name="jam_start" id="jam_start" value="<?= old('jam_start') ?? $dataForm['jam_start'] ?? '' ?>">
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label class="form-label required fs-6 fw-bolder text-dark">Jam Berakhir</label>
                                        <input type="time" class="form-control form-control-lg form-control-solid" name="jam_end" id="jam_end" value="<?= old('jam_end') ?? $dataForm['jam_end'] ?? '' ?>">
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label class="form-label required fs-6 fw-bolder text-dark">Penguji 1</label>
                                        <select class="form-select form-select-lg form-select-solid" name="id_penguji1" required>
                                            <option value="">Pilih Dosen Penguji 1</option>
                                            <?php foreach ($dosen as $penguji): ?>
                                                <option value="<?= $penguji['id_user'] ?>" <?= ($penguji['id_user'] == old('id_penguji1') || (isset($dataForm['id_penguji1']) && $penguji['id_user'] == $dataForm['id_penguji1'])) ? 'selected' : '' ?>>
                                                    <?= $penguji['nama'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <!-- <div class="fv-row mb-10">
                                        <label class="form-label required fs-6 fw-bolder text-dark">Penguji 2</label>
                                        <select class="form-select form-select-lg form-select-solid" name="id_penguji2" required>
                                            <option value="">Pilih Dosen Penguji 2</option>
                                            <?php foreach ($dosen as $penguji): ?>
                                                <option value="<?= $penguji['id_user'] ?>" <?= ($penguji['id_user'] == old('id_penguji2') || (isset($dataForm['id_penguji2']) && $penguji['id_user'] == $dataForm['id_penguji2'])) ? 'selected' : '' ?>>
                                                    <?= $penguji['nama'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div> -->
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
            FormValidation.formValidation(document.getElementById('form_rilis_jadwal'), {
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
    <?php if(service('router')->getMatchedRoute()[0] == "rilisjadwalsemhas/create"): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Membuat objek JSON dari data PHP
                var dataMahasiswa = <?= json_encode(array_reduce($pengajuan, function($result, $pengaju) {
                    $result[$pengaju['nim']] = [
                        'nama' => $pengaju['nama_mhs'],
                        'judul' => $pengaju['judul'],
                        'id_pengajuansemhas' => $pengaju['id_seminarhasil']
                    ];
                    return $result;
                }, [])); ?>;

                // Event listener untuk dropdown NIM
                document.getElementById('nim').addEventListener('change', function() {
                    var nim = this.value;
                    var namaInput = document.getElementById('nama');
                    var judulInput = document.getElementById('judul');
                    var IdUjianInput = document.getElementById('id_pengajuansemhas');
                    
                    if (dataMahasiswa[nim]) {
                        namaInput.value = dataMahasiswa[nim].nama;
                        judulInput.value = dataMahasiswa[nim].judul;
                        IdUjianInput.value = dataMahasiswa[nim].id_pengajuansemhas;
                    } else {
                        namaInput.value = '';
                        judulInput.value = '';
                        IdUjianInput.value = '';
                    }
                });

                // Mengisi nama dan judul secara otomatis jika NIM sudah dipilih sebelumnya
                var nim = document.getElementById('nim').value;
                if (nim) {
                    document.getElementById('nim').dispatchEvent(new Event('change'));
                }
            });
        </script>
    <?php endif; ?>

<?= $this->endSection() ?>
