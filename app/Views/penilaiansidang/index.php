<?= $this->extend('layouts\main') ?>

<?= $this->section('content') ?>
<div class="card card-flush pb-0 bgi-position-y-top bgi-no-repeat mb-10" style="background-size: auto calc(50% + 5rem); background-position-x: 100%; background-image: url('assets/media/illustrations/sketchy-1/4.png')">
    <!--begin::Card header-->
    <div class="card-header pt-10">
        <div class="d-flex align-items-center">
            <!--begin::Icon-->
            <div class="symbol symbol-circle me-5">
                <div class="symbol-label bg-transparent text-primary border border-secondary border-dashed">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs020.svg-->
                    <span class="svg-icon svg-icon-2x svg-icon-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M17.302 11.35L12.002 20.55H21.202C21.802 20.55 22.202 19.85 21.902 19.35L17.302 11.35Z" fill="black" />
                            <path opacity="0.3" d="M12.002 20.55H2.802C2.202 20.55 1.80202 19.85 2.10202 19.35L6.70203 11.45L12.002 20.55ZM11.302 3.45L6.70203 11.35H17.302L12.702 3.45C12.402 2.85 11.602 2.85 11.302 3.45Z" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
            </div>
            <!--end::Icon-->
            <!--begin::Title-->
            <div class="d-flex flex-column">
                <h2 class="mb-1">Penilaian Sidang</h2>
            </div>
            <!--end::Title-->
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pb-0">
        <!--begin::Navs-->
        <div class="d-flex overflow-auto h-55px">
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-6 fw-bold flex-nowrap">
                <!--begin::Nav item-->
                <!-- <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" href="<?= base_url('pengajuanbimbingan') ?>">Pengajuan Bimbingan</a>
                </li> -->
                <!--end::Nav item-->
                <!--begin::Nav item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" href="<?= base_url('pengajuansidang') ?>">Pengajuan Sidang Tugas Akhir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" href="<?= base_url('rilisjadwalsidang') ?>">Jadwal Sidang Tugas Akhir</a>
                </li>
                <?php if(session()->get('role') == 'Dosen' || session()->get('role') == 'Koordinator' || session()->get('nama') == 'Masbahah '): ?>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6 active" href="<?= base_url('penilaiansidang') ?>">Penilaian Sidang Akhir</a>
                    </li>
                <?php endif; ?>
                <?php if(session()->get('role') == 'Mahasiswa'): ?>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 active" href="<?= base_url('syaratkelulusan') ?>">Unggah Syarat Kelulusan</a>
                </li>
                <?php endif; ?>
                <!--end::Nav item-->
            </ul>
        </div>
        <!--begin::Navs-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
