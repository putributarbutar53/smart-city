<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>SMART CITY</title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>favicon/favicon-16x16.png">
    <link rel="manifest" href="<?= base_url() ?>favicon/site.webmanifest">
    <meta name="theme-color" content="#ffffff">
    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="<?= base_url() ?>assets/lib/flatpickr/flatpickr.min.css" rel="stylesheet">

    <script src="<?= base_url() ?>assets/js/config.navbar-vertical.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="<?= base_url() ?>assets/lib/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/prismjs/prism-okaidia.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/datatables-bs4/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/datatables.net-responsive-bs4/responsive.bootstrap4.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/fancybox/jquery.fancybox.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/select2/select2.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/toastr/toastr.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/theme.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>



    <!-- datatables -->
    <script src="<?= base_url() ?>assets/lib/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/datatables-bs4/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/datatables.net-responsive/dataTables.responsive.js"></script>
    <script src="<?= base_url() ?>assets/lib/datatables.net-responsive-bs4/responsive.bootstrap4.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> -->

    <link type="text/css" href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />
    <script type="text/javascript" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
    <!-- checkbox -->
</head>

<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">

        <div class="container-fluid" data-layout="container">
            <?= $this->include('admin/layout/left_menu') ?>
            <div class="content">

                <?= $this->include('admin/layout/top_menu') ?>
                <!-- Render the content section -->
                <?= $this->renderSection('content') ?>

                <?= $this->include('admin/layout/footer') ?>
                <?= $this->include('admin/layout/modal-lg') ?>
                <?= $this->include('admin/layout/modal') ?>
            </div>
        </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url() ?>assets/js/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/@fortawesome/all.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/stickyfilljs/stickyfill.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/sticky-kit/sticky-kit.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/is_js/is.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/lodash/lodash.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/perfect-scrollbar/perfect-scrollbar.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <script src="<?= base_url() ?>assets/lib/prismjs/prism.js"></script>

    <!-- <script src="<?= base_url() ?>assets/lib/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/datatables-bs4/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/datatables.net-responsive/dataTables.responsive.js"></script>
    <script src="<?= base_url() ?>assets/lib/datatables.net-responsive-bs4/responsive.bootstrap4.js"></script> -->
    <script src="<?= base_url() ?>assets/lib/flatpickr/flatpickr.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/fancybox/jquery.fancybox.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/select2/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/tinymce/tinymce.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/toastr/toastr.min.js"></script>
    <script src="<?= base_url() ?>assets/js/theme.js"></script>
    <script src="<?= base_url() ?>assets/lib/echarts/echarts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- <script type="text/javascript" src="https://cd  n.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> -->


    <script>
        function showToast(type, message, title = null) {
            var defaultOptions = {
                closeButton: true,
                newestOnTop: false,
                positionClass: 'toast-bottom-right'
            };
            var vTitle = (title != null) ? title : type;
            toastr.options = defaultOptions;

            switch (type) {
                case 'success':
                    toastr.success(message, vTitle);
                    break;

                case 'warning':
                    toastr.warning(message, vTitle);
                    break;

                case 'error':
                    toastr.error(message, vTitle);
                    break;

                default:
                    toastr.info(message, vTitle);
                    break;
            }
        }

        function showToastError(error, eJson = null) {
            var defaultOptions = {
                closeButton: true,
                newestOnTop: false,
                positionClass: 'toast-bottom-right'
            };
            toastr.options = defaultOptions;

            if (eJson && eJson.errors) {
                // Menggunakan for...in loop
                for (var key in eJson.errors) {
                    toastr.error(eJson.errors[key], key);
                }
            } else {
                toastr.error(error, "Error");
            }
        }
    </script>

    <?= $this->renderSection('script') ?>
</body>

</html>