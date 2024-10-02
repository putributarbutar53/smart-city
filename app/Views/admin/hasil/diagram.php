<!-- home.php -->
<?php $this->extend('admin/layout/main') ?>

<?php $this->section('content') ?>
<!-- Page content goes here -->

<div class="card mb-3">
    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?= base_url() ?>/assets/img/illustrations/corner-4.png);">
    </div>
    <!--/.bg-holder-->
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8">
                <h3 class="mb-0">Diagram Hasil : <?= $detail['nama'] ?? '-' ?></h3>
            </div>
        </div>
    </div>
</div>
<div class="card-deck">
    <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
        <div class="bg-holder bg-card" style="background-image:url(<?= base_url() ?>assets/img/illustrations/corner-1.png);">
        </div>
        <!--/.bg-holder-->

        <div class="card-body position-relative">
            <h6>Jenis Kelamin</h6>
            <canvas id="genderChart"></canvas>
        </div>
    </div>
    <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
        <div class="bg-holder bg-card" style="background-image:url(<?= base_url() ?>assets/img/illustrations/corner-2.png);">
        </div>
        <!--/.bg-holder-->

        <div class="card-body position-relative">
            <h6>Umur</h6>
            <canvas id="ageChart"></canvas>
        </div>
    </div>
    <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
        <div class="bg-holder bg-card" style="background-image:url(<?= base_url() ?>assets/img/illustrations/corner-3.png);">
        </div>
        <!--/.bg-holder-->

        <div class="card-body position-relative">
            <h6>Pekerjaan</h6>
            <canvas id="jobChart"></canvas>
        </div>
    </div>
</div>
<div class="row no-gutters">
    <div class="col-md-6 col-lg-4 col-xl-6 col-xxl-4 pr-md-2 mb-3">
        <div class="card h-md-100">
            <div class="card-header pb-0">
                <h6 class="mb-0 mt-2 d-flex align-items-center">Layanan
                </h6>
            </div>
            <div class="card-body pt-0">
                <canvas id="serviceChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-6 col-xxl-4 pl-md-2 pr-lg-2 pr-xl-0 pr-xxl-2 mb-3">
        <div class="card h-md-100">
            <div class="card-header pb-0">
                <h6 class="mb-0 mt-2">Sasaran</h6>
            </div>
            <div class="card-body pt-0">
                <canvas id="targetChart"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <div class="row flex-between-center">
            <div class="col-auto">
                <h5 class="mb-0">Kuesioner ini mengukur persepsi Anda sebagai masyarakat terhadap implementasi program smart city yang dilaksanakan oleh Pemerintah Daerah. Silakan Klik angka dengan skala nilai yang sesuai. (1 = “Tidak Setuju”; 2 = “kurang Setuju”; 3 = “Setuju”; dan 4 = “Sangat Setuju”; atau 9 bila tidak menjawab)</h5>
            </div>
        </div>
    </div>
    <div class="card-body">
        <?php
        $roman_numbers = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X'];
        ?>
        <?php if (!empty($sub_dimensi)): ?>
            <?php foreach ($sub_dimensi as $index => $dimensi): ?>
                <label style="font-weight: bold; margin-bottom: 2px; color: black;">
                    Sub Dimensi <?= isset($roman_numbers[$index]) ? esc($roman_numbers[$index]) : ($index + 1) ?>: <?= esc($dimensi['sub_dimensi']) ?>
                </label>
                <?php if (!empty($dimensi['pertanyaan'])): ?>
                    <?php $nomor = 1;
                    ?>
                    <?php foreach ($dimensi['pertanyaan'] as $pertanyaan): ?>
                        <div class="col-lg-12 mb-20">
                            <label style="margin-bottom: 2px;">
                                <?= $nomor++ ?>. <?= esc($pertanyaan['pertanyaan']) ?>
                            </label><br>
                            <div class="d-flex justify-content-center">
                                <div class="card mb-3" style="min-width: 20rem; max-width: 30rem; height: 350px; padding: 15px;">
                                    <div class="bg-holder bg-card" style="background-image: url(<?= base_url() ?>assets/img/illustrations/corner-2.png);">
                                    </div>
                                    <div class="card-body position-relative" style="padding: 10px;">
                                        <canvas id="chart_<?= $pertanyaan['id'] ?>" width="300" height="200"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php else: ?>
                    <div style="margin-left: 20px;">
                        <p>Tidak ada pertanyaan untuk sub dimensi ini.</p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <label style="font-weight: bold; margin-bottom: 5px;">Sub Dimensi: Tidak ada sub dimensi yang tersedia.</label>
        <?php endif; ?>
    </div>
