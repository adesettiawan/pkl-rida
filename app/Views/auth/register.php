<?= $this->extend('auth/_layouts/app') ?>

<?= $this->Section('content') ?>

<section class="section">
    <div class="container mt-4">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Register</h4>
                    </div>
                    <?php

                    $errors = session()->getFlashdata('errors');
                    if (!empty($errors)) { ?>
                        <div class="alert alert-danger text-white" role="alert">
                            <ul class="text-white">
                                <?php foreach ($errors as $error) : ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php } ?>

                    <?php if (session()->getFlashdata('messages')) {
                        echo '<div class="alert alert-danger bg-danger text-white" role="alert">';
                        echo session()->getFlashdata('messages');
                        echo '</div>';
                    } ?>

                    <?php if (session()->getFlashdata('message')) {
                        echo '<div class="alert alert-success bg-success text-white" role="alert">';
                        echo session()->getFlashdata('message');
                        echo '</div>';
                    } ?>
                    <div class="card-body">
                        <form action="<?= base_url('register_processed') ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="name">Nama lengkap</label>
                                    <input id="name" type="text" class="form-control" name="name" autofocus required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="telp">No. Handphone</label>
                                    <input id="telp" type="text" class="form-control" name="telp" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="instansi_name">Nama Instansi</label>
                                    <input id="instansi_name" type="text" class="form-control" name="instansi_name" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="password" class="d-block">Password</label>
                                    <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                                    <div id="pwindicator" class="pwindicator">
                                        <div class="bar"></div>
                                        <div class="label"></div>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="repassword" class="d-block">Password Confirmation</label>
                                    <input id="repassword" type="password" class="form-control" name="repassword">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="npm">NIM/NPM</label>
                                <input id="npm" type="text" class="form-control" name="npm" required>
                            </div>
                            <div class="form-group">
                                <label for="ktm">Upload KTM</label>
                                <div class="custom-file">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    <input type="file" accept="image/*" class="custom-file-input" id="customFile" name="ktm" style="display: none;">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="mb-4 text-muted text-center">
                        Already Registered? <a href="<?= base_url('/') ?>">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    $('#customFile').change(function() {
        var i = $(this).prev('label').clone();
        var file = $('#customFile')[0].files[0].name;
        $(this).prev('label').text(file);
    });
</script>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(2000, 0).slideUp(500, function() {
            $($this).remove();
        });
    }, 3000);
</script>
<?= $this->endSection() ?>