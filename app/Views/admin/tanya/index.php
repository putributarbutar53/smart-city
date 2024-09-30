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
                <h3 class="mb-0">Pertanyaan</h3>
            </div>
        </div>
    </div>
</div>


<div class="card mb-3">
    <div class="card-body bg-light">
        <div class="container">
            <div class="row">
                <?php foreach ($kategori as $item): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card" style="width: 100%; min-height: 350px;"> <!-- Tambahkan min-height -->
                            <div class="d-flex justify-content-center mt-3">
                                <img class="img-fluid" style="width: 100px; height: 100px;" src="<?= base_url() . getenv('dir.uploads.category') . $item['img'] ?>">
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title"><?= $item['nama'] ?></h5>
                                <p class="card-text"><?= $item['desc'] ?></p>
                            </div>
                            <div class="card-body text-center">
                                <a class="card-link" href="<?= site_url('admin2053/category/bagian/' . $item['id']) ?>">Buat Pertanyaan</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>


    </div>
</div>
</div>
<?php $this->endsection() ?>
<?php $this->section('script') ?>
<?php $this->endsection() ?>