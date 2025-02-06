
<?php


use CodeIgniter\Database\Migration;

class CreateTables extends Migration
{
    public function up()
    {
            // Tabel simta_kriteria
            $this->forge->addField([
                'id_kriteria' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                    'auto_increment' => true,
                ],
                'nama_kriteria' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                ],
            ]);
            $this->forge->addKey('id_kriteria', true);
            $this->forge->createTable('simta_kriteria');
    
            // Tabel simta_kriteria_semhas
            $this->forge->addField([
                'id_kriteria' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                    'unsigned' => true,
                    'null' => false,
                ],
                'nama_kriteria' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => true,
                ],
            ]);
            $this->forge->addKey('id_kriteria', true);
            $this->forge->createTable('simta_kriteria_semhas');
    
            // Tabel simta_kriteria_sidang
            $this->forge->addField([
                'id_kriteria' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                    'auto_increment' => true,
                    'null' => false,
                ],
                'nama_kriteria' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => true,
                ],
            ]);
            $this->forge->addKey('id_kriteria', true);
            $this->forge->createTable('simta_kriteria_sidang');
    
    
            // Tabel simta_indikator
            $this->forge->addField([
                'id_indikator' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                    'auto_increment' => true,
                ],
                'id_kriteria' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                    'null' => false,
                ],
                'nama' => [
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => true,
                ],
                'max_nilai' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'null' => true,
                ],
            ]);
            $this->forge->addKey('id_indikator', true);
            $this->forge->addForeignKey('id_kriteria', 'simta_kriteria', 'id_kriteria', 'CASCADE', 'CASCADE');
            $this->forge->createTable('simta_indikator');
    
            // Tabel simta_indikator_semhas
            $this->forge->addField([
                'id_indikator' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                    'null' => false,
                    'auto_increment' => true,
                ],
                'id_kriteria' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'null' => true,
                    'unsigned' => true,
                ],
                'nama' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => true,
                ],
                'max_nilai' => [
                    'type' => 'INT',
                    'constraint' => 255,
                    'null' => true,
                ],
            ]);
            $this->forge->addKey('id_indikator', true);
            $this->forge->addForeignKey('id_kriteria', 'simta_kriteria_semhas', 'id_kriteria', 'SET NULL', 'CASCADE');
            $this->forge->createTable('simta_indikator_semhas');
    
            // Tabel simta_indikator_sidang
            $this->forge->addField([
                'id_indikator' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                    'null' => false,
                    'auto_increment' => true,
                ],
                'id_kriteria' => [
                    'type' => 'INT',
                    'unsigned' => true,
                    'constraint' => 11,
                    'null' => true,
                ],
                'nama' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => true,
                ],
                'max_nilai' => [
                    'type' => 'INT',
                    'constraint' => 255,
                    'null' => true,
                ],
            ]);
            $this->forge->addKey('id_indikator', true);
            $this->forge->addForeignKey('id_kriteria', 'simta_kriteria_sidang', 'id_kriteria', 'SET NULL', 'CASCADE');
            $this->forge->createTable('simta_indikator_sidang');
    
               // Tabel users
               $this->forge->addField([
                'id' => [
                    'type' => 'INT',
                    'constraint' => 10,
                    'unsigned' => true,
                    'auto_increment' => true,
                ],
                'email' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                ],
                'username' => [
                    'type' => 'VARCHAR',
                    'constraint' => '30',
                ],
                'nama' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => true,
                ],
                'password_hash' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                ],
                'reset_hash' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => true,
                ],
                'reset_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
                'reset_expires' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
                'activate_hash' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => true,
                ],
                'status' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => true,
                ],
                'status_message' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => true,
                ],
                'active' => [
                    'type' => 'TINYINT',
                    'constraint' => 1,
                    'default' => 0,
                ],
                'force_pass_reset' => [
                    'type' => 'TINYINT',
                    'constraint' => 1,
                    'default' => 0,
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
                'deleted_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
                'password' => [
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                ],
                'role' => [
                    'type' => 'ENUM',
                    'constraint' => ['Admin', 'Dosen', 'Koordinator', 'Mahasiswa'],
                    'null' => true,
                ],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->addUniqueKey('email');
            $this->forge->addUniqueKey('username');
            $this->forge->createTable('users');

        // Tabel auth_groups
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('auth_groups');

        // Tabel auth_groups_permissions
        $this->forge->addField([
            'group_id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ],
            'permission_id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey(['group_id', 'permission_id'], true);
        $this->forge->addForeignKey('group_id', 'auth_groups', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('auth_groups_permissions');

        // Tabel auth_groups_users
        $this->forge->addField([
            'group_id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey(['group_id', 'user_id'], true);
        $this->forge->addForeignKey('group_id', 'auth_groups', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('auth_groups_users');

        // Tabel auth_permissions
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('auth_permissions');

        // Tabel mahasiswa
        $this->forge->addField([
            'id_mhs' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'null' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nim' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'prodi' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'no_telp' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'th_masuk' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'th_lulus' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'kelas' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Aktif', 'Tidak Aktif'],
            ],
        ]);
        $this->forge->addKey('id_mhs', true);
        $this->forge->addForeignKey('id_user', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('mahasiswa');

        // Tabel mata_kuliah
        $this->forge->addField([
            'id_mata_kuliah' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'auto_increment' => true,

            ],
            'kode_mata_kuliah' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama_mata_kuliah' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'semester' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'sks' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'jenis' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addKey('id_mata_kuliah', true);
        $this->forge->createTable('mata_kuliah');

        // Tabel simta_acc_judul
        $this->forge->addField([
            'id_accjudul' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'mhs_id' => [
                'type' => 'INT',
                'constraint' => 100,
                'unsigned' => true,
                'null' => true,
            ],
            'dospem_acc' => [
                'type' => 'INT',
                'constraint' => 100,
                'unsigned' => true,
                'null' => true,
            ],
            'judul_acc' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'keterangan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_accjudul', true);
        $this->forge->addForeignKey('mhs_id',  'users', 'id',  'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('dospem_acc', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('simta_acc_judul');

        // Tabel simta_berkas
        $this->forge->addField([
            'id_berkas' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_berkas' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'file_berkas' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addKey('id_berkas', true);
        $this->forge->createTable('simta_berkas');

        // Tabel simta_bobot
        $this->forge->addField([
            'id_bobot' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'auto_increment' => true,
            ],
            'bobot_ujianproposal' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'bobot_seminarhasil' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'bobot_ujianta' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'created_at' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'updated_at' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
        ]);
        $this->forge->addKey('id_bobot', true);
        $this->forge->createTable('simta_bobot');
        
    
        // Tabel simta_mahasiswa_bimbingan
        $this->forge->addField([
            'id_mahasiswa_bimbingan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'judul_acc_id' => [
                'type' => 'INT',
                'constraint' => 50,
                'unsigned' => true,
                'null' => true,
            ],
            'tracking' => [
                'type' => 'ENUM',
                'constraint' => [
                    'Pengajuan Judul',
                    'Pengajuan Ujian Proposal',
                    'Revisi Ujian Proposal',
                    'Pengajuan Bimbingan Ujian Proposal',
                    'Pengumpulan Revisi Ujian Proposal',
                    'Pengajuan Bimbingan Seminar Hasil',
                    'Pengajuan Seminar Hasil',
                    'Judul Acc',
                    'Revisi Seminar Hasil',
                    'Ajuan Bimbingan Sidang',
                    'Pengajuan Sidang',
                    'Revisi Sidang',
                    'Unggah Syarat Kelulusan',
                    'Pengumpulan Revisi Seminar Hasil',
                ],
                'default' => 'Judul Acc',
            ],
        ]);
        $this->forge->addKey('id_mahasiswa_bimbingan', true);
        $this->forge->addForeignKey('judul_acc_id', 'simta_acc_judul', 'id_accjudul', 'SET NULL', 'CASCADE');
        $this->forge->createTable('simta_mahasiswa_bimbingan');

        // Tabel simta_masterstaf
        $this->forge->addField([
            'id_masterstaf' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_staf' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'nip_staf' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'no_telpon' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'alamat_staf' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'jenis_staf' => [
                'type' => 'ENUM',
                'constraint' => ['Pimpinan', 'Dosen', 'Laboran', ''],
            ],
        ]);
        $this->forge->addKey('id_masterstaf', true);
        $this->forge->createTable('simta_masterstaf');

        // Tabel simta_master_mahasiswa
        $this->forge->addField([
            'id_master_mahasiswa' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_mahasiswa' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'nim' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'prodi' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'nomor_telp' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'tahun_masuk' => [
                'type' => 'INT',
                'constraint' => 25,
            ],
            'tahun_lulus' => [
                'type' => 'INT',
                'constraint' => 25,
            ],
            'kelas' => [
                'type' => 'ENUM',
                'constraint' => ['D', 'E', '', ''],
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Aktif', 'Tidak Aktif', '', ''],
            ],
        ]);
        $this->forge->addKey('id_master_mahasiswa', true);
        $this->forge->createTable('simta_master_mahasiswa');

        // Tabel simta_mengelola_surat
        $this->forge->addField([
            'id_surat' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_mhs' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_staf' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'surat_undangan' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
            ],
            'surat_tugas' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
            ],
        ]);
        $this->forge->addKey('id_surat', true);
        $this->forge->addForeignKey('id_mhs', 'users', 'id',  'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_staf',  'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('simta_mengelola_surat');

        // Tabel simta_pengajuanbimbingan
        $this->forge->addField([
            'id_pengajuanbimbingan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_mhs' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'null' => true,
            ],
            'id_staf' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'null' => true,
            ],
            'lokasi_bimbingan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'hasil_bimbingan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status_ajuan' => [
                'type' => 'ENUM',
                'constraint' => ['DITERIMA', 'DITOLAK', 'PENDING'],
                'default' => 'PENDING',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'update_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'waktu_bimbingan' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'jadwal_bimbingan' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'agenda' => [
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => true,
            ],
            'tracking' => [
                'type' => 'ENUM',
                'constraint' => [
                    'Ajuan Judul',
                    'Ajuan Bimbingan Ujian Proposal',
                    'Ajuan Ujian Proposal',
                    'Revisi Ujian Proposal',
                    'Pengumpulan Revisi',
                    'Ajuan Bimbingan Seminar Hasil',
                    'Ajuan Seminar Hasil',
                    'Revisi Seminar Hasil',
                    'Ajuan Bimbingan Sidang',
                    'Ajuan Sidang',
                    'Revisi Sidang',
                    'Unggah Syarat Kelulusan',
                ],
                'null' => true,
            ],
            'id_accjudul' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_pengajuanbimbingan', true);
        $this->forge->addForeignKey('id_mhs',  'users', 'id',  'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_staf', 'users', 'id',  'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_accjudul', 'simta_acc_judul', 'id_accjudul', 'SET NULL', 'CASCADE');
        $this->forge->createTable('simta_pengajuanbimbingan');

        // Tabel simta_pengajuanjudul
        $this->forge->addField([
            'id_pengajuanjudul' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_mhs' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'null' => true,
            ],
            'nama_judul1' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'deskripsi_sistem1' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'nama_judul2' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'deskripsi_sistem2' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'nama_judul3' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'deskripsi_sistem3' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'catatan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'status_pj' => [
                'type' => 'ENUM',
                'constraint' => ['DIAJUKAN', 'DISETUJUI', 'DISETUJUI DENGAN REVISI', 'DITOLAK'],
                'default' => 'DIAJUKAN',
            ],
            'created_at' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'id_timeline' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'id_rekom_dospem1' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'null' => true,
            ],
            'id_rekom_dospem2' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'null' => true,
            ],
            'id_dospem' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'updated_by' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'acc_judul' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'acc_deskripsi' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_pengajuanjudul', true);
        $this->forge->addForeignKey('id_mhs', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_rekom_dospem1', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_rekom_dospem2', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('simta_pengajuanjudul');

        // Tabel simta_pengajuan_seminarhasil
        $this->forge->addField([
            'id_seminarhasil' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
            ],
            'id_mhs' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'null' => true,
            ],
            'id_dospem' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'created_at' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'update_at' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'id_accjudul' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'abstrak' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => true,
            ],
            'revisi_laporan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'laporan_ta' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'revisi_laporan_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'ajuan_tgl_ujian' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'status_pengajuan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'id_penguji1' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'id_penguji2' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
                
            ],
        ]);
        $this->forge->addKey('id_seminarhasil', true);
        $this->forge->addForeignKey('id_mhs',  'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_dospem', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_accjudul', 'simta_acc_judul', 'id_accjudul', 'SET NULL', 'CASCADE');
        $this->forge->createTable('simta_pengajuan_seminarhasil');

        // Tabel simta_pengajuan_sidang
        $this->forge->addField([
            'id_sidang' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
            ],
            'id_mhs' => [
                'type' => 'INT',
                'null' => true,
                'unsigned' => true,
                
            ],
            'id_dospem' => [
                'type' => 'INT',
                'constraint' => '50',
                'null' => true,
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'update_at' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'id_accjudul' => [
                'type' => 'INT',
                'null' => true,
                'unsigned' => true,
            ],
            'abstrak' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => true,
            ],
            'revisi_laporan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'laporan_ta' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'revisi_laporan_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'ajuan_tgl_ujian' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'status_pengajuan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'id_penguji1' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'id_penguji2' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'transkrip_nilai' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'beritaacara_kmm' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'surat_rekomendasi' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'krs' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_sidang', true);
        $this->forge->addForeignKey('id_mhs',  'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_accjudul', 'simta_acc_judul', 'id_accjudul', 'SET NULL', 'CASCADE');
        $this->forge->createTable('simta_pengajuan_sidang');

        
        // Tabel simta_pengajuan_ujianproposal
        $this->forge->addField([
            'id_ujianproposal' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'mahasiswa' => [
                'type' => 'INT',
                'constraint' => 100,
                'unsigned' => true,
                'null' => true,
            ],
            'id_dospem' => [
                'type' => 'INT',
                'constraint' => 50,
                'unsigned' => true,
                'null' => true,
            ],
            'judul_acc_id' => [
                'type' => 'INT',
                'constraint' => 50,
                'unsigned' => true,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'update_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'abstrak' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => true,
            ],
            'revisi_proposal' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'proposal_ta' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'revisi_proposal_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'ajuan_tgl_ujian' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'status_pengajuan' => [
                'type' => 'ENUM',
                'constraint' => ['PENDING', 'DITOLAK', 'DITERIMA', 'REVISI'],
                'default' => 'PENDING',
            ],
            'id_penguji1' => [
                'type' => 'INT',
                'constraint' => 100,
                'unsigned' => true,
                'null' => true,
            ],
            'id_penguji2' => [
                'type' => 'INT',
                'constraint' => 100,
                'unsigned' => true,
                'null' => true,
            ],
            'jadwal' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_ujianproposal', true);
        $this->forge->addForeignKey('mahasiswa',  'users', 'id',  'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_dospem', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_penguji1', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_penguji2', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('judul_acc_id', 'simta_acc_judul', 'id_accjudul', 'SET NULL', 'CASCADE');
        $this->forge->createTable('simta_pengajuan_ujianproposal');

    // Tabel simta_rilis_jadwal
    $this->forge->addField([
        'id_rilis_jadwal' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
            'auto_increment' => true,
        ],
        'ruangan' => [
            'type' => 'VARCHAR',
            'constraint' => '100',
            'null' => true,
        ],
        'jam_start' => [
            'type' => 'TIME',
            'null' => true,
        ],
        'jam_end' => [
            'type' => 'TIME',
            'null' => true,
        ],
        'tgl_ujian' => [
            'type' => 'DATE',
            'null' => true,
        ],
        'id_penguji1' => [
            'type' => 'INT',
            'unsigned' => true,
            'null' => true,
        ],
        'id_penguji2' => [
            'type' => 'INT',
            'unsigned' => true,
            'null' => true,
        ],
        'id_pengajuanujianpropo' => [
            'type' => 'INT',
            'null' => true,
            'unsigned' => true,
        ],
    ]);
    $this->forge->addKey('id_rilis_jadwal', true);
    $this->forge->addForeignKey('id_pengajuanujianpropo', 'simta_pengajuan_ujianproposal', 'id_ujianproposal', 'SET NULL', 'CASCADE');
    $this->forge->addForeignKey('id_penguji1', 'users', 'id', 'SET NULL', 'CASCADE');
    $this->forge->addForeignKey('id_penguji2', 'users', 'id', 'SET NULL', 'CASCADE');
    $this->forge->createTable('simta_rilis_jadwal');
    

        // Tabel simta_rilis_jadwal_semhas
        $this->forge->addField([
            'id_rilis_jadwal_semhas' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'ruangan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'jam_start' => [
                'type' => 'TIME',
            ],
            'jam_end' => [
                'type' => 'TIME',
            ],
            'tgl_ujian' => [
                'type' => 'DATE',
            ],
            'id_penguji1' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'id_penguji2' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'id_pengajuansemhas' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_rilis_jadwal_semhas', true);
        $this->forge->addForeignKey('id_pengajuansemhas', 'simta_pengajuan_seminarhasil', 'id_seminarhasil', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_penguji1', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_penguji2', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('simta_rilis_jadwal_semhas');

        // Tabel simta_rilis_jadwal_sidang
        $this->forge->addField([
            'id_rilis_jadwal_sidang' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'ruangan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'jam_start' => [
                'type' => 'TIME',
            ],
          'jam_end' => [
                'type' => 'TIME',
            ],
            'tgl_ujian' => [
                'type' => 'DATE',
            ],
            'id_penguji1' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'id_penguji2' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'id_penguji3' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'id_pengajuansidang' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'surat_undangan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'surat_tugas' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_rilis_jadwal_sidang', true);
        $this->forge->addForeignKey('id_pengajuansidang', 'simta_pengajuan_sidang', 'id_sidang', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_penguji1', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_penguji2', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_penguji3', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('simta_rilis_jadwal_sidang');


        // Tabel simta_penilaian_seminarhasil
        $this->forge->addField([
            'id_penilaian' => [
                'type' => 'INT',
                'constraint' => 50,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_staf' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 11,   
                'null' => true,
            ],
            'id_mhs' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 11,   
                'null' => true,
            ],
            'nilai_total' => [
                'type' => 'FLOAT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'id_rilis_jadwal' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 11,   
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_penilaian', true);
        $this->forge->addForeignKey('id_staf',  'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_mhs',  'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_rilis_jadwal', 'simta_rilis_jadwal', 'id_rilis_jadwal', 'SET NULL', 'CASCADE');
        $this->forge->createTable('simta_penilaian_seminarhasil');

        // Tabel simta_penilaian_seminarhasil_detail
        $this->forge->addField([
            'id_penilaian_detail' => [
                'type' => 'INT',
                'unsigned' => true,
                'constraint' => 50,
                'auto_increment' => true,
            ],
            'id_indikator' => [
                'type' => 'INT',
                'constraint' => 50,
                'null' => true,
                'unsigned' => true,
            ],
            'nilai' => [
                'type' => 'FLOAT',
                'null' => true,
            ],
            'id_penilaian_semhas' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('id_penilaian_detail', true);
        $this->forge->addForeignKey('id_indikator', 'simta_indikator_semhas', 'id_indikator', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_penilaian_semhas', 'simta_penilaian_seminarhasil', 'id_penilaian', 'SET NULL', 'CASCADE');
        $this->forge->createTable('simta_penilaian_seminarhasil_detail');

        // Tabel simta_penilaian_sidang
        $this->forge->addField([
            'id_penilaian' => [
                'type' => 'INT',
                'constraint' => 50,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_staf' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'id_mhs' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'nilai_total' => [
                'type' => 'FLOAT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'id_rilis_jadwal' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_penilaian', true);
        $this->forge->addForeignKey('id_staf',  'users', 'id',  'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_mhs', 'users', 'id',  'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_rilis_jadwal', 'simta_rilis_jadwal_sidang', 'id_rilis_jadwal_sidang', 'SET NULL', 'CASCADE');
        $this->forge->createTable('simta_penilaian_sidang');

        // Tabel simta_penilaian_sidang_detail
        $this->forge->addField([
            'id_penilaian_detail' => [
                'type' => 'INT',
                'constraint' => 50,
                'auto_increment' => true,
                'unsigned' => true,
            ],
            'id_indikator' => [
                'type' => 'INT',
                'constraint' => 50,
                'null' => true,
                'unsigned' => true,
            ],
            'nilai' => [
                'type' => 'FLOAT',
                'null' => true,
            ],
            'id_penilaian_sidang' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('id_penilaian_detail', true);
        $this->forge->addForeignKey('id_indikator', 'simta_indikator_sidang', 'id_indikator', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_penilaian_sidang', 'simta_penilaian_sidang', 'id_penilaian', 'SET NULL', 'CASCADE');
        $this->forge->createTable('simta_penilaian_sidang_detail');
    
        // Tabel simta_penilaian_ujianproposal
        $this->forge->addField([
            'id_penilaian' => [
                'type' => 'INT',
                'constraint' => 50,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_staf' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'id_mhs' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'nilai_total' => [
                'type' => 'FLOAT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'id_rilis_jadwal' => [
                'type' => 'INT',
                'null' => true,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('id_penilaian', true);
        $this->forge->addForeignKey('id_staf', 'users', 'id',  'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_mhs',  'users', 'id',  'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_rilis_jadwal', 'simta_rilis_jadwal', 'id_rilis_jadwal', 'SET NULL', 'CASCADE');
        $this->forge->createTable('simta_penilaian_ujianproposal');

        // Tabel simta_penilaian_ujianproposal_detail
        $this->forge->addField([
            'id_penilaian_detail' => [
                'type' => 'INT',
                'constraint' => 50,
                'auto_increment' => true,
                'unsigned' => true,
            ],
            'id_indikator' => [
                'type' => 'INT',
                'constraint' => 50,
                'unsigned' => true,
                'null' => true,
            ],
            'nilai' => [
                'type' => 'FLOAT',
                'null' => true,
            ],
            'id_penilaian_pro' => [
                'type' => 'INT',
                'constraint' => 50,
                'null' => true,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('id_penilaian_detail', true);
        $this->forge->addForeignKey('id_indikator', 'simta_indikator', 'id_indikator', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_penilaian_pro', 'simta_penilaian_ujianproposal', 'id_penilaian', 'SET NULL', 'CASCADE');
        $this->forge->createTable('simta_penilaian_ujianproposal_detail');


        // Tabel simta_syarat_kelulusan
        $this->forge->addField([
            'id_syarat_kelulusan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'poster' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'lembar_pengesahan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'lembar_persetujuan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'bukti_pelunasan_ukt' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'surat_bebas_lab' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'aplikasi_ta' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'laporan_ta_word' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'laporan_ta_pdf' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'ktp' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'id_mhs' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'id_staf' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'status_syarat' => [
                'type' => 'ENUM',
                'constraint' => ['Sedang Diproses', 'Validasi', '', ''],
                'default' => 'Sedang Diproses',
            ],
            'catatan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_syarat_kelulusan', true);
        $this->forge->addForeignKey('id_mhs', 'users', 'id',  'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_staf',  'users', 'id',  'SET NULL', 'CASCADE');
        $this->forge->createTable('simta_syarat_kelulusan');

        // Tabel simta_timeline
        $this->forge->addField([
            'id_timeline' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_kegiatan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'mulai' => [
                'type' => 'DATE',
            ],
            'akhir' => [
                'type' => 'DATE',
            ],
            'tahun' => [
                'type' => 'INT',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addKey('id_timeline', true);
        $this->forge->createTable('simta_timeline');

        // Tabel staf
        $this->forge->addField([
            'id_staf' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nip' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'no_telp' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'jenis' => [
                'type' => 'ENUM',
                'constraint' => ['Admin', 'Dosen', 'Koordinator'],
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['0', '1'],
            ],
        ]);
        $this->forge->addKey('id_staf', true);
        $this->forge->addForeignKey('id_user', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('staf');

    }
    public function down()
    {
        // Drop tables in reverse order
        $this->forge->dropTable('users');
        $this->forge->dropTable('staf');
        $this->forge->dropTable('simta_timeline');
        $this->forge->dropTable('simta_syarat_kelulusan');
        $this->forge->dropTable('simta_rilis_jadwal_sidang');
        $this->forge->dropTable('simta_rilis_jadwal_semhas');
        $this->forge->dropTable('simta_rilis_jadwal');
        $this->forge->dropTable('simta_penilaian_ujianproposal_detail');
        $this->forge->dropTable('simta_penilaian_ujianproposal');
        $this->forge->dropTable('simta_penilaian_sidang_detail');
        $this->forge->dropTable('simta_penilaian_sidang');
        $this->forge->dropTable('simta_penilaian_seminarhasil_detail');
        $this->forge->dropTable('simta_penilaian_seminarhasil');
        $this->forge->dropTable('simta_pengajuan_ujianproposal');
        $this->forge->dropTable('simta_pengajuan_sidang');
        $this->forge->dropTable('simta_pengajuan_seminarhasil');
        $this->forge->dropTable('simta_pengajuanjudul');
        $this->forge->dropTable('simta_pengajuanbimbingan');
        $this->forge->dropTable('simta_mengelola_surat');
        $this->forge->dropTable('simta_master_mahasiswa');
        $this->forge->dropTable('simta_masterstaf');
        $this->forge->dropTable('simta_mahasiswa_bimbingan');
        $this->forge->dropTable('simta_kriteria_sidang');
        $this->forge->dropTable('simta_kriteria_semhas');
        $this->forge->dropTable('simta_kriteria');
        $this->forge->dropTable('simta_indikator_sidang');
        $this->forge->dropTable('simta_indikator_semhas');
        $this->forge->dropTable('simta_indikator');
        $this->forge->dropTable('simta_bobot');
        $this->forge->dropTable('simta_berkas');
        $this->forge->dropTable('simta_acc_judul');
        $this->forge->dropTable('mata_kuliah');
        $this->forge->dropTable('mahasiswa');
        $this->forge->dropTable('auth_permissions');
        $this->forge->dropTable('auth_groups_users');
        $this->forge->dropTable('auth_groups_permissions');
        $this->forge->dropTable('auth_groups');
    }
}