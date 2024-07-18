<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lembar Persetujuan</title>
</head>
<body>
    <p style="text-align: center; font-weight: bold;">SURAT REKOMENDASI SIDANG TA <br> D3 TEKNIK INFORMATIKA MADIUN <br> SEKOLAH VOKASI UNS</p>
    <p>Dosen Pembimbing Tugas Akhir Jurusan D3 Teknik Informatika Madiun Sekolah Vokasi UNS :</p>
        <table width="100%">
            <tbody>
                <tr>
                    <td width="25%">Nama</td>
                    <td width="2%">:</td>
                    <td width="73%"><?= $rekom['nama_pembimbing']; ?></td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td>:</td>
                    <td><?= $rekom['nip_pembimbing']; ?></td>
                </tr>
            </tbody>
        </table>
    <p>Dengan ini merekomendasikan kepada mahasiswa berikut ini :</p>
    <table width="100%">
        <tbody>
            <tr>
                <td width="25%">Nama Mahasiswa</td>
                <td width="2%">:</td>
                <td width="73%"><?= $rekom['nama_mhs']; ?></td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>:</td>
                <td><?= $rekom['nim']; ?></td>
            </tr>
            <tr>
                <td>Judul Tugas Akhir</td>
                <td>:</td>
                <td><?= $rekom['judul']; ?></td>
            </tr>
        </tbody>
    </table>
    <p>Untuk mendaftar dan mengikuti Sidang Tugas Akhir di Jurusan D3 Teknik Informatika Madiun Sekolah Vokasi UNS. <br>Demikian surat ini dibuat agar dapat dipergunakan sebagaimana mestinya.</p>
    <p></p>
    <table width="100%">
        <tbody>
            <tr>
                <td width="45%">
                </td>
                <td width="10%"></td>
                <td width="45%">
                    <span>Madiun, ................................................. <?= date('Y') ?></span><br><br>
                    <span>Pembimbing TA</span><br><br><br><br><br>
                    <span><?= $rekom['nama_pembimbing']; ?></span>
                    <hr style="border: none; height: 1px;">
                    <span>NIP. <?= $rekom['nip_pembimbing']; ?></span><br>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>