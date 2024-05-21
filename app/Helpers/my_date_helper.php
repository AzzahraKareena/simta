<?php 

if (!function_exists('convert_datetime_to_indonesian')) {
    function convert_datetime_to_indonesian($datetime) {
        $days = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];

        $months = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];

        $day = date('l', strtotime($datetime)); // Mendapatkan nama hari dalam bahasa Inggris
        $date = date('d', strtotime($datetime)); // Mendapatkan tanggal
        $month = date('m', strtotime($datetime)); // Mendapatkan bulan dalam angka
        $year = date('Y', strtotime($datetime)); // Mendapatkan tahun

        return [
            'day' => $days[$day],
            'date' => $date,
            'month' => $months[$month],
            'year' => $year
        ];
    }
}

?>