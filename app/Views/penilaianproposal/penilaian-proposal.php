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
                <td width="73%"><?= $mhs['mhs_nama'] ?></td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>:</td>
                <td width="73%"><?= $mhs['nim'] ?></td>
            </tr>
            <tr>
                <td>Jurusan / Program Studi</td>
                <td>:</td>
                <td width="73%"><?= $mhs['prodi'] ?></td>
            </tr>
            <tr>
                <td>Judul Proposal TA</td>
                <td>:</td>
                <td width="73%"><?= $mhs['judul_judul_acc'] ?></td>
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
            foreach ($mhs['nilai'] as $nilai => $data): ?>
                <tr>
                    <td rowspan="<?= count($data['indi']) ?>"><?= $no ?></td> <!-- Counter -->
                    <td rowspan="<?= count($data['indi']) ?>"><?= $data['kri'] ?></td>
                    <?php 
                    $first = true;
                    foreach ($data['indi'] as $indi): ?>
                        <?php if (!$first): ?>
                            <tr>
                        <?php endif; ?>
                        <td><?= isset($indi['indi']) ? $indi['indi'] : 'N/A' ?></td>
                        <td><?= isset($indi['indi_nilai']) ? $indi['indi_nilai'] : 'N/A' ?></td>
                        <td><?= isset($indi['nilai']) ? $indi['nilai'] : 'N/A' ?></td>
                        </tr>
                    <?php 
                    $first = false;
                    endforeach; 
                    $no++; // Increment counter
                    ?>
            <?php endforeach ?>
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
                <th>Madiun, <?= $mhs['date']; ?> <?= $mhs['month']; ?> <?= $mhs['year']; ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> <?= $mhs['penguji']; ?></td>
            </tr>
            <br><br><br>
            <tr>
                <td>_________________</td>
            </tr>
            <tr>
                <td>NIP. <?= $mhs['nip_penguji']; ?></td>
            </tr>
        </tbody>
</table>

</body>
</html>