</div>
<?php $this->endsection() ?>
<?php $this->section('script') ?>
<script>
    const ctx = document.getElementById('genderChart').getContext('2d');
    const genderChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Perempuan (P)', 'Laki-laki (L)'],
            datasets: [{
                label: 'Jumlah',
                data: [<?= $jumlah_kelamin['P'] ?>, <?= $jumlah_kelamin['L'] ?>],
                backgroundColor: [
                    'rgba(235, 52, 164)',
                    'rgba(52, 64, 235)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Diagram Berdasarkan Jenis Kelamin'
                }
            }
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctxAge = document.getElementById('ageChart').getContext('2d');
        const ageChart = new Chart(ctxAge, {
            type: 'pie',
            data: {
                labels: Object.keys(<?= json_encode($jumlah_umur) ?>), // Umur unik
                datasets: [{
                    label: 'Jumlah',
                    data: Object.values(<?= json_encode($jumlah_umur) ?>), // Jumlah masing-masing umur
                    backgroundColor: Array.from({
                        length: Object.keys(<?= json_encode($jumlah_umur) ?>).length
                    }, (_, i) => `hsl(${i * 40}, 70%, 50%)`), // Warna dinamis
                    borderColor: 'rgba(0, 0, 0, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true, // Menjaga rasio aspek
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Diagram Berdasarkan Umur'
                    }
                }
            }
        });

    });
</script>
<script>
    const ctxJob = document.getElementById('jobChart').getContext('2d');
    const jobChart = new Chart(ctxJob, {
        type: 'pie',
        data: {
            labels: Object.keys(<?= json_encode($jumlah_pekerjaan) ?>), // Pekerjaan unik
            datasets: [{
                label: 'Jumlah',
                data: Object.values(<?= json_encode($jumlah_pekerjaan) ?>), // Jumlah masing-masing pekerjaan
                backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#FFC300', '#FF33A1'],
                borderColor: 'rgba(0, 0, 0, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Diagram Pekerjaan'
                }
            }
        }
    });
</script>
<script>
    const ctxService = document.getElementById('serviceChart').getContext('2d');
    const serviceChart = new Chart(ctxService, {
        type: 'bar',
        data: {
            labels: Object.keys(<?= json_encode($jumlah_layanan) ?>),
            datasets: [{
                label: 'Jumlah',
                data: Object.values(<?= json_encode($jumlah_layanan) ?>),
                backgroundColor: 'rgba(136, 92, 224, 1)',
                borderColor: 'rgba(136, 92, 224, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    ticks: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Diagram Batang Layanan'
                }
            }
        }
    });
</script>
<script>
    const ctxTarget = document.getElementById('targetChart').getContext('2d');
    const targetChart = new Chart(ctxTarget, {
        type: 'bar',
        data: {
            labels: Object.keys(<?= json_encode($jumlah_sasaran) ?>),
            datasets: [{
                label: 'Jumlah',
                data: Object.values(<?= json_encode($jumlah_sasaran) ?>),
                backgroundColor: [
                    'rgba(255, 206, 86, 1)', // Kuning
                ],
                borderColor: [
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Diagram Sasaran Layanan'
                }
            }
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php foreach ($sub_dimensi as $dimensi): ?>
            <?php foreach ($dimensi['pertanyaan'] as $pertanyaan): ?>

                new Chart(document.getElementById('chart_<?= $pertanyaan['id'] ?>').getContext('2d'), {
                    type: 'pie',
                    data: {
                        labels: Object.keys(<?= json_encode($pertanyaan['jumlah_jawaban']) ?>).map(label => label.replace('option_', '')),
                        datasets: [{
                            label: 'Jumlah Jawaban: <?= array_sum($pertanyaan['jumlah_jawaban']) ?>',
                            data: Object.values(<?= json_encode($pertanyaan['jumlah_jawaban']) ?>),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.9)',
                                'rgba(54, 162, 235, 0.9)',
                                'rgba(255, 206, 86, 0.9)',
                                'rgba(75, 192, 192, 0.9)',
                                'rgba(153, 102, 255, 0.9)'
                            ],

                            borderColor: 'rgba(0, 0, 0, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            }
                        }
                    }
                });
            <?php endforeach; ?>
        <?php endforeach; ?>
    });
</script>

<?php $this->endsection() ?>