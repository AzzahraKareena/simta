<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lembar Persetujuan</title>
</head>
<body>
    <p style="text-align: center; font-weight: bold;">LEMBAR PERSETUJUAN SEMINAR HASIL TA <br> D3 TEKNIK INFORMATIKA MADIUN <br> SEKOLAH VOKASI UNS</p>
    <p>Yang bertanda tangan di bawah ini selaku pembimbing Tugas Akhir, menerangkan bahwa:</p>
        <table width="100%">
            <tbody>
                <tr>
                    <td width="25%">Nama Mahasiswa</td>
                    <td width="2%">:</td>
                    <td width="73%"><?= $semhas['nama_mhs'] ?? ''; ?></td>
                </tr>
                <tr>
                    <td>NIM</td>
                    <td>:</td>
                    <td><?= $semhas['nim']; ?></td>
                </tr>
                <tr>
                    <td>Judul Tugas Akhir</td>
                    <td>:</td>
                    <td><?= $semhas['judul']; ?></td>
                </tr>
            </tbody>
        </table>
    <p>Telah dinyatakan layak, memenuhi segala ketentuan dan aturan yang berlaku agar dapat dilanjutkan kepada tahap Seminar Hasil.</p>
    
    <table width="100%">
        <tbody>
            <tr>
                <td width="45%">
                </td>
                <td width="10%"></td>
                <td width="45%">
                    <span>Disetujui</span><br>
                    <span>Pada Tanggal : .................................................</span><br><br>
                    <span>Pembimbing TA</span><br><br><br><br><br>
                    <span><?= $semhas['nama_pembimbing']; ?></span>
                    <hr style="border: none; height: 1px;">
                    <span>NIP. <?= $semhas['nip_pembimbing']; ?></span><br>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>