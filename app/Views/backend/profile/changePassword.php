<?= $this->extend('_layouts/app') ?>

<?= $this->Section('content') ?>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Edit password user profile</h4>

                            </div>
                        </div>

                        <?php

                        $errors = session()->getFlashdata('errors');
                        if (!empty($errors)) { ?>
                            <div class="alert alert-danger" role="alert">
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
                            <!-- form edit -->
                            <form action="<?= base_url('change-password-profile-processed/' . $profile['id']) ?>" method="POST" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label>Name</label>
                                            <input id="id" name="id" type="hidden" value="<?= $profile['id'] ?>" class="form-control">
                                            <input readonly id="name" name="name" type="text" value="<?= $profile['name'] ?>" class="form-control" placeholder="fill name">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group form-group-default">
                                            <label>Password</label>
                                            <input id="password" name="password" type="password" class="form-control" placeholder="fill password">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group form-group-default">
                                            <label>Repeat password</label>
                                            <input id="repassword" name="repassword" type="password" class="form-control" placeholder="fill repassword">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer no-bd mt-3">
                                    <a href="<?= base_url('profile/' . $profile['id']) ?>" class="btn btn-danger">Back</a>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection('') ?>

<?= $this->Section('script') ?>

<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(2000, 0).slideUp(500, function() {
            $($this).remove();
        });
    }, 3000);
</script>
<?= $this->endSection('') ?>