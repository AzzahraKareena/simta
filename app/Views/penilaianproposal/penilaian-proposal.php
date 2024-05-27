<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara</title>
</head>
<body>
    <table width="100%" celllpadding="5">
        <tbody>
            <tr>
                <td width="25%">Nama Mahasiswa</td>
                <td width="2%">:</td>
                <td width="73%"><?= $nama ?? ''; ?></td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>:</td>
                <td><?= $nim; ?></td>
            </tr>
            <tr>
                <td>Jurusan / Program Studi</td>
                <td>:</td>
                <td><?= $prodi; ?></td>
            </tr>
            <tr>
                <td>Judul Proposal TA</td>
                <td>:</td>
                <td><?= $prodi; ?></td>
            </tr>
        </tbody>
    </table>
    <br><br>

<table width="100%" cellpadding="5" border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Kriteria Penilaian</th>
            <th>Indikator Penilaian</th>
            <th>Nilai Maksimal</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1; // Inisialisasi counter
        foreach ($indikator as $id_kriteria => $data): ?>
            <tr>
                <td rowspan="<?= count($data['indikator']) ?>"><?= $no ?></td> <!-- Counter -->
                <td rowspan="<?= count($data['indikator']) ?>"><?= $data['kriteria_nama_kriteria'] ?></td>
                <?php 
                $first = true;
                foreach ($data['indikator'] as $indi): ?>
                    <?php if (!$first): ?>
                        <tr>
                    <?php endif; ?>
                    <td><?= isset($indi['nama']) ? $indi['nama'] : 'N/A' ?></td>
                    <td><?= isset($indi['max_nilai']) ? $indi['max_nilai'] : 'N/A' ?></td>
                    <td>10</td>
            </tr>
                <?php 
                $first = false;
                endforeach; 
                $no++; // Increment counter
                ?>
        <?php endforeach ?>
        <tr>
            <td colspan="4">Total</td>
        </tr>
    </tbody>
</table>
<br> <br>
<table width="100%" cellpadding="1">
        <thead>
            <tr>
                <th>Catatan :</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>___________________________________________________________________________________</td>
            </tr>
            <tr>
                <td>___________________________________________________________________________________</td>
            </tr>
            <tr>
                <td>___________________________________________________________________________________</td>
            </tr>
        </tbody>
</table>
<br> <br>
<table width="105mm" align="left" cellpadding="1" border="1">
        <thead>
            <tr>
                <th>Rentang Nilai</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>>= 85</td>
                <td>Layak dengan huruf mutu A</td>
            </tr>
            <tr>
                <td>80-84</td>
                <td>Layak dengan huruf mutu A-</td>
            </tr>
            <tr>
                <td>75-79</td>
                <td>Layak dengan huruf mutu B+</td>
            </tr>
            <tr>
                <td>70-74</td>
                <td>Layak dengan huruf mutu B</td>
            </tr>
            <tr>
                <td>65-69</td>
                <td>Layak dengan huruf mutu C+</td>
            </tr>
            <tr>
                <td>=< 59</td>
                <td>Tidak Layak</td>
            </tr>
        </tbody>
</table>
<br> <br>
<table width="100%" align="right" cellpadding="1">
        <thead>
            <tr>
                <th>Madiun, <?= $date; ?> <?= $month; ?> <?= $year; ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Anggota Penguji</td>
            </tr>
            <br><br><br>
            <tr>
                <td>_________________</td>
            </tr>
            <tr>
                <td>NIP.</td>
            </tr>
        </tbody>
</table>

</body>
</html>