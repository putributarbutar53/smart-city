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
                <h3 class="mb-0">Hasil Survey : <?= $detail['nama'] ?? '-' ?></h3>
            </div>
        </div>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header">
        <a href="<?= site_url('admin2053/export/exportExcel/' . session('id_kategori')) ?>" class="btn btn-sm btn-falcon-success">
            <i class="fas fa-file-excel"></i> Export Excel
        </a>
        <a href="<?= site_url('admin2053/hasil/diagram/' . $detail['id']) ?>" class="btn btn-sm btn-falcon-danger">
            <i class="fas fa-chart-pie"></i> Lihat Diagram
        </a>
        <br><br>
        <div class="row flex-between-center">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-sm table-dashboard data-table no-wrap mb-0 fs--1 w-100">
                        <thead class="bg-200">
                            <tr>
                                <th>#</th> <!-- Kolom baru untuk tombol fas fa-eye -->
                                <th class="sort">Nama</th>
                                <th class="sort"><i class="fas fa-camera sort-icon"></th>
                                <th class="sort"><i class="fas fa-signature"></i></th>
                                <th class="sort">Email</th>
                                <th class="sort">JK</th>
                                <th class="sort">Umur</th>
                                <th class="sort">Pekerjaan</th>
                                <th class="sort">Nama Layanan</th>
                                <th class="sort">Sasaran Layanan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <?php if (!empty($kuisioner)) : ?>
                                <?php foreach ($kuisioner as $item) : ?>
                                    <tr>
                                        <td>
                                            <a href="<?= site_url('admin2053/hasil/detailkuisioner/' . $item['id']) ?>" class="btn-icon-only text-danger">
                                                <span class="fas fa-eye"></span>
                                            </a>
                                        </td>
                                        <td><?= esc($item['nama']) ?></td>
                                        <td>
                                            <?php if (!empty($item['selfie_data'])): ?>
                                                <a href="<?= base_url() . getenv('dir.uploads.selfie') . '/' . esc($item['selfie_data']) ?>" data-fancybox data-caption="<?= esc($item['nama']) ?>">
                                                    <img class="rounded" width="30" src="<?= base_url() . getenv('dir.uploads.selfie') . '/' . esc($item['selfie_data']) ?>" alt="<?= esc($item['nama']) ?>">
                                                </a>
                                            <?php else: ?>
                                                ----
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($item['signature_data'])): ?>
                                                <a href="<?= base_url() . getenv('dir.uploads.ttd') . '/' . esc($item['signature_data']) ?>" data-fancybox data-caption="<?= esc($item['nama']) ?>">
                                                    <img class="rounded" width="30" src="<?= base_url() . getenv('dir.uploads.ttd') . '/' . esc($item['signature_data']) ?>" alt="<?= esc($item['nama']) ?>">
                                                </a>
                                            <?php else: ?>
                                                ----
                                            <?php endif; ?>
                                        </td>

                                        <td><?= esc($item['email']) ?></td>
                                        <td><?= esc($item['jenis_kelamin']) ?></td>
                                        <td><?= esc($item['umur']) ?></td>
                                        <td><?= esc($item['pekerjaan']) ?></td>
                                        <td><?= esc($item['nama_layanan']) ?></td>
                                        <td><?= esc($item['sasaran_layanan']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada kuisioner yang tersedia untuk kategori ini.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    </div>
</div>
<?php $this->endsection() ?>