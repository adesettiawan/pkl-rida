<?= $this->extend('auth/_layouts/app') ?>

<?= $this->Section('content') ?>

<section class="section" style="padding-top: 20px;">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="card card-primary">
                    <div class="d-flex justify-content-center align-items-center mt-4">
                        <img alt="image" width="60" height="60" src="<?= base_url() ?>assets/img/logoprov.png" class="header-logo" />
                    </div>
                    <div class="card-header justify-content-center">
                        <h4>Login RIDA</h4>
                    </div>
                    <div class="card-body">
                        <?php

                        $errors = session()->getFlashdata('errors');
                        if (!empty($errors)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    <?php foreach ($errors as $error) : ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php } ?>

                        <?php if (session()->getFlashdata('messages')) {
                            echo '<div class="alert alert-danger" role="alert">';
                            echo session()->getFlashdata('messages');
                            echo '</div>';
                        } ?>

                        <?php if (session()->getFlashdata('message')) {
                            echo '<div class="alert alert-success" role="alert">';
                            echo session()->getFlashdata('message');
                            echo '</div>';
                        } ?>

                        <form method="POST" action="<?= base_url('login_processed') ?>" class="needs-validation" novalidate="">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" tabindex="1" placeholder="Email" required autofocus autocomplete="off">
                                <div class="invalid-feedback">
                                    Please fill in your email
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                    <div class="float-right">
                                        <a href="<?= base_url('forgot-password') ?>" class="text-small">
                                            Lupa Password?
                                        </a>
                                    </div>
                                </div>
                                <input id="password" type="password" class="form-control" name="password" tabindex="2" placeholder="Password" required autocomplete="off">
                                <div class="invalid-feedback">
                                    please fill in your password
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                                </div>
                            </div> -->
                            <div class="form-group" style="margin-top: 50px;">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Masuk
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-5 text-muted text-center">
                    Belum memiliki akun? <a href="<?= base_url('register') ?>">Daftar akun!</a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(300, function() {
            $($this).remove();
        });
    }, 3000);
</script>

<?= $this->endSection() ?>