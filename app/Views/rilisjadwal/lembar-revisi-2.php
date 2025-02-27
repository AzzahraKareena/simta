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
                    <td><?= $jadwal['penguji2']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    < <div>
        <table border="1" cellspacing="0" cellpadding="2" width="100%">
            <thead style="vertical-align: middle;">
                <tr>
                    <th width="10%" style="text-align: center;">No.</th>
                    <th width="60%" style="text-align: center;">Catatan Revisi</th>
                    <th width="30%" style="text-align: center;">Tanda Tangan Penguji Sebelum Revisi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($jadwal['catatan_revisi_penguji2'])): ?>
                    <?php $revisions = explode(" | ", $jadwal['catatan_revisi_penguji2']); ?>
                    <?php foreach ($revisions as $index => $revision): ?>
                        <tr>
                        <td width="10%" style="text-align: center;"><?= $index + 1; ?></td>
                            <td  width="60%"><?= $revision; ?></td>
                            <td  width="30%"></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" style="text-align: center;">Tidak ada catatan revisi.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table><br><br>
        <table width="100%">
            <tbody>
                <tr>
                    <td width="50%"></td>
                    <td width="50%">
                        <span>Madiun, <?= $date; ?> <?= $month; ?> <?= $year; ?></span><br>
                        <span>Menyatakan telah direvisi *)</span><br>
                        <span>Penguji 2</span><br><br><br><br>
                        <span>Nama : <?= $jadwal['penguji2']; ?></span><br>
                        <span>NIP. <?= $jadwal['nip_penguji2']; ?></span>
                    </td>
                </tr>
            </tbody>
        </table>
        <span style="font-size: small;">*) Di tandatangani setelah revisi selesai</span>
    </div>
</body>
</html>