<!--begin::Card-->
<div class="card card-flush">
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input type="text" data-kt-subscription-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Cari Syarat Kelulusan" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-subscription-table-toolbar="base">
                    <!--begin::Filter-->
                    <div class="my-1 me-4">
                        <!--begin::Select-->
                        <form action="/pengajuansidang" method="get" class="d-flex align-items-center position-relative my-1 mt-3" id="myForm" role="form">
                            <select id="tahun_filter" name="tahun" class="form-select form-select-sm form-select-solid w-125px" data-control="select2" data-placeholder="Select Tahun" data-hide-search="true">
                                <!-- <option value="1" selected="selected">1 Hours</option>
                                <option value="2">6 Hours</option>
                                <option value="3">12 Hours</option>
                                <option value="4">24 Hours</option> -->
                                <?php
                                    $thn_skr = date('Y');
                                    for ($x = $thn_skr; $x >= 2020; $x--) {
                                    ?>
                                    <option value="<?= $x; ?>" <?= ($x == $tahun) ? 'selected' : ''; ?>><?= $x; ?></option>
                                    <?php
                                    }
                                ?>
                            </select>
                        </form>
                        <!--end::Select-->
                    </div>
                    <!--end::Filter-->
                    
                    <!--end::Add subscription-->
                </div>
                <!--end::Toolbar-->
                <!--begin::Group actions-->
                <div class="d-flex justify-content-end align-items-center d-none" data-kt-subscription-table-toolbar="selected">
                    <div class="fw-bolder me-5">
                    <span class="me-2" data-kt-subscription-table-select="selected_count"></span>Selected</div>
                    <button type="button" class="btn btn-danger" data-kt-subscription-table-select="delete_selected">Delete Selected</button>
                </div>
                <!--end::Group actions-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Body-->
    <?php if (!empty($data) && is_array($data)) : ?>
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9" width="100%">
                    <!--begin::Thead-->
                    <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                        <tr>
                            <th width="25%" class="min-w-175px text-center">Nama Mahasiswa</th>
                            <th width="15%" class="min-w-150px text-center">NIM</th>
                            <th width="25%" class="min-w-150px text-center">Judul TA</th>
                            <th width="25%" class="min-w-150px text-center">Dospem</th>
                            <?php if(session()->get('role') == 'Koordinator' || session()->get('nama') == 'Masbahah '): ?>
                            <th width="25%" class="min-w-150px text-center">Penguji</th>
                            <?php endif ?>
                            <th width="15%" class="min-w-150px text-center">Tanggal Ujian</th>
                            <th width="10%" class="min-w-150px text-center">Total Nilai</th>
                            <?php if(session()->get('role') != 'Mahasiswa'): ?>
                            <th width="10%" class="min-w-150px text-center">#</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <!--end::Thead-->
                    <!--begin::Tbody-->
                    <tbody class="fw-6 fw-bold text-gray-600">
                        <?php foreach ($data as $vdata) : ?>
                            <tr>
                                <td><?= $vdata['mhs_nama'] ?></td>
                                <td><?= $nim ?></td>
                                <td><?= $vdata['judul_judul_acc'] ?></td>
                                <td><?= $vdata['dospem_nama'] ?></td>
                                <?php if(session()->get('role') == 'Koordinator' || session()->get('nama') == 'Masbahah '): ?>
                                <td><?= $vdata['staff_nama'] ?></td>
                                <?php endif ?>
                                <td><?= $vdata['jadwal'] ?></td>
                                <td><?= $vdata['nilai_total'] ?></td>
                                <td>
                                <?php if(session()->get('role') == 'Dosen'): ?>
                                    <div class="d-flex justify-content-end flex-shrink-0">
                                        <form action="<?= base_url('penilaiansidang/delete/'.$vdata['id_penilaian']) ?>" method="POST">
                                            <button type="submit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" title="Hapus Data">
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                                        <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V7H5V5Z" fill="black" />
                                                        <path opacity="0.5" d="M9 3C9 2.44772 9.44772 2 10 2H14C14.5523 2 15 2.44772 15 3V5H9V3Z" fill="black" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </form>
                                        <a href="<?= base_url('penilaiansidang/pdf/'.$vdata['id_penilaian']) ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" target="_blank" title="Cetak Penilaian Semhas">
                                                <span class="svg-icon svg-icon-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download">
                                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                                <polyline points="7 10 12 15 17 10"></polyline>
                                                                <line x1="12" y1="15" x2="12" y2="3"></line>
                                                            </svg>
                                                </span>
                                        </a>
                                    </div>
                                <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <!--end::Tbody-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
    <?php else : ?>
        <div class="card-body pb-0">
            <!--begin::Heading-->
            <div class="card-px text-center pt-20 pb-5">
                <!--begin::Title-->
                <h2 class="fs-2x fw-bolder mb-0">Penilaian Sidang Tugas Akhir</h2>
                <!--end::Title-->
                <!--begin::Description-->
                <!-- <p class="text-gray-400 fs-4 fw-bold py-7">Klik tombol dibawah untuk menambahkan
                <br />Pengajuan Syarat Kelulusan.</p> -->
                <!--end::Description-->
                <!--begin::Action-->
                <!-- <a href="<?= base_url('syaratkelulusan/create') ?>" class="btn btn-primary er fs-6 px-8 py-4" >Tambah Syarat</a> -->
                <!--end::Action-->
            </div>
            <!--end::Heading-->
            <!--begin::Illustration-->
            <div class="text-center px-5">
                <img src="<?= base_url('assets/media/illustrations/sketchy-1/17.png') ?>" alt="" class="mw-100 h-200px h-sm-325px" />
            </div>
            <!--end::Illustration-->
        </div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('td[contenteditable=true]').on('blur', function() {
                var cell = $(this);
                var column = cell.index();
                var rowId = cell.closest('tr').find('.nilaiId').text();
                var value = cell.text();
                
                // Prepare data to send
                var data = {
                    column: column,
                    value: value,
                    rowId: rowId
                };

                // Send data to server
                $.ajax({
                    url: 'pengajuanbimbingan/update/' + rowId,
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        console.log('Data updated successfully:', response);
                        // You can provide feedback to the user here if needed
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating data:', error);
                        // Handle errors here
                    }
                });
            });
        });
    </script>
    <script>
    function updateValidationStatus(id, status) {
        $.ajax({
            url: '<?= base_url('syaratkelulusan/updateValidationStatus/') ?>' + id,
            type: 'POST',
            data: {
                status: status
            },
            success: function(response) {
                // Handle success response
                alert('Status validasi berhasil diperbarui.');
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    }
</script>
<?= $this->endSection() ?>