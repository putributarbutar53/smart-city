<!-- home.php -->
<?php $this->extend('admin/layout/main') ?>

<?php $this->section('content') ?>
<!-- Page content goes here -->
<!-- <div class="card mb-3">
    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?= base_url() ?>assets/img/illustrations/corner-4.png);">
    </div>
    /.bg-holder
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8">
                <h3 class="mb-0">Dashboard</h3>
            </div>
        </div>
    </div>
</div> -->
<div class="card mb-3">
    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?= base_url() ?>/assets/img/illustrations/corner-4.png);">
    </div>
    <!--/.bg-holder-->
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <h3>Dashboard</h3>
                <div class="card-deck">

                </div>
            </div>
        </div>
    </div>
</div>
<?php if ((session()->get('admin_role') == 'superadmin') || (session()->get('admin_role') == 'admin')) { ?>
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?= base_url() ?>/assets/img/illustrations/corner-4.png);">
        </div>
        <!--/.bg-holder-->
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<div class="card mb-3">

</div>


<div class="card mb-3">
    <div class="card-header">
        <div class="row align-items-center justify-content-between">
            <div class="col-6 col-sm-auto d-flex align-items-center pr-0">
                <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">Account</h5>
            </div>
        </div>
    </div>
    <div class="card-body pt-0">
        <div class="container">
            <div class="row">
                <?php if (session()->get('admin_role') == 'superadmin') { ?>
                    <div class="col-sm"><a href="<?= site_url('admin2053/admin') ?>"><img src="<?= base_url() ?>assets/icon/1797890_86.png" /></a><br />Admin</div>
                <?php } ?>
                <div class="col-sm"><a href="<?= site_url('admin2053/profile') ?>"><img src="<?= base_url() ?>assets/icon/1797890_64.png" /></a><br />Ubah Password</div>
                <div class="col-sm"><a href="<?= site_url('admin2053/Login/logout') ?>"><img src="<?= base_url() ?>assets/icon/1797890_46.png" /></a><br />Logout</div>
            </div>
        </div>
    </div>
</div>
<script>
</script>
<?php $this->endsection() ?>