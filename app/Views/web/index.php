<?php $this->extend('web/layout/main') ?>

<?php $this->section('content') ?>
<div class="service-area tp-grey-insu-2 p-relative pt-115 pb-90">
    <img class="tp-service-shape-insu up-down p-absolute" src="<?= base_url() ?>assets/img/service/round-shape.png" alt="shape">
    <img class="tp-service-shape-insu-2 d-none d-sm-block up-down p-absolute" src="<?= base_url() ?>assets/img/service/round-shape-2.png" alt="shape">
    <div class="container">
        <div class="row gx-0">
            <div class="col-12">
                <div class="tp-section-title-wrapper text-center mb-60 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                    <h6 class="tp-section-title tp-section-title-insu" style="margin-top: -60px;">Smart City</h6>
                </div>
            </div>
            <!-- <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="tp-service-insu-wrapper text-center mb-30 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                    <div class="tp-service-insu-inner">
                        <div class="tp-service-insu-btn p-relative">
                            <img src="<?= base_url() ?>assets/img/service/eco-house.png" alt="service-btn" width="100" height="100">
                        </div>
                        <div class="tp-service-insu-cont">
                            <h3 class="tp-service-insu-title"><a href="service-details.html">Smart Living</a></h3>
                            <p class="tp-service-insu-para">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.</p>
                            <div class="tp-service-insu-icon-2">
                                <a href="service-details.html"><i class="flaticon-next"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="tp-service-insu-wrapper text-center mb-30 wow fadeInUp" data-wow-delay=".5s" data-wow-duration="1s">
                    <div class="tp-service-insu-inner">
                        <div class="tp-service-insu-btn p-relative">
                            <img src="<?= base_url() ?>assets/img/service/save-the-planet.png" alt="service-btn" width="100" height="100">
                        </div>
                        <div class="tp-service-insu-cont">
                            <h3 class="tp-service-insu-title"><a href="service-details.html">Smart Environment</a></h3>
                            <p class="tp-service-insu-para">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.</p>
                            <div class="tp-service-insu-icon-2">
                                <a href="service-details.html"><i class="flaticon-next"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="tp-service-insu-wrapper text-center mb-30 wow fadeInUp" data-wow-delay=".7s" data-wow-duration="1s">
                    <div class="tp-service-insu-inner">
                        <div class="tp-service-insu-btn p-relative">
                            <img src="<?= base_url() ?>assets/img/service/branding.png" alt="service-btn" width="100" height="100">
                        </div>
                        <div class="tp-service-insu-cont">
                            <h3 class="tp-service-insu-title"><a href="service-details.html">Smart Branding</a></h3>
                            <p class="tp-service-insu-para">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.</p>
                            <div class="tp-service-insu-icon-2">
                                <a href="service-details.html"><i class="flaticon-next"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="tp-service-insu-wrapper text-center mb-30 wow fadeInUp" data-wow-delay=".9s" data-wow-duration="1s">
                    <div class="tp-service-insu-inner">
                        <div class="tp-service-insu-btn p-relative">
                            <img src="<?= base_url() ?>assets/img/service/community.png" alt="service-btn" width="100" height="100">
                        </div>
                        <div class="tp-service-insu-cont">
                            <h3 class="tp-service-insu-title"><a href="service-details.html">Smart Society</a></h3>
                            <p class="tp-service-insu-para">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.</p>
                            <div class="tp-service-insu-icon-2">
                                <a href="service-details.html"><i class="flaticon-next"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <?php foreach ($kategori as $item): ?>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="tp-service-insu-wrapper text-center mb-30 wow fadeInUp" data-wow-delay=".7s" data-wow-duration="1s">
                        <div class="tp-service-insu-inner">
                            <div class="tp-service-insu-btn p-relative">
                                <img src="<?= base_url() . getenv('dir.uploads.category') . $item['img'] ?>" alt="service-btn" width="100" height="100">
                            </div>
                            <div class="tp-service-insu-cont">
                                <h3 class="tp-service-insu-title"><a href="service-details.html"><?= $item['nama'] ?></a></h3>
                                <p class="tp-service-insu-para"><?= $item['desc'] ?></p>
                                <div class="tp-service-insu-icon-2">
                                    <a href="service-details.html"><i class="flaticon-next"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- service-area-end -->
<?php $this->endsection() ?>
<?php $this->section('script') ?>
<?php $this->endsection() ?>