<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara</title>
</head>
<body>
    <p style="text-align: center; font-weight: bold;">BERITA ACARA UJIAN PROPOSAL TUGAS AKHIR <br> D3 TEKNIK INFORMATIKA MADIUN <br> SEKOLAH VOKASI UNS</p>
    <p>Pada hari ini <?= $day; ?>, Tanggal <?= $date; ?> Bulan <?= $month; ?> Tahun <?= $year; ?>, Telah dilaksanakan Ujian Proposal TA atas Mahasiswa :</p>
        <table width="100%">
            <tbody>
                <tr>
                    <td width="25%">Nama Mahasiswa</td>
                    <td width="2%">:</td>
                    <td width="73%"><?= $jadwal['nama_mhs'] ?? ''; ?></td>
                </tr>
                <tr>
                    <td>NIM</td>
                    <td>:</td>
                    <td><?= $jadwal['nim']; ?></td>
                </tr>
                <tr>
                    <td>Jurusan / Program Studi</td>
                    <td>:</td>
                    <td><?= $jadwal['prodi']; ?></td>
                </tr>
            </tbody>
        </table>
    <p>Yang bersangkutan telah menyusun dan mempertahankan Proposal TA yang diwajibkan padanya dengan Judul : <br> <b>"<?= $jadwal['judul']; ?>"</b></p>
    <div>Dihadapan Tim Penguji yang terdiri dari</div>
    <table width="100%" cellpadding="1">
        <tbody>
            <tr>
                <td width="3%">1</td>
                <td width="97%">___________________________________________ Sebagai Ketua Penguji</td>
            </tr>
            <tr>
                <td width="3%">2</td>
                <td width="97%">___________________________________________ Sebagai Anggota</td>
            </tr>
        </tbody>
    </table>
    <div>Dengan hasil</div>
   <table width="100%" cellpadding="1"> 
        <tbody>
            <tr>
                <td width="3%">1.</td>
                <td width="97%">Disetujui</td>
            </tr>
            <tr>
                <td width="3%">2.</td>
                <td width="97%">Disetujui dengan revisi (jangka waktu revisi paling lama ............ minggu)</td>
            </tr>
            <tr>
                <td width="3%">3.</td>
                <td width="97%">Disetujui dengan revisi (jangka waktu revisi paling lama ............ minggu) dan ujian TA ulang</td>
            </tr>
            <tr>
                <td width="3%">4.</td>
                <td width="97%">Tidak disetujui atau mengulang</td>
            </tr>
        </tbody>
    </table>
    <div></div>
    <span>Perbaikan yang harus dilakukan adalah : (jika diperlukan dapat ditulis dilembar terpisah)</span>
    <span>_____________________________________________________________________________________</span>
    <span>_____________________________________________________________________________________</span>
    <span>_____________________________________________________________________________________</span>

        <table width="100%">
            <tbody>
                <tr>
                    <td width="45%">
                        <span style="display: none;">_______</span><br>
                        <span>Ketua</span><br><br><br><br>
                        <hr style="border: none; height: 1px;">
                        <span>NIP.</span>
                    </td>
                    <td width="10%"></td>
                    <td width="45%">
                        <span>Madiun, ______________20__</span><br>
                        <span>Anggota</span><br><br><br><br>
                        <hr style="border: none; height: 1px;">
                        <span>NIP.</span><br>
                    </td>
                </tr>
                <tr>
                    <td width="30%"></td>
                    <td width="40%">
                        <span>Mengetahui,</span><br>
                        <span>a.n. Kepala Program Studi</span><br>
                        <span>D3 Teknik Informatika Madiun</span><br><br><br><br>
                        <span>Fendi Aji Purnomo, S.Si., M.Eng.</span>
                        <hr style="border: none; height: 1px; width: 200px;">
                        <span>NIP. 1984092620160901</span>
                    </td>
                    <td width="30%"></td>
                </tr>
            </tbody>
        </table>
</body>
</html>