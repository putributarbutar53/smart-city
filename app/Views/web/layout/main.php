<!doctype html>
<html class="no-js" lang="zxx">

<!-- Mirrored from html.hixstudio.net/alizo-prev/alizo/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 27 Sep 2024 02:26:24 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Form Smart City - Kabupaten Toba</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>asset/img/logo/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMp5aUq1fZP8t94zOB/2bL8WaiD5u15GVy3cZc" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="<?= base_url() ?>asset/lib/datatables-bs4/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>asset/lib/datatables.net-responsive-bs4/responsive.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>asset/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url() ?>asset/css/animate.css">
    <link rel="stylesheet" href="<?= base_url() ?>asset/css/swiper-bundle.css">
    <link rel="stylesheet" href="<?= base_url() ?>asset/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url() ?>asset/css/font-awesome-pro.css">
    <link rel="stylesheet" href="<?= base_url() ?>asset/css/flaticon.css">
    <link rel="stylesheet" href="<?= base_url() ?>asset/css/spacing.css">
    <link rel="stylesheet" href="<?= base_url() ?>asset/css/ion.rangeSlider.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>asset/css/main.css">
    <style>
        .hidden {
            display: none;
        }

        .tp-service-insu-inner {
            height: 400px;
            /* Tentukan tinggi tetap */
            display: flex;
            flex-direction: column;
        }

        .tp-service-insu-cont {
            flex-grow: 1;
            /* Mengisi ruang kosong */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .tp-service-insu-icon-2 {
            margin-top: auto;
            /* Pastikan elemen ini diposisikan di bawah */
        }
    </style>
</head>

<body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
      <![endif]-->
    <!-- preloader -->
    <div id="preloader" class="tp-preloader">
        <div id="loader-img" class="tp-preloader-img">
            <div class="tp-preloader-main" id="loader"></div>
        </div>
        <div id="tp-preloader-panel_left" class='tp-preloader-section tp-preloader-section-left'></div>
        <div id="tp-preloader-panel_right" class='tp-preloader-section tp-preloader-section-right'></div>
    </div>
    <!-- preloader end  -->
    <div class="back-to-top-wrapper">
        <button id="back_to_top" type="button" class="back-to-top-btn">
            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
    </div>

    <!-- tp-offcanvus-area-start -->
    <!-- <div class="tpoffcanvas-area">
        <div class="tpoffcanvas">
            <div class="tpoffcanvas__close-btn">
                <button class="close-btn"><i class="fal fa-times"></i></button>
            </div>
            <div class="tpoffcanvas__logo">
                <a href="index-2.html">
                    <img src="<?= base_url() ?>asset/img/logo/logo5.png" alt="logo">
                </a>
            </div>
            <div class="tp-main-menu-mobile d-xl-none"></div>
            <div class="tpoffcanvas-btn mb-50">
                <a class="tp-btn" href="contact.html">GET STARTED</a>
            </div>
            <div class="tpoffcanvas__contact-info">
                <div class="tpoffcanvas__contact-title">
                    <h5>Contact us</h5>
                </div>
                <ul>
                    <li>
                        <i class="fa-light fa-location-dot"></i>
                        <a href="https://www.google.com/maps/@41.6758525,-86.2531698,18.17z" target="_blank">Melbone st, Australia, Ny 12099</a>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:alizoinfo@gmail.com"><span>alizoinfo@gmail.com</span></a>
                    </li>
                    <li>
                        <i class="fal fa-phone-alt"></i>
                        <a href="tel:(+00)67834598568">(+00) 678 345 98568</a>
                    </li>
                </ul>
            </div>
            <div class="tpoffcanvas__social">
                <div class="social-icon">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                </div>
            </div>
        </div>
    </div> -->
    <div class="body-overlay"></div>
    <!-- tp-offcanvus-area-end -->
    <!--search-form-start -->
    <div class="tp-search-body-overlay"></div>
    <div class="tp-search-form-toggle">
        <div class="tp-search-close">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="tp-search-form">
                        <h4>WHAT ARE YOU LOOKING FOR?</h4>
                        <form action="#">
                            <input type="text" placeholder="Search Here.." required>
                            <div class="tp-search-form-icon">
                                <button type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- search-form-end -->

    <?= $this->include('web/layout/top_menu') ?>
    <main>
        <?= $this->renderSection('content') ?>
    </main>
    <!-- footer-area-start -->
    <?= $this->include('web/layout/footer') ?>
    <!-- footer-area-end -->
    <!-- JS here -->
    <script src="<?= base_url() ?>asset/js/vendors/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url() ?>asset/lib/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>asset/lib/datatables-bs4/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>asset/lib/datatables.net-responsive/dataTables.responsive.js"></script>
    <script src="<?= base_url() ?>asset/lib/datatables.net-responsive-bs4/responsive.bootstrap4.js"></script>
    <script src="<?= base_url() ?>asset/js/vendors/waypoints.js"></script>
    <script src="<?= base_url() ?>asset/js/bootstrap-bundle.js"></script>
    <script src="<?= base_url() ?>asset/js/meanmenu.js"></script>
    <script src="<?= base_url() ?>asset/js/swiper-bundle.js"></script>
    <script src="<?= base_url() ?>asset/js/ion.rangeSlider.min.js"></script>
    <script src="<?= base_url() ?>asset/js/magnific-popup.js"></script>
    <script src="<?= base_url() ?>asset/js/nice-select.js"></script>
    <script src="<?= base_url() ?>asset/js/jquery.counterup.min.js"></script>
    <script src="<?= base_url() ?>asset/js/one-page-nav-min.js"></script>
    <script src="<?= base_url() ?>asset/js/wow.js"></script>
    <script src="<?= base_url() ?>asset/js/ajax-form.js"></script>
    <script src="<?= base_url() ?>asset/js/main.js"></script>
    <?= $this->renderSection('script') ?>
</body>

<!-- Mirrored from html.hixstudio.net/alizo-prev/alizo/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 27 Sep 2024 02:26:39 GMT -->

</html>