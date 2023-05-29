<?= $this->extend('_layouts/app') ?>

<?= $this->Section('content') ?>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-7">
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <div class="author-box-left">
                                <?php if (session()->get('image') != '') { ?>
                                    <img alt="image" src="<?= base_url() ?>assets/img/<?= session()->get('image') ?>" class="rounded-circle author-box-picture">
                                <?php  } else { ?>
                                    <img alt="image" src="<?= base_url() ?>assets/img/profile.jpg" class="rounded-circle author-box-picture">
                                <?php } ?>

                                <div class="clearfix"></div>
                            </div>
                            <div class="author-box-details">
                                <div class="author-box-name" style="font-size: 20px;">
                                    <a href="javascript:void(0)"><?= session()->get('name') ?> </a>
                                    <?php if (session()->get('status') == 1) { ?>
                                        <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i> Aktif</div>
                                    <?php } else { ?>
                                        <div class="text-small font-weight-600 text-muted"><i class="fas fa-circle"></i> Tidak aktif</div>
                                    <?php } ?>
                                </div>
                                <div class="author-box-job mt-1" style="font-size: 14px;"></div>
                                <div class="author-box-description">
                                    <p>NPM : <?= session()->get('npm') ?> | <?= session()->get('instansi_name') ?> <br>
                                        <span style="font-size: 14px;">Email : <?= session()->get('email') ?></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>