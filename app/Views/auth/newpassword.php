<?= $this->extend('auth/_layouts/app') ?>

<?= $this->Section('content') ?>

<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Reset Password</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Enter Your New Password</p>
                        <form method="POST" action="<?= base_url('new_password_processed/' . $user['email']) ?>">
                            <input type="hidden" name="email" value="<?= $user['email'] ?>">
                            <!-- <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                            </div> -->
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" tabindex="2" required>
                                <div id="pwindicator" class="pwindicator">
                                    <div class="bar"></div>
                                    <div class="label"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="repassword">Confirm Password</label>
                                <input id="repassword" type="password" class="form-control" name="repassword" tabindex="2" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Reset Password
                                </button>
                            </div>
                        </form>
                    </div>
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