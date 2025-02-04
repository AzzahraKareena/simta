<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Session\Session;

class ReminderController extends Controller
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $db = \Config\Database::connect();

        // Mendapatkan data mahasiswa bimbingan
        $builderBimbingan = $db->table('simta_mahasiswa_bimbingan');
        $builderBimbingan->where('judul_acc_id', 28); // Hanya mengambil data dengan judul_acc_id = 28
        $bimbingan = $builderBimbingan->get()->getResult();

        log_message('info', 'Jumlah data bimbingan yang ditemukan: ' . count($bimbingan));

        $notified_numbers = []; // Untuk menyimpan nomor yang sudah diberi notifikasi

        $alert_message = ''; // Untuk menyimpan pesan alert
        $alert_type = 'success'; // Default type untuk SweetAlert2

        if (count($bimbingan) > 0) {
            foreach ($bimbingan as $track) {
                $judul_acc_id = $track->judul_acc_id;
                $tracking = $track->tracking;

                // Mendapatkan mhs_id berdasarkan judul_acc_id
                $builderAccJudul = $db->table('simta_acc_judul');
                $builderAccJudul->where('id_accjudul', $judul_acc_id);
                $accJudul = $builderAccJudul->get()->getRow();

                if ($accJudul) {
                    $mhs_id = $accJudul->mhs_id;

                    // Mendapatkan data user berdasarkan mhs_id
                    $builderUser = $db->table('users');
                    $builderUser->where('id', $mhs_id);
                    $user = $builderUser->get()->getRow();

                    if ($user) {
                        $builderMahasiswa = $db->table('mahasiswa');
                        $builderMahasiswa->where('id_user', $user->id);
                        $mahasiswa = $builderMahasiswa->get()->getRow();

                        if ($mahasiswa) {
                            $id_mhs = $mahasiswa->id_mhs;
                            $nama = $user->nama;
                            $no_telp = $mahasiswa->no_telp;

                            // Pastikan nomor telepon belum diberi notifikasi
                            if (!in_array($no_telp, $notified_numbers)) {
                                // Mendapatkan tanggal hari ini
                                $tanggal_hari_ini = date('Y-m-d');

                                // Query untuk mengambil data timeline berdasarkan tahun berjalan
                                $builderTimeline = $db->table('simta_timeline');
                                $builderTimeline->where('mulai <=', $tanggal_hari_ini);
                                $builderTimeline->where('akhir >=', $tanggal_hari_ini);
                                $timeline = $builderTimeline->get()->getResult();

                                $tahapan_sekarang = '';
                                $tanggal_end_tahapan_sekarang = '';

                                if (count($timeline) > 0) {
                                    foreach ($timeline as $row_timeline) {
                                        $tahapan_sekarang = $row_timeline->nama_kegiatan;
                                        $tanggal_end_tahapan_sekarang = $row_timeline->akhir;
                                    }
                                } else {
                                    log_message('info', 'Tidak ada tahapan yang berlaku untuk tanggal hari ini.');
                                    continue; // Jika tidak ada tahapan yang berlaku, lanjut ke mahasiswa berikutnya
                                }

                                // Kirim pesan
                                $message = "Hallo $nama,\n\n";
                                $message .= "Status Anda saat ini: $tracking.\n";
                                $message .= "Segera selesaikan semua tahapan $tahapan_sekarang.\n";
                                $message .= "Deadline ajuan $tahapan_sekarang adalah pada tanggal $tanggal_end_tahapan_sekarang.\n\n";
                                $message .= "Salam,\n";
                                $message .= "Koor TA";

                                $token = "8Kh#Q+RadpkRxc8qXRX_";
                                $response = $this->send_message($no_telp, $message, $token);

                                $responseData = json_decode($response, true); // Mengubah JSON ke array

                                if (isset($responseData['status']) && $responseData['status'] === false) {
                                    $alert_message .= "Pesan untuk $nama ($no_telp): Gagal dikirim. Error: {$responseData['reason']}<br>Status tracking: $tracking<br>";
                                    $alert_type = 'error'; // Mengatur tipe alert ke 'error'
                                } else {
                                    $alert_message .= "Pesan untuk $nama ($no_telp): Berhasil dikirim.<br>Status tracking: $tracking<br>";
                                }

                                // Tambahkan nomor telepon ke daftar yang sudah diberi notifikasi
                                $notified_numbers[] = $no_telp;

                            } else {
                                log_message('info', "Pesan sudah dikirim ke nomor $no_telp. Skip pengiriman.");
                            }
                        } else {
                            // Log jika data mahasiswa tidak ditemukan
                            log_message('error', "Mahasiswa dengan ID User $mhs_id tidak ditemukan.");
                        }
                    } else {
                        // Log jika data user tidak ditemukan
                        log_message('error', "User dengan ID $mhs_id tidak ditemukan.");
                    }
                } else {
                    // Log jika data acc_judul tidak ditemukan
                    log_message('error', "Acc Judul dengan ID $judul_acc_id tidak ditemukan.");
                }
            }
        } else {
            $alert_message = "Data mahasiswa bimbingan tidak ditemukan.";
            $alert_type = 'info'; // Mengatur tipe alert ke 'info'
        }

        // Set session alert untuk ditampilkan di view
        $this->session->setFlashdata('alert_message', (string) $alert_message);
        $this->session->setFlashdata('alert_type', $alert_type);

        // Redirect ke halaman tracking setelah proses selesai
        return redirect()->to('/tracking');
    }

    // integrasi fonnte
    private function send_message($no_telp, $message, $token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $no_telp,
                'message' => $message,
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token"
            ),
            CURLOPT_SSL_VERIFYPEER => false, 
        ));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            curl_close($curl);
            return json_encode(['status' => false, 'reason' => $error_msg]);
        }
        curl_close($curl);
        return $response;
    }
}
