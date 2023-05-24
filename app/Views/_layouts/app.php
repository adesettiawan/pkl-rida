<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title != '' ? $title : 'PKL Bidang RIDA'; ?></title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/app.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/bundles/datatables/datatables.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/custom.css">
    <!-- <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' /> -->
    <link rel='shortcut icon' type='image/x-icon' href='<?= base_url() ?>assets/img/logo1.png' />
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            <!-- navbar -->
            <?= $this->include('_layouts/_partials/navbar') ?>
            <!-- End navbar -->

            <!-- sidebar -->
            <?= $this->include('_layouts/_partials/sidebar') ?>
            <!-- End sidebar -->

            <!-- content -->
            <?= $this->renderSection('content') ?>
            <!-- end content -->

            <!-- footer -->
            <?= $this->include('_layouts/_partials/footer') ?>
            <!-- End footer -->

        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="<?= base_url() ?>assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <script src="<?= base_url() ?>assets/bundles/apexcharts/apexcharts.min.js"></script>
    <!-- Page Specific JS File -->
    <!-- JS Libraies -->
    <script src="<?= base_url() ?>assets/bundles/datatables/datatables.min.js"></script>
    <script src="<?= base_url() ?>assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/bundles/jquery-ui/jquery-ui.min.js"></script>
    <!-- Page Specific JS File -->
    <script src="<?= base_url() ?>assets/js/page/datatables.js"></script>
    <script src="<?= base_url() ?>assets/js/page/index.js"></script>
    <!-- Template JS File -->
    <script src="<?= base_url() ?>assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="<?= base_url() ?>assets/js/custom.js"></script>
</body>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->

</html>