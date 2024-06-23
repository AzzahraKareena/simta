<!--begin::Aside-->
<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo" style="display: flex; justify-content: center;">
        <!--begin::Logo-->
        <a href="../../demo1/dist/index.html">
            <img alt="Logo" src="<?= base_url('assets/media/logo-uns-biru.png')?>" class="h-50px logo" />
        </a>
        <!--end::Logo-->
        <!--end::Brand-->
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
            <span class="svg-icon svg-icon-1 rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="black" />
                    <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="black" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Aside toggler-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
            <!--begin::Menu-->
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
                <div class="menu-item">
                    <div class="menu-content pb-2">
                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">Dashboard</span>
                    </div>
                </div>
                <div class="menu-item">
                    <a class="menu-link <?= service('router')->getMatchedRoute()[0] == '/' ? "active" : "" ?>" href="<?=base_url()?>">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                    <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                                    <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                                    <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Home</span>
                    </a>
                </div>
                <?php if(session()->get('logged_in') == true) : ?>

                    <?php if(session()->get('role') == 'Admin'): ?>
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z" fill="black" />
                                        <path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z" fill="black" />
                                        <path opacity="0.3" d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Master</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item">
                                <a class="menu-link <?= explode('users', service('router')->getMatchedRoute()[0])[0] == "users" ? "active" : "" ?>" href="<?= base_url('users')?>">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Data Users</span>
                                </a>
                            </div>
                            <!-- <div class="menu-sub menu-sub-accordion menu-active-bg"> -->
                            <div class="menu-item">
                                <a class="menu-link <?= explode('masterstaf', service('router')->getMatchedRoute()[0])[0] == "masterstaf" ? "active" : "" ?>" href="<?= base_url('masterstaf')?>">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Data Staf</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link <?= explode('mastermahasiswa', service('router')->getMatchedRoute()[0])[0] == "mastermahasiswa" ? "active" : "" ?>" href="<?= base_url('mastermahasiswa')?>">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Data Mahasiswa</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link <?= explode('kriteria', service('router')->getMatchedRoute()[0])[0] == "kriteria" ? "active" : "" ?>" href="<?= base_url('kriteria')?>">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Data Kriteria Penilaian Proposal</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link <?= explode('indikator', service('router')->getMatchedRoute()[0])[0] == "indikator" ? "active" : "" ?>" href="<?= base_url('indikator')?>">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Data Indikator Penilaian Proposal</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link <?= explode('kriteria_semhas', service('router')->getMatchedRoute()[0])[0] == "kriteria_semhas" ? "active" : "" ?>" href="<?= base_url('kriteria_semhas')?>">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Data Kriteria Penilaian Semhas</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link <?= explode('indikator_semhas', service('router')->getMatchedRoute()[0])[0] == "indikator_semhas" ? "active" : "" ?>" href="<?= base_url('indikator_semhas')?>">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Data Indikator Penilaian Semhas</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link <?= explode('kriteria_sidang', service('router')->getMatchedRoute()[0])[0] == "kriteria_sidang" ? "active" : "" ?>" href="<?= base_url('kriteria_sidang')?>">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Data Kriteria Penilaian Sidang</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link <?= explode('indikator_sidang', service('router')->getMatchedRoute()[0])[0] == "indikator_sidang" ? "active" : "" ?>" href="<?= base_url('indikator_sidang')?>">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Data Indikator Penilaian Sidang</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z" fill="black" />
                                        <path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z" fill="black" />
                                        <path opacity="0.3" d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Menu</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div class="menu-item">
                                <a class="menu-link <?= explode('timeline', service('router')->getMatchedRoute()[0])[0] == "timeline" ? "active" : "" ?>" href="<?= base_url('timeline')?>">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Data Timeline</span>
                                </a>
                            </div>
                            <?php if(session()->get('role') == 'Dosen' || session()->get('unsername') == 'masbahah'): ?>
                                <div class="menu-item">
                                    <a class="menu-link <?= explode('users', service('router')->getMatchedRoute()[0])[0] == "users" ? "active" : "" ?>" href="<?= base_url('users')?>">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Data Users</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link <?= service('router')->getMatchedRoute()[0] == "mahasiswabimbingan" ? "active" : "" ?>" href="<?= base_url('mahasiswabimbingan')?>">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Data mahasiswa bimbingan</span>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php if(session()->get('role') == 'Mahasiswa' || session()->get('role') == 'Dosen' || session()->get('nama') == 'masbahah aprilio'): ?>
                                <div class="menu-item">
                                    <a class="menu-link <?= service('router')->getMatchedRoute()[0] == "pengajuanjudul" ? "active" : "" ?>" href="<?= base_url('pengajuanjudul')?>">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Pengajuan Judul</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link <?= service('router')->getMatchedRoute()[0] == "judulacc" ? "active" : "" ?>" href="<?= base_url('judulacc')?>">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Judul Acc</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link <?= service('router')->getMatchedRoute()[0] == "pengajuanbimbingan" ? "active" : "" ?>" href="<?= base_url('pengajuanbimbingan')?>">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Pengajuan Bimbingan</span>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php if(session()->get('role') != 'Admin'): ?>
                                <div class="menu-item">
                                    <a class="menu-link <?= service('router')->getMatchedRoute()[0] == "pengajuanujianproposal" ? "active" : "" ?>" href="<?= base_url('pengajuanujianproposal')?>">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Pengajuan Ujian Proposal</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link <?= service('router')->getMatchedRoute()[0] == "rilisjadwal" ? "active" : "" ?>" href="<?= base_url('rilisjadwal')?>">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Rilis Jadwal Ujian Proposal</span>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php if(session()->get('role') == 'Dosen' || session()->get('role') == 'Koordinator' || session()->get('nama') == 'masbahah aprilio'): ?>
                                <div class="menu-item">
                                    <a class="menu-link <?= service('router')->getMatchedRoute()[0] == "penilaianproposal" ? "active" : "" ?>" href="<?= base_url('penilaianproposal')?>">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Penilaian Ujian Proposal</span>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php if(session()->get('role') == 'Mahasiswa' || session()->get('role') == 'Dosen' || session()->get('nama') == 'masbahah aprilio'): ?>
                                <div class="menu-item">
                                    <a class="menu-link <?= service('router')->getMatchedRoute()[0] == "pengajuanseminarhasil" ? "active" : "" ?>" href="<?= base_url('pengajuanseminarhasil')?>">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Seminar Hasil</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link <?= service('router')->getMatchedRoute()[0] == "rilisjadwalsemhas" ? "active" : "" ?>" href="<?= base_url('rilisjadwalsemhas')?>">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Rilis Jadwal Seminar Hasil</span>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php if(session()->get('role') == 'Dosen' || session()->get('role') == 'Koordinator' || session()->get('nama') == 'masbahah aprilio'): ?>
                                <div class="menu-item">
                                    <a class="menu-link <?= service('router')->getMatchedRoute()[0] == "penilaiansemhas" ? "active" : "" ?>" href="<?= base_url('penilaiansemhas')?>">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Penilaian Seminar Hasil</span>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php if(session()->get('role') != 'Admin'): ?>
                                <div class="menu-item">
                                    <a class="menu-link <?= service('router')->getMatchedRoute()[0] == "pengajuansidang" ? "active" : "" ?>" href="<?= base_url('pengajuansidang')?>">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Sidang Tugas Akhir</span>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="menu-item">
                                <a class="menu-link <?= service('router')->getMatchedRoute()[0] == "rilisjadwalsidang" ? "active" : "" ?>" href="<?= base_url('rilisjadwalsidang')?>">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Rilis Jadwal Sidang TA</span>
                                </a>
                            </div>
                            <?php if(session()->get('role') == 'Mahasiswa' || session()->get('role') == 'Admin'): ?>
                                <div class="menu-item">
                                    <a class="menu-link <?= service('router')->getMatchedRoute()[0] == "mengelolasurat" ? "active" : "" ?>" href="<?= base_url('mengelolasurat')?>">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Unduh Surat Undangan</span>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php if(session()->get('role') == 'Dosen' || session()->get('role') == 'Koordinator' || session()->get('nama') == 'masbahah aprilio'): ?>
                                <div class="menu-item">
                                    <a class="menu-link <?= service('router')->getMatchedRoute()[0] == "penilaiansidang" ? "active" : "" ?>" href="<?= base_url('penilaiansidang')?>">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Penilaian Sidang Akhir</span>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php
                            $session = session();
                            $role = $session->get('role');
                            $id_mhs = $session->get('user_id'); // Asumsi id_mhs disimpan di session

                            $db = \Config\Database::connect();
                            $builder = $db->table('simta_penilaian_sidang');
                            $builder->where('id_mhs', $id_mhs);
                            $count = $builder->countAllResults();
                            ?>

                            <?php if($role == 'Mahasiswa' && $count > 0): ?>
                                <div class="menu-item">
                                    <a class="menu-link <?= service('router')->getMatchedRoute()[0] == "syaratkelulusan" ? "active" : "" ?>" href="<?= base_url('syaratkelulusan')?>">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Unggah Syarat Kelulusan</span>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php if(session()->get('role') == 'Admin'): ?>
                                <div class="menu-item">
                                    <a class="menu-link <?= service('router')->getMatchedRoute()[0] == "rekapitulasi-nilai" ? "active" : "" ?>" href="<?= base_url('rekapitulasi-nilai')?>">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Rekapitulasi Nilai</span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>               
            <!--end::Menu-->
        </div>
        <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->
</div>
<!--end::Aside-->



