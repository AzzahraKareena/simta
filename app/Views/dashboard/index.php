<?= $this->extend('layouts\main') ?>

<?= $this->section('title') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="card card-bordered">
    <div class="card-header">
        <h3 class="card-title" style="font-weight: bold;">Dashboard</h3>
    </div>
    <div class="card-body">
        <div id="kt_apexcharts_6" style="height: 350px;"></div>
        <canvas id="barChart" style="height: 300px; margin-top: 20px;"></canvas>
    </div>
</div>

<!-- Load necessary JavaScript libraries -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
<script src="path/to/KTUtil.js"></script> <!-- Ensure KTUtil is loaded -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js library -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var element = document.getElementById('kt_apexcharts_6');

        var height = parseInt(KTUtil.css(element, 'height'));

        // Ubah warna grafik
        var baseColor = '#2196f3'; // Biru
        var secondaryColor = '#ff9800'; // Oranye
        var baseLightColor = '#9c27b0'; // Ungu
        var sidangColor = '#006400'; // Hijau Tua

        var options = {
            series: [
                {
                    name: 'Seminar Proposal',
                    data: [
                        {
                            x: 'Seminar Proposal',
                            y: [
                                new Date('2024-02-06').getTime(),
                                new Date('2024-02-20').getTime()
                            ]
                        },
                        // Data Seminar Proposal lainnya
                    ]
                },
                {
                    name: 'Seminar KMM',
                    data: [
                        {
                            x: 'Seminar KMM',
                            y: [
                                new Date('2024-04-02').getTime(),
                                new Date('2024-04-30').getTime()
                            ]
                        },
                        
                    ]
                },
                {
                    name: 'Seminar Hasil',
                    data: [
                        {
                            x: 'Seminar Hasil',
                            y: [
                                new Date('2024-06-01').getTime(),
                                new Date('2024-06-15').getTime()
                            ]
                        },
                    ]
                },
                {
                    name: 'Sidang Tugas Akhir',
                    data: [
                        {
                            x: 'Sidang Tugas Akhir',
                            y: [
                                new Date('2024-06-06').getTime(),
                                new Date('2024-07-28').getTime()
                            ]
                        },
                    ]
                }
            ],
            chart: {
                type: 'rangeBar',
                fontFamily: 'inherit',
                height: height,
                toolbar: {
                    show: false
                }
            },
            colors: [baseColor, secondaryColor, baseLightColor, sidangColor],
            plotOptions: {
                bar: {
                    horizontal: true,
                    barHeight: '80%'
                }
            },
            xaxis: {
                type: 'datetime'
            },
            stroke: {
                width: 1
            },
            fill: {
                type: 'solid',
                opacity: 1
            },
            legend: {
                position: 'top',
                horizontalAlign: 'left'
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();

        // Data untuk bar chart
        var barData = {
            labels: ['Pemrograman', 'Jaringan Komputer', 'Hardware'], // Diurutkan sesuai jumlah
            datasets: [{
                label: 'Jumlah Judul TA Berdasarkan Kompetensi',
                backgroundColor: 'rgba(54, 162, 235, 0.2)', // Warna biru muda
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                data: [80, 65, 40] // Sesuaikan jumlah dengan urutan label
            }]
        };

        var barChart = new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: barData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Statistik Kompetensi TA',
                        font: {
                            size: 20,
                            weight: 'bold'
                        }
                    }
                }
            }
        });
    });
</script>
<?= $this->endSection() ?>
