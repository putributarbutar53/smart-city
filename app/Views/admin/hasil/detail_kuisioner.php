<!-- home.php -->
<?php $this->extend('admin/layout/main') ?>

<?php $this->section('content') ?>
<!-- Page content goes here -->

<div class="card mb-3">
    <div class="card-body bg-light">
        <div class="container mt-4">
            <h1>Detail Kuisioner</h1>
            <h3>Nama: <?= esc($kuisioner['nama']) ?></h3>
            <h3>Email: <?= esc($kuisioner['email']) ?></h3>
            <h3>Jenis Kelamin: <?= esc($kuisioner['jenis_kelamin']) ?></h3>
            <h3>Umur: <?= esc($kuisioner['umur']) ?></h3>
            <h3>Pekerjaan: <?= esc($kuisioner['pekerjaan']) ?></h3>

            <h2>Sub Dimensi</h2>
            <ul>
                <?php if (!empty($subDimensi)) : ?>
                    <?php foreach ($subDimensi as $dimensi) : ?>
                        <li><?= esc($dimensi['sub_dimensi']) ?></li>
                        <!-- Ambil pertanyaan berdasarkan sub dimensi -->
                        <ul>
                            <?php
                            $pertanyaan = $this->dimensiModel->getPertanyaanBySubdimensi($dimensi['id']);
                            if (!empty($pertanyaan)):
                                foreach ($pertanyaan as $item):
                            ?>
                                    <li><?= esc($item['pertanyaan']) ?></li>
                            <?php endforeach;
                            endif; ?>
                        </ul>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li>Tidak ada sub dimensi untuk kategori ini.</li>
                <?php endif; ?>
            </ul>

            <a href="<?= site_url('admin2053/hasil') ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
<div class="card mb-3">
    <div class="card-body">
        <div class="row align-items-center text-center mb-3">
            <div class="col text-sm-right mt-3 mt-sm-0">
                <h5><?= esc($kuisioner['nama']) ?></h5>
                <p class="fs--1 mb-0"><?= esc($kuisioner['email']) ?></p>
            </div>
            <div class="col-12">
                <hr>
            </div>
        </div>
        <div class="row justify-content-between align-items-center">
            <div class="col">
                <h6 class="text-500">Invoice to</h6>
                <h5>Antonio Banderas</h5>
                <p class="fs--1">1954 Bloor Street West<br>Torronto ON, M6P 3K9<br>Canada</p>
                <p class="fs--1"><a href="mailto:example@gmail.com">example@gmail.com</a><br><a href="tel:444466667777">+4444-6666-7777</a></p>
            </div>
            <div class="col-sm-auto ml-auto">
                <div class="table-responsive">
                    <table class="table table-sm table-borderless fs--1">
                        <tbody>
                            <tr>
                                <th class="text-sm-right">Invoice No:</th>
                                <td>14</td>
                            </tr>
                            <tr>
                                <th class="text-sm-right">Order Number:</th>
                                <td>AD20294</td>
                            </tr>
                            <tr>
                                <th class="text-sm-right">Invoice Date:</th>
                                <td>2018-09-25</td>
                            </tr>
                            <tr>
                                <th class="text-sm-right">Payment Due:</th>
                                <td>Upon receipt</td>
                            </tr>
                            <tr class="alert-success font-weight-bold">
                                <th class="text-sm-right">Amount Due:</th>
                                <td>$19688.40</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="table-responsive mt-4 fs--1">
            <table class="table table-striped border-bottom">
                <thead>
                    <tr class="bg-primary text-white">
                        <th class="border-0">Products</th>
                        <th class="border-0 text-center">Quantity</th>
                        <th class="border-0 text-right">Rate</th>
                        <th class="border-0 text-right">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="align-middle">
                            <h6 class="mb-0 text-nowrap">Platinum web hosting package</h6>
                            <p class="mb-0">Down 35mb, Up 100mb</p>
                        </td>
                        <td class="align-middle text-center">2</td>
                        <td class="align-middle text-right">$65.00</td>
                        <td class="align-middle text-right">$130.00</td>
                    </tr>
                    <tr>
                        <td class="align-middle">
                            <h6 class="mb-0 text-nowrap">2 Page website design</h6>
                            <p class="mb-0">Includes basic wireframes and responsive templates</p>
                        </td>
                        <td class="align-middle text-center">1</td>
                        <td class="align-middle text-right">$2,100.00</td>
                        <td class="align-middle text-right">$2,100.00</td>
                    </tr>
                    <tr>
                        <td class="align-middle">
                            <h6 class="mb-0 text-nowrap">Mobile App Development</h6>
                            <p class="mb-0">Includes responsive navigation</p>
                        </td>
                        <td class="align-middle text-center">8</td>
                        <td class="align-middle text-right">$5,00.00</td>
                        <td class="align-middle text-right">$4,000.00</td>
                    </tr>
                    <tr>
                        <td class="align-middle">
                            <h6 class="mb-0 text-nowrap">Web App Development</h6>
                            <p class="mb-0">Includes react spa</p>
                        </td>
                        <td class="align-middle text-center">6</td>
                        <td class="align-middle text-right">$2,000.00</td>
                        <td class="align-middle text-right">$12,000.00</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row no-gutters justify-content-end">
            <div class="col-auto">
                <table class="table table-sm table-borderless fs--1 text-right">
                    <tr>
                        <th class="text-900">Subtotal:</th>
                        <td class="font-weight-semi-bold">$18,230.00 </td>
                    </tr>
                    <tr>
                        <th class="text-900">Tax 8%:</th>
                        <td class="font-weight-semi-bold">$1458.40</td>
                    </tr>
                    <tr class="border-top">
                        <th class="text-900">Total:</th>
                        <td class="font-weight-semi-bold">$19688.40</td>
                    </tr>
                    <tr class="border-top border-2x font-weight-bold text-900">
                        <th>Amount Due:</th>
                        <td>$19688.40</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer bg-light">
        <p class="fs--1 mb-0"><strong>Notes: </strong>We really appreciate your business and if there’s anything else we can do, please let us know!</p>
    </div>
</div>
<?php $this->endsection() ?>