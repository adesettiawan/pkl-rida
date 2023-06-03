<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title != '' ? $title : 'PKL Bidang RIDA'; ?></title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/app.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/bundles/bootstrap-social/bootstrap-social.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='<?= base_url() ?>assets/img/logo1.png' />
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <!-- content -->
        <?= $this->renderSection('content') ?>
        <!-- end content -->
    </div>
    <!-- General JS Scripts -->
    <script src="<?= base_url() ?>assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="<?= base_url() ?>assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="<?= base_url() ?>assets/js/custom.js"></script>

    <?= $this->renderSection('script') ?>
</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

</html>