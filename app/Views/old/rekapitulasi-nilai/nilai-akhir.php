<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lembar Persetujuan</title>
</head>
<body>
    <p style="text-align: center; font-weight: bold;">NILAI TUGAS AKHIR</p>
        <table width="100%" cellpadding="2">
            <tbody>
                <tr>
                    <td width="25%">Nama</td>
                    <td width="2%">:</td>
                    <td width="73%"><?= $rekap['mahasiswa']['nama_mhs']; ?></td>
                </tr>
                <tr>
                    <td>Nomor Induk Mahasiswa</td>
                    <td>:</td>
                    <td><?= $rekap['mahasiswa']['nim']; ?></td>
                </tr>
                <tr>
                    <td>Program Studi</td>
                    <td>:</td>
                    <td><?= $rekap['mahasiswa']['prodi']; ?></td>
                </tr>
                <tr>
                    <td>Hari/Tanggal Ujian</td>
                    <td>:</td>
                    <td><?= $day ?>, <?= $date; ?> <?= $month; ?> <?= $year; ?></td>
                </tr>
                <tr>
                    <td>Mulai Pukul</td>
                    <td>:</td>
                    <td><?= $rekap['mahasiswa']['jam_start'] ?></td>
                </tr>
            </tbody>
        </table>
    <p style="text-align: center; font-weight: bold;"><?= $rekap['mahasiswa']['judul']; ?></p>
    <table width="100%" border="1" cellpadding="4">
        <thead>
            <tr>
                <th style="text-align: center; font-weight: bold;">KOMPONEN</th>
                <th style="text-align: center; font-weight: bold;">BOBOT</th>
                <th style="text-align: center; font-weight: bold;">NILAI</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Nilai Proposal</td>
                <td style="text-align: center;">10</td>
                <td style="text-align: center;"><?= $rekap['nilaiProposal']; ?></td>
            </tr>
            <tr>
                <td>Nilai Seminar Hasil TA</td>
                <td style="text-align: center;">30</td>
                <td style="text-align: center;"><?= $rekap['nilaiSeminar']; ?></td>
            </tr>
            <tr>
                <td>Rata-rata Nilai Ujian TA</td>
                <td style="text-align: center;">60</td>
                <td style="text-align: center;"><?= $rekap['nilaiSidang']; ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">TOTAL</td>
                <td style="text-align: center; font-weight: bold;">100</td>
                <td style="font-weight: bold; text-align: center;"><?= $rekap['nilaiAkhir']; ?></td>
            </tr>
        </tbody>
    </table>
    <div></div>
    <div></div>
    <table width="100%">
        <tbody>
            <tr>
                <td width="45%">
                    <span style="display: none;">Madiun, ................................................. <?= date('Y') ?></span><br><br>
                    <span>Mengetahui,</span><br>
                    <span>Kepala Program Studi</span><br><br><br><br><br>
                    <span>Darmawan Lahru Riatma, S.Kom., M.M.T</span>
                    <hr style="border: none; height: 1px;">
                    <span>NIP. 1991091420200801</span><br>
                </td>
                <td width="10%"></td>
                <td width="45%">
                    <span>Madiun, ................................................. <?= date('Y') ?></span><br><br>
                    <span style="display: none;">_________</span><br>
                    <span>Divisi Tugas Akhir</span><br><br><br><br><br>
                    <span>Masbahah, S.Pd., M.Pd.</span>
                    <hr style="border: none; height: 1px;">
                    <span>NIP. 1987052520200801</span><br>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>