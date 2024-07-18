<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara</title>
</head>
<body>
    <p style="text-align: center; font-weight: bold;">LEMBAR REVISI TUGAS AKHIR <br> D3 TEKNIK INFORMATIKA MADIUN <br> SEKOLAH VOKASI UNS</p><br>
    <div>
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
                    <td>Usulan Judul</td>
                    <td>:</td>
                    <td><?= $jadwal['judul']; ?></td>
                </tr>
                <tr>
                    <td>Penguji</td>
                    <td>:</td>
                    <td><?= $jadwal['penguji1']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        <table border="1" cellspacing="0" cellpadding="2" width="100%">
            <thead style="vertical-align: middle;">
                <tr>
                    <th width="10%" style="text-align: center;">No.</th>
                    <th width="60%" style="text-align: center;">Catatan Revisi</th>
                    <th width="30%" style="text-align: center;">Tanda Tangan Penguji Sebelum Revisi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="10%"><br><br><br><br></td>
                    <td width="60%"></td>
                    <td width="30%"></td>
                </tr>
                <tr>
                    <td width="10%"><br><br><br><br></td>
                    <td width="60%"></td>
                    <td width="30%"></td>
                </tr>
                <tr>
                    <td width="10%"><br><br><br><br></td>
                    <td width="60%"></td>
                    <td width="30%"></td>
                </tr>
                <tr>
                    <td width="10%"><br><br><br><br></td>
                    <td width="60%"></td>
                    <td width="30%"></td>
                </tr>
                <tr>
                    <td width="10%"><br><br><br><br></td>
                    <td width="60%"></td>
                    <td width="30%"></td>
                </tr>
            </tbody>
        </table><br><br>
        <table width="100%">
            <tbody>
                <tr>
                    <td width="50%"></td>
                    <td width="50%">
                        <span>Madiun, <?= $date; ?> <?= $month; ?> <?= $year; ?></span><br>
                        <span>Menyatakan telah direvisi *)</span><br>
                        <span>Penguji 1</span><br><br><br><br>
                        <span>Nama : <?= $jadwal['penguji1']; ?></span><br>
                        <span>NIP. <?= $jadwal['nip_penguji1']; ?></span>
                    </td>
                </tr>
            </tbody>
        </table>
        <span style="font-size: small;">*) Di tandatangani setelah revisi selesai</span>
    </div>
</body>
</